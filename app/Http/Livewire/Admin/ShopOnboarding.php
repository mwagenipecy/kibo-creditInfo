<?php

// app/Http/Livewire/Admin/ShopOnboarding.php
namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ShopOnboarding extends Component
{
    use WithPagination;

    // View modes
    public $currentView = 'list'; // 'list', 'create', 'edit'
    
    // Form properties
    public $shopId = null;
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
    public $supervisor_id = null;
    
    // UI states
    public $locationCaptured = false;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    // Confirmation states
    public $confirmingDeletion = false;
    public $shopToDelete = null;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'shop_type' => 'required|in:spare_parts,mechanic,accessories,service',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'required|string',
            'supervisor_name' => 'required|string|max:255',
            'supervisor_email' => [
                'required',
                'email',
                $this->shopId ? Rule::unique('users', 'email')->ignore($this->supervisor_id) : 'unique:users,email'
            ],
            'supervisor_phone' => 'required|string|max:255',
        ];

        return $rules;
    }

    public function mount()
    {
        $this->shop_type = 'spare_parts';
    }

    // View navigation methods
    public function showCreateForm()
    {
        $this->currentView = 'create';
        $this->resetForm();
    }

    public function showList()
    {
        $this->currentView = 'list';
        $this->resetForm();
    }

    public function editShop($shopId)
    {
        $shop = Shop::with('supervisor')->findOrFail($shopId);
        
        $this->shopId = $shop->id;
        $this->name = $shop->name;
        $this->owner_name = $shop->owner_name;
        $this->phone_number = $shop->phone_number;
        $this->email = $shop->email;
        $this->shop_type = $shop->shop_type;
        $this->latitude = $shop->latitude;
        $this->longitude = $shop->longitude;
        $this->address = $shop->address;
        $this->locationCaptured = true;
        
        if ($shop->supervisor) {
            $this->supervisor_id = $shop->supervisor->id;
            $this->supervisor_name = $shop->supervisor->name;
            $this->supervisor_email = $shop->supervisor->email;
            $this->supervisor_phone = $shop->supervisor->phone;
        }
        
        $this->currentView = 'edit';
    }

    public function resetForm()
    {
        $this->reset([
            'shopId', 'name', 'owner_name', 'phone_number', 'email', 'shop_type',
            'latitude', 'longitude', 'address', 'supervisor_name', 'supervisor_email',
            'supervisor_phone', 'supervisor_id', 'locationCaptured'
        ]);
        $this->shop_type = 'spare_parts';
    }

    // Location methods
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

    // CRUD operations
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
            $password = Str::random(8);
            $supervisor = User::create([
                'name' => $this->supervisor_name,
                'email' => $this->supervisor_email,
                'phone' => $this->supervisor_phone,
                'password' => Hash::make($password),
                'shop_id' => $shop->id,
                'role' => 'shop_supervisor',
            ]);

            session()->flash('success', "Shop created successfully! Supervisor credentials: Email: {$this->supervisor_email}, Password: {$password}");
            
            $this->resetForm();
            $this->currentView = 'list';

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating shop: ' . $e->getMessage());
        }
    }

    public function updateShop()
    {
        $this->validate();

        try {
            $shop = Shop::findOrFail($this->shopId);
            
            // Update shop details
            $shop->update([
                'name' => $this->name,
                'owner_name' => $this->owner_name,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'shop_type' => $this->shop_type,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'address' => $this->address,
            ]);

            // Update supervisor details
            if ($this->supervisor_id) {
                $supervisor = User::findOrFail($this->supervisor_id);
                $supervisor->update([
                    'name' => $this->supervisor_name,
                    'email' => $this->supervisor_email,
                    'phone' => $this->supervisor_phone,
                ]);
            }

            session()->flash('success', 'Shop updated successfully!');
            
            $this->resetForm();
            $this->currentView = 'list';

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating shop: ' . $e->getMessage());
        }
    }

    public function confirmDeletion($shopId)
    {
        $this->shopToDelete = $shopId;
        $this->confirmingDeletion = true;
    }

    public function deleteShop()
    {
        try {
            $shop = Shop::findOrFail($this->shopToDelete);
            
            // Delete associated supervisor
            if ($shop->supervisor) {
                $shop->supervisor->delete();
            }
            
            // Delete shop
            $shop->delete();

            session()->flash('success', 'Shop deleted successfully!');
            
            $this->confirmingDeletion = false;
            $this->shopToDelete = null;

        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting shop: ' . $e->getMessage());
        }
    }

    public function cancelDeletion()
    {
        $this->confirmingDeletion = false;
        $this->shopToDelete = null;
    }

    // Sorting and searching
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $shops = Shop::with(['supervisor'])
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('owner_name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.shop-onboarding', compact('shops'));
    }
}