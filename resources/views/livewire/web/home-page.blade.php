<div>


<!-- resources/views/livewire/home-page.blade.php -->
<div class="bg-white w-full">
    <!-- Hero Section with Slideshow -->
    <div class="relative" x-data="{ activeSlide: 0, slides: [
        { image: '{{ asset('/cars/66815.jpg') }}', title: 'Find Your Dream Car', description: 'Browse our exclusive collection of premium vehicles', buttonText: 'Explore Now' },
        { image: '{{ asset('/cars/11452727.png') }}', title: 'Connect With Top Dealers', description: 'Direct access to the most trusted dealers in the country', buttonText: 'View Dealers' },
        { image: '{{ asset('/cars/blue-car-driving-road.jpg') }}', title: 'Best Deals Guaranteed', description: 'Quality vehicles at competitive prices', buttonText: 'See Deals' }
    ] }" x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 5000)">
        <!-- Slideshow -->
        <div class="relative h-[500px] md:h-[600px] w-full overflow-hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" 
                    x-transition:enter="transition ease-out duration-500" 
                    x-transition:enter-start="opacity-0 transform scale-105" 
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300" 
                    x-transition:leave-start="opacity-100 transform scale-100" 
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="absolute inset-0">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <img :src="slide.image" class="w-full h-full object-cover" :alt="slide.title">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center max-w-4xl px-4">
                            <h1 x-text="slide.title" class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg"></h1>
                            <p x-text="slide.description" class="text-xl md:text-2xl text-white mb-8 drop-shadow-md"></p>
                            <button x-text="slide.buttonText" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg text-lg font-semibold transition duration-300 transform hover:scale-105 shadow-lg"></button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        
        <!-- Slide indicators -->
        <div class="absolute bottom-5 left-0 right-0 flex justify-center space-x-3">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                    :class="{ 'w-12 bg-green-600': activeSlide === index, 'w-6 bg-white/60': activeSlide !== index }"
                    class="h-2 rounded-full transition-all duration-300 focus:outline-none"></button>
            </template>
        </div>
        
        <!-- Arrow Navigation -->
        <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" 
            class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center rounded-full bg-white/30 backdrop-blur-sm text-white hover:bg-white/50 transition duration-300 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" 
            class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center rounded-full bg-white/30 backdrop-blur-sm text-white hover:bg-white/50 transition duration-300 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <!-- Quick Filter and Search Section -->
    <div class="bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Find Your Perfect Vehicle</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="make" class="block text-sm font-medium text-gray-700 mb-1">Make</label>
                            <select wire:model="selectedMake" id="make" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                <option value="">All Makes</option>
                                @foreach($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                            <select wire:model="selectedModel" id="model" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                <option value="">All Models</option>
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                            <select wire:model="priceRange" id="price" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                <option value="">Any Price</option>
                                <option value="0-5000000">Under 5M</option>
                                <option value="5000000-15000000">5M - 15M</option>
                                <option value="15000000-30000000">15M - 30M</option>
                                <option value="30000000-50000000">30M - 50M</option>
                                <option value="50000000-999999999">Over 50M</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-center">
                        <button wire:click="searchVehicles" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            Search Vehicles
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Vehicles Section -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Featured Vehicles</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Discover our handpicked selection of premium vehicles from trusted dealers</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredVehicles as $vehicle)
                
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition duration-300 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="relative">

                    
                    <img
                            src="{{ asset('cars/blue-car-driving-road.jpg') }}"
                            alt="{{ optional($vehicle->make)->name }} {{ optional($vehicle->model)->name }}"
                            class="w-full h-56 object-cover"
                            />
                        <div class="absolute top-3 right-3">
                            <span class="bg-green-600 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-md">Featured</span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                            <!-- <h3 class="text-xl font-bold text-white">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}</h3> -->
                            <p class="text-white/90">{{ $vehicle->trim }}</p>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-green-600">TZS {{ number_format($vehicle->price) }}</span>
                            <span class="text-gray-600 text-sm">{{ $vehicle->mileage }} km</span>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H11a1 1 0 001-1v-1h3.05a2.5 2.5 0 014.9 0H20a1 1 0 001-1V5a1 1 0 00-1-1H3z" />
                                </svg>
                                {{ $vehicle->body_type }}
                            </span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                </svg>
                                {{ $vehicle->fuel_type }}
                            </span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $vehicle->year }}
                            </span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                                <!-- {{ $vehicle->transmission }} -->
                            </span>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('/cars/icon.avif') }}" alt="{{ $vehicle->dealer->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $vehicle->dealer->name }}</p>
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

    <!-- Featured Dealers Section -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Top Dealers</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Connecting you with the most trusted vehicle dealers</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($topDealers as $dealer)

                <div class="bg-white rounded-xl shadow-md p-6 text-center transition duration-300 hover:shadow-lg transform hover:-translate-y-1">
                    <img src="{{ asset('/cars/icon.avif') }}" alt="{{ $dealer->name }}" class="w-24 h-24 mx-auto rounded-full object-cover border-4 border-gray-200">
                   
                    <h3 class="mt-4 text-xl font-bold text-gray-900">{{ $dealer->name }}</h3>
                    <p class="mt-2 text-gray-600">{{ $dealer->location }}</p>
                    <div class="mt-3 flex justify-center">
                        <div class="flex items-center">

                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $dealer->rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            
                            <span class="ml-2 text-sm text-gray-600">({{ $dealer->reviews_count }} reviews)</span>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-gray-600">{{ $dealer->vehicles_count }} vehicles in stock</p>
                    <a href="#" class="mt-4 inline-block text-green-600 hover:text-green-800 font-medium">
                        View Inventory
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Why Choose Our Platform</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">We're committed to providing the best vehicle shopping experience</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Verified Dealers</h3>
                    <p class="text-gray-600">All our dealers go through a strict verification process to ensure reliability and quality service.</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Secure Transactions</h3>
                    <p class="text-gray-600">Our platform ensures your interactions and transactions with dealers are secure and protected.</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Expert Support</h3>
                    <p class="text-gray-600">Our team of automotive experts is always ready to assist you with any questions or concerns.</p>
                </div>
            </div>
        </div>
    </div>

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
