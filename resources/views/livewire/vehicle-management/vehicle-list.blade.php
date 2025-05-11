<div>
<!-- resources/views/livewire/dealer-vehicle-management.blade.php -->
<div class="bg-white w-full">
   
    <div class="p-4">
     <!-- Stats Cards -->
     <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Active Listings</div>
                            <div class="text-xl font-bold text-gray-900">{{ $activeCount }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">On Hold</div>
                            <div class="text-xl font-bold text-gray-900">{{ $onHoldCount }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Sold</div>
                            <div class="text-xl font-bold text-gray-900">{{ $soldCount }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Featured</div>
                            <div class="text-xl font-bold text-gray-900">{{ $featuredCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if($showForm)
            <!-- Vehicle Add/Edit Form -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">{{ $editMode ? 'Edit Vehicle' : 'Add New Vehicle' }}</h2>
                
                <form wire:submit.prevent="{{ $editMode ? 'updateVehicle' : 'addVehicle' }}">



                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <strong class="font-bold">Whoops! Something went wrong.</strong>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                    <!-- Two Column Form Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Basic Details Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Details</h3>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="make_id" class="block text-sm font-medium text-gray-700 mb-1">Make*</label>
                                        <select id="make_id" wire:model="vehicle.make_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Make</option>
                                            @foreach($makes as $make)
                                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle.make_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="model_id" class="block text-sm font-medium text-gray-700 mb-1">Model*</label>
                                        <select id="model_id" wire:model="vehicle.model_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Model</option>
                                            @foreach($models as $model)
                                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle.model_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="trim" class="block text-sm font-medium text-gray-700 mb-1">Trim</label>
                                        <input type="text" id="trim" wire:model="vehicle.trim" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.trim') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year*</label>
                                        <input type="number" id="year" wire:model="vehicle.year" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.year') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Specifications Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Specifications</h3>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="body_type_id" class="block text-sm font-medium text-gray-700 mb-1">Body Type*</label>
                                        <select id="body_type_id" wire:model="vehicle.body_type_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Body Type</option>
                                            @foreach($bodyTypes as $bodyType)
                                                <option value="{{ $bodyType->id }}">{{ $bodyType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle.body_type_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="fuel_type_id" class="block text-sm font-medium text-gray-700 mb-1">Fuel Type*</label>
                                        <select id="fuel_type_id" wire:model="vehicle.fuel_type_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Fuel Type</option>
                                            @foreach($fuelTypes as $fuelType)
                                                <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle.fuel_type_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="transmission_id" class="block text-sm font-medium text-gray-700 mb-1">Transmission*</label>
                                        <select id="transmission_id" wire:model="vehicle.transmission_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Transmission</option>
                                            @foreach($transmissions as $transmission)
                                                <option value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle.transmission_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="drivetrain" class="block text-sm font-medium text-gray-700 mb-1">Drivetrain</label>
                                        <select id="drivetrain" wire:model="vehicle.drivetrain" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Drivetrain</option>
                                            <option value="FWD">Front-Wheel Drive (FWD)</option>
                                            <option value="RWD">Rear-Wheel Drive (RWD)</option>
                                            <option value="AWD">All-Wheel Drive (AWD)</option>
                                            <option value="4WD">Four-Wheel Drive (4WD)</option>
                                        </select>
                                        @error('vehicle.drivetrain') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="engine_size" class="block text-sm font-medium text-gray-700 mb-1">Engine Size</label>
                                        <input type="text" id="engine_size" wire:model="vehicle.engine_size" placeholder="e.g. 2.0L" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.engine_size') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="engine_type" class="block text-sm font-medium text-gray-700 mb-1">Engine Type</label>
                                        <input type="text" id="engine_type" wire:model="vehicle.engine_type" placeholder="e.g. V6 Turbo" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.engine_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="horsepower" class="block text-sm font-medium text-gray-700 mb-1">Horsepower</label>
                                        <input type="number" id="horsepower" wire:model="vehicle.horsepower" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.horsepower') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="seating_capacity" class="block text-sm font-medium text-gray-700 mb-1">Seating Capacity</label>
                                        <input type="number" id="seating_capacity" wire:model="vehicle.seating_capacity" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.seating_capacity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Listing Details Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Listing Details</h3>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="vehicle_condition" class="block text-sm font-medium text-gray-700 mb-1">Condition*</label>
                                        <select id="vehicle_condition" wire:model="vehicle.vehicle_condition" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Condition</option>
                                            <option value="New">New</option>
                                            <option value="Used">Used</option>
                                            <option value="Certified Pre-Owned">Certified Pre-Owned</option>
                                        </select>
                                        @error('vehicle.vehicle_condition') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (TZS)*</label>
                                        <input type="number" id="price" wire:model="vehicle.price" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>


                                    <div>
                                        <label for="downPaymentPercent" class="block text-sm font-medium text-gray-700 mb-1">Down payment (%)*</label>
                                        <input type="number" id="downPaymentPercent" wire:model="vehicle.downPaymentPercent" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.downPaymentPercent') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>



                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="mileage" class="block text-sm font-medium text-gray-700 mb-1">Mileage (KM)*</label>
                                        <input type="number" id="mileage" wire:model="vehicle.mileage" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.mileage') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color*</label>
                                        <input type="text" id="color" wire:model="vehicle.color" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.color') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="vin" class="block text-sm font-medium text-gray-700 mb-1">VIN*</label>
                                        <input type="text" id="vin" wire:model="vehicle.vin" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.vin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="owners" class="block text-sm font-medium text-gray-700 mb-1">Previous Owners</label>
                                        <input type="number" id="owners" wire:model="vehicle.owners" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('vehicle.owners') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location*</label>
                                    <input type="text" id="location" wire:model="vehicle.location" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('vehicle.location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <!-- Description and Status Section -->
                            <div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                                    <textarea id="description" wire:model="vehicle.description" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"></textarea>
                                    @error('vehicle.description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="is_featured" wire:model="vehicle.is_featured" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">Featured Vehicle</label>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input type="radio" id="status_active" wire:model="vehicleStatus" value="active" class="rounded-full border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        <label for="status_active" class="ml-2 block text-sm text-gray-900">Active</label>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input type="radio" id="status_on_hold" wire:model="vehicleStatus" value="on_hold" class="rounded-full border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                                        <label for="status_on_hold" class="ml-2 block text-sm text-gray-900">On Hold</label>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input type="radio" id="status_sold" wire:model="vehicleStatus" value="sold" class="rounded-full border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                        <label for="status_sold" class="ml-2 block text-sm text-gray-900">Sold</label>
                                    </div>
                                </div>
                            </div>


                            </div>
                            </div>


                            <div>  
                            <div>  

                            
                            
                            <!-- Vehicle Images Section -->
                            <div>
    <h3 class="text-lg font-medium text-gray-900 mb-4">Vehicle Images</h3>
    
    <!-- Image Upload Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Front View -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">Front View Image</h4>
            <div class="mb-3">
                <div class="flex items-center justify-center w-full">
                    <label for="frontImage" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload front view</span></p>
                            <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 10MB)</p>
                        </div>
                        <input id="frontImage" wire:model="viewImages.front" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
                
                @error('viewImages.front') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <!-- Front View Image Preview -->
            @if(isset($viewImagesPreview['front']))
                <div class="mt-2">
                    <div class="relative inline-block">
                        <img src="{{ $viewImagesPreview['front'] }}" alt="Front View" class="h-24 w-auto object-cover rounded-lg">
                        <button type="button" wire:click="removeViewImage('front')" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Side View -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">Side View Image</h4>
            <div class="mb-3">
                <div class="flex items-center justify-center w-full">
                    <label for="sideImage" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload side view</span></p>
                            <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 10MB)</p>
                        </div>
                        <input id="sideImage" wire:model="viewImages.side" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
                
                @error('viewImages.side') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <!-- Side View Image Preview -->
            @if(isset($viewImagesPreview['side']))
                <div class="mt-2">
                    <div class="relative inline-block">
                        <img src="{{ $viewImagesPreview['side'] }}" alt="Side View" class="h-24 w-auto object-cover rounded-lg">
                        <button type="button" wire:click="removeViewImage('side')" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Back View -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">Back View Image</h4>
            <div class="mb-3">
                <div class="flex items-center justify-center w-full">
                    <label for="backImage" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload back view</span></p>
                            <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 10MB)</p>
                        </div>
                        <input id="backImage" wire:model="viewImages.back" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
                
                @error('viewImages.back') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <!-- Back View Image Preview -->
            @if(isset($viewImagesPreview['back']))
                <div class="mt-2">
                    <div class="relative inline-block">
                        <img src="{{ $viewImagesPreview['back'] }}" alt="Back View" class="h-24 w-auto object-cover rounded-lg">
                        <button type="button" wire:click="removeViewImage('back')" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Additional Images Section -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">Additional Images</h4>
            <div class="mb-3">
                <div class="flex items-center justify-center w-full">
                    <label for="additionalImages" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload additional images</span></p>
                            <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 10MB)</p>
                        </div>
                        <input id="additionalImages" wire:model="additionalImages" type="file" class="hidden" multiple accept="image/*" />
                    </label>
                </div>
                
                @error('additionalImages.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
    
    <!-- Existing Images Preview -->
    @if($editMode && count($existingImages) > 0)
        <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-sm font-medium text-gray-700 mb-4">Current Images</h4>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($existingImages['front']))
                    <div class="mb-4">
                        <h5 class="text-xs font-medium text-gray-600 mb-2">Front View</h5>
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $existingImages['front']->image_url) }}" alt="Front View" class="h-24 w-auto object-cover rounded-lg shadow-sm">
                            <button type="button" wire:click="removeExistingImage({{ $existingImages['front']->id }})" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                
                @if(isset($existingImages['side']))
                    <div class="mb-4">
                        <h5 class="text-xs font-medium text-gray-600 mb-2">Side View</h5>
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $existingImages['side']->image_url) }}" alt="Side View" class="h-24 w-auto object-cover rounded-lg shadow-sm">
                            <button type="button" wire:click="removeExistingImage({{ $existingImages['side']->id }})" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                
                @if(isset($existingImages['back']))
                    <div class="mb-4">
                        <h5 class="text-xs font-medium text-gray-600 mb-2">Back View</h5>
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $existingImages['back']->image_url) }}" alt="Back View" class="h-24 w-auto object-cover rounded-lg shadow-sm">
                            <button type="button" wire:click="removeExistingImage({{ $existingImages['back']->id }})" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            
            @if(count($existingImages['additional']) > 0)
                <div class="mt-4">
                    <h5 class="text-xs font-medium text-gray-600 mb-2">Additional Images</h5>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($existingImages['additional'] as $image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Additional Image" class="h-24 w-full object-cover rounded-lg shadow-sm">
                                <button type="button" wire:click="removeExistingImage({{ $image->id }})" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif
    
    <!-- Additional Images Preview -->
    @if(count($additionalImages) > 0)
        <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-sm font-medium text-gray-700 mb-2">New Additional Images</h4>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($additionalImages as $index => $image)
                    <div class="relative">
                        <img src="{{ $image->temporaryUrl() }}" alt="New Vehicle Image" class="h-24 w-full object-cover rounded-lg shadow-sm">
                        <button type="button" wire:click="removeAdditionalImage({{ $index }})" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2 shadow-md hover:bg-red-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>






                        </div>
                    </div>
                    
                    <!-- Form Buttons -->
                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" wire:click="cancelForm" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 border border-transparent rounded-md font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                            {{ $editMode ? 'Update Vehicle' : 'Add Vehicle' }}
                        </button>
                    </div>
                </form>
            </div>
        @else
            <!-- Vehicle Listing Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">



            <div class="flex justify-between items-center mb-6">

            <div> </div>

            <button wire:click="showAddVehicleForm" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New Vehicle
                    </button>



            </div>
                   


                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0 mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Your Vehicles</h2>
                    
                    <!-- Filter Controls -->
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                        <div class="relative">
                            <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search vehicles..." class="w-full md:w-64 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <div>
                            <select wire:model="statusFilter" class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <option value="">All Statuses</option>
                                <option value="active">Active</option>
                                <option value="on_hold">On Hold</option>
                                <option value="sold">Sold</option>
                            </select>
                        </div>
                        
                        <div>
                            <select wire:model="sortField" class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <option value="created_at">Date Added</option>
                                <option value="price">Price</option>
                                <option value="year">Year</option>
                                <option value="mileage">Mileage</option>
                            </select>
                        </div>
                        
                        <div>
                            <select wire:model="sortDirection" class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <option value="desc">Descending</option>
                                <option value="asc">Ascending</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Vehicles Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Vehicle
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Details
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Down Payment (%)
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Listed
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($vehicles as $vehicle)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-16 bg-gray-100 rounded overflow-hidden">

                                            @if(count($vehicle->images) > 0)

                                             
                                                    <img src="{{  asset('storage/' . $vehicle->images[0])  }}" alt="{{ $vehicle->year }} {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}" class="h-10 w-16 object-cover">
                                                @else
                                                    <div class="h-10 w-16 flex items-center justify-center bg-gray-200 text-gray-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $vehicle->year }} {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    VIN: {{ $vehicle->vin }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ number_format($vehicle->mileage) }} km</div>
                                        <div class="text-sm text-gray-500">{{ optional($vehicle->transmission)->name }}, {{ optional($vehicle->fuel_type)->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">TZS {{ number_format($vehicle->price) }}</div>
                                        @if($vehicle->is_featured)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                Featured
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">TZS {{ number_format($vehicle->price) }}</div>
                                     
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                              
                                            </span>
                                        
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($vehicle->status === 'active')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @elseif($vehicle->status === 'on_hold')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                On Hold
                                            </span>
                                        @elseif($vehicle->status === 'sold')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Sold
                                            </span>

                                            @elseif($vehicle->status === 'deleted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            deleted
                                            </span>

                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $vehicle->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
    <div class="flex flex-wrap gap-2">
        <!-- Edit button -->
        <button wire:click="editVehicle({{ $vehicle->id }})" 
                class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
        </button>
        
        <!-- Status dropdown using Livewire -->
        <div class="relative inline-block text-left">
            <button 
                wire:click="$toggle('showStatusDropdown.{{ $vehicle->id }}')" 
                type="button" 
                class="inline-flex w-full items-center justify-center gap-x-1.5 rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" 
                id="status-menu-button" 
                aria-expanded="false" 
                aria-haspopup="true">
                Status
                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
            
            @if(isset($showStatusDropdown[$vehicle->id]) && $showStatusDropdown[$vehicle->id])
            <div 
                class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" 
                role="menu" 
                aria-orientation="vertical" 
                aria-labelledby="status-menu-button" 
                tabindex="-1"
                wire:click.away="$set('showStatusDropdown.{{ $vehicle->id }}', false)">
                <div class="py-1" role="none">
                    <button 
                        wire:click="toggleVehicleStatus({{ $vehicle->id }}, 'active')" 
                        class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                        role="menuitem" 
                        tabindex="-1">
                        <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                        Activate
                    </button>
                    <button 
                        wire:click="toggleVehicleStatus({{ $vehicle->id }}, 'on_hold')" 
                        class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                        role="menuitem" 
                        tabindex="-1">
                        <span class="h-2 w-2 rounded-full bg-yellow-500 mr-2"></span>
                        Hold
                    </button>
                    <button 
                        wire:click="toggleVehicleStatus({{ $vehicle->id }}, 'sold')" 
                        class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                        role="menuitem" 
                        tabindex="-1">
                        <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span>
                        Mark Sold
                    </button>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Featured Toggle Button -->
        <button 
            wire:click="toggleFeatured({{ $vehicle->id }})" 
            class="inline-flex items-center rounded-md {{ $vehicle->is_featured ? 'bg-purple-50 text-purple-700 ring-purple-600/20' : 'bg-white text-gray-700 ring-gray-300' }} px-2.5 py-1.5 text-sm font-semibold shadow-sm ring-1 ring-inset hover:bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 {{ $vehicle->is_featured ? 'text-purple-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            {{ $vehicle->is_featured ? 'Featured' : 'Feature' }}
        </button>
        
        <!-- Delete Button -->
        <button 
            wire:click="deleteVehicle({{ $vehicle->id }})" 
            wire:confirm="Are you sure you want to delete this vehicle?" 
            class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Delete
        </button>
    </div>
</td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <p class="text-base font-medium">No vehicles found</p>
                                            <p class="text-sm mt-1">Add your first vehicle by clicking the "Add New Vehicle" button above.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $vehicles->links() }}
                </div>
            </div>
            
           
        @endif
    </div>
</div>

</div>
