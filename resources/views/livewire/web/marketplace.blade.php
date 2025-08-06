<div>
{{-- resources/views/livewire/marketplace.blade.php --}}
<div class="min-h-screen bg-gradient-to-br from-green-50 to-white">
    {{-- Header --}}
    <div class="bg-green-600 shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-start">
                <h1 class="text-4xl font-bold text-white  mb-2">Spare Parts Marketplace</h1>
                <p class="text-lg text-white ">Find quality spare parts from verified shops near you</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Location Success Message --}}
        @if (session()->has('location_success'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
                {{ session('location_success') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar Filters --}}
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Filters</h2>
                    
                    {{-- Location Filter --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Location</label>
                        @if(!$locationCaptured)
                            <button wire:click="getCurrentLocation" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Find Nearby
                            </button>
                        @else
                            <div class="text-sm text-green-600 mb-2">
                                ✓ Showing parts within {{ $maxDistance }}km
                            </div>
                            <input type="range" wire:model="maxDistance" min="5" max="100" step="5" 
                                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>5km</span>
                                <span>{{ $maxDistance }}km</span>
                                <span>100km</span>
                            </div>
                        @endif
                    </div>

                    {{-- Search --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" wire:model="search" placeholder="Search spare parts..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    {{-- Category Filter --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select wire:model="categoryFilter" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }} ({{ $category->spare_parts_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Brand Filter --}}
                    @if($brands->count() > 0)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                            <select wire:model="brandFilter" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">All Brands</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    {{-- Price Range --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" wire:model="priceMin" placeholder="Min" 
                                   class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <input type="number" wire:model="priceMax" placeholder="Max" 
                                   class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                    </div>

                    {{-- Clear Filters --}}
                    <button wire:click="clearFilters" 
                            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200">
                        Clear All Filters
                    </button>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="lg:w-3/4">
                {{-- Sort Controls --}}
                <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="text-sm text-gray-600">
                            Showing {{ $spareParts->firstItem() ?? 0 }} - {{ $spareParts->lastItem() ?? 0 }} 
                            of {{ $spareParts->total() }} results
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">Sort by:</span>
                            <div class="flex gap-2">
                                <button wire:click="sortBy('created_at')" 
                                        class="px-3 py-1 text-sm rounded {{ $sortBy === 'created_at' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    Newest
                                    @if($sortBy === 'created_at')
                                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                                    @endif
                                </button>
                                <button wire:click="sortBy('price')" 
                                        class="px-3 py-1 text-sm rounded {{ $sortBy === 'price' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    Price
                                    @if($sortBy === 'price')
                                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                                    @endif
                                </button>
                                @if($locationCaptured)
                                    <button wire:click="sortBy('distance')" 
                                            class="px-3 py-1 text-sm rounded {{ $sortBy === 'distance' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        Distance
                                        @if($sortBy === 'distance')
                                            @if($sortDirection === 'asc') ↑ @else ↓ @endif
                                        @endif
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Spare Parts Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @forelse($spareParts as $part)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200 group">
                            {{-- Image --}}
                            <div class="aspect-w-16 aspect-h-12 bg-gray-200 relative">
                                @if($part->preview_image)
                                    <img src="{{ Storage::url($part->preview_image) }}" 
                                         alt="{{ $part->unit }}" 
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Distance Badge --}}
                                @if(isset($part->distance))
                                    <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                        {{ number_format($part->distance, 1) }}km
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="font-semibold text-gray-900 text-lg">{{ $part->unit }}</h3>
                                    <span class="text-xl font-bold text-green-600">
                                        Tzs - {{ number_format($part->price, 2) }}
                                    </span>
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600 mb-3">
                                    <div>
                                        <span class="font-medium">Category:</span> {{ $part->spareCategory->name }}
                                    </div>
                                    @if($part->spareBrand)
                                        <div>
                                            <span class="font-medium">Brand:</span> {{ $part->spareBrand->name }}
                                        </div>
                                    @endif
                                    <div>
                                        <span class="font-medium">Shop:</span> {{ $part->shop->name }}
                                    </div>
                                    <div class="flex items-center text-xs">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ Str::limit($part->shop->address, 30) }}
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                        {{ ucfirst(str_replace('_', ' ', $part->price_type)) }}
                                    </span>
                                    
                                    <a href="{{ route('spare-part.detail', $part->id) }}" 
                                       class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded transition duration-200">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-.772-6.25-2.091C4.77 11.49 4 10.51 4 9.5c0-.828.43-1.613 1.172-2.172"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No spare parts found</h3>
                                <p class="mt-1 text-sm text-gray-500">Try adjusting your search criteria or filters.</p>
                                <button wire:click="clearFilters" 
                                        class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition duration-200">
                                    Clear Filters
                                </button>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                {{ $spareParts->links() }}
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('get-user-location', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        @this.updateUserLocation(position.coords.latitude, position.coords.longitude);
                    },
                    (error) => {
                        alert('Error getting location: ' + error.message);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });
    </script>
</div>

</div>
