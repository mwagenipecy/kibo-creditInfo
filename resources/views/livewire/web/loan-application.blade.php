<div>
<!-- resources/views/livewire/loan-application.blade.php -->
<div class="bg-white w-full">
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('vehicle.list', $vehicle->id) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ml-2">

                        </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Loan Application - {{ $lender->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <!-- Vehicle & Lender Info -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
                    <div class="flex items-center mb-4 md:mb-0">
                        <img src="{{ asset('/cars/icon.avif') }}" alt="{{ $lender->name }}" class="h-12 w-12 object-contain mr-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $lender->name }}</h2>
                            <p class="text-sm text-gray-600">Loan Application</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <div class="text-sm text-gray-600">Vehicle Price:</div>
                        <div class="text-lg font-bold text-green-600">TZS {{ number_format($vehicle->price) }}</div>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="md:w-1/4">
                        <img src="{{ asset('/cars/blue-car-driving-road.jpg') }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-32 object-cover rounded-lg">
                    </div>
                    <div class="md:w-3/4">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">

                    </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div>
                                <div class="text-xs text-gray-500">Condition</div>
                                <div class="text-sm font-medium">{{ $vehicle->condition }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Mileage</div>
                                <div class="text-sm font-medium">{{ number_format($vehicle->mileage) }} km</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Color</div>
                                <div class="text-sm font-medium">{{ $vehicle->color }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">VIN</div>
                                <div class="text-sm font-medium">{{ $vehicle->vin }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('info') }}
    </div>
@endif


            <!-- Loan Application Form -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-2">Loan Application Form</h2>
                <p class="text-gray-600 mb-6">Please fill in all required information to apply for financing.</p>
                
                <form wire:submit.prevent="submitApplication">
                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name*</label>
                                <input type="text" id="first_name" wire:model.defer="first_name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                                <input type="text" id="middle_name" wire:model.defer="middle_name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name*</label>
                                <input type="text" id="last_name" wire:model.defer="last_name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                                <input type="email" id="email" wire:model.defer="email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number*</label>
                                <input type="text" id="phone_number" wire:model.defer="phone_number" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('phone_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="national_id" class="block text-sm font-medium text-gray-700 mb-1">National ID*</label>
                                <input type="text" id="national_id" wire:model.defer="national_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('national_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Address Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Address Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region*</label>
                                <input type="text" id="region" wire:model.defer="region" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                    <!-- <option value="">Select Region</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach -->
                                <!-- </input> -->
                                @error('region') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District*</label>
                                <input type="text" id="district" wire:model.defer="district" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                    <!-- <option value="">Select District</option> -->
                                    <!-- @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach -->
                               
                                @error('district') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Street/Area*</label>
                                <input type="text" id="street" wire:model.defer="street" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('street') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Employment Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Employment Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="employer_name" class="block text-sm font-medium text-gray-700 mb-1">Employer Name*</label>
                                <input type="text" id="employer_name" wire:model.defer="employer_name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('employer_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="hrEmail" class="block text-sm font-medium text-gray-700 mb-1">HR Email*</label>
                                <input type="email" id="hrEmail" wire:model.defer="hrEmail" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <p class="mt-1 text-xs text-gray-500">We will verify your employment with your HR department</p>
                                @error('hrEmail') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="is_employee" class="flex items-center space-x-3 mb-3">
                                    <input type="checkbox" id="is_employee" wire:model.defer="is_employee" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    <span class="text-sm font-medium text-gray-700">Government Employee</span>
                                </label>
                                
                                <div class="mt-1" x-data="{ open: false }" x-init="$watch('$wire.is_employee', value => { open = value })">
                                    <div x-show="open">
                                        <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                                        <input type="text" id="employee_id" wire:model.defer="employee_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        @error('employee_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="monthly_income" class="block text-sm font-medium text-gray-700 mb-1">Monthly Income (TZS)*</label>
                                <input type="text" id="monthly_income" wire:model.defer="monthly_income" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('monthly_income') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Loan Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Loan Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">Purchase Price (TZS)*</label>
                                <input type="text" id="purchase_price" wire:model="purchase_price" value="{{ $vehicle->price }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" readonly>
                            </div>
                            <div>
                                <label for="down_payment" class="block text-sm font-medium text-gray-700 mb-1">Down Payment (TZS)*</label>
                                @php
                                

                                $this->downPaymentPercent=$this->vehicle->downPaymentPercent;

                                $this->down_payment=$this->downPaymentPercent*$purchase_price/100

                                @endphp

                                <input type="text" id="down_payment" readonly wire:model="down_payment" value="{{ $down_payment }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                @error('down_payment') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="loan_amount" class="block text-sm font-medium text-gray-700 mb-1">Loan Amount (TZS)*</label>
                                <input type="text" id="loan_amount" wire:model="loan_amount" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" readonly>
                            </div>
                            <div>
                                <label for="loanProductId" class="block text-sm font-medium text-gray-700 mb-1">Loan Term*</label>
                                <select id="loanProductId" wire:model.defer="loanProductId" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    <option value="">Select Loan Term</option>
                                    @foreach($loanProducts as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->term }} months ({{ $product->interest_rate }}% interest)</option>
                                    @endforeach
                                </select>
                                @error('loanProductId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <!-- Monthly Payment Estimate -->
                        @if($estimated_payment)
                        <div class="mt-4 bg-green-50 p-4 rounded-lg border border-green-100">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-green-800">Estimated Monthly Payment:</h4>
                                    <p class="text-xl font-bold text-green-700">TZS {{ number_format($estimated_payment) }}</p>
                                    <p class="text-sm text-green-600 mt-1">This is an estimate. Final payment may vary based on credit approval.</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Terms and Submission -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" wire:model.defer="terms" type="checkbox" class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="text-gray-600">I have read and agree to the <a href="#" class="text-green-600 hover:underline">terms and conditions</a> and authorize the lender to verify my employment and check my credit history.</label>
                                @error('terms') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('vehicle.list', $vehicle->id) }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-150">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-150 flex items-center">
                            <svg wire:loading wire:target="submitApplication" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="submitApplication">Submit Application</span>
                            <span wire:loading wire:target="submitApplication">Processing...</span>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Application Process -->
            <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Application Process</h2>
                
                <div class="relative">
                    <div class="absolute left-5 top-0 h-full w-0.5 bg-gray-200"></div>
                    
                    <div class="relative z-10 flex items-start mb-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-100 text-green-600 border-4 border-white">
                                <span class="text-lg font-bold">1</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Submit Application</h3>
                            <p class="mt-1 text-gray-600">Complete this form with accurate personal and financial information.</p>
                        </div>
                    </div>
                    
                    <div class="relative z-10 flex items-start mb-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-600 border-4 border-white">
                                <span class="text-lg font-bold">2</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Document Verification</h3>
                            <p class="mt-1 text-gray-600">We will verify your employment and income details with your employer.</p>
                        </div>
                    </div>
                    
                    <div class="relative z-10 flex items-start mb-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-600 border-4 border-white">
                                <span class="text-lg font-bold">3</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Credit Assessment</h3>
                            <p class="mt-1 text-gray-600">{{ $lender->name }} will review your application and credit history to determine eligibility.</p>
                        </div>
                    </div>
                    
                    <div class="relative z-10 flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-600 border-4 border-white">
                                <span class="text-lg font-bold">4</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Approval & Disbursement</h3>
                            <p class="mt-1 text-gray-600">Upon approval, the loan will be disbursed directly to the vehicle seller.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="font-medium text-blue-800 mb-1">Processing Time</h4>
                            <p class="text-sm text-blue-700">Applications typically take 1-3 business days to process. You will receive status updates via email and SMS.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
