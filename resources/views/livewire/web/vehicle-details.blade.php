<div>
<!-- resources/views/livewire/vehicle-detail.blade.php -->
<div class="bg-white w-full">
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('vehicle.list') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ml-2">Vehicles</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $vehicle->year }} 
                            <!-- {{ $vehicle->make }} {{ $vehicle->model }} -->
                        
                        </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Vehicle Images and Details -->
            <div class="lg:w-2/3">

            
                <!-- Vehicle Title & Price -->
                <div class="mb-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <!-- <h1 class="text-3xl font-bold text-gray-900 mb-2 md:mb-0">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }}</h1> -->
                        <div class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md">
                            <span class="text-lg font-bold">TZS {{ number_format($vehicle->price) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-600 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-sm">{{ $vehicle->location }}</span>
                    </div>
                </div>
                
                <!-- Vehicle Images Gallery -->
                <div class="mb-8" x-data="{ activeSlide: 0 }">
                    <!-- Main Image -->
                    <div class="relative rounded-xl overflow-hidden mb-4 bg-gray-100 aspect-w-16 aspect-h-9">
                        <!-- @foreach($vehicle->images as $index => $image) -->
                        @for($i = 1; $i <= 3; $i++)

                            <div x-show="activeSlide === {{ $index }}" class="w-full h-full">
                                <img src="{{ asset('/cars/blue-car-driving-road.jpg')}}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-full object-cover">
                            </div>

                            @endfor
                        <!-- @endforeach -->
                        
                        <!-- Image Navigation Arrows -->
                        <button @click="activeSlide = activeSlide === 0 ? {{ count($vehicle->images) - 1 }} : activeSlide - 1" 
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/70 hover:bg-white/90 rounded-full p-2 shadow-md focus:outline-none transition">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="activeSlide = activeSlide === {{ count($vehicle->images) - 1 }} ? 0 : activeSlide + 1" 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/70 hover:bg-white/90 rounded-full p-2 shadow-md focus:outline-none transition">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Thumbnails -->
                    <div class="grid grid-cols-6 gap-2">
                        @foreach($vehicle->images as $index => $image)
                            <button @click="activeSlide = {{ $index }}" :class="{ 'ring-2 ring-green-600': activeSlide === {{ $index }} }" 
                                class="rounded-md overflow-hidden focus:outline-none transition duration-150 hover:opacity-90">
                                <img src="{{ asset('/cars/blue-car-driving-road.jpg') }}" alt="Thumbnail" class="w-full h-16 object-cover">
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <!-- Vehicle Features Tabs -->
                <div class="mb-8" x-data="{ activeTab: 'overview' }">
                    <!-- Tab Navigation -->
                    <div class="flex border-b border-gray-200">
                        <button @click="activeTab = 'overview'" :class="{ 'border-green-600 text-green-600': activeTab === 'overview' }" 
                            class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm sm:text-base transition-colors duration-200 ease-out">
                            Overview
                        </button>
                        <button @click="activeTab = 'features'" :class="{ 'border-green-600 text-green-600': activeTab === 'features' }" 
                            class="flex-1 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm sm:text-base text-gray-500 hover:text-gray-700 transition-colors duration-200 ease-out">
                            Features
                        </button>
                        <button @click="activeTab = 'specifications'" :class="{ 'border-green-600 text-green-600': activeTab === 'specifications' }" 
                            class="flex-1 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm sm:text-base text-gray-500 hover:text-gray-700 transition-colors duration-200 ease-out">
                            Specifications
                        </button>
                    </div>
                    
                    <!-- Tab Content -->
                    <div class="py-6">
                        <!-- Overview Tab -->
                        <div x-show="activeTab === 'overview'" class="space-y-5">
                            <p class="text-gray-700">{{ $vehicle->description }}</p>
                            
                            <!-- Key Specs Cards -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Condition</div>
                                    <div class="font-semibold">{{ $vehicle->condition }}</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Year</div>
                                    <div class="font-semibold">{{ $vehicle->year }}</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Mileage</div>
                                    <div class="font-semibold">{{ number_format($vehicle->mileage) }} km</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Fuel Type</div>
                                    <div class="font-semibold">{{ $vehicle->fuel_type }}</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Transmission</div>
                                    <div class="font-semibold">{{optional($vehicle->transmission)->name }}</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Body Type</div>
                                    <div class="font-semibold">{{ $vehicle->body_type }}</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Color</div>
                                    <div class="font-semibold">{{ $vehicle->color }}</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-gray-500 text-sm mb-1">Engine</div>
                                    <div class="font-semibold">{{ $vehicle->engine_size }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Features Tab -->
                        <div x-show="activeTab === 'features'" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                                @foreach($vehicle->features as $feature)

                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ $feature }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Specifications Tab -->
                        <div x-show="activeTab === 'specifications'" class="space-y-5">
                            <!-- Engine & Performance -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Engine & Performance</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Engine Type</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->engine_type }}</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Engine Size</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->engine_size }}</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Fuel Type</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->fuel_type }}</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Transmission</span>
                                        <span class="font-medium text-gray-900">{{ optional($vehicle->transmission)->name }}</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Power</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->horsepower }} hp</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Drivetrain</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->drivetrain }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Dimensions -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Dimensions</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Length</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->length }} mm</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Width</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->width }} mm</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Height</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->height }} mm</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Wheelbase</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->wheelbase }} mm</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Seating Capacity</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->seating_capacity }} seats</span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-100">
                                        <span class="text-gray-500">Cargo Volume</span>
                                        <span class="font-medium text-gray-900">{{ $vehicle->cargo_volume }} liters</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Vehicle History -->
                 <!-- Vehicle History -->
                 <!-- <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Vehicle History</h2>
                    <div class="flex items-center justify-between bg-green-50 p-4 rounded-lg border border-green-100 mb-4">
                        <div class="flex items-center">
                            <svg class="h-8 w-8 text-green-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-medium text-green-800">Clean Title</h3>
                                <p class="text-sm text-green-600">This vehicle has a clean title history with no reported accidents.</p>
                            </div>
                        </div>
                        <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">
                            View Report
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-base font-medium text-gray-900">No Reported Accidents</h4>
                                <p class="mt-1 text-sm text-gray-600">No accidents or damage reported in the vehicle's history.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-base font-medium text-gray-900">{{ $vehicle->owners }} Previous Owner(s)</h4>
                                <p class="mt-1 text-sm text-gray-600">The vehicle has had {{ $vehicle->owners }} previous owner(s) based on the registration information.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-base font-medium text-gray-900">Service History Available</h4>
                                <p class="mt-1 text-sm text-gray-600">Complete maintenance records are available upon request.</p>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
            
            <!-- Right Column - Dealer Info, Contact Form, Similar Vehicles -->
            <div class="lg:w-1/3">
                <!-- Dealer Information -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('/cars/icon.avif') }}" alt="{{ $vehicle->dealer->name }}" class="h-14 w-14 rounded-full object-cover border-2 border-gray-200">
                        <div class="ml-4">
                            <h2 class="text-lg font-bold text-gray-900">{{ $vehicle->dealer->name }}</h2>
                            <div class="flex items-center mt-1">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $vehicle->dealer->rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span class="ml-1 text-sm text-gray-600">({{ $vehicle->dealer->reviews_count }} reviews)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-sm text-gray-700">{{ $vehicle->dealer->address }}</p>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <p class="text-sm text-gray-700">{{ optional($vehicle->dealer)->contact_person_phone }}</p>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-gray-700">{{ $vehicle->dealer->email }}</p>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">Opening Hours:</span><br>
                                Mon-Fri: 8:00 AM - 6:00 PM<br>
                                Sat: 9:00 AM - 5:00 PM<br>
                                Sun: Closed
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('view.vehicle', $vehicle->dealer->id) }}" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                            View Dealer's Inventory
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <!-- <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Interested in this vehicle?</h2>
                    <p class="text-gray-600 mb-6">Contact the dealer directly to schedule a test drive or for more information.</p>
                    
                    <form wire:submit.prevent="submitInquiry">
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name*</label>
                                <input type="text" id="name" wire:model.defer="name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                                <input type="email" id="email" wire:model.defer="email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone*</label>
                                <input type="text" id="phone" wire:model.defer="phone" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message*</label>
                                <textarea id="message" wire:model.defer="message" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"></textarea>
                                @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="privacy" wire:model.defer="consent" type="checkbox" class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="privacy" class="text-gray-600">I agree to the <a href="#" class="text-green-600 hover:underline">privacy policy</a> and consent to being contacted by the dealer.</label>
                                    @error('consent') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                                    <svg wire:loading wire:target="submitInquiry" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span wire:loading.remove wire:target="submitInquiry">Contact Dealer</span>
                                    <span wire:loading wire:target="submitInquiry">Sending...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->



                <!-- Financing Options Section -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Financing Options</h2>
    <p class="text-gray-600 mb-6">Choose from our trusted financial partners to get the best loan terms for this vehicle.</p>
    
    <!-- Financing Card -->
    <div class="border border-gray-200 rounded-lg mb-6">
        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 rounded-t-lg">
            <h3 class="font-medium text-gray-900">Available Lenders</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($lenders as $lender)
            <div class="p-4 hover:bg-gray-50 transition-colors duration-150">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ asset('/cars/icon.avif') }}" alt="{{ $lender->name }}" class="h-10 w-10 object-contain mr-3">
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $lender->name }}</h4>
                            <div class="flex items-center mt-1 text-sm text-gray-600">
                                <span class="font-medium text-green-600">{{ $lender->interest_rate_range }}% </span>
                                <span class="mx-2">•</span>
                                <span>Terms up to {{ $lender->max_term }} months</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('loan.pre-qualify',[$vehicle->id,$lender->id]) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition-colors duration-150">
                        Apply Now
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
  
    
    <!-- Financing CTA -->
    <div class="mt-6 bg-green-50 p-4 rounded-lg border border-green-100">
        <div class="flex items-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h4 class="font-medium text-green-800 mb-1">Pre-qualify for Financing</h4>
                <p class="text-sm text-green-700 mb-3">Check your eligibility without affecting your credit score.</p>
                <a href=" " 
                   class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition-colors duration-150">
                    Check Eligibility
                </a>
            </div>
        </div>
    </div>
</div>


                
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <button wire:click="scheduleTestDrive" class="flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-800 font-medium p-4 rounded-lg transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Schedule Test Drive
                        </button>
                        <button wire:click="requestVideo" class="flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-800 font-medium p-4 rounded-lg transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Request Video
                        </button>
                        <button wire:click="calculateFinance" class="flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-800 font-medium p-4 rounded-lg transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Calculate Finance
                        </button>
                        <button wire:click="shareVehicle" class="flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-800 font-medium p-4 rounded-lg transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Share Vehicle
                        </button>
                    </div>
                </div>
                
                <!-- Similar Vehicles -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Similar Vehicles</h2>
                    <div class="space-y-4">
                        @foreach($similarVehicles as $similarVehicle)
                        <a href="{{ route('vehicle.list', $similarVehicle->id) }}" class="block hover:bg-gray-50 rounded-lg p-3 transition duration-300">
                            <div class="flex">
                                <img src="{{ asset('/cars/blue-car-driving-road.jpg') }}" alt="{{ $similarVehicle->make }} {{ $similarVehicle->model }}" class="w-20 h-20 object-cover rounded-lg">
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-medium text-gray-900 line-clamp-1">{{ $similarVehicle->year }} {{ $similarVehicle->make }} {{ $similarVehicle->model }}</h3>
                                    <p class="text-sm text-green-600 font-semibold">TZS {{ number_format($similarVehicle->price) }}</p>
                                    <p class="text-xs text-gray-500">{{ number_format($similarVehicle->mileage) }} km • 
                                    {{ optional($similarVehicle->transmission)->name }}
                                </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('vehicle.list', ['make' => $vehicle->make_id]) }}" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center justify-center">
                            View More
                            
                            {{ optional($vehicle->make)->name }} 
                            
                            Vehicles
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





</div>
