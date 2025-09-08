<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">📋 Submit Quote</h1>
            <p class="text-lg text-gray-600">Provide your best offer for this spare part request</p>
        </div>

        {{-- Error Message --}}
        @if($error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ $error }}
            </div>
        @endif

        {{-- Success Message --}}
        @if($success)
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="mb-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Quote Submitted Successfully!</h2>
                <p class="text-gray-600 mb-6">
                    Your quote has been submitted to the customer. They will be notified and can review your offer.
                </p>
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-sm text-green-800">
                        <strong>Request ID:</strong> #{{ $requestId }}<br>
                        <strong>Shop:</strong> {{ $shop->name }}<br>
                        <strong>Status:</strong> Pending customer review
                    </p>
                </div>
                
                <div class="space-y-4">
                    <div class="text-sm text-gray-600">
                        <h3 class="font-semibold mb-2">What happens next?</h3>
                        <ul class="text-left max-w-md mx-auto space-y-1">
                            <li>• Customer will review your quote</li>
                            <li>• They may contact you directly</li>
                            <li>• You can track quote status in your dashboard</li>
                            <li>• Quote expires in 3 days if not accepted</li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-8">
                    <a href="{{ route('dashboard') }}" 
                       class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        @else
            {{-- Request Details --}}
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Request Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="font-medium text-gray-600">Vehicle:</span>
                        <span class="text-gray-900">{{ $request->year }} {{ $request->make->name }} {{ $request->model->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Part Name:</span>
                        <span class="text-gray-900">{{ $request->part_name }}</span>
                    </div>
                    @if($request->part_number)
                        <div>
                            <span class="font-medium text-gray-600">Part Number:</span>
                            <span class="text-gray-900">{{ $request->part_number }}</span>
                        </div>
                    @endif
                    @if($request->part_size)
                        <div>
                            <span class="font-medium text-gray-600">Part Size:</span>
                            <span class="text-gray-900">{{ $request->part_size }}</span>
                        </div>
                    @endif
                    @if($request->description)
                        <div class="md:col-span-2">
                            <span class="font-medium text-gray-600">Description:</span>
                            <span class="text-gray-900">{{ $request->description }}</span>
                        </div>
                    @endif
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-2">Customer Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-600">Name:</span>
                            <span class="text-gray-900">{{ $request->customer_name }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Phone:</span>
                            <span class="text-gray-900">{{ $request->customer_phone }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Email:</span>
                            <span class="text-gray-900">{{ $request->customer_email }}</span>
                        </div>
                        @if($request->additional_notes)
                            <div class="md:col-span-2">
                                <span class="font-medium text-gray-600">Notes:</span>
                                <span class="text-gray-900">{{ $request->additional_notes }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        <strong>Request expires:</strong> {{ $request->formatted_expires_at }}
                    </p>
                </div>
            </div>

            {{-- Quote Form --}}
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Your Quote</h2>
                
                <form wire:submit.prevent="submitQuote">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Price <span class="text-red-500">*</span>
                            </label>
                            <div class="flex">
                                <input type="number" wire:model="price" step="0.01" min="0"
                                       placeholder="0.00"
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('price') border-red-500 @enderror">
                                <select wire:model="currency" 
                                        class="px-3 py-2 border border-l-0 border-gray-300 rounded-r-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="TZS">TZS</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Quantity Available --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Quantity Available <span class="text-red-500">*</span>
                            </label>
                            <input type="number" wire:model="quantityAvailable" min="1"
                                   placeholder="1"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('quantityAvailable') border-red-500 @enderror">
                            @error('quantityAvailable') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Brand --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Brand (Optional)
                            </label>
                            <input type="text" wire:model="brand" 
                                   placeholder="e.g., Bosch, Toyota, etc."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('brand') border-red-500 @enderror">
                            @error('brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

                        {{-- Delivery Time --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Delivery Time (Days)
                            </label>
                            <input type="number" wire:model="deliveryTimeDays" min="1" max="365"
                                   placeholder="e.g., 3"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('deliveryTimeDays') border-red-500 @enderror">
                            @error('deliveryTimeDays') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Delivery Cost --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Delivery Cost
                            </label>
                            <input type="number" wire:model="deliveryCost" step="0.01" min="0"
                                   placeholder="0.00"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('deliveryCost') border-red-500 @enderror">
                            @error('deliveryCost') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Part Description (Optional)
                        </label>
                        <textarea wire:model="description" rows="3" 
                                  placeholder="Describe the part, condition, warranty, etc."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('description') border-red-500 @enderror"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Shop Notes --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Additional Notes (Optional)
                        </label>
                        <textarea wire:model="shopNotes" rows="3" 
                                  placeholder="Any additional information for the customer..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('shopNotes') border-red-500 @enderror"></textarea>
                        @error('shopNotes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end mt-8">
                        <button type="submit" 
                                wire:loading.attr="disabled"
                                class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition duration-200 disabled:opacity-50">
                            <span wire:loading.remove>Submit Quote</span>
                            <span wire:loading>Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
