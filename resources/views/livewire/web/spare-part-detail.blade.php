<div>
{{-- resources/views/livewire/spare-part-detail.blade.php --}}
<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('spare.parts.list') }}" class="text-gray-700 hover:text-green-600 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Marketplace
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-500 ml-1 md:ml-2">{{ $sparePart->unit }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            {{-- Images Section --}}
            <div class="space-y-4">
                {{-- Main Image --}}
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                    @php
                        $images = collect([
                            $sparePart->preview_image,
                            $sparePart->additional_image_1,
                            $sparePart->additional_image_2
                        ])->filter();
                        $currentImage = $images->get($selectedImage, $sparePart->preview_image);
                    @endphp
                    
                    @if($currentImage)
                        <img src="{{ Storage::url($currentImage) }}" 
                             alt="{{ $sparePart->unit }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Thumbnail Images --}}
                @if($images->count() > 1)
                    <div class="flex gap-2">
                        @foreach($images as $index => $image)
                            <button wire:click="selectImage({{ $index }})" 
                                    class="w-20 h-20 border-2 rounded-lg overflow-hidden {{ $selectedImage === $index ? 'border-green-600' : 'border-gray-300' }}">
                                <img src="{{ Storage::url($image) }}" 
                                     alt="Image {{ $index + 1 }}" 
                                     class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Product Details --}}
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $sparePart->unit }}</h1>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">
                            {{ $sparePart->spareCategory->name }}
                        </span>
                        @if($sparePart->spareBrand)
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">
                                {{ $sparePart->spareBrand->name }}
                            </span>
                        @endif
                        @if($sparePart->spareModel)
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">
                                {{ $sparePart->spareModel->name }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Price --}}
                <div class="border-b pb-6">
                    <div class="flex items-center gap-4">
                        <span class="text-4xl font-bold text-green-600">
                            Tzs - {{ number_format($sparePart->price, 2) }}
                        </span>
                        <span class="text-sm bg-gray-100 px-3 py-1 rounded">
                            {{ ucfirst(str_replace('_', ' ', $sparePart->price_type)) }}
                        </span>
                    </div>
                </div>

                {{-- Description --}}
                @if($sparePart->description)
                    <div class="border-b pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $sparePart->description }}</p>
                    </div>
                @endif

                {{-- Shop Information --}}
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Shop Information</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h2M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="font-medium text-gray-900">{{ $sparePart->shop->name }}</span>
                        </div>

                        @if($sparePart->shop->owner_name)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-gray-700">{{ $sparePart->shop->owner_name }}</span>
                            </div>
                        @endif

                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ $sparePart->shop->phone_number }}" 
                               class="text-green-600 hover:text-green-700 font-medium">
                                {{ $sparePart->shop->phone_number }}
                            </a>
                        </div>

                        @if($sparePart->shop->email)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <a href="mailto:{{ $sparePart->shop->email }}" 
                                   class="text-green-600 hover:text-green-700">
                                    {{ $sparePart->shop->email }}
                                </a>
                            </div>
                        @endif

                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <div class="text-gray-700">{{ $sparePart->shop->address }}</div>
                                @if($distance)
                                    <div class="text-sm text-green-600 mt-1">
                                        Distance: {{ $distance }}km from your location
                                    </div>
                                @else
                                    <button wire:click="calculateDistance" 
                                            class="text-sm text-green-600 hover:text-green-700 mt-1">
                                        Calculate distance from my location
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Actions --}}
                <div class="flex gap-4">
                    <a href="tel:{{ $sparePart->shop->phone_number }}" 
                       class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200 text-center flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Call Shop
                    </a>
                    
                    @if($sparePart->shop->latitude && $sparePart->shop->longitude)
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $sparePart->shop->latitude }},{{ $sparePart->shop->longitude }}" 
                           target="_blank"
                           class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200 text-center flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Get Directions
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedParts->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Spare Parts</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedParts as $relatedPart)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                            <div class="aspect-w-16 aspect-h-12 bg-gray-200">
                                @if($relatedPart->preview_image)
                                    <img src="{{ Storage::url($relatedPart->preview_image) }}" 
                                         alt="{{ $relatedPart->unit }}" 
                                         class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2">{{ Str::limit($relatedPart->unit, 30) }}</h3>
                                <div class="text-sm text-gray-600 mb-2">
                                    {{ $relatedPart->shop->name }}
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-green-600">
                                        ${{ number_format($relatedPart->price, 2) }}
                                    </span>
                                    <a href="{{ route('spare-part.detail', $relatedPart->id) }}" 
                                       class="text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded transition duration-200">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        window.addEventListener('get-user-location-for-distance', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        @this.updateUserLocationForDistance(position.coords.latitude, position.coords.longitude);
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
