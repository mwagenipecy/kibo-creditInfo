<?php

namespace App\Http\Livewire\VehicleManagement;

use App\Models\VehicleModel;
use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Make;
use App\Models\BodyType;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleImage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
    
    // New image fields with specific views
    public $viewImages = [
        'front' => null,
        'side' => null,
        'back' => null,
    ];
    public $additionalImages = [];
    public $viewImagesPreview = [];
    public $existingImages = [
        'front' => null,
        'side' => null,
        'back' => null,
        'additional' => [],
    ];
    
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
        $rules = [
            'vehicle.make_id' => 'required|exists:makes,id',
            'vehicle.model_id' => 'required',
            'vehicle.body_type_id' => 'required|exists:body_types,id',
            'vehicle.fuel_type_id' => 'required|exists:fuel_types,id',
            'vehicle.transmission_id' => 'required|exists:transmissions,id',
            'vehicle.year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
           // 'vehicle.downPaymentPercent' => 'required|integer|max:99',
            'vehicle.price' => 'required|numeric|min:0',
            'vehicle.mileage' => 'required|numeric|min:0',
            'vehicle.color' => 'required|string|max:50',
            'vehicle.vin' => 'required|string|max:17|unique:vehicles,vin,' . $this->vehicleId,
            'vehicle.engine_size' => 'nullable|string|max:20',
            'vehicle.engine_type' => 'nullable|string|max:50',
            'vehicle.horsepower' => 'nullable|integer|min:0',
            'vehicle.drivetrain' => 'nullable|string|max:10',
            'vehicle.seating_capacity' => 'nullable|integer|min:0',
            'vehicle.vehicle_condition' => 'required|string|max:50',
            'vehicle.description' => 'required|string',
            'vehicle.trim' => 'nullable|string|max:50',
            'vehicle.owners' => 'nullable|integer|min:0',
            'vehicle.location' => 'required|string|max:100',
            'vehicle.is_featured' => 'boolean',
            'additionalImages.*' => 'nullable|image|max:10240', // 10MB Max
            'vehicleStatus' => 'required|in:active,on_hold,sold',
        ];

        // Add validation rules for view images only if in create mode or if there's no existing image
        if (!$this->editMode || ($this->editMode && !isset($this->existingImages['front']))) {
            $rules['viewImages.front'] = 'nullable|image|max:10240';
        } else {
            $rules['viewImages.front'] = 'nullable|image|max:10240';
        }

        if (!$this->editMode || ($this->editMode && !isset($this->existingImages['side']))) {
            $rules['viewImages.side'] = 'nullable|image|max:10240';
        } else {
            $rules['viewImages.side'] = 'nullable|image|max:10240';
        }

        if (!$this->editMode || ($this->editMode && !isset($this->existingImages['back']))) {
            $rules['viewImages.back'] = 'nullable|image|max:10240';
        } else {
            $rules['viewImages.back'] = 'nullable|image|max:10240';
        }

        return $rules;
    }
    
    // Initialize component
    public function mount()
    {
        $this->resetVehicleForm();
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
        
        // Get vehicle images and organize them by view
        $vehicleImages = VehicleImage::where('vehicle_id', $id)->get();
        
        // Reset existing images arrays
        $this->existingImages = [
            'front' => null,
            'side' => null,
            'back' => null,
            'additional' => [],
        ];
        
        foreach ($vehicleImages as $image) {
            if ($image->view === 'front') {
                $this->existingImages['front'] = $image;
            } elseif ($image->view === 'side') {
                $this->existingImages['side'] = $image;
            } elseif ($image->view === 'back') {
                $this->existingImages['back'] = $image;
            } else {
                $this->existingImages['additional'][] = $image;
            }
        }
    }
    
    // Cancel form and return to listing
    public function cancelForm()
    {
        $this->resetVehicleForm();
        $this->showForm = false;
        $this->editMode = false;
    }
    
    // Process property updates and handle image previews
    public function updated($propertyName)
    {
        // Only validate the updated property
        $this->validateOnly($propertyName);
        
        // Handle image previews for view-specific images
        if (Str::startsWith($propertyName, 'viewImages.')) {
            $viewType = Str::after($propertyName, 'viewImages.');
            
            if (in_array($viewType, ['front', 'side', 'back']) && 
                isset($this->viewImages[$viewType]) && 
                $this->viewImages[$viewType] instanceof \Livewire\TemporaryUploadedFile) {
                
                $this->viewImagesPreview[$viewType] = $this->viewImages[$viewType]->temporaryUrl();
            }
        }
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

            // Handle numeric fields that might be empty strings
            $numericFields = ['horsepower', 'seating_capacity'];
            foreach ($numericFields as $field) {
                if (isset($vehicleData[$field]) && $vehicleData[$field] === '') {
                    $vehicleData[$field] = null;
                }
            }

            $newVehicle->fill($vehicleData);
            $newVehicle->dealer_id = $dealerId;
            $newVehicle->status = $this->vehicleStatus;
            $newVehicle->save();
            
            // Upload and save view-specific images
            $this->uploadVehicleViewImages($newVehicle->id);
            
            // Upload and save additional images
            $this->uploadAdditionalImages($newVehicle->id);
            
            // Success message and reset form
            session()->flash('success', 'Vehicle added successfully!');
            $this->resetVehicleForm();
            $this->showForm = false;
            
        } catch (\Exception $e) {
            Log::error('Failed to add vehicle: ' . $e->getMessage());
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
            $vehicleData = $this->vehicle;
            
            // Handle numeric fields that might be empty strings
            $numericFields = ['horsepower', 'seating_capacity'];
            foreach ($numericFields as $field) {
                if (isset($vehicleData[$field]) && $vehicleData[$field] === '') {
                    $vehicleData[$field] = null;
                }
            }
            
            $existingVehicle->fill($vehicleData);
            $existingVehicle->status = $this->vehicleStatus;
            $existingVehicle->save();
            
            // Upload and save view-specific images
            $this->uploadVehicleViewImages($existingVehicle->id);
            
            // Upload and save additional images
            $this->uploadAdditionalImages($existingVehicle->id);
            
            // Success message and reset form
            session()->flash('success', 'Vehicle updated successfully!');
            $this->resetVehicleForm();
            $this->showForm = false;
            
        } catch (\Exception $e) {
            Log::error('Failed to update vehicle: ' . $e->getMessage());
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
            
            // Mark as deleted instead of actual deletion
            $vehicle->status = 'deleted';
            $vehicle->save();
            
            session()->flash('success', 'Vehicle deleted successfully');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete vehicle. ' . $e->getMessage());
        }
    }
    
    // Remove an existing image from database
    public function removeExistingImage($id)
    {
        try {
            $image = VehicleImage::findOrFail($id);
            $view = $image->view;
            
            // Delete file from storage
            if($image->image_url) {
                Storage::delete('public/' . $image->image_url);
            }
            
            // Delete record from database
            $image->delete();
            
            // Update the existingImages array
            if ($view === 'front') {
                $this->existingImages['front'] = null;
            } elseif ($view === 'side') {
                $this->existingImages['side'] = null;
            } elseif ($view === 'back') {
                $this->existingImages['back'] = null;
            } else {
                // Remove from additional images array
                $this->existingImages['additional'] = array_filter(
                    $this->existingImages['additional'], 
                    function($img) use ($id) {
                        return $img->id !== $id;
                    }
                );
                // Re-index the array
                $this->existingImages['additional'] = array_values($this->existingImages['additional']);
            }
            
            session()->flash('success', 'Image removed successfully');
            
        } catch (\Exception $e) {
            Log::error('Failed to remove image: ' . $e->getMessage());
            session()->flash('error', 'Failed to remove image. ' . $e->getMessage());
        }
    }
    
    // Remove a view-specific image before saving
    public function removeViewImage($view)
    {
        if (isset($this->viewImages[$view])) {
            $this->viewImages[$view] = null;
            
            // Also remove from preview
            if (isset($this->viewImagesPreview[$view])) {
                unset($this->viewImagesPreview[$view]);
            }
        }
    }
    
    // Remove an additional image before saving
    public function removeAdditionalImage($index)
    {
        if (isset($this->additionalImages[$index])) {
            unset($this->additionalImages[$index]);
            $this->additionalImages = array_values($this->additionalImages);
        }
    }
    
    // Upload view-specific vehicle images
  
    private function uploadVehicleViewImages($vehicleId)
{
    foreach (['front', 'side', 'back'] as $view) {
        if (!empty($this->viewImages[$view]) && $this->viewImages[$view] instanceof \Livewire\TemporaryUploadedFile) {
            try {
                // Check if there's already an image for this view
                $existingImage = VehicleImage::where('vehicle_id', $vehicleId)
                    ->where('view', $view)
                    ->first();
                
                // If exists, delete the old file
                if ($existingImage && $existingImage->image_url) {
                    Storage::delete('public/' . $existingImage->image_url);
                    $existingImage->delete();
                }
                
                // Process and compress image to WebP format
                $compressedImagePath = $this->processAndCompressImage(
                    $this->viewImages[$view], 
                    'vehicles/' . $vehicleId, 
                    $view
                );
                
                // Create image record
                VehicleImage::create([
                    'vehicle_id' => $vehicleId,
                    'image_url' => $compressedImagePath,
                    'view' => $view,
                    'is_featured' => ($view === 'front') ? true : false, // Make front view the featured image
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to upload {$view} image: " . $e->getMessage());
            }
        }
    }
}

// Upload additional vehicle images
private function uploadAdditionalImages($vehicleId)
{
    if (!empty($this->additionalImages)) {
        foreach ($this->additionalImages as $index => $image) {
            if ($image instanceof \Livewire\TemporaryUploadedFile) {
                try {
                    // Process and compress image to WebP format
                    $compressedImagePath = $this->processAndCompressImage(
                        $image, 
                        'vehicles/' . $vehicleId, 
                        'additional_' . $index
                    );
                    
                    VehicleImage::create([
                        'vehicle_id' => $vehicleId,
                        'image_url' => $compressedImagePath,
                        'view' => 'additional',
                        'is_featured' => false,
                    ]);
                } catch (\Exception $e) {
                    Log::error("Failed to upload additional image: " . $e->getMessage());
                }
            }
        }
    }
}

/**
 * Process and compress image to WebP format
 * 
 * @param \Livewire\TemporaryUploadedFile $uploadedFile
 * @param string $directory
 * @param string $filename
 * @return string
 */
private function processAndCompressImage($uploadedFile, $directory, $filename)
{
    // Get the temporary file path
    $tempPath = $uploadedFile->getRealPath();
    
    // Create image resource from uploaded file
    $imageInfo = getimagesize($tempPath);
    $mimeType = $imageInfo['mime'];
    
    switch ($mimeType) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($tempPath);
            break;
        case 'image/png':
            $image = imagecreatefrompng($tempPath);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($tempPath);
            break;
        case 'image/webp':
            $image = imagecreatefromwebp($tempPath);
            break;
        default:
            throw new \Exception('Unsupported image format: ' . $mimeType);
    }
    
    if (!$image) {
        throw new \Exception('Failed to create image resource');
    }
    
    // Get original dimensions
    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);
    
    // Calculate new dimensions (max width: 1200px, maintain aspect ratio)
    $maxWidth = 1200;
    $maxHeight = 800;
    
    if ($originalWidth > $maxWidth || $originalHeight > $maxHeight) {
        $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
        $newWidth = round($originalWidth * $ratio);
        $newHeight = round($originalHeight * $ratio);
        
        // Create resized image
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preserve transparency for PNG/GIF
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        
        // Resize image
        imagecopyresampled(
            $resizedImage, $image, 
            0, 0, 0, 0, 
            $newWidth, $newHeight, 
            $originalWidth, $originalHeight
        );
        
        imagedestroy($image);
        $image = $resizedImage;
    }
    
    // Generate unique filename with WebP extension
    $webpFilename = $filename . '_' . time() . '_' . uniqid() . '.webp';
    $webpPath = $directory . '/' . $webpFilename;
    
    // Ensure directory exists
    $fullDirectory = storage_path('app/public/' . $directory);
    if (!file_exists($fullDirectory)) {
        mkdir($fullDirectory, 0755, true);
    }
    
    // Save as WebP with compression (quality: 80 for good balance of size and quality)
    $fullWebpPath = storage_path('app/public/' . $webpPath);
    $success = imagewebp($image, $fullWebpPath, 80);
    
    // Clean up memory
    imagedestroy($image);
    
    if (!$success) {
        throw new \Exception('Failed to save WebP image');
    }
    
    return $webpPath;
}

/**
 * Validate image before processing
 * 
 * @param \Livewire\TemporaryUploadedFile $file
 * @return bool
 */
private function validateImage($file)
{
    // Check file size (max 10MB)
    if ($file->getSize() > 10 * 1024 * 1024) {
        throw new \Exception('Image file too large. Maximum size is 10MB.');
    }
    
    // Check if it's a valid image
    $imageInfo = getimagesize($file->getRealPath());
    if (!$imageInfo) {
        throw new \Exception('Invalid image file.');
    }
    
    // Check allowed formats
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($imageInfo['mime'], $allowedTypes)) {
        throw new \Exception('Unsupported image format. Allowed: JPEG, PNG, GIF, WebP');
    }
    
    return true;
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
            'seating_capacity' => '',
            'vehicle_condition' => '',
            'description' => '',
            'trim' => '',
            'owners' => 0,
            'location' => '',
            'is_featured' => false,
           // 'downPaymentPercent' => ''
        ];
        
        $this->vehicleId = null;
        $this->vehicleStatus = 'active';
        $this->viewImages = [
            'front' => null,
            'side' => null,
            'back' => null,
        ];
        $this->additionalImages = [];
        $this->viewImagesPreview = [];
        $this->existingImages = [
            'front' => null,
            'side' => null,
            'back' => null,
            'additional' => [],
        ];
        $this->resetValidation();
    }
    
    // Render the component
    public function render()
    {
        $models = [];
        // Get makes, models, body types, etc.
        $makes = Make::orderBy('name')->get();
        $models = isset($this->vehicle['make_id']) && $this->vehicle['make_id']
            ? VehicleModel::where('make_id', $this->vehicle['make_id'])->get() 
            : VehicleModel::orderBy('name')->get();
        
        $bodyTypes = BodyType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $transmissions = Transmission::orderBy('name')->get();
        
        // Get vehicles with filtering and sorting
        $dealerId = Auth::user()->institution_id;
        
        $vehiclesQuery = Vehicle::where('dealer_id', $dealerId)
            ->where('status', '!=', 'deleted')
            ->with(['make', 'model', 'transmission', 'fuelType', 'images'])
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