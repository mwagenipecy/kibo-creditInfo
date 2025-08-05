<?php

// app/Http/Livewire/Admin/ShopOnboarding.php
namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ShopOnboarding extends Component
{
    public $name = '';
    public $owner_name = '';
    public $phone_number = '';
    public $email = '';
    public $shop_type = 'spare_parts';
    public $latitude = '';
    public $longitude = '';
    public $address = '';
    
    // Supervisor details
    public $supervisor_name = '';
    public $supervisor_email = '';
    public $supervisor_phone = '';
    
    public $locationCaptured = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'shop_type' => 'required|in:spare_parts,mechanic,accessories,service',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
        'address' => 'required|string',
        'supervisor_name' => 'required|string|max:255',
        'supervisor_email' => 'required|email|unique:users,email',
        'supervisor_phone' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->shop_type = 'spare_parts';
    }

    public function getCurrentLocation()
    {
        $this->dispatchBrowserEvent('get-current-location');
    }

    public function updateLocation($latitude, $longitude, $address = '')
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->address = $address ?: $this->address;
        $this->locationCaptured = true;
        
        session()->flash('location_success', 'Location captured successfully!');
    }

    public function createShop()
    {
        $this->validate();

        try {
            // Create the shop
            $shop = Shop::create([
                'name' => $this->name,
                'owner_name' => $this->owner_name,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'shop_type' => $this->shop_type,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'address' => $this->address,
            ]);

            // Create the supervisor user
            $password = Str::random(8); // Generate random password
            $supervisor = User::create([
                'name' => $this->supervisor_name,
                'email' => $this->supervisor_email,
                'phone' => $this->supervisor_phone,
                'password' => Hash::make($password),
                'shop_id' => $shop->id,
                'role' => 'shop_supervisor',
            ]);

            // Send credentials via email or SMS (implement as needed)
            // Mail::to($supervisor->email)->send(new SupervisorCredentials($supervisor, $password));

            session()->flash('success', "Shop created successfully! Supervisor credentials: Email: {$this->supervisor_email}, Password: {$password}");
            
            // Reset form
            $this->reset();
            $this->locationCaptured = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating shop: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.shop-onboarding');
    }
}

// Route for this component (add to web.php)
// Route::get('/admin/shops/create', App\Http\Livewire\Admin\ShopOnboarding::class)
//     ->middleware(['auth', 'admin'])->name('admin.shops.create');