<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Vehicles</h1>
            <p class="text-gray-600">Manage your vehicle listings</p>
        </div>

        <div class="mb-4 flex justify-between items-center">
            <div class="flex gap-4">
                <input 
                    type="text" 
                    wire:model="searchTerm" 
                    placeholder="Search vehicles..." 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                >
                <select 
                    wire:model="statusFilter" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                >
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="sold">Sold</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            <a 
                href="{{ route('register.vehicle') }}" 
                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
            >
                + Register New Vehicle
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Pending Negotiations -->
        @if(isset($pendingNegotiations) && count($pendingNegotiations) > 0)
            <div class="mb-6 bg-orange-50 border border-orange-200 rounded-lg p-4">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        {{ count($pendingNegotiations) }} Price Negotiation Request(s)
                    </h3>
                    <button wire:click="viewNegotiations" class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                        View All →
                    </button>
                </div>
            </div>
        @else
            <!-- Debug: Show this if there are no negotiations -->
            {{-- <div class="mb-4 text-sm text-gray-600">
                Debug: No negotiations found for seller_id {{ Auth::id() }}
            </div> --}}
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Year</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Mileage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($vehicles as $vehicle)
                            @php
                                $frontImage = $vehicle->images()->where('view', 'front')->first();
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img 
                                            src="{{ $frontImage ? asset($frontImage->image_url) : asset('/default/default-car.jpg') }}" 
                                            alt="Vehicle"
                                            class="h-12 w-12 rounded-lg object-cover mr-3"
                                        >
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $vehicle->make->name ?? 'N/A' }} {{ $vehicle->model->name ?? 'N/A' }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $vehicle->color ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $vehicle->year }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($vehicle->mileage) }} km
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                    TSh {{ number_format($vehicle->price) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded 
                                                                                    @if($vehicle->status == 'active') bg-green-100 text-green-800
                                        @elseif($vehicle->status == 'sold') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($vehicle->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex gap-2">
                                        <button 
                                            wire:click="viewVehicle({{ $vehicle->id }})"
                                            class="text-green-600 hover:text-green-900"
                                        >
                                            View
                                        </button>
                                        <span class="text-gray-300">|</span>
                                        <a 
                                            href="{{ route('edit.vehicle', $vehicle->id) }}" 
                                            class="text-gray-600 hover:text-gray-900"
                                        >
                                            Edit
                                        </a>
                                        @php
                                            $vehicleNegotiations = \App\Models\VehicleNegotiation::where('vehicle_id', $vehicle->id)
                                                ->whereIn('status', ['pending', 'accepted'])
                                                ->get();
                                            $hasUnreadMessages = $vehicleNegotiations->filter(function($neg) {
                                                return $neg->messages->where('sender_id', '!=', Auth::id())
                                                    ->where('created_at', '>', now()->subMinutes(5))
                                                    ->count() > 0;
                                            })->count();
                                        @endphp
                                        @if($vehicleNegotiations->count() > 0)
                                            <span class="text-gray-300">|</span>
                                            <button 
                                                wire:click="openVehicleChat({{ $vehicle->id }})"
                                                class="text-blue-600 hover:text-blue-900 relative {{ $vehicle->status == 'on_hold' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $vehicle->status == 'on_hold' ? 'disabled' : '' }}
                                                title="{{ $vehicle->status == 'on_hold' ? 'Vehicle is on hold' : '' }}"
                                            >
                                                Chat
                                                @if($hasUnreadMessages > 0)
                                                    <span class="absolute -top-1 -right-1 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                                                @endif
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-gray-600 mb-4">No vehicles found. Start by registering a new vehicle!</p>
                                    <a 
                                        href="{{ route('register.vehicle') }}" 
                                        class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                                    >
                                        Register Your First Vehicle
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $vehicles->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($showModal && $selectedVehicle)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModal">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white" wire:click.stop>
                <div class="mt-3">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">
                            Vehicle Details
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Vehicle Images -->
                        <div>
                            @php
                                $images = is_array($selectedVehicle->images) ? collect($selectedVehicle->images) : $selectedVehicle->images;
                                $frontImg = $images->where('view', 'front')->first();
                                $sideImg = $images->where('view', 'side')->first();
                                $backImg = $images->where('view', 'back')->first();
                                $additionalImgs = $images->where('view', 'additional');
                            @endphp
                            
                            @if($frontImg)
                                <img src="{{ asset('storage/' . $frontImg->image_url) }}" alt="Front view" class="w-full h-64 object-cover rounded-lg mb-3">
                            @endif
                            
                            <div class="grid grid-cols-3 gap-3">
                                @if($sideImg)
                                    <img src="{{ asset('storage/' . $sideImg->image_url) }}" alt="Side view" class="h-24 object-cover rounded">
                                @endif
                                @if($backImg)
                                    <img src="{{ asset('storage/' . $backImg->image_url) }}" alt="Back view" class="h-24 object-cover rounded">
                                @endif
                                @foreach($additionalImgs->take(1) as $img)
                                    <img src="{{ asset('storage/' . $img->image_url) }}" alt="Additional view" class="h-24 object-cover rounded">
                                @endforeach
                            </div>
                        </div>

                        <!-- Vehicle Information -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-3 text-lg">
                                    {{ $selectedVehicle->make->name ?? 'N/A' }} {{ $selectedVehicle->model->name ?? 'N/A' }}
                                    @if($selectedVehicle->trim)
                                        - {{ $selectedVehicle->trim }}
                                    @endif
                                </h4>
                                
                                <p class="text-green-600 font-bold text-2xl mb-4">
                                    TSh {{ number_format($selectedVehicle->price) }}
                                </p>

                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <span class="text-gray-600">Year:</span>
                                        <span class="font-medium">{{ $selectedVehicle->year }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Color:</span>
                                        <span class="font-medium">{{ $selectedVehicle->color }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Mileage:</span>
                                        <span class="font-medium">{{ number_format($selectedVehicle->mileage) }} km</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Condition:</span>
                                        <span class="font-medium">{{ $selectedVehicle->vehicle_condition }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Body Type:</span>
                                        <span class="font-medium">{{ $selectedVehicle->bodyType->name ?? 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Fuel Type:</span>
                                        <span class="font-medium">{{ $selectedVehicle->fuelType->name ?? 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Transmission:</span>
                                        <span class="font-medium">{{ $selectedVehicle->transmission->name ?? 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Location:</span>
                                        <span class="font-medium">{{ $selectedVehicle->location }}</span>
                                    </div>
                                    @if($selectedVehicle->engine_size)
                                        <div>
                                            <span class="text-gray-600">Engine:</span>
                                            <span class="font-medium">{{ $selectedVehicle->engine_size }}</span>
                                        </div>
                                    @endif
                                    @if($selectedVehicle->horsepower)
                                        <div>
                                            <span class="text-gray-600">Horsepower:</span>
                                            <span class="font-medium">{{ $selectedVehicle->horsepower }} HP</span>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="text-gray-600">VIN:</span>
                                        <span class="font-medium">{{ $selectedVehicle->vin }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Status:</span>
                                        <span class="px-2 py-1 text-xs rounded 
                                            @if($selectedVehicle->status == 'active') bg-green-100 text-green-800
                                            @elseif($selectedVehicle->status == 'sold') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ ucfirst($selectedVehicle->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if($selectedVehicle->description)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-900 mb-2">Description</h4>
                                    <p class="text-sm text-gray-700">{{ $selectedVehicle->description }}</p>
                                </div>
                            @endif

                            <div class="flex flex-col gap-3">
                                <div class="flex gap-3">
                                    <a 
                                        href="{{ route('edit.vehicle', $selectedVehicle->id) }}" 
                                        class="flex-1 px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition-colors"
                                    >
                                        Edit Vehicle
                                    </a>
                                    @if($selectedVehicle->status != 'sold')
                                        <button 
                                            wire:click="setAsSold({{ $selectedVehicle->id }})" 
                                            onclick="return confirm('Are you sure you want to mark this vehicle as sold?')"
                                            class="flex-1 px-4 py-2 bg-orange-600 text-white text-center rounded-lg hover:bg-orange-700 transition-colors"
                                        >
                                            Set as Sold
                                        </button>
                                    @endif
                                </div>
                                @if($selectedVehicle->status == 'on_hold')
                                    <button 
                                        wire:click="setToActive({{ $selectedVehicle->id }})" 
                                        onclick="return confirm('Are you sure you want to set this vehicle back to active? This will allow buyers to negotiate again.')"
                                        class="w-full px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition-colors"
                                    >
                                        Set to Active
                                    </button>
                                @endif
                                <button 
                                    wire:click="closeModal" 
                                    class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Negotiations Modal -->
    @if($showNegotiations)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeNegotiations">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white" wire:click.stop>
                <div class="mt-3">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">
                            @if($selectedVehicleId)
                                Vehicle Negotiations
                            @else
                                All Price Negotiations
                            @endif
                        </h3>
                        <button wire:click="closeNegotiations" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Filter Buttons -->
                    <div class="flex gap-2 mb-4 overflow-x-auto pb-2">
                        <button wire:click="$set('negotiationFilter', 'all')" 
                                class="px-4 py-2 {{ !isset($negotiationFilter) || $negotiationFilter == 'all' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg whitespace-nowrap text-sm">
                            All
                        </button>
                        <button wire:click="$set('negotiationFilter', 'pending')" 
                                class="px-4 py-2 {{ isset($negotiationFilter) && $negotiationFilter == 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg whitespace-nowrap text-sm">
                            Pending
                        </button>
                        <button wire:click="$set('negotiationFilter', 'accepted')" 
                                class="px-4 py-2 {{ isset($negotiationFilter) && $negotiationFilter == 'accepted' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg whitespace-nowrap text-sm">
                            Accepted
                        </button>
                        <button wire:click="$set('negotiationFilter', 'completed')" 
                                class="px-4 py-2 {{ isset($negotiationFilter) && $negotiationFilter == 'completed' ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg whitespace-nowrap text-sm">
                            Completed
                        </button>
                    </div>
                    
                    <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Buyer</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Vehicle</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Offer</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Last Message</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Time</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $negotiations = $selectedVehicleId ? $vehicleNegotiations : (isset($pendingNegotiations) ? $pendingNegotiations : []);
                                    if (isset($negotiationFilter) && $negotiationFilter != 'all') {
                                        $negotiations = $negotiations->filter(function($neg) use ($negotiationFilter) {
                                            return $neg->status == $negotiationFilter;
                                        });
                                    }
                                @endphp
                                @forelse($negotiations as $negotiation)
                                    @php
                                        $hasUnreadMessages = $negotiation->messages->where('sender_id', '!=', Auth::id())
                                            ->where('created_at', '>', now()->subMinutes(5))
                                            ->count() > 0;
                                        $lastMessage = $negotiation->messages->last();
                                    @endphp
                                    <tr class="hover:bg-gray-50 {{ $hasUnreadMessages ? 'bg-blue-50' : '' }}">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                                    {{ substr($negotiation->buyer->name ?? 'U', 0, 1) }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-900">{{ $negotiation->buyer->name ?? 'Unknown Buyer' }}</span>
                                                @if($hasUnreadMessages)
                                                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $negotiation->vehicle->make->name ?? 'N/A' }} {{ $negotiation->vehicle->model->name ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-orange-600">TSh {{ number_format($negotiation->offered_price) }}</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded 
                                                @if($negotiation->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($negotiation->status == 'accepted') bg-green-100 text-green-800
                                                @elseif($negotiation->status == 'completed') bg-blue-100 text-blue-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($negotiation->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            @if($lastMessage)
                                                <div class="text-xs text-gray-500 truncate max-w-xs">
                                                    {{ $lastMessage->message }}
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400">No messages</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-500">
                                            {{ $negotiation->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($negotiation->status == 'pending')
                                                <div class="flex gap-2">
                                                    <button wire:click="acceptNegotiation({{ $negotiation->id }})" 
                                                            class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-xs">
                                                        Accept
                                                    </button>
                                                    <button wire:click="rejectNegotiation({{ $negotiation->id }})" 
                                                            class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-xs">
                                                        Reject
                                                    </button>
                                                </div>
                                            @elseif($negotiation->status == 'accepted')
                                                <button wire:click.prevent="openChat({{ $negotiation->id }})" 
                                                        type="button"
                                                        class="px-4 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-xs">
                                                    Chat
                                                </button>
                                            @elseif($negotiation->status == 'completed')
                                                <span class="px-3 py-1 bg-green-700 text-white rounded-lg text-xs">✓ Done</span>
                                            @else
                                                <span class="px-3 py-1 bg-gray-400 text-white rounded-lg text-xs">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-12 text-center">
                                            <p class="text-gray-600">No negotiations found for this filter.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Chat Modal -->
    @if($showChatModal && $selectedNegotiation)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[60]" wire:click="closeChat">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white" wire:click.stop>
                <div class="flex flex-col h-[600px]">
                    <!-- Chat Header -->
                    <div class="flex justify-between items-center mb-4 pb-4 border-b">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Chat</h3>
                            <p class="text-sm text-gray-600">{{ $selectedNegotiation->buyer->name ?? 'Buyer' }} - {{ $selectedNegotiation->vehicle->make->name ?? '' }} {{ $selectedNegotiation->vehicle->model->name ?? '' }}</p>
                            <p class="text-xs text-gray-500">Offered: TSh {{ number_format($selectedNegotiation->offered_price) }}</p>
                        </div>
                        <button wire:click="closeChat" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Chat Messages -->
                    <div class="flex-1 overflow-y-auto mb-4 space-y-4 chat-messages" 
                         id="seller-chat-messages"
                         x-data
                         x-init="setTimeout(() => $el.scrollTop = $el.scrollHeight, 100)"
                         wire:poll.2s>
                        @if($selectedNegotiation->messages->count() > 0)
                            @foreach($selectedNegotiation->messages as $message)
                                <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-xs md:max-w-md">
                                        <div class="flex items-start gap-2">
                                            @if($message->sender_id != Auth::id())
                                                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm font-medium">
                                                    {{ substr($message->sender->name ?? 'U', 0, 1) }}
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <p class="text-xs text-gray-500 mb-1 {{ $message->sender_id == Auth::id() ? 'text-right' : '' }}">
                                                    {{ $message->sender->name ?? 'Unknown' }}
                                                </p>
                                                <div class="px-4 py-2 rounded-lg {{ $message->sender_id == Auth::id() ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-900' }}">
                                                    <p class="text-sm">{{ $message->message }}</p>
                                                </div>
                                                <p class="text-xs text-gray-400 mt-1 {{ $message->sender_id == Auth::id() ? 'text-right' : '' }}">
                                                    {{ $message->created_at->format('H:i') }}
                                                </p>
                                            </div>
                                            @if($message->sender_id == Auth::id())
                                                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center text-sm font-medium">
                                                    {{ substr(Auth::user()->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-gray-500 py-8">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Price Input - Seller Response -->
                    <div class="border-t pt-4 space-y-2">
                        @if($selectedNegotiation->status == 'accepted')
                            <!-- Quick keyword buttons for seller -->
                            <div class="flex gap-2 flex-wrap">
                                <button wire:click.prevent="sendSellerKeyword('I can accept at', {{ $selectedNegotiation->id }})" 
                                        class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg border">
                                    I can accept at
                                </button>
                                <button wire:click.prevent="sendSellerKeyword('Lowest I can go', {{ $selectedNegotiation->id }})" 
                                        class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg border">
                                    Lowest I can go
                                </button>
                                <button wire:click.prevent="sendSellerKeyword('Yes, I can negotiate', {{ $selectedNegotiation->id }})" 
                                        class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg border">
                                    Yes, I can negotiate
                                </button>
                            </div>
                            <!-- Price input -->
                            <div class="flex gap-2">
                                <input type="number" wire:model="sellerPrice" 
                                       wire:keydown.enter="sendPriceOffer"
                                       placeholder="Or enter your counter offer (TSh)..." 
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                                       step="0.01">
                                <button wire:click="sendPriceOffer" 
                                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    Send Price
                                </button>
                            </div>
                            <button wire:click="openConfirmSaleModal({{ $selectedNegotiation->id }})" 
                                    class="w-full px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                                ✓ Confirm Sale at TSh {{ number_format($selectedNegotiation->offered_price) }}
                            </button>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <p class="text-sm text-yellow-800">Accept the negotiation to start price discussion.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Confirm Sale Modal -->
    @if($showConfirmSaleModal && $saleToConfirm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[70]" wire:click="closeConfirmSaleModal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white" wire:click.stop>
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-orange-100">
                        <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mt-5">Confirm Sale</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to confirm this sale at <strong class="text-orange-600">TSh {{ number_format($saleToConfirm->offered_price) }}</strong>?
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            This will mark the vehicle as on hold and send an email notification.
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button wire:click="confirmSale" 
                                class="px-4 py-2 bg-orange-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            Confirm Sale
                        </button>
                        <button wire:click="closeConfirmSaleModal" 
                                class="mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
