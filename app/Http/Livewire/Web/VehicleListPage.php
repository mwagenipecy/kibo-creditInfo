<?php

namespace App\Http\Livewire\Web;

use App\Models\BodyType;
use App\Models\CarDealer;
use App\Models\FuelType;
use App\Models\Make;
use App\Models\Transmission;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleListPage extends Component
{
    use WithPagination;

    // Filter variables
    public $selectedMakes = [];

    public $selectedModels = [];

    public $selectedBodyTypes = [];

    public $selectedFuelTypes = [];

    public $selectedTransmissions = [];

    public $selectedDealers = [];

    public $priceMin;

    public $priceMax;

    public $yearFrom;

    public $yearTo;

    public $maxMileage;

    // Sorting and view options
    public $sortBy = 'newest';

    public $viewType = 'grid';

    public $hasActiveFilters = false;

    public $activeFilters = [];

    protected $queryString = [
        'selectedMakes' => ['except' => []],
        'selectedModels' => ['except' => []],
        'priceMin' => ['except' => ''],
        'priceMax' => ['except' => ''],
        'yearFrom' => ['except' => ''],
        'yearTo' => ['except' => ''],
        'sortBy' => ['except' => 'newest'],
        'viewType' => ['except' => 'grid'],
    ];

    public function mount()
    {
        // Set default filter values if needed
        if (! $this->priceMin) {
            $this->priceMin = Vehicle::min('price') ?? 0;
        }

        if (! $this->priceMax) {
            $this->priceMax = Vehicle::max('price') ?? 100000000;
        }

        $this->checkActiveFilters();
    }

    public function updated($property)
    {
        if (in_array($property, [
            'selectedMakes', 'selectedModels', 'selectedBodyTypes',
            'selectedFuelTypes', 'selectedTransmissions', 'selectedDealers',
            'priceMin', 'priceMax', 'yearFrom', 'yearTo', 'maxMileage',
        ])) {
            $this->resetPage();
            $this->checkActiveFilters();
        }
    }

    public function resetFilters()
    {
        $this->reset([
            'selectedMakes', 'selectedModels', 'selectedBodyTypes',
            'selectedFuelTypes', 'selectedTransmissions', 'selectedDealers',
            'priceMin', 'priceMax', 'yearFrom', 'yearTo', 'maxMileage',
        ]);

        $this->priceMin = Vehicle::min('price') ?? 0;
        $this->priceMax = Vehicle::max('price') ?? 100000000;
        $this->resetPage();
        $this->checkActiveFilters();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function removeFilter($type, $value)
    {
        switch ($type) {
            case 'make':
                $this->selectedMakes = array_filter($this->selectedMakes, function ($id) use ($value) {
                    $make = Make::find($id);

                    return $make->name !== $value;
                });
                // Also reset selected models if they belong to this make
                if (count($this->selectedMakes) === 0) {
                    $this->selectedModels = [];
                }
                break;
            case 'model':
                $this->selectedModels = array_filter($this->selectedModels, function ($id) use ($value) {
                    $model = VehicleModel::find($id);

                    return $model->name !== $value;
                });
                break;
            case 'bodyType':
                $this->selectedBodyTypes = array_filter($this->selectedBodyTypes, function ($id) use ($value) {
                    $bodyType = BodyType::find($id);

                    return $bodyType->name !== $value;
                });
                break;
            case 'fuelType':
                $this->selectedFuelTypes = array_filter($this->selectedFuelTypes, function ($id) use ($value) {
                    $fuelType = FuelType::find($id);

                    return $fuelType->name !== $value;
                });
                break;
            case 'transmission':
                $this->selectedTransmissions = array_filter($this->selectedTransmissions, function ($id) use ($value) {
                    $transmission = Transmission::find($id);

                    return $transmission->name !== $value;
                });
                break;
            case 'dealer':
                $this->selectedDealers = array_filter($this->selectedDealers, function ($id) use ($value) {
                    $dealer = CarDealer::find($id);

                    return $dealer->name !== $value;
                });
                break;
            case 'price':
                $this->priceMin = Vehicle::min('price') ?? 0;
                $this->priceMax = Vehicle::max('price') ?? 100000000;
                break;
            case 'year':
                $this->yearFrom = '';
                $this->yearTo = '';
                break;
            case 'mileage':
                $this->maxMileage = '';
                break;
        }

        $this->resetPage();
        $this->checkActiveFilters();
    }

    private function checkActiveFilters()
    {
        $this->activeFilters = [];

        if (count($this->selectedMakes) > 0) {
            $this->activeFilters['makes'] = Make::whereIn('id', $this->selectedMakes)->pluck('name')->toArray();
        }

        if (count($this->selectedModels) > 0) {
            $this->activeFilters['models'] = VehicleModel::whereIn('id', $this->selectedModels)->pluck('name')->toArray();
        }

        if (count($this->selectedBodyTypes) > 0) {
            $this->activeFilters['bodyTypes'] = BodyType::whereIn('id', $this->selectedBodyTypes)->pluck('name')->toArray();
        }

        if (count($this->selectedFuelTypes) > 0) {
            $this->activeFilters['fuelTypes'] = FuelType::whereIn('id', $this->selectedFuelTypes)->pluck('name')->toArray();
        }

        if (count($this->selectedTransmissions) > 0) {
            $this->activeFilters['transmissions'] = Transmission::whereIn('id', $this->selectedTransmissions)->pluck('name')->toArray();
        }

        if (count($this->selectedDealers) > 0) {
            $this->activeFilters['dealers'] = CarDealer::whereIn('id', $this->selectedDealers)->pluck('name')->toArray();
        }

        if ($this->priceMin && $this->priceMin > Vehicle::min('price')) {
            $this->activeFilters['priceMin'] = $this->priceMin;
        }

        if ($this->priceMax && $this->priceMax < Vehicle::max('price')) {
            $this->activeFilters['priceMax'] = $this->priceMax;
        }

        if ($this->yearFrom) {
            $this->activeFilters['yearFrom'] = $this->yearFrom;
        }

        if ($this->yearTo) {
            $this->activeFilters['yearTo'] = $this->yearTo;
        }

        if ($this->maxMileage) {
            $this->activeFilters['maxMileage'] = $this->maxMileage;
        }

        $this->hasActiveFilters = count($this->activeFilters) > 0;
    }

    public function render()
    {
        $minPrice = Vehicle::min('price') ?? 0;
        $maxPrice = Vehicle::max('price') ?? 100000000;
<<<<<<< HEAD

        $query = Vehicle::with('dealer');

=======
        
        $query = Vehicle::with('dealer')
        ->where('status', 'active')
        ;
        
>>>>>>> 23326fd4fc3d0d76819f118df0b06962ef0cfb6b
        // Apply filters
        if (count($this->selectedMakes) > 0) {
            $query->whereIn('make_id', $this->selectedMakes);
        }

        if (count($this->selectedModels) > 0) {
            $query->whereIn('model_id', $this->selectedModels);
        }

        if (count($this->selectedBodyTypes) > 0) {
            $query->whereIn('body_type_id', $this->selectedBodyTypes);
        }

        if (count($this->selectedFuelTypes) > 0) {
            $query->whereIn('fuel_type_id', $this->selectedFuelTypes);
        }

        if (count($this->selectedTransmissions) > 0) {
            $query->whereIn('transmission_id', $this->selectedTransmissions);
        }

        if (count($this->selectedDealers) > 0) {
            $query->whereIn('dealer_id', $this->selectedDealers);
        }

        if ($this->priceMin) {
            $query->where('price', '>=', $this->priceMin);
        }

        if ($this->priceMax) {
            $query->where('price', '<=', $this->priceMax);
        }

        if ($this->yearFrom) {
            $query->where('year', '>=', $this->yearFrom);
        }

        if ($this->yearTo) {
            $query->where('year', '<=', $this->yearTo);
        }

        if ($this->maxMileage) {
            $query->where('mileage', '<=', $this->maxMileage);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'mileage_low':
                $query->orderBy('mileage', 'asc');
                break;
            case 'year_new':
                $query->orderBy('year', 'desc');
                break;
            default:
                $query->latest();
        }

        $vehicles = $query->paginate(12);

        // Get filter options
        $makes = Make::distinct('name')->take(10)->orderBy('name')->get();
        $models = VehicleModel::distinct('name')->take(10)->orderBy('name')->get();

        $bodyTypes = BodyType::withCount('vehicles')->take(3)->orderBy('name')->get();
        $fuelTypes = FuelType::withCount('vehicles')->take(3)->orderBy('name')->get();
        $transmissions = Transmission::withCount('vehicles')->take(3)->orderBy('name')->get();
        $dealers = CarDealer::withCount('vehicles')->orderBy('name')->get();

        return view('livewire.web.vehicle-list-page', [
            'vehicles' => $vehicles,
            'makes' => $makes,
            'models' => $models,
            'bodyTypes' => $bodyTypes,
            'fuelTypes' => $fuelTypes,
            'transmissions' => $transmissions,
            'dealers' => $dealers,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
}
