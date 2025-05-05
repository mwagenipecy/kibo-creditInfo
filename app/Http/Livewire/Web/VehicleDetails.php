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
use Livewire\WithPagination;
use Livewire\WithFileUploads;

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

    public $monthly_payment=[];
    
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|regex:/^[0-9+\s\-()]{7,15}$/',
        'message' => 'required|min:10',
        'consent' => 'accepted',
    ];
    
    public function mount($id)
    {
      //  $this->vehicle = Vehicle::with(['dealer', 'make', 'model', 'bodyType', 'fuelType', 'transmission'])->findOrFail($id);
        
        $this->vehicle = Vehicle::with(['dealer', 'make', 'model', 'bodyType', 'fuelType', 'transmission'])->findOrFail($id);

        $this->lenders=Lender::get();
        // Pre-fill message
        $this->message = "Hi, I'm interested in the " . $this->vehicle->year . " " . optional($this->vehicle->make)->name . " " . optional($this->vehicle->model)->name . " you have listed. Please contact me with more information.";
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
    
    public function render()
    {
        // Get similar vehicles (same make/model or category but different vehicles)
        $similarVehicles = Vehicle::where(function($query) {
                $query->where('make_id', $this->vehicle->make_id)
                    ->orWhere('body_type_id', $this->vehicle->body_type_id);
            })
            ->where('id', '!=', $this->vehicle->id)
            ->take(4)
            ->get();
        
        return view('livewire.web.vehicle-details', [
            'similarVehicles' => $similarVehicles,
        ]);
    }




}
