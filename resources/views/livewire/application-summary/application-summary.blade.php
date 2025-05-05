<div class="p-4 w-full bg-gray-50">
   

    <div class="p-6 bg-white shadow-lg rounded-xl max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Loan Applications</h2>
            <div class="flex space-x-2">
                <div class="relative">
                    <input type="text" wire:model="search" placeholder="Search applications..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 w-64">
                    <div class="absolute left-3 top-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <select wire:model="statusFilter" class="rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 py-2 px-4">
                    <option value="">All Statuses</option>
                    <option value="NEW CLIENT">New Application</option>
                    <option value="ACCEPTED">Accepted</option>
                    <option value="REJECTED">Rejected</option>
                    <option value="IN REVIEW">In Review</option>
                </select>
            </div>
        </div>


        @php
    function calculateMonthlyPayment($principal, $yearlyInterestRate, $months) {
        $monthlyRate = $yearlyInterestRate / 100 / 12;
        return $principal * $monthlyRate * pow(1 + $monthlyRate, $months) / (pow(1 + $monthlyRate, $months) - 1);
    }

    function calculateTotalInterest($principal, $yearlyInterestRate, $months) {
        $monthlyPayment = calculateMonthlyPayment($principal, $yearlyInterestRate, $months);
        return ($monthlyPayment * $months) - $principal;
    }

    function calculateDTI($application) {
        $monthlyIncome = $application->monthly_income ?? 3500000;
        $otherDebtPayments = $application->other_debt_payments ?? 500000;
        $loanAmount = $application->purchase_price - $application->down_payment;
        $monthlyLoanPayment = calculateMonthlyPayment($loanAmount, 12.5, 48);
        
        return round((($otherDebtPayments + $monthlyLoanPayment) / $monthlyIncome) * 100, 1);
    }
        @endphp



        @if(session()->has('message'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="font-medium">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        <div class="flex gap-6">
            <!-- Applications List -->
            <div class="w-1/3 h-[calc(100vh-12rem)] overflow-y-auto pr-2 space-y-3">
                @forelse($applicationx as $application)
                    <div 
                        wire:click="selectApplication({{ $application->id }})" 
                        class="p-4 border rounded-xl cursor-pointer transition-all duration-200 hover:shadow-md
                            {{ $selectedApplication && $selectedApplication->id == $application->id  ? 'border-green-500 bg-green-50'   : 'border-gray-200 bg-white' }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $application->first_name }} {{ $application->last_name }}</h3>
                                <p class="text-sm text-gray-600">{{ $application->phone_number }}</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $application->application_status === 'Approved' ? 'bg-green-100 text-green-800' : 
                                       ($application->application_status === 'Rejected' ? 'bg-red-100 text-red-800' : 
                                       ($application->application_status === 'In Review' ? 'bg-blue-100 text-blue-800' : 
                                        'bg-yellow-100 text-yellow-800')) }}">
                                    {{ $application->application_status }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $application->region }}, {{ $application->district }}
                        </div>
                        <div class="mt-1 flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h6m-6 4h6m-6-8h6M7 8h6m0 0v6m-6 0h6" />
                            </svg>
                            {{ $application->make_and_model }} ({{ $application->year_of_manufacture }})
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 bg-white rounded-xl border border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No applications found</h3>
                        <p class="mt-1 text-sm text-gray-500">No loan applications match your search criteria.</p>
                    </div>
                @endforelse

                {{ $applicationx->links() }}
            </div>

            <!-- Application Details or Modal Trigger -->
            <div class="w-2/3">
                @if($selectedApplication)

                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="bg-green-700 px-6 py-4 flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-white">Application Details</h3>
                            <div class="flex space-x-2">
                                <button wire:click="openApplicationModal" class="px-4 py-2 bg-white text-green-700 rounded-md font-medium hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-700">
                                    View Full Details
                                </button>
                                <div class="relative" x-data="{ open: false }">
                                  
                                    <button  class="p-2 rounded-md bg-green-600 text-white hover:bg-green-800 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>

                                    <!-- <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-10">
                                        <div class="py-1">
                                            <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                                Edit Application
                                            </a>
                                            <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                Download Documents
                                            </a>
                                        </div>
                                        <div class="py-1">
                                            <a href="#" class="group flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                Delete Application
                                            </a>
                                        </div>
                                    </div> -->



                                </div>

                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Applicant Information</h4>
                                    <div class="space-y-2">
                                        <div class="flex">
                                            <span class="text-sm text-gray-500 w-1/3">Full Name:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->first_name }} {{ $selectedApplication->middle_name }} {{ $selectedApplication->last_name }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="text-sm text-gray-500 w-1/3">National ID:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->national_id }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="text-sm text-gray-500 w-1/3">Phone Number:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->phone_number }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="text-sm text-gray-500 w-1/3">Email:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Address Information</h4>
                                    <div class="space-y-2">
                                        <div class="flex">
                                            <span class="text-sm text-gray-500 w-1/3">Region:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->region }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="text-sm text-gray-500 w-1/3">District:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->district }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="text-sm text-gray-500 w-1/3">Street:</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->street }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Vehicle Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Make & Model</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->make_and_model }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Year</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->year_of_manufacture }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Color</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->color }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">VIN</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->vin }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Mileage</span>
                                        <span class="text-sm font-medium text-gray-900">{{ number_format($selectedApplication->mileage, 0) }} km</span>
                                    </div>
                                </div>
                            </div>



                            
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Financial Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Purchase Price</span>
                                        <span class="text-sm font-medium text-gray-900">TZS {{ number_format($selectedApplication->purchase_price, 2) }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Down Payment</span>
                                        <span class="text-sm font-medium text-gray-900">TZS {{ number_format($selectedApplication->down_payment, 2) }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Loan Amount</span>
                                        <span class="text-sm font-medium text-gray-900">TZS {{ number_format($selectedApplication->purchase_price - $selectedApplication->down_payment, 2) }}</span>
                                    </div>
                                </div>
                            </div>



                          



                            <div class="bg-amber-50 border-l-4 mb-4 border-amber-500 rounded-lg shadow-md p-5 transition-all duration-300 hover:shadow-lg">
            <div class="flex flex-col sm:flex-row">
                <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-4">
                    <div class="bg-amber-500 text-white w-12 h-12 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                </div>
                <div class="flex-grow">
                    <h5 class="text-amber-800 font-semibold text-lg mb-2">Action Required!</h5>
                    <p class="text-gray-700 mb-3">If you want this application to proceed, please approve it. Otherwise, cancel the application by rejecting it with an appropriate reason.</p>
                    <p class="text-gray-700"><span class="font-bold text-amber-700">Note:</span> This decision cannot be changed once submitted.</p>
                    
                    <div class="mt-4 flex justify-end space-x-3">
                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors font-medium focus:outline-none focus:ring-2 focus:ring-gray-400">
                            Reject
                        </button>
                        <button class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600 transition-colors font-medium focus:outline-none focus:ring-2 focus:ring-amber-500">
                            Approve
                        </button>
                    </div>
                </div>
            </div>
        </div>








                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Application Document </h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   


                                @forelse($applicationDocuments as $appDocument)
    <button 
        wire:click="download('{{ $appDocument->url }}')" 
        type="button" 
        class="w-full md:w-1/2 border-2 border-primary-100 px-6 py-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 motion-reduce:transition-none dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950" 
        data-twe-ripple-init 
        data-twe-ripple-color="light"
    >
        <div class="flex items-center justify-between w-full">
            <span class="truncate max-w-[80%] overflow-hidden whitespace-nowrap">
                {{ $appDocument->type }}
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-primary-700 dark:text-primary-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75v6a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0019.5 18.75v-6m-3.75-3L12 15m0 0L8.25 9.75M12 15V3" />
            </svg>
        </div>
    </button>
@empty
    <div class="text-sm text-gray-500">No documents available</div>
@endforelse




                                </div>
                            </div>




                            <div>
    <!-- Other application details sections would be here -->
    
    @if($selectedApplication->is_employee)
    <div class="bg-gray-50  mb-6 p-6 space-y-4 mt-6">
        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Employment Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-600">Employee Number</label>
                <div class="text-gray-800">{{ $selectedApplication->employee_id }}</div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Employer Email</label>
                <div class="text-gray-800">{{ $selectedApplication->hrEmail }}</div>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-md font-semibold text-gray-700">Employment Verification</h3>
                
                @if($employerMessageSent)
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 mr-3">Sent: {{ $employerMessageSentDate }}</span>
                        <button 
                            wire:click="resendVerification" 
                            class="px-3 py-1 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition"
                        >
                            Resend
                        </button>
                    </div>
                @else
                    <button 
                        wire:click="toggleEmployerMessageForm" 
                        class="px-3 py-1 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition"
                    >
                        {{ $showEmployerMessageForm ? 'Cancel' : 'Contact Employer' }}
                    </button>
                @endif
            </div>

            @if($showEmployerMessageForm)
                <div wire:loading.class="opacity-50" class="mt-3 border border-gray-200 rounded-md p-4 bg-gray-50">
                    <label for="messageToEmployer" class="block text-sm font-medium text-gray-700 mb-2">Message to Employer</label>
                    <textarea 
                        id="messageToEmployer"
                        wire:model.defer="messageToEmployer" 
                        rows="6"
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 text-sm"
                        placeholder="Write a message to the employer with your questions..."
                    ></textarea>
                    @error('messageToEmployer') 
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="mt-3 flex justify-end">
                        <div wire:loading wire:target="sendToEmployer" class="mr-3">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <button 
                            wire:click="sendToEmployer"
                            wire:loading.attr="disabled"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition disabled:opacity-50"
                        >
                            Send Verification Request
                        </button>
                    </div>
                </div>
            @else
                @if($employerMessageSent)
                    <div class="bg-green-50 border border-green-200 rounded-md p-3 text-sm">
                        <div class="flex items-center text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Verification request sent to employer on {{ $employerMessageSentDate }}
                        </div>
                        
                        @if($selectedApplication->employer_verified)
                            <div class="mt-2 ml-7 text-green-700">
                                <span class="font-medium">Response received:</span> {{ $selectedApplication->employer_verified_at }}
                            </div>
                            
                            <div class="mt-3 pt-3 border-t border-green-200">
                                <h4 class="font-medium text-green-800 mb-1">Employer Verification Result:</h4>
                                <div class="ml-1">
                                    @php
                                        $verification = App\Models\EmployerVerification::where('application_id', $selectedApplication->id)
                                            ->where('status', 'completed')
                                            ->latest()
                                            ->first();
                                        
                                        $response = $verification ? $verification->employer_response : null;
                                    @endphp
                                    
                                    @if($response)
                                        <ul class="space-y-1 text-sm">
                                            <li><span class="font-medium">Knows Employee:</span> 
                                                @if($response['knows_employee'] === 'yes')
                                                    <span class="text-green-700">Yes</span>
                                                @else
                                                    <span class="text-red-700">No</span>
                                                @endif
                                            </li>
                                            
                                            @if($response['knows_employee'] === 'yes')
                                                <li><span class="font-medium">Position:</span> {{ $response['position'] }}</li>
                                                <li><span class="font-medium">Status:</span> {{ ucfirst(str_replace('-', ' ', $response['employment_status'])) }}</li>
                                                <li><span class="font-medium">Length of Employment:</span> {{ ucfirst(str_replace('-', ' ', $response['employment_length'])) }}</li>
                                                <li><span class="font-medium">Recommendation:</span> 
                                                    @if($response['recommend'] === 'yes')
                                                        <span class="text-green-700">Recommended</span>
                                                    @elseif($response['recommend'] === 'no')
                                                        <span class="text-red-700">Not Recommended</span>
                                                    @else
                                                        <span class="text-yellow-700">Unsure</span>
                                                    @endif
                                                </li>
                                                
                                                @if(!empty($response['comments']))
                                                    <li class="mt-2">
                                                        <span class="font-medium">Additional Comments:</span>
                                                        <div class="mt-1 italic text-gray-600">{{ $response['comments'] }}</div>
                                                    </li>
                                                @endif
                                            @endif
                                        </ul>
                                    @else
                                        <div class="text-gray-600">Detailed verification results are not available.</div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="mt-2 ml-7 text-blue-600">
                                Awaiting employer response
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-gray-600 text-sm">
                        Click "Contact Employer" to send a verification request to the employer.
                    </div>
                @endif
            @endif
        </div>
    </div>
    @endif
    
    <!-- Other application details sections would continue here -->
</div>








                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Attached Images</h4>
                                <div class="flex space-x-4 overflow-x-auto">
                                    @foreach ($images as $index => $image)
                                        <img 
                                            src="{{ asset('storage/' . $image) }}" 
                                            class="w-32 h-32 object-cover rounded cursor-pointer border hover:shadow-lg" 
                                            wire:click="showImageModal({{ $index }})"
                                        />
                                    @endforeach
                                </div>
                            </div>



{{-- Modal --}}
                              
@if ($selectedImageIndex !== null)
    <div class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 p-4">
        <div class="relative w-full max-w-4xl h-[80vh] bg-white rounded-xl shadow-2xl overflow-hidden flex">
            {{-- Image Container --}}
            <div class="w-3/4 bg-gray-100 flex items-center justify-center relative">
                <img 
                    src="{{ asset('storage/' . $images[$selectedImageIndex]) }}" 
                    class="max-w-full max-h-full object-contain"
                    alt="Application Image {{ $selectedImageIndex + 1 }}"
                />
                
                {{-- Navigation Buttons --}}
                <button 
                    wire:click="previousImage"
                    @if ($selectedImageIndex <= 0) disabled @endif
                    class="absolute left-4 top-1/2 -translate-y-1/2 
                        bg-white/50 hover:bg-white/70 rounded-full p-2 
                        disabled:opacity-50 disabled:cursor-not-allowed 
                        transition-all duration-300 ease-in-out"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                
                <button 
                    wire:click="nextImage"
                    @if ($selectedImageIndex >= count($images) - 1) disabled @endif
                    class="absolute right-4 top-1/2 -translate-y-1/2 
                        bg-white/50 hover:bg-white/70 rounded-full p-2 
                        disabled:opacity-50 disabled:cursor-not-allowed 
                        transition-all duration-300 ease-in-out"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            {{-- Image Details Sidebar --}}
            <div class="w-1/4 bg-white p-6 overflow-y-auto border-l border-gray-200">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Image Details</h3>
                    <button 
                        wire:click="closeImageModal" 
                        class="text-gray-500 hover:text-gray-700 focus:outline-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <span class="text-xs text-gray-500 block mb-1">Image</span>
                        <span class="text-sm font-medium text-gray-700">
                            {{ $selectedImageIndex + 1 }} of {{ count($images) }}
                        </span>
                    </div>
                    
                    @php
                        $imagePath = $images[$selectedImageIndex];
                        $imageInfo = pathinfo($imagePath);
                        $fileSize = filesize(storage_path('app/public/' . $imagePath));
                    @endphp
                    
                    <div>
                        <span class="text-xs text-gray-500 block mb-1">Filename</span>
                        <span class="text-sm font-medium text-gray-700 truncate block">
                            {{ $imageInfo['basename'] }}
                        </span>
                    </div>
                    
                    <div>
                        <span class="text-xs text-gray-500 block mb-1">File Type</span>
                        <span class="text-sm font-medium text-gray-700">
                            {{ strtoupper($imageInfo['extension']) }}
                        </span>
                    </div>
                    
                    <div>
                        <span class="text-xs text-gray-500 block mb-1">File Size</span>
                        <span class="text-sm font-medium text-gray-700">
                            {{ number_format($fileSize / 1024, 2) }} KB
                        </span>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <button 
                            wire:click="downloadImage('{{ $imagePath }}')"
                            class="w-full flex items-center justify-center space-x-2 
                                   bg-green-500 text-white py-2 rounded-md 
                                   hover:bg-green-600 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>Download Image</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



        
                            
                            <div>
                                <livewire:application-summary.assessment />
                            </div>


                        </div>


                    </div>

                @else


                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm h-full flex items-center justify-center">
                        <div class="text-center p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No application selected</h3>
                            <p class="mt-1 text-sm text-gray-500">Select an application from the list to view details.</p>
                        </div>
                    </div>

                @endif
            </div>


        </div>
    </div>

    <!-- Full Application Details Modal -->
    @if($isModalOpen && $selectedApplication)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeApplicationModal"></div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full">
                <div class="bg-green-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">Full Application Details</h3>
                    <button wire:click="closeApplicationModal" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="max-h-[70vh] overflow-y-auto p-6">
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Application Status -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex justify-between items-center">
                                <h4 class="text-sm font-semibold text-gray-700">Application Status</h4>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $selectedApplication->application_status === 'Approved' ? 'bg-green-100 text-green-800' : 
                                      ($selectedApplication->application_status === 'Rejected' ? 'bg-red-100 text-red-800' : 
                                      ($selectedApplication->application_status === 'In Review' ? 'bg-blue-100 text-blue-800' : 
                                       'bg-yellow-100 text-yellow-800')) }}">
                                    {{ $selectedApplication->application_status }}
                                </span>
                            </div>
                            @if($selectedApplication->application_status !== 'Pending')
                                <div class="mt-2 text-sm text-gray-500">
                                    Last updated: {{ \Carbon\Carbon::parse($selectedApplication->updated_at)->format('M d, Y H:i') }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- Personal Information -->
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                                <h4 class="text-sm font-semibold text-gray-700">Personal Information</h4>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">First Name</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->first_name }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Middle Name</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->middle_name ?: 'N/A' }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Last Name</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->last_name }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">National ID</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->national_id }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Phone Number</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->phone_number }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Email Address</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Address Information -->
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                                <h4 class="text-sm font-semibold text-gray-700">Address Information</h4>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Region</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->region }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">District</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->district }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Street</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->street }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Vehicle Information -->
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                                <h4 class="text-sm font-semibold text-gray-700">Vehicle Information</h4>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Make & Model</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->make_and_model }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Year of Manufacture</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->year_of_manufacture }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Color</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->color }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">VIN</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->vin }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Mileage</span>
                                        <span class="text-sm font-medium text-gray-900">{{ number_format($selectedApplication->mileage, 0) }} km</span>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Financial Information -->
                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                                <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                                    <h4 class="text-sm font-semibold text-gray-700">Financial Information</h4>
                                </div>
                                <div class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <span class="text-xs text-gray-500">Purchase Price</span>
                                            <div class="flex items-baseline">
                                                <span class="text-lg font-bold text-gray-900">TZS {{ number_format($selectedApplication->purchase_price, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <span class="text-xs text-gray-500">Down Payment</span>
                                            <div class="flex items-baseline">
                                                <span class="text-lg font-bold text-gray-900">TZS {{ number_format($selectedApplication->down_payment, 2) }}</span>
                                                <span class="ml-1 text-xs text-gray-500">({{ round(($selectedApplication->down_payment / $selectedApplication->purchase_price) * 100) }}%)</span>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <span class="text-xs text-gray-500">Loan Amount</span>
                                            <div class="flex items-baseline">
                                                <span class="text-lg font-bold text-gray-900">TZS {{ number_format($selectedApplication->purchase_price - $selectedApplication->down_payment, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 border-t border-gray-200 pt-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <h5 class="text-sm font-medium text-gray-700 mb-3">Loan Details</h5>
                                                <div class="space-y-3">
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Loan Term</span>
                                                        <span class="text-sm font-medium text-gray-900">48 months</span>
                                                    </div>
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Interest Rate</span>
                                                        <span class="text-sm font-medium text-gray-900">12.5% p.a.</span>
                                                    </div>
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Monthly Payment</span>
                                                        <span class="text-sm font-medium text-gray-900">TZS {{ number_format(calculateMonthlyPayment($selectedApplication->purchase_price - $selectedApplication->down_payment, 12.5, 48), 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Total Interest</span>
                                                        <span class="text-sm font-medium text-gray-900">TZS {{ number_format(calculateTotalInterest($selectedApplication->purchase_price - $selectedApplication->down_payment, 12.5, 48), 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <h5 class="text-sm font-medium text-gray-700 mb-3">Income Assessment</h5>
                                                <div class="space-y-3">
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Monthly Income</span>
                                                        <span class="text-sm font-medium text-gray-900">TZS {{ number_format($selectedApplication->monthly_income ?? 3500000, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Other Debts</span>
                                                        <span class="text-sm font-medium text-gray-900">TZS {{ number_format($selectedApplication->other_debt_payments ?? 500000, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Debt-to-Income Ratio</span>
                                                        <span class="text-sm font-medium
                                                            {{ (calculateDTI($selectedApplication)) < 40 ? 'text-green-600' : 
                                                            ((calculateDTI($selectedApplication)) < 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                                            {{ calculateDTI($selectedApplication) }}%
                                                        </span>
                                                    </div>
                                                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                                                        <span class="text-xs text-gray-500">Affordability Assessment</span>
                                                        <span class="text-sm font-medium
                                                            {{ (calculateDTI($selectedApplication)) < 40 ? 'text-green-600' : 
                                                            ((calculateDTI($selectedApplication)) < 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                                            {{ (calculateDTI($selectedApplication)) < 40 ? 'Good' : 
                                                            ((calculateDTI($selectedApplication)) < 50 ? 'Moderate' : 'Poor') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 border-t border-gray-200 pt-4">
                                        <h5 class="text-sm font-medium text-gray-700 mb-3">Payment Schedule</h5>
                                        <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                                            <div class="overflow-x-auto">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-100">
                                                        <tr>
                                                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment #</th>
                                                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Amount</th>
                                                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Principal</th>
                                                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interest</th>
                                                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remaining Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @php
                                                            $loanAmount = $selectedApplication->purchase_price - $selectedApplication->down_payment;
                                                            $interestRate = 12.5 / 100 / 12; // Monthly interest rate
                                                            $term = 48; // months
                                                            $monthlyPayment = calculateMonthlyPayment($loanAmount, 12.5, 48);
                                                            $balance = $loanAmount;
                                                            $today = new \DateTime();
                                                        @endphp

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @php
                                                                $interest = $balance * $interestRate;
                                                                $principal = $monthlyPayment - $interest;
                                                                $balance -= $principal;
                                                                $dueDate = (clone $today)->modify("+$i month");
                                                            @endphp
                                                            <tr>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $i }}</td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $dueDate->format('M d, Y') }}</td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">TZS {{ number_format($monthlyPayment, 2) }}</td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">TZS {{ number_format($principal, 2) }}</td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">TZS {{ number_format($interest, 2) }}</td>
                                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">TZS {{ number_format($balance > 0 ? $balance : 0, 2) }}</td>
                                                            </tr>
                                                        @endfor
                                                        <tr>
                                                            <td colspan="6" class="px-4 py-2 text-sm text-center text-gray-500">
                                                                <button type="button" class="text-green-600 hover:text-green-800 font-medium">
                                                                    Show Full Amortization Schedule
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 border-t border-gray-200 pt-4">
                                        <h5 class="text-sm font-medium text-gray-700 mb-3">Credit Information</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <span class="text-xs text-gray-500">Credit Score</span>
                                                <div class="mt-1">
                                                    <div class="relative pt-1">
                                                        <div class="flex mb-2 items-center justify-between">
                                                            <div>
                                                                <span class="text-xs font-semibold inline-block text-gray-900">
                                                                    {{ $selectedApplication->credit_score ?? 720 }}
                                                                </span>
                                                            </div>
                                                            <div class="text-right">
                                                                <span class="text-xs font-semibold inline-block
                                                                    {{ ($selectedApplication->credit_score ?? 720) >= 700 ? 'text-green-600' : 
                                                                    (($selectedApplication->credit_score ?? 720) >= 650 ? 'text-yellow-600' : 'text-red-600') }}">
                                                                    {{ ($selectedApplication->credit_score ?? 720) >= 700 ? 'Excellent' : 
                                                                    (($selectedApplication->credit_score ?? 720) >= 650 ? 'Good' : 
                                                                    (($selectedApplication->credit_score ?? 720) >= 600 ? 'Fair' : 'Poor')) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="overflow-hidden h-2 mb-1 text-xs flex rounded bg-gray-200">
                                                            <div style="width: {{ min(100, (($selectedApplication->credit_score ?? 720) / 850) * 100) }}%" 
                                                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center 
                                                                {{ ($selectedApplication->credit_score ?? 720) >= 700 ? 'bg-green-500' : 
                                                                (($selectedApplication->credit_score ?? 720) >= 650 ? 'bg-yellow-500' : 'bg-red-500') }}">
                                                            </div>
                                                        </div>
                                                        <div class="flex text-xs justify-between">
                                                            <span>300</span>
                                                            <span>850</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <span class="text-xs text-gray-500">Credit Utilization</span>
                                                <div class="mt-1">
                                                    <div class="relative pt-1">
                                                        <div class="flex mb-2 items-center justify-between">
                                                            <div>
                                                                <span class="text-xs font-semibold inline-block text-gray-900">
                                                                    {{ $selectedApplication->credit_utilization ?? 25 }}%
                                                                </span>
                                                            </div>
                                                            <div class="text-right">
                                                                <span class="text-xs font-semibold inline-block
                                                                    {{ ($selectedApplication->credit_utilization ?? 25) <= 30 ? 'text-green-600' : 
                                                                    (($selectedApplication->credit_utilization ?? 25) <= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                                                    {{ ($selectedApplication->credit_utilization ?? 25) <= 30 ? 'Good' : 
                                                                    (($selectedApplication->credit_utilization ?? 25) <= 50 ? 'Moderate' : 'High') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="overflow-hidden h-2 mb-1 text-xs flex rounded bg-gray-200">
                                                            <div style="width: {{ min(100, ($selectedApplication->credit_utilization ?? 25)) }}%" 
                                                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center 
                                                                {{ ($selectedApplication->credit_utilization ?? 25) <= 30 ? 'bg-green-500' : 
                                                                (($selectedApplication->credit_utilization ?? 25) <= 50 ? 'bg-yellow-500' : 'bg-red-500') }}">
                                                            </div>
                                                        </div>
                                                        <div class="flex text-xs justify-between">
                                                            <span>0%</span>
                                                            <span>100%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <span class="text-xs text-gray-500">Payment History</span>
                                                <div class="mt-2">
                                                    <div class="grid grid-cols-12 gap-1">
                                                        @for ($i = 0; $i < 12; $i++)
                                                            @php
                                                                $status = rand(1, 10) > 1 ? 'paid' : (rand(0, 1) ? 'late' : 'missed'); 
                                                            @endphp
                                                            <div class="h-4 rounded-sm {{ $status === 'paid' ? 'bg-green-500' : ($status === 'late' ? 'bg-yellow-500' : 'bg-red-500') }}"></div>
                                                        @endfor
                                                    </div>
                                                    <div class="mt-2 flex justify-between text-xs text-gray-500">
                                                        <span>Last 12 months</span>
                                                        <div class="flex items-center space-x-2">
                                                            <div class="flex items-center">
                                                                <div class="h-2 w-2 rounded-full bg-green-500 mr-1"></div>
                                                                <span>On-time</span>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <div class="h-2 w-2 rounded-full bg-yellow-500 mr-1"></div>
                                                                <span>Late</span>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <div class="h-2 w-2 rounded-full bg-red-500 mr-1"></div>
                                                                <span>Missed</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>














                        
                    </div>
                </div>

            </div>
            
            
        </div>
    </div>
    @endif




</div>  


