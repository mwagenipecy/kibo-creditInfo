<div>
{{-- resources/views/livewire/admin/shop-onboarding.blade.php --}}
<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-start mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                @if($currentView === 'list') Shop Management
                @elseif($currentView === 'create') Shop Registration
                @else Edit Shop
                @endif
            </h1>
            <p class="text-lg text-gray-600">
                @if($currentView === 'list') Manage registered shops and supervisors
                @elseif($currentView === 'create') Register a new shop and create supervisor account
                @else 
                Update shop details and supervisor information
                @endif
            </p>
        </div>

        {{-- Success/Error Messages --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('location_success'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
                {{ session('location_success') }}
            </div>
        @endif

        {{-- LIST VIEW --}}
        @if($currentView === 'list')
            <div class="bg-white shadow-xl rounded-lg">
                {{-- List Header --}}
                <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <input type="text" wire:model="search" placeholder="Search shops..." 
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <button wire:click="showCreateForm" 
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            Add New Shop
                        </button>
                    </div>
                </div>

                {{-- Shops Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th wire:click="sortBy('name')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                    Shop Name
                                    @if($sortField === 'name')
                                        <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Owner
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Supervisor
                                </th>
                                <th wire:click="sortBy('created_at')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                    Created
                                    @if($sortField === 'created_at')
                                        <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($shops as $shop)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $shop->name }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($shop->address, 30) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $shop->owner_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $shop->phone_number }}</div>
                                        @if($shop->email)
                                            <div class="text-sm text-gray-500">{{ $shop->email }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($shop->shop_type === 'spare_parts') bg-blue-100 text-blue-800
                                            @elseif($shop->shop_type === 'mechanic') bg-green-100 text-green-800
                                            @elseif($shop->shop_type === 'accessories') bg-purple-100 text-purple-800
                                            @else bg-orange-100 text-orange-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $shop->shop_type)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($shop->supervisor)
                                            <div class="text-sm text-gray-900">{{ $shop->supervisor->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $shop->supervisor->email }}</div>
                                        @else
                                            <span class="text-sm text-gray-500"> supervisor</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $shop->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="editShop({{ $shop->id }})"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            Edit
                                        </button>
                                        <button wire:click="confirmDeletion({{ $shop->id }})"
                                                class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        No shops found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $shops->links() }}
                </div>
            </div>

        {{-- CREATE/EDIT FORM --}}
        @else
            <form wire:submit.prevent="{{ $currentView === 'create' ? 'createShop' : 'updateShop' }}" class="bg-white shadow-xl rounded-lg p-8">
                {{-- Navigation --}}
                <div class="mb-6">
                    <button type="button" wire:click="showList" 
                            class="text-gray-600 hover:text-gray-800 font-medium flex items-center">
                        ← Back to Shop List
                    </button>
                </div>

                {{-- Shop Details Section --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b-2 border-green-200 pb-2">
                        Shop Information
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Shop Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Shop Name *</label>
                            <input type="text" wire:model="name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Owner Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Owner Name *</label>
                            <input type="text" wire:model="owner_name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('owner_name') border-red-500 @enderror">
                            @error('owner_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                            <input type="tel" wire:model="phone_number" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('phone_number') border-red-500 @enderror">
                            @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" wire:model="email" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Shop Type --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Shop Type *</label>
                            <select wire:model="shop_type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('shop_type') border-red-500 @enderror">
                                <option value="spare_parts">Spare Parts</option>
                                <option value="mechanic">Mechanic</option>
                                <option value="accessories">Accessories</option>
                                <option value="service">Service</option>
                            </select>
                            @error('shop_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Location Section --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b-2 border-green-200 pb-2">
                        Location Details
                    </h2>
                    
                    <div class="mb-6">
                        <button type="button" wire:click="getCurrentLocation" 
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Capture Current Location
                        </button>
                        @if($locationCaptured)
                            <div class="mt-2 text-green-600 font-medium">
                                ✓ Location captured successfully
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Latitude --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Latitude *</label>
                            <input type="number" step="any" wire:model="latitude" readonly
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 @error('latitude') border-red-500 @enderror">
                            @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Longitude --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Longitude *</label>
                            <input type="number" step="any" wire:model="longitude" readonly
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 @error('longitude') border-red-500 @enderror">
                            @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Address --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                            <textarea wire:model="address" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('address') border-red-500 @enderror"></textarea>
                            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Supervisor Section --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b-2 border-green-200 pb-2">
                        Shop Supervisor Details
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Supervisor Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Supervisor Name *</label>
                            <input type="text" wire:model="supervisor_name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('supervisor_name') border-red-500 @enderror">
                            @error('supervisor_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Supervisor Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Supervisor Email *</label>
                            <input type="email" wire:model="supervisor_email" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('supervisor_email') border-red-500 @enderror">
                            @error('supervisor_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Supervisor Phone --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Supervisor Phone *</label>
                            <input type="tel" wire:model="supervisor_phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('supervisor_phone') border-red-500 @enderror">
                            @error('supervisor_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex justify-between">
                    <button type="button" wire:click="showList" 
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-lg transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg transition duration-200">
                        {{ $currentView === 'create' ? 'Create Shop & Supervisor' : 'Update Shop & Supervisor' }}
                    </button>
                </div>
            </form>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    @if($confirmingDeletion)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-.77-2.167 0-3L18.732 2.5c.77-.833 2.462-.833 3.232 0L26.732 4c.77.833.77 2.167 0 3l-5 8.5c-.77.833-2.462.833-3.232 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Delete Shop</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete this shop? This action cannot be undone and will also remove the associated supervisor account.
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button wire:click="deleteShop"
                                class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Delete
                        </button>
                        <button wire:click="cancelDeletion"
                                class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        window.addEventListener('get-current-location', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        
                        // Get address from coordinates using reverse geocoding
                        fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=YOUR_API_KEY`)
                            .then(response => response.json())
                            .then(data => {
                                const address = data.results[0]?.formatted || '';
                                @this.updateLocation(latitude, longitude, address);
                            })
                            .catch(() => {
                                @this.updateLocation(latitude, longitude);
                            });
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
