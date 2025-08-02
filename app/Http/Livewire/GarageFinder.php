<?php

namespace App\Http\Livewire;

use App\Models\Garage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class GarageFinder extends Component
{
    public $userLocation = '';

    public $userLatitude = null;

    public $userLongitude = null;

    public $searchRadius = 10;

    public $selectedServices = [];

    public $sortBy = 'distance';

    public $garages = [];

    public $selectedGarage = null;

    public $isLoading = false;

    public $searchPerformed = false;

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
    ];

    public function mount()
    {
        $this->garages = [];
        $this->loadNearbyGarages();
    }

    public function updatedUserLocation()
    {
        if (strlen($this->userLocation) >= 3) {
            $this->geocodeUserLocation();
        }
    }

    public function updatedSearchRadius()
    {
        $this->loadNearbyGarages();
    }

    public function updatedSelectedServices()
    {
        $this->loadNearbyGarages();
    }

    public function updatedSortBy()
    {
        $this->loadNearbyGarages();
    }

    public function geocodeUserLocation()
    {
        if (empty($this->userLocation)) {
            return;
        }

        $this->isLoading = true;

        try {
            // Using Google Geocoding API
            $googleApiKey = config('services.google.maps_api_key');

            if ($googleApiKey) {
                $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                    'address' => $this->userLocation,
                    'key' => $googleApiKey,
                ]);

                if ($response->successful() && $response->json()['status'] === 'OK') {
                    $result = $response->json()['results'][0];
                    $this->userLatitude = $result['geometry']['location']['lat'];
                    $this->userLongitude = $result['geometry']['location']['lng'];

                    // Update location display with formatted address
                    $this->userLocation = $result['formatted_address'];

                    $this->loadNearbyGarages();
                    $this->showNotification('success', 'Location found! Showing nearby garages.');
                }
            } else {
                // Fallback to OpenStreetMap
                $response = Http::get('https://nominatim.openstreetmap.org/search', [
                    'q' => $this->userLocation,
                    'format' => 'json',
                    'limit' => 1,
                ]);

                if ($response->successful() && count($response->json()) > 0) {
                    $result = $response->json()[0];
                    $this->userLatitude = $result['lat'];
                    $this->userLongitude = $result['lon'];

                    $this->loadNearbyGarages();
                    $this->showNotification('success', 'Location found! Showing nearby garages.');
                }
            }
        } catch (\Exception $e) {
            Log::error('Geocoding error: '.$e->getMessage());
            $this->showNotification('error', 'Could not find location. Please try again.');
        } finally {
            $this->isLoading = false;
        }
    }

    public function useCurrentLocation()
    {
        $this->isLoading = true;
        $this->dispatchBrowserEvent('getCurrentLocation');
    }

    public function setCurrentLocation($latitude, $longitude)
    {
        $this->userLatitude = $latitude;
        $this->userLongitude = $longitude;
        $this->isLoading = false;

        // Reverse geocode to get address
        $this->reverseGeocode($latitude, $longitude);

        $this->loadNearbyGarages();
        $this->showNotification('success', 'Using your current location!');
    }

    private function reverseGeocode($lat, $lng)
    {
        try {
            $googleApiKey = config('services.google.maps_api_key');

            if ($googleApiKey) {
                $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                    'latlng' => "$lat,$lng",
                    'key' => $googleApiKey,
                ]);

                if ($response->successful() && $response->json()['status'] === 'OK') {
                    $result = $response->json()['results'][0];
                    $this->userLocation = $result['formatted_address'];
                }
            }
        } catch (\Exception $e) {
            Log::error('Reverse geocoding error: '.$e->getMessage());
        }
    }

    public function loadNearbyGarages()
    {
        $this->isLoading = true;

        try {
            $query = Garage::where('is_active', true);

            if ($this->userLatitude && $this->userLongitude) {
                // Add distance calculation
                $query = $query->selectRaw('
                    *,
                    (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
                ', [$this->userLatitude, $this->userLongitude, $this->userLatitude])
                    ->having('distance', '<=', $this->searchRadius);
            }

            if (! empty($this->selectedServices)) {
                $query = $query->where(function ($q) {
                    foreach ($this->selectedServices as $service) {
                        $q->orWhereJsonContains('services', $service);
                    }
                });
            }

            // Apply sorting
            switch ($this->sortBy) {
                case 'distance':
                    if ($this->userLatitude && $this->userLongitude) {
                        $query = $query->orderBy('distance', 'asc');
                    }
                    break;
                case 'rating':
                    $query = $query->orderBy('rating', 'desc');
                    break;
                case 'name':
                    $query = $query->orderBy('name', 'asc');
                    break;
            }

            $this->garages = $query->get()->toArray();
            $this->searchPerformed = true;

        } catch (\Exception $e) {
            Log::error('Error loading garages: '.$e->getMessage());
            $this->showNotification('error', 'Error loading garages. Please try again.');
            $this->garages = [];
        } finally {
            $this->isLoading = false;
        }
    }

    public function showGarageDetails($garageId)
    {
        $this->selectedGarage = Garage::findOrFail($garageId);
    }

    public function closeGarageDetails()
    {
        $this->selectedGarage = null;
    }

    public function getDirections($garageId)
    {
        $garage = Garage::findOrFail($garageId);

        // Use Google Maps with coordinates (no API key needed for this URL format)
        $url = "https://www.google.com/maps/place/@{$garage->latitude},{$garage->longitude}";

        return redirect()->to($url);
    }

    public function clearFilters()
    {
        $this->selectedServices = [];
        $this->searchRadius = 10;
        $this->sortBy = 'distance';
        $this->loadNearbyGarages();
        $this->showNotification('info', 'Filters cleared!');
    }

    private function showNotification($type, $message)
    {
        $this->dispatchBrowserEvent('notify', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function render()
    {
        return view('livewire.garage-finder');
    }
}
