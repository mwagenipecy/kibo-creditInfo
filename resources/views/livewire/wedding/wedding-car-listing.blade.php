<div>
<div class="bg-white w-full">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-600 via-green-600 to-green-600 text-white py-8">
        <div class="container mx-auto px-4 text-start">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                  Car Rentals 
            </h1>
            <p class="text-xl md:text-2xl mb-2 text-green-100">
                Make your special day unforgettable with our luxury  cars
            </p>
            <div class="flex justify-start space-x-2 text-green-100">
                <span></span>
                <span>Premium Collection</span>
                <span>•</span>
                <span>Professional Service</span>
                <span>•</span>
                <span>Memorable Experience</span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- Enhanced Search Section -->
    <section class="bg-gradient-to-b from-gray-50 to-white py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto bg-white rounded-xl  border border-gray-100 overflow-hidden">
                <!-- Heading -->
                <div class="bg-gradient-to-r from-green-50 to-green-50 py-6 px-6 border-b border-gray-100">
                    <div class="flex items-start justify-start">
                        <span class="text-2xl mr-3"></span>
                        <h2 class="text-xl font-bold text-gray-800">Find Your Dream Wedding Car</h2>
                        <span class="text-2xl ml-3"></span>
                    </div>
                </div>
                
                <!-- Search Form -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                        <!-- Make Dropdown -->
                        <div>
                            <label for="make" class="block text-sm font-medium text-gray-700 mb-2">Make</label>
                            <select wire:model="selectedMake" id="make" 
                                class="w-full rounded-lg border-gray-300 py-3 pl-3 pr-8 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 shadow-sm">
                                <option value="">All Makes</option>
                                @foreach($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Model Dropdown -->
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                            <select wire:model="selectedModel" id="model" 
                                class="w-full rounded-lg border-gray-300 py-3 pl-3 pr-8 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 shadow-sm">
                                <option value="">All Models</option>
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Price Range -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Daily Rate</label>
                            <select wire:model="priceRange" id="price" 
                                class="w-full rounded-lg border-gray-300 py-3 pl-3 pr-8 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 shadow-sm">
                                <option value="">Any Price</option>
                                <option value="0-200000">Under 200K TZS</option>
                                <option value="200000-500000">200K - 500K TZS</option>
                                <option value="500000-1000000">500K - 1M TZS</option>
                                <option value="1000000-999999999">Over 1M TZS</option>
                            </select>
                        </div>
                        
                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" wire:model="location" id="location" placeholder="Enter city..." 
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 shadow-sm">
                        </div>
                        
                        <!-- Search Button -->
                        <div class="flex items-end">
                            <button wire:click="searchCars" 
                                class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-600 hover:to-green-600 text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                Search
                            </button>
                        </div>
                    </div>
                    
                    <!-- Quick Search Bar -->
                    <div class="mt-4">
                        <input type="text" wire:model.debounce.500ms="search" placeholder="Quick search by make, model, color, or year..." 
                            class="w-full rounded-lg border-gray-300 py-3 px-4 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-200 shadow-sm">
                    </div>
                    
                    <!-- Popular Searches -->
                    <div class="mt-4 flex flex-wrap gap-2 items-center">
                        <span class="text-sm text-gray-500">Popular:</span>
                        <button wire:click="$set('search', 'Mercedes')" class="text-sm text-green-600 hover:text-green-800 hover:underline">Mercedes</button>
                        <span class="text-gray-300">|</span>
                        <button wire:click="$set('search', 'BMW')" class="text-sm text-green-600 hover:text-green-800 hover:underline">BMW</button>
                        <span class="text-gray-300">|</span>
                        <button wire:click="$set('search', 'white')" class="text-sm text-green-600 hover:text-green-800 hover:underline">White Cars</button>
                        <span class="text-gray-300">|</span>
                        <button wire:click="$set('priceRange', '200000-500000')" class="text-sm text-green-600 hover:text-green-800 hover:underline">Budget Friendly</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wedding Cars Grid -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <!-- Results Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">
                    Available Wedding Cars
                    <span class="text-green-500">({{ $weddingCars->total() }} cars)</span>
                </h2>
                <div class="text-sm text-gray-600">
                    Showing {{ $weddingCars->count() }} of {{ $weddingCars->total() }} cars
                </div>
            </div>
            
            @if($weddingCars->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($weddingCars as $car)
                        <div class="bg-white rounded-xl  border border-gray-100 overflow-hidden group  hover:border-green-200 transition duration-300">
                            <!-- Car Image -->
                            <div class="relative aspect-[16/10] overflow-hidden">
                                @php
                                    $frontImage = $car->frontView();
                                @endphp
                                <img 
                                    src="{{ $frontImage ? asset('storage/' . $frontImage->image_url) : asset('default/car1.jpg') }}"
                                    onerror="this.onerror=null; this.src='{{ asset('default/car1.jpg') }}';"
                                    alt="{{ optional($car->make)->name }} {{ optional($car->model)->name }}"
                                    class="w-full h-full object-cover transition duration-300 group-hover:scale-110"
                                />
                                
                                <!-- Overlay Badges -->
                                <div class="absolute top-3 left-3 flex flex-col gap-2">
                                    @if($car->is_featured)
                                        <span class="inline-flex items-center px-2.5 py-1 bg-gradient-to-r from-green-600 to-green-500 text-white text-xs font-bold rounded-full shadow-lg">
                                            <span class="mr-1">⭐</span>
                                            PREMIUM
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center px-2.5 py-1 bg-black bg-opacity-75 text-white text-xs font-medium rounded-full">
                                        {{ $car->year }}
                                    </span>
                                </div>
                                
                                <!-- Wedding Badge -->
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center px-2.5 py-1 bg-white bg-opacity-90 text-green-600 text-xs font-bold rounded-full shadow-md">
                                         WEDDING
                                    </span>
                                </div>
                                
                                <!-- Price Tag -->
                                <div class="absolute bottom-3 right-3 bg-gradient-to-r from-green-600 to-green-500 text-white px-3 py-2 rounded-lg shadow-lg">
                                    <div class="text-xs text-green-100">Per Day</div>
                                    <div class="text-sm font-bold">TZS {{ number_format($car->rent_price) }}</div>
                                </div>
                            </div>
                            
                            <!-- Car Details -->
                            <div class="p-5">
                                <!-- Title -->
                                <div class="mb-3">
                                    <h3 class="font-bold text-gray-800 text-lg leading-tight">
                                        {{ optional($car->make)->name }} {{ optional($car->model)->name }}
                                        @if($car->trim)
                                            <span class="text-gray-600">{{ $car->trim }}</span>
                                        @endif
                                    </h3>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-sm text-gray-500">{{ number_format($car->mileage) }} km</span>
                                        <span class="text-sm font-medium text-green-600 capitalize">{{ $car->color }}</span>
                                    </div>
                                </div>
                                
                                <!-- Quick Specs -->
                                <div class="grid grid-cols-2 gap-3 mb-4 text-xs">
                                    <div class="flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H11a1 1 0 001-1v-1h3.05a2.5 2.5 0 014.9 0H20a1 1 0 001-1V5a1 1 0 00-1-1H3z" />
                                        </svg>
                                        {{ optional($car->bodyType)->name ?? 'Luxury' }}
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                        </svg>
                                        {{ optional($car->fuelType)->name ?? 'Petrol' }}
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $car->location ?? 'Available' }}
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $car->seating_capacity ?? '4' }} Seats
                                    </div>
                                </div>
                                
                                <!-- Dealer Info & Action -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <img src="{{ asset('/cars/icon.avif') }}" alt="{{ optional($car->dealer)->name }}" 
                                            class="w-8 h-8 rounded-full object-cover border-2 border-green-200">
                                        <div class="ml-2">
                                            <p class="text-xs font-medium text-gray-700 truncate max-w-[100px]">
                                                {{ optional($car->dealer)->name }}
                                            </p>
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-3 h-3 {{ $i <= (optional($car->dealer)->rating ?? 5) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('wedding.car.detail', $car->id) }}" 
                                        class="inline-flex items-center text-sm font-bold text-white bg-gradient-to-r from-green-600 to-green-500 hover:from-green-600 hover:to-green-600 px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                        View Details
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-12">
                    {{ $weddingCars->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="text-6xl mb-4">💒</div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No Wedding Cars Found</h3>
                        <p class="text-gray-500 mb-6">We couldn't find any wedding cars matching your criteria. Try adjusting your search filters.</p>
                        <button wire:click="$set('search', '')" 
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                            Clear Filters
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </section>
    
    <!-- Wedding Services Info -->
    <section class="py-16 bg-gradient-to-r from-green-50 to-green-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Why Choose Our Wedding Cars?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Premium Collection</h3>
                    <p class="text-gray-600">Luxury and elegant cars perfect for your special day</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Professional Chauffeur</h3>
                    <p class="text-gray-600">Experienced drivers dressed for the occasion</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <!-- <div class="text-4xl mb-4">💐</div> -->
                    <h3 class="text-xl font-semibold mb-2">Wedding Decoration</h3>
                    <p class="text-gray-600">Beautiful floral arrangements and ribbons included</p>
                </div>
            </div>
        </div>
    </section>
</div>


</div>
