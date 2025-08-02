<?php

namespace App\Http\Livewire\Web;

use App\Models\CarDealer;
use App\Models\Make;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Livewire\Component;

class HomePage extends Component
{
    public $selectedMake = '';

    public $selectedModel = '';

    public $priceRange = '';

    public function mount()
    {
        // Initialize any required data
    }

    public function searchVehicles()
<<<<<<< HEAD
    {
        // Update the featured vehicles based on search criteria
        $query = Vehicle::with('dealer')->where('is_featured', true);

        // Apply search filters
        if ($this->selectedMake) {
            $query->where('make_id', $this->selectedMake);
=======
{
    // Update the featured vehicles based on search criteria
    $query = Vehicle::with('dealer')->where('is_featured', true)
             ->where('status', 'active');
    
    // Apply search filters
    if ($this->selectedMake) {
        $query->where('make_id', $this->selectedMake);
    }
    
    if ($this->selectedModel) {
        $query->where('model_id', $this->selectedModel);
    }
    
    if ($this->priceRange) {
        // Assuming priceRange is something like "10000-20000"
        $prices = explode('-', $this->priceRange);
        if (count($prices) == 2) {
            $query->whereBetween('price', [$prices[0], $prices[1]]);
>>>>>>> 23326fd4fc3d0d76819f118df0b06962ef0cfb6b
        }

        if ($this->selectedModel) {
            $query->where('model_id', $this->selectedModel);
        }

        if ($this->priceRange) {
            // Assuming priceRange is something like "10000-20000"
            $prices = explode('-', $this->priceRange);
            if (count($prices) == 2) {
                $query->whereBetween('price', [$prices[0], $prices[1]]);
            }
        }

        // Update the featured vehicles property to be emitted to the view
        $this->featuredVehicles = $query->latest()->take(6)->get();

        // Emit an event to notify other components if needed
        $this->emit('featuredVehiclesUpdated');
    }

<<<<<<< HEAD
    public function render()
    {
        $makes = Make::withCount('vehicles')->orderBy('name')->get();
        $models = $this->selectedMake ? VehicleModel::where('make_id', $this->selectedMake)->withCount('vehicles')->orderBy('name')->get() : [];

        // Only fetch featured vehicles if not already set by search
        if (! isset($this->featuredVehicles)) {
            $this->featuredVehicles = Vehicle::with('dealer')->where('is_featured', true)->latest()->take(12)->get();
        }

        $topDealers = CarDealer::withCount(['vehicles', 'reviews'])->orderByDesc('reviews_count')->take(8)->get();

        return view('livewire.web.home-page', [
            'makes' => $makes,
            'models' => $models,
            'featuredVehicles' => $this->featuredVehicles,
            'topDealers' => $topDealers,
        ]);
=======
public function render()
{
    $makes = Make::withCount('vehicles')->orderBy('name')->get();
    $models = $this->selectedMake ? VehicleModel::where('make_id', $this->selectedMake)
    ->where('status', 'active')
    ->withCount('vehicles')->orderBy('name')->get() : [];
    
    // Only fetch featured vehicles if not already set by search
    if (!isset($this->featuredVehicles)) {
        $this->featuredVehicles = Vehicle::with('dealer')->where('is_featured', true)
        ->where('status', 'active')
        ->latest()->take(12)->get();
>>>>>>> 23326fd4fc3d0d76819f118df0b06962ef0cfb6b
    }
}
