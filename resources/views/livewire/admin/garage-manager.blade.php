                                 
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Garage Management</h1>
                    <p class="text-gray-600 mt-1">Manage registered garages and their information</p>
                </div>
                <button wire:click="openModal" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>Add Garage</span>
                </button>
            </div>
        </div>

        <!-- Debug Information -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h3 class="text-sm font-medium text-blue-800">Debug Information</h3>
            <p class="text-sm text-blue-700 mt-1">
                Total Garages: {{ $garages->total() ?? 0 }} |
                Current Page: {{ $garages->currentPage() ?? 1 }} |
                Search: "{{ $search }}" |
                Sort: {{ $sortBy }} ({{ $sortDirection }})
            </p>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search garages..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="flex space-x-4">
                    <select wire:model.live="sortBy" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="name">Sort by Name</option>
                        <option value="city">Sort by City</option>
                        <option value="rating">Sort by Rating</option>
                        <option value="created_at">Sort by Date</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Garages Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            @if($garages->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <button wire:click="sortBy('name')" class="flex items-center space-x-1 hover:text-gray-700">
                                        <span>Name</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                        </svg>
                                    </button>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Services</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($garages as $garage)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($garage->image)
                                            <img src="{{ Storage::url($garage->image) }}" alt="{{ $garage->name }}" class="w-12 h-12 rounded-lg object-cover mr-4">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $garage->name }}</div>
                                            @if($garage->featured ?? false)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    ⭐ Featured
                                                </span>
                                            @endif
                                            @if($garage->description)
                                                <div class="text-xs text-gray-500 mt-1 max-w-xs truncate">{{ $garage->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $garage->city }}, {{ $garage->state }}</div>
                                    <div class="text-sm text-gray-500">{{ $garage->address }}</div>
                                    @if($garage->latitude && $garage->longitude)
                                        <div class="text-xs text-green-600 font-medium">📍 Mapped ({{ number_format($garage->latitude, 4) }}, {{ number_format($garage->longitude, 4) }})</div>
                                    @else
                                        <div class="text-xs text-red-600 font-medium">📍 No coordinates</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $garage->phone }}</div>
                                    @if($garage->email)
                                        <div class="text-sm text-gray-500">{{ $garage->email }}</div>
                                    @endif
                                    @if($garage->website)
                                        <a href="{{ $garage->website }}" target="_blank" class="text-xs text-green-600 hover:text-green-800">🌐 Website</a>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($garage->services && is_array($garage->services))
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(array_slice($garage->services, 0, 2) as $service)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ $service }}
                                                </span>
                                            @endforeach
                                            @if(count($garage->services) > 2)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    +{{ count($garage->services) - 2 }} more
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">No services listed</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">{{ number_format($garage->rating ?? 0, 1) }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <button wire:click="toggleStatus({{ $garage->id }})"
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium transition-colors {{ $garage->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                            {{ $garage->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                        @if($garage->featured ?? false)
                                            <button wire:click="toggleFeatured({{ $garage->id }})"
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 hover:bg-yellow-200 transition-colors">
                                                Featured
                                            </button>
                                        @else
                                            <button wire:click="toggleFeatured({{ $garage->id }})"
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors">
                                                Feature
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button wire:click="openModal({{ $garage->id }})"
                                                class="text-green-600 hover:text-green-900 transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        @if($garage->latitude && $garage->longitude)
                                            <a href="https://www.google.com/maps/place/@{{ $garage->latitude }},{{ $garage->longitude }}"
                                               target="_blank"
                                               class="text-green-600 hover:text-green-900 transition-colors" title="View on Map">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </a>
                                        @endif
                                        <button wire:click="confirmDelete({{ $garage->id }})"
                                                class="text-red-600 hover:text-red-900 transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $garages->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No garages found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by adding a new garage.</p>
                    <div class="mt-6">
                        <button wire:click="openModal" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Garage
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <form wire:submit.prevent="save">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $editingGarage ? 'Edit Garage' : 'Add New Garage' }}
                            </h3>
                            <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-6">
                            <!-- Basic Information -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-md font-medium text-gray-900 mb-4">Basic Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                                        <input wire:model="name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                        <textarea wire:model="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                                        <input wire:model="phone" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input wire:model="email" type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                        <input wire:model="website" type="url" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Opening Hours</label>
                                        <input wire:model="opening_hours" type="text" placeholder="e.g., Mon-Fri 8AM-6PM" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('opening_hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Rating (0-5)</label>
                                        <input wire:model="rating" type="number" min="0" max="5" step="0.1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                        <input wire:model="image" type="file" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        @if($image)
                                            <div class="mt-2">
                                                <span class="text-sm text-green-600">✓ Image selected</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 mt-4">
                                    <label class="flex items-center">
                                        <input wire:model="is_active" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-700">Active</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input wire:model="featured" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-700">Featured</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Location Information -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-md font-medium text-gray-900 mb-4">Location Information</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                                        <input wire:model="address" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                                            <input wire:model="city" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                            @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                                            <input wire:model="state" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                            @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">ZIP Code *</label>
                                            <input wire:model="zip_code" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                            @error('zip_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                            <select wire:model="country" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                                <option value="Tanzania">Tanzania</option>
                                            </select>
                                            @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                                            <input id="latitude-input" wire:model="latitude" type="number" step="any" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                            @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                                            <input id="longitude-input" wire:model="longitude" type="number" step="any" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                            @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <button type="button"
                                                wire:click="geocodeAddress"
                                                class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors flex items-center justify-center space-x-2 {{ $isGeocoding ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $isGeocoding ? 'disabled' : '' }}>
                                            @if($isGeocoding)
                                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                <span>Finding Location...</span>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <span>Auto-detect Coordinates</span>
                                            @endif
                                        </button>

                                        <button type="button"
                                                id="use-my-location"
                                                onclick="window.kiboGetLocation && window.kiboGetLocation(@json($this->id))"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span>Use My Location</span>
                                        </button>
                                    </div>

                                    <div class="text-xs text-gray-500 bg-blue-50 p-3 rounded">
                                        <p><strong>Auto-detect:</strong> Uses address to find coordinates via OpenStreetMap (free)</p>
                                        <p><strong>My Location:</strong> Uses your device's GPS to get current coordinates</p>
                                        <p id="geo-status" class="mt-2 text-gray-600"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Services -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-md font-medium text-gray-900 mb-4">Services Offered</h4>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($availableServices as $service)
                                        <label class="flex items-center">
                                            <input wire:model="services" type="checkbox" value="{{ $service }}" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $service }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            {{ $editingGarage ? 'Update Garage' : 'Create Garage' }}
                        </button>
                        <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteConfirm)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="cancelDelete"></div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Delete Garage
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this garage? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="performDelete" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">Delete</button>
                    <button wire:click="cancelDelete" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Geolocation (Livewire 2 compatible) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var componentId = @json($this->id);

            function getLW() {
                return (window.Livewire || window.livewire || Livewire);
            }

            // Global helper so inline button click works inside modal re-renders
            window.kiboGetLocation = function (cid) {
                function ipFallback() {
                    var statusEl = document.getElementById('geo-status');
                    if (statusEl) statusEl.textContent = 'Trying IP-based location...';
                    fetch('https://ipapi.co/json/')
                        .then(function(r){ return r.ok ? r.json() : Promise.reject(r.status); })
                        .then(function(data){
                            if (!data || !data.latitude || !data.longitude) throw new Error('No IP location');
                            var lat = parseFloat(data.latitude);
                            var lng = parseFloat(data.longitude);
                            var latInput = document.getElementById('latitude-input');
                            var lngInput = document.getElementById('longitude-input');
                            if (latInput && lngInput) {
                                latInput.value = lat;
                                lngInput.value = lng;
                                latInput.dispatchEvent(new Event('input', { bubbles: true }));
                                lngInput.dispatchEvent(new Event('input', { bubbles: true }));
                            }
                            if (statusEl) statusEl.textContent = 'Approximate location set via IP: ' + lat.toFixed(4) + ', ' + lng.toFixed(4);
                            var LW = getLW();
                            if (LW && LW.find) {
                                try { LW.find(cid || componentId).call('setCurrentLocation', lat, lng); } catch (e) {}
                            }
                        })
                        .catch(function(){
                            var statusEl2 = document.getElementById('geo-status');
                            if (statusEl2) statusEl2.textContent = 'Using default location (Dar es Salaam).';
                            var latInput2 = document.getElementById('latitude-input');
                            var lngInput2 = document.getElementById('longitude-input');
                            if (latInput2 && lngInput2) {
                                latInput2.value = -6.792354;
                                lngInput2.value = 39.208328;
                                latInput2.dispatchEvent(new Event('input', { bubbles: true }));
                                lngInput2.dispatchEvent(new Event('input', { bubbles: true }));
                            }
                            var LW2 = getLW();
                            if (LW2 && LW2.find) {
                                try { LW2.find(cid || componentId).call('setCurrentLocation', -6.792354, 39.208328); } catch (e) {}
                            }
                        });
                }
                function handleLocationSuccess(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var LW = getLW();
                    if (LW && LW.find) {
                        try {
                            LW.find(cid || componentId).call('setCurrentLocation', lat, lng);
                        } catch (e) {
                            console.error('Livewire call failed:', e);
                            alert('Failed to send coordinates to server. Try again.');
                        }
                    } else {
                        console.error('Livewire not found on window.');
                        alert('Livewire is not available. Please refresh the page.');
                    }
                }
                function handleLocationError(error) {
                    var message = 'Unable to retrieve your location.';
                    if (error && error.code !== undefined) {
                        switch (error.code) {
                            case error.PERMISSION_DENIED: message = 'Permission denied. Please allow location access.'; break;
                            case error.POSITION_UNAVAILABLE: message = 'Location information is unavailable.'; break;
                            case error.TIMEOUT: message = 'Location request timed out.'; break;
                            default: message = 'An unknown error occurred.'; break;
                        }
                    }
                    var statusEl = document.getElementById('geo-status');
                    if (statusEl) statusEl.textContent = message + ' Falling back to IP-based location...';
                    ipFallback();
                }
                if (!('geolocation' in navigator)) {
                    var statusEl = document.getElementById('geo-status');
                    if (statusEl) statusEl.textContent = 'Geolocation not supported. Using IP-based location...';
                    ipFallback();
                    return;
                }
                navigator.geolocation.getCurrentPosition(
                    handleLocationSuccess,
                    handleLocationError,
                    { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
                );
            };

            function handleLocationSuccess(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                if (window.livewire && window.livewire.find) {
                    window.livewire.find(componentId).call('setCurrentLocation', lat, lng);
                }
            }

            function handleLocationError(error) {
                var message = 'Unable to retrieve your location.';
                if (error && error.code !== undefined) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            message = 'Permission denied. Please allow location access.'; break;
                        case error.POSITION_UNAVAILABLE:
                            message = 'Location information is unavailable.'; break;
                        case error.TIMEOUT:
                            message = 'Location request timed out.'; break;
                        default:
                            message = 'An unknown error occurred.'; break;
                    }
                }
                alert(message);
            }

            // Listen for Livewire browser event on window (Livewire 2 dispatchBrowserEvent)
            window.addEventListener('getCurrentLocation', function () {
                window.kiboGetLocation(componentId);
            });

            // Fallback: bind directly to the button click to trigger geolocation immediately
            var btn = document.getElementById('use-my-location');
            if (btn) {
                btn.addEventListener('click', function (e) {
                    window.kiboGetLocation(componentId);
                });
            }

            // Rebind after Livewire DOM updates (modal re-render)
            var LWForHook = getLW();
            if (LWForHook && LWForHook.hook) {
                LWForHook.hook('message.processed', function(message, component){
                    if (component && component.id === componentId) {
                        var rebBtn = document.getElementById('use-my-location');
                        if (rebBtn) {
                            rebBtn.onclick = function(){ window.kiboGetLocation(componentId); };
                        }
                    }
                });
            }
        });
    </script>

    <!-- Simple vanilla JS geolocation (auto on modal open + button click) -->
    <script>
        (function(){
            function setCoords(lat, lng) {
                var latInput = document.getElementById('latitude-input');
                var lngInput = document.getElementById('longitude-input');
                if (latInput && lngInput) {
                    latInput.value = lat;
                    lngInput.value = lng;
                    latInput.dispatchEvent(new Event('input', { bubbles: true }));
                    lngInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
                var statusEl = document.getElementById('geo-status');
                if (statusEl) statusEl.textContent = 'Location: ' + Number(lat).toFixed(6) + ', ' + Number(lng).toFixed(6);
            }

            function getCoordsSimple() {
                var fallbackLat = -6.792354, fallbackLng = 39.208328; // Dar es Salaam
                if (navigator && navigator.geolocation && navigator.geolocation.getCurrentPosition) {
                    navigator.geolocation.getCurrentPosition(function(pos){
                        setCoords(pos.coords.latitude, pos.coords.longitude);
                    }, function(){
                        // IP fallback
                        try {
                            fetch('https://ipapi.co/json/').then(function(r){return r.ok?r.json():Promise.reject();}).then(function(d){
                                if (d && d.latitude && d.longitude) return setCoords(parseFloat(d.latitude), parseFloat(d.longitude));
                                setCoords(fallbackLat, fallbackLng);
                            }).catch(function(){ setCoords(fallbackLat, fallbackLng); });
                        } catch(e) { setCoords(fallbackLat, fallbackLng); }
                    }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 });
                } else {
                    // No geolocation support
                    try {
                        fetch('https://ipapi.co/json/').then(function(r){return r.ok?r.json():Promise.reject();}).then(function(d){
                            if (d && d.latitude && d.longitude) return setCoords(parseFloat(d.latitude), parseFloat(d.longitude));
                            setCoords(fallbackLat, fallbackLng);
                        }).catch(function(){ setCoords(fallbackLat, fallbackLng); });
                    } catch(e) { setCoords(fallbackLat, fallbackLng); }
                }
            }

            // Button click (simple)
            document.addEventListener('click', function(e){
                if (e.target && (e.target.id === 'use-my-location' || e.target.closest && e.target.closest('#use-my-location'))) {
                    getCoordsSimple();
                }
            });

            // Auto when modal appears (MutationObserver)
            var observed = false;
            var obs = new MutationObserver(function(){
                var modal = document.querySelector('.fixed.inset-0.z-50');
                if (modal && !observed) {
                    observed = true;
                    // Delay slightly to ensure inputs exist
                    setTimeout(getCoordsSimple, 200);
                }
                if (!modal) {
                    observed = false;
                }
            });
            obs.observe(document.documentElement, {subtree:true, childList:true});
        })();
    </script>

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
                    <button onclick="hideNotification()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple JavaScript for Notifications and Geolocation -->
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

        // Event Listeners
        document.addEventListener('livewire:initialized', function () {
            // Listen for Livewire events
            Livewire.on('notify', (event) => {
                showNotification(event.type, event.message);
            });

            Livewire.on('getCurrentLocation', () => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            @this.call('setCurrentLocation',
                                position.coords.latitude,
                                position.coords.longitude
                            );
                        },
                        function(error) {
                            let message = 'Error getting location: ';
                            switch(error.code) {
                                case error.PERMISSION_DENIED:
                                    message += 'Location access denied by user.';
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    message += 'Location information unavailable.';
                                    break;
                                case error.TIMEOUT:
                                    message += 'Location request timed out.';
                                    break;
                                default:
                                    message += 'An unknown error occurred.';
                                    break;
                            }
                            showNotification('error', message);
                        },
                        {
                            enableHighAccuracy: true,
                            timeout: 10000,
                            maximumAge: 300000
                        }
                    );
                } else {
                    showNotification('error', 'Geolocation is not supported by this browser.');
                }
            });
        });
    </script>

    <style>
        /* Loading animation */
        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
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
