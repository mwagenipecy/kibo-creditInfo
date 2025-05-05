<?php

namespace App\Http\Livewire\VehicleManagement;

use App\Models\VehicleModel;
use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Make;
use App\Models\Model;
use App\Models\BodyType;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleImage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class VehicleList extends Component
{


    use WithFileUploads, WithPagination;
    
    // Pagination theme
    protected $paginationTheme = 'tailwind';
    
    // Form properties

    public $showStatusDropdown = [];
    public $showForm = false;
    public $editMode = false;
    public $vehicle = [];
    public $vehicleId = null;
    public $vehicleStatus = 'active';
    public $images = [];

    public $downPaymentPercent;
    public $vehicleImages = [];
    
    // Filter and sorting properties
    public $searchTerm = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    // Listeners for events
    protected $listeners = [
        'refreshVehicles' => '$refresh'
    ];
    
    // Validation rules
    protected function rules()
    {
        return [
            'vehicle.make_id' => 'required|exists:makes,id',
            'vehicle.model_id' => 'required',
            'vehicle.body_type_id' => 'required|exists:body_types,id',
            'vehicle.fuel_type_id' => 'required|exists:fuel_types,id',
            'vehicle.transmission_id' => 'required|exists:transmissions,id',
            'vehicle.year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'vehicle.downPaymentPercent'=>'required|integer|max:99',
            'vehicle.price' => 'required|numeric|min:0',
            'vehicle.mileage' => 'required|numeric|min:0',
            'vehicle.color' => 'required|string|max:50',
            'vehicle.vin' => 'required|string|max:17|unique:vehicles,vin,' . $this->vehicleId,
            'vehicle.engine_size' => 'nullable|string|max:20',
            'vehicle.engine_type' => 'nullable|string|max:50',
            'vehicle.horsepower' => 'nullable|integer|min:0',
            'vehicle.drivetrain' => 'nullable|string|max:10',
            'vehicle.length' => 'nullable|numeric|min:0',
            'vehicle.width' => 'nullable|numeric|min:0',
            'vehicle.height' => 'nullable|numeric|min:0',
            'vehicle.wheelbase' => 'nullable|numeric|min:0',
            'vehicle.seating_capacity' => 'nullable|integer|min:0',
            'vehicle.cargo_volume' => 'nullable|numeric|min:0',
            'vehicle.vehicle_condition' => 'required|string|max:50',
            'vehicle.description' => 'required|string',
            'vehicle.trim' => 'nullable|string|max:50',
            'vehicle.owners' => 'nullable|integer|min:0',
            'vehicle.location' => 'required|string|max:100',
            'vehicle.is_featured' => 'boolean',
            'images.*' => 'image|max:10240', // 10MB Max
            'vehicleStatus' => 'required|in:active,on_hold,sold',
        ];
    }
    
    // Initialize component
    public function mount()
    {
        $this->vehicle['is_featured'] = false;
        $this->vehicleStatus = 'active';
    }
    
    // Show the add vehicle form
    public function showAddVehicleForm()
    {
        $this->resetVehicleForm();
        $this->showForm = true;
        $this->editMode = false;
    }
    
    // Show edit form for a specific vehicle
    public function editVehicle($id)
    {
        $this->resetVehicleForm();
        
        $this->vehicleId = $id;
        $this->editMode = true;
        $this->showForm = true;
        
        $vehicle = Vehicle::findOrFail($id);
        
        // Populate form with vehicle data
        $this->vehicle = $vehicle->toArray();
        $this->vehicleStatus = $vehicle->status;
        
        // Get vehicle images
        $this->vehicleImages = $vehicle->images;
    }
    
    // Cancel form and return to listing
    public function cancelForm()
    {
        $this->resetVehicleForm();
        $this->showForm = false;
        $this->editMode = false;
    }
    
    // Add a new vehicle
    public function addVehicle()
    {
        $this->validate();
        
        try {
            // Get the dealer ID
            $dealerId = Auth::user()->institution_id;
            
            // Create new vehicle
            $newVehicle = new Vehicle();
            $vehicleData = $this->vehicle;

            $numericFields = ['length', 'width', 'height', 'wheelbase', 'seating_capacity', 'cargo_volume', 'horsepower'];
            foreach ($numericFields as $field) {
                if (isset($vehicleData[$field]) && $vehicleData[$field] === '') {
                    $vehicleData[$field] = null;
                }
            }

            $newVehicle->fill($vehicleData);



            // $newVehicle->fill($this->vehicle);
            $newVehicle->dealer_id = $dealerId;
            $newVehicle->status = $this->vehicleStatus;
            $newVehicle->save();
            
            // Upload and save images
            $this->uploadVehicleImages($newVehicle->id);
            
            // Success message and reset form
            session()->flash('success', 'Vehicle added successfully!');
            $this->resetVehicleForm();
            $this->showForm = false;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to add vehicle. ' . $e->getMessage());
        }
    }
    
    // Update an existing vehicle
    public function updateVehicle()
    {
        $this->validate();
        
        try {
            // Get existing vehicle
            $existingVehicle = Vehicle::findOrFail($this->vehicleId);
            
            // Update vehicle data
            $existingVehicle->fill($this->vehicle);
            $existingVehicle->status = $this->vehicleStatus;
            $existingVehicle->save();
            
            // Upload and save new images
            $this->uploadVehicleImages($existingVehicle->id);
            
            // Success message and reset form
            session()->flash('success', 'Vehicle updated successfully!');
            $this->resetVehicleForm();
            $this->showForm = false;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update vehicle. ' . $e->getMessage());
        }
    }
    
    // Toggle vehicle status (active/on hold/sold)
    public function toggleVehicleStatus($id, $status)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->status = $status;
            $vehicle->save();
            
            $statusText = ucfirst(str_replace('_', ' ', $status));
            session()->flash('success', "Vehicle marked as $statusText");
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update vehicle status. ' . $e->getMessage());
        }
    }
    
    // Toggle featured status
    public function toggleFeatured($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->is_featured = !$vehicle->is_featured;
            $vehicle->save();
            
            $statusText = $vehicle->is_featured ? 'featured' : 'unfeatured';
            session()->flash('success', "Vehicle $statusText successfully");
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update featured status. ' . $e->getMessage());
        }
    }
    
    // Delete a vehicle
    public function deleteVehicle($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            
            // Delete associated images from storage
            // foreach ($vehicle->images as $image) {
            //     Storage::delete('public/' . $image->path);
            //     $image->delete();
            // }
            
            // Delete the vehicle

            $vehicle->status = 'deleted';
            $vehicle->save();

    
            //delete();
            
            session()->flash('success', 'Vehicle deleted successfully');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete vehicle. ' . $e->getMessage());
        }
    }
    
    // Remove an existing image
    public function removeImage($path)
    {
        try {
            $image = VehicleImage::where('image_url',$path)->first();
            Storage::delete('public/' . $path);
            $image->delete();
            
            // Refresh images list
           // $this->vehicleImages = VehicleImage::where('vehicle_id', $this->vehicleId)->get();
            
            session()->flash('success', 'Image removed successfully');
            
        } catch (\Exception $e) {

            dd($e->getMessage());
            session()->flash('error', 'Failed to remove image. ' . $e->getMessage());
        }
    }
    
    // Remove a newly uploaded image (before saving)
    public function removeUploadedImage($index)
    {
        array_splice($this->images, $index, 1);
    }
    
    // Upload vehicle images
    private function uploadVehicleImages($vehicleId)
    {
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $path = $image->store('vehicles/' . $vehicleId, 'public');
                
                VehicleImage::create([
                    'vehicle_id' => $vehicleId,
                    'image_url' => $path,
                    'sort_order' => 0, // Default sort order
                ]);
            }
        }
    }
    
    // Reset vehicle form
    private function resetVehicleForm()
    {
        $this->vehicle = [
            'make_id' => '',
            'model_id' => '',
            'body_type_id' => '',
            'fuel_type_id' => '',
            'transmission_id' => '',
            'year' => date('Y'),
            'price' => '',
            'mileage' => '',
            'color' => '',
            'vin' => '',
            'engine_size' => '',
            'engine_type' => '',
            'horsepower' => '',
            'drivetrain' => '',
            'length' => '',
            'width' => '',
            'height' => '',
            'wheelbase' => '',
            'seating_capacity' => '',
            'cargo_volume' => '',
            'vehicle_condition' => '',
            'description' => '',
            'trim' => '',
            'owners' => 0,
            'location' => '',
            'is_featured' => false,
            'downPaymentPercent'=>''
        ];
        
        $this->vehicleId = null;
        $this->vehicleStatus = 'active';
        $this->images = [];
        $this->vehicleImages = [];
        $this->resetValidation();
    }
    
    // Render the component
    public function render()
    {
        $models=[];
        // Get makes, models, body types, etc.
        $makes = Make::orderBy('name')->get();
        $models = (isset($this->vehicle['make_id']) && $this->vehicle['make_id']) 
        ? VehicleModel::where('make_id', $this->vehicle['make_id'])->get() 
        : VehicleModel::orderBy('name')->get();
        
        $bodyTypes = BodyType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $transmissions = Transmission::orderBy('name')->get();
        
        // Get vehicles with filtering and sorting
        $dealerId = Auth::user()->institution_id;
        
        $vehiclesQuery = Vehicle::where('dealer_id', $dealerId)
           ->
            with(['make', 'model', 'transmission', 'fuelType', 'images'])
            ->when($this->searchTerm, function ($query) {
                return $query->where(function ($q) {
                    $q->whereHas('make', function ($q) {
                        $q->where('name', 'like', '%' . $this->searchTerm . '%');
                    })
                    ->orWhereHas('model', function ($q) {
                        $q->where('name', 'like', '%' . $this->searchTerm . '%');
                    })
                    ->orWhere('vin', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('color', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('year', 'like', '%' . $this->searchTerm . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                return $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection);
        
        $vehicles = $vehiclesQuery->paginate(10);
        
        // Count vehicles by status
        $activeCount = Vehicle::where('dealer_id', $dealerId)->where('status', 'active')->count();
        $onHoldCount = Vehicle::where('dealer_id', $dealerId)->where('status', 'on_hold')->count();
        $soldCount = Vehicle::where('dealer_id', $dealerId)->where('status', 'sold')->count();
        $featuredCount = Vehicle::where('dealer_id', $dealerId)->where('is_featured', true)->count();


        
        return view('livewire.vehicle-management.vehicle-list', [
            'vehicles' => $vehicles,
            'makes' => $makes,
            'models' => $models,
            'bodyTypes' => $bodyTypes,
            'fuelTypes' => $fuelTypes,
            'transmissions' => $transmissions,
            'activeCount' => $activeCount,
            'onHoldCount' => $onHoldCount,
            'soldCount' => $soldCount,
            'featuredCount' => $featuredCount,
        ]);
    }


}
