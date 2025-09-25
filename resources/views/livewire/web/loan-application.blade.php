<div>
<!-- resources/views/livewire/loan-application.blade.php -->
<div class="bg-white w-full">
    <!-- Breadcrumb -->
    <div class="bg-green-600 py-4 border-b border-gray-200">
        <div class="container text-white mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex  text-white items-center">
                        <a href="" class="inline-flex items-center text-sm font-medium  hover:text-green-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('vehicle.list', $vehicle->id) }}" class="ml-1 text-sm font-medium text-white hover:text-green-600 md:ml-2">
                        </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Loan Application - {{ $lender->name }}</span>
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
                    @php
                        $frontImage = $vehicle->frontView();
                    @endphp                       


                        <img
                         src="{{ $frontImage ? asset('storage/' . $frontImage->image_url) : asset('default/car1.jpg') }}" 

                         alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-32 object-cover rounded-lg">
                    </div>

                    <div class="md:w-3/4">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">

                    </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div>
                                <div class="text-xs text-gray-500">Condition</div>
                                <div class="text-sm font-medium">{{ $vehicle->vehicle_condition }}</div>
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
          <!-- Blade View: resources/views/livewire/web/loan-application.blade.php -->
<div class="bg-white rounded-xl shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-2">Loan Application Form</h2>
    <p class="text-gray-600 mb-6">Please fill in all required information to apply for financing.</p>
    
    <form wire:submit.prevent="submitApplication" enctype="multipart/form-data">
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
                    <input readonly type="email" id="email" wire:model.defer="email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number*</label>
                    <input readonly type="text" id="phone_number" wire:model.defer="phone_number" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    @error('phone_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="national_id" class="block text-sm font-medium text-gray-700 mb-1">National ID*</label>
                    <input type="text" id="national_id" wire:model.defer="national_id"
                    oninput="formatNationalId(this)"
                    placeholder="20060329-14129-00001-27"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('national_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- National ID Upload -->
            <div class="mt-4">
                <label for="id_document" class="block text-sm font-medium text-gray-700 mb-1">Upload ID Document (National ID/Passport/Driver's License)*</label>
                <input type="file" id="id_document" wire:model="id_document" class="w-full p-2 border border-gray-300 rounded-lg" accept=".jpg,.jpeg,.png,.pdf">
                <p class="mt-1 text-xs text-gray-500">Accepted formats: JPG, PNG, PDF (Max size: 2MB)</p>
                @error('id_document') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                <div wire:loading wire:target="id_document" class="mt-1 text-sm text-gray-600">Uploading...</div>
            </div>
        </div>
        
        <!-- Address Information -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Address Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region*</label>
                    <input type="text" id="region" wire:model="region" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                       
                   
                    @error('region') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District*</label>
                    <input type="text" id="district" wire:model.defer="district" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                       
             
                    @error('district') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Street/Area*</label>
                    <input type="text" id="street" wire:model.defer="street" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    @error('street') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
        
        <!-- Employment Status -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Employment Status</h3>
            <div class="mb-4">
                <label for="employment_status" class="block text-sm font-medium text-gray-700 mb-1">Are you currently employed?*</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="is_employed" value="1" class="text-green-600 focus:ring-green-500 h-4 w-4">
                        <span class="ml-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="is_employed" value="0" class="text-green-600 focus:ring-green-500 h-4 w-4">
                        <span class="ml-2">No</span>
                    </label>
                </div>
                @error('is_employed') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <!-- Bank Statement Upload (Always required) -->
            <div class="mb-4">
                <label for="bank_statement" class="block text-sm font-medium text-gray-700 mb-1">Upload Bank Statement (Last 3 months)*</label>
                <input type="file" id="bank_statement" wire:model="bank_statement" class="w-full p-2 border border-gray-300 rounded-lg" accept=".pdf,.jpg,.jpeg,.png">
                <p class="mt-1 text-xs text-gray-500">Accepted formats: JPG, PNG, PDF (Max size: 5MB)</p>
                @error('bank_statement') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                <div wire:loading wire:target="bank_statement" class="mt-1 text-sm text-gray-600">Uploading...</div>
            </div>
        </div>
        
        <!-- Employment Information (Only if employed) -->
        @if($is_employed)
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
                    <label for="monthly_income" class="block text-sm font-medium text-gray-700 mb-1">Monthly Income (TZS)*</label>
                    <input type="text" id="monthly_income" wire:model.defer="monthly_income" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    @error('monthly_income') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="is_government_employee" class="flex items-center space-x-3 mb-3">
                        <input type="checkbox" id="is_government_employee" wire:model="is_employee" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="text-sm font-medium text-gray-700">Government Employee</span>
                    </label>
                    
                    @if($is_employee)
                    <div>
                        <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                        <input type="text" id="employee_id" wire:model.defer="employee_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        @error('employee_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Payslip Upload (Only if employed) -->
            <div class="mt-4">
                <label for="payslip" class="block text-sm font-medium text-gray-700 mb-1">Upload Recent Payslip*</label>
                <input type="file" id="payslip" wire:model="payslip" class="w-full p-2 border border-gray-300 rounded-lg" accept=".pdf,.jpg,.jpeg,.png">
                <p class="mt-1 text-xs text-gray-500">Accepted formats: JPG, PNG, PDF (Max size: 2MB)</p>
                @error('payslip') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                <div wire:loading wire:target="payslip" class="mt-1 text-sm text-gray-600">Uploading...</div>
            </div>
        </div>
        @endif
        
        <!-- Loan Details -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Loan Details</h3>
            
            <!-- Basic Loan Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">Purchase Price (TZS)*</label>
                    <input type="text" id="purchase_price" wire:model="purchase_price" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" readonly>
                </div>
                <div>
                    <label for="down_payment" class="block text-sm font-medium text-gray-700 mb-1">Down Payment (TZS)*</label>
                    <input type="text" id="down_payment" readonly wire:model="down_payment" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    @error('down_payment') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="loan_amount" class="block text-sm font-medium text-gray-700 mb-1">Loan Amount (TZS)*</label>
                    <input type="text" id="loan_amount" wire:model="loan_amount" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" readonly>
                </div>
                <div>
                    <label for="tenure" class="block text-sm font-medium text-gray-700 mb-1">Loan Term*</label>
                    <select id="tenure" wire:model.defer="tenure" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <option value="">Select Loan Term</option>
                        @foreach($loanProducts as $product)
                            <option value="{{ $product }}">{{ $product }} months</option>
                        @endforeach
                    </select>
                    @error('tenure') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Loan Terms Summary -->
            @if($interest_rate > 0 || $loan_amount > 0)
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-4">
                <h4 class="font-medium text-gray-800 mb-3">Loan Terms Summary</h4>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="text-center p-3 bg-white rounded-lg border">
                        <p class="text-xs text-gray-500 mb-1">Interest Rate</p>
                        <p class="text-lg font-bold text-blue-600">{{ number_format($interest_rate, 2) }}%</p>
                        <p class="text-xs text-gray-400">Annual Rate</p>
                    </div>
                    <div class="text-center p-3 bg-white rounded-lg border">
                        <p class="text-xs text-gray-500 mb-1">Loan Amount</p>
                        <p class="text-lg font-bold text-green-600">TZS {{ number_format($loan_amount) }}</p>
                        <p class="text-xs text-gray-400">Principal</p>
                    </div>
                    <div class="text-center p-3 bg-white rounded-lg border">
                        <p class="text-xs text-gray-500 mb-1">Loan Term</p>
                        <p class="text-lg font-bold text-purple-600">{{ $tenure ?: 'Select' }} {{ $tenure ? 'months' : 'term' }}</p>
                        <p class="text-xs text-gray-400">Duration</p>
                    </div>
                    <div class="text-center p-3 bg-white rounded-lg border">
                        <p class="text-xs text-gray-500 mb-1">Monthly Payment</p>
                        <p class="text-lg font-bold text-orange-600">
                            @if($estimated_payment)
                                TZS {{ number_format($estimated_payment) }}
                            @else
                                Select Term
                            @endif
                        </p>
                        <p class="text-xs text-gray-400">EMI</p>
                    </div>
                </div>
                
                @if($estimated_payment && $tenure && $loan_amount)
                @php
                    $totalPayment = $estimated_payment * $tenure;
                    $totalInterest = $totalPayment - $loan_amount;
                    $monthlyInterestRate = $interest_rate / 100 / 12;
                @endphp
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Payment:</span>
                            <span class="font-medium">TZS {{ number_format($totalPayment) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Interest:</span>
                            <span class="font-medium text-red-600">TZS {{ number_format($totalInterest) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Interest Ratio:</span>
                            <span class="font-medium text-orange-600">{{ number_format(($totalInterest / $loan_amount) * 100, 1) }}%</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
            
            <!-- Application Document Upload -->
            <!-- <div class="mt-4">
                <label for="application_document" class="block text-sm font-medium text-gray-700 mb-1">Upload Application Form (if available)</label>
                <input type="file" id="application_document" wire:model="application_document" class="w-full p-2 border border-gray-300 rounded-lg" accept=".pdf,.jpg,.jpeg,.png,.docx">
                <p class="mt-1 text-xs text-gray-500">Accepted formats: JPG, PNG, PDF, DOCX (Max size: 5MB)</p>
                @error('application_document') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                <div wire:loading wire:target="application_document" class="mt-1 text-sm text-gray-600">Uploading...</div>
            </div> -->
            
            <!-- Monthly Payment Calculator -->
            @if($interest_rate > 0 || $estimated_payment)
            <div class="mt-6 bg-gradient-to-r from-blue-50 to-green-50 p-6 rounded-xl border border-blue-200">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <h4 class="text-xl font-bold text-gray-800">Monthly Payment Calculator</h4>
                </div>
                
                <!-- Payment Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                        <p class="text-sm text-gray-600 mb-1">Interest Rate</p>
                        <p class="text-2xl font-bold text-blue-600">{{ number_format($interest_rate, 2) }}%</p>
                        <p class="text-xs text-gray-500 mt-1">Annual Rate</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                        <p class="text-sm text-gray-600 mb-1">Loan Amount</p>
                        <p class="text-2xl font-bold text-green-600">TZS {{ number_format($loan_amount) }}</p>
                        <p class="text-xs text-gray-500 mt-1">Principal</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                        <p class="text-sm text-gray-600 mb-1">Monthly Payment</p>
                        <p class="text-2xl font-bold text-purple-600">TZS {{ number_format($estimated_payment) }}</p>
                        <p class="text-xs text-gray-500 mt-1">EMI</p>
                    </div>
                </div>

                <!-- Detailed Breakdown -->
                @if($estimated_payment && $tenure && $loan_amount)
                @php
                    $totalPayment = $estimated_payment * $tenure;
                    $totalInterest = $totalPayment - $loan_amount;
                    $monthlyInterestRate = $interest_rate / 100 / 12;
                @endphp
                
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h5 class="font-semibold text-gray-800 mb-3">Payment Breakdown</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Loan Term:</span>
                                <span class="text-sm font-medium">{{ $tenure }} months</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Total Payment:</span>
                                <span class="text-sm font-medium">TZS {{ number_format($totalPayment) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Total Interest:</span>
                                <span class="text-sm font-medium text-red-600">TZS {{ number_format($totalInterest) }}</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Principal:</span>
                                <span class="text-sm font-medium text-green-600">TZS {{ number_format($loan_amount) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Monthly Interest Rate:</span>
                                <span class="text-sm font-medium">{{ number_format($monthlyInterestRate * 100, 3) }}%</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Interest to Principal Ratio:</span>
                                <span class="text-sm font-medium">{{ number_format(($totalInterest / $loan_amount) * 100, 1) }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Payment Options Comparison -->
                @if(!empty($paymentOptions))
                <div class="mt-6 bg-white p-4 rounded-lg border border-gray-200">
                    <h5 class="font-semibold text-gray-800 mb-4">Compare Loan Terms</h5>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Loan Term</th>
                                    <th class="text-right py-3 px-4 font-medium text-gray-700">Monthly Payment</th>
                                    <th class="text-right py-3 px-4 font-medium text-gray-700">Total Payment</th>
                                    <th class="text-right py-3 px-4 font-medium text-gray-700">Total Interest</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentOptions as $option)
                                <tr class="border-b hover:bg-gray-50 {{ $option['is_selected'] ? 'bg-blue-50 border-blue-200' : '' }}">
                                    <td class="py-3 px-4">
                                        <span class="font-medium">{{ $option['term'] }} months</span>
                                        @if($option['is_selected'])
                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Selected
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-right py-3 px-4 font-medium text-green-600">
                                        TZS {{ number_format($option['monthly_payment']) }}
                                    </td>
                                    <td class="text-right py-3 px-4">
                                        TZS {{ number_format($option['total_payment']) }}
                                    </td>
                                    <td class="text-right py-3 px-4 text-red-600">
                                        TZS {{ number_format($option['total_interest']) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">
                        <strong>Tip:</strong> Longer terms mean lower monthly payments but higher total interest. 
                        Shorter terms mean higher monthly payments but less total interest.
                    </p>
                </div>
                @endif

                <!-- Disclaimer -->
                <div class="mt-4 p-4 bg-orange-50 border border-orange-200 rounded-lg">
                <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mt-0.5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <div>
                            <p class="text-sm text-orange-700 font-medium mb-1">Important Disclaimer</p>
                            <p class="text-xs text-orange-600">
                                These calculations are based on the interest rate from the financing criteria table and are approximate estimates only. 
                                Final rates and payments may vary based on credit approval, loan terms, processing fees, insurance, and other factors. 
                                Please contact the lender for exact terms and conditions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Terms and Submission -->
        <div class="mb-6">

        <!-- <div class="mt-4 p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg">
            After submission, please send your bank statement to <a href="mailto:kiboauto@gmail.com" class="font-semibold underline text-green-700">kiboauto@gmail.com</a>.
        </div> -->



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
            <button type="button" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-150">
                Cancel
            </button>
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

        <!-- Step 1 -->
        <div class="relative z-10 flex items-start mb-6">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-100 text-green-600 border-4 border-white">
                    <span class="text-lg font-bold">1</span>
                </div>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Apply for Financing</h3>
                <p class="mt-1 text-gray-600">Fill in the application form with your personal, vehicle, and financial details.</p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="relative z-10 flex items-start mb-6">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-600 border-4 border-white">
                    <span class="text-lg font-bold">2</span>
                </div>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Car Dealer Approval</h3>
                <p class="mt-1 text-gray-600">The car dealer will review and approve your vehicle financing request.</p>
            </div>
        </div>




        <div class="relative z-10 flex items-start mb-6">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-600 border-4 border-white">
                    <span class="text-lg font-bold">3</span>
                </div>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Statement Verification</h3>
                <p class="mt-1 text-gray-600"></p>
            </div>
        </div>



        <!-- Step 3 -->
        <div class="relative z-10 flex items-start mb-6">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-600 border-4 border-white">
                    <span class="text-lg font-bold">4</span>
                </div>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Lender Review & Approval</h3>
                <p class="mt-1 text-gray-600">{{ $lender->name }} will assess your application and approve the loan based on eligibility.</p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="relative z-10 flex items-start">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-600 border-4 border-white">
                    <span class="text-lg font-bold">5</span>
                </div>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Loan Disbursement</h3>
                <p class="mt-1 text-gray-600">Once approved, the loan amount is disbursed directly to the vehicle seller.</p>
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
                <p class="text-sm text-blue-700">Applications typically take 1–3 business days. Updates are sent via email and SMS.</p>
            </div>
        </div>
    </div>
</div>




        </div>
    </div>
</div>




<script>
function formatNationalId(input) {
    let value = input.value.replace(/\D/g, '').slice(0, 20); // digits only, limit length
    let formatted = '';

    if (value.length >= 8) {
        formatted += value.slice(0, 8) + '-';
        if (value.length >= 13) {
            formatted += value.slice(8, 13) + '-';
            if (value.length >= 18) {
                formatted += value.slice(13, 18) + '-';
                formatted += value.slice(18, 20);
            } else {
                formatted += value.slice(13);
            }
        } else {
            formatted += value.slice(8);
        }
    } else {
        formatted += value;
    }

    input.value = formatted;
}
</script>




</div>
