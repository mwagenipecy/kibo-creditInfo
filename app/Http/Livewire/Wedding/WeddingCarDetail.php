<?php

namespace App\Http\Livewire\Wedding;
use Livewire\Component;
use App\Models\Vehicle;
class WeddingCarDetail extends Component
{
    public $vehicle;
    public $selectedPackage = 'basic';
    public $rentalDuration = 1;
    public $eventDate;
    public $eventTime = '09:00';
    public $pickupLocation = '';
    public $specialRequests = '';
    public $customerName = '';
    public $customerPhone = '';
    public $customerEmail = '';
    
    // Package options
    public $packages = [
        'basic' => [
            'name' => 'Basic Package',
            'description' => 'Car rental with basic decoration',
            'includes' => ['Professional chauffeur', 'Basic floral decoration', 'Ribbon decoration', 'Fuel included'],
            'multiplier' => 1.0
        ],
        'premium' => [
            'name' => 'Premium Package',
            'description' => 'Enhanced package with premium decorations',
            'includes' => ['Professional chauffeur in formal wear', 'Premium floral arrangement', 'Balloon decoration', 'Red carpet service', 'Fuel included', 'Photography props'],
            'multiplier' => 1.5
        ],
        'luxury' => [
            'name' => 'Luxury Package',
            'description' => 'Complete luxury wedding car experience',
            'includes' => ['Professional chauffeur in tuxedo', 'Luxury floral arrangement', 'Full car decoration', 'Red carpet & umbrella service', 'Fuel included', 'Photography session', 'Refreshments', 'Music system'],
            'multiplier' => 2.0
        ]
    ];

    public function mount($vehicleId)
    {
        $this->vehicle = Vehicle::where('id', $vehicleId)
            ->where('is_wedding_car', 1)
            ->where('status', 'active')
            ->with(['make', 'model', 'dealer', 'bodyType', 'fuelType', 'transmission', 'images'])
            ->firstOrFail();
    }

    public function calculateTotal()
    {
        $basePrice = $this->vehicle->rent_price;
        $packageMultiplier = $this->packages[$this->selectedPackage]['multiplier'];
        $duration = max(1, $this->rentalDuration);
        
        return $basePrice * $packageMultiplier * $duration;
    }

    public function submitBooking()
    {
        $this->validate([
            'eventDate' => 'required|date|after:today',
            'eventTime' => 'required',
            'pickupLocation' => 'required|min:3',
            'customerName' => 'required|min:2',
            'customerPhone' => 'required|min:10',
            'customerEmail' => 'required|email'
        ]);

        // Here you would typically save the booking to database
        // For now, we'll just show a success message
        session()->flash('booking_success', 'Your wedding car booking request has been submitted successfully! The dealer will contact you soon.');
        
        // Optionally redirect or reset form
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->customerName = '';
        $this->customerPhone = '';
        $this->customerEmail = '';
        $this->eventDate = '';
        $this->pickupLocation = '';
        $this->specialRequests = '';
    }

    public function render()
    {


        $similarCars = Vehicle::where('is_wedding_car', 1)
            ->where('status', 'active')
            ->where('id', '!=', $this->vehicle->id)
            ->where(function($query) {
                $query->where('make_id', $this->vehicle->make_id)
                      ->orWhere('body_type_id', $this->vehicle->body_type_id);
            })
            ->with(['make', 'model', 'dealer'])
            ->limit(3)
            ->get();

        return view('livewire.wedding.wedding-car-detail', [
            'similarCars' => $similarCars,
            'totalPrice' => $this->calculateTotal()
        ]);
    }
}