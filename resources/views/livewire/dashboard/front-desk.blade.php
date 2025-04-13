<div class="flex flex-col bg-white w-full">
    <!-- Notifications Area -->
    @if(session()->has('message_2'))
        <div class="bg-teal-100 border-l-4 border-teal-500 p-4 mb-6 rounded-r shadow-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-teal-800">{{ session('message_2') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('message_fail'))
        <div class="bg-red-100 border-l-4 border-red-500 p-4 mb-6 rounded-r shadow-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-red-800">{{ session('message_fail') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Tab Navigation -->
    <div class="mb-6 mx-4  border-b border-gray-200">
        <nav class="flex -mb-px">
            <button wire:click="$set('activeTab', 'application')" class="px-6 py-4 text-sm font-medium {{ $activeTab == 'application' ? 'text-green-700 border-b-2 border-green-500' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 border-transparent' }}">
                Loan Application
            </button>
            <button wire:click="$set('activeTab', 'calculator')" class="px-6 py-4 text-sm font-medium {{ $activeTab == 'calculator' ? 'text-green-700 border-b-2 border-green-500' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 border-transparent' }}">
                Loan Calculator
            </button>
        </nav>
    </div>

    <!-- Application Form -->
    @if($activeTab == 'application')
        <!-- Progress Indicator -->
        <div class="mb-6 mx-6">
            <div class="flex items-center">
                @foreach(['Personal Info', 'Vehicle Details', 'Loan Details', 'Documentation'] as $index => $stepLabel)
                    <div class="flex items-center relative">
                        <!-- Step Circle -->
                        <div class="flex items-center justify-center h-8 w-8 rounded-full {{ $applicationStep > $index ? 'bg-green-500' : ($applicationStep == $index ? 'bg-green-600' : 'bg-gray-200') }} {{ $applicationStep >= $index ? 'text-white' : 'text-gray-500' }}">
                            @if($applicationStep > $index)
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <!-- Step Label -->
                        <span class="ml-2 text-sm font-medium {{ $applicationStep == $index ? 'text-gray-900' : 'text-gray-500' }} hidden sm:block">{{ $stepLabel }}</span>
                    </div>
                    
                    <!-- Connector Line -->
                    @if($index < 3)
                        <div class="flex-1 h-0.5 mx-2 {{ $applicationStep > $index ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Step Content -->
        <div class=" mx-6 flex flex-col lg:flex-row gap-6">
            <!-- Main Form Area -->
            <div class="w-full lg:w-2/3 bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                <!-- Step 1: Personal Information -->
                @if($applicationStep == 0)
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Personal Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="firstname" class="block text-sm font-medium text-gray-700">First Name*</label>
                                <input type="text" id="firstname" wire:model.defer="firstname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('firstname') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="middlename" class="block text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" id="middlename" wire:model.defer="middlename" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                            
                            <div>
                                <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name*</label>
                                <input type="text" id="lastname" wire:model.defer="lastname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('lastname') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="nidanumber" class="block text-sm font-medium text-gray-700">National ID Number*</label>
                                <input type="text" id="nidanumber" wire:model.defer="nidanumber" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('nidanumber') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="phonenumber" class="block text-sm font-medium text-gray-700">Phone Number*</label>
                                <input type="text" id="phonenumber" wire:model.defer="phonenumber" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('phonenumber') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address*</label>
                                <input type="email" id="email" wire:model.defer="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="region" class="block text-sm font-medium text-gray-700">Region*</label>
                                    <input type="text" id="region" wire:model.defer="region" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    @error('region') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                
                                <div>
                                    <label for="district" class="block text-sm font-medium text-gray-700">District*</label>
                                    <input type="text" id="district" wire:model.defer="district" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    @error('district') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                
                                <div>
                                    <label for="ward" class="block text-sm font-medium text-gray-700">Ward/Street*</label>
                                    <input type="text" id="ward" wire:model.defer="ward" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    @error('ward') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Employment Information</h3>
                            
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <input id="isEmployee" type="checkbox" wire:model="isEmployee" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                    <label for="isEmployee" class="ml-2 block text-sm text-gray-900">
                                        Is the client employed?
                                    </label>
                                </div>
                            </div>
                            
                            @if($isEmployee)
                                <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="employeeId" class="block text-sm font-medium text-gray-700">Employee ID*</label>
                                            <input type="text" id="employeeId" wire:model.defer="employeeId" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('employeeId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="employmentPosition" class="block text-sm font-medium text-gray-700">Position</label>
                                            <input type="text" id="employmentPosition" wire:model.defer="employmentPosition" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        </div>


                                        <div>
                                            <label for="hrEmail" class="block text-sm font-medium text-gray-700"> Employer Email </label>
                                            <input type="email" id="hrEmail" wire:model.defer="hrEmail" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        </div>

                                    </div>
                                </div>
                            @else
                                <!-- <div>
                                    <label for="employerName" class="block text-sm font-medium text-gray-700">Employer Name*</label>
                                    <input type="text" id="employerName" wire:model.defer="employerName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    @error('employerName') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div> -->
                            @endif
                            
                            <div class="mt-4">
                                <label for="monthlyIncome" class="block text-sm font-medium text-gray-700">Monthly Income (TZS)*</label>
                                <input type="number" id="monthlyIncome" wire:model.defer="monthlyIncome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="e.g. 1,500,000">
                                @error('monthlyIncome') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <input id="otherLoans" type="checkbox" wire:model="otherLoans" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                    <label for="otherLoans" class="ml-2 block text-sm text-gray-900">
                                        I have other active loans
                                    </label>
                                </div>
                                
                                @if($otherLoans)
                                    <div class="mt-2">
                                        <label for="otherLoanDetails" class="block text-sm font-medium text-gray-700">Loan Details</label>
                                        <textarea id="otherLoanDetails" wire:model.defer="otherLoanDetails" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="Please provide details about your other loans"></textarea>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="button" wire:click="nextApplicationStep" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Next: Vehicle Details
                                <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button> 
                        </div>   nextApplicationStep
                    </div>
                @endif

                <!-- Step 2: Vehicle Details -->
                @if($applicationStep == 1)
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Vehicle Details</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="make_and_model" class="block text-sm font-medium text-gray-700">Make and Model*</label>
                                <input type="text" id="make_and_model" wire:model.defer="make_and_model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="e.g. Toyota Corolla">
                                @error('make_and_model') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="year_of_manufacture" class="block text-sm font-medium text-gray-700">Year of Manufacture*</label>
                                <input type="text" id="year_of_manufacture" wire:model.defer="year_of_manufacture" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="e.g. 2020">
                                @error('year_of_manufacture') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="vin" class="block text-sm font-medium text-gray-700">VIN (Vehicle Identification Number) / Chassis Number *</label>
                                <input type="text" id="vin" wire:model.defer="vin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('vin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700">Color*</label>
                                <input type="text" id="color" wire:model.defer="color" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('color') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="mileage" class="block text-sm font-medium text-gray-700">Mileage (km)*</label>
                                <input type="text" id="mileage" wire:model.defer="mileage" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('mileage') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="currentVehicleOwner" class="block text-sm font-medium text-gray-700">Current Vehicle Owner*</label>
                                <select id="currentVehicleOwner" wire:model="currentVehicleOwner" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">-- Select Owner Type --</option>
                                    <option value="Dealer">Car Dealer</option>
                                    <option value="Private">Private Seller</option>
                                    <option value="Import">Direct Import</option>
                                </select>
                                @error('currentVehicleOwner') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        @if($currentVehicleOwner == 'Dealer')
                            <div class="bg-gray-50 p-4 mb-6 rounded-md border border-gray-200">
                                <h3 class="text-md font-medium text-gray-700 mb-4">Dealer Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="dealerName" class="block text-sm font-medium text-gray-700">Dealer Name</label>
                                        <input type="text" id="dealerName" wire:model.defer="dealerName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                    
                                    <div>
                                        <label for="dealerContactInfo" class="block text-sm font-medium text-gray-700">Dealer Contact Information</label>
                                        <input type="text" id="dealerContactInfo" wire:model.defer="dealerContactInfo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex justify-between">
                            <button type="button" wire:click="prevApplicationStep" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Back
                            </button>
                            <button type="button" wire:click="nextApplicationStep" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Next: Loan Details
                                <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif


                <!-- Step 3: Loan Details -->
                 <!-- Step 3: Loan Details -->
                @if($applicationStep == 2)
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Loan Details</h2>
                        
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">
                                        Need help calculating your loan? Use our <a href="#" wire:click.prevent="$set('activeTab', 'calculator')" class="font-medium underline">Loan Calculator</a> first.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="purchase_price" class="block text-sm font-medium text-gray-700">Purchase Price (TZS)*</label>
                                <input type="number" id="purchase_price" wire:model.defer="purchase_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('purchase_price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="down_payment" class="block text-sm font-medium text-gray-700">Down Payment (TZS)*</label>
                                <input type="number" id="down_payment" wire:model.defer="down_payment" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('down_payment') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="loan_amount" class="block text-sm font-medium text-gray-700">Loan Amount (TZS)*</label>
                                <input type="number" id="loan_amount" wire:model.defer="loan_amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('loan_amount') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>



                            <div>
                                <label for="loanProductId" class="block text-sm font-medium text-gray-700">Select Lender </label>
                                <select id="loanProductId" wire:model="lender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">-- Select  --</option>
                                    @foreach($lenderList as $lenderx)
                                        <option value="{{ $lenderx->id }}">{{ $lenderx->name }} </option>
                                    @endforeach
                                </select>
                                @error('loanProductId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>




                            
                            <div>
                                <label for="loanProductId" class="block text-sm font-medium text-gray-700">Loan Product*</label>
                                <select id="loanProductId" wire:model.defer="loanProductId" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">-- Select Loan Product --</option>
                                    @foreach($loanProduct as $product)
                                        <option value="{{ $product->id }}">{{ $product->sub_product_name }} (Range: {{ $product->range($product->id) }})</option>
                                    @endforeach
                                </select>
                                @error('loanProductId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>


                        </div>
                        
                        <div class="flex justify-between">
                            <button type="button" wire:click="prevApplicationStep" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Back
                            </button>
                            <button type="button" wire:click="nextApplicationStep" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Next: Documentation
                                <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Step 4: Documentation -->
                @if($applicationStep == 3)
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Documentation & Review</h2>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Upload Required Documents</h3>
                            <p class="text-sm text-gray-600 mb-2">Please upload clear images of the following documents:</p>
                            <ul class="list-disc list-inside text-sm text-gray-600 mb-4 space-y-1">
                                <li>Vehicle photos (exterior, interior, engine)</li>
                                <li>National ID/Passport</li>
                                <li>Proof of income (payslips, bank statements)</li>
                                <li>Vehicle registration documents (if applicable)</li>
                            </ul>
                            
                            <!-- File Upload -->
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
    <div class="space-y-1 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex text-sm text-gray-600 justify-center">
            <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none">
                <span>Upload files</span>
                <input 
                    id="file-upload" 
                    name="images[]"
                    multiple 
                    type="file" 
                    wire:model="images" 
                    accept=".png,.jpg,.jpeg"
                    class="sr-only"
                >
            </label>
            <p class="pl-1">or drag and drop</p>
        </div>
        <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB each</p>
        
        {{-- Error handling --}}
        @error('images')
            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
        @enderror

        {{-- File count display --}}
        @if($images)
            <p class="text-xs text-green-600 mt-2">
                {{ count($images) }} file(s) selected
            </p>
        @endif
    </div>
</div>

                            @error('images') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            @error('images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Image Previews -->
                        @if(count($imagePreviews) > 0)
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Selected Documents</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                    @foreach($imagePreviews as $index => $preview)
                                        <div class="relative group">
                                            <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden shadow-sm border border-gray-200">
                                                <img src="{{ $preview['url'] }}" alt="Document preview" class="object-cover">
                                                <div class="absolute inset-0 bg-gray-900 bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <button type="button" wire:click="removeImage({{ $index }})" class="bg-red-600 text-white p-1 rounded-full hover:bg-red-700 focus:outline-none">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-sm text-center text-gray-700 truncate">{{ $preview['name'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- Application Summary -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Application Summary</h3>
                            <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <h4 class="text-sm font-medium text-gray-500">Applicant</h4>
                                            <p class="mt-1 text-sm text-gray-900">{{ $firstname }} {{ $middlename }} {{ $lastname }}</p>
                                        </div>
                                        
                                        <div class="sm:col-span-3">
                                            <h4 class="text-sm font-medium text-gray-500">Contact</h4>
                                            <p class="mt-1 text-sm text-gray-900">{{ $phonenumber }}</p>
                                            <p class="mt-1 text-sm text-gray-900">{{ $email }}</p>
                                        </div>
                                        
                                        <div class="sm:col-span-3">
                                            <h4 class="text-sm font-medium text-gray-500">Vehicle</h4>
                                            <p class="mt-1 text-sm text-gray-900">{{ $make_and_model }}, {{ $year_of_manufacture }}</p>
                                            <p class="mt-1 text-sm text-gray-900">Color: {{ $color }}, Mileage: {{ number_format($mileage) }} km</p>
                                        </div>
                                        
                                        <div class="sm:col-span-3">
                                            <h4 class="text-sm font-medium text-gray-500">Loan Amount</h4>
                                            <p class="mt-1 text-sm text-gray-900">TZS {{ number_format($loan_amount) }}</p>
                                            <p class="mt-1 text-sm text-gray-500">Down payment: TZS {{ number_format($down_payment) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <button type="button" wire:click="prevApplicationStep" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Back
                            </button>
                            <button type="button" wire:click="submitApplication" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Submit Application
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Sidebar - Information or Help -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Application Guide</h3>
                    
                    @if($applicationStep == 0)
                        <div class="prose prose-sm text-gray-600">
                            <h4 class="text-base font-medium text-gray-800">Personal Information</h4>
                            <p>Please provide accurate personal details. This information will be used to verify your identity and process your loan application.</p>
                            <ul class="mt-2 space-y-1">
                                <li>Make sure your name matches your ID document</li>
                                <li>Provide a valid phone number and email for communication</li>
                                <li>Your employment status may affect loan eligibility</li>
                            </ul>
                        </div>
                    @elseif($applicationStep == 1)
                        <div class="prose prose-sm text-gray-600">
                            <h4 class="text-base font-medium text-gray-800">Vehicle Details</h4>
                            <p>Enter accurate information about the vehicle you wish to finance. The vehicle details help us assess the loan value and terms.</p>
                            <ul class="mt-2 space-y-1">
                                <li>The VIN uniquely identifies the vehicle</li>
                                <li>Newer vehicles may qualify for better terms</li>
                                <li>Mileage affects the vehicle's value</li>
                            </ul>
                        </div>
                    @elseif($applicationStep == 2)
                        <div class="prose prose-sm text-gray-600">
                            <h4 class="text-base font-medium text-gray-800">Loan Information</h4>
                            <p>Select the loan details that best fit your financial situation. The loan amount, down payment, and product type determine your monthly payments.</p>
                            <ul class="mt-2 space-y-1">
                                <li>A larger down payment may lower your interest rate</li>
                                <li>Choose a loan product that matches your needs</li>
                                <li>Review the terms carefully before proceeding</li>
                            </ul>
                            
                            <div class="mt-4 p-3 bg-blue-50 rounded-md">
                                <h5 class="text-sm font-medium text-blue-800">Loan Calculator</h5>
                                <p class="text-sm text-blue-700">Use our loan calculator to estimate your monthly payments based on different loan amounts and terms.</p>
                                <button type="button" wire:click="$set('activeTab', 'calculator')" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Open Calculator
                                </button>
                            </div>
                        </div>
                    @elseif($applicationStep == 3)
                        <div class="prose prose-sm text-gray-600">
                            <h4 class="text-base font-medium text-gray-800">Documentation Requirements</h4>
                            <p>Upload clear photos or scans of all required documents to avoid delays in processing your application.</p>
                            <ul class="mt-2 space-y-1">
                                <li>ID document (National ID, passport)</li>
                                <li>Proof of income (salary slips, bank statements)</li>
                                <li>Vehicle documentation (if applicable)</li>
                                <li>Vehicle photos from multiple angles</li>
                            </ul>
                            
                            <div class="mt-4 p-3 bg-yellow-50 rounded-md">
                                <h5 class="text-sm font-medium text-yellow-800">Important Note</h5>
                                <p class="text-sm text-yellow-700">Review your application details carefully before submission. Once submitted, you'll be contacted by our team for the next steps.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif



    <!-- Step 3: Loan Calculator -->
@if($activeTab == 'calculator')
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            Loan Calculator
        </h2>
        
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Calculate your loan details to determine affordable monthly payments before applying. Once you're satisfied, you can use these values directly in your application.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 mb-6">
            <div>
                <label for="calculatorPrincipal" class="block text-sm font-medium text-gray-700">Loan Amount (TZS)</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">TZS</span>
                    </div>
                    <input type="number" id="calculatorPrincipal" wire:model.defer="calculatorPrincipal" 
                        class="pl-12 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                        placeholder="e.g. 10,000,000">
                </div>
                @error('calculatorPrincipal') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="calculatorInterestRate" class="block text-sm font-medium text-gray-700">Interest Rate (% per annum)</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input type="number" step="0.01" id="calculatorInterestRate" wire:model.defer="calculatorInterestRate" 
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                        placeholder="e.g. 12.5">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">%</span>
                    </div>
                </div>
                @error('calculatorInterestRate') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="calculatorTenure" class="block text-sm font-medium text-gray-700">Loan Term (months)</label>
                <input type="number" id="calculatorTenure" wire:model.defer="calculatorTenure" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                    placeholder="e.g. 36">
                @error('calculatorTenure') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="calculatorInterestMethod" class="block text-sm font-medium text-gray-700">Interest Method</label>
                <select id="calculatorInterestMethod" wire:model.defer="calculatorInterestMethod" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    <option value="reducing">Reducing Balance</option>
                    <option value="flat">Flat Rate</option>
                </select>
                <div class="mt-1 text-xs text-gray-500">
                    <span class="font-medium">Reducing Balance:</span> Interest calculated on remaining balance.<br>
                    <span class="font-medium">Flat Rate:</span> Interest calculated on initial principal throughout.
                </div>
            </div>
            
            <div>
                <label for="calculatorStartDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" id="calculatorStartDate" wire:model.defer="calculatorStartDate" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>
            
            <div>
                <label for="calculatorPaymentFrequency" class="block text-sm font-medium text-gray-700">Payment Frequency</label>
                <select id="calculatorPaymentFrequency" wire:model.defer="calculatorPaymentFrequency" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    <option value="monthly">Monthly</option>
                    <option value="daily">Daily</option>
                    <option value="quarterly">Quarterly</option>
                    <option value="semi_annual">Semi-Annual</option>
                    <option value="annual">Annual</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label for="calculatorGracePeriod" class="block text-sm font-medium text-gray-700">Grace Period (months)</label>
                <input type="number" id="calculatorGracePeriod" wire:model.defer="calculatorGracePeriod" 
                    class="mt-1 block w-full max-w-xs border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                    placeholder="e.g. 0">
                <p class="mt-1 text-xs text-gray-500">Period before principal repayment starts (interest may still accrue)</p>
            </div>
        </div>
        
        <div class="flex flex-wrap justify-between items-center mb-8">
            <div>
                <button type="button" wire:click="calculateSchedule" wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg wire:loading wire:target="calculateSchedule" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="calculateSchedule">Calculate</span>
                    <span wire:loading wire:target="calculateSchedule">Calculating...</span>
                </button>
                <button type="button" wire:click="resetCalculator" class="ml-2 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Reset
                </button>
            </div>
            
            @if($calculatorScheduleData)
                <button type="button" wire:click="useCalculatedValues" 
                    class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 border border-green-600 text-sm font-medium rounded-md text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Use These Values in Application
                </button>
            @endif
        </div>
        
        <!-- Calculator Results -->
        @if($calculatorScheduleData)
            <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Loan Summary</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-3 rounded border border-gray-100 shadow-sm">
                        <h4 class="text-xs font-medium text-gray-500 uppercase">Principal</h4>
                        <p class="text-xl font-semibold text-gray-900">TZS {{ number_format($calculatorPrincipal) }}</p>
                    </div>
                    
                    <div class="bg-white p-3 rounded border border-gray-100 shadow-sm">
                        <h4 class="text-xs font-medium text-gray-500 uppercase">Monthly Payment</h4>
                        <p class="text-xl font-semibold text-green-600">TZS {{ number_format($calculatorScheduleData['schedule'][0]['payment']) }}</p>
                    </div>
                    
                    <div class="bg-white p-3 rounded border border-gray-100 shadow-sm">
                        <h4 class="text-xs font-medium text-gray-500 uppercase">Total Interest</h4>
                        <p class="text-xl font-semibold text-gray-900">TZS {{ number_format($calculatorScheduleData['footer']['total_interest']) }}</p>
                    </div>
                    
                    <div class="bg-white p-3 rounded border border-gray-100 shadow-sm">
                        <h4 class="text-xs font-medium text-gray-500 uppercase">Total Payment</h4>
                        <p class="text-xl font-semibold text-gray-900">TZS {{ number_format($calculatorScheduleData['footer']['total_payment']) }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Payment Schedule Table -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Payment Schedule</h3>
                    <button type="button" wire:click="downloadRepaymentSchedule" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Excel
                    </button>
                </div>
                <div class="overflow-x-auto shadow border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                                <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Principal</th>
                                <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Interest</th>
                                <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($calculatorScheduleData['schedule'] as $index => $installment)
                                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $installment['installment_date'] }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($installment['payment']) }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($installment['principal']) }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($installment['interest']) }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($installment['closing_balance']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <td colspan="2" class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Totals</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-right">{{ number_format($calculatorScheduleData['footer']['total_payment']) }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-right">{{ number_format($calculatorScheduleData['footer']['total_principal']) }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-right">{{ number_format($calculatorScheduleData['footer']['total_interest']) }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-right">{{ number_format($calculatorScheduleData['footer']['final_closing_balance']) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- Visual Chart -->
                <div class="mt-6 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h4 class="text-base font-medium text-gray-900 mb-4">Payment Breakdown</h4>
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-full sm:w-1/2">
                            <div class="relative h-64 bg-gray-50 rounded-lg overflow-hidden">
                                <!-- Pie chart visualization would go here (using JavaScript charts) -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-sm text-gray-500">Principal vs Interest</div>
                                        <div class="mt-2 flex items-center justify-center space-x-4">
                                            <div class="flex items-center">
                                                <span class="h-3 w-3 bg-green-500 rounded-full mr-1"></span>
                                                <span class="text-xs text-gray-600">Principal ({{ round($calculatorScheduleData['footer']['total_principal'] / $calculatorScheduleData['footer']['total_payment'] * 100) }}%)</span>
                                            </div>
                                            <div class="flex items-center">
                                                <span class="h-3 w-3 bg-blue-400 rounded-full mr-1"></span>
                                                <span class="text-xs text-gray-600">Interest ({{ round($calculatorScheduleData['footer']['total_interest'] / $calculatorScheduleData['footer']['total_payment'] * 100) }}%)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Key Insights</h5>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-1.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Your total interest payment is <strong>{{ round($calculatorScheduleData['footer']['total_interest'] / $calculatorPrincipal * 100) }}%</strong> of the principal amount.</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-1.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Monthly payment is <strong>

                                        @php
    $payment = $calculatorScheduleData['schedule'][0]['payment'] ?? 0;
    $income = $monthlyIncome ?? 1;
    $percentage = $income != 0 ? round(($payment / $income) * 100) : 0;
@endphp

                                        
                                        {{  $percentage }}%

                                    </strong> of your monthly income.</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-blue-500 mr-1.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Loan will be fully paid by <strong>{{ \Carbon\Carbon::parse($calculatorScheduleData['schedule'][count($calculatorScheduleData['schedule'])-1]['installment_date'])->format('M Y') }}</strong>.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between">
                <button type="button" wire:click="$set('activeTab', 'application')" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Application
                </button>
                
                @if($calculatorScheduleData)
                    <button type="button" wire:click="startApplicationWithCalculatedValues" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Start Application with These Values
                        <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No calculation results</h3>
                <p class="mt-1 text-sm text-gray-500">Enter loan details and click Calculate to view the repayment schedule.</p>
            </div>
        @endif
    </div>
@endif



    </div>
    <!-- Loan Calculator Tab -->
    