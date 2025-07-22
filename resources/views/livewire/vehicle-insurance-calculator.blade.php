<div>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Tanzania Vehicle Insurance Calculator</h1>
                <p class="mt-2 text-gray-600">Get instant quotes for your vehicle insurance in Tanzania</p>
                <div class="mt-4 flex items-center justify-center space-x-4 text-sm text-gray-500">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Instant Quotes
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Tanzania Compliant
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Expert Support
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calculator Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <form wire:submit.prevent="calculateInsurance">
                        <!-- Vehicle Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                Vehicle Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type *</label>
                                    <select wire:model="vehicleType" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Vehicle Type</option>
                                        @foreach($vehicleTypes as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicleType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Make *</label>
                                    <select wire:model="vehicleMake" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Make</option>
                                        @foreach($vehicleMakes as $key => $make)
                                            <option value="{{ $key }}">{{ $make }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicleMake') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Model *</label>
                                    <input wire:model="vehicleModel" type="text" placeholder="e.g., Corolla, Civic, Hilux" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('vehicleModel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Year of Manufacture *</label>
                                    <select wire:model="yearOfManufacture" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @for($year = date('Y'); $year >= 1980; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('yearOfManufacture') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Engine Capacity (CC) *</label>
                                    <input wire:model="engineCapacity" type="number" placeholder="e.g., 1500" min="50" max="8000" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('engineCapacity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Value (TSh) *</label>
                                    <input wire:model="vehicleValue" type="number" placeholder="e.g., 15000000" min="500000" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('vehicleValue') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Usage *</label>
                                    <select wire:model="vehicleUsage" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Usage</option>
                                        @foreach($vehicleUsages as $key => $usage)
                                            <option value="{{ $key }}">{{ $usage }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicleUsage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Registration Number (Optional)</label>
                                    <input wire:model="registrationNumber" type="text" placeholder="e.g., T123ABC" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Driver Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Driver Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver Age *</label>
                                    <input wire:model="driverAge" type="number" min="18" max="80" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('driverAge') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Driving Experience (Years) *</label>
                                    <input wire:model="drivingExperience" type="number" min="0" max="60" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('drivingExperience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Location (Region) *</label>
                                    <select wire:model="location" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @foreach($tanzanianRegions as $key => $region)
                                            <option value="{{ $key }}">{{ $region }}</option>
                                        @endforeach
                                    </select>
                                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Claims History</label>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input wire:model="hasClaimsHistory" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">I have made insurance claims before</span>
                                        </label>
                                        @if($hasClaimsHistory)
                                            <input wire:model="claimsCount" type="number" min="1" max="10" placeholder="Number of claims" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Coverage Options -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Coverage Options
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Coverage Type</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 {{ $coverageType === 'third_party' ? 'border-blue-500 bg-blue-50' : '' }}">
                                            <input wire:model="coverageType" type="radio" value="third_party" class="mr-3">
                                            <div>
                                                <div class="font-medium text-gray-900">Third Party Only</div>
                                                <div class="text-sm text-gray-500">Legal minimum coverage</div>
                                                <div class="text-sm font-medium text-green-600">From TSh 50,000/year</div>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 {{ $coverageType === 'comprehensive' ? 'border-blue-500 bg-blue-50' : '' }}">
                                            <input wire:model="coverageType" type="radio" value="comprehensive" class="mr-3">
                                            <div>
                                                <div class="font-medium text-gray-900">Comprehensive</div>
                                                <div class="text-sm text-gray-500">Complete protection</div>
                                                <div class="text-sm font-medium text-blue-600">Full coverage</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                @if($coverageType === 'comprehensive')
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Excess Amount</label>
                                        <select wire:model="excessAmount" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="50000">TSh 50,000 (Higher premium)</option>
                                            <option value="100000">TSh 100,000 (Standard)</option>
                                            <option value="200000">TSh 200,000 (Lower premium)</option>
                                            <option value="300000">TSh 300,000 (Lowest premium)</option>
                                        </select>
                                        <p class="text-xs text-gray-500 mt-1">Higher excess means lower premium but more out-of-pocket costs during claims</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Additional Coverage</label>
                                        <div class="space-y-2">
                                            <label class="flex items-center">
                                                <input wire:model="includeWindscreen" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                                <span class="ml-2 text-sm text-gray-700">Windscreen & Windows Coverage</span>
                                                <span class="ml-auto text-sm text-gray-500">+0.5% of vehicle value</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input wire:model="includeRadio" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                                <span class="ml-2 text-sm text-gray-700">Radio & Accessories Coverage</span>
                                                <span class="ml-auto text-sm text-gray-500">+0.2% of vehicle value</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <label class="flex items-center">
                                        <input wire:model="includePersonalAccident" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Personal Accident Coverage (TSh 2,000,000)</span>
                                        <span class="ml-auto text-sm text-gray-500">+TSh 50,000</span>
                                    </label>
                                </div>
                            </div>
                        </div>

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

            
            <!-- Results & Info Sidebar -->
            <div class="lg:col-span-1">
                @if($showResults && $calculationResults)
                    <!-- Premium Results -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Your Premium Quote
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Total Premium -->
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
                                <div class="text-center">
                                    <div class="text-sm opacity-90">Annual Premium</div>
                                    <div class="text-2xl font-bold">TSh {{ number_format($calculationResults['total_premium']) }}</div>
                                    <div class="text-sm opacity-90">Monthly: TSh {{ number_format($calculationResults['monthly_premium']) }}</div>
                                </div>
                            </div>

                            <!-- Premium Breakdown -->
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Base Premium:</span>
                                    <span>TSh {{ number_format($calculationResults['adjusted_premium']) }}</span>
                                </div>
                                @if($calculationResults['add_ons_total'] > 0)
                                    <div class="flex justify-between">
                                        <span>Add-ons:</span>
                                        <span>TSh {{ number_format($calculationResults['add_ons_total']) }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <span>Government Levy (4%):</span>
                                    <span>TSh {{ number_format($calculationResults['government_levy']) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Service Tax (18%):</span>
                                    <span>TSh {{ number_format($calculationResults['service_tax']) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Stamp Duty:</span>
                                    <span>TSh {{ number_format($calculationResults['stamp_duty']) }}</span>
                                </div>
                                <hr class="border-gray-200">
                                <div class="flex justify-between font-semibold">
                                    <span>Total:</span>
                                    <span>TSh {{ number_format($calculationResults['total_premium']) }}</span>
                                </div>
                            </div>

                            <!-- Excess Amount -->
                            @if($coverageType === 'comprehensive')
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                    <div class="text-sm">
                                        <div class="font-medium text-yellow-800">Excess Amount</div>
                                        <div class="text-yellow-700">TSh {{ number_format($calculationResults['excess_amount']) }} per claim</div>
                                    </div>
                                </div>
                            @endif

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
                                <a href="https://wa.me/255753123456?text=Hi, I'm interested in vehicle insurance. My quote is TSh {{ number_format($calculationResults['total_premium']) }}" target="_blank" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                                    </svg>
                                    <span>WhatsApp</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Coverage Details -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Coverage Details</h4>
                        <div class="space-y-2 text-sm">
                            @foreach($calculationResults['coverage_details'] as $coverage => $limit)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">{{ $coverage }}:</span>
                                    <span class="font-medium text-gray-900">{{ $limit }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Company Information -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Safari Premier Insurance</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <div class="font-medium">Licensed by IRA</div>
                                    <div class="text-sm text-gray-600">Fully licensed by Insurance Regulatory Authority</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <div class="font-medium">24/7 Claims Support</div>
                                    <div class="text-sm text-gray-600">Round-the-clock assistance when you need it</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <div class="font-medium">Nationwide Network</div>
                                    <div class="text-sm text-gray-600">Service centers across all regions</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-3">Contact Information</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span>+255 22 211 8888</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>info@tanzaniainsurance.co.tz</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>Dar es Salaam, Tanzania</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Tips -->
                    <div class="bg-blue-50 rounded-lg p-6">
                        <h4 class="font-semibold text-blue-900 mb-3">💡 Money-Saving Tips</h4>
                        <ul class="space-y-2 text-sm text-blue-800">
                            <li>• Higher excess = Lower premium</li>
                            <li>• No claims discount available</li>
                            <li>• Security features reduce premium</li>
                            <li>• Annual payment cheaper than monthly</li>
                            <li>• Group policies get discounts</li>
                        </ul>
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
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Contact Method</label>
                                <select wire:model="preferredContact" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="phone">Phone Call</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                                <textarea wire:model="additionalNotes" rows="3" placeholder="Any specific requirements or questions..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            @if($calculationResults)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <div class="text-sm">
                                        <div class="font-medium text-blue-800">Quote Summary</div>
                                        <div class="text-blue-700">
                                            {{ $vehicleMake }} {{ $vehicleModel }} ({{ $yearOfManufacture }})<br>
                                            {{ ucfirst(str_replace('_', ' ', $coverageType)) }} Coverage<br>
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

    <!-- Notification Toast -->
    <div id="notification" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg id="notification-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Icon will be set by JavaScript -->
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1">
                    <p id="notification-message" class="text-sm font-medium text-gray-900"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button onclick="hideNotification()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tanzania Premier Insurance</h3>
                    <p class="text-gray-300 text-sm">
                        Your trusted partner for comprehensive vehicle insurance solutions across Tanzania. 
                        Licensed and regulated by the Insurance Regulatory Authority.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Claims Process</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Coverage Details</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Customer Support</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Branch Locations</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Emergency Contact</h3>
                    <div class="space-y-2 text-sm text-gray-300">
                        <div>24/7 Claims Hotline:</div>
                        <div class="text-lg font-semibold text-white">+255 22 211 8888</div>
                        <div class="mt-4">
                            <div>WhatsApp Support:</div>
                            <div class="text-lg font-semibold text-white">+255 753 123 456</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 Tanzania Premier Insurance. All rights reserved. | Licensed by IRA | Powered by GarageFinder</p>
            </div>
        </div>
    </div>
</div>

<script>
// Notification functions
function showNotification(type, message) {
    const notification = document.getElementById('notification');
    const icon = document.getElementById('notification-icon');
    const messageEl = document.getElementById('notification-message');
    
    if (!notification || !icon || !messageEl) return;
    
    messageEl.textContent = message;
    
    // Set icon and color based on type
    switch(type) {
        case 'success':
            icon.className = 'h-6 w-6 text-green-400';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
            break;
        case 'error':
            icon.className = 'h-6 w-6 text-red-400';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            break;
        case 'info':
            icon.className = 'h-6 w-6 text-blue-400';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            break;
    }
    
    notification.classList.remove('hidden');
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        hideNotification();
    }, 5000);
}

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.classList.add('hidden');
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
    const currencyInputs = document.querySelectorAll('input[type="number"]');
    currencyInputs.forEach(input => {
        if (input.getAttribute('wire:model') === 'vehicleValue') {
            input.addEventListener('input', function(e) {
                // Add thousands separators for display (optional)
                if (e.target.value) {
                    const value = parseInt(e.target.value.replace(/,/g, ''));
                    if (!isNaN(value)) {
                        // You can format the display here if needed
                    }
                }
            });
        }
    });
});

// Utility functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-TZ', {
        style: 'currency',
        currency: 'TZS',
        minimumFractionDigits: 0
    }).format(amount);
}

function scrollToResults() {
    const resultsSection = document.querySelector('.lg\\:col-span-1');
    if (resultsSection) {
        resultsSection.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<style>
/* Custom styles for better visual appeal */
.gradient-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, transform;
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

/* Hover effects for cards */
.hover-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.hover-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Loading animation */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
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
