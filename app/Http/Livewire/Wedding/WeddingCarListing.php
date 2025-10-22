<?php

namespace App\Http\Livewire\Wedding;

use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Make;
use App\Models\Model;

class WeddingCarListing extends Component
{
    public $selectedMake = '';
    public $selectedModel = '';
    public $priceRange = '';
    public $location = '';
    public $search = '';
    
    // Name-based properties for searchable selects
    public $selectedMakeName = '';
    public $selectedModelName = '';
    public $priceRangeName = '';

    public function searchCars()
    {
        // This method will be called when search button is clicked
        // The filtering will happen in the render method
    }
    
    public function updatedSelectedMakeName()
    {
        $make = Make::where('name', $this->selectedMakeName)->first();
        $this->selectedMake = $make ? $make->id : '';
        
        $this->selectedModel = '';
        $this->selectedModelName = '';
    }
    
    public function updatedSelectedModelName()
    {
        $model = \App\Models\VehicleModel::where('name', $this->selectedModelName)->first();
        $this->selectedModel = $model ? $model->id : '';
    }
    
    public function updatedPriceRangeName()
    {
        $priceRanges = [
            'Under 200K TZS' => '0-200000',
            '200K - 500K TZS' => '200000-500000',
            '500K - 1M TZS' => '500000-1000000',
            'Over 1M TZS' => '1000000-999999999',
        ];
        $this->priceRange = $priceRanges[$this->priceRangeName] ?? '';
    }

    public function render()
    {
        $query = Vehicle::query()
            ->where('is_wedding_car', 1)
            ->where('status', 'active')
            ->with(['make', 'model', 'dealer', 'bodyType', 'fuelType', 'transmission']);

        // Apply filters
        if ($this->selectedMake) {
            $query->where('make_id', $this->selectedMake);
        }

        if ($this->selectedModel) {
            $query->where('model_id', $this->selectedModel);
        }

        if ($this->priceRange) {
            $range = explode('-', $this->priceRange);
            if (count($range) == 2) {
                $query->whereBetween('rent_price', [(int)$range[0], (int)$range[1]]);
            }
        }

        if ($this->location) {
            $query->where('location', 'like', '%' . $this->location . '%');
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->whereHas('make', function($make) {
                    $make->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('model', function($model) {
                    $model->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('color', 'like', '%' . $this->search . '%')
                  ->orWhere('year', 'like', '%' . $this->search . '%');
            });
        }

        $weddingCars = $query->orderBy('is_featured', 'desc')
                           ->orderBy('created_at', 'desc')
                           ->paginate(12);

        $makes = Make::orderBy('name')->get();
        $models = $this->selectedMake 
            ? \App\Models\VehicleModel::where('make_id', $this->selectedMake)->orderBy('name')->get()
            : \App\Models\VehicleModel::orderBy('name')->get();

        return view('livewire.wedding.wedding-car-listing', compact('weddingCars', 'makes', 'models'));
    }
}