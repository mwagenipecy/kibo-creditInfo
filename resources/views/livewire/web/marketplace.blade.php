<div>
{{-- resources/views/livewire/marketplace.blade.php --}}
<div class="min-h-screen bg-gray-50">
    {{-- Header --}}
    <div class="bg-green-600 shadow-sm border-b">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="text-center">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2 sm:mb-4">Spare Parts Request</h1>
                <p class="text-green-100 text-sm sm:text-base md:text-lg">Submit your request and get quotes from verified shops</p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Simple Request Form --}}
        <div class="bg-white rounded-lg shadow-sm p-6 sm:p-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6">Request Spare Parts</h2>
            
            <form wire:submit.prevent="submitRequest">
                {{-- Row 1: Vehicle Information --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-6">
                    {{-- Vehicle Make --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-3 h-3 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H11a1 1 0 001-1v-1h3.05a2.5 2.5 0 014.9 0H20a1 1 0 001-1V5a1 1 0 00-1-1H3z" />
                            </svg>
                            Vehicle Make *
                        </label>
                        <div class="relative">
                            <input 
                                wire:model="selectedMakeName" 
                                id="make" 
                                list="make-options"
                                placeholder="Search for a make..."
                                class="w-full rounded-lg border-gray-300 py-2.5 pl-10 pr-4 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:ring-opacity-20 shadow-sm transition-all duration-200 hover:border-gray-400"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <datalist id="make-options">
                                @foreach($makes as $make)
                                    <option value="{{ $make->name }}" data-id="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        @error('selectedMake') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Vehicle Model --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-3 h-3 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Vehicle Model *
                        </label>
                        <div class="relative">
                            <input 
                                wire:model="selectedModelName" 
                                id="model" 
                                list="model-options"
                                placeholder="Search for a model..."
                                class="w-full rounded-lg border-gray-300 py-2.5 pl-10 pr-4 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:ring-opacity-20 shadow-sm transition-all duration-200 hover:border-gray-400"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <datalist id="model-options">
                                @foreach($models as $model)
                                    <option value="{{ $model->name }}" data-id="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        @error('selectedModel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Year --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-3 h-3 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Year *
                        </label>
                        <div class="relative">
                            <input 
                                wire:model="selectedYearName" 
                                id="year" 
                                list="year-options"
                                placeholder="Select year..."
                                class="w-full rounded-lg border-gray-300 py-2.5 pl-10 pr-4 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:ring-opacity-20 shadow-sm transition-all duration-200 hover:border-gray-400"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <datalist id="year-options">
                                @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        @error('selectedYear') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Row 2: Part Information --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6">
                    {{-- Part Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Part Name *</label>
                        <input type="text" wire:model="partName" 
                               placeholder="e.g., Brake Pads, Oil Filter"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('partName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Part Condition --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Part Condition *</label>
                        <select wire:model="partCondition" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Select Condition</option>
                            <option value="all">All (New & Used)</option>
                            <option value="new">New Only</option>
                            <option value="used">Used Only</option>
                        </select>
                        @error('partCondition') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Row 3: Contact Information --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6">
                    {{-- Customer Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Name *</label>
                        <input type="text" wire:model="customerName" 
                               placeholder="Enter your full name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('customerName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Customer Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" wire:model="customerEmail" 
                               placeholder="Enter your email"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('customerEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Row 3b: Phone --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                        <input type="text" wire:model="customerPhone" 
                               placeholder="e.g., +255712345678"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('customerPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Row 4: Additional Information --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6">
                    {{-- Part Number --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Part Number (Optional)</label>
                        <input type="text" wire:model="partNumber" 
                               placeholder="e.g., BP123, OF456"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('partNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Part Size --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Part Size (Optional)</label>
                        <input type="text" wire:model="partSize" 
                               placeholder="e.g., 10mm, 14mm, Standard"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('partSize') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Additional Details (Optional)</label>
                    <textarea wire:model="additionalNotes" rows="3" 
                              placeholder="Any additional information about the part you need..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
                    @error('additionalNotes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Images (Optional) --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Attach Images (Optional)</label>
                    <input type="file" wire:model="images" multiple accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    {{-- Previews --}}
                    <div class="mt-3 grid grid-cols-3 sm:grid-cols-5 gap-2">
                        @if(is_array($images))
                            @foreach($images as $photo)
                                @if($photo)
                                    <div class="border rounded overflow-hidden cursor-zoom-in" wire:click="openPreview('{{ $photo->temporaryUrl() }}')">
                                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-28 object-cover"/>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="text-center">
                    <button type="submit" 
                            wire:loading.attr="disabled"
                            class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 sm:px-8 rounded-md transition duration-200 disabled:opacity-50 w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        <span wire:loading.remove>Submit Request</span>
                        <span wire:loading>Submitting...</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Available Shops --}}
        <div class="mt-6 sm:mt-8 bg-white rounded-lg shadow-sm p-4 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3 sm:mb-4">Available Shops</h3>
            <p class="text-gray-600 mb-4 text-sm sm:text-base">Your request will be sent to these verified shops:</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                @foreach($shops as $shop)
                    <div class="border border-gray-200 rounded-lg p-3 sm:p-4">
                        <h4 class="font-medium text-gray-900 text-sm sm:text-base">{{ $shop->name }}</h4>
                        <p class="text-xs sm:text-sm text-gray-600 mt-1">{{ $shop->email }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>

@if($previewOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75" wire:click="closePreview">
        <img src="{{ $previewSrc }}" alt="Preview" class="max-w-3xl max-h-[85vh] rounded shadow-lg" wire:click.stop>
        <button 
            class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2"
            wire:click.stop="closePreview"
            aria-label="Close preview"
        >
            ✕
        </button>
    </div>
@endif
