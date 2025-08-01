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
<div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-green-800 mb-1">
                    {{ $editMode ? 'Edit Vehicle' : 'Add New Vehicle' }}
                </h2>
                <p class="text-green-700 text-sm">
                    {{ $editMode ? 'Update vehicle information and images' : 'Create a new vehicle listing with all details' }}
                </p>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">
        <form wire:submit.prevent="{{ $editMode ? 'updateVehicle' : 'addVehicle' }}">
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-400 rounded-lg p-6 mb-8 shadow-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center">
                                        <span class="w-1 h-1 bg-red-400 rounded-full mr-2"></span>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

          

            <!-- Two Column Form Layout -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Basic Details Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-6">
                            <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Basic Details</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="make_id" class="block text-sm font-medium text-gray-700">Make*</label>
                                <select id="make_id" wire:model="vehicle.make_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    <option value="">Select Make</option>
                                    @foreach($makes as $make)
                                        <option value="{{ $make->id }}">{{ $make->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle.make_id') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label for="model_id" class="block text-sm font-medium text-gray-700">Model*</label>
                                <select id="model_id" wire:model="vehicle.model_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    <option value="">Select Model</option>
                                    @foreach($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle.model_id') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="space-y-2">
                                <label for="trim" class="block text-sm font-medium text-gray-700">Trim</label>
                                <input type="text" id="trim" wire:model="vehicle.trim" placeholder="e.g., Sport, Limited" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                @error('vehicle.trim') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label for="year" class="block text-sm font-medium text-gray-700">Year*</label>
                                <input type="number" id="year" wire:model="vehicle.year" placeholder="2024" min="1900" max="2030" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                @error('vehicle.year') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Specifications Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-6">
                            <div class="bg-purple-100 rounded-lg p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Specifications</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="body_type_id" class="block text-sm font-medium text-gray-700">Body Type*</label>
                                    <select id="body_type_id" wire:model="vehicle.body_type_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                        <option value="">Select Body Type</option>
                                        @foreach($bodyTypes as $bodyType)
                                            <option value="{{ $bodyType->id }}">{{ $bodyType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle.body_type_id') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="fuel_type_id" class="block text-sm font-medium text-gray-700">Fuel Type*</label>
                                    <select id="fuel_type_id" wire:model="vehicle.fuel_type_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                        <option value="">Select Fuel Type</option>
                                        @foreach($fuelTypes as $fuelType)
                                            <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle.fuel_type_id') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="transmission_id" class="block text-sm font-medium text-gray-700">Transmission*</label>
                                    <select id="transmission_id" wire:model="vehicle.transmission_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                        <option value="">Select Transmission</option>
                                        @foreach($transmissions as $transmission)
                                            <option value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle.transmission_id') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="drivetrain" class="block text-sm font-medium text-gray-700">Drivetrain</label>
                                    <select id="drivetrain" wire:model="vehicle.drivetrain" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                        <option value="">Select Drivetrain</option>
                                        <option value="FWD">Front-Wheel Drive (FWD)</option>
                                        <option value="RWD">Rear-Wheel Drive (RWD)</option>
                                        <option value="AWD">All-Wheel Drive (AWD)</option>
                                        <option value="4WD">Four-Wheel Drive (4WD)</option>
                                    </select>
                                    @error('vehicle.drivetrain') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="engine_size" class="block text-sm font-medium text-gray-700">Engine Size</label>
                                    <input type="text" id="engine_size" wire:model="vehicle.engine_size" placeholder="e.g. 2.0L" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    @error('vehicle.engine_size') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="engine_type" class="block text-sm font-medium text-gray-700">Engine Type</label>
                                    <input type="text" id="engine_type" wire:model="vehicle.engine_type" placeholder="e.g. V6 Turbo" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    @error('vehicle.engine_type') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="horsepower" class="block text-sm font-medium text-gray-700">Horsepower</label>
                                    <input type="number" id="horsepower" wire:model="vehicle.horsepower" placeholder="300" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    @error('vehicle.horsepower') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="seating_capacity" class="block text-sm font-medium text-gray-700">Seating Capacity</label>
                                    <input type="number" id="seating_capacity" wire:model="vehicle.seating_capacity" placeholder="5" min="1" max="50" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    @error('vehicle.seating_capacity') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Listing Details Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-6">
                            <div class="bg-green-100 rounded-lg p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Listing Details</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="vehicle_condition" class="block text-sm font-medium text-gray-700">Condition*</label>
                                    <select id="vehicle_condition" wire:model="vehicle.vehicle_condition" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                        <option value="">Select Condition</option>
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                        <option value="Certified Pre-Owned">Certified Pre-Owned</option>
                                    </select>
                                    @error('vehicle.vehicle_condition') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price (TZS)*</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">TZS</span>
                                        </div>
                                        <input type="number" id="price" wire:model="vehicle.price" placeholder="50,000,000" class="w-full pl-12 rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    </div>
                                    @error('vehicle.price') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <!-- <div class="space-y-2">
                                <label for="downPaymentPercent" class="block text-sm font-medium text-gray-700">Down Payment (%)*</label>
                                <div class="relative">
                                    <input type="number" id="downPaymentPercent" wire:model="vehicle.downPaymentPercent" placeholder="30" min="0" max="100" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">%</span>
                                    </div>
                                </div>
                                @error('vehicle.downPaymentPercent') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                            </div> -->
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="mileage" class="block text-sm font-medium text-gray-700">Mileage (KM)*</label>
                                    <div class="relative">
                                        <input type="number" id="mileage" wire:model="vehicle.mileage" placeholder="50,000" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">KM</span>
                                        </div>
                                    </div>
                                    @error('vehicle.mileage') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="color" class="block text-sm font-medium text-gray-700">Color*</label>
                                    <input type="text" id="color" wire:model="vehicle.color" placeholder="e.g., Midnight Blue" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    @error('vehicle.color') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="vin" class="block text-sm font-medium text-gray-700">VIN*</label>
                                    <input type="text" id="vin" wire:model="vehicle.vin" placeholder="1HGBH41JXMN109186" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white font-mono text-sm">
                                    @error('vehicle.vin') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="owners" class="block text-sm font-medium text-gray-700">Previous Owners</label>
                                    <input type="number" id="owners" wire:model="vehicle.owners" placeholder="1" min="0" max="10" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    @error('vehicle.owners') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="location" class="block text-sm font-medium text-gray-700">Location*</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="location" wire:model="vehicle.location" placeholder="Dar es Salaam, Tanzania" class="w-full pl-10 rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                </div>
                                @error('vehicle.location') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description and Status Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-6">
                            <div class="bg-orange-100 rounded-lg p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Description & Status</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description*</label>
                                <textarea id="description" wire:model="vehicle.description" rows="5" placeholder="Provide a detailed description of the vehicle including features, maintenance history, and any additional information..." class="w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-gray-50 focus:bg-white resize-none"></textarea>
                                @error('vehicle.description') <p class="mt-1 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl">
                                    <input type="checkbox" id="is_featured" wire:model="vehicle.is_featured" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                                    <label for="is_featured" class="ml-3 text-sm font-medium text-gray-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Featured Vehicle
                                        <span class="ml-2 text-xs text-gray-500">(Premium placement)</span>
                                    </label>
                                </div>
                                
                                <div class="space-y-3">
                                    <label class="text-sm font-medium text-gray-700">Vehicle Status</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <label class="relative flex items-center justify-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-300 transition-all duration-200 group">
                                            <input type="radio" id="status_active" wire:model="vehicleStatus" value="active" class="sr-only">
                                            <div class="text-center">
                                                <div class="w-3 h-3 bg-green-500 rounded-full mx-auto mb-2"></div>
                                                <span class="text-sm font-medium text-gray-700">Active</span>
                                            </div>
                                        </label>
                                        
                                        <label class="relative flex items-center justify-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-yellow-300 transition-all duration-200 group">
                                            <input type="radio" id="status_on_hold" wire:model="vehicleStatus" value="on_hold" class="sr-only">
                                            <div class="text-center">
                                                <div class="w-3 h-3 bg-yellow-500 rounded-full mx-auto mb-2"></div>
                                                <span class="text-sm font-medium text-gray-700">On Hold</span>
                                            </div>
                                        </label>
                                        
                                        <label class="relative flex items-center justify-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-red-300 transition-all duration-200 group">
                                            <input type="radio" id="status_sold" wire:model="vehicleStatus" value="sold" class="sr-only">
                                            <div class="text-center">
                                                <div class="w-3 h-3 bg-red-500 rounded-full mx-auto mb-2"></div>
                                                <span class="text-sm font-medium text-gray-700">Sold</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Images Section -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center mb-6">
                    <div class="bg-indigo-100 rounded-lg p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Vehicle Images</h3>
                        <p class="text-sm text-gray-600">Upload high-quality images to showcase your vehicle</p>
                    </div>
                </div>
                
                <!-- Image Upload Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                    <!-- Front View -->
                    <div class="space-y-3">
                        <h4 class="text-sm font-medium text-gray-700 flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            Front View
                        </h4>
                        <div class="relative group">
                            <label for="frontImage" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all duration-200 group-hover:border-blue-400">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-500 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                                    </svg>
                                    <p class="text-xs text-gray-500 text-center">
                                        <span class="font-semibold">Click to upload</span><br/>
                                        PNG, JPG (MAX. 10MB)
                                    </p>
                                </div>
                                <input id="frontImage" wire:model="viewImages.front" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('viewImages.front') <p class="text-xs text-red-600 flex items-center"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                        
                        @if(isset($viewImagesPreview['front']))
                            <div class="relative">
                                <img src="{{ $viewImagesPreview['front'] }}" alt="Front View" class="w-full h-24 object-cover rounded-lg shadow-sm">
                                <button type="button" wire:click="removeViewImage('front')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Side View -->
                    <div class="space-y-3">
                        <h4 class="text-sm font-medium text-gray-700 flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Side View
                        </h4>
                        <div class="relative group">
                            <label for="sideImage" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all duration-200 group-hover:border-green-400">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-500 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                                    </svg>
                                    <p class="text-xs text-gray-500 text-center">
                                        <span class="font-semibold">Click to upload</span><br/>
                                        PNG, JPG (MAX. 10MB)
                                    </p>
                                </div>
                                <input id="sideImage" wire:model="viewImages.side" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('viewImages.side') <p class="text-xs text-red-600 flex items-center"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                        
                        @if(isset($viewImagesPreview['side']))
                            <div class="relative">
                                <img src="{{ $viewImagesPreview['side'] }}" alt="Side View" class="w-full h-24 object-cover rounded-lg shadow-sm">
                                <button type="button" wire:click="removeViewImage('side')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Back View -->
                    <div class="space-y-3">
                        <h4 class="text-sm font-medium text-gray-700 flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                            Back View
                        </h4>
                        <div class="relative group">
                            <label for="backImage" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all duration-200 group-hover:border-purple-400">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-500 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                                    </svg>
                                    <p class="text-xs text-gray-500 text-center">
                                        <span class="font-semibold">Click to upload</span><br/>
                                        PNG, JPG (MAX. 10MB)
                                    </p>
                                </div>
                                <input id="backImage" wire:model="viewImages.back" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('viewImages.back') <p class="text-xs text-red-600 flex items-center"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                        
                        @if(isset($viewImagesPreview['back']))
                            <div class="relative">
                                <img src="{{ $viewImagesPreview['back'] }}" alt="Back View" class="w-full h-24 object-cover rounded-lg shadow-sm">
                                <button type="button" wire:click="removeViewImage('back')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Additional Images -->
                    <div class="space-y-3">
                        <h4 class="text-sm font-medium text-gray-700 flex items-center">
                            <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                            Additional
                        </h4>
                        <div class="relative group">
                            <label for="additionalImages" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all duration-200 group-hover:border-orange-400">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-500 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                                    </svg>
                                    <p class="text-xs text-gray-500 text-center">
                                        <span class="font-semibold">Multiple files</span><br/>
                                        PNG, JPG (MAX. 10MB)
                                    </p>
                                </div>
                                <input id="additionalImages" wire:model="additionalImages" type="file" class="hidden" multiple accept="image/*" />
                            </label>
                        </div>
                        @error('additionalImages.*') <p class="text-xs text-red-600 flex items-center"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p> @enderror
                    </div>
                </div>
                
                <!-- Existing Images Preview -->
                @if($editMode && count($existingImages) > 0)
                    <div class="mt-8 p-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-blue-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Current Images
                        </h4>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach(['front', 'side', 'back'] as $view)
                                @if(isset($existingImages[$view]))
                                    <div class="space-y-2">
                                        <h5 class="text-xs font-medium text-gray-600 capitalize">{{ $view }} View</h5>
                                        <div class="relative group">
                                          
                                        <img 
                                                src="{{ isset($existingImages[$view]) ? asset('storage/' . $existingImages[$view]->image_url) : asset('default/car1.jpg') }}"
                                                alt="{{ ucfirst($view) }} View"
                                                class="w-full h-24 object-cover rounded-lg shadow-sm"
                                                onerror="this.onerror=null; this.src='{{ asset('default/car1.jpg') }}';"
                                            />
                                           
                                            <button type="button" wire:click="removeExistingImage({{ $existingImages[$view]->id }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition-colors duration-200 opacity-0 group-hover:opacity-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        
                        @if(count($existingImages['additional']) > 0)
                            <div class="mt-6">
                                <h5 class="text-xs font-medium text-gray-600 mb-3">Additional Images</h5>
                                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                                    @foreach($existingImages['additional'] as $image)
                                        <div class="relative group">
                                        <img 
                                            src="{{ $image->image_url ? asset('storage/' . $image->image_url) : asset('default/car1.jpg') }}" 
                                            alt="Additional Image" 
                                            class="w-full h-20 object-cover rounded-lg shadow-sm"
                                            onerror="this.onerror=null; this.src='{{ asset('default/car1.jpg') }}';"
                                        />

                                            <button type="button" wire:click="removeExistingImage({{ $image->id }})" class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition-colors duration-200 opacity-0 group-hover:opacity-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                
                <!-- New Additional Images Preview -->
                @if(count($additionalImages) > 0)
                    <div class="mt-6 p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            New Additional Images
                        </h4>
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            @foreach($additionalImages as $index => $image)
                                <div class="relative group">
                                <img 
                                            src="{{ $image ? $image->temporaryUrl() : asset('default/car1.jpg') }}" 
                                            alt="New Vehicle Image" 
                                            class="w-full h-20 object-cover rounded-lg shadow-sm"
                                            onerror="this.onerror=null; this.src='{{ asset('default/car1.jpg') }}';"
                                        />


                                        <button type="button" wire:click="removeAdditionalImage({{ $index }})" class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition-colors duration-200 opacity-0 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Form Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 mt-10 pt-6 border-t border-gray-200">
                <button type="button" wire:click="cancelForm" class="w-full sm:w-auto px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 border border-transparent rounded-xl font-medium text-green-800 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    @if($editMode)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Update Vehicle
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Vehicle
                    @endif
                </button>
            </div>
        </form>
    </div>
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

                                             
                                            <img 
                                                    src="{{ isset($vehicle->images[0]) ? asset('storage/' . $vehicle->images[0]) : asset('default/car1.jpg') }}"
                                                    alt="{{ $vehicle->year }} {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}"
                                                    class="h-10 w-16 object-cover"
                                                    onerror="this.onerror=null;this.src='{{ asset('default/car1.jpg') }}';"
                                                />
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
