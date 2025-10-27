<?php

namespace App\Http\Livewire\Web;

use App\Models\Lender;
use Livewire\Component;
use App\Models\CarDealer;
use App\Models\VehicleModel;
use App\Models\Vehicle;
use App\Models\Dealer;
use App\Models\Make;
use App\Models\Model;
use App\Models\BodyType;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleNegotiation;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\LenderFinancingService;
use Illuminate\Support\Facades\Auth;

class VehicleDetails extends Component
{

    use WithFileUploads;
    
    public $vehicle;
    
    // Inquiry form fields
    public $name;
    public $email;
    public $phone;
    public $message;
    public $consent = false;

    public $lenders=[];

    public $updateVehicleId;

    public $simiralVehicles=[];
    public $monthly_payment=[];
    
    // Negotiation properties
    public $showNegotiationModal = false;
    public $offeredPrice;
    public $isVehicleOwner = false;
    public $showBuyerNegotiationModal = false;
    public $buyerNegotiation = null;
    
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|regex:/^[0-9+\s\-()]{7,15}$/',
        'message' => 'required|min:10',
        'consent' => 'accepted',
        'offeredPrice' => 'nullable|numeric|min:1',
    ];
    
    public function mount($id)
    {
        $this->updateVehicleId = $id;
        
        // Try to find the vehicle with any status
        $vehicle = Vehicle::with(['dealer', 'make', 'model', 'bodyType', 'fuelType', 'transmission', 'images', 'user'])
            ->find($id);
        
        // If not found, throw a model not found exception
        if (!$vehicle) {
            abort(404, 'Vehicle not found');
        }
        
        $this->vehicle = $vehicle;

       // $this->lenders=Lender::get();

        $lenderService = new LenderFinancingService();
       // $this->eligibleLenders = $lenderService->getLendersForVehicle($id);

       $this->lenders = $lenderService->getLendersForVehicle($id);


               $this->simiralVehicles=$this->getSimiralVehiclesProperty();
        

       $lenderService = new LenderFinancingService();
       $this->eligibleLenders = $lenderService->getLendersForVehicle($id);

       
        // Pre-fill message
        $this->message = "Hi, I'm interested in the " . $this->vehicle->year . " " . optional($this->vehicle->make)->name . " " . optional($this->vehicle->model)->name . " you have listed. Please contact me with more information.";
        
        // Check if logged in user owns this vehicle
        if (Auth::check()) {
            $this->isVehicleOwner = $this->vehicle->user_id == Auth::id();
        }
    }


    public function getSimiralVehiclesProperty()
    {
        // Get similar vehicles (same make/model or category but different vehicles)
        return Vehicle::where(function($query) {
                $query->where('make_id', $this->vehicle->make_id)
                    ->orWhere('body_type_id', $this->vehicle->body_type_id);
            })
            ->where('id', '!=', $this->vehicle->id)
            ->where('status', 'active')
            ->take(4)
            ->get();
    }


    
    public function submitInquiry()
    {
        $this->validate();
        
        // Process the inquiry
        // Here you would typically:
        // 1. Save the inquiry to the database
        // 2. Send an email notification to the dealer
        // 3. Maybe send a confirmation email to the customer
        
        // For now, just show a success message
        session()->flash('message', 'Your inquiry has been sent to the dealer successfully. They will contact you shortly.');
        
        // Reset the form fields
        $this->reset(['name', 'email', 'phone', 'consent']);
        $this->message = "Hi, I'm interested in the " . $this->vehicle->year . " " . optional($this->vehicle->make)->name . " " . optional($this->vehicle->model)->name . " you have listed. Please contact me with more information.";
    }
    
    public function scheduleTestDrive()
    {
        // Logic to schedule a test drive
        session()->flash('message', 'Test drive request sent. The dealer will contact you to confirm the appointment.');
    }
    
    public function requestVideo()
    {
        // Logic to request a video of the vehicle
        session()->flash('message', 'Video request sent. The dealer will prepare a video walkthrough for you.');
    }
    
    public function calculateFinance()
    {
        // Redirect to finance calculator with this vehicle's details pre-filled
        return redirect()->route('finance.calculator', ['vehicle_id' => $this->vehicle->id]);
    }
    
    public function shareVehicle()
    {
        // Logic to share the vehicle (could be a modal with sharing options)
        $this->emit('openShareModal', $this->vehicle->id);
    }
    
    public function openNegotiationModal()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login to negotiate the price.');
            return redirect()->route('login');
        }
        
        if ($this->isVehicleOwner) {
            session()->flash('error', 'You cannot negotiate on your own vehicle.');
            return;
        }
        
        // Check if there's already a negotiation
        $existingNegotiation = \App\Models\VehicleNegotiation::where('vehicle_id', $this->vehicle->id)
            ->where('buyer_id', Auth::id())
            ->with(['messages'])
            ->first();
        
        if ($existingNegotiation) {
            // Show the chat interface with existing negotiation
            $this->buyerNegotiation = $existingNegotiation;
            $this->showBuyerNegotiationModal = true;
        } else {
            // Show the initial offer form
            $this->showNegotiationModal = true;
            // Set a default offer (e.g., 10% less than listed price)
            $this->offeredPrice = $this->vehicle->price * 0.9;
        }
    }
    
    public function submitNegotiation()
    {
        try {
            if (!Auth::check() || $this->isVehicleOwner) {
                session()->flash('error', 'Unauthorized action.');
                return;
            }
            
            // Validate the offer
            if (!isset($this->offeredPrice) || $this->offeredPrice <= 0) {
                session()->flash('error', 'Please enter a valid offer amount.');
                return;
            }
            
            // Get the seller ID from the vehicle
            $vehicle = Vehicle::with('user')->find($this->vehicle->id);
            
            if (!$vehicle) {
                session()->flash('error', 'Vehicle not found.');
                return;
            }
            
            // Get the seller ID from the vehicle
            $sellerId = $vehicle->user_id;
            
            // If there's no user_id, this might be a dealer vehicle
            if (!$sellerId) {
                session()->flash('error', 'This vehicle is listed by a dealer. Please contact the dealer directly.');
                return;
            }
            
            // Verify that the seller user exists
            $sellerExists = User::where('id', $sellerId)->exists();
            if (!$sellerExists) {
                session()->flash('error', 'Unable to find seller information for this vehicle.');
                return;
            }
            
            // Check if there's already a negotiation for this buyer and vehicle
            $existingNegotiation = \App\Models\VehicleNegotiation::where('vehicle_id', $this->vehicle->id)
                ->where('buyer_id', Auth::id())
                ->first();
            
            if ($existingNegotiation) {
                // Add a new message to the existing negotiation
                \App\Models\NegotiationMessage::create([
                    'negotiation_id' => $existingNegotiation->id,
                    'sender_id' => Auth::id(),
                    'message' => 'Offer: TSh ' . number_format($this->offeredPrice)
                ]);
                
                // Update the status if it was rejected
                if ($existingNegotiation->status == 'rejected') {
                    $existingNegotiation->status = 'pending';
                    $existingNegotiation->offered_price = $this->offeredPrice;
                    $existingNegotiation->save();
                }
            } else {
                // Create new negotiation record
                $negotiation = \App\Models\VehicleNegotiation::create([
                    'vehicle_id' => $this->vehicle->id,
                    'buyer_id' => Auth::id(),
                    'seller_id' => $sellerId,
                    'offered_price' => $this->offeredPrice,
                    'status' => 'pending'
                ]);
                
                // Add the initial offer as a message
                \App\Models\NegotiationMessage::create([
                    'negotiation_id' => $negotiation->id,
                    'sender_id' => Auth::id(),
                    'message' => 'Initial Offer: TSh ' . number_format($this->offeredPrice)
                ]);
            }
            
            // Close the initial offer modal and open the chat interface
            $this->showNegotiationModal = false;
            
            // Load the negotiation with messages
            $negotiationId = isset($negotiation) ? $negotiation->id : $existingNegotiation->id;
            $this->buyerNegotiation = \App\Models\VehicleNegotiation::where('id', $negotiationId)
                ->with(['messages.sender'])
                ->first();
            
            $this->showBuyerNegotiationModal = true;
            $this->offeredPrice = null;
            session()->flash('success', 'Your price offer has been sent to the seller.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
            \Log::error('Negotiation submission error: ' . $e->getMessage());
        }
    }
    
    public function closeNegotiationModal()
    {
        $this->showNegotiationModal = false;
        $this->offeredPrice = null;
    }
    
    public function viewBuyerNegotiation()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login to view your negotiations.');
            return;
        }
        
        // Get the buyer's negotiation for this vehicle
        $this->buyerNegotiation = \App\Models\VehicleNegotiation::where('vehicle_id', $this->vehicle->id)
            ->where('buyer_id', Auth::id())
            ->with(['vehicle', 'seller', 'messages.sender'])
            ->first();
        
        if ($this->buyerNegotiation) {
            $this->showBuyerNegotiationModal = true;
        } else {
            session()->flash('info', 'You have not made any offers on this vehicle yet.');
        }
    }
    
    public function closeBuyerNegotiationModal()
    {
        $this->showBuyerNegotiationModal = false;
        $this->buyerNegotiation = null;
        $this->offeredPrice = null;
    }
    
    public function sendNewOffer()
    {
        if (!$this->buyerNegotiation || !$this->offeredPrice || $this->offeredPrice <= 0) {
            session()->flash('error', 'Please enter a valid offer amount.');
            return;
        }
        
        // Add the new offer as a message
        \App\Models\NegotiationMessage::create([
            'negotiation_id' => $this->buyerNegotiation->id,
            'sender_id' => Auth::id(),
            'message' => 'New Offer: TSh ' . number_format($this->offeredPrice)
        ]);
        
        // Update the negotiation's offered price
        $this->buyerNegotiation->offered_price = $this->offeredPrice;
        $this->buyerNegotiation->save();
        
        // Refresh the negotiation
        $this->buyerNegotiation = \App\Models\VehicleNegotiation::where('id', $this->buyerNegotiation->id)
            ->with(['messages.sender'])
            ->first();
        
        $this->offeredPrice = null;
        session()->flash('success', 'Your new offer has been sent!');
    }
    
    public function sendKeyword($keyword)
    {
        if (!$this->buyerNegotiation) {
            return;
        }
        
        // Send the keyword as a message
        \App\Models\NegotiationMessage::create([
            'negotiation_id' => $this->buyerNegotiation->id,
            'sender_id' => Auth::id(),
            'message' => $keyword
        ]);
        
        // Refresh the negotiation
        $this->buyerNegotiation = \App\Models\VehicleNegotiation::where('id', $this->buyerNegotiation->id)
            ->with(['messages.sender'])
            ->first();
        
        session()->flash('success', 'Message sent!');
    }
    
    public function render()
    {
        // Get similar vehicles (same make/model or category but different vehicles)
        $similarVehicles = Vehicle::where(function($query) {
                $query->where('make_id', $this->vehicle->make_id)
                    ->orWhere('body_type_id', $this->vehicle->body_type_id);
            })
            ->where('id', '!=', $this->vehicle->id)
            ->where('status', 'active')
            ->take(4)
            ->get();
        
        return view('livewire.web.vehicle-details', [
            'similarVehicles' => $similarVehicles,
        ]);
    }




}
