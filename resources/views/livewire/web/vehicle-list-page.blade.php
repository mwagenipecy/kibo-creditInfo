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
         
            <div class="lg:w-1/4 w-full bg-white rounded-lg border border-gray-100 shadow-sm self-start lg:sticky lg:top-24 mb-6 overflow-hidden">
    <!-- Header with Clean Design -->
    <div class="flex justify-between items-center p-4 border-b border-gray-100 bg-gray-50">
        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
            </svg>
            Filters
        </h2>
        <button wire:click="resetFilters" class="text-sm text-green-600 hover:text-green-800 font-medium flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Reset
        </button>
    </div>
    
    <!-- Mobile Filter Toggle - Improved for better UX -->
    <div class="p-4 border-b border-gray-100 lg:hidden">
        <button id="toggleFilters" class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded flex items-center justify-between transition-colors duration-150">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                Filter Options
            </span>
            <svg id="filterArrow" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <!-- Main Filter Content -->
    <div id="filterContent" class="divide-y divide-gray-100 lg:block">
        <!-- Make Filter - Cleaner Design -->
        <div class="p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-gray-700">Make</h3>
                @if(count($selectedMakes) > 0)
                <span class="text-xs bg-green-100 text-green-700 py-0.5 px-2 rounded-full">{{ count($selectedMakes) }}</span>
                @endif
            </div>
            <div class="space-y-1.5 max-h-32 overflow-y-auto pr-1 scrollbar-thin">
                @foreach($makes as $make)
                <label class="flex items-center hover:bg-gray-50 p-1 rounded transition-colors duration-150 cursor-pointer">
                    <input type="checkbox" wire:model="selectedMakes" value="{{ $make->id }}" 
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    <span class="ml-2 text-gray-700 text-sm">{{ $make->name }}</span>
                </label>
                @endforeach
            </div>
        </div>
        
        <!-- Model Filter - Appears if make is selected -->
        @if(count($selectedMakes) > 0)
        <div class="p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-gray-700">Model</h3>
                @if(count($selectedModels) > 0)
                <span class="text-xs bg-green-100 text-green-700 py-0.5 px-2 rounded-full">{{ count($selectedModels) }}</span>
                @endif
            </div>
            <div class="space-y-1.5 max-h-32 overflow-y-auto pr-1 scrollbar-thin">
                @foreach($models as $model)
                <label class="flex items-center hover:bg-gray-50 p-1 rounded transition-colors duration-150 cursor-pointer">
                    <input type="checkbox" wire:model="selectedModels" value="{{ $model->id }}" 
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    <span class="ml-2 text-gray-700 text-sm">{{ $model->name }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Price Range - Clean UI -->
        <div class="p-4">
            <div class="mb-3">
                <h3 class="text-sm font-semibold text-gray-700">Price Range</h3>
            </div>
            
            <!-- Active Price Range Display -->
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs font-medium text-gray-700">TZS {{ number_format($priceMin) }}</span>
                <span class="text-xs font-medium text-gray-700">TZS {{ number_format($priceMax) }}</span>
            </div>
            
            <!-- Slider with Better Styling -->
            <div class="px-1 mb-4 relative">
                <div class="h-1 bg-gray-200 rounded-full mt-1 mb-1 relative">
                    <div class="absolute h-1 bg-green-500 rounded-full"
                         style="left: {{ (($priceMin - $minPrice) / ($maxPrice - $minPrice)) * 100 }}%; right: {{ 100 - (($priceMax - $minPrice) / ($maxPrice - $minPrice)) * 100 }}%;">
                    </div>
                </div>
                
                <input type="range" wire:model.debounce.500ms="priceMin" min="{{ $minPrice }}" max="{{ $maxPrice }}" 
                    class="absolute appearance-none w-full h-1 bg-transparent cursor-pointer z-10 top-1 opacity-0">
                
                <input type="range" wire:model.debounce.500ms="priceMax" min="{{ $minPrice }}" max="{{ $maxPrice }}" 
                    class="absolute appearance-none w-full h-1 bg-transparent cursor-pointer z-10 top-1 opacity-0">
            </div>
            
            <!-- Direct Input Fields -->
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">Min Price</label>
                    <div class="relative">
                        <input type="number" wire:model.debounce.500ms="priceMin" min="{{ $minPrice }}" max="{{ $priceMax }}" 
                               class="w-full pl-2 pr-6 py-1.5 text-xs rounded-md border border-gray-300 focus:ring-green-500 focus:border-green-500">
                        <div class="absolute inset-y-0 right-0 pr-1 flex items-center pointer-events-none">
                            <span class="text-xs text-gray-500">TZS</span>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">Max Price</label>
                    <div class="relative">
                        <input type="number" wire:model.debounce.500ms="priceMax" min="{{ $priceMin }}" max="{{ $maxPrice }}" 
                               class="w-full pl-2 pr-6 py-1.5 text-xs rounded-md border border-gray-300 focus:ring-green-500 focus:border-green-500">
                        <div class="absolute inset-y-0 right-0 pr-1 flex items-center pointer-events-none">
                            <span class="text-xs text-gray-500">TZS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Year - Improved Design -->
        <div class="p-4">
            <div class="mb-3">
                <h3 class="text-sm font-semibold text-gray-700">Year</h3>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <select wire:model="yearFrom" class="w-full rounded-md border border-gray-300 py-1.5 pl-2 pr-8 text-sm focus:ring-green-500 focus:border-green-500 bg-white">
                        <option value="">From</option>
                        @foreach(range(date('Y'), 2000) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select wire:model="yearTo" class="w-full rounded-md border border-gray-300 py-1.5 pl-2 pr-8 text-sm focus:ring-green-500 focus:border-green-500 bg-white">
                        <option value="">To</option>
                        @foreach(range(date('Y'), 2000) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Collapsible Sections - Improved with Consistent Design -->
        
        <!-- Body Type - Collapsible -->
        <div class="collapsible-section">
            <div class="flex justify-between items-center p-4 cursor-pointer" onclick="toggleSection('bodyTypeContent', this)">
                <h3 class="text-sm font-semibold text-gray-700">Body Type</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transition-transform duration-200 toggle-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <div id="bodyTypeContent" class="px-4 pb-4 section-content">
                <div class="space-y-1.5 max-h-32 overflow-y-auto pr-1 scrollbar-thin">
                    @foreach($bodyTypes as $bodyType)
                    <label class="flex items-center hover:bg-gray-50 p-1 rounded transition-colors duration-150 cursor-pointer">
                        <input type="checkbox" wire:model="selectedBodyTypes" value="{{ $bodyType->id }}" 
                            class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-700 text-sm">{{ $bodyType->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Fuel Type - Collapsible -->
        <div class="collapsible-section">
            <div class="flex justify-between items-center p-4 cursor-pointer" onclick="toggleSection('fuelTypeContent', this)">
                <h3 class="text-sm font-semibold text-gray-700">Fuel Type</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transition-transform duration-200 toggle-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <div id="fuelTypeContent" class="px-4 pb-4 section-content">
                <div class="space-y-1.5 max-h-32 overflow-y-auto pr-1 scrollbar-thin">
                    @foreach($fuelTypes as $fuelType)
                    <label class="flex items-center hover:bg-gray-50 p-1 rounded transition-colors duration-150 cursor-pointer">
                        <input type="checkbox" wire:model="selectedFuelTypes" value="{{ $fuelType->id }}" 
                            class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-700 text-sm">{{ $fuelType->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Transmission - Collapsible -->
        <div class="collapsible-section">
            <div class="flex justify-between items-center p-4 cursor-pointer" onclick="toggleSection('transmissionContent', this)">
                <h3 class="text-sm font-semibold text-gray-700">Transmission</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transition-transform duration-200 toggle-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <div id="transmissionContent" class="px-4 pb-4 section-content">
                <div class="space-y-1.5 max-h-32 overflow-y-auto pr-1 scrollbar-thin">
                    @foreach($transmissions as $transmission)
                    <label class="flex items-center hover:bg-gray-50 p-1 rounded transition-colors duration-150 cursor-pointer">
                        <input type="checkbox" wire:model="selectedTransmissions" value="{{ $transmission->id }}" 
                            class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-700 text-sm">{{ $transmission->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Mileage - Clean Dropdown -->
        <div class="p-4">
            <div class="mb-3">
                <h3 class="text-sm font-semibold text-gray-700">Mileage (km)</h3>
            </div>
            <select wire:model="maxMileage" class="w-full rounded-md border border-gray-300 py-1.5 pl-2 pr-8 text-sm focus:ring-green-500 focus:border-green-500 bg-white">
                <option value="">Any Mileage</option>
                <option value="10000">Under 10,000 km</option>
                <option value="50000">Under 50,000 km</option>
                <option value="100000">Under 100,000 km</option>
                <option value="150000">Under 150,000 km</option>
                <option value="200000">Under 200,000 km</option>
            </select>
        </div>
        
        <!-- Dealers - Collapsible -->
        <div class="collapsible-section">
            <div class="flex justify-between items-center p-4 cursor-pointer" onclick="toggleSection('dealerContent', this)">
                <h3 class="text-sm font-semibold text-gray-700">Dealers</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transition-transform duration-200 toggle-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <div id="dealerContent" class="px-4 pb-4 section-content">
                <div class="space-y-1.5 max-h-32 overflow-y-auto pr-1 scrollbar-thin">
                    @foreach($dealers as $dealer)
                    <label class="flex items-center hover:bg-gray-50 p-1 rounded transition-colors duration-150 cursor-pointer">
                        <input type="checkbox" wire:model="selectedDealers" value="{{ $dealer->id }}" 
                            class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-700 text-sm">{{ $dealer->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Apply Button - Fixed at Bottom -->
        <div class="p-4 bg-gray-50 sticky bottom-0 border-t border-gray-100">
            <button wire:click="applyFilters" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded shadow flex items-center justify-center transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Apply Filters
            </button>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript for Filter Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile filter toggle
    const toggleFiltersBtn = document.getElementById('toggleFilters');
    const filterContent = document.getElementById('filterContent');
    const filterArrow = document.getElementById('filterArrow');
    
    // Initialize filter content display based on screen size
    if (window.innerWidth < 1024) { // lg breakpoint
        filterContent.style.display = 'none';
    }
    
    if (toggleFiltersBtn) {
        toggleFiltersBtn.addEventListener('click', function() {
            if (filterContent.style.display === 'none') {
                filterContent.style.display = 'block';
                filterArrow.classList.add('rotate-180');
            } else {
                filterContent.style.display = 'none';
                filterArrow.classList.remove('rotate-180');
            }
        });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) { // lg breakpoint
            filterContent.style.display = 'block';
        } else if (!filterArrow.classList.contains('rotate-180')) {
            filterContent.style.display = 'none';
        }
    });
    
    // Initialize collapsible sections
    const sections = document.querySelectorAll('.section-content');
    if (window.innerWidth < 768) {
        sections.forEach(section => {
            section.style.display = 'none';
        });
    }
});

// Improved toggle section with animation
function toggleSection(sectionId, headerElement) {
    const section = document.getElementById(sectionId);
    const icon = headerElement.querySelector('.toggle-icon');
    
    if (section.style.display === 'none' || section.style.display === '') {
        section.style.display = 'block';
        icon.classList.add('rotate-180');
    } else {
        section.style.display = 'none';
        icon.classList.remove('rotate-180');
    }
}
</script>

<!-- Custom styling for range input thumbs with better appearance -->
<style>
/* Range Slider Styling */
input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #10B981;
    cursor: pointer;
    margin-top: -7px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

input[type=range]::-moz-range-thumb {
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #10B981;
    cursor: pointer;
    border: none;
    box-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

/* Scrollbar Styling */
.scrollbar-thin::-webkit-scrollbar {
    width: 4px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Collapsible Section Animation */
.section-content {
    transition: max-height 0.3s ease-out;
}
</style>






           <!-- Enhanced Results Area - Professional & Space Efficient -->
<div class="lg:w-3/4">
    <!-- Results Header with Sort Options - Cleaner Design -->
    <div class="bg-white rounded-lg border border-gray-100 shadow-sm p-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-3 sm:space-y-0">
            <!-- Results count with improved styling -->
            <div class="flex items-center text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>
                    Showing <span class="font-medium text-gray-700">{{ $vehicles->firstItem() ?? 0 }}-{{ $vehicles->lastItem() ?? 0 }}</span> 
                    of <span class="font-medium text-gray-700">{{ $vehicles->total() }}</span> vehicles
                </span>
            </div>
            
            <!-- Controls Group - More compact -->
            <div class="flex items-center space-x-3">
                <!-- Sort Dropdown - Improved Design -->
                <div class="relative flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                    </svg>
                    <select 
                        wire:model="sortBy" 
                        class="appearance-none text-sm bg-transparent border-none focus:ring-0 py-1 pl-0 pr-6 cursor-pointer"
                    >
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="mileage_low">Mileage: Low to High</option>
                        <option value="year_new">Year: Newest First</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                
                <!-- Vertical Divider -->
                <div class="h-6 w-px bg-gray-200"></div>
                
                <!-- View Toggle Buttons - Improved Design -->
                <div class="flex border border-gray-200 rounded-md">
                    <button 
                        wire:click="$set('viewType', 'grid')" 
                        class="p-1.5 {{ $viewType === 'grid' ? 'bg-green-50 text-green-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-l-md transition-colors duration-150"
                        aria-label="Grid view"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </button>
                    <button 
                        wire:click="$set('viewType', 'list')" 
                        class="p-1.5 {{ $viewType === 'list' ? 'bg-green-50 text-green-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-r-md transition-colors duration-150"
                        aria-label="List view"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Active Filters - Clean Design -->
    @if($hasActiveFilters)
    <div class="bg-gray-50 rounded-md border border-gray-200 p-3 mb-4">
        <div class="flex flex-wrap items-center gap-1.5">
            <span class="text-xs font-medium text-gray-500 mr-1">Filters:</span>
            
            @if(count($selectedMakes) > 0)
                @foreach($activeFilters['makes'] as $make)
                    <span class="inline-flex items-center bg-white border border-gray-200 rounded-full px-2 py-0.5 text-xs">
                        <span class="text-gray-600">{{ $make }}</span>
                        <button wire:click="removeFilter('make', '{{ $make }}')" class="ml-1 text-gray-400 hover:text-gray-600">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </span>
                @endforeach
            @endif
            <!-- Add similar blocks for other active filters -->
            
            <button wire:click="resetFilters" class="ml-auto text-xs text-green-600 hover:text-green-700 font-medium flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Clear All
            </button>
        </div>
    </div>
    @endif
    
    <!-- No Results Message - Clean Design -->
    @if($vehicles->count() == 0)
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 text-center">
        <div class="max-w-md mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-base font-semibold text-gray-900 mb-1">No Vehicles Found</h3>
            <p class="text-sm text-gray-600 mb-4">We couldn't find any vehicles matching your current filters. Try adjusting your search criteria.</p>
            <button wire:click="resetFilters" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors duration-150">
                Reset All Filters
            </button>
        </div>
    </div>
    @endif
    
    <!-- Grid View - Enhanced Space-Efficient Design -->
    @if($viewType === 'grid' && $vehicles->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($vehicles as $vehicle)
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
            <!-- Vehicle Image with Overlays -->
            <div class="relative">
                <a href="{{ route('vehicle.list', $vehicle->id) }}" class="block relative">
                
                @php
                    $frontImage = $vehicle->frontView();
                @endphp

                <img 
                        src="{{ $frontImage ? asset('storage/' . $frontImage->image_url) : asset('cars/blue-car-driving-road.jpg') }}" 
                        alt="{{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}" 
                        class="w-full h-44 object-cover"
                    >
                    
                    <!-- Price Tag - Top Left -->
                    <div class="absolute top-3 left-3 bg-white py-1 px-2 rounded shadow-sm text-green-600 font-bold text-sm">
                        TZS {{ number_format($vehicle->price) }}
                    </div>
                    
                    <!-- Feature Badge - If Featured -->
                    @if($vehicle->is_featured)
                    <div class="absolute top-3 right-3">
                        <span class="bg-green-600 text-white text-xs font-medium px-2 py-0.5 rounded-sm shadow-sm">Featured</span>
                    </div>
                    @endif
                    
                    <!-- Year Badge -->
                    <div class="absolute bottom-3 right-3">
                        <span class="bg-black bg-opacity-60 text-white text-xs px-1.5 py-0.5 rounded">{{ $vehicle->year }}</span>
                    </div>
                </a>
            </div>
            
            <!-- Vehicle Details -->
            <div class="p-3">
                <!-- Title and Essentials -->
                <div class="mb-2">
                    <h3 class="font-semibold text-gray-800 text-sm leading-tight truncate">
                        <a href="{{ route('vehicle.list', $vehicle->id) }}" class="hover:text-green-600">
                            {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }} {{ $vehicle->trim }}
                        </a>
                    </h3>
                    <div class="flex items-center justify-between mt-1 text-xs text-gray-500">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            {{ number_format($vehicle->mileage) }} km
                        </span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            {{ optional($vehicle->transmission)->name }}
                        </span>
                    </div>
                </div>
                
                <!-- Specs Pills - Horizontal Scroll -->
                <div class="flex space-x-1.5 overflow-x-auto pb-1.5 mb-2 scrollbar-hide">
                    <span class="flex-shrink-0 bg-gray-100 text-gray-800 text-xs px-1.5 py-0.5 rounded whitespace-nowrap">
                        {{ optional($vehicle->bodyType)->name }}
                    </span>
                    <span class="flex-shrink-0 bg-gray-100 text-gray-800 text-xs px-1.5 py-0.5 rounded whitespace-nowrap">
                        {{ optional($vehicle->fuelType)->name }}
                    </span>
                    @if($vehicle->color)
                    <span class="flex-shrink-0 bg-gray-100 text-gray-800 text-xs px-1.5 py-0.5 rounded whitespace-nowrap">
                        {{ $vehicle->color }}
                    </span>
                    @endif
                </div>
                
                <!-- Footer with Dealer Info and CTA -->
                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <div class="flex items-center">
                        <img 
                            src="{{ asset('/cars/icon.avif')}}" 
                            alt="{{ optional($vehicle->dealer)->name }}" 
                            class="w-5 h-5 rounded-full object-cover border border-gray-200"
                        >
                        <span class="ml-1.5 text-xs text-gray-600 truncate max-w-[120px]">{{ optional($vehicle->dealer)->name }}</span>
                    </div>
                    <a 
                        href="{{ route('view.vehicle', $vehicle->id) }}" 
                        class="text-xs font-medium text-green-600 hover:text-green-700 flex items-center"
                    >
                        View
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-0.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    
    <!-- List View - Enhanced Space-Efficient Design -->
    @if($viewType === 'list' && $vehicles->count() > 0)
    <div class="space-y-3">
        @foreach($vehicles as $vehicle)
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
            <div class="flex flex-col sm:flex-row">
                <!-- Image Section - Optimized Size -->
                <div class="sm:w-1/3 lg:w-1/4 relative">
                    <a href="{{ route('vehicle.list', $vehicle->id) }}" class="block h-full">
                        <img 
                            src="{{ asset('/cars/blue-car-driving-road.jpg')}}" 
                            alt="{{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}" 
                            class="w-full h-48 sm:h-full object-cover"
                        >
                        
                        <!-- Feature Badge - If Featured -->
                        @if($vehicle->is_featured)
                        <div class="absolute top-2 right-2">
                            <span class="bg-green-600 text-white text-xs font-medium px-1.5 py-0.5 rounded-sm shadow-sm">Featured</span>
                        </div>
                        @endif
                        
                        <!-- Year Badge - Bottom Right -->
                        <div class="absolute bottom-2 right-2">
                            <span class="bg-black bg-opacity-70 text-white text-xs px-1.5 py-0.5 rounded">{{ $vehicle->year }}</span>
                        </div>
                    </a>
                </div>
                
                <!-- Content Section -->
                <div class="sm:w-2/3 lg:w-3/4 p-3 sm:p-4 flex flex-col">
                    <div class="flex-grow">
                        <!-- Header with Title and Price -->
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-2 gap-2">
                            <div>
                                <h3 class="font-semibold text-gray-800 text-base leading-tight">
                                    <a href="{{ route('vehicle.list', $vehicle->id) }}" class="hover:text-green-600">
                                        {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }} {{ $vehicle->trim }}
                                    </a>
                                </h3>
                                <div class="flex items-center mt-1">
                                    <img 
                                        src="{{ asset('/cars/icon.avif')}}" 
                                        alt="{{ $vehicle->dealer->name }}" 
                                        class="w-4 h-4 rounded-full object-cover border border-gray-200"
                                    >
                                    <span class="ml-1.5 text-xs text-gray-500">{{ $vehicle->dealer->name }} • {{ $vehicle->dealer->location }}</span>
                                </div>
                            </div>
                            <div class="text-green-600 font-bold text-base sm:text-right">
                                TZS {{ number_format($vehicle->price) }}
                            </div>
                        </div>
                        
                        <!-- Specs Grid - 3 Column Compact -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-1.5 mb-3">
                            <div class="flex items-center text-xs text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ optional($vehicle->bodyType)->name }}</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span>{{ number_format($vehicle->mileage) }} km</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span>{{ optional($vehicle->fuelType)->name }}</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2M6 7l-3-1" />
                                </svg>
                                <span>{{ optional($vehicle->transmission)->name }}</span>
                            </div>
                            @if($vehicle->color)
                            <div class="flex items-center text-xs text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                                <span>{{ $vehicle->color }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Description - Truncated -->
                        @if($vehicle->description)
                        <p class="text-xs text-gray-600 mb-3 line-clamp-2">
                            {{ Str::words($vehicle->description, 15, '...') }}
                        </p>
                        @endif
                    </div>
                    
                    <!-- Action Button -->
                    <div class="mt-auto pt-2 border-t border-gray-100 flex justify-end">
                        <a 
                            href="{{ route('view.vehicle', $vehicle->id) }}" 
                            class="inline-flex items-center text-xs font-medium px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded transition-colors duration-150"
                        >
                            View Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    
    <!-- Pagination - Cleaner Design -->
    @if($vehicles->hasPages())
    <div class="mt-6">
        {{ $vehicles->links() }}
    </div>
    @endif
</div>

<style>
/* Hide scrollbar but allow scrolling */
.scrollbar-hide {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;  /* Chrome, Safari and Opera */
}

/* Line clamp for text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>



            
        </div>
    </div>
</div>






</div>
