<div>
<!-- resources/views/livewire/application-status.blade.php -->
<div class="bg-white w-full">
    <!-- Breadcrumb -->
    <div class="bg-green-600 py-4 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="" class="inline-flex items-center text-sm font-medium text-white hover:text-green-600">
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
                            <a href=" " class="ml-1 text-sm font-medium text-white hover:text-green-600 md:ml-2">My Loan Applications</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Application #{{ $application->id }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <!-- Status Header -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Application #{{ $application->id }}</h1>
                        <p class="text-gray-600">Submitted on {{ $application->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="inline-flex items-center px-4 py-2 rounded-lg
                            {{ $application->application_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                               ($application->application_status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($application->application_status === 'rejected' ? 'bg-red-100 text-red-800' : 
                               ($application->application_status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                               'bg-purple-100 text-purple-800'))) }}">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                @if($application->application_status === 'pending')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @elseif($application->application_status === 'approved')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @elseif($application->application_status === 'rejected')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                @endif
                            </svg>
                            <span class="font-medium">{{ ucfirst($application->application_status) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Application Progress</h2>

    <div class="relative">
        <div class="absolute left-6 top-0 h-full w-0.5 bg-gray-200"></div>

        <!-- Step 1: Application Submitted -->
        <div class="relative z-10 flex mb-8">
            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center border-4 border-white">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Application Submitted</h3>
                <p class="text-gray-600 mt-1">{{ $application->created_at->format('F d, Y \a\t h:i A') }}</p>
                <div class="mt-2 text-sm text-gray-700">
                    Your request to finance a {{ $application->make_and_model }} has been submitted.
                </div>
            </div>
        </div>

        <!-- Step 2: Car Dealer Approval -->
        <div class="relative z-10 flex mb-8">
            <div class="flex-shrink-0 h-12 w-12 rounded-full
                {{ $application->stage_name=="statement_verification" ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}
                flex items-center justify-center border-4 border-white">
                @if($application->stage_name=="statement_verification" )
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                @else
                    <span class="text-lg font-bold">2</span>
                @endif
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Car Dealer Approval</h3>
                @if($application->stage_name=="statement_verification")
                    <p class="text-gray-600 mt-1">Approved on {{ $application->updated_at->format('F d, Y') }}</p>
                    <div class="mt-2 text-sm text-green-700">
                        Your financing request has been approved by the dealer.
                    </div>
                @else
                    <p class="text-gray-600 mt-1">Pending</p>
                    <div class="mt-2 text-sm text-gray-700">
                        Awaiting confirmation from the vehicle dealer.
                    </div>
                @endif
            </div>
        </div>

        <!-- Step 3: Lender Review & Decision -->
        <div class="relative z-10 flex mb-8">
            <div class="flex-shrink-0 h-12 w-12 rounded-full
                {{ in_array($application->application_status, ['approved', 'rejected']) ? 
                    ($application->application_status == 'approved' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600') : 
                    'bg-gray-100 text-gray-600' }}
                flex items-center justify-center border-4 border-white">
                @if($application->application_status === 'approved')
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                @elseif($application->application_status === 'rejected')
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
                    </svg>
                @else
                    <span class="text-lg font-bold">3</span>
                @endif
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Lender Review & Statement Verifications </h3>
                @if($application->application_status === 'approved')
                    <p class="text-gray-600 mt-1">Approved on {{ $application->updated_at->format('F d, Y') }}</p>
                    <div class="mt-2 text-sm text-green-700">
                        Your loan was approved by {{ optional($application->lender)->name }}.
                    </div>
                @elseif($application->application_status === 'rejected')
                    <p class="text-gray-600 mt-1">Rejected on {{ $application->updated_at->format('F d, Y') }}</p>
                    <div class="mt-2 text-sm text-red-700">
                        Your loan was not approved. Contact {{ optional($application->lender)->name }} for details.
                    </div>
                @elseif($application->dealer_approved)
                    <p class="text-gray-600 mt-1">In Progress</p>
                    <div class="mt-2 text-sm text-blue-700">
                        Awaiting review by {{ optional($application->lender)->name }}.
                    </div>
                @else
                    <p class="text-gray-600 mt-1">Waiting</p>
                    <div class="mt-2 text-sm text-gray-700">
                        Review will begin after dealer approval.
                    </div>
                @endif
            </div>
        </div>

        <!-- Step 4: Loan Disbursement -->
        <div class="relative z-10 flex">
            <div class="flex-shrink-0 h-12 w-12 rounded-full
                {{ $application->application_status === 'approved' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}
                flex items-center justify-center border-4 border-white">
                @if($application->application_status === 'approved')
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                @else
                    <span class="text-lg font-bold">4</span>
                @endif
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Loan Disbursement</h3>
                @if($application->application_status === 'approved')
                    <p class="text-gray-600 mt-1">Next Step</p>
                    <div class="mt-2 text-sm text-gray-700">
                        Please proceed to {{ optional($application->lender)->name }} to sign and complete disbursement.
                        <a href="{{ route('loan.agreement', $application->id) }}" class="mt-2 block text-green-600 hover:text-green-800 font-medium">
                            View Loan Agreement
                        </a>
                    </div>
                @else
                    <p class="text-gray-600 mt-1">Pending</p>
                    <div class="mt-2 text-sm text-gray-700">
                        Disbursement is only available after lender approval.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


            
            <!-- Application Details -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Application Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Personal Information</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Full Name</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->first_name }} {{ $application->middle_name }} {{ $application->last_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Email</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->email }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Phone</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->phone_number }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">National ID</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->national_id }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Address</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->street }}, {{ $application->district }}, {{ $application->region }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Employment Information</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Employer</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->employer_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Monthly Income</div>
                                <div class="text-sm font-medium text-gray-900">TZS {{ number_format($application->monthly_income) }}</div>
                            </div>
                            @if($application->is_employee)
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Employee ID</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->employee_id }}</div>
                            </div>
                            @endif
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">HR Email</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->hrEmail }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Vehicle Information</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Vehicle</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->make_and_model }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Year</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->year_of_manufacture }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Color</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->color }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">VIN</div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->vin }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Mileage</div>
                                <div class="text-sm font-medium text-gray-900">{{ number_format($application->mileage) }} km</div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Loan Information</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Lender</div>
                                <div class="text-sm font-medium text-gray-900">{{ optional(optional($application->lender))->name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Purchase Price</div>
                                <div class="text-sm font-medium text-gray-900">TZS {{ number_format($application->purchase_price) }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Down Payment</div>
                                <div class="text-sm font-medium text-gray-900">TZS {{ number_format($application->down_payment) }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Loan Amount</div>
                                <div class="text-sm font-medium text-gray-900">TZS {{ number_format($application->loan_amount) }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Loan Term</div>
                                <div class="text-sm font-medium text-gray-900">{{ $loanProduct?->term }} months</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Interest Rate</div>
                                <div class="text-sm font-medium text-gray-900">{{ $loanProduct?->interest_rate }}%</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="text-sm text-gray-500">Monthly Payment</div>
                                <div class="text-sm font-medium text-gray-900">TZS {{ number_format($monthlyPayment) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Need Assistance?</h2>
                <p class="text-gray-600 mb-6">If you have any questions about your application, please contact the lender directly:</p>
                
                <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:{{ optional($application->lender)->phone }}" class="text-green-600 hover:text-green-800">{{ optional($application->lender)->phone }}</a>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:{{ optional($application->lender)->email }}" class="text-green-600 hover:text-green-800">{{ optional($application->lender)->email }}</a>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <a href="{{ optional($application->lender)->website }}" target="_blank" class="text-green-600 hover:text-green-800">{{ optional($application->lender)->website }}</a>
                    </div>
                </div>
                
                <div class="flex justify-center mt-8">
                    <a href="{{ route('application.list') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Back to Applications
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
