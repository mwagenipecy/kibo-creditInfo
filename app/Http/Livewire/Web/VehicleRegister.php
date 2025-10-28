<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Vehicle;
use App\Models\Make;
use App\Models\VehicleModel;
use App\Models\BodyType;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleRegister extends Component
{
    use WithFileUploads;
    
    public $editMode = false;
    public $vehicleId = null;
    public $makes;
    public $models = [];
    public $bodyTypes;
    public $fuelTypes;
    public $transmissions;
    
    // Form fields
    public $make_id;
    public $model_id;
    public $body_type_id;
    public $fuel_type_id;
    public $transmission_id;
    public $year;
    public $price;
    public $mileage;
    public $color;
    public $vin;
    public $engine_size;
    public $engine_type;
    public $horsepower;
    public $drivetrain;
    public $seating_capacity;
    public $vehicle_condition;
    public $description;
    public $trim;
    public $owners;
    public $location;
    
    // Images
    public $front_image;
    public $side_image;
    public $back_image;
    public $additional_images = [];
    
    public function mount($id = null)
    {
        $this->makes = Make::orderBy('name')->get();
        $this->bodyTypes = BodyType::all();
        $this->fuelTypes = FuelType::all();
        $this->transmissions = Transmission::all();
        
        if ($id) {
            $this->editMode = true;
            $this->vehicleId = $id;
            $this->loadVehicleData();
        }
    }
    
    public function updatedMakeId($value)
    {
        $this->models = VehicleModel::where('make_id', $value)->orderBy('name')->get();
        $this->model_id = null;
    }
    
    public function loadVehicleData()
    {
        $vehicle = Vehicle::find($this->vehicleId);
        
        if ($vehicle && $vehicle->user_id === Auth::id()) {
            $this->make_id = $vehicle->make_id;
            $this->models = VehicleModel::where('make_id', $vehicle->make_id)->orderBy('name')->get();
            $this->model_id = $vehicle->model_id;
            $this->body_type_id = $vehicle->body_type_id;
            $this->fuel_type_id = $vehicle->fuel_type_id;
            $this->transmission_id = $vehicle->transmission_id;
            $this->year = $vehicle->year;
            $this->price = $vehicle->price;
            $this->mileage = $vehicle->mileage;
            $this->color = $vehicle->color;
            $this->vin = $vehicle->vin;
            $this->engine_size = $vehicle->engine_size;
            $this->engine_type = $vehicle->engine_type;
            $this->horsepower = $vehicle->horsepower;
            $this->drivetrain = $vehicle->drivetrain;
            $this->seating_capacity = $vehicle->seating_capacity;
            $this->vehicle_condition = $vehicle->vehicle_condition;
            $this->description = $vehicle->description;
            $this->trim = $vehicle->trim;
            $this->owners = $vehicle->owners;
            $this->location = $vehicle->location;
        }
    }
    
    public function save()
    {
        $rules = [
            'make_id' => 'required|exists:makes,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'body_type_id' => 'required|exists:body_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'transmission_id' => 'required|exists:transmissions,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|numeric|min:0',
            'color' => 'required|string|max:50',
            'vin' => 'required|string|max:17|unique:vehicles,vin,' . $this->vehicleId,
            'engine_size' => 'nullable|string|max:20',
            'engine_type' => 'nullable|string|max:50',
            'horsepower' => 'nullable|integer|min:0',
            'drivetrain' => 'nullable|string|max:10',
            'seating_capacity' => 'nullable|integer|min:0',
            'vehicle_condition' => 'required|string|max:50',
            'description' => 'required|string',
            'trim' => 'nullable|string|max:50',
            'owners' => 'nullable|integer|min:0',
            'location' => 'required|string|max:100',
            'front_image' => $this->editMode ? 'nullable' : 'required|image|max:10240',
            'side_image' => 'nullable|image|max:10240',
            'back_image' => 'nullable|image|max:10240',
            'additional_images.*' => 'nullable|image|max:10240',
        ];
        
        $this->validate($rules);
        
        if ($this->editMode && $this->vehicleId) {
            $vehicle = Vehicle::where('id', $this->vehicleId)
                ->where('user_id', Auth::id())
                ->first();
                
            if (!$vehicle) {
                session()->flash('error', 'Vehicle not found or you do not have permission to edit it.');
                return;
            }
        } else {
            $vehicle = new Vehicle();
            $vehicle->user_id = Auth::id();
            $vehicle->status = 'active';
            $vehicle->is_for_sale = true;
            $vehicle->is_wedding_car = false;
        }
        
        $vehicle->make_id = $this->make_id;
        $vehicle->model_id = $this->model_id;
        $vehicle->body_type_id = $this->body_type_id;
        $vehicle->fuel_type_id = $this->fuel_type_id;
        $vehicle->transmission_id = $this->transmission_id;
        $vehicle->year = $this->year;
        $vehicle->price = $this->price;
        $vehicle->mileage = $this->mileage;
        $vehicle->color = $this->color;
        $vehicle->vin = $this->vin;
        $vehicle->engine_size = $this->engine_size;
        $vehicle->engine_type = $this->engine_type;
        $vehicle->horsepower = $this->horsepower;
        $vehicle->drivetrain = $this->drivetrain;
        $vehicle->seating_capacity = $this->seating_capacity;
        $vehicle->vehicle_condition = $this->vehicle_condition;
        $vehicle->description = $this->description;
        $vehicle->trim = $this->trim;
        $vehicle->owners = $this->owners;
        $vehicle->location = $this->location;
        $vehicle->isNotdealer = true;
        $vehicle->save();
        
        // Handle image uploads
        $this->uploadImages($vehicle->id);
        
        session()->flash('success', $this->editMode ? 'Vehicle updated successfully!' : 'Vehicle registered successfully!');
        
        return redirect()->route('my.vehicles');
    }
    
    public function uploadImages($vehicleId)
    {
        $path = 'public/vehicles/' . $vehicleId;
        
        // Upload front image
        if ($this->front_image) {
            $this->saveImage($vehicleId, $this->front_image, 'front');
        }
        
        // Upload side image
        if ($this->side_image) {
            $this->saveImage($vehicleId, $this->side_image, 'side');
        }
        
        // Upload back image
        if ($this->back_image) {
            $this->saveImage($vehicleId, $this->back_image, 'back');
        }
        
        // Upload additional images
        if (!empty($this->additional_images)) {
            foreach ($this->additional_images as $image) {
                $this->saveImage($vehicleId, $image, 'additional');
            }
        }
    }
    
    public function saveImage($vehicleId, $image, $view)
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->putFileAs('vehicles/' . $vehicleId, $image, $filename);
        
        VehicleImage::create([
            'vehicle_id' => $vehicleId,
            'image_url' => $path,
            'view' => $view,
            'is_featured' => $view === 'front',
        ]);
    }
    
    public function render()
    {
        return view('livewire.web.vehicle-register');
    }
}
