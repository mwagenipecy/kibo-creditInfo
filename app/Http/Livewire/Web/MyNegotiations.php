<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\VehicleNegotiation;
use App\Models\NegotiationMessage;
use Illuminate\Support\Facades\Auth;

class MyNegotiations extends Component
{
    public $showChatModal = false;
    public $selectedNegotiation = null;
    public $chatMessage = '';
    
    public function render()
    {
        $userId = Auth::id();
        
        // Get all negotiations where the current user is the buyer
        $myNegotiations = VehicleNegotiation::where('buyer_id', $userId)
            ->with(['vehicle', 'seller', 'messages'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('livewire.web.my-negotiations', [
            'myNegotiations' => $myNegotiations
        ]);
    }
    
    public function openChat($negotiationId)
    {
        $this->selectedNegotiation = VehicleNegotiation::with(['seller', 'vehicle', 'messages.sender'])
            ->find($negotiationId);
        $this->showChatModal = true;
    }
    
    public function closeChat()
    {
        $this->showChatModal = false;
        $this->selectedNegotiation = null;
        $this->chatMessage = '';
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
        $this->dispatchBrowserEvent('scrollToBottom', ['element' => 'buyer-chat-messages']);
    }
}
