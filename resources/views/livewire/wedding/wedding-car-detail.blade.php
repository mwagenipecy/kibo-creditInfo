<div>
<div class="bg-white w-full">
    <!-- Breadcrumb -->
    <div class="bg-gradient-to-r from-green-600 to-green-600 py-6 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-white hover:text-green-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('wedding.vehicles') }}" class="ml-1 text-sm font-medium text-white hover:text-green-200 md:ml-2">Wedding Cars</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-green-100 md:ml-2">
                                {{ $vehicle->year }} {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('booking_success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mx-4 mt-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('booking_success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col xl:flex-row gap-8">
            <!-- Left Column - Car Details -->
            <div class="xl:w-2/3">
                <!-- Car Title & Price -->
                <div class="mb-8 border-b border-gray-200 pb-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                {{ $vehicle->year }} {{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }} {{ $vehicle->trim }}
                            </h1>
                            <div class="flex items-center mb-4">
                                <span class="bg-gradient-to-r from-green-600 to-green-600 text-white px-4 py-1 rounded-full text-sm font-medium mr-3">
                                     Wedding Special
                                </span>
                                @if($vehicle->is_featured)
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                         Premium
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-green-600 to-green-600 text-white px-6 py-4 rounded-xl shadow-lg">
                            <div class="text-sm text-green-100">Starting from</div>
                            <div class="text-2xl font-bold">TZS {{ number_format($vehicle->rent_price) }}</div>
                            <div class="text-sm text-green-100">per day</div>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-600 mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $vehicle->location ?? 'Available in multiple locations' }}</span>
                    </div>
                </div>
                
                <!-- Car Images Gallery -->
                <div class="mb-10" x-data="{ activeSlide: 0, fitMode: 'contain' }">
                    <div class="relative rounded-xl overflow-hidden mb-4 bg-gray-100 shadow-lg">
                        <div class="relative w-full" style="padding-bottom: 56.25%;">
                          

                        @forelse($vehicle->images as $index => $image)

                                <div x-show="activeSlide === {{ $index }}" class="absolute inset-0 w-full h-full">
                                    <img 
                                        src="{{ $image ? asset('storage/' . $image) : asset('default/car1.jpg') }}" 
                                        alt="Wedding Car {{ $index + 1 }}" 
                                        class="w-full h-full transition-all duration-300"
                                        :class="fitMode === 'contain' ? 'object-contain' : 'object-cover'"
                                        onerror="this.onerror=null; this.src='{{ asset('default/car1.jpg') }}';"
                                    />
                                </div>
                            @empty
                                <div class="absolute inset-0 w-full h-full">
                                    <img src="{{ asset('/default/car1.jpg') }}" 
                                         alt="Wedding Car Placeholder" 
                                         class="w-full h-full object-cover">
                                </div>
                            @endforelse
                            
                            @if(count($vehicle->images) > 1)
                                <!-- Navigation Arrows -->
                                <button @click="activeSlide = activeSlide === 0 ? {{ count($vehicle->images) - 1 }} : activeSlide - 1" 
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition-colors duration-200 z-10">
                                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button @click="activeSlide = activeSlide === {{ count($vehicle->images) - 1 }} ? 0 : activeSlide + 1" 
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition-colors duration-200 z-10">
                                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif
                            
                            <!-- Controls Overlay -->
                            <div class="absolute bottom-4 left-0 right-0 flex justify-between items-center px-6 z-10">
                                @if(count($vehicle->images) > 0)
                                    <div class="bg-black/60 text-white text-sm px-3 py-2 rounded-full">
                                        <span x-text="(activeSlide + 1) + ' / ' + {{ count($vehicle->images) }}"></span>
                                    </div>
                                    
                                    <button @click="fitMode = fitMode === 'contain' ? 'cover' : 'contain'" 
                                            class="bg-black/60 hover:bg-black/80 text-white text-sm px-3 py-2 rounded-full transition-colors duration-200">
                                        <span x-text="fitMode === 'contain' ? 'Fill' : 'Fit'"></span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thumbnails -->
                    @if(count($vehicle->images) > 1)
                        <div class="grid grid-cols-6 md:grid-cols-8 gap-2">
                            @foreach($vehicle->images as $index => $image)
                                <button @click="activeSlide = {{ $index }}" class="focus:outline-none">
                                    <div class="relative aspect-w-4 aspect-h-3 rounded-md overflow-hidden group">
                                        <img 
                                            src="{{ $image ? asset('storage/' . $image) : asset('default/car1.jpg') }}" 
                                            alt="Thumbnail {{ $index + 1 }}" 
                                            class="w-full h-full object-cover transition-all duration-200"
                                            :class="activeSlide === {{ $index }} ? 'ring-2 ring-green-500' : 'ring-1 ring-gray-200 group-hover:ring-gray-300'"
                                        />
                                        <div x-show="activeSlide === {{ $index }}" class="absolute inset-0 bg-green-500/20"></div>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Car Specifications -->
                <div class="mb-10 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-green-50 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <span class="text-2xl mr-3"> </span>
                            Vehicle Specifications
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"> </div>
                                <div class="text-sm text-gray-500 mb-1">Year</div>
                                <div class="font-bold text-gray-900">{{ $vehicle->year }}</div>
                            </div>
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"> </div>
                                <div class="text-sm text-gray-500 mb-1">Mileage</div>
                                <div class="font-bold text-gray-900">{{ number_format($vehicle->mileage) }} km</div>
                            </div>
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"> </div>
                                <div class="text-sm text-gray-500 mb-1">Fuel Type</div>
                                <div class="font-bold text-gray-900">{{ optional($vehicle->fuelType)->name ?? 'Petrol' }}</div>
                            </div>
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"> </div>
                                <div class="text-sm text-gray-500 mb-1">Transmission</div>
                                <div class="font-bold text-gray-900">{{ optional($vehicle->transmission)->name ?? 'Automatic' }}</div>
                            </div>
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"> </div>
                                <div class="text-sm text-gray-500 mb-1">Color</div>
                                <div class="font-bold text-gray-900 capitalize">{{ $vehicle->color }}</div>
                            </div>
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"></div>
                                <div class="text-sm text-gray-500 mb-1">Seating</div>
                                <div class="font-bold text-gray-900">{{ $vehicle->seating_capacity ?? '4' }} Seats</div>
                            </div>
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"> </div>
                                <div class="text-sm text-gray-500 mb-1">Body Type</div>
                                <div class="font-bold text-gray-900">{{ optional($vehicle->bodyType)->name ?? 'Sedan' }}</div>
                            </div>
                            <div class="text-center bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl mb-2"> </div>
                                <div class="text-sm text-gray-500 mb-1">Condition</div>
                                <div class="font-bold text-gray-900 capitalize">{{ $vehicle->vehicle_condition ?? 'Excellent' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($vehicle->description)
                <div class="mb-10 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-green-50 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-gray-800">About This Wedding Car</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">{{ $vehicle->description }}</p>
                    </div>
                </div>
                @endif

                <!-- Similar Cars -->
                @if($similarCars->count() > 0)
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="text-2xl mr-3">💒</span>
                        Similar Wedding Cars
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($similarCars as $similarCar)
                            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
                                <div class="relative">
                                    @php
                                        $frontImage = $similarCar->frontView();
                                    @endphp
                                    <img 
                                        src="{{ $frontImage ? asset('storage/' . $frontImage->image_url) : asset('default/car1.jpg') }}" 
                                        alt="{{ optional($similarCar->make)->name }} {{ optional($similarCar->model)->name }}" 
                                        class="w-full h-40 object-cover"
                                    />
                                    <div class="absolute top-3 right-3 bg-gradient-to-r from-green-600 to-green-600 text-white px-2 py-1 rounded text-xs font-bold">
                                        TZS {{ number_format($similarCar->rent_price) }}/day
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-800 mb-2">
                                        {{ optional($similarCar->make)->name }} {{ optional($similarCar->model)->name }}
                                    </h3>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">{{ $similarCar->year }}</span>
                                        <a href="{{ route('wedding.car.detail', $similarCar->id) }}" 
                                            class="text-sm font-medium text-green-600 hover:text-green-800">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Booking Form & Dealer Info -->
            <div class="xl:w-1/3 space-y-8">
                <!-- Package Selection & Booking Form -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden sticky top-4">
                    <div class="bg-gradient-to-r from-green-600 to-green-600 text-white px-6 py-4">
                        <h2 class="text-xl font-bold flex items-center">
                            <span class="text-2xl mr-3"></span>
                            Book Your Wedding Car
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <!-- Package Selection -->
                        <!-- <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Select Package</label>
                            <div class="space-y-3">
                                @foreach($packages as $key => $package)
                                    <label class="relative flex cursor-pointer">
                                        <input type="radio" wire:model="selectedPackage" value="{{ $key }}" class="sr-only">
                                        <div class="flex-1 flex items-start p-4 border-2 rounded-lg transition-colors duration-200"
                                             :class="$wire.selectedPackage === '{{ $key }}' ? 'border-green-500 bg-green-50' : 'border-gray-200 hover:border-gray-300'">
                                            <div class="flex-1">
                                                <div class="flex items-center mb-2">
                                                    <h4 class="font-medium text-gray-900">{{ $package['name'] }}</h4>
                                                    <span class="ml-2 text-sm text-green-600 font-semibold">
                                                        +{{ ($package['multiplier'] - 1) * 100 }}%
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-2">{{ $package['description'] }}</p>
                                                <ul class="text-xs text-gray-500">
                                                    @foreach($package['includes'] as $include)
                                                        <li class="flex items-center mb-1">
                                                            <svg class="w-3 h-3 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            {{ $include }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div> -->

                        <!-- Rental Duration -->
                        <div class="mb-6">
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Rental Duration (Days)</label>
                            <select wire:model="rentalDuration" id="duration" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200">
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="3">3 Days</option>
                                <option value="4">4 Days</option>
                                <option value="5">5 Days</option>
                            </select>
                        </div>

                        <!-- Price Calculation -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Price Breakdown</h4>
                            <div class="space-y-1 text-sm">
                                <div class="flex justify-between">
                                    <span>Base Rate ({{ $rentalDuration }} day{{ $rentalDuration > 1 ? 's' : '' }})</span>
                                    <span>TZS {{ number_format($vehicle->rent_price * $rentalDuration) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>{{ $packages[$selectedPackage]['name'] }}</span>
                                    <span>+{{ ($packages[$selectedPackage]['multiplier'] - 1) * 100 }}%</span>
                                </div>
                                <div class="border-t pt-2 mt-2 flex justify-between font-bold text-green-600">
                                    <span>Total</span>
                                    <span>TZS {{ number_format($totalPrice) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Event Details -->
                        <div class="space-y-4 mb-6">
                            <div>
                                <label for="eventDate" class="block text-sm font-medium text-gray-700 mb-2">Event Date *</label>
                                <input type="date" wire:model="eventDate" id="eventDate" 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200">
                                @error('eventDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="eventTime" class="block text-sm font-medium text-gray-700 mb-2">Event Time *</label>
                                <input type="time" wire:model="eventTime" id="eventTime" 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200">
                            </div>

                            <div>
                                <label for="pickupLocation" class="block text-sm font-medium text-gray-700 mb-2">Pickup Location *</label>
                                <input type="text" wire:model="pickupLocation" id="pickupLocation" placeholder="Enter pickup address" 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200">
                                @error('pickupLocation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="space-y-4 mb-6">
                            <h4 class="font-medium text-gray-900">Your Details</h4>
                            
                            <div>
                                <label for="customerName" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" wire:model="customerName" id="customerName" placeholder="Enter your full name" 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200">
                                @error('customerName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="customerPhone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" wire:model="customerPhone" id="customerPhone" placeholder="e.g. +255123456789" 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200">
                                @error('customerPhone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="customerEmail" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" wire:model="customerEmail" id="customerEmail" placeholder="your@email.com" 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200">
                                @error('customerEmail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="specialRequests" class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                                <textarea wire:model="specialRequests" id="specialRequests" rows="3" 
                                    placeholder="Any special decoration preferences, routes, or requirements..." 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200"></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button wire:click="submitBooking" 
                            class="w-full bg-gradient-to-r from-green-600 to-green-600 hover:from-green-600 hover:to-green-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Book Now - TZS {{ number_format($totalPrice) }}
                        </button>
                        
                        <p class="text-xs text-gray-500 mt-2 text-center">
                            * This is a booking request. Final confirmation will be provided by the dealer.
                        </p>
                    </div>
                </div>

                <!-- Dealer Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-green-50 p-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <img src="{{ asset('/cars/icon.avif') }}" alt="{{ optional($vehicle->dealer)->name }}" 
                                class="h-16 w-16 rounded-full object-cover border-2 border-white shadow-md">
                            <div class="ml-4">
                                <h2 class="text-lg font-bold text-gray-900">{{ optional($vehicle->dealer)->name }}</h2>
                                <div class="flex items-center mt-1">
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= (optional($vehicle->dealer)->rating ?? 5) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span class="ml-1 text-sm text-gray-600">({{ optional($vehicle->dealer)->reviews_count ?? '15' }} reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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
                                    <p class="text-sm text-gray-600 mt-1">{{ optional($vehicle->dealer)->address ?? 'Dar es Salaam, Tanzania' }}</p>
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
                                    <p class="text-sm text-gray-600 mt-1">{{ optional($vehicle->dealer)->contact_person_phone ?? '+255123456789' }}</p>
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
                                    <p class="text-sm text-gray-600 mt-1">{{ optional($vehicle->dealer)->email ?? 'info@dealer.com' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- WhatsApp Contact Button -->
                        <div class="mt-6">
                            @php
                                $phoneNumber = preg_replace('/[^0-9]/', '', optional($vehicle->dealer)->contact_person_phone ?? '+255123456789');
                                
                                if(strlen($phoneNumber) > 0 && !Str::startsWith($phoneNumber, '255') && Str::startsWith($phoneNumber, '0')) {
                                    $phoneNumber = '255' . substr($phoneNumber, 1);
                                }
                                
                                $message = "Hello! I'm interested in renting your " . $vehicle->year . " " . 
                                          optional($vehicle->make)->name . " " . optional($vehicle->model)->name . 
                                          " for my wedding. Can you please provide more details about availability and pricing?";
                                
                                $encodedMessage = urlencode($message);
                                $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
                            @endphp

                            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" 
                               class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg 
                                      transition duration-300 flex items-center justify-center group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" 
                                     class="h-5 w-5 mr-2 fill-current transition-transform duration-300 group-hover:scale-110">
                                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                </svg>
                                Chat on WhatsApp
                            </a>

                            @if(!empty(optional($vehicle->dealer)->contact_person_phone))
                                <div class="flex justify-between items-center mt-3">
                                    <p class="text-sm text-gray-600">
                                        {{ optional($vehicle->dealer)->contact_person_phone }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ optional($vehicle->dealer)->contact_person_name ?? 'Wedding Car Specialist' }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Wedding Services Info -->
                <div class="bg-gradient-to-br from-green-600 to-green-600 text-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <span class="text-2xl mr-3">💒</span>
                            Wedding Car Services
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Professional wedding chauffeur</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Beautiful floral decorations</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Red carpet service</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Flexible pickup & drop-off</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Photography assistance</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-4 bg-white/20 rounded-lg">
                            <p class="text-sm">
                                <strong>💡 Pro Tip:</strong> Book early to secure your preferred date and get the best package deals for your special day!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Why Couples Choose Us</h3>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <div class="text-2xl mb-2">🏆</div>
                            <div class="text-sm font-medium text-gray-900">Premium Quality</div>
                            <div class="text-xs text-gray-500">Luxury vehicles only</div>
                        </div>
                        <div>
                            <div class="text-2xl mb-2">⭐</div>
                            <div class="text-sm font-medium text-gray-900">5-Star Service</div>
                            <div class="text-xs text-gray-500">Rated by couples</div>
                        </div>
                        <div>
                            <div class="text-2xl mb-2">🛡️</div>
                            <div class="text-sm font-medium text-gray-900">Fully Insured</div>
                            <div class="text-xs text-gray-500">Complete coverage</div>
                        </div>
                        <div>
                            <div class="text-2xl mb-2">💝</div>
                            <div class="text-sm font-medium text-gray-900">Special Packages</div>
                            <div class="text-xs text-gray-500">Wedding exclusive</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add custom styles -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-in-out;
        }
        
        /* Custom scrollbar for thumbnails */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>

    <!-- Alpine.js for interactive elements -->
</div>

</div>
