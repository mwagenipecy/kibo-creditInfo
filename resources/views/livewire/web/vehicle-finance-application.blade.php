<div>

<div class="min-h-screen bg-gradient-to-br from-green-50 to-white">
    <!-- Enhanced Header -->
    <div class="bg-green-600 shadow-sm border-b-4 border-green-500">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-white mb-2">Vehicle Finance Application</h1>
                <p class="text-lg text-white mb-6">Get pre-approved for your dream vehicle in minutes</p>
                
                <!-- Enhanced Progress Indicator -->
                <div class="max-w-4xl mx-auto">
                    <div class="flex items-center justify-between mb-4">
                        @for($i = 1; $i <= $totalSteps; $i++)
                            <div class="flex items-center {{ $i < $totalSteps ? 'flex-1' : '' }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300
                                        {{ $currentStep > $i ? 'bg-green-600 text-white' : ($currentStep == $i ? 'bg-green-600 text-white ring-4 ring-green-200' : 'bg-gray-200 text-gray-500') }}">
                                        @if($currentStep > $i)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @else
                                            {{ $i }}
                                        @endif
                                    </div>
                                    <div class="ml-3 text-left">
                                        <div class="text-sm font-medium {{ $currentStep >= $i ? 'text-white' : 'text-green-100' }}">
                                            @switch($i)
                                                @case(1) Insurance Verification @break
                                                @case(2) Vehicle Details @break
                                                @case(3) Personal Information @break
                                                @case(4) Lender & Documents @break
                                            @endswitch
                                        </div>
                                        <div class="text-xs {{ $currentStep >= $i ? 'text-white' : 'text-green-200' }}">
                                            @switch($i)
                                                @case(1) Verify your vehicle insurance @break
                                                @case(2) Tell us about your vehicle @break
                                                @case(3) Your personal details @break
                                                @case(4) Choose lender & upload docs @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                                @if($i < $totalSteps)
                                    <div class="flex-1 mx-4">
                                        <div class="h-0.5 bg-green-300">
                                            <div class="h-0.5 bg-white transition-all duration-500" 
                                                 style="width: {{ $currentStep > $i ? '100%' : '0%' }}"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Main Form -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                
                <!-- Step 1: Insurance Verification -->
                @if($currentStep == 1)
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <!-- Step Header -->
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Insurance Verification</h2>
                                <p class="text-green-100">Verify your vehicle insurance to proceed with the application</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Help Section -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h3 class="text-sm font-semibold text-blue-800 mb-1">Why do we need this?</h3>
                                    <p class="text-sm text-blue-700">We verify your insurance to ensure your vehicle is properly covered before processing your loan application. This helps us provide you with the best financing options.</p>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-lg mx-auto">
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Vehicle Registration Number
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" 
                                           wire:model="registration_number" 
                                           placeholder="Enter registration number (e.g., T209EMJ)"
                                           class="w-full px-4 py-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg font-medium uppercase transition-all duration-200"
                                           style="text-transform: uppercase;"
                                           maxlength="10">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('registration_number') 
                                    <div class="mt-2 flex items-center text-red-600 text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                <button wire:click="verifyInsurance" 
                                        class="w-full mt-4 px-6 py-4 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center font-semibold text-lg transition-all duration-200 shadow-lg hover:shadow-xl"
                                        {{ $verification_loading ? 'disabled' : '' }}>
                                    @if($verification_loading)
                                        <svg class="animate-spin h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Verifying Insurance...
                                    @else
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Verify Insurance
                                    @endif
                                </button>
                            </div>

                            @if($insurance_verified)
                            <div class="mb-6 p-6 {{ $insurance_valid ? 'bg-green-50 border-2 border-green-200' : 'bg-red-50 border-2 border-red-200' }} rounded-xl">
                                <div class="flex items-center mb-4">
                                    @if($insurance_valid)
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-green-800">Insurance Verified Successfully!</h3>
                                            <p class="text-green-700">Your vehicle insurance is valid and up to date.</p>
                                        </div>
                                    @else
                                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-red-800">Insurance Issue Detected</h3>
                                            <p class="text-red-700">Please resolve the insurance issue before proceeding.</p>
                                        </div>
                                    @endif
                                </div>
                                
                                @if($insurance_data)
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 class="font-semibold text-gray-800 mb-3">Insurance Details</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Registration:</span>
                                            <span class="font-medium">{{ $insurance_data['motor']['registrationNumber'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Company:</span>
                                            <span class="font-medium">{{ $insurance_data['company']['companyName'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Product:</span>
                                            <span class="font-medium">{{ $insurance_data['productName'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Valid Until:</span>
                                            <span class="font-medium text-green-600">
                                                {{ \Carbon\Carbon::createFromTimestampMs($insurance_data['coverNoteEndDate'])->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif

                            @if($insurance_valid)
                            <div class="text-center">
                                <button wire:click="nextStep" 
                                        class="px-8 py-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 flex items-center justify-center mx-auto font-semibold text-lg shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                    Continue to Vehicle Details
                                </button>
                            </div>
                            @endif
                    </div>
                </div>
                @endif

                <!-- Step 2: Vehicle Information -->
                @if($currentStep == 2)
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <!-- Step Header -->
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Vehicle Information</h2>
                                <p class="text-green-100">Tell us about the vehicle you want to finance</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Help Section -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h3 class="text-sm font-semibold text-blue-800 mb-1">Vehicle Details Required</h3>
                                    <p class="text-sm text-blue-700">Please provide accurate vehicle information. This helps us find the best financing options and calculate your loan terms.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <!-- Vehicle Make & Model -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Vehicle Make & Model
                                </h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                                            Vehicle Make
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <select wire:model="selected_make_id" 
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                            <option value="">Select Vehicle Make</option>
                                            @foreach($makes as $make)
                                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selected_make_id') 
                                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                                            Vehicle Model
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <select wire:model="selected_model_id" 
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                                                {{ empty($selected_make_id) ? 'disabled' : '' }}>
                                            <option value="">Select Vehicle Model</option>
                                            @foreach($models as $model)
                                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selected_model_id') 
                                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Vehicle Specifications -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    Vehicle Specifications
                                </h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                                            Year of Manufacture
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" wire:model="year_of_manufacture" 
                                               min="1990" max="2025" 
                                               placeholder="e.g., 2020"
                                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                        @error('year_of_manufacture') 
                                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                                            Vehicle Color
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" wire:model="color" 
                                               placeholder="e.g., White, Black, Silver"
                                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                        @error('color') 
                                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                                            Mileage (KM)
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" wire:model="mileage" min="0"
                                               placeholder="e.g., 50000"
                                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                        @error('mileage') 
                                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                                            Purchase Price (TZS)
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" wire:model="purchase_price" min="1000"
                                               placeholder="e.g., 15000000"
                                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                        @error('purchase_price') 
                                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Vehicle Identification -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Vehicle Identification
                                </h3>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        VIN/Chassis Number
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" wire:model="vin" 
                                           placeholder="Enter 17-character VIN number"
                                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 uppercase"
                                           style="text-transform: uppercase;"
                                           maxlength="17">
                                    @error('vin') 
                                        <div class="mt-2 flex items-center text-red-600 text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if(count($qualified_lenders) > 0)
                        <div class="mt-8 p-6 bg-green-50 border-2 border-green-200 rounded-xl">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-green-800">{{ count($qualified_lenders) }} Qualified Lenders Found</h3>
                                    <p class="text-green-700">Great! We found lenders who can finance this vehicle.</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                            <button wire:click="prevStep" 
                                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Previous
                            </button>
                            <button wire:click="nextStep" 
                                    class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 flex items-center shadow-lg hover:shadow-xl">
                                Continue
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
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
    /* Enhanced step indicators */
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

    /* Mobile responsiveness improvements */
    @media (max-width: 768px) {
        .step-indicator {
            flex-direction: column;
            text-align: center;
        }
        
        .step-indicator .step-content {
            margin-left: 0;
            margin-top: 0.5rem;
        }
        
        .step-indicator .step-line {
            display: none;
        }
        
        .form-section {
            padding: 1rem;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .navigation-buttons {
            flex-direction: column;
            gap: 1rem;
        }
        
        .navigation-buttons button {
            width: 100%;
        }
    }

    /* Enhanced form styling */
    .form-input {
        transition: all 0.2s ease;
    }
    
    .form-input:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }
    
    .form-section {
        transition: all 0.3s ease;
    }
    
    .form-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    /* Loading animations */
    .loading-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: .5;
        }
    }

    /* Success animations */
    .success-bounce {
        animation: bounce 0.6s ease-in-out;
    }
    
    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% {
            transform: translate3d(0,0,0);
        }
        40%, 43% {
            transform: translate3d(0, -8px, 0);
        }
        70% {
            transform: translate3d(0, -4px, 0);
        }
        90% {
            transform: translate3d(0, -2px, 0);
        }
    }

    /* Enhanced button styles */
    .btn-primary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
    }
    
    .btn-secondary {
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* File upload enhancements */
    .file-upload-area {
        border: 2px dashed #d1d5db;
        transition: all 0.3s ease;
    }
    
    .file-upload-area:hover {
        border-color: #10b981;
        background-color: #f0fdf4;
    }
    
    .file-upload-area.dragover {
        border-color: #10b981;
        background-color: #f0fdf4;
        transform: scale(1.02);
    }

    /* Progress bar enhancements */
    .progress-bar {
        background: linear-gradient(90deg, #10b981 0%, #059669 100%);
        transition: width 0.5s ease;
    }

    /* Card hover effects */
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Input focus enhancements */
    .input-focus:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    /* Error state styling */
    .error-state {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    /* Success state styling */
    .success-state {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced form interactions
    const inputs = document.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
        // Add focus/blur effects
        input.addEventListener('focus', function() {
            this.classList.add('input-focus');
        });
        
        input.addEventListener('blur', function() {
            this.classList.remove('input-focus');
        });
        
        // Add error state styling
        input.addEventListener('invalid', function() {
            this.classList.add('error-state');
        });
        
        input.addEventListener('input', function() {
            this.classList.remove('error-state');
            if (this.checkValidity()) {
                this.classList.add('success-state');
            }
        });
    });

    // Auto-format registration number
    const regInput = document.querySelector('input[wire\\:model="registration_number"]');
    if (regInput) {
        regInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        });
    }

    // Auto-format VIN number
    const vinInput = document.querySelector('input[wire\\:model="vin"]');
    if (vinInput) {
        vinInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        });
    }

    // Format phone number
    const phoneInput = document.querySelector('input[wire\\:model="phone_number"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('255')) {
                    value = value.substring(0, 3) + ' ' + value.substring(3);
                }
                if (value.length > 7) {
                    value = value.substring(0, 7) + ' ' + value.substring(7);
                }
                if (value.length > 11) {
                    value = value.substring(0, 11) + ' ' + value.substring(11);
                }
            }
            this.value = value;
        });
    }

    // Format National ID
    const nationalIdInput = document.querySelector('input[wire\\:model="national_id"]');
    if (nationalIdInput) {
        nationalIdInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length >= 8) {
                value = value.substring(0, 8) + '-' + value.substring(8);
            }
            if (value.length >= 14) {
                value = value.substring(0, 14) + '-' + value.substring(14);
            }
            if (value.length >= 20) {
                value = value.substring(0, 20) + '-' + value.substring(20);
            }
            if (value.length >= 23) {
                value = value.substring(0, 23);
            }
            this.value = value;
        });
    }

    // Format currency inputs
    const currencyInputs = document.querySelectorAll('input[wire\\:model="purchase_price"], input[wire\\:model="monthly_income"], input[wire\\:model="down_payment"]');
    currencyInputs.forEach(input => {
        input.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = parseInt(value).toLocaleString('en-US');
            }
            this.value = value;
        });
    });

    // Enhanced file upload
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        const container = input.closest('.file-upload-container');
        if (container) {
            const dropZone = container.querySelector('.file-upload-area');
            
            if (dropZone) {
                dropZone.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('dragover');
                });
                
                dropZone.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                });
                
                dropZone.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        input.files = files;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            }
        }
    });

    // Smooth scrolling for form sections
    const formSections = document.querySelectorAll('.form-section');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, { threshold: 0.1 });
    
    formSections.forEach(section => {
        observer.observe(section);
    });

    // Add loading states to buttons
    const buttons = document.querySelectorAll('button[wire\\:click]');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.textContent.includes('Verify') || this.textContent.includes('Submit')) {
                this.classList.add('loading-pulse');
            }
        });
    });

    // Success animations
    document.addEventListener('livewire:load', function() {
        Livewire.on('insuranceVerified', () => {
            const successElement = document.querySelector('.insurance-success');
            if (successElement) {
                successElement.classList.add('success-bounce');
            }
        });
    });
});

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>




</div>
