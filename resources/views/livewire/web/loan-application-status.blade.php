<div>
    <!-- resources/views/livewire/application-status.blade.php -->
    <div class="bg-white w-full">
        <!-- Breadcrumb -->
        <div class="bg-green-600 py-4 border-b border-gray-200">
            <div class="container mx-auto px-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href=""
                                class="inline-flex items-center text-sm font-medium text-white hover:text-green-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href=" "
                                    class="ml-1 text-sm font-medium text-white hover:text-green-600 md:ml-2">My Loan
                                    Applications</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-white md:ml-2">Application
                                    #{{ $application->id }}</span>
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
                            <p class="text-gray-600">Submitted on
                                {{ $application->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                           
                        
                        @php
    $status = $application->application_status;

    // Normalize NEW_CLIENT as 'processing' for display
    $displayStatus = $status === 'NEW_CLIENT' ? 'processing' : $status;

    // Define badge styles
    $statusClasses = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'approved' => 'bg-green-100 text-green-800',
        'ACCEPTED' => 'bg-green-100 text-green-800',
        'REJECTED' => 'bg-red-100 text-red-800',
        'processing' => 'bg-blue-100 text-blue-800',
    ];

    $class = $statusClasses[$displayStatus] ?? 'bg-purple-100 text-purple-800';
@endphp

<div class="inline-flex items-center px-4 py-2 rounded-lg {{ $class }}">
    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        @if ($displayStatus === 'pending')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        @elseif($displayStatus === 'approved' || $displayStatus === 'ACCEPTED')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        @elseif($displayStatus === 'rejected')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        @else
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        @endif
    </svg>

    <span class="font-medium">
        {{ $status === 'NEW CLIENT' ? 'Processing' : ucfirst(strtolower($status)) }}
    </span>
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
                            <div
                                class="flex-shrink-0 h-12 w-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center border-4 border-white">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Application Submitted</h3>
                                <p class="text-gray-600 mt-1">
                                    {{ $application->created_at->format('F d, Y \a\t h:i A') }}</p>
                                <div class="mt-2 text-sm text-gray-700">
                                    Your request to finance a {{ $application->make_and_model }} has been submitted.
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Car Dealer Approval -->

                        @if($application->application_status =="REJECTED")


                        <div class="relative ml-12 z-10 mx-4 flex flex-col mb-8">
                            <p class="text-gray-600 mt-1">
                                Rejected {{ $application->updated_at->format('F d, Y') }}
                            </p>

                            <div class="mt-2 text-sm text-red-700">
                                Your loan was not approved.
                            </div>
                        </div>



                        @else 
                        <div class="relative z-10 flex mb-8">
                            <div
                                class="flex-shrink-0 h-12 w-12 rounded-full
                {{ $application->stage_name == 'statement_verification' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}
                flex items-center justify-center border-4 border-white">
                                @if ($application->stage_name == 'statement_verification')
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4" />
                                    </svg>
                                @else
                                    <span class="text-lg font-bold">2</span>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Car Dealer Approval</h3>
                                @if ($application->stage_name == 'statement_verification')
                                    <p class="text-gray-600 mt-1">Approved on
                                        {{ $application->updated_at->format('F d, Y') }}</p>
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

                            <div
                                class="flex-shrink-0 h-12 w-12 rounded-full
                {{ in_array($application->application_status, ['approved', 'rejected', 'ACCEPTED'])
                    ? ($application->application_status == 'approved' || $application->application_status == 'ACCEPTED'
                        ? 'bg-green-100 text-green-600'
                        : 'bg-red-100 text-red-600')
                    : 'bg-gray-100 text-gray-600' }}
                flex items-center justify-center border-4 border-white">
                                @if ($application->application_status === 'approved')
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4" />
                                    </svg>
                                @elseif($application->application_status === 'rejected')
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
                                    </svg>
                                @elseif($application->application_status === 'ACCEPTED')
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @else
                                    <span class="text-lg font-bold">3</span>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Lender Review & Statement Verifications
                                </h3>
                                @if ($application->application_status === 'approved')
                                    <p class="text-gray-600 mt-1">Approved on
                                        {{ $application->updated_at->format('F d, Y') }}</p>
                                    <div class="mt-2 text-sm text-green-700">
                                        Your loan was approved by {{ optional($application->lender)->name }}.
                                    </div>
                                @elseif($application->application_status === 'rejected')
                                    <p class="text-gray-600 mt-1">Rejected on
                                        {{ $application->updated_at->format('F d, Y') }}</p>
                                    <div class="mt-2 text-sm text-red-700">
                                        Your loan was not approved. Contact {{ optional($application->lender)->name }}
                                        for details.
                                    </div>
                                @elseif($application->application_status === 'ACCEPTED')
                                    <p class="text-gray-600 mt-1">Rejected on
                                        {{ $application->updated_at->format('F d, Y') }}</p>
                                    <div class="mt-2 text-sm text-green-700">
                                        Your loan was approved by lender {{ optional($application->lender)->name }} for
                                        details.
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

                        @endif 
                        <!-- Step 4: Loan Disbursement -->
                        {{-- <div class="relative z-10 flex">
            <div class="flex-shrink-0 h-12 w-12 rounded-full
                {{ $application->application_status === 'approved' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}
                flex items-center justify-center border-4 border-white">
                @if ($application->application_status === 'approved')
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                @else
                    <span class="text-lg font-bold">4</span>
                @endif
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Loan Disbursement</h3>
                @if ($application->application_status === 'approved')
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
        </div> --}}


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
                                    <div class="text-sm font-medium text-gray-900">{{ $application->first_name }}
                                        {{ $application->middle_name }} {{ $application->last_name }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Email</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->email }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Phone</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->phone_number }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">National ID</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->national_id }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Address</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->street }},
                                        {{ $application->district }}, {{ $application->region }}</div>
                                </div>
                            </div>
                        </div>


                        @if($application->is_employee)

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Employment Information</h3>
                            <div class="space-y-3">
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Employer</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->employer_name }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Monthly Income</div>
                                    <div class="text-sm font-medium text-gray-900">TZS
                                        {{ number_format($application->monthly_income) }}</div>
                                </div>
                                @if ($application->is_employee)
                                    <div class="grid grid-cols-2">
                                        <div class="text-sm text-gray-500">Employee ID</div>
                                        <div class="text-sm font-medium text-gray-900">{{ $application->employee_id }}
                                        </div>
                                    </div>
                                @endif
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">HR Email</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->hrEmail }}</div>
                                </div>
                            </div>
                        </div>

                         @endif 
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Vehicle Information</h3>
                            <div class="space-y-3">
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Vehicle</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->make_and_model }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Year</div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $application->year_of_manufacture }}</div>
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
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($application->mileage) }} km</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Loan Information</h3>
                            <div class="space-y-3">
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Lender</div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ optional(optional($application->lender))->name }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Purchase Price</div>
                                    <div class="text-sm font-medium text-gray-900">TZS
                                        {{ number_format($application->purchase_price) }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Down Payment</div>
                                    <div class="text-sm font-medium text-gray-900">TZS
                                        {{ number_format($application->down_payment) }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Loan Amount</div>
                                    <div class="text-sm font-medium text-gray-900">TZS
                                        {{ number_format($application->loan_amount) }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Loan Term</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->tenure }} months
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Interest Rate</div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($interest_rate, 2) }}%
                                        <span class="text-xs text-orange-600 ml-1">(Approximate)</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-sm text-gray-500">Monthly Payment</div>
                                    <div class="text-sm font-medium text-gray-900">
                                        TZS {{ number_format($monthlyPayment) }}
                                        <span class="text-xs text-orange-600 ml-1">(Approximate)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Payment Breakdown -->
                @if($monthlyPayment > 0 && $application->tenure && $application->loan_amount && $interest_rate > 0)
                @php
                    $totalPayment = $monthlyPayment * $application->tenure;
                    $totalInterest = $totalPayment - $application->loan_amount;
                    $monthlyInterestRate = $interest_rate / 100 / 12;
                    $interestToPrincipalRatio = ($totalInterest / $application->loan_amount) * 100;
                @endphp
                
                <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl shadow-md p-6 mb-6 border border-blue-200">
                    <div class="flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">Payment Breakdown</h2>
                    </div>
                    
                    <!-- Payment Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                            <p class="text-sm text-gray-600 mb-1">Loan Term</p>
                            <p class="text-xl font-bold text-blue-600">{{ $application->tenure }} months</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                            <p class="text-sm text-gray-600 mb-1">Total Payment</p>
                            <p class="text-xl font-bold text-purple-600">TZS {{ number_format($totalPayment) }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                            <p class="text-sm text-gray-600 mb-1">Total Interest</p>
                            <p class="text-xl font-bold text-red-600">TZS {{ number_format($totalInterest) }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                            <p class="text-sm text-gray-600 mb-1">Interest Ratio</p>
                            <p class="text-xl font-bold text-orange-600">{{ number_format($interestToPrincipalRatio, 1) }}%</p>
                        </div>
                    </div>

                    <!-- Detailed Information -->
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <h5 class="font-semibold text-gray-800 mb-4">Detailed Calculations</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Principal Amount:</span>
                                    <span class="text-sm font-medium text-green-600">TZS {{ number_format($application->loan_amount) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Annual Interest Rate:</span>
                                    <span class="text-sm font-medium text-blue-600">{{ number_format($interest_rate, 2) }}%</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Monthly Interest Rate:</span>
                                    <span class="text-sm font-medium text-blue-600">{{ number_format($monthlyInterestRate * 100, 3) }}%</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Monthly Payment (EMI):</span>
                                    <span class="text-sm font-medium text-purple-600">TZS {{ number_format($monthlyPayment) }}</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Total Repayment:</span>
                                    <span class="text-sm font-medium">TZS {{ number_format($totalPayment) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Total Interest:</span>
                                    <span class="text-sm font-medium text-red-600">TZS {{ number_format($totalInterest) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Interest to Principal Ratio:</span>
                                    <span class="text-sm font-medium text-orange-600">{{ number_format($interestToPrincipalRatio, 1) }}%</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Down Payment:</span>
                                    <span class="text-sm font-medium text-gray-700">TZS {{ number_format($application->down_payment) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Schedule Preview -->
                    <div class="mt-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h6 class="font-medium text-gray-700 mb-3">Payment Summary</h6>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p><strong>Monthly Payment:</strong> TZS {{ number_format($monthlyPayment) }} for {{ $application->tenure }} months</p>
                            <p><strong>Total Amount to Pay:</strong> TZS {{ number_format($totalPayment) }}</p>
                            <p><strong>Interest Cost:</strong> TZS {{ number_format($totalInterest) }} ({{ number_format($interestToPrincipalRatio, 1) }}% of principal)</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Monthly Payment Schedule Preview -->
                @if($monthlyPayment > 0 && $application->tenure && $application->loan_amount && $interest_rate > 0)
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">Payment Schedule Preview</h2>
                    </div>
                    
                    <!-- Payment Timeline -->
                    <div class="space-y-4">
                        <!-- First Payment -->
                        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="font-medium text-gray-900">Month 1</p>
                                    <p class="text-sm text-gray-600">First payment due</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-600">TZS {{ number_format($monthlyPayment) }}</p>
                                <p class="text-xs text-gray-500">Monthly EMI</p>
                            </div>
                        </div>

                        <!-- Middle Payments -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-gray-400 rounded-full mr-3"></div>
                                <div>
                                    <p class="font-medium text-gray-900">Months 2-{{ $application->tenure - 1 }}</p>
                                    <p class="text-sm text-gray-600">Regular payments</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-600">TZS {{ number_format($monthlyPayment) }}</p>
                                <p class="text-xs text-gray-500">Monthly EMI</p>
                            </div>
                        </div>

                        <!-- Final Payment -->
                        <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="font-medium text-gray-900">Month {{ $application->tenure }}</p>
                                    <p class="text-sm text-gray-600">Final payment</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-blue-600">TZS {{ number_format($monthlyPayment) }}</p>
                                <p class="text-xs text-gray-500">Monthly EMI</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="mt-6 p-4 bg-gradient-to-r from-green-50 to-blue-50 border border-gray-200 rounded-lg">
                        <h6 class="font-semibold text-gray-800 mb-3">Payment Summary</h6>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div class="text-center">
                                <p class="text-gray-600">Monthly Payment</p>
                                <p class="font-bold text-lg text-green-600">TZS {{ number_format($monthlyPayment) }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-600">Payment Duration</p>
                                <p class="font-bold text-lg text-blue-600">{{ $application->tenure }} months</p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-600">Total Amount</p>
                                <p class="font-bold text-lg text-purple-600">TZS {{ number_format($monthlyPayment * $application->tenure) }}</p>
                            </div>
                        </div>
                        
                        <!-- Payment Progress Visualization -->
                        <div class="mt-4 p-4 bg-white border border-gray-200 rounded-lg">
                            <h6 class="font-medium text-gray-700 mb-3">Payment Breakdown Visualization</h6>
                            <div class="space-y-3">
                                <!-- Principal vs Interest -->
                                @php
                                    $principalPercentage = ($application->loan_amount / ($monthlyPayment * $application->tenure)) * 100;
                                    $interestPercentage = 100 - $principalPercentage;
                                @endphp
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Principal vs Interest</span>
                                        <span class="text-gray-500">{{ number_format($principalPercentage, 1) }}% / {{ number_format($interestPercentage, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="flex h-3 rounded-full overflow-hidden">
                                            <div class="bg-green-500" style="width: {{ $principalPercentage }}%"></div>
                                            <div class="bg-red-500" style="width: {{ $interestPercentage }}%"></div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>Principal: TZS {{ number_format($application->loan_amount) }}</span>
                                        <span>Interest: TZS {{ number_format($monthlyPayment * $application->tenure - $application->loan_amount) }}</span>
                                    </div>
                                </div>
                                
                                <!-- Payment Timeline Progress -->
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Payment Progress</span>
                                        <span class="text-gray-500">0 / {{ $application->tenure }} months</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Loan payments will begin after approval</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mt-0.5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm text-yellow-800 font-medium mb-1">Payment Information</p>
                                <ul class="text-xs text-yellow-700 space-y-1">
                                    <li>• Payments are due on the same date each month</li>
                                    <li>• Late payments may incur additional fees</li>
                                    <li>• Early payment may be possible with lender approval</li>
                                    <li>• Final terms will be confirmed upon loan approval</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Loan Information Disclaimer -->
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500 mt-0.5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <div>
                            <h4 class="font-medium text-orange-800 mb-1">Important Notice</h4>
                            <p class="text-sm text-orange-700">
                                The interest rate and monthly payment shown above are approximate estimates based on current financing criteria. 
                                Final rates and payments may vary based on credit approval, loan terms, and other factors. 
                                Please contact the lender for exact terms and conditions.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Need Assistance?</h2>
                    <p class="text-gray-600 mb-6">If you have any questions about your application, please contact the
                        lender directly:</p>

                    <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:{{ optional($application->lender)->phone }}"
                                class="text-green-600 hover:text-green-800">{{ optional($application->lender)->phone }}</a>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ optional($application->lender)->email }}"
                                class="text-green-600 hover:text-green-800">{{ optional($application->lender)->email }}</a>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <a href="{{ optional($application->lender)->website }}" target="_blank"
                                class="text-green-600 hover:text-green-800">{{ optional($application->lender)->website }}</a>
                        </div>
                    </div>

                    <div class="flex justify-center mt-8">
                        <a href="{{ route('application.list') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Back to Applications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
