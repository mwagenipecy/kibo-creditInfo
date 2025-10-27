<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\VehicleNegotiation;
use App\Models\NegotiationMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MyVehicleList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'tailwind';
    
    public $searchTerm = '';
    public $statusFilter = '';
    public $showModal = false;
    public $selectedVehicle = null;
    public $showNegotiations = false;
    public $showChatModal = false;
    public $selectedNegotiation = null;
    public $chatMessage = '';
    public $sellerPrice = '';
    public $selectedVehicleId = null;
    public $vehicleNegotiations = [];
    public $negotiationFilter = 'all';
    public $showConfirmSaleModal = false;
    public $saleToConfirm = null;
    
    public function render()
    {
        $userId = Auth::id();
        
        $vehicles = Vehicle::where('user_id', $userId)
            ->with(['make', 'model', 'bodyType', 'fuelType', 'transmission', 'images'])
            ->when($this->searchTerm, function ($query) {
                $query->whereHas('make', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                ->orWhereHas('model', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                ->orWhere('year', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('price', 'like', '%' . $this->searchTerm . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Get pending and accepted negotiations for seller's vehicles
        $pendingNegotiations = VehicleNegotiation::where('seller_id', $userId)
            ->whereIn('status', ['pending', 'accepted'])
            ->with(['vehicle', 'buyer'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('livewire.web.my-vehicle-list', [
            'vehicles' => $vehicles,
            'pendingNegotiations' => $pendingNegotiations
        ]);
    }
    
    public function deleteVehicle($vehicleId)
    {
        $vehicle = Vehicle::where('user_id', Auth::id())
            ->where('id', $vehicleId)
            ->first();
        
        if ($vehicle) {
            // Delete associated images
            $vehicle->images()->delete();
            $vehicle->delete();
            
            session()->flash('success', 'Vehicle deleted successfully!');
        }
    }

    public function setAsSold($vehicleId)
    {
        $vehicle = Vehicle::where('user_id', Auth::id())
            ->where('id', $vehicleId)
            ->first();
        
        if ($vehicle) {
            $vehicle->status = 'sold';
            $vehicle->save();
            
            // Update selected vehicle if it's the same one
            if ($this->selectedVehicle && $this->selectedVehicle->id == $vehicleId) {
                $this->selectedVehicle->status = 'sold';
            }
            
            session()->flash('success', 'Vehicle marked as sold successfully!');
        }
    }
    
    public function setToActive($vehicleId)
    {
        $vehicle = Vehicle::where('user_id', Auth::id())
            ->where('id', $vehicleId)
            ->first();
        
        if ($vehicle) {
            $vehicle->status = 'active';
            $vehicle->save();
            
            // Update selected vehicle if it's the same one
            if ($this->selectedVehicle && $this->selectedVehicle->id == $vehicleId) {
                $this->selectedVehicle->status = 'active';
            }
            
            session()->flash('success', 'Vehicle set to active successfully!');
        }
    }

    public function viewVehicle($vehicleId)
    {
        $this->selectedVehicle = Vehicle::with(['make', 'model', 'bodyType', 'fuelType', 'transmission', 'images'])
            ->where('user_id', Auth::id())
            ->find($vehicleId);
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedVehicle = null;
    }
    
    public function viewNegotiations()
    {
        $this->showNegotiations = true;
    }
    
    public function closeNegotiations()
    {
        $this->showNegotiations = false;
        $this->selectedVehicleId = null;
        $this->vehicleNegotiations = [];
        $this->negotiationFilter = 'all';
    }
    
    public function acceptNegotiation($negotiationId)
    {
        $negotiation = VehicleNegotiation::find($negotiationId);
        
        if ($negotiation && $negotiation->seller_id == Auth::id()) {
            $negotiation->status = 'accepted';
            $negotiation->save();
            
            session()->flash('success', 'Negotiation accepted! You can now respond to the buyer.');
            // Don't auto-open chat, let them use the Chat button
        }
    }
    
    public function rejectNegotiation($negotiationId)
    {
        $negotiation = VehicleNegotiation::find($negotiationId);
        
        if ($negotiation && $negotiation->seller_id == Auth::id()) {
            $negotiation->status = 'rejected';
            $negotiation->save();
            
            session()->flash('info', 'Negotiation rejected.');
        }
    }
    
    public function openChat($negotiationId)
    {
        try {
            \Log::info('openChat called with ID: ' . $negotiationId);
            
            $this->selectedNegotiation = VehicleNegotiation::with(['buyer', 'vehicle', 'messages.sender'])
                ->find($negotiationId);
            
            if ($this->selectedNegotiation) {
                $this->showChatModal = true;
                session()->flash('success', 'Opening chat...');
                \Log::info('Chat modal opened for negotiation: ' . $negotiationId);
            } else {
                session()->flash('error', 'Negotiation not found.');
                \Log::warning('Negotiation not found: ' . $negotiationId);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error opening chat: ' . $e->getMessage());
            \Log::error('Error in openChat: ' . $e->getMessage());
        }
    }
    
    public function openVehicleChat($vehicleId)
    {
        $this->selectedVehicleId = $vehicleId;
        
        // Get all negotiations for this vehicle
        $this->vehicleNegotiations = VehicleNegotiation::where('vehicle_id', $vehicleId)
            ->where('seller_id', Auth::id())
            ->with(['buyer', 'vehicle', 'messages'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $this->showNegotiations = true;
    }
    
    public function closeChat()
    {
        $this->showChatModal = false;
        $this->selectedNegotiation = null;
        $this->chatMessage = '';
        $this->sellerPrice = '';
    }
    
    public function sendMessage()
    {
        if (!$this->chatMessage || trim($this->chatMessage) == '') {
            return;
        }
        
        NegotiationMessage::create([
            'negotiation_id' => $this->selectedNegotiation->id,
            'sender_id' => Auth::id(),
            'message' => trim($this->chatMessage)
        ]);
        
        $this->chatMessage = '';
        $this->selectedNegotiation->refresh();
        
        // Dispatch event to scroll to bottom
        $this->dispatchBrowserEvent('scrollToBottom', ['element' => 'seller-chat-messages']);
    }
    
    public function sendPriceOffer()
    {
        if (!$this->sellerPrice || !is_numeric($this->sellerPrice) || $this->sellerPrice <= 0) {
            session()->flash('error', 'Please enter a valid price amount.');
            return;
        }
        
        NegotiationMessage::create([
            'negotiation_id' => $this->selectedNegotiation->id,
            'sender_id' => Auth::id(),
            'message' => 'Counter Offer: TSh ' . number_format($this->sellerPrice)
        ]);
        
        $this->sellerPrice = '';
        $this->selectedNegotiation->refresh();
        session()->flash('success', 'Your counter offer has been sent.');
        
        // Dispatch event to scroll to bottom
        $this->dispatchBrowserEvent('scrollToBottom', ['element' => 'seller-chat-messages']);
    }
    
    public function sendSellerKeyword($keyword, $negotiationId)
    {
        NegotiationMessage::create([
            'negotiation_id' => $negotiationId,
            'sender_id' => Auth::id(),
            'message' => $keyword
        ]);
        
        $this->selectedNegotiation->refresh();
        session()->flash('success', 'Message sent!');
        
        // Dispatch event to scroll to bottom
        $this->dispatchBrowserEvent('scrollToBottom', ['element' => 'seller-chat-messages']);
    }
    
    public function openConfirmSaleModal($negotiationId)
    {
        $this->saleToConfirm = VehicleNegotiation::with(['vehicle', 'buyer'])->find($negotiationId);
        $this->showConfirmSaleModal = true;
    }
    
    public function closeConfirmSaleModal()
    {
        $this->showConfirmSaleModal = false;
        $this->saleToConfirm = null;
    }
    
    public function confirmSale()
    {
        if (!$this->saleToConfirm || $this->saleToConfirm->seller_id != Auth::id()) {
            session()->flash('error', 'Unauthorized action.');
            return;
        }
        
        // Update negotiation status
        $this->saleToConfirm->status = 'completed';
        $this->saleToConfirm->save();
        
        // Update vehicle status to on_hold
        $this->saleToConfirm->vehicle->status = 'on_hold';
        $this->saleToConfirm->vehicle->save();
        
        // Send email
        $emailData = [
            'vehicle' => $this->saleToConfirm->vehicle,
            'buyer' => $this->saleToConfirm->buyer,
            'seller' => Auth::user(),
            'offeredPrice' => $this->saleToConfirm->offered_price
        ];
        
        try {
            Mail::send('emails.sale-completed', $emailData, function($message) {
                $message->to('savannahills25@gmail.com')
                        ->subject('Vehicle Sale Completed - Kibo Platform');
            });
        } catch (\Exception $e) {
            // Log error but don't fail the transaction
            \Log::error('Failed to send sale completion email: ' . $e->getMessage());
        }
        
        session()->flash('success', 'Sale confirmed! An email notification has been sent.');
        $this->closeConfirmSaleModal();
        $this->closeChat();
        $this->showNegotiations = false;
    }
}
