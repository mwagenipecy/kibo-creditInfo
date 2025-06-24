<div>


<!-- resources/views/livewire/home-page.blade.php -->
<div class="bg-white w-full">
    <!-- Hero Section with Slideshow -->
<!-- Enhanced Hero Section with Professional Styling and Balanced Height -->
<div class="relative" 
     x-data="{ 
        activeSlide: 0, 
        slides: [
            { 
                image: '{{ asset('/cars/66815.jpg') }}', 
                title: 'Find Your Dream Car', 
                description: 'Browse our exclusive collection of premium vehicles', 
                buttonText: 'Explore Now' 
            },
            { 
                image: '{{ asset('/cars/11452727.png') }}', 
                title: 'Connect With Top Dealers', 
                description: 'Direct access to the most trusted dealers in the country', 
                buttonText: 'View Dealers' 
            },
            { 
                image: '{{ asset('//default/car1.jpg') }}', 
                title: 'Best Deals Guaranteed', 
                description: 'Quality vehicles at competitive prices', 
                buttonText: 'See Deals' 
            }
        ],
        play() {
            this.slideInterval = setInterval(() => {
                this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1;
            }, 6000);
        },
        pause() {
            clearInterval(this.slideInterval);
        }
     }" 
     x-init="play()"
     @mouseenter="pause()"
     @mouseleave="play()">
    
    <!-- Slideshow Container with Balanced Height -->
    <div class="relative h-[450px] md:h-[500px] w-full overflow-hidden">
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" 
                x-transition:enter="transition ease-out duration-800" 
                x-transition:enter-start="opacity-0 transform scale-105" 
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-500" 
                x-transition:leave-start="opacity-100 transform scale-100" 
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute inset-0">
                
                <!-- Image with Overlay -->
                <div class="relative h-full">
                    <!-- Base Image -->
                    <img :src="slide.image" class="w-full h-full object-cover" :alt="slide.title">
                    
                    <!-- Custom Overlay with Left-to-Center Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 via-black/60 to-black/40"></div>
                    
                    <!-- Additional Vignette Effect -->
                    <div class="absolute inset-0 bg-radial-gradient"></div>
                </div>
                
                <!-- Content Container - Left Aligned -->
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-6 md:px-12">
                        <div class="max-w-xl ml-0 md:ml-12 text-left">
                            <!-- Decorative Element -->
                            <div class="w-20 h-1.5 bg-green-500 mb-4 rounded shadow-glow-green"></div>
                            
                            <!-- Title with Text Shadow - Slightly Reduced Size -->
                            <h1 x-text="slide.title" 
                                class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight tracking-tight text-shadow-lg"></h1>
                            
                            <!-- Description with Enhanced Shadow - Slightly Reduced Size -->
                            <p x-text="slide.description" 
                               class="text-base md:text-lg text-gray-100 mb-6 max-w-lg text-shadow-sm"></p>
                            
                            <!-- Button with Enhanced Style -->
                            <button x-text="slide.buttonText" 
                                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg text-md font-semibold transition-all duration-300 transform hover:-translate-y-0.5 shadow-xl hover:shadow-2xl hover:shadow-green-600/30 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"></button>
                            
                            <!-- Slide Number Indicator - Slightly Reduced Size -->
                            <div class="hidden md:flex items-center mt-6 text-gray-300 text-sm">
                                <span class="text-lg font-bold text-green-500" x-text="`0${index + 1}`"></span>
                                <span class="mx-2">/</span>
                                <span x-text="`0${slides.length}`"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        
        <!-- Decorative Element - Bottom Right -->
        <div class="absolute bottom-0 right-0 w-1/3 h-16 bg-gradient-to-tl from-green-600/20 to-transparent"></div>
    </div>
    
    <!-- Enhanced Slide Indicators - Repositioned -->
    <div class="absolute bottom-6 left-0 right-0">
        <div class="container mx-auto px-6 md:px-12">
            <div class="flex space-x-3 md:ml-12">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index" 
                        :class="{ 
                            'w-10 bg-green-500 shadow-md shadow-green-500/50': activeSlide === index, 
                            'w-5 bg-white/40 hover:bg-white/60': activeSlide !== index 
                        }"
                        class="h-1.5 rounded-full transition-all duration-300 focus:outline-none"></button>
                </template>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Arrow Navigation - Slightly Reduced Size -->
    <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" 
        class="absolute left-6 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center rounded-full bg-black/20 backdrop-blur-sm text-white hover:bg-green-600/70 transition-all duration-300 focus:outline-none border border-white/20 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" 
        class="absolute right-6 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center rounded-full bg-black/20 backdrop-blur-sm text-white hover:bg-green-600/70 transition-all duration-300 focus:outline-none border border-white/20 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>

<style>
/* Custom radial gradient for vignette effect */
.bg-radial-gradient {
    background: radial-gradient(circle at center, transparent 0%, rgba(0, 0, 0, 0.3) 100%);
}

/* Text shadow utilities */
.text-shadow-lg {
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
}

.text-shadow-sm {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

/* Glow effect for green elements */
.shadow-glow-green {
    box-shadow: 0 0 15px rgba(16, 185, 129, 0.5);
}
</style>








    <!-- Quick Filter and Search Section -->
  <!-- Enhanced Vehicle Search Section -->
<section class="bg-gradient-to-b from-gray-50 to-white py-6 sm:py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <!-- Heading with Search Icon -->
            <div class="bg-gray-50 py-4 px-6 border-b border-gray-100">
                <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">Find Your Perfect Vehicle</h2>
                </div>
            </div>
            
            <!-- Search Form -->
            <div class="p-5">
                <!-- Main Search Fields -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-x-4 gap-y-4">
                    <!-- Make Dropdown -->
                    <div>
                        <label for="make" class="block text-xs font-medium text-gray-600 mb-1.5">Make</label>
                        <div class="relative">
                            <select 
                                wire:model="selectedMake" 
                                id="make" 
                                class="w-full rounded border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm"
                            >
                                <option value="">All Makes</option>
                                @foreach($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        
                        </div>
                    </div>
                    
                    <!-- Model Dropdown -->
                    <div>
                        <label for="model" class="block text-xs font-medium text-gray-600 mb-1.5">Model</label>
                        <div class="relative">
                            <select 
                                wire:model="selectedModel" 
                                id="model" 
                                class="w-full rounded border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm"
                            >
                                <option value="">All Models</option>
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                           
                        </div>
                    </div>
                    
                    <!-- Price Range Dropdown -->
                    <div>
                        <label for="price" class="block text-xs font-medium text-gray-600 mb-1.5">Price Range</label>
                        <div class="relative">
                            <select 
                                wire:model="priceRange" 
                                id="price" 
                                class="w-full rounded border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm"
                            >
                                <option value="">Any Price</option>
                                <option value="0-5000000">Under 5M</option>
                                <option value="5000000-15000000">5M - 15M</option>
                                <option value="15000000-30000000">15M - 30M</option>
                                <option value="30000000-50000000">30M - 50M</option>
                                <option value="50000000-999999999">Over 50M</option>
                            </select>
                         
                        </div>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button 
                            wire:click="searchVehicles" 
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition duration-150 flex justify-center items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            Search
                        </button>
                    </div>
                </div>
                
                <!-- Advanced Search Toggle -->
                <div class="mt-4 pt-3 border-t border-gray-100">
                    <button type="button" class="flex items-center text-xs text-gray-600 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Advanced Filters
                    </button>
                </div>
                
                <!-- Popular Searches -->
                <div class="mt-3">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs text-gray-500">Popular:</span>
                        <a href="{{ url('vehicle/list') }}" class="text-xs text-blue-600 hover:text-blue-800 hover:underline">SUVs</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ url('vehicle/list') }}" class="text-xs text-blue-600 hover:text-blue-800 hover:underline">Under 10M</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ url('vehicle/list') }}" class="text-xs text-blue-600 hover:text-blue-800 hover:underline">Toyota</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ url('vehicle/list') }}" class="text-xs text-blue-600 hover:text-blue-800 hover:underline">Automatic</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Featured Vehicles Section -->
    <div class="py-4 bg-white">
        <div class="container mx-auto px-4">
           
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredVehicles as $vehicle)
                
                <div class="bg-white rounded-lg shadow overflow-hidden group hover:shadow-md transition duration-200">
    <!-- Vehicle Image Section -->
    <div class="relative aspect-[16/9] overflow-hidden">


    @php
    $frontImage = $vehicle->frontView();
@endphp

        <img 
            src="{{ $frontImage ? asset('storage/' . $frontImage->image_url) : asset('/default/car1.jpg') }}"
            alt="{{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}"
            class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
        />
        
        <!-- Tags & Badge Overlays -->
        <div class="absolute top-2 left-2 flex flex-col gap-1.5">
            @if($vehicle->featured)
            <span class="inline-flex items-center px-2 py-1 bg-green-600 bg-opacity-90 text-white text-xs font-medium rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Featured
            </span>
            @endif
            
            <span class="inline-flex items-center px-2 py-1 bg-black bg-opacity-70 text-white text-xs font-medium rounded">
                {{ $vehicle->year }}
            </span>
        </div>
        
        <!-- Price Tag -->
        <div class="absolute bottom-0 right-0 bg-white py-1 px-2 rounded-tl-lg shadow-md font-bold text-green-600">
            TZS {{ number_format($vehicle->price) }}
        </div>
    </div>
    
    <!-- Vehicle Details Section -->
    <div class="p-3">
        <!-- Vehicle Title -->
        <div class="mb-2">
            <h3 class="font-semibold text-gray-800 leading-tight truncate">
                {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }} {{ $vehicle->trim }}
            </h3>
            <div class="flex items-center justify-between mt-0.5">
                <span class="text-xs text-gray-500">{{ $vehicle->mileage }} km</span>
                <span class="text-xs font-medium text-gray-600">{{ optional($vehicle->transmission)->name }}</span>
            </div>
        </div>
        
        <!-- Main Specs Grid -->
        <div class="grid grid-cols-2 gap-1.5 mb-2.5 text-xs">
            <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H11a1 1 0 001-1v-1h3.05a2.5 2.5 0 014.9 0H20a1 1 0 001-1V5a1 1 0 00-1-1H3z" />
                </svg>
                {{ optional($vehicle->bodyType)->name ?? 'Not specified' }}
            </div>
            <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                </svg>
                {{ optional($vehicle->fuelType)->name ?? 'Not specified' }}
            </div>
            <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                {{ $vehicle->created_at->diffForHumans() }}
            </div>
            <div class="flex items-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                {{ $vehicle->location ?? 'Not specified' }}
            </div>
        </div>
        
        <!-- Dealership Info + View Details -->
        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
            <div class="flex items-center">
                <img src="{{ asset('/cars/icon.avif') }}" alt="{{ optional($vehicle->dealer)->name }}" class="w-7 h-7 rounded-full object-cover border border-gray-200">
                <p class="ml-2 text-xs font-medium text-gray-700 truncate max-w-[100px]">{{ optional($vehicle->dealer)->name }}</p>
            </div>
            
            <a href="{{ route('view.vehicle', $vehicle->id) }}" class="inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-800 transition">
                Details
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-0.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>

                @endforeach
            </div>
            
            <div class="mt-12 text-center">
                <a href="{{ route('vehicle.list') }}" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    View All Vehicles
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>





 <!-- Top Dealers Section - Clear and Professional -->
<section class="py-10 bg-white">
    <div class="container mx-auto px-4">
        <!-- Simple Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Featured Dealers</h2>
            <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700">View All Dealers →</a>
        </div>
        
        <!-- Dealers Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($topDealers as $dealer)
            <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
                <!-- Header with Location -->
                <div class="p-4 border-b border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $dealer->name }}</h3>
                            <p class="text-xs text-gray-500 flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $dealer->region }} - {{ $dealer->city }}
                            </p>
                        </div>
                        <img src="{{ asset('/cars/icon.avif') }}" alt="{{ $dealer->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    </div>
                </div>
                
                <!-- Stats -->
                <div class="flex divide-x divide-gray-100">
                    <div class="flex-1 p-3 text-center">
                        <div class="text-sm font-medium text-gray-900">{{ $dealer->dealerCarCount() }}</div>
                        <div class="text-xs text-gray-500">Vehicles</div>
                    </div>
                    <div class="flex-1 p-3 text-center">
                        <div class="flex items-center justify-center">
                            <span class="text-sm font-medium text-gray-900 mr-1">{{ $dealer->rateCarDealer() }} /10</span>
                            <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <div class="text-xs text-gray-500">Rating</div>
                    </div>
                </div>
                
                <!-- Action Link -->
                <a href="{{ route('vehicle.list') }}" class="block text-center py-2 text-sm font-medium text-green-600 hover:text-green-700 hover:bg-green-50 transition-colors duration-150 border-t border-gray-100">
                    Browse Inventory
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>



   <!-- Why Choose Us - Clean & Professional -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Clean Header -->
        <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-6">
            <h2 class="text-xl font-bold text-gray-800">Our Advantages</h2>
        </div>
        
        <!-- Features Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Verified Dealers -->
            <div class="bg-white p-5 rounded border border-gray-200">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Verified Dealers</h3>
                </div>
                <p class="text-sm text-gray-600">All our dealers are verified for reliability and quality service.</p>
            </div>
            
            <!-- Secure Transactions -->
            <div class="bg-white p-5 rounded border border-gray-200">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Secure Transactions</h3>
                </div>
                <p class="text-sm text-gray-600">Your interactions and payments are protected on our platform.</p>
            </div>
            
            <!-- Expert Support -->
            <div class="bg-white p-5 rounded border border-gray-200">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Expert Support</h3>
                </div>
                <p class="text-sm text-gray-600">Our automotive experts are ready to assist with any questions.</p>
            </div>
        </div>
    </div>
</section>



    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">What Our Customers Say</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Hear from people who found their perfect vehicles through our platform</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
               
               <div class="bg-white rounded-xl shadow-md p-6 relative">
                    <div class="absolute -top-4 left-6 text-green-600">
                        <svg class="w-8 h-8 text-green-600 opacity-25" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                    </div>
                    <p class="mt-4 text-gray-600 italic">I found my dream Toyota Land Cruiser on this platform within days of searching. The connection with the dealer was seamless and the entire process was smooth.</p>
                    <div class="mt-6 flex items-center">
                        <img src="{{ asset('/cars/icon.avif') }}" alt="Customer" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-3">
                            <h4 class="text-base font-semibold text-gray-900">Michael Johnson</h4>
                            <div class="flex mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= 5 ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>



                
                <div class="bg-white rounded-xl shadow-md p-6 relative">
                    <div class="absolute -top-4 left-6 text-green-600">
                        <svg class="w-8 h-8 text-green-600 opacity-25" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                    </div>
                    <p class="mt-4 text-gray-600 italic">As a first-time car buyer, I appreciated the detailed information provided for each vehicle. It made my decision much easier and I'm very happy with my purchase.</p>
                    <div class="mt-6 flex items-center">
                        <img src="{{ asset('/cars/icon.avif') }}" alt="Customer" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-3">
                            <h4 class="text-base font-semibold text-gray-900">David Mwangi</h4>
                            <div class="flex mt-1">


                                @for($i = 1; $i <= 5; $i++)

                                    <svg class="w-4 h-4 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor


                            </div>
                        </div>
                    </div>
                </div>



                <div class="bg-white rounded-xl shadow-md p-6 relative">
    <div class="absolute -top-4 left-6 text-green-600">
        <svg class="w-8 h-8 text-green-600 opacity-25" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
        </svg>
    </div>

    <p class="mt-4 text-gray-600 italic">
        Kibo Auto made the car buying process smooth and stress-free. Their team was helpful and transparent, and I found exactly what I was looking for.
    </p>

    <div class="mt-6 flex items-center">
        <img src="{{ asset('/cars/icon.avif') }}" alt="Customer" class="w-12 h-12 rounded-full object-cover">
        <div class="ml-3">
            <h4 class="text-base font-semibold text-gray-900">Aisha Mwakalinga</h4>
            <div class="flex mt-1">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= 5 ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @endfor
            </div>
        </div>
    </div>
</div>








            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-16 bg-green-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Find Your Perfect Vehicle?</h2>
            <p class="text-xl text-green-100 mb-8 max-w-3xl mx-auto">Browse our extensive collection of quality vehicles from trusted dealers across the country.</p>
            <a href="{{ route('vehicle.list') }}" class="inline-block bg-white hover:bg-gray-100 text-green-700 font-bold py-3 px-8 rounded-lg text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                Start Browsing Now
            </a>
        </div>
    </div>
</div>


                                    

</div>
