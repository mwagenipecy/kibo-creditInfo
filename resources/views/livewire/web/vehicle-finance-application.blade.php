<div>

<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-8">
    <div class="container mx-auto px-4">
        <!-- Progress Bar -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-green-800">Vehicle Finance Application</h1>
                    <span class="text-sm text-gray-500">Step {{ $currentStep }} of {{ $totalSteps }}</span>
                </div>
                
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full transition-all duration-300" 
                         style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
                </div>
                
                <div class="flex justify-between text-xs text-gray-500">
                    <span class="{{ $currentStep >= 1 ? 'text-green-600 font-semibold' : '' }}">Insurance</span>
                    <span class="{{ $currentStep >= 2 ? 'text-green-600 font-semibold' : '' }}">Vehicle</span>
                    <span class="{{ $currentStep >= 3 ? 'text-green-600 font-semibold' : '' }}">Personal</span>
                    <span class="{{ $currentStep >= 4 ? 'text-green-600 font-semibold' : '' }}">Lender & Docs</span>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                
                <!-- Step 1: Insurance Verification -->
                @if($currentStep == 1)
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-green-800 mb-2">Verify Vehicle Insurance</h2>
                        <p class="text-gray-600">Enter your vehicle registration number to verify insurance coverage</p>
                    </div>

                    <div class="max-w-md mx-auto">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Registration Number</label>
                            <div class="flex">
                                <input type="text" 
                                       wire:model="registration_number" 
                                       placeholder="e.g., T209EMJ"
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 uppercase"
                                       style="text-transform: uppercase;">
                                <button wire:click="verifyInsurance" 
                                        class="px-6 py-3 bg-green-600 text-white rounded-r-lg hover:bg-green-700 disabled:opacity-50 flex items-center"
                                        {{ $verification_loading ? 'disabled' : '' }}>
                                    @if($verification_loading)
                                        <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Verifying...
                                    @else
                                        Verify
                                    @endif
                                </button>
                            </div>
                            @error('registration_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        @if($insurance_verified)
                        <div class="mb-6 p-4 {{ $insurance_valid ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }} rounded-lg">
                            <div class="flex items-center mb-3">
                                @if($insurance_valid)
                                    <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h3 class="text-green-800 font-semibold">Insurance Valid</h3>
                                @else
                                    <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <h3 class="text-red-800 font-semibold">Insurance Issue</h3>
                                @endif
                            </div>
                            
                            @if($insurance_data)
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Registration:</span> {{ $insurance_data['motor']['registrationNumber'] ?? 'N/A' }}</p>
                                <p><span class="font-medium">Company:</span> {{ $insurance_data['company']['companyName'] ?? 'N/A' }}</p>
                                <p><span class="font-medium">Product:</span> {{ $insurance_data['productName'] ?? 'N/A' }}</p>
                                <p><span class="font-medium">Valid Until:</span> 
                                    {{ \Carbon\Carbon::createFromTimestampMs($insurance_data['coverNoteEndDate'])->format('d M Y') }}
                                </p>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($insurance_valid)
                        <div class="text-center">
                            <button wire:click="nextStep" 
                                    class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                Continue to Vehicle Details
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Step 2: Vehicle Information -->
                @if($currentStep == 2)
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-green-800 mb-2">Vehicle Information</h2>
                        <p class="text-gray-600">Provide details about the vehicle you want to finance</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Make *</label>
                            <select wire:model="selected_make_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Select Make</option>
                                @foreach($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                            @error('selected_make_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Model *</label>
                            <select wire:model="selected_model_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Select Model</option>
                                @foreach($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                            @error('selected_model_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year of Manufacture *</label>
                            <input type="number" wire:model="year_of_manufacture" 
                                   min="1990" max="2025" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('year_of_manufacture') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color *</label>
                            <input type="text" wire:model="color" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('color') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mileage (KM) *</label>
                            <input type="number" wire:model="mileage" min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('mileage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Purchase Price (TZS) *</label>
                            <input type="number" wire:model="purchase_price" min="1000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('purchase_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">VIN/Chassis Number *</label>
                            <input type="text" wire:model="vin" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('vin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    @if(count($qualified_lenders) > 0)
                    <div class="mt-8 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <h3 class="text-green-800 font-semibold mb-2">{{ count($qualified_lenders) }} Qualified Lenders Found</h3>
                        <p class="text-green-700 text-sm">Great! We found lenders who can finance this vehicle.</p>
                    </div>
                    @endif

                    <div class="flex justify-between mt-8">
                        <button wire:click="prevStep" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Previous
                        </button>
                        <button wire:click="nextStep" 
                                class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Continue
                        </button>
                    </div>
                </div>
                @endif

                <!-- Step 3: Personal Information -->
                @if($currentStep == 3)
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-green-800 mb-2">Personal Information</h2>
                        <p class="text-gray-600">Tell us about yourself to complete the application</p>
                    </div>

                    <div class="space-y-6">
                        <!-- Personal Details -->
                        <div class="grid md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                <input type="text" wire:model="first_name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                <input type="text" wire:model="middle_name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                <input type="text" wire:model="last_name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" wire:model="email" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="text" wire:model="phone_number" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">National ID *</label>
                            <input type="text" wire:model="national_id" 
                                   placeholder="20060329-14129-00001-27"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('national_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Address Information -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Region *</label>
                                <select wire:model="selected_region" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Select Region</option>
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                @error('selected_region') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">District *</label>
                                <input type="text" wire:model="selected_district" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" />
                                   
                              
                                @error('selected_district') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Street/Ward *</label>
                            <input type="text" wire:model="street" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('street') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Employment Status -->
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Employment Information</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Employment Status *</label>
                                <div class="flex space-x-6">
                                    <label class="flex items-center">
                                        <input type="radio" wire:model="is_employed" value="1" class="text-green-600 focus:ring-green-500">
                                        <span class="ml-2">Employed</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" wire:model="is_employed" value="0" class="text-green-600 focus:ring-green-500">
                                        <span class="ml-2">Self-Employed/Other</span>
                                    </label>
                                </div>
                                @error('is_employed') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if($is_employed)
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer Name *</label>
                                    <input type="text" wire:model="employer_name" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    @error('employer_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">HR Email *</label>
                                    <input type="email" wire:model="hrEmail" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    @error('hrEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="flex items-center mb-2">
                                        <input type="checkbox" wire:model="is_employee" class="text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-700">I am a government employee</span>
                                    </label>
                                </div>

                                @if($is_employee)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employee ID *</label>
                                    <input type="text" wire:model="employee_id" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    @error('employee_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                @endif
                            </div>
                            @endif

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Monthly Income (TZS) *</label>
                                <input type="number" wire:model="monthly_income" min="0"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('monthly_income') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button wire:click="prevStep" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Previous
                        </button>
                        <button wire:click="nextStep" 
                                class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Continue
                        </button>
                    </div>
                </div>
                @endif

                <!-- Step 4: Lender Selection & Documents -->
                @if($currentStep == 4)
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-green-800 mb-2">Lender Selection & Documents</h2>
                        <p class="text-gray-600">Choose your preferred lender and upload required documents</p>
                    </div>

                    <!-- Qualified Lenders -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Available Lenders</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($qualified_lenders as $lender)
                            <div class="border rounded-lg p-4 {{ $selected_lender_id == $lender->id ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                                <label class="flex items-start cursor-pointer">
                                    <input type="radio" 
                                           wire:model="selected_lender_id" 
                                           value="{{ $lender->id }}" 
                                           class="mt-1 mr-3 text-green-600 focus:ring-green-500">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800">{{ $lender->name }}</h4>
                                        @if($lender->financingCriteria->first())
                                        <div class="text-sm text-gray-600 mt-1">
                                            <p>Interest Rate: {{ $lender->financingCriteria->first()->interest_rate }}%</p>
                                            <p>Min Down Payment: {{ $lender->financingCriteria->first()->min_down_payment_percent }}%</p>
                                            <p>Max Tenure: {{ $lender->financingCriteria->first()->max_tenure }} months</p>
                                        </div>
                                        @endif
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('selected_lender_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Loan Details -->
                    @if($selected_lender_id)
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Loan Details</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Down Payment (TZS) *</label>
                                <input type="number" wire:model="down_payment" min="0" disabled
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('down_payment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Loan Amount (TZS)</label>
                                <input type="text" value="{{ number_format($loan_amount) }}" disabled
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-100">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tenure (Months) *</label>
                                <select wire:model="tenure" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Select Tenure</option>
                                    @for($i = 12; $i <= 60; $i += 6)
                                    <option value="{{ $i }}">{{ $i }} months</option>
                                    @endfor
                                </select>
                                @error('tenure') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Document Upload -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800">Required Documents</h3>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ID Document *</label>
                                <input type="file" wire:model="id_document" 
                                       accept=".jpg,.jpeg,.png,.pdf"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('id_document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bank Statement *</label>
                                <input type="file" wire:model="bank_statement" 
                                       accept=".jpg,.jpeg,.png,.pdf"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('bank_statement') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if($is_employed)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Payslip *</label>
                                <input type="file" wire:model="payslip" 
                                       accept=".jpg,.jpeg,.png,.pdf"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                @error('payslip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            @endif
                        </div>

                        <!-- Vehicle Images -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Images * (3-10 photos)</label>
                            <input type="file" wire:model="vehicle_images" 
                                   multiple accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @error('vehicle_images') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @error('vehicle_images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            
                            @if(count($image_previews) > 0)
                            <div class="mt-4 grid grid-cols-3 md:grid-cols-5 gap-4">
                                @foreach($image_previews as $key => $preview)
                                <div class="relative">
                                    <img src="{{ $preview['url'] }}" alt="Preview" class="w-full h-20 object-cover rounded-lg">
                                    <button type="button" wire:click="removeImage({{ $key }})" 
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                        ×
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="border-t pt-6">
                            <label class="flex items-start">
                                <input type="checkbox" wire:model="terms_accepted" 
                                       class="mt-1 mr-3 text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-green-600 underline">Terms and Conditions</a> 
                                    and authorize the lender to verify my employment and financial information.
                                </span>
                            </label>
                            @error('terms_accepted') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button wire:click="prevStep" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Previous
                        </button>
                        <button wire:click="submitApplication" 
                                class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Submit Application
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div wire:loading.flex class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 flex items-center">
            <svg class="animate-spin h-6 w-6 text-green-600 mr-3" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700">Processing...</span>
        </div>
    </div>
</div>

<style>
    .step-indicator {
        transition: all 0.3s ease;
    }
    
    .step-indicator.active {
        background: linear-gradient(45deg, #10b981, #059669);
        color: white;
    }
    
    .step-indicator.completed {
        background: #10b981;
        color: white;
    }
</style>




</div>
