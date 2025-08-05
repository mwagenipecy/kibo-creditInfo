<div>
<div class="min-h-screen bg-white">
    <!-- Header -->
    <div class="bg-green-600 shadow-sm border-b-4 border-green-500">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-white">Vehicle Insurance Calculator</h1>
                <p class="mt-2 text-white">Complete Insurance Calculator </p>
                <div class="mt-4 flex items-center justify-center space-x-6 text-sm text-gray-500">
                    <span class="flex items-center text-white">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        Instant Quotes
                    </span>
                    <span class="flex text-white items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        Tanzania Compliant
                    </span>
                  
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calculator Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6 border-t-4 border-green-500">
                    <form wire:submit.prevent="calculateInsurance">
                        <!-- Step 1: Insurable Value -->
                        <div class="mb-8 bg-green-50 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                                <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">1</div>
                                Step 1: Insurable Value
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Insurable Value (TSh) *</label>
                                    <input wire:model="insurableValue" type="number" placeholder="e.g., 2,500,000" min="500000" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg font-semibold">
                                    @error('insurableValue') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Year *</label>
                                    <select wire:model="year" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @for($y = date('Y'); $y >= 1980; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                    @error('year') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                                    <input wire:model="startDate" type="date" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    @error('startDate') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Vehicle Class & Passengers -->
                        <div class="mb-8 bg-green-50 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                                <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2</div>
                                Step 2: Vehicle Class & Passenger Details
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Class *</label>
                                    <select wire:model="vehicleClass" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg">
                                        <option value="">-- Select Vehicle Class --</option>
                                        @foreach($vehicleClasses as $key => $class)
                                            <option value="{{ $key }}">{{ $class }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicleClass') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Carrying Passengers? *</label>
                                    <select wire:model="carryingPassengers" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Number of Passengers 
                                        @if(in_array($vehicleClass, ['Motorcycle Wheelers 2', 'Motorcycle Wheelers 3']))
                                            <span class="text-green-600">(including driver)</span>
                                        @endif
                                    </label>
                                    <input wire:model="noPassengers" type="number" min="0" max="50" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    @error('noPassengers') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                                    @enderror
                                    @if($vehicleClass === 'Motorcycle Wheelers 2' && $carryingPassengers === 'Yes')
                                        <p class="text-sm text-green-600 mt-1">
                                            <strong>Additional TSh 15,000</strong> for passenger coverage (Bodaboda)
                                        </p>
                                    @elseif($vehicleClass === 'Motorcycle Wheelers 3' && $carryingPassengers === 'Yes')
                                        <p class="text-sm text-green-600 mt-1">
                                            <strong>Additional TSh 45,000</strong> for passenger coverage (Bajaji)
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Coverage Type & Claim Status -->
                        <div class="mb-8 bg-green-50 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                                <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">3</div>
                                Step 3: Coverage Type & Claim Status
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Claim Status *</label>
                                    <select wire:model="claimStatus" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @foreach($claimStatusOptions as $key => $status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    @error('claimStatus') 
                                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>

                                @if($vehicleClass && $claimStatus)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Type of Cover *</label>
                                        <select wire:model="typeOfCover" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
                                            <option value="">-- Select Coverage Type --</option>
                                            @foreach($this->getAvailableCoverageOptions() as $coverageKey => $coverageData)
                                                <option value="{{ $coverageKey }}">
                                                    {{ $coverageKey }}
                                                    @if($coverageData['rate'] > 0)
                                                        ({{ ($coverageData['rate'] * 100) }}% rate)
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('typeOfCover') 
                                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Calculate Button -->
                        <div class="flex space-x-4">
                            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-4 rounded-lg font-bold text-lg transition-colors flex items-center justify-center space-x-2 shadow-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span>Calculate Premium</span>
                            </button>
                            <button type="button" wire:click="resetCalculator" class="px-6 py-4 border-2 border-green-300 text-green-700 rounded-lg font-medium hover:bg-green-50 transition-colors">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Sidebar -->
            <div class="lg:col-span-1">
                @if($showResults && $calculationResults)
                    <!-- Premium Results - Exactly like Excel -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border-t-4 border-green-500">
                        <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Calculation Results
                        </h3>
                        
                        <!-- Summary Box -->
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white mb-4">
                            <div class="text-center">
                                <div class="text-sm opacity-90">Total Premium Inc. VAT</div>
                                <div class="text-2xl font-bold">TSh {{ number_format($calculationResults['total_premium']) }}</div>
                                <div class="text-sm opacity-90">Annual Premium</div>
                            </div>
                        </div>

                        <!-- Excel-style breakdown -->
                        <div class="space-y-3 text-sm">
                            <!-- Input Summary -->
                            <div class="bg-gray-50 rounded p-3">
                                <div class="font-semibold text-gray-700 mb-2">Input Summary:</div>
                                <div class="space-y-1 text-xs">
                                    <div class="flex justify-between">
                                        <span>Insurable Value:</span>
                                        <span class="font-semibold">TSh {{ number_format($calculationResults['insurable_value']) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Vehicle Class:</span>
                                        <span class="font-semibold">{{ $calculationResults['vehicle_class'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Carrying Passengers:</span>
                                        <span class="font-semibold">{{ $calculationResults['carrying_passengers'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>No. Passengers:</span>
                                        <span class="font-semibold">{{ $calculationResults['no_passengers'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Type of Cover:</span>
                                        <span class="font-semibold text-green-600">{{ $calculationResults['type_of_cover'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Claim Status:</span>
                                        <span class="font-semibold">{{ $calculationResults['claim_status'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Year:</span>
                                        <span class="font-semibold">{{ $calculationResults['year'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Premium Calculation - Excel Format -->
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Minimum Premium:</span>
                                    <span class="font-semibold">TSh {{ number_format($calculationResults['minimum_premium']) }}</span>
                                </div>
                                
                                @if($calculationResults['plus_tpp'] > 0)
                                    <div class="flex justify-between">
                                        <span>Plus TPP:</span>
                                        <span class="font-semibold">TSh {{ number_format($calculationResults['plus_tpp']) }}</span>
                                    </div>
                                @else
                                    <div class="flex justify-between">
                                        <span>Plus TPP:</span>
                                        <span class="font-semibold">-</span>
                                    </div>
                                @endif

                                @if($calculationResults['additional_charge'] > 0)
                                    <div class="flex justify-between">
                                        <span>Additional Charge:</span>
                                        <span class="font-semibold text-green-600">TSh {{ number_format($calculationResults['additional_charge']) }}</span>
                                    </div>
                                @else
                                    <div class="flex justify-between">
                                        <span>Additional Charge:</span>
                                        <span class="font-semibold">-</span>
                                    </div>
                                @endif

                                <hr class="border-gray-300">

                                <div class="flex justify-between">
                                    <span>Premium Excl. VAT:</span>
                                    <span class="font-semibold">TSh {{ number_format($calculationResults['premium_excl_vat']) }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span>VAT %:</span>
                                    <span class="font-semibold">{{ ($calculationResults['vat_rate'] * 100) }}%</span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Premium Rate:</span>
                                    <span class="font-semibold">{{ ($calculationResults['premium_rate'] * 100) }}%</span>
                                </div>

                                <hr class="border-gray-300">

                                <div class="flex justify-between text-green-700 font-bold">
                                    <span>Total Premium Inc. VAT:</span>
                                    <span>TSh {{ number_format($calculationResults['total_premium']) }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span>VAT Amount:</span>
                                    <span class="font-semibold">TSh {{ number_format($calculationResults['vat_amount']) }}</span>
                                </div>

                                <hr class="border-gray-300">

                                <div class="flex justify-between text-blue-600">
                                    <span>Estimated Commission:</span>
                                    <span class="font-semibold">TSh {{ number_format($calculationResults['estimated_commission']) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Excess Policy - Excel Format -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-4">
                            <div class="text-sm">
                                <div class="font-bold text-yellow-800 mb-2">Excess Policy:</div>
                                <div class="text-yellow-700 text-xs leading-relaxed">
                                    {{ $calculationResults['excess_info'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3 mt-6">
                            <button wire:click="showContactModal" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2 shadow-lg">
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
                            <a href="https://wa.me/255753123456?text=Hi, I need vehicle insurance. My quote is TSh {{ number_format($calculationResults['total_premium']) }}" target="_blank" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                                </svg>
                                <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                @else
                    <!-- How It Works - Green Theme -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border-t-4 border-green-500">
                        <h3 class="text-lg font-bold text-green-700 mb-4">How It Works</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-sm font-bold">1</div>
                                <div>
                                    <div class="font-medium text-green-700">Enter Vehicle Details</div>
                                    <div class="text-sm text-gray-600">Vehicle value, year, and start date</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <div>
                                    <div class="font-medium text-green-700">Select Vehicle Class</div>
                                    <div class="text-sm text-gray-600">Choose class and passenger details</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <div>
                                    <div class="font-medium text-green-700">Choose Coverage & Claim Status</div>
                                    <div class="text-sm text-gray-600">Select protection level and claim history</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">✓</div>
                                <div>
                                    <div class="font-medium text-green-700">Get Complete Excel-Style Results</div>
                                    <div class="text-sm text-gray-600">Detailed breakdown with all calculations</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coverage Info - Green Theme -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border-t-4 border-green-500">
                        <h4 class="font-bold text-green-700 mb-3">Coverage Types Available</h4>
                        <div class="space-y-3 text-sm">
                            <div class="p-3 bg-green-50 rounded">
                                <div class="font-medium text-green-700">Comprehensive Coverage</div>
                                <div class="text-gray-600 text-xs">Complete protection including own damage, theft, fire, and third party liability</div>
                            </div>
                            <div class="p-3 bg-blue-50 rounded">
                                <div class="font-medium text-blue-700">Third Party Fire & Theft</div>
                                <div class="text-gray-600 text-xs">Third party liability plus fire and theft protection for your vehicle</div>
                            </div>
                            <div class="p-3 bg-gray-50 rounded">
                                <div class="font-medium text-gray-700">Third Party Only</div>
                                <div class="text-gray-600 text-xs">Legal minimum coverage for third party claims</div>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-3 bg-yellow-50 rounded border border-yellow-200">
                            <div class="text-xs text-yellow-800">
                                <strong>Note:</strong> All calculations follow the exact formula structure with proper VAT, commission, and excess calculations.
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
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border-t-4 border-green-500">
                <form wire:submit.prevent="submitContactForm">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-green-700">Request Insurance Quote</h3>
                            <button type="button" wire:click="closeContactForm" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                <input wire:model="customerName" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('customerName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                <input wire:model="customerPhone" type="tel" placeholder="+255 xxx xxx xxx" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('customerPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input wire:model="customerEmail" type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('customerEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if($calculationResults)
                                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                    <div class="text-sm">
                                        <div class="font-medium text-green-800">Complete Quote Summary</div>
                                        <div class="text-green-700 text-xs mt-1">
                                            Vehicle: {{ $calculationResults['vehicle_class'] }} ({{ $calculationResults['year'] }})<br>
                                            Coverage: {{ $calculationResults['type_of_cover'] }}<br>
                                            Status: {{ $calculationResults['claim_status'] }}<br>
                                            Passengers: {{ $calculationResults['carrying_passengers'] }} ({{ $calculationResults['no_passengers'] }})<br>
                                            <strong class="text-green-800">Total Premium: TSh {{ number_format($calculationResults['total_premium']) }}/year</strong>
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
                        <button type="button" wire:click="closeContactForm" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
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
// Enhanced notification functions
function showNotification(type, message) {
    const colors = {
        success: { bg: 'bg-green-100', text: 'text-green-800', border: 'border-green-300' },
        error: { bg: 'bg-red-100', text: 'text-red-800', border: 'border-red-300' },
        info: { bg: 'bg-blue-100', text: 'text-blue-800', border: 'border-blue-300' }
    };
    
    const color = colors[type] || colors.info;
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg border ${color.bg} ${color.text} ${color.border} shadow-lg max-w-sm`;
    notification.innerHTML = `
        <div class="flex items-start">
            <div class="flex-shrink-0">
                ${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}
            </div>
            <div class="ml-3 w-0 flex-1">
                <p class="text-sm font-medium">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-600">
                <span class="sr-only">Close</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification && notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Livewire event listeners
    document.addEventListener('livewire:load', function () {
        window.livewire.on('notify', (data) => {
            showNotification(data.type, data.message);
        });
    });

    // Format large numbers in inputs
    const formatNumber = (input) => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/,/g, '');
            if (!isNaN(value) && value !== '') {
                // Add thousand separators for display
                e.target.style.fontWeight = 'bold';
                e.target.style.color = '#059669'; // green-600
            }
        });
    };

    // Apply formatting to insurance value input
    const insurableValueInput = document.querySelector('input[wire\\:model="insurableValue"]');
    if (insurableValueInput) {
        formatNumber(insurableValueInput);
    }
});

// Excel-style calculation display animation
function animateResults() {
    const resultItems = document.querySelectorAll('.lg\\:col-span-1 .space-y-2 > div');
    resultItems.forEach((item, index) => {
        setTimeout(() => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(10px)';
            item.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 50);
        }, index * 100);
    });
}
</script>

<style>
/* Green theme custom styles */
* {
    transition-property: color, background-color, border-color, opacity, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

/* Enhanced form styling */
input:focus, select:focus, textarea:focus {
    outline: none;
    ring: 2px solid #10b981;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

/* Step indicators */
.step-indicator {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
}

/* Results animation */
.results-appear {
    animation: slideInRight 0.5s ease-out;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
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
    
    .px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* Excel-style table appearance */
.excel-table {
    border-collapse: collapse;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Green gradient backgrounds */
.bg-green-gradient {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

/* Number formatting */
.currency-display {
    font-family: 'Courier New', monospace;
    font-weight: bold;
    color: #059669;
}

/* Loading states */
.loading-shimmer {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

/* Button hover effects */
.btn-green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    transition: all 0.3s ease;
}

.btn-green:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

/* Card elevation effects */
.card-elevated {
    transition: all 0.3s ease;
}

.card-elevated:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Success states */
.success-glow {
    box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
    border-color: #10b981;
}
</style>


</div>