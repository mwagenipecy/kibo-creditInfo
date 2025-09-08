<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center sm:text-left">
                <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">Find Trusted Garages</h1>
                <p class="text-lg text-green-100">Discover professional automotive services near you</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Search Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="space-y-6">
                <!-- Sort and Filter Controls -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Sort By -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Sort by</label>
                        <select wire:model.live="sortBy" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-base">
                            <option value="rating">Best Rated</option>
                            <option value="featured">Featured First</option>
                            <option value="name">Name A-Z</option>
                        </select>
                    </div>
                    
                    <!-- Service Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Filter by Services</label>
                        <div class="relative">
                            <button wire:click="toggleServiceDropdown" 
                                    class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg bg-white text-left focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <span class="text-gray-700">
                                    @if(empty($selectedServices))
                                        Select services to filter...
                                    @else
                                        {{ count($selectedServices) }} service{{ count($selectedServices) !== 1 ? 's' : '' }} selected
                                    @endif
                                </span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            @if($showServiceDropdown)
                                <div class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    <!-- Search within services -->
                                    <div class="p-3 border-b border-gray-200">
                                        <input type="text" 
                                               wire:model.live.debounce.300ms="serviceSearch"
                                               placeholder="Search services..." 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    
                                    <!-- Service options -->
                                    <div class="py-2">
                                        @foreach($this->filteredServices as $service)
                                            <label class="flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer">
                                                <input wire:model.live="selectedServices" 
                                                       type="checkbox" 
                                                       value="{{ $service }}" 
                                                       class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                                                <span class="ml-3 text-sm text-gray-700">{{ $service }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if(!empty($selectedServices))
                            <div class="mt-2">
                                <button wire:click="clearFilters" 
                                        class="text-sm text-green-600 hover:text-green-800 font-medium bg-green-50 px-3 py-1 rounded-lg transition-colors">
                                    Clear Filters
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Selected Services Display -->
                @if(!empty($selectedServices))
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach($selectedServices as $service)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    {{ $service }}
                                    <button wire:click="removeService('{{ $service }}')" 
                                            class="ml-2 text-green-600 hover:text-green-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Results Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">
                        @if($searchPerformed)
                            Found {{ count($garages) }} garage{{ count($garages) !== 1 ? 's' : '' }}
                        @else
                            Loading garages...
                        @endif
                    </h2>
                </div>
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse($garages as $garage)
                    @php
                        $garageObj = is_array($garage) ? (object) $garage : $garage;
                    @endphp
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-start space-x-6">
                            <!-- Garage Image -->
                            <div class="flex-shrink-0">
                                @if(isset($garageObj->image) && $garageObj->image)
                                    <img src="{{ Storage::url($garageObj->image) }}" alt="{{ $garageObj->name }}" 
                                         class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl object-cover shadow-md">
                                @else
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-md">
                                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Garage Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <h3 class="text-xl font-bold text-gray-900">{{ $garageObj->name }}</h3>
                                            @if(isset($garageObj->featured) && $garageObj->featured)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    Featured
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 mb-2">
                                            @if(is_array($garage) && isset($garage['full_address']))
                                                {{ $garage['full_address'] }}
                                            @elseif(isset($garageObj->full_address))
                                                {{ $garageObj->full_address }}
                                            @else
                                                {{ $garageObj->address ?? '' }}, {{ $garageObj->city ?? '' }}, {{ $garageObj->state ?? '' }}
                                            @endif
                                        </p>
                                        @if(isset($garageObj->description) && $garageObj->description)
                                            <p class="text-sm text-gray-700 mb-3 line-clamp-2">{{ $garageObj->description }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Distance -->
                                    @if(isset($garageObj->distance))
                                        <div class="flex-shrink-0 ml-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                </svg>
                                                {{ number_format($garageObj->distance, 1) }} mi
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Rating and Hours -->
                                <div class="flex items-center mt-3 space-x-6">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= (isset($garageObj->rating) ? $garageObj->rating : 0) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-sm font-semibold text-gray-900">{{ number_format($garageObj->rating ?? 0, 1) }}</span>
                                    </div>
                                    @if(isset($garageObj->opening_hours) && $garageObj->opening_hours)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $garageObj->opening_hours }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Services -->
                                @if(isset($garageObj->services) && $garageObj->services)
                                    @php
                                        $services = is_string($garageObj->services) ? json_decode($garageObj->services, true) : $garageObj->services;
                                    @endphp
                                    <div class="mt-4">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(array_slice($services ?? [], 0, 4) as $service)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ $service }}
                                                </span>
                                            @endforeach
                                            @if(count($services ?? []) > 4)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                    +{{ count($services) - 4 }} more
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-3 mt-6">
                                    <button wire:click="showGarageDetails({{ $garageObj->id }})" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>View Details</span>
                                    </button>
                                    
                                    <button wire:click="getDirections({{ $garageObj->id }})" 
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center space-x-2 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                        </svg>
                                        <span>Get Directions</span>
                                    </button>
                                    
                                    <a href="tel:{{ $garageObj->phone }}" 
                                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center space-x-2 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>Call Now</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No garages found</h3>
                        <p class="text-gray-600 mb-6">Try adjusting your search criteria.</p>
                        <button wire:click="clearFilters" 
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Clear Filters
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Garage Details Modal -->
    @if($selectedGarage)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeGarageDetails"></div>
            
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">{{ $selectedGarage->name }}</h3>
                        <button wire:click="closeGarageDetails" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Image -->
                        @if($selectedGarage->image)
                            <img src="{{ Storage::url($selectedGarage->image) }}" alt="{{ $selectedGarage->name }}" 
                                 class="w-full h-48 object-cover rounded-lg">
                        @endif
                        
                        <!-- Description -->
                        @if($selectedGarage->description)
                            <p class="text-gray-700 leading-relaxed">{{ $selectedGarage->description }}</p>
                        @endif
                        
                        <!-- Contact Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Contact Information</h4>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">
                                        <strong>Phone:</strong> {{ $selectedGarage->phone }}
                                    </p>
                                    @if($selectedGarage->email)
                                        <p class="text-sm text-gray-600">
                                            <strong>Email:</strong> {{ $selectedGarage->email }}
                                        </p>
                                    @endif
                                    @if($selectedGarage->website)
                                        <p class="text-sm text-gray-600">
                                            <strong>Website:</strong> 
                                            <a href="{{ $selectedGarage->website }}" target="_blank" 
                                               class="text-blue-600 hover:text-blue-800 transition-colors">Visit Website</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Location</h4>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">{{ $selectedGarage->full_address }}</p>
                                    @if($selectedGarage->opening_hours)
                                        <p class="text-sm text-gray-600">
                                            <strong>Hours:</strong> {{ $selectedGarage->opening_hours }}
                                        </p>
                                    @endif
                                    @if(isset($selectedGarage->distance))
                                        <p class="text-sm text-gray-600">
                                            <strong>Distance:</strong> {{ number_format($selectedGarage->distance, 1) }} miles away
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Services -->
                        @if($selectedGarage->services)
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Services Offered</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($selectedGarage->services as $service)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $service }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- Rating -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Rating</h4>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $selectedGarage->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="ml-3 text-sm font-semibold text-gray-900">{{ number_format($selectedGarage->rating, 1) }} out of 5</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse space-y-3 sm:space-y-0">
                    <button wire:click="getDirections({{ $selectedGarage->id }})" 
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Get Directions
                    </button>
                    
                    <a href="tel:{{ $selectedGarage->phone }}" 
                       class="w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Call Now
                    </a>
                    
                    <button wire:click="closeGarageDetails" 
                            class="w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Notification Toast -->
    <div id="notification" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg id="notification-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Icon will be set by JavaScript -->
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1">
                    <p id="notification-message" class="text-sm font-medium text-gray-900"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button onclick="hideNotification()" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple JavaScript -->
    <script>
        // Notification functions
        function showNotification(type, message) {
            const notification = document.getElementById('notification');
            const icon = document.getElementById('notification-icon');
            const messageEl = document.getElementById('notification-message');
            
            messageEl.textContent = message;
            
            // Set icon and color based on type
            switch(type) {
                case 'success':
                    icon.className = 'h-6 w-6 text-green-400';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
                    break;
                case 'error':
                    icon.className = 'h-6 w-6 text-red-400';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                    break;
                case 'info':
                    icon.className = 'h-6 w-6 text-blue-400';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                    break;
            }
            
            notification.classList.remove('hidden');
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                hideNotification();
            }, 5000);
        }

        function hideNotification() {
            document.getElementById('notification').classList.add('hidden');
        }

        // Livewire event listeners
        document.addEventListener('livewire:initialized', function () {
            // Listen for Livewire events
            Livewire.on('notify', (event) => {
                showNotification(event.type, event.message);
            });
            
            // Listen for directions event
            Livewire.on('openDirections', (event) => {
                window.open(event.url, '_blank');
            });
        });
    </script>

    <style>
        /* Custom styles for better mobile experience */
        @media (max-width: 640px) {
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        }

        /* Smooth transitions */
        .transition-colors {
            transition-property: color, background-color, border-color;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>
</div>