<div>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Vehicle Insurance Calculator</h1>
                <p class="mt-2 text-gray-600">Simple & Fast Insurance Quotes for Tanzania</p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calculator Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <form wire:submit.prevent="calculateInsurance">
                        <!-- Step 1: Insurable Value -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-blue-600 mb-3">Step 1: Vehicle Value</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Insurable Value (TSh) *</label>
                                <input wire:model="insurableValue" type="number" placeholder="e.g., 5,000,000" min="500000" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
                                @error('insurableValue') 
                                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Minimum value: TSh 500,000</p>
                            </div>
                        </div>

                        <!-- Step 2: Vehicle Class -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-blue-600 mb-3">Step 2: Vehicle Class</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Select Vehicle Class *</label>
                                <select wire:model="vehicleClass" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
                                    <option value="">-- Select Vehicle Class --</option>
                                    @foreach($vehicleClasses as $key => $class)
                                        <option value="{{ $key }}">{{ $class }}</option>
                                    @endforeach
                                </select>
                                @error('vehicleClass') 
                                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                                @enderror
                            </div>

                            <!-- Carrying Passengers (for motorcycles) -->
                            @if(in_array($vehicleClass, ['Motorcycle Wheelers 2', 'Motorcycle Wheelers 3']))
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Carrying Passengers?</label>
                                    <div class="flex space-x-4">
                                        <label class="flex items-center">
                                            <input wire:model="carryingPassengers" type="radio" value="Yes" class="mr-2">
                                            <span>Yes</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model="carryingPassengers" type="radio" value="No" class="mr-2">
                                            <span>No</span>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($vehicleClass === 'Motorcycle Wheelers 2')
                                            Additional TSh 15,000 for passenger coverage (Bodaboda)
                                        @elseif($vehicleClass === 'Motorcycle Wheelers 3')
                                            Additional TSh 45,000 for passenger coverage (Bajaji)
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Step 3: Type of Cover -->
                        @if($vehicleClass)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-blue-600 mb-3">Step 3: Type of Cover</h3>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Coverage Type *</label>
                                    <select wire:model="typeOfCover" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
                                        <option value="">-- Select Coverage Type --</option>
                                        @foreach($this->getAvailableCoverageOptions() as $coverageKey => $coverageData)
                                            <option value="{{ $coverageKey }}">
                                                {{ $coverageKey }}
                                                @if($coverageData['rate'] > 0)
                                                    ({{ ($coverageData['rate'] * 100) }}% of vehicle value)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('typeOfCover') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <!-- Calculate Button -->
                        <div class="flex space-x-4">
                            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span>Calculate Premium</span>
                            </button>
                            <button type="button" wire:click="resetCalculator" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Sidebar -->
            <div class="lg:col-span-1">
                @if($showResults && $calculationResults)
                    <!-- Premium Results -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Your Quote
                        </h3>
                        
                        <!-- Total Premium -->
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white mb-4">
                            <div class="text-center">
                                <div class="text-sm opacity-90">Annual Premium</div>
                                <div class="text-2xl font-bold">TSh {{ number_format($calculationResults['total_premium']) }}</div>
                                <div class="text-sm opacity-90">Monthly: TSh {{ number_format($calculationResults['monthly_premium']) }}</div>
                            </div>
                        </div>

                        <!-- Premium Breakdown -->
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span>Base Premium:</span>
                                <span>TSh {{ number_format($calculationResults['base_premium']) }}</span>
                            </div>
                            @if($calculationResults['additional_charge'] > 0)
                                <div class="flex justify-between">
                                    <span>Additional Charge:</span>
                                    <span>TSh {{ number_format($calculationResults['additional_charge']) }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <span>Premium Excl. VAT:</span>
                                <span>TSh {{ number_format($calculationResults['premium_excl_vat']) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>VAT (18%):</span>
                                <span>TSh {{ number_format($calculationResults['vat_amount']) }}</span>
                            </div>
                            <hr class="border-gray-200">
                            <div class="flex justify-between font-semibold">
                                <span>Total Premium:</span>
                                <span>TSh {{ number_format($calculationResults['total_premium']) }}</span>
                            </div>
                        </div>

                        <!-- Coverage Summary -->
                        <div class="bg-gray-50 rounded-lg p-3 mb-4">
                            <div class="text-sm">
                                <div class="font-medium text-gray-800">Coverage Details</div>
                                <div class="text-gray-600 mt-1">
                                    Vehicle Class: {{ $calculationResults['vehicle_class'] }}<br>
                                    Coverage Type: {{ $calculationResults['type_of_cover'] }}<br>
                                    Premium Rate: {{ ($calculationResults['premium_rate'] * 100) }}%
                                </div>
                            </div>
                        </div>

                        <!-- Excess Information -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                            <div class="text-sm">
                                <div class="font-medium text-yellow-800">Excess Policy</div>
                                <div class="text-yellow-700 mt-1">{{ $calculationResults['excess_info'] }}</div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <button wire:click="showContactModal" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>Apply for This Policy</span>
                            </button>
                            <a href="tel:+255-22-211-8888" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>Call Now</span>
                            </a>
                        </div>
                    </div>
                @else
                    <!-- How It Works -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">How It Works</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                                <div>
                                    <div class="font-medium">Enter Vehicle Value</div>
                                    <div class="text-sm text-gray-600">Provide your vehicle's insurable value</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                                <div>
                                    <div class="font-medium">Select Vehicle Class</div>
                                    <div class="text-sm text-gray-600">Choose from our vehicle categories</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                                <div>
                                    <div class="font-medium">Choose Coverage</div>
                                    <div class="text-sm text-gray-600">Pick the protection level you need</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-semibold">✓</div>
                                <div>
                                    <div class="font-medium">Get Instant Quote</div>
                                    <div class="text-sm text-gray-600">Receive your premium calculation</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coverage Types -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Coverage Types</h4>
                        <div class="space-y-3 text-sm">
                            <div>
                                <div class="font-medium text-green-600">Comprehensive</div>
                                <div class="text-gray-600">Full protection including own damage, theft, fire, and third party</div>
                            </div>
                            <div>
                                <div class="font-medium text-blue-600">Third Party Fire & Theft</div>
                                <div class="text-gray-600">Third party plus fire and theft protection</div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-600">Third Party Only</div>
                                <div class="text-gray-600">Legal minimum coverage for third party claims</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Contact Form Modal -->
    @if($showContactForm)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeContactForm"></div>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form wire:submit.prevent="submitContactForm">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Request Insurance Quote</h3>
                            <button type="button" wire:click="closeContactForm" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                <input wire:model="customerName" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('customerName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                <input wire:model="customerPhone" type="tel" placeholder="+255 xxx xxx xxx" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('customerPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input wire:model="customerEmail" type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('customerEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if($calculationResults)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <div class="text-sm">
                                        <div class="font-medium text-blue-800">Quote Summary</div>
                                        <div class="text-blue-700">
                                            Vehicle Class: {{ $calculationResults['vehicle_class'] }}<br>
                                            Coverage: {{ $calculationResults['type_of_cover'] }}<br>
                                            <strong>Premium: TSh {{ number_format($calculationResults['total_premium']) }}/year</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Submit Request
                        </button>
                        <button type="button" wire:click="closeContactForm" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

  
</div>

<script>
// Notification functions
function showNotification(type, message) {
    // Simple alert for now - you can enhance this
    if (type === 'success') {
        alert('✅ ' + message);
    } else if (type === 'error') {
        alert('❌ ' + message);
    } else {
        alert('ℹ️ ' + message);
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Livewire event listeners
    document.addEventListener('livewire:load', function () {
        window.livewire.on('notify', (data) => {
            showNotification(data.type, data.message);
        });
    });

    // Format currency inputs
    const currencyInput = document.querySelector('input[wire\\:model="insurableValue"]');
    if (currencyInput) {
        currencyInput.addEventListener('input', function(e) {
            // You can add number formatting here if needed
        });
    }
});
</script>

<style>
/* Custom styles for better visual appeal */
* {
    transition-property: color, background-color, border-color, opacity, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

/* Form styling improvements */
input:focus, select:focus, textarea:focus {
    outline: none;
    ring: 2px;
    ring-color: rgb(59 130 246);
    border-color: rgb(59 130 246);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .grid {
        gap: 1rem;
    }
    
    .text-3xl {
        font-size: 1.875rem;
        line-height: 2.25rem;
    }
}
</style>


</div>