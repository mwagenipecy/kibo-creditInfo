<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SparePart;
use App\Models\SpareCategory;
use App\Models\SpareBrand;
use Illuminate\Support\Facades\DB;

class Marketplace extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $brandFilter = '';
    public $priceMin = '';
    public $priceMax = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    
    // Location-based search
    public $userLatitude = '';
    public $userLongitude = '';
    public $maxDistance = 50; // kilometers
    public $locationCaptured = false;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
    }

    public function updatedCategoryFilter()
    {
        $this->brandFilter = '';
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPriceMin()
    {
        $this->resetPage();
    }

    public function updatedPriceMax()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function getCurrentLocation()
    {
        $this->dispatchBrowserEvent('get-user-location');
    }

    public function updateUserLocation($latitude, $longitude)
    {
        $this->userLatitude = $latitude;
        $this->userLongitude = $longitude;
        $this->locationCaptured = true;
        session()->flash('location_success', 'Location captured! Showing nearby spare parts.');
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'categoryFilter', 'brandFilter', 'priceMin', 'priceMax']);
        $this->resetPage();
    }

    public function render()
    {
        $categories = SpareCategory::withCount('spareParts')->orderBy('name')->get();
        $brands = collect();
        
        if ($this->categoryFilter) {
            $brands = SpareBrand::where('spare_category_id', $this->categoryFilter)
                ->withCount('spareModels')
                ->orderBy('name')
                ->get();
        }

        $query = SparePart::with(['spareCategory', 'spareBrand', 'spareModel', 'shop'])
            ->when($this->search, function($q) {
                $q->where(function($query) {
                    $query->where('unit', 'like', '%' . $this->search . '%')
                          ->orWhere('description', 'like', '%' . $this->search . '%')
                          ->orWhereHas('spareCategory', function($cat) {
                              $cat->where('name', 'like', '%' . $this->search . '%');
                          })
                          ->orWhereHas('spareBrand', function($brand) {
                              $brand->where('name', 'like', '%' . $this->search . '%');
                          });
                });
            })
            ->when($this->categoryFilter, function($q) {
                $q->where('spare_category_id', $this->categoryFilter);
            })
            ->when($this->brandFilter, function($q) {
                $q->where('spare_brand_id', $this->brandFilter);
            })
            ->when($this->priceMin, function($q) {
                $q->where('price', '>=', $this->priceMin);
            })
            ->when($this->priceMax, function($q) {
                $q->where('price', '<=', $this->priceMax);
            });

        // Add location-based filtering if user location is available
        if ($this->locationCaptured && $this->userLatitude && $this->userLongitude) {
            $query->join('shops', 'spare_parts.shop_id', '=', 'shops.id')
                  ->whereNotNull('shops.latitude')
                  ->whereNotNull('shops.longitude')
                  ->selectRaw('spare_parts.*, shops.name as shop_name, shops.latitude as shop_latitude, shops.longitude as shop_longitude,
                              ( 6371 * acos( cos( radians(?) ) * cos( radians( shops.latitude ) ) * cos( radians( shops.longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( shops.latitude ) ) ) ) AS distance', 
                              [$this->userLatitude, $this->userLongitude, $this->userLatitude])
                  ->having('distance', '<=', $this->maxDistance)
                  ->orderBy('distance');
        }

        $spareParts = $query->orderBy($this->sortBy, $this->sortDirection)->paginate(12);

        return view('livewire.web.marketplace', [
            'spareParts' => $spareParts,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}