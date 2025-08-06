<?php

namespace App\Http\Livewire\Admin;

use App\Models\Garage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GarageManager extends Component
{
    use WithFileUploads, WithPagination;

    public $showModal = false;
    public $editingGarage = null;
    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $isGeocoding = false;

    // Form properties
    public $name = '';
    public $description = '';
    public $address = '';
    public $city = '';
    public $state = '';
    public $zip_code = '';
    public $country = 'USA';
    public $latitude = '';
    public $longitude = '';
    public $phone = '';
    public $email = '';
    public $services = [];
    public $rating = 0;
    public $opening_hours = '';
    public $website = '';
    public $image = null;
    public $is_active = true;
    public $featured = false;

    public $availableServices = [
        'Oil Change',
        'Brake Service',
        'Tire Service',
        'Engine Repair',
        'Transmission Service',
        'Air Conditioning',
        'Battery Service',
        'Alignment',
        'Inspection',
        'Towing',
        'OBD diagnostics',
        'Suspension Repair',
        'Exhaust System',
        'Fuel System',
        'Electrical Repair',
        'Cooling System',
        'Detailing',
        'Windshield Replacement',
        'Bodywork',
        'Paintless Dent Repair',
        'Hybrid/Electric Vehicle Service',
        'Performance Upgrades',
        'Custom Modifications',
        'Fleet Services',
        'Roadside Assistance',
        'Pre-purchase Inspection',
        'Warranty Repairs',
        'Emissions Testing',
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:50',
        'zip_code' => 'required|string|max:10',
        'country' => 'required|string|max:100',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'services' => 'nullable|array',
        'rating' => 'nullable|numeric|min:0|max:5',
        'opening_hours' => 'nullable|string|max:255',
        'website' => 'nullable|url|max:255',
        'image' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
        'featured' => 'boolean'
    ];

    public function mount()
    {
        // Debug: Check if we have any garages
        $garageCount = Garage::count();
        Log::info("GarageManager mounted. Total garages: " . $garageCount);
        
        // If no garages exist, create some sample data
        if ($garageCount == 0) {
            $this->createSampleGarages();
        }
    }

    private function createSampleGarages()
    {
        $sampleGarages = [
            [
                'name' => 'AutoCare Express',
                'description' => 'Full-service automotive repair and maintenance with over 20 years of experience.',
                'address' => '123 Main Street',
                'city' => 'New York',
                'state' => 'NY',
                'zip_code' => '10001',
                'country' => 'USA',
                'latitude' => 40.7589,
                'longitude' => -73.9851,
                'phone' => '(555) 123-4567',
                'email' => 'info@autocareexpress.com',
                'website' => 'https://autocareexpress.com',
                'opening_hours' => 'Mon-Fri: 8AM-6PM, Sat: 8AM-4PM',
                'services' => ['Oil Change', 'Brake Service', 'Tire Service', 'Engine Repair', 'Inspection'],
                'rating' => 4.5,
                'is_active' => true,
                'featured' => true,
            ],
            [
                'name' => 'Quick Fix Garage',
                'description' => 'Fast and reliable automotive services for busy professionals.',
                'address' => '456 Broadway',
                'city' => 'New York',
                'state' => 'NY',
                'zip_code' => '10013',
                'country' => 'USA',
                'latitude' => 40.7205,
                'longitude' => -74.0050,
                'phone' => '(555) 234-5678',
                'email' => 'service@quickfixgarage.com',
                'website' => 'https://quickfixgarage.com',
                'opening_hours' => 'Mon-Sat: 7AM-7PM, Sun: 9AM-5PM',
                'services' => ['Oil Change', 'Brake Service', 'Battery Service', 'Alignment', 'Towing'],
                'rating' => 4.2,
                'is_active' => true,
                'featured' => false,
            ]
        ];

        foreach ($sampleGarages as $garageData) {
            try {
                Garage::create($garageData);
                Log::info("Created sample garage: " . $garageData['name']);
            } catch (\Exception $e) {
                Log::error("Error creating sample garage: " . $e->getMessage());
            }
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function openModal($garageId = null)
    {
        $this->resetForm();
        
        if ($garageId) {
            try {
                $this->editingGarage = Garage::findOrFail($garageId);
                $this->fillForm($this->editingGarage);
            } catch (\Exception $e) {
                $this->showNotification('error', 'Garage not found.');
                return;
            }
        }
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function geocodeAddress()
    {
        // Validate required address fields
        if (empty($this->address) || empty($this->city) || empty($this->state)) {
            $this->showNotification('error', 'Please fill in Address, City, and State before auto-detecting coordinates.');
            return;
        }

        $this->isGeocoding = true;
        $fullAddress = trim("{$this->address}, {$this->city}, {$this->state} {$this->zip_code}, {$this->country}");
        
        Log::info("Attempting to geocode address: " . $fullAddress);
        
        try {
            // Use OpenStreetMap Nominatim (free geocoding service)
            $response = Http::timeout(10)->get('https://nominatim.openstreetmap.org/search', [
                'q' => $fullAddress,
                'format' => 'json',
                'limit' => 1,
                'countrycodes' => strtolower($this->country === 'USA' ? 'us' : $this->country),
                'addressdetails' => 1
            ]);

            if ($response->successful() && count($response->json()) > 0) {
                $result = $response->json()[0];
                $this->latitude = number_format($result['lat'], 8);
                $this->longitude = number_format($result['lon'], 8);
                
                Log::info("Nominatim coordinates found: {$this->latitude}, {$this->longitude}");
                
                $this->showNotification('success', 'Location coordinates found using OpenStreetMap!');
            } else {
                $this->showNotification('error', 'Could not find coordinates for this address. Please check the address or enter coordinates manually.');
            }
        } catch (\Exception $e) {
            Log::error('Nominatim geocoding error: ' . $e->getMessage());
            $this->showNotification('error', 'Geocoding service unavailable. Please enter coordinates manually.');
        } finally {
            $this->isGeocoding = false;
        }
    }

    public function useCurrentLocation()
    {
        $this->dispatchBrowserEvent('getCurrentLocation');
    }

    public function setCurrentLocation($latitude, $longitude)
    {
        $this->latitude = number_format($latitude, 8);
        $this->longitude = number_format($longitude, 8);
        
        Log::info("Current location set: {$this->latitude}, {$this->longitude}");
        
        // Reverse geocode to get address
        $this->reverseGeocode($latitude, $longitude);
        
        $this->showNotification('success', 'Current location coordinates set!');
    }

    private function reverseGeocode($lat, $lng)
    {
        try {
            // Use OpenStreetMap Nominatim for reverse geocoding
            $response = Http::get('https://nominatim.openstreetmap.org/reverse', [
                'lat' => $lat,
                'lon' => $lng,
                'format' => 'json',
                'addressdetails' => 1
            ]);

            if ($response->successful()) {
                $result = $response->json();
                
                // Update address fields from result
                if (isset($result['address'])) {
                    $address = $result['address'];
                    
                    // Extract address components
                    $streetNumber = $address['house_number'] ?? '';
                    $streetName = $address['road'] ?? '';
                    
                    if ($streetNumber && $streetName) {
                        $this->address = trim($streetNumber . ' ' . $streetName);
                    } elseif ($streetName) {
                        $this->address = $streetName;
                    }
                    
                    $this->city = $address['city'] ?? $address['town'] ?? $address['village'] ?? '';
                    $this->state = $address['state'] ?? '';
                    $this->zip_code = $address['postcode'] ?? '';
                    $this->country = $address['country_code'] === 'us' ? 'USA' : ($address['country'] ?? $this->country);
                }
            }
        } catch (\Exception $e) {
            Log::error('Reverse geocoding error: ' . $e->getMessage());
        }
    }

    public function validateCoordinates()
    {
        if ($this->latitude && $this->longitude) {
            if ($this->latitude < -90 || $this->latitude > 90) {
                $this->addError('latitude', 'Latitude must be between -90 and 90 degrees.');
                return false;
            }
            
            if ($this->longitude < -180 || $this->longitude > 180) {
                $this->addError('longitude', 'Longitude must be between -180 and 180 degrees.');
                return false;
            }
            
            return true;
        }
        
        return true;
    }

    public function save()
    {
        $this->validate();
        
        if (!$this->validateCoordinates()) {
            return;
        }

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'latitude' => $this->latitude ?: null,
            'longitude' => $this->longitude ?: null,
            'phone' => $this->phone,
            'email' => $this->email,
            'services' => $this->services,
            'rating' => $this->rating ?: 0,
            'opening_hours' => $this->opening_hours,
            'website' => $this->website,
            'is_active' => $this->is_active,
            'featured' => $this->featured
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('garages', 'public');
        }

        try {
            if ($this->editingGarage) {
                $this->editingGarage->update($data);
                $message = 'Garage updated successfully!';
                Log::info("Updated garage: " . $this->editingGarage->name);
            } else {
                $garage = Garage::create($data);
                $message = 'Garage created successfully!';
                Log::info("Created new garage: " . $garage->name);
            }

            $this->showNotification('success', $message);
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Error saving garage: ' . $e->getMessage(), $data);
            $this->showNotification('error', 'Error saving garage. Please try again.');
        }
    }

    public function delete($garageId)
    {
        try {
            $garage = Garage::findOrFail($garageId);
            
            if ($garage->image) {
                Storage::disk('public')->delete($garage->image);
            }
            
            $garage->delete();

            $this->showNotification('success', 'Garage deleted successfully!');
            Log::info("Deleted garage: " . $garage->name);
        } catch (\Exception $e) {
            Log::error('Error deleting garage: ' . $e->getMessage());
            $this->showNotification('error', 'Error deleting garage.');
        }
    }

    public function toggleStatus($garageId)
    {
        try {
            $garage = Garage::findOrFail($garageId);
            $garage->update(['is_active' => !$garage->is_active]);

            $this->showNotification('success', 'Garage status updated successfully!');
            Log::info("Toggled status for garage: " . $garage->name . " to " . ($garage->is_active ? 'active' : 'inactive'));
        } catch (\Exception $e) {
            Log::error('Error updating garage status: ' . $e->getMessage());
            $this->showNotification('error', 'Error updating garage status.');
        }
    }

    public function toggleFeatured($garageId)
    {
        try {
            $garage = Garage::findOrFail($garageId);
            $garage->update(['featured' => !$garage->featured]);

            $this->showNotification('success', 'Garage featured status updated!');
            Log::info("Toggled featured status for garage: " . $garage->name);
        } catch (\Exception $e) {
            Log::error('Error updating featured status: ' . $e->getMessage());
            $this->showNotification('error', 'Error updating featured status.');
        }
    }

    private function showNotification($type, $message)
    {
        $this->dispatchBrowserEvent('notify', [
            'type' => $type,
            'message' => $message
        ]);
    }

    private function resetForm()
    {
        $this->editingGarage = null;
        $this->name = '';
        $this->description = '';
        $this->address = '';
        $this->city = '';
        $this->state = '';
        $this->zip_code = '';
        $this->country = 'USA';
        $this->latitude = '';
        $this->longitude = '';
        $this->phone = '';
        $this->email = '';
        $this->services = [];
        $this->rating = 0;
        $this->opening_hours = '';
        $this->website = '';
        $this->image = null;
        $this->is_active = true;
        $this->featured = false;
        $this->isGeocoding = false;
    }

    private function fillForm(Garage $garage)
    {
        $this->name = $garage->name;
        $this->description = $garage->description;
        $this->address = $garage->address;
        $this->city = $garage->city;
        $this->state = $garage->state;
        $this->zip_code = $garage->zip_code;
        $this->country = $garage->country ?? 'USA';
        $this->latitude = $garage->latitude;
        $this->longitude = $garage->longitude;
        $this->phone = $garage->phone;
        $this->email = $garage->email;
        $this->services = $garage->services ?? [];
        $this->rating = $garage->rating;
        $this->opening_hours = $garage->opening_hours;
        $this->website = $garage->website;
        $this->is_active = $garage->is_active;
        $this->featured = $garage->featured ?? false;
    }

    public function render()
    {
        try {
            $garages = Garage::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('city', 'like', '%' . $this->search . '%')
                          ->orWhere('address', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(10);

            Log::info("Rendering garage manager with " . $garages->total() . " garages");
            
            return view('livewire.admin.garage-manager', compact('garages'));
        } catch (\Exception $e) {
            Log::error('Error in garage manager render: ' . $e->getMessage());
            
            // Return empty collection to prevent errors
            $garages = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            return view('livewire.admin.garage-manager', compact('garages'));
        }
    }

    
}