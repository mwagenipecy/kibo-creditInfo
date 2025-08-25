<div>
<div class="bg-gray-50 min-h-screen">
    <!-- Breadcrumb -->
    <div class="bg-green-600 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('import.duty.applications') }}" class="text-green-100 hover:text-white">My Applications</a>
                    </li>
                    <li>
                        <svg class="flex-shrink-0 h-5 w-5 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z"/>
                        </svg>
                    </li>
                    <li>
                        <span class="text-white font-medium">{{ $application->application_number }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Application Header -->
        <div class="bg-white shadow-sm rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $application->application_number }}</h1>
                        <p class="text-gray-600">{{ $application->vehicle_make }} {{ $application->vehicle_model }} {{ $application->vehicle_year }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $application->getStatusBadgeClass() }}">
                            {{ $application->getCurrentStepText() }}
                        </span>
                        <p class="text-sm text-gray-500 mt-1">Applied: {{ $application->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="px-6 py-4">
                <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                    <span>Progress</span>
                    <span>{{ $application->getProgressPercentage() }}% Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full transition-all duration-300" style="width: {{ $application->getProgressPercentage() }}%"></div>
                </div>
            </div>
        </div>

        <!-- Pending Actions -->
        @if(count($pendingActions) > 0)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold text-yellow-900 mb-2">Action Required</h3>
            @foreach($pendingActions as $action)
            <div class="flex items-start space-x-3 mb-3 last:mb-0">
                <div class="flex-shrink-0">
                    <div class="w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-900" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-yellow-900">{{ $action['title'] }}</h4>
                    <p class="text-yellow-800 text-sm">{{ $action['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Vehicle & Application Details -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Application Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Vehicle</label>
                            <p class="text-gray-900">{{ $application->vehicle_make }} {{ $application->vehicle_model }} {{ $application->vehicle_year }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">VIN</label>
                            <p class="text-gray-900 font-mono">{{ $application->vehicle_vin }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">CIF Value</label>
                            <p class="text-gray-900">${{ number_format($application->cif_value_usd, 2) }} (TZS {{ number_format($application->cif_value_tzs) }})</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Port of Entry</label>
                            <p class="text-gray-900">{{ $application->port_of_entry }}</p>
                        </div>
                        @if($application->expected_arrival_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Expected Arrival</label>
                            <p class="text-gray-900">{{ $application->expected_arrival_date->format('M d, Y') }}</p>
                        </div>
                        @endif
                        @if($application->total_duty_amount)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Total Duty Amount</label>
                            <p class="text-gray-900 font-semibold">TZS {{ number_format($application->total_duty_amount) }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- CF Quotations Section -->
                @if($application->status === 'CF_QUOTATION' || $application->status === 'CF_SELECTED' || $application->status === 'LENDER_REVIEW' || $application->status === 'APPROVED')
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">CF Company Quotations</h2>
                        @if($availableQuotations->count() > 0 && $application->status === 'CF_QUOTATION')
                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">
                            {{ $availableQuotations->count() }} Available
                        </span>
                        @endif
                    </div>

                    @if($availableQuotations->count() > 0 && $application->status === 'CF_QUOTATION')
                    <div class="space-y-4">
                        @foreach($availableQuotations as $quotation)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-300 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $quotation->cfCompany->company_name }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ $quotation->cfCompany->region }}, {{ $quotation->cfCompany->city }}</p>
                                    
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-500">Total Duties & Taxes:</span>
                                            <p class="font-semibold">TZS {{ number_format($quotation->total_duties_taxes) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Service Fees:</span>
                                            <p class="font-semibold">TZS {{ number_format($quotation->total_service_fees) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Grand Total:</span>
                                            <p class="font-semibold text-green-600">TZS {{ number_format($quotation->grand_total) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Clearance Time:</span>
                                            <p class="font-semibold">{{ $quotation->estimated_clearance_days }} days</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2 ml-4">
                                    <button wire:click="viewQuotation({{ $quotation->id }})" 
                                            class="px-3 py-2 text-sm border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                                        View Details
                                    </button>
                                    <button wire:click="selectQuotation({{ $quotation->id }})" 
                                            class="px-3 py-2 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                                        Select This
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @elseif($application->selectedCFCompany)
                    <div class="border border-green-200 bg-green-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-green-900">Selected: {{ $application->selectedCFCompany->company_name }}</h3>
                                <p class="text-green-800 text-sm">Total Amount: TZS {{ number_format($application->total_duty_amount) }}</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900">Waiting for Quotations</h3>
                        <p class="text-sm text-gray-500">CF companies are preparing quotations with TRA calculations</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Lender Offers Section -->
                @if($application->status === 'LENDER_REVIEW' || $application->status === 'APPROVED')
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Financing Offers</h2>
                        @if($availableOffers->count() > 0 && $application->status === 'LENDER_REVIEW')
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                            {{ $availableOffers->count() }} Available
                        </span>
                        @endif
                    </div>

                    @if($availableOffers->count() > 0 && $application->status === 'LENDER_REVIEW')
                    <div class="space-y-4">
                        @foreach($availableOffers as $offer)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h3 class="font-semibold text-gray-900">{{ $offer->lender->name }}</h3>
                                        @if($offer->priority_order === 1)
                                        <span class="ml-2 bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">
                                            First to Respond
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-500">Down Payment:</span>
                                            <p class="font-semibold">TZS {{ number_format($offer->down_payment_required) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Loan Amount:</span>
                                            <p class="font-semibold">TZS {{ number_format($offer->loan_amount) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Interest Rate:</span>
                                            <p class="font-semibold text-blue-600">{{ $offer->interest_rate_annual }}% p.a.</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Monthly Payment:</span>
                                            <p class="font-semibold">TZS {{ number_format($offer->monthly_installment) }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-2 text-sm text-gray-600">
                                        <span>Tenure: {{ $offer->loan_tenure_months }} months</span>
                                        <span class="mx-2">•</span>
                                        <span>Total Repayment: TZS {{ number_format($offer->total_repayment) }}</span>
                                        @if($offer->total_fees > 0)
                                        <span class="mx-2">•</span>
                                        <span>Fees: TZS {{ number_format($offer->total_fees) }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2 ml-4">
                                    <button wire:click="viewOffer({{ $offer->id }})" 
                                            class="px-3 py-2 text-sm border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                                        View Details
                                    </button>
                                    <button wire:click="acceptOffer({{ $offer->id }})" 
                                            class="px-3 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Accept Offer
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @elseif($application->selectedLender)
                    <div class="border border-green-200 bg-green-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-green-900">Financing Approved: {{ $application->selectedLender->name }}</h3>
                                <p class="text-green-800 text-sm">
                                    Loan: TZS {{ number_format($application->financing_amount) }} at {{ $application->interest_rate }}% for {{ $application->loan_tenure_months }} months
                                </p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900">Waiting for Lender Offers</h3>
                        <p class="text-sm text-gray-500">Lenders are reviewing your application and preparing offers</p>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Process Steps -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Process Steps</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">
                                ✓
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                                <p class="text-xs text-gray-500">{{ $application->created_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-8 h-8 {{ in_array($application->status, ['CF_QUOTATION', 'CF_SELECTED', 'LENDER_REVIEW', 'APPROVED','COMPLETED']) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }} rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">
                                {{ in_array($application->status, ['CF_QUOTATION', 'CF_SELECTED', 'LENDER_REVIEW', 'APPROVED','COMPLETED']) ? '✓' : '2' }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">CF Companies Review</p>
                                <p class="text-xs text-gray-500">
                                    @if($application->status === 'CF_QUOTATION')
                                        In Progress
                                    @elseif(in_array($application->status, ['CF_SELECTED', 'LENDER_REVIEW', 'APPROVED']))
                                        Completed
                                    @else
                                        Pending
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-8 h-8 {{ in_array($application->status, ['CF_SELECTED', 'LENDER_REVIEW', 'APPROVED']) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }} rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">
                                {{ in_array($application->status, ['CF_SELECTED', 'LENDER_REVIEW', 'APPROVED']) ? '✓' : '3' }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">CF Company Selected</p>
                                <p class="text-xs text-gray-500">
                                    @if($application->status === 'CF_QUOTATION')
                                        {{ $availableQuotations->count() }} quotations available
                                    @elseif(in_array($application->status, ['CF_SELECTED', 'LENDER_REVIEW', 'APPROVED']))
                                        {{ $application->selectedCFCompany->company_name ?? 'Selected' }}
                                    @else
                                        Pending
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-8 h-8 {{ in_array($application->status, ['LENDER_REVIEW', 'APPROVED']) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }} rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">
                                {{ $application->status === 'APPROVED' ? '✓' : '4' }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Lender Review</p>
                                <p class="text-xs text-gray-500">
                                    @if($application->status === 'LENDER_REVIEW')
                                        {{ $availableOffers->count() }} offers available
                                    @elseif($application->status === 'APPROVED')
                                        {{ $application->selectedLender->name ?? 'Approved' }}
                                    @else
                                        Pending
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-8 h-8 {{ $application->status === 'APPROVED' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }} rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">
                                {{ $application->status === 'APPROVED' ? '✓' : '5' }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Financing Approved</p>
                                <p class="text-xs text-gray-500">
                                    @if($application->status === 'APPROVED')
                                        {{ $application->approved_at->format('M d, Y') }}
                                    @else
                                        Pending
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center">
                         

                            <div class="w-8 h-8 {{ $application->status === 'COMPLETED' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }} rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">
                                {{ $application->status === 'COMPLETED' ? '✓' : '6' }}
                            </div>

                            
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Vehicle Clearance</p>
                                <p class="text-xs text-gray-500">
                                    @if($application->status === 'COMPLETED')
                                        {{ $application->approved_at->format('M d, Y') }}
                                    @else
                                        Pending
                                    @endif
                                </p>


                            </div>
                        </div>


                    </div>
                </div>

                <!-- Contact Information -->
                @if($application->selectedCFCompany || $application->selectedLender)
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    
                    @if($application->selectedCFCompany)
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-900">CF Company</h4>
                        <p class="text-sm text-gray-600">{{ $application->selectedCFCompany->company_name }}</p>
                        <p class="text-sm text-gray-600">{{ $application->selectedCFCompany->contact_person_name }}</p>
                        <p class="text-sm text-gray-600">{{ $application->selectedCFCompany->phone_number }}</p>
                        <p class="text-sm text-gray-600">{{ $application->selectedCFCompany->email }}</p>
                    </div>
                    @endif

                    @if($application->selectedLender)
                    <div>
                        <h4 class="font-medium text-gray-900">Lender</h4>
                        <p class="text-sm text-gray-600">{{ $application->selectedLender->name }}</p>
                        <p class="text-sm text-gray-600">{{ $application->selectedLender->contact_person_name }}</p>
                        <p class="text-sm text-gray-600">{{ $application->selectedLender->contact_person_phone }}</p>
                        <p class="text-sm text-gray-600">{{ $application->selectedLender->contact_person_email }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Documents -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Documents</h3>
                    <div class="space-y-2">
                        @if($application->bill_of_lading)
                        <a href="{{ Storage::url($application->bill_of_lading) }}" target="_blank" 
                           class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Bill of Lading
                        </a>
                        @endif
                        @if($application->commercial_invoice)
                        <a href="{{ Storage::url($application->commercial_invoice) }}" target="_blank" 
                           class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Commercial Invoice
                        </a>
                        @endif
                        @if($application->packing_list)
                        <a href="{{ Storage::url($application->packing_list) }}" target="_blank" 
                           class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Packing List
                        </a>
                        @endif
                        @if($application->certificate_of_origin)
                        <a href="{{ Storage::url($application->certificate_of_origin) }}" target="_blank" 
                           class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Certificate of Origin
                        </a>
                        @endif
                    </div>
                </div>

                
            </div>
        </div>

        <!-- Quotation Details Modal -->
        @if($showQuotationModal && $selectedQuotation)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Quotation Details</h3>
                    <button wire:click="closeQuotationModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="font-medium text-gray-900">{{ $selectedQuotation->cfCompany->company_name }}</h4>
                        <p class="text-sm text-gray-600">{{ $selectedQuotation->cfCompany->contact_person_name }}</p>
                        <p class="text-sm text-gray-600">TRA Reference: {{ $selectedQuotation->tra_reference_number }}</p>
                    </div>

                    <div class="border-t pt-4">
                        <h5 class="font-medium text-gray-900 mb-2">Duties & Taxes Breakdown</h5>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="flex justify-between">
                                <span>Import Duty:</span>
                                <span>TZS {{ number_format($selectedQuotation->import_duty) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>VAT (18%):</span>
                                <span>TZS {{ number_format($selectedQuotation->vat_amount) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Railway Development Levy:</span>
                                <span>TZS {{ number_format($selectedQuotation->railway_development_levy) }}</span>
                            </div>
                            @if($selectedQuotation->excise_duty > 0)
                            <div class="flex justify-between">
                                <span>Excise Duty:</span>
                                <span>TZS {{ number_format($selectedQuotation->excise_duty) }}</span>
                            </div>
                            @endif
                            @if($selectedQuotation->other_charges > 0)
                            <div class="flex justify-between">
                                <span>Other Charges:</span>
                                <span>TZS {{ number_format($selectedQuotation->other_charges) }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between font-semibold border-t pt-2 col-span-2">
                                <span>Total Duties & Taxes:</span>
                                <span>TZS {{ number_format($selectedQuotation->total_duties_taxes) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h5 class="font-medium text-gray-900 mb-2">Service Fees</h5>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="flex justify-between">
                                <span>Clearing Fee:</span>
                                <span>TZS {{ number_format($selectedQuotation->clearing_fee) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Forwarding Fee:</span>
                                <span>TZS {{ number_format($selectedQuotation->forwarding_fee) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Documentation Fee:</span>
                                <span>TZS {{ number_format($selectedQuotation->documentation_fee) }}</span>
                            </div>
                            @if($selectedQuotation->port_charges > 0)
                            <div class="flex justify-between">
                                <span>Port Charges:</span>
                                <span>TZS {{ number_format($selectedQuotation->port_charges) }}</span>
                            </div>
                            @endif
                            @if($selectedQuotation->transportation_fee > 0)
                            <div class="flex justify-between">
                                <span>Transportation:</span>
                                <span>TZS {{ number_format($selectedQuotation->transportation_fee) }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between font-semibold border-t pt-2 col-span-2">
                                <span>Total Service Fees:</span>
                                <span>TZS {{ number_format($selectedQuotation->total_service_fees) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Grand Total:</span>
                            <span class="text-green-600">TZS {{ number_format($selectedQuotation->grand_total) }}</span>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Estimated Clearance:</span>
                                <p class="font-medium">{{ $selectedQuotation->estimated_clearance_days }} days</p>
                            </div>
                            <div>
                                <span class="text-gray-500">Valid Until:</span>
                                <p class="font-medium">{{ $selectedQuotation->expires_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        @if($selectedQuotation->special_notes)
                        <div class="mt-4">
                            <span class="text-gray-500">Special Notes:</span>
                            <p class="text-sm mt-1">{{ $selectedQuotation->special_notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button wire:click="closeQuotationModal" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                        Close
                    </button>
                    @if($application->status === 'CF_QUOTATION')
                    <button wire:click="selectQuotation({{ $selectedQuotation->id }})" 
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Select This Quotation
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Offer Details Modal -->
        @if($showOfferModal && $selectedOffer)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Financing Offer Details</h3>
                    <button wire:click="closeOfferModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="font-medium text-gray-900">{{ $selectedOffer->lender->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $selectedOffer->lender->contact_person_name }}</p>
                        <p class="text-sm text-gray-600">Offer #{{ $selectedOffer->offer_number }}</p>
                    </div>

                    <div class="border-t pt-4">
                        <h5 class="font-medium text-gray-900 mb-2">Loan Details</h5>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="flex justify-between">
                                <span>Total Financing Amount:</span>
                                <span class="font-medium">TZS {{ number_format($selectedOffer->total_financing_amount) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Down Payment Required:</span>
                                <span class="font-medium">TZS {{ number_format($selectedOffer->down_payment_required) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Loan Amount:</span>
                                <span class="font-medium">TZS {{ number_format($selectedOffer->loan_amount) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Interest Rate:</span>
                                <span class="font-medium text-blue-600">{{ $selectedOffer->interest_rate_annual }}% per annum</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Loan Tenure:</span>
                                <span class="font-medium">{{ $selectedOffer->loan_tenure_months }} months</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Monthly Installment:</span>
                                <span class="font-medium">TZS {{ number_format($selectedOffer->monthly_installment) }}</span>
                            </div>
                            <div class="flex justify-between font-semibold border-t pt-2 col-span-2">
                                <span>Total Repayment:</span>
                                <span>TZS {{ number_format($selectedOffer->total_repayment) }}</span>
                            </div>
                        </div>
                    </div>

                    @if($selectedOffer->total_fees > 0)
                    <div class="border-t pt-4">
                        <h5 class="font-medium text-gray-900 mb-2">Fees & Charges</h5>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            @if($selectedOffer->processing_fee > 0)
                            <div class="flex justify-between">
                                <span>Processing Fee:</span>
                                <span>TZS {{ number_format($selectedOffer->processing_fee) }}</span>
                            </div>
                            @endif
                            @if($selectedOffer->insurance_fee > 0)
                            <div class="flex justify-between">
                                <span>Insurance Fee:</span>
                                <span>TZS {{ number_format($selectedOffer->insurance_fee) }}</span>
                            </div>
                            @endif
                            @if($selectedOffer->legal_fee > 0)
                            <div class="flex justify-between">
                                <span>Legal Fee:</span>
                                <span>TZS {{ number_format($selectedOffer->legal_fee) }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between font-semibold border-t pt-2 col-span-2">
                                <span>Total Fees:</span>
                                <span>TZS {{ number_format($selectedOffer->total_fees) }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="border-t pt-4">
                        <h5 class="font-medium text-gray-900 mb-2">Requirements</h5>
                        <div class="text-sm space-y-2">
                            @if($selectedOffer->employment_type_required)
                            <div>
                                <span class="text-gray-500">Employment Type:</span>
                                <span class="ml-2">{{ $selectedOffer->employment_type_required }}</span>
                            </div>
                            @endif
                            @if($selectedOffer->minimum_income_required)
                            <div>
                                <span class="text-gray-500">Minimum Income:</span>
                                <span class="ml-2">TZS {{ number_format($selectedOffer->minimum_income_required) }}</span>
                            </div>
                            @endif
                            @if($selectedOffer->guarantor_required)
                            <div>
                                <span class="text-gray-500">Guarantor:</span>
                                <span class="ml-2">Required</span>
                            </div>
                            @endif
                            @if($selectedOffer->collateral_required)
                            <div>
                                <span class="text-gray-500">Collateral:</span>
                                <span class="ml-2">{{ $selectedOffer->collateral_required }}</span>
                            </div>
                            @endif
                            @if($selectedOffer->additional_requirements)
                            <div>
                                <span class="text-gray-500">Additional Requirements:</span>
                                <p class="mt-1 text-sm">{{ $selectedOffer->additional_requirements }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($selectedOffer->conditions)
                    <div class="border-t pt-4">
                        <h5 class="font-medium text-gray-900 mb-2">Terms & Conditions</h5>
                        <p class="text-sm text-gray-600">{{ $selectedOffer->conditions }}</p>
                    </div>
                    @endif

                    <div class="border-t pt-4">
                        <div class="text-sm text-gray-600">
                            <span>Valid until: {{ $selectedOffer->expires_at->format('M d, Y g:i A') }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button wire:click="closeOfferModal" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                        Close
                    </button>
                    @if($application->status === 'LENDER_REVIEW')
                    <button wire:click="rejectOffer({{ $selectedOffer->id }})" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Reject Offer
                    </button>
                    <button wire:click="acceptOffer({{ $selectedOffer->id }})" 
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Accept Offer
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

</div>
