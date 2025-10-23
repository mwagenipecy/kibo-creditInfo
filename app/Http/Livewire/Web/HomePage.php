<?php

namespace App\Http\Livewire\Web;

use App\Models\CarDealer;
use App\Models\VehicleModel;
use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Dealer;
use App\Models\Make;
use App\Models\Model;
use App\Models\BodyType;
use App\Models\FuelType;
use App\Models\Transmission;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class HomePage extends Component
{



    public $selectedMake = '';
    public $selectedModel = '';
    public $priceRange = '';
    
    public $selectedMakeName = '';
    public $selectedModelName = '';
    public $priceRangeName = '';
    
    public function updatedSelectedMakeName()
    {
        // Find the make ID based on the selected name
        $make = Make::where('name', $this->selectedMakeName)->first();
        $this->selectedMake = $make ? $make->id : '';
        
        // Reset model when make changes
        $this->selectedModel = '';
        $this->selectedModelName = '';
    }
    
    public function updatedSelectedModelName()
    {
        // Find the model ID based on the selected name
        $model = VehicleModel::where('name', $this->selectedModelName)->first();
        $this->selectedModel = $model ? $model->id : '';
    }
    
    public function updatedPriceRangeName()
    {
        // Map price range names to their corresponding ranges
        $priceRanges = [
            'Under 5M' => '0-5000000',
            '5M - 15M' => '5000000-15000000',
            '15M - 30M' => '15000000-30000000',
            '30M - 50M' => '30000000-50000000',
            'Over 50M' => '50000000-999999999',
        ];
        
        $this->priceRange = $priceRanges[$this->priceRangeName] ?? '';
    }
    public function searchVehicles()
{
    // Update the featured vehicles based on search criteria
    $query = Vehicle::with('dealer')
    
     //->where('is_featured', true)
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
        }
    }
    
    // Update the featured vehicles property to be emitted to the view
    $this->featuredVehicles = $query->latest()->take(6)->get();
    
    // Emit an event to notify other components if needed
    $this->emit('featuredVehiclesUpdated');
}

public function render()
{
    $makes = Make::withCount('vehicles')->orderBy('name')->get();
    $models = $this->selectedMake ? VehicleModel::where('make_id', $this->selectedMake)
   // ->where('status', 'active')
    ->withCount('vehicles')->orderBy('name')->get() : [];
    
    // Only fetch featured vehicles if not already set by search
    if (!isset($this->featuredVehicles)) {
        $this->featuredVehicles = Vehicle::with('dealer')
        //->where('is_featured', true)
        ->where('status', 'active')
        ->latest()->take(12)->get();
    }
    
    $topDealers = CarDealer::withCount(['vehicles', 'reviews'])->orderByDesc('reviews_count')->take(8)->get();
    
    return view('livewire.web.home-page', [
        'makes' => $makes,
        'models' => $models,
        'featuredVehicles' => $this->featuredVehicles,
        'topDealers' => $topDealers,
    ]);
}




  
}
