<div>
<!-- resources/views/livewire/vehicle-detail.blade.php -->
<div class="bg-white w-full">
    <!-- Breadcrumb -->
    <div class="bg-green-600 py-4 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="" class="inline-flex items-center text-sm font-medium text-white hover:text-green-600">
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
                            <a href="{{ route('vehicle.list') }}" class="ml-1 text-sm font-medium text-white hover:text-green-600 md:ml-2">Vehicles</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">{{ $vehicle->year }} 
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
           <!-- Left Column - Vehicle Images and Details -->
<div class="lg:w-2/3 mx-auto max-w-5xl">
    <!-- Vehicle Title & Price -->
    <div class="mb-8 border-b border-gray-200 pb-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">{{ $vehicle->year }} {{optional( $vehicle->make)->name }} {{ optional($vehicle->model)->name }} {{ $vehicle->trim }}</h1>
            <div class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-md">
                <span class="text-xl font-bold">TZS {{ number_format($vehicle->price) }}</span>
            </div>
        </div>
        <div class="flex items-center text-gray-600 mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>{{ $vehicle->location }}</span>
        </div>
    </div>
    
    <!-- Vehicle Images Gallery -->
   <!-- Vehicle Images Gallery -->
<div class="mb-10" x-data="{ activeSlide: 0, fitMode: 'contain' }">
    <!-- Main Image Container with Fixed Aspect Ratio -->
    <div class="relative rounded-xl overflow-hidden mb-4 bg-gray-100 shadow-md">
        <!-- Fixed aspect ratio container (16:9 ratio) -->
        <div class="relative w-full" style="padding-bottom: 56.25%;">
            @forelse($vehicle->images as $index => $image)
                <div x-show="activeSlide === {{ $index }}" class="absolute inset-0 w-full h-full">
                    <img src="{{ asset('storage/' . $image) }}" 
                         alt="Vehicle {{ $index + 1 }}" 
                         class="w-full h-full transition-all duration-300"
                         :class="fitMode === 'contain' ? 'object-contain' : 'object-cover'">
                </div>
            @empty
                <!-- Fallback image when no images are available -->
                <div class="absolute inset-0 w-full h-full">
                    <img src="{{ asset('cars/blue-car-driving-road.jpg') }}" 
                         alt="Vehicle Image Placeholder" 
                         class="w-full h-full object-cover">
                </div>
            @endforelse
            
            <!-- Only show navigation arrows if there are multiple images -->
            @if(count($vehicle->images) > 1)
                <!-- Navigation Arrows -->
                <button @click="activeSlide = activeSlide === 0 ? {{ count($vehicle->images) - 1 }} : activeSlide - 1" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-md focus:outline-none transition-colors duration-200 z-10">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="activeSlide = activeSlide === {{ count($vehicle->images) - 1 }} ? 0 : activeSlide + 1" 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-md focus:outline-none transition-colors duration-200 z-10">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @endif
            
            <!-- Controls Overlay -->
            <div class="absolute bottom-3 left-0 right-0 flex justify-between items-center px-4 z-10">
                <!-- Image View/Position Label -->
                @if(count($vehicle->images) > 0)
                    <div class="bg-black/50 text-white text-xs px-3 py-1 rounded-full">
                        <span x-text="(activeSlide + 1) + ' / ' + {{ count($vehicle->images) }}"></span>
                        @foreach($vehicle->images as $index => $image)
                            <span x-show="activeSlide === {{ $index }} && '{{ $image->view ?? '' }}'">
                                - {{ ucfirst($image->view ?? '') }} View
                            </span>
                        @endforeach
                    </div>
                    
                    <!-- Fit/Fill Toggle Button -->
                    <button @click="fitMode = fitMode === 'contain' ? 'cover' : 'contain'" 
                            class="bg-black/50 hover:bg-black/70 text-white text-xs px-3 py-1 rounded-full transition-colors duration-200">
                        <span x-text="fitMode === 'contain' ? 'Fill' : 'Fit'"></span>
                    </button>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Thumbnails with Fixed Height -->
    @if(count($vehicle->images) > 1)
        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-2">
            @foreach($vehicle->images as $index => $image)
                <button @click="activeSlide = {{ $index }}" class="focus:outline-none">
                    <div class="relative aspect-w-4 aspect-h-3 rounded-md overflow-hidden group">
                        <img src="{{ asset('storage/' . $image) }}" 
                             alt="Thumbnail {{ $index + 1 }}" 
                             class="w-full h-full object-cover transition-all duration-200"
                             :class="activeSlide === {{ $index }} ? 'ring-2 ring-green-600' : 'ring-1 ring-gray-200 group-hover:ring-gray-300'">
                             
                        @if(isset($image->view) && !empty($image->view))
                            <div class="absolute bottom-0 inset-x-0 bg-black/50 text-white text-xs text-center py-0.5 capitalize">
                                {{ $image->view }}
                            </div>
                        @endif
                        
                        <!-- Active indicator overlay -->
                        <div x-show="activeSlide === {{ $index }}" class="absolute inset-0 bg-green-600/10"></div>
                    </div>
                </button>
            @endforeach
        </div>
    @endif
</div>




    <!-- Quick Specs Banner -->
    <div class="flex flex-wrap justify-between mb-8 bg-gray-50 p-4 rounded-xl border border-gray-100 shadow-sm">
        <div class="flex items-center px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div>
                <div class="text-xs text-gray-500">Year</div>
                <div class="font-semibold">{{ $vehicle->year }}</div>
            </div>
        </div>
        <div class="flex items-center px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <div class="text-xs text-gray-500">Mileage</div>
                <div class="font-semibold">{{ number_format($vehicle->mileage) }} km</div>
            </div>
        </div>
        <div class="flex items-center px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <div>
                <div class="text-xs text-gray-500">Fuel Type</div>
                <div class="font-semibold">{{ $vehicle->fuel_type }}</div>
            </div>
        </div>
        <div class="flex items-center px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <div>
                <div class="text-xs text-gray-500">Transmission</div>
                <div class="font-semibold">{{optional($vehicle->transmission)->name }}</div>
            </div>
        </div>
    </div>
    
    <!-- Vehicle Features Tabs -->
    <div class="mb-10 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ activeTab: 'overview' }">
        <!-- Tab Navigation -->
        <div class="flex border-b border-gray-200">
            <button @click="activeTab = 'overview'" :class="{ 'border-green-600 text-green-600': activeTab === 'overview', 'border-transparent text-gray-500 hover:text-gray-700': activeTab !== 'overview' }" 
                class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm sm:text-base transition-colors duration-200 ease-out">
                Overview
            </button>
           
            <button @click="activeTab = 'specifications'" :class="{ 'border-green-600 text-green-600': activeTab === 'specifications', 'border-transparent text-gray-500 hover:text-gray-700': activeTab !== 'specifications' }" 
                class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm sm:text-base transition-colors duration-200 ease-out">
                Specifications
            </button>
            
        </div>
        
        <!-- Tab Content -->
        <div class="p-6">
            <!-- Overview Tab -->
            <div x-show="activeTab === 'overview'" class="space-y-6 animate-fadeIn">
                <p class="text-gray-700 leading-relaxed">{{ $vehicle->description }}</p>
                
                <!-- Key Specs Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Condition</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->condition }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Year</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->year }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Body Type</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->body_type }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Color</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->color }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Engine</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->engine_size }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Drive Type</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->drivetrain }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Power</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->horsepower }} hp</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="text-gray-500 text-sm mb-1">Seats</div>
                        <div class="font-semibold text-gray-900">{{ $vehicle->seating_capacity }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Features Tab -->
            <div x-show="activeTab === 'features'" class="animate-fadeIn">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    @foreach($vehicle->features as $feature)
                    <div class="flex items-center py-2 px-3 rounded-lg hover:bg-gray-50 transition duration-300">
                        <svg class="h-5 w-5 text-green-600 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-800">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Specifications Tab -->
            <div x-show="activeTab === 'specifications'" class="space-y-8 animate-fadeIn">
                <!-- Engine & Performance -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Engine & Performance
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 rounded-xl p-4">
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Engine Type</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->engine_type }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Engine Size</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->engine_size }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Fuel Type</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->fuel_type }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Transmission</span>
                            <span class="font-medium text-gray-900">{{ optional($vehicle->transmission)->name }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Power</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->horsepower }} hp</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Drivetrain</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->drivetrain }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Dimensions -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                        Dimensions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 rounded-xl p-4">
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Length</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->length }} mm</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Width</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->width }} mm</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Height</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->height }} mm</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Wheelbase</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->wheelbase }} mm</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Seating Capacity</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->seating_capacity }} seats</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-200">
                            <span class="text-gray-600">Cargo Volume</span>
                            <span class="font-medium text-gray-900">{{ $vehicle->cargo_volume }} liters</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact & Action Buttons -->
    <!-- <div class="flex flex-col md:flex-row justify-between gap-4 mb-10">
        <button class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            Contact Seller
        </button>
        <button class="flex-1 bg-white hover:bg-gray-50 text-green-600 border border-green-600 font-medium py-3 px-6 rounded-lg shadow-sm transition duration-300 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            Share Listing
        </button>
        <button class="flex-1 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 font-medium py-3 px-6 rounded-lg shadow-sm transition duration-300 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            Save to Favorites
        </button>
    </div> -->
    
    <!-- Similar Vehicles -->
    <div class="mb-10">
        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
            Similar Vehicles
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Similar Vehicle Card 1 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <img src="{{ asset('/cars/blue-car-driving-road.jpg') }}" alt="Similar Vehicle" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="font-medium text-gray-900 mb-1">2022 Toyota Corolla LE</h3>
                    <div class="text-green-600 font-bold mb-2">TZS 23,500,000</div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>35,000 km</span>
                        <span>Automatic</span>
                        <span>Petrol</span>
                    </div>
                </div>
            </div>
            
            <!-- Similar Vehicle Card 2 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <img src="{{ asset('/cars/blue-car-driving-road.jpg') }}" alt="Similar Vehicle" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="font-medium text-gray-900 mb-1">2023 Honda Civic EX</h3>
                    <div class="text-green-600 font-bold mb-2">TZS 28,900,000</div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>20,000 km</span>
                        <span>CVT</span>
                        <span>Petrol</span>
                    </div>
                </div>
            </div>
            
            <!-- Similar Vehicle Card 3 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <img src="{{ asset('/cars/blue-car-driving-road.jpg') }}" alt="Similar Vehicle" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="font-medium text-gray-900 mb-1">2021 Mazda 3 Touring</h3>
                    <div class="text-green-600 font-bold mb-2">TZS 26,200,000</div>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>45,000 km</span>
                        <span>Automatic</span>
                        <span>Petrol</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add custom styles for animations -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fadeIn {
            animation: fadeIn 0.4s ease-in-out;
        }
    </style>
</div>


           <!-- Right Column - Dealer Info, Financing, Quick Actions, Similar Vehicles -->
<div class="lg:w-1/3 space-y-8">
    <!-- Dealer Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header with background -->
        <div class="bg-gradient-to-r from-green-600/10 to-green-600/5 p-6 border-b border-gray-100">
            <div class="flex items-center">
                <img src="{{ asset('/cars/icon.avif') }}" alt="{{optional( $vehicle->dealer)->name }}" class="h-16 w-16 rounded-full object-cover border-2 border-white shadow-md">
                <div class="ml-4">
                    <h2 class="text-lg font-bold text-gray-900">{{optional($vehicle->dealer)->name }}</h2>
                    <div class="flex items-center mt-1">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= optional($vehicle->dealer)->rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ml-1 text-sm text-gray-600">({{optional($vehicle->dealer)->reviews_count }} reviews)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Info -->
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Address</p>
                        <p class="text-sm text-gray-600 mt-1">{{ optional($vehicle->dealer)->address }}</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Phone</p>
                        <p class="text-sm text-gray-600 mt-1">{{ optional($vehicle->dealer)->contact_person_phone }}</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Email</p>
                        <p class="text-sm text-gray-600 mt-1">{{ optional($vehicle->dealer)->email }}</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Opening Hours</p>
                        <div class="text-sm text-gray-600 mt-1">
                            <div class="grid grid-cols-2 gap-1">
                                <span>Monday - Friday:</span>
                                <span>8:00 AM - 6:00 PM</span>
                                <span>Saturday:</span>
                                <span>9:00 AM - 5:00 PM</span>
                                <span>Sunday:</span>
                                <span>Closed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Button -->
            <div class="mt-6">
    @php
        // Format phone number for WhatsApp (remove spaces, hyphens, etc.)
        $phoneNumber = preg_replace('/[^0-9]/', '', optional($vehicle->dealer)->contact_person_phone ?? '');
        
        // If phone number doesn't start with country code, add Tanzania's code (+255)
        if(strlen($phoneNumber) > 0 && !Str::startsWith($phoneNumber, '255') && Str::startsWith($phoneNumber, '0')) {
            $phoneNumber = '255' . substr($phoneNumber, 1);
        }
        
        // Text message template
        $message = "Hello, I'm interested in your " . $vehicle->year . " " . optional($vehicle->make)->name . " " . 
                   optional($vehicle->model)->name . " (VIN: " . $vehicle->vin . ") listed for TZS " . 
                   number_format($vehicle->price, 0) . ". Is it still available?";
        
        // Encode message for URL
        $encodedMessage = urlencode($message);
        
        // Generate WhatsApp URL
        $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
    @endphp

    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" 
       class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg 
              transition duration-300 flex items-center justify-center group">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" 
             class="h-5 w-5 mr-2 fill-current transition-transform duration-300 group-hover:scale-110">
            <!-- WhatsApp icon (FontAwesome style) -->
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
        </svg>
        Chat on WhatsApp
    </a>

    @if(!empty(optional($vehicle->dealer)->contact_person_phone))
        <div class="flex justify-between items-center mt-2">
            <p class="text-sm text-gray-600">
                {{ optional($vehicle->dealer)->contact_person_phone }}
            </p>
            
            <p class="text-xs text-gray-500">
                {{ optional($vehicle->dealer)->contact_person_name ?? 'Dealer' }}
            </p>
        </div>
    @endif
</div>



            
            <!-- View Inventory Link -->
            <div class="mt-4 text-center">
                <a href="{{ url('vehicle/list') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition duration-300">
                    View Dealer's Inventory
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Financing Options Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-600/10 to-green-600/5 p-6 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Financing Options
            </h2>
            <p class="text-gray-600 mt-2">Get pre-approved with our trusted financing partners</p>
        </div>
        
        <div class="p-6">
            <!-- Financing Cards -->
            <div class="space-y-4">
                @foreach($lenders as $lender)
                <div class="border border-gray-200 rounded-lg hover:border-green-200 transition-colors duration-300 overflow-hidden">
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center p-2">
                                <img src="{{ asset('/cars/icon.avif') }}" alt="{{ $lender->name }}" class="max-h-full max-w-full object-contain">
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-gray-900">{{ $lender->name }}</h4>
                                <div class="flex items-center mt-1">
                                    <span class="font-medium text-green-600 text-sm">{{ $lender->interest_rate_range }}%</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-gray-600 text-sm">Up to {{ $lender->max_term }} months</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('loan.pre-qualify',[$vehicle->id,$lender->id]) }}" 
                           class="bg-white hover:bg-green-50 text-green-600 border border-green-600 font-medium py-2 px-4 rounded-lg text-sm transition-colors duration-300">
                            Apply
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
           
            
            <!-- Financing CTA -->
            <div class="mt-6 bg-green-50 p-4 rounded-lg border border-green-100">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div>
                        <h4 class="font-medium text-green-800 mb-1">Pre-qualify for Financing</h4>
                        <p class="text-sm text-green-700">Check your eligibility without affecting your credit score.</p>
                        <a href="#" class="inline-flex items-center mt-2 text-sm font-medium text-green-700 hover:text-green-800">
                            Learn more 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <!-- <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-600/10 to-green-600/5 p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Quick Actions
            </h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                <button wire:click="scheduleTestDrive" class="relative group">
                    <div class="absolute inset-0 bg-green-200 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex flex-col items-center justify-center bg-gray-50 border border-gray-200 group-hover:border-green-300 text-gray-800 font-medium p-5 rounded-lg transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span>Schedule Test Drive</span>
                    </div>
                </button>
                
                <button wire:click="requestVideo" class="relative group">
                    <div class="absolute inset-0 bg-green-200 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex flex-col items-center justify-center bg-gray-50 border border-gray-200 group-hover:border-green-300 text-gray-800 font-medium p-5 rounded-lg transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Request Video</span>
                    </div>
                </button>
                
                <button wire:click="calculateFinance" class="relative group">
                    <div class="absolute inset-0 bg-green-200 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex flex-col items-center justify-center bg-gray-50 border border-gray-200 group-hover:border-green-300 text-gray-800 font-medium p-5 rounded-lg transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span>Calculate Finance</span>
                    </div>
                </button>
                
                <button wire:click="shareVehicle" class="relative group">
                    <div class="absolute inset-0 bg-green-200 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex flex-col items-center justify-center bg-gray-50 border border-gray-200 group-hover:border-green-300 text-gray-800 font-medium p-5 rounded-lg transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span>Share Vehicle</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
     -->
   
    
    <!-- Trade-In Promotion Banner -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl shadow-md overflow-hidden">
        <div class="p-6 text-white">
            <h3 class="text-lg font-bold mb-2">Trade In Your Vehicle</h3>
            <p class="text-green-100 mb-4">Get an instant offer for your current vehicle and apply it toward this purchase!</p>
            <button class="bg-white text-green-700 hover:bg-green-50 font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center">
                Get Trade-In Value
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />

        </svg>
    </div>
</div>
</div>
        </div>
    </div>
</div>





</div>
