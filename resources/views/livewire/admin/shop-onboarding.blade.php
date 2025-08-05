<div>
{{-- resources/views/livewire/admin/shop-onboarding.blade.php --}}
<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Shop Registration</h1>
            <p class="text-lg text-gray-600">Register a new shop and create supervisor account</p>
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

        <form wire:submit.prevent="createShop" class="bg-white shadow-xl rounded-lg p-8">
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

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg transition duration-200 flex items-center">
                    Create Shop & Supervisor
                </button>
            </div>
        </form>
    </div>

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
