<div>



<!-- resources/views/livewire/vehicle-listings.blade.php -->
<div class="bg-white w-full">
    <!-- Page Header -->
    <div class="bg-green-700 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Browse Vehicles</h1>
            <p class="text-green-100 text-lg">Find the perfect vehicle from our extensive collection</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4 bg-white rounded-xl shadow-md p-6 self-start sticky top-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Filters</h2>
                    <button wire:click="resetFilters" class="text-sm text-green-600 hover:text-green-800 font-medium">
                        Reset All
                    </button>
                </div>
                
                <!-- Filter sections -->
                <div class="space-y-6">
                    <!-- Make Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Make</h3>
                        <div class="space-y-2 max-h-48 overflow-y-auto pr-2">
                            @foreach($makes as $make)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedMakes" value="{{ $make->id }}" 
                                    class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-700">{{ $make->name }} ({{ $make->count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Model Filter - Appears if make is selected -->
                    @if(count($selectedMakes) > 0)
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Model</h3>
                        <div class="space-y-2 max-h-48 overflow-y-auto pr-2">
                            @foreach($models as $model)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedModels" value="{{ $model->id }}" 
                                    class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-700">{{ $model->name }} ({{ $model->count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Price Range Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Price Range</h3>
                        <div class="space-y-3 px-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">TZS {{ number_format($minPrice) }}</span>
                                <span class="text-sm text-gray-600">TZS {{ number_format($maxPrice) }}</span>
                            </div>
                            <div class="relative">
                                <input type="range" wire:model="priceMin" min="{{ $minPrice }}" max="{{ $maxPrice }}" 
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                <input type="range" wire:model="priceMax" min="{{ $minPrice }}" max="{{ $maxPrice }}" 
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer absolute top-0">
                            </div>
                            <div class="flex justify-between">
                                <div class="w-2/5">
                                    <label class="text-xs text-gray-500 mb-1 block">Min Price</label>
                                    <input type="number" wire:model="priceMin" min="{{ $minPrice }}" max="{{ $priceMax }}" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-sm">
                                </div>
                                <div class="w-2/5">
                                    <label class="text-xs text-gray-500 mb-1 block">Max Price</label>
                                    <input type="number" wire:model="priceMax" min="{{ $priceMin }}" max="{{ $maxPrice }}" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Year Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Year</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="text-xs text-gray-500 mb-1 block">From</label>
                                <select wire:model="yearFrom" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-sm">
                                    <option value="">Any</option>
                                    @foreach(range(date('Y'), 2000) as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1 block">To</label>
                                <select wire:model="yearTo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-sm">
                                    <option value="">Any</option>
                                    @foreach(range(date('Y'), 2000) as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Body Type Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Body Type</h3>
                        <div class="space-y-2">
                            @foreach($bodyTypes as $bodyType)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedBodyTypes" value="{{ $bodyType->id }}" 
                                    class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-700">{{ $bodyType->name }} ({{ $bodyType->count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Fuel Type Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Fuel Type</h3>
                        <div class="space-y-2">
                            @foreach($fuelTypes as $fuelType)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedFuelTypes" value="{{ $fuelType->id }}" 
                                    class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-700">{{ $fuelType->name }} ({{ $fuelType->count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Transmission Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Transmission</h3>
                        <div class="space-y-2">
                            @foreach($transmissions as $transmission)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedTransmissions" value="{{ $transmission->id }}" 
                                    class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-700">{{ $transmission->name }} ({{ $transmission->count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Mileage Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Mileage (km)</h3>
                        <select wire:model="maxMileage" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <option value="">Any Mileage</option>
                            <option value="10000">Under 10,000 km</option>
                            <option value="50000">Under 50,000 km</option>
                            <option value="100000">Under 100,000 km</option>
                            <option value="150000">Under 150,000 km</option>
                            <option value="200000">Under 200,000 km</option>
                        </select>
                    </div>
                    
                    <!-- Dealer Filter -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-2">Dealers</h3>
                        <div class="space-y-2 max-h-48 overflow-y-auto pr-2">
                            @foreach($dealers as $dealer)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedDealers" value="{{ $dealer->id }}" 
                                    class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-700">{{ $dealer->name }} ({{ $dealer->count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="pt-4">
                        <button wire:click="applyFilters" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Results Area -->
            <div class="lg:w-3/4">
                <!-- Sort and View Options -->
                <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
                        <!-- Results count and pagination info -->
                        <div>
                            <p class="text-gray-600">
                                Showing <span class="font-semibold">{{ $vehicles->firstItem() ?? 0 }}</span> 
                                to <span class="font-semibold">{{ $vehicles->lastItem() ?? 0 }}</span> 
                                of <span class="font-semibold">{{ $vehicles->total() }}</span> vehicles
                            </p>
                        </div>
                        
                        <!-- Sorting and display options -->
                        <div class="flex items-center space-x-4">
                            <div>
                                <label for="sortOrder" class="text-sm text-gray-600 mr-2">Sort:</label>
                                <select id="sortOrder" wire:model="sortBy" class="rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    <option value="newest">Newest First</option>
                                    <option value="oldest">Oldest First</option>
                                    <option value="price_low">Price: Low to High</option>
                                    <option value="price_high">Price: High to Low</option>
                                    <option value="mileage_low">Mileage: Low to High</option>
                                    <option value="year_new">Year: Newest First</option>
                                </select>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <button wire:click="$set('viewType', 'grid')" class="{{ $viewType === 'grid' ? 'text-green-600' : 'text-gray-400' }} hover:text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </button>
                                <button wire:click="$set('viewType', 'list')" class="{{ $viewType === 'list' ? 'text-green-600' : 'text-gray-400' }} hover:text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Active Filters -->
                @if($hasActiveFilters)
                <div class="bg-green-50 rounded-xl border border-green-100 p-4 mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-sm font-medium text-green-800">Active Filters</h3>
                        <button wire:click="resetFilters" class="text-xs text-green-600 hover:text-green-800 font-medium">
                            Clear All
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if(count($selectedMakes) > 0)
                            @foreach($activeFilters['makes'] as $make)
                                <span class="inline-flex items-center bg-white border border-gray-200 rounded-full px-3 py-1 text-sm">
                                    <span class="text-gray-600">Make: {{ $make }}</span>
                                    <button wire:click="removeFilter('make', '{{ $make }}')" class="ml-1 text-gray-400 hover:text-gray-600">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                            @endforeach
                        @endif
                        
                        <!-- Add similar blocks for other active filters -->
                    </div>
                </div>
                @endif
                
                <!-- No Results Message -->
                @if($vehicles->count() == 0)
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Vehicles Found</h3>
                    <p class="text-gray-600 mb-4">We couldn't find any vehicles matching your current filters. Try adjusting your search criteria.</p>
                    <button wire:click="resetFilters" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                        Reset All Filters
                    </button>
                </div>
                @endif
                
                <!-- Grid View -->
                 <!-- Grid View -->
                 @if($viewType === 'grid' && $vehicles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($vehicles as $vehicle)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition duration-300 hover:shadow-xl transform hover:-translate-y-1">
                        <a href="{{ route('vehicle.list', $vehicle->id) }}" class="block relative">
                            <img src="{{ asset('/cars/blue-car-driving-road.jpg')}}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-56 object-cover">
                            @if($vehicle->is_featured)
                            <div class="absolute top-3 right-3">
                                <span class="bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">Featured</span>
                            </div>
                            @endif
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                <!-- <h3 class="text-lg font-bold text-white">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}</h3> -->
                                <p class="text-white/90">{{ $vehicle->trim }}</p>
                            </div>
                        </a>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-xl font-bold text-green-600">TZS {{ number_format($vehicle->price) }}</span>
                                <span class="text-gray-600 text-sm">{{ number_format($vehicle->mileage) }} km</span>
                            </div>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H11a1 1 0 001-1v-1h3.05a2.5 2.5 0 014.9 0H20a1 1 0 001-1V5a1 1 0 00-1-1H3z" />
                                    </svg>
                                    {{ $vehicle->body_type }}
                                </span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $vehicle->fuel_type }}
                                </span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                    </svg>
                                    <!-- {{ $vehicle->transmission }} -->
                                </span>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <img src="{{ asset('/cars/icon.avif')}}" alt="{{ $vehicle->dealer->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-gray-200">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-900">{{ $vehicle->dealer->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $vehicle->dealer->location }}</p>
                                </div>
                            </div>
                            
                            <a href="{{ route('view.vehicle', $vehicle->id) }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
                                View Details
                            </a>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- List View -->
                @if($viewType === 'list' && $vehicles->count() > 0)
                <div class="space-y-4">
                    @foreach($vehicles as $vehicle)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition duration-300 hover:shadow-lg">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-2/5 relative">
                                <a href="{{ route('vehicle.list', $vehicle->id) }}">
                                    <img src="{{ $vehicle->featured_image }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-64 md:h-full object-cover">
                                    @if($vehicle->is_featured)
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">Featured</span>
                                    </div>
                                    @endif
                                </a>
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex flex-col h-full justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                                            <a href="{{ route('vehicle.list', $vehicle->id) }}" class="hover:text-green-600">
                                                {{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }}
                                            </a>
                                        </h3>
                                        <div class="flex items-center mb-4">
                                            <img src="{{ $vehicle->dealer->logo }}" alt="{{ $vehicle->dealer->name }}" class="w-6 h-6 rounded-full object-cover border border-gray-200">
                                            <p class="ml-2 text-sm text-gray-600">{{ $vehicle->dealer->name }} - {{ $vehicle->dealer->location }}</p>
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-x-4 gap-y-2 mb-4">
                                            <div class="flex items-center text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-sm">{{ $vehicle->body_type }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-sm">{{ $vehicle->year }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <span class="text-sm">{{ number_format($vehicle->mileage) }} km</span>
                                            </div>
                                            <div class="flex items-center text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                                </svg>
                                                <span class="text-sm">{{ $vehicle->fuel_type }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2M6 7l-3-1" />
                                                </svg>
                                                <span class="text-sm">{{ $vehicle->transmission }}</span>
                                            </div>
                                            <div class="flex items-center text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                                </svg>
                                                <span class="text-sm">{{ $vehicle->color }}</span>
                                            </div>
                                        </div>
                                        
                                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $vehicle->description }}</p>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-green-600">TZS {{ number_format($vehicle->price) }}</span>
                                        <a href="{{ route('vehicle.list', $vehicle->id) }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                                            View Details
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Pagination -->
                @if($vehicles->hasPages())
                <div class="mt-8">
                    {{ $vehicles->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>






</div>
