<?php

namespace App\Http\Livewire;

use App\Models\Garage;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class GarageFinder extends Component
{
    public $selectedServices = [];
    public $sortBy = 'rating';
    public $garages = [];
    public $selectedGarage = null;
    public $isLoading = false;
    public $searchPerformed = false;
    public $showServiceDropdown = false;
    public $serviceSearch = '';

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

    public function mount()
    {
        $this->garages = [];
        $this->loadGarages();
    }

    public function updatedSelectedServices()
    {
        $this->loadGarages();
    }

    public function updatedSortBy()
    {
        $this->loadGarages();
    }

    public function updatedServiceSearch()
    {
        // This will automatically update the filtered services
    }

    public function toggleServiceDropdown()
    {
        $this->showServiceDropdown = !$this->showServiceDropdown;
    }

    public function getFilteredServicesProperty()
    {
        if (empty($this->serviceSearch)) {
            return $this->availableServices;
        }

        return collect($this->availableServices)
            ->filter(function ($service) {
                return str_contains(strtolower($service), strtolower($this->serviceSearch));
            })
            ->values()
            ->toArray();
    }

    public function loadGarages()
    {
        $this->isLoading = true;
        
        try {
            $query = Garage::where('is_active', true);

            if (!empty($this->selectedServices)) {
                $query = $query->where(function ($q) {
                    foreach ($this->selectedServices as $service) {
                        $q->orWhereJsonContains('services', $service);
                    }
                });
            }

            // Apply sorting
            switch ($this->sortBy) {
                case 'rating':
                    $query = $query->orderBy('rating', 'desc');
                    break;
                case 'featured':
                    $query = $query->orderBy('featured', 'desc')->orderBy('rating', 'desc');
                    break;
                case 'name':
                    $query = $query->orderBy('name', 'asc');
                    break;
                default:
                    $query = $query->orderBy('rating', 'desc');
            }

            $this->garages = $query->get()->toArray();
            $this->searchPerformed = true;
            
        } catch (\Exception $e) {
            Log::error('Error loading garages: ' . $e->getMessage());
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
        
        // Build the Google Maps URL with multiple options for better accuracy
        $baseUrl = "https://www.google.com/maps/dir/";
        
        // If we have coordinates, use them for precise location
        if ($garage->latitude && $garage->longitude) {
            $destination = "{$garage->latitude},{$garage->longitude}";
        } else {
            // Fallback to address if coordinates are not available
            $destination = urlencode($garage->full_address);
        }
        
        // Add garage name for better context
        $garageName = urlencode($garage->name);
        $url = "{$baseUrl}{$destination}/{$garageName}";
        
        // Open in new tab/window
        $this->dispatchBrowserEvent('openDirections', [
            'url' => $url,
            'garageName' => $garage->name
        ]);
        
        $this->showNotification('info', "Opening directions to {$garage->name} in Google Maps...");
    }

    public function clearFilters()
    {
        $this->selectedServices = [];
        $this->sortBy = 'rating';
        $this->serviceSearch = '';
        $this->loadGarages();
        $this->showNotification('info', 'Filters cleared!');
    }

    public function removeService($service)
    {
        $this->selectedServices = array_filter($this->selectedServices, function($item) use ($service) {
            return $item !== $service;
        });
        $this->loadGarages();
    }

    private function showNotification($type, $message)
    {
        $this->dispatchBrowserEvent('notify', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.garage-finder');
    }
}