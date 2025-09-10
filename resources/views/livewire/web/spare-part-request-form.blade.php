<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">🚗 Request Spare Parts</h1>
            <p class="text-lg text-gray-600">Tell us what you need and we'll connect you with the best shops</p>
        </div>

        {{-- Progress Steps --}}
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    <div class="flex items-center relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 {{ $step >= 1 ? 'border-green-600 bg-green-600 text-white' : 'border-gray-300 bg-white text-gray-500' }}">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 mt-16 w-20 text-center text-xs font-medium {{ $step >= 1 ? 'text-green-600' : 'text-gray-500' }}">Vehicle & Part</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out {{ $step >= 2 ? 'border-green-600' : 'border-gray-300' }}"></div>
                    <div class="flex items-center relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 {{ $step >= 2 ? 'border-green-600 bg-green-600 text-white' : 'border-gray-300 bg-white text-gray-500' }}">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 mt-16 w-20 text-center text-xs font-medium {{ $step >= 2 ? 'text-green-600' : 'text-gray-500' }}">Contact Info</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out {{ $step >= 3 ? 'border-green-600' : 'border-gray-300' }}"></div>
                    <div class="flex items-center relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 {{ $step >= 3 ? 'border-green-600 bg-green-600 text-white' : 'border-gray-300 bg-white text-gray-500' }}">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 mt-16 w-20 text-center text-xs font-medium {{ $step >= 3 ? 'text-green-600' : 'text-gray-500' }}">Success</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Error Messages --}}
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Step 1: Vehicle and Part Information --}}
        @if($step === 1)
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Vehicle & Part Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Vehicle Make --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Vehicle Make <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="selectedMake" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('selectedMake') border-red-500 @enderror">
                            <option value="">Select Make</option>
                            @foreach($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedMake') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Vehicle Model --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Vehicle Model <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="selectedModel" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('selectedModel') border-red-500 @enderror"
                                {{ empty($models) ? 'disabled' : '' }}>
                            <option value="">Select Model</option>
                            @foreach($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedModel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Vehicle Year --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Vehicle Year <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="selectedYear" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('selectedYear') border-red-500 @enderror">
                            <option value="">Select Year</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        @error('selectedYear') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Part Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Part Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="partName" 
                               placeholder="e.g., Oil Filter, Brake Pads, Air Filter"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('partName') border-red-500 @enderror">
                        @error('partName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Part Number --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Part Number (Optional)
                        </label>
                        <input type="text" wire:model="partNumber" 
                               placeholder="e.g., 90915-YZZA1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('partNumber') border-red-500 @enderror">
                        @error('partNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Part Size --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Part Size (Optional)
                        </label>
                        <input type="text" wire:model="partSize" 
                               placeholder="e.g., 14mm, 195/65R15"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('partSize') border-red-500 @enderror">
                        @error('partSize') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Description (Optional)
                    </label>
                    <textarea wire:model="description" rows="3" 
                              placeholder="Any additional details about the part you need..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('description') border-red-500 @enderror"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Navigation --}}
                <div class="flex justify-end mt-8">
                    <button wire:click="nextStep" 
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200">
                        Next Step →
                    </button>
                </div>
            </div>
        @endif

        {{-- Step 2: Contact Information --}}
        @if($step === 2)
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Customer Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Your Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="customerName" 
                               placeholder="Enter your full name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('customerName') border-red-500 @enderror">
                        @error('customerName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Customer Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" wire:model="customerEmail" 
                               placeholder="your.email@example.com"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('customerEmail') border-red-500 @enderror">
                        @error('customerEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Customer Phone --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" wire:model="customerPhone" 
                               placeholder="+255 123 456 789"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('customerPhone') border-red-500 @enderror">
                        @error('customerPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Additional Notes --}}
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Notes (Optional)
                    </label>
                    <textarea wire:model="additionalNotes" rows="3" 
                              placeholder="Any additional information or special requirements..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('additionalNotes') border-red-500 @enderror"></textarea>
                    @error('additionalNotes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Request Summary --}}
                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Request Summary</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-600">Vehicle:</span>
                            <span class="text-gray-900">{{ $selectedYear }} {{ $makes->find($selectedMake)->name ?? '' }} {{ $models->find($selectedModel)->name ?? '' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Part:</span>
                            <span class="text-gray-900">{{ $partName }}</span>
                        </div>
                        @if($partNumber)
                            <div>
                                <span class="font-medium text-gray-600">Part Number:</span>
                                <span class="text-gray-900">{{ $partNumber }}</span>
                            </div>
                        @endif
                        @if($partSize)
                            <div>
                                <span class="font-medium text-gray-600">Size:</span>
                                <span class="text-gray-900">{{ $partSize }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Navigation --}}
                <div class="flex justify-between mt-8">
                    <button wire:click="previousStep" 
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                        ← Previous
                    </button>
                    <button wire:click="submitRequest" 
                            wire:loading.attr="disabled"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200 disabled:opacity-50">
                        <span wire:loading.remove>Submit Request</span>
                        <span wire:loading>Submitting...</span>
                    </button>
                </div>
            </div>
        @endif

        {{-- Step 3: Success --}}
        @if($step === 3 && $success)
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="mb-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Request Submitted Successfully!</h2>
                <p class="text-gray-600 mb-6">
                    Your spare part request has been sent to all registered shops. You'll receive quotes via email within 24-48 hours.
                </p>
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-sm text-green-800">
                        <strong>Request ID:</strong> #{{ $requestId }}<br>
                        <strong>Status:</strong> Pending quotes from shops
                    </p>
                </div>
                
                <div class="space-y-4">
                    <div class="text-sm text-gray-600">
                        <h3 class="font-semibold mb-2">What happens next?</h3>
                        <ul class="text-left max-w-md mx-auto space-y-1">
                            <li>• Shops will review your request</li>
                            <li>• You'll receive email notifications with quotes</li>
                            <li>• Compare prices and choose the best offer</li>
                            <li>• Contact the shop directly to complete purchase</li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-8 space-x-4">
                    <button wire:click="resetForm" 
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200">
                        Submit Another Request
                    </button>
                    <a href="{{ route('spare.parts.list') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                        Back to Marketplace
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
