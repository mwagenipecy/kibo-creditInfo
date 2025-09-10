<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-green-600 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-white">Import Duty Financing</h1>
                    <p class="text-green-100">{{ $lender->name }} - License: {{ $lender->financial_license_number ?? 'N/A' }}</p>
                </div>
                <div class="text-white text-right">
                    <p class="text-sm text-green-100">Welcome back!</p>
                    <p class="font-medium">{{ $lender->contact_person_name }}</p>
                </div>
            </div>
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">New Requests</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['new_requests'] }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">My Offers</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['my_offers'] }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Accepted</div>
                        <div class="text-2xl font-bold text-green-600">{{ $stats['accepted'] }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Rejected</div>
                        <div class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Portfolio Value</div>
                        <div class="text-lg font-bold text-green-600">TZS {{ number_format($stats['total_value']) }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Expiring Soon</div>
                        <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending_expiry'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6">
                    <button wire:click="switchTab('import-duty-requests')" 
                            class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'import-duty-requests' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        New Requests
                        @if($stats['new_requests'] > 0)
                        <span class="ml-2 bg-green-100 text-green-600 rounded-full px-2 py-1 text-xs font-bold">{{ $stats['new_requests'] }}</span>
                        @endif
                    </button>
                    <button wire:click="switchTab('my-offers')" 
                            class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'my-offers' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        My Offers
                        @if($stats['my_offers'] > 0)
                        <span class="ml-2 bg-purple-100 text-purple-600 rounded-full px-2 py-1 text-xs font-bold">{{ $stats['my_offers'] }}</span>
                        @endif
                    </button>
                    <button wire:click="switchTab('accepted')" 
                            class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'accepted' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Accepted
                        @if($stats['accepted'] > 0)
                        <span class="ml-2 bg-green-100 text-green-600 rounded-full px-2 py-1 text-xs font-bold">{{ $stats['accepted'] }}</span>
                        @endif
                    </button>
                    <button wire:click="switchTab('rejected')" 
                            class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'rejected' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Rejected
                        @if($stats['rejected'] > 0)
                        <span class="ml-2 bg-red-100 text-red-600 rounded-full px-2 py-1 text-xs font-bold">{{ $stats['rejected'] }}</span>
                        @endif
                    </button>
                </nav>
            </div>

            <!-- Filters -->
            <div class="px-6 py-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" wire:model.debounce.300ms="searchTerm" 
                                   placeholder="Search applications..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-green-500 focus:border-green-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <select wire:model="statusFilter" 
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md">
                            <option value="">All Statuses</option>
                            <option value="CF_SELECTED">CF Selected</option>
                            <option value="LENDER_REVIEW">Lender Review</option>
                            <option value="APPROVED">Approved</option>
                            <option value="PROCESSING">Processing</option>
                            <option value="DUTY_PAID">Duty Paid</option>
                            <option value="COMPLETED">Completed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications List -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            @if($applications->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Application</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">My Offer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $application)
                        @php
                            $selectedQuotation = $application->cfQuotations->first();
                            $myOffer = $application->lenderFinancingOffers->first();
                        @endphp
                        <tr class="hover:bg-gray-50 {{ $application->application_type === 'WANT_TO_BUY' ? 'bg-blue-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <div class="text-sm font-medium text-gray-900">{{ $application->application_number }}</div>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $application->application_type === 'PURCHASED' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $application->application_type === 'PURCHASED' ? 'Already Bought' : 'Want to Buy' }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $application->applicant_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->created_at->format('M d, Y') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->vehicle_make }} {{ $application->vehicle_model }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->vehicle_year }} • {{ $application->vehicle_color }}</div>
                                    
                                    @if($application->application_type === 'PURCHASED' && $application->vehicle_vin)
                                        <div class="text-xs text-gray-400 font-mono">VIN: {{ substr($application->vehicle_vin, 0, 8) }}***</div>
                                    @elseif($application->application_type === 'WANT_TO_BUY')
                                        <div class="text-xs text-blue-600">
                                            <a href="{{ $application->car_listing_url }}" target="_blank" class="hover:underline">
                                                View Car Listing →
                                            </a>
                                        </div>
                                        @if($application->extracted_car_image)
                                            <div class="mt-1">
                                                <img src="{{ asset('storage/' . $application->extracted_car_image) }}" 
                                                     alt="Car Image" 
                                                     class="w-16 h-12 object-cover rounded border border-gray-200">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    @if($selectedQuotation)
                                    <div class="text-sm font-medium text-gray-900">TZS {{ number_format($selectedQuotation->grand_total) }}</div>
                                    <div class="text-sm text-gray-500">Duties & Fees</div>
                                    <div class="text-xs text-gray-500">{{ $selectedQuotation->estimated_clearance_days }} days clearance</div>
                                    @else
                                    <div class="text-sm text-gray-500">No quotation selected</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $application->getStatusBadgeClass() }}">
                                    {{ $application->getCurrentStepText() }}
                                </span>
                                @if($application->expected_arrival_date)
                                <div class="text-xs text-gray-500 mt-1">
                                    Arrival: {{ $application->expected_arrival_date->format('M d') }}
                                </div>
                                @endif
                                
                                <!-- Progress Bar -->
                                <div class="mt-2">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full transition-all duration-300" 
                                             style="width: {{ $application->getProgressPercentage() }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $application->getProgressPercentage() }}% Complete</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($myOffer)
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $myOffer->interest_rate_annual }}% APR</div>
                                    <div class="text-sm text-gray-500">TZS {{ number_format($myOffer->monthly_installment) }}/month</div>
                                    <div class="text-sm text-gray-500">{{ $myOffer->loan_tenure_months }} months</div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($myOffer->status === 'ACCEPTED') bg-green-100 text-green-800
                                        @elseif($myOffer->status === 'REJECTED') bg-red-100 text-red-800
                                        @elseif($myOffer->status === 'EXPIRED') bg-gray-100 text-gray-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $myOffer->status)) }}
                                    </span>
                                </div>
                                @else
                                <div class="text-sm text-gray-500">No offer submitted</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <!-- View Details Button -->
                                    <button wire:click="viewApplicationDetails({{ $application->id }})" 
                                            class="text-blue-600 hover:text-blue-900 font-medium">
                                        Details
                                    </button>
                                    
                                    @if($activeTab === 'import-duty-requests' && !$myOffer && $selectedQuotation)
                                        <button wire:click="openOfferModal({{ $application->id }})" 
                                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium">
                                            Submit Offer
                                        </button>
                                    @elseif($myOffer)
                                        <button wire:click="viewOffer({{ $myOffer->id }})" 
                                                class="text-green-600 hover:text-green-900 font-medium">
                                            View Offer
                                        </button>
                                        @if($myOffer->status === 'SUBMITTED')
                                            <button wire:click="editOffer({{ $myOffer->id }})" 
                                                    class="text-blue-600 hover:text-blue-900 font-medium">
                                                Edit
                                            </button>
                                        @endif
                                        @if($myOffer->status === 'ACCEPTED' && in_array($application->status, ['DUTY_PAID', 'PROCESSING']))
                                            <button wire:click="openCompletedModal({{ $application->id }})" 
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-medium">
                                                Mark Complete
                                            </button>
                                        @endif
                                    @else
                                        <span class="text-gray-400">No actions</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $applications->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No applications found</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if($activeTab === 'import-duty-requests')
                        No new financing requests available.
                    @elseif($activeTab === 'my-offers')
                        You haven't submitted any offers yet.
                    @elseif($activeTab === 'accepted')
                        No accepted offers.
                    @else
                        No rejected offers.
                    @endif
                </p>
            </div>
            @endif
        </div>
    </div>

    <!-- Financing Offer Modal -->
    @if($showOfferModal && $selectedApplication)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $isEditing ? 'Edit Financing Offer' : 'Submit Financing Offer' }}
                    </h3>
                    <button wire:click="closeOfferModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- In-modal Flash Messages -->
                @if (session()->has('success'))
                    <div class="mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="mt-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Application Details -->
                <div class="bg-gray-50 p-4 rounded-lg mt-4">
                    <h4 class="font-medium text-gray-900 mb-2">Application Summary</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Application:</span>
                            <span class="font-medium ml-2">{{ $selectedApplication->application_number }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Applicant:</span>
                            <span class="font-medium ml-2">{{ $selectedApplication->applicant_name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Vehicle:</span>
                            <span class="font-medium ml-2">{{ $selectedApplication->vehicle_make }} {{ $selectedApplication->vehicle_model }} ({{ $selectedApplication->vehicle_year }})</span>
                        </div>
                        @if($selectedApplication->cfQuotations->first())
                        <div>
                            <span class="text-gray-500">Total Amount:</span>
                            <span class="font-medium ml-2">TZS {{ number_format($selectedApplication->cfQuotations->first()->grand_total) }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Error Summary -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Required Fields Notice -->
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mt-6">
                    <div class="flex">
                        <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 8a1 1 0 112 0v4a1 1 0 11-2 0V8zm1-5a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-sm text-blue-900 font-medium">Required fields</p>
                            <p class="text-sm text-blue-800 mt-1">Please fill the following fields to submit an offer: <span class="font-medium">Down Payment</span>, <span class="font-medium">Annual Interest Rate</span>, <span class="font-medium">Loan Tenure</span>, and <span class="font-medium">Offer Validity</span>. All other fields are optional.</p>
                        </div>
                    </div>
                </div>

                <!-- Financing Offer Form -->
                <form wire:submit.prevent="submitOffer" class="mt-6">
                    <div class="space-y-6">
                        <!-- Loan Terms Section -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Loan Terms</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Down Payment Required (TZS) *</label>
                                    <input type="number" step="0.01" wire:model="down_payment_required" 
                                           class="mt-1 block w-full border @error('down_payment_required') border-red-300 @else border-gray-300 @enderror rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="0.00">
                                    @error('down_payment_required') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Annual Interest Rate (%) *</label>
                                    <input type="number" step="0.01" min="0" max="50" wire:model="interest_rate_annual" 
                                           class="mt-1 block w-full border @error('interest_rate_annual') border-red-300 @else border-gray-300 @enderror rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="18.0">
                                    @error('interest_rate_annual') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Loan Tenure (Months) *</label>
                                    <select wire:model="loan_tenure_months" 
                                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                        <option value="12">12 months</option>
                                        <option value="18">18 months</option>
                                        <option value="24">24 months</option>
                                        <option value="36">36 months</option>
                                        <option value="48">48 months</option>
                                        <option value="60">60 months</option>
                                        <option value="72">72 months</option>
                                        <option value="84">84 months</option>
                                    </select>
                                    @error('loan_tenure_months') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Offer Validity (Hours) *</label>
                                    <select wire:model="validity_hours" 
                                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                        <option value="24">24 hours</option>
                                        <option value="48">48 hours</option>
                                        <option value="72">72 hours</option>
                                        <option value="96">96 hours</option>
                                        <option value="168">7 days</option>
                                    </select>
                                    @error('validity_hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Fees Section -->
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Additional Fees (TZS) <span class="text-sm text-gray-500 font-normal">(Optional)</span></h4>
                            <p class="text-sm text-gray-600 mb-4">Specify any additional fees that will be charged to the borrower.</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Processing Fee</label>
                                    <input type="number" step="0.01" min="0" wire:model="processing_fee" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="0.00">
                                    @error('processing_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Insurance Fee</label>
                                    <input type="number" step="0.01" min="0" wire:model="insurance_fee" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="0.00">
                                    @error('insurance_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Legal Fee</label>
                                    <input type="number" step="0.01" min="0" wire:model="legal_fee" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="0.00">
                                    @error('legal_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Other Fees</label>
                                    <input type="number" step="0.01" min="0" wire:model="other_fees" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="0.00">
                                    @error('other_fees') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Requirements Section -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Eligibility Requirements <span class="text-sm text-gray-500 font-normal">(Optional)</span></h4>
                            <p class="text-sm text-gray-600 mb-4">Specify any eligibility requirements for this financing offer.</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Minimum Monthly Income (TZS)</label>
                                    <input type="number" step="0.01" min="0" wire:model="minimum_income_required" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="0.00">
                                    @error('minimum_income_required') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Employment Type Required</label>
                                    <select wire:model="employment_type_required" 
                                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                        <option value="">Select employment type (optional)</option>
                                        <option value="Formal Employment">Formal Employment</option>
                                        <option value="Self Employed">Self Employed</option>
                                        <option value="Business Owner">Business Owner</option>
                                        <option value="Any">Any Employment Type</option>
                                    </select>
                                    @error('employment_type_required') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Collateral Required</label>
                                    <input type="text" wire:model="collateral_required" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                           placeholder="Describe any collateral requirements (optional)">
                                    @error('collateral_required') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="guarantor_required" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700">Guarantor Required</span>
                                    </label>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Additional Requirements</label>
                                    <textarea wire:model="additional_requirements" rows="3" 
                                              class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                              placeholder="Any additional eligibility requirements (optional)..."></textarea>
                                    @error('additional_requirements') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Terms and Conditions <span class="text-sm text-gray-500 font-normal">(Optional)</span></h4>
                            <p class="text-sm text-gray-600 mb-4">Add any special terms or conditions for this financing offer.</p>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Special Conditions</label>
                                <textarea wire:model="conditions" rows="3" 
                                          class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                          placeholder="Any special terms or conditions for this offer (optional)..."></textarea>
                                @error('conditions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Loan Summary -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Loan Summary</h4>
                            <div class="space-y-2 text-sm">
                                @if($selectedApplication && $selectedApplication->cfQuotations->first())
                                <div class="flex justify-between">
                                    <span>Total Financing Amount:</span>
                                    <span class="font-medium">TZS {{ number_format($selectedApplication->cfQuotations->first()->grand_total) }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between">
                                    <span>Down Payment:</span>
                                    <span class="font-medium">TZS {{ number_format($down_payment_required ?? 0) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Loan Amount:</span>
                                    <span class="font-medium">TZS {{ number_format($loan_amount ?? 0) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Monthly Installment:</span>
                                    <span class="font-medium">TZS {{ number_format($monthly_installment ?? 0) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Fees:</span>
                                    <span class="font-medium">TZS {{ number_format($total_fees ?? 0) }}</span>
                                </div>
                                <div class="flex justify-between border-t pt-2 text-lg font-bold">
                                    <span>Total Repayment:</span>
                                    <span class="text-green-600">TZS {{ number_format($total_repayment ?? 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
                        <button type="button" wire:click="closeOfferModal" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                wire:loading.attr="disabled">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled"
                                wire:target="submitOffer">
                            <span wire:loading.remove wire:target="submitOffer">
                                {{ $isEditing ? 'Update Offer' : 'Submit Offer' }}
                            </span>
                            <span wire:loading wire:target="submitOffer" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ $isEditing ? 'Updating...' : 'Submitting...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- View Offer Modal -->
    @if($showViewModal && $viewingOffer)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Financing Offer Details</h3>
                    <button wire:click="closeViewModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Offer Details -->
                <div class="mt-4 space-y-6">
                    <!-- Basic Info -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Offer Information</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Offer Number:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->offer_number }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span class="ml-2 inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $viewingOffer->getStatusBadgeClass() }}">
                                    {{ $viewingOffer->status_text }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Submitted:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->submitted_at ? $viewingOffer->submitted_at->format('M d, Y H:i') : 'Not submitted' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Expires:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->expires_at ? $viewingOffer->expires_at->format('M d, Y H:i') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Loan Terms -->
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Loan Terms</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Down Payment:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->down_payment_required) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Loan Amount:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->loan_amount) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Interest Rate:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->interest_rate_annual }}% per annum</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Tenure:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->loan_tenure_months }} months</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Monthly Payment:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->monthly_installment) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Total Repayment:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->total_repayment) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Fees -->
                    @if($viewingOffer->total_fees > 0)
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Additional Fees</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            @if($viewingOffer->processing_fee > 0)
                            <div>
                                <span class="text-gray-500">Processing Fee:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->processing_fee) }}</span>
                            </div>
                            @endif
                            @if($viewingOffer->insurance_fee > 0)
                            <div>
                                <span class="text-gray-500">Insurance Fee:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->insurance_fee) }}</span>
                            </div>
                            @endif
                            @if($viewingOffer->legal_fee > 0)
                            <div>
                                <span class="text-gray-500">Legal Fee:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->legal_fee) }}</span>
                            </div>
                            @endif
                            @if($viewingOffer->other_fees > 0)
                            <div>
                                <span class="text-gray-500">Other Fees:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->other_fees) }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="border-t mt-3 pt-3">
                            <div class="flex justify-between font-medium">
                                <span>Total Fees:</span>
                                <span>TZS {{ number_format($viewingOffer->total_fees) }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Requirements -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Eligibility Requirements</h4>
                        <div class="space-y-2 text-sm">
                            @if($viewingOffer->minimum_income_required)
                            <div>
                                <span class="text-gray-500">Minimum Income:</span>
                                <span class="font-medium ml-2">TZS {{ number_format($viewingOffer->minimum_income_required) }} per month</span>
                            </div>
                            @endif
                            <div>
                                <span class="text-gray-500">Employment Type:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->employment_type_required }}</span>
                            </div>
                            @if($viewingOffer->collateral_required)
                            <div>
                                <span class="text-gray-500">Collateral:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->collateral_required }}</span>
                            </div>
                            @endif
                            <div>
                                <span class="text-gray-500">Guarantor Required:</span>
                                <span class="font-medium ml-2">{{ $viewingOffer->guarantor_required ? 'Yes' : 'No' }}</span>
                            </div>
                            @if($viewingOffer->additional_requirements)
                            <div>
                                <span class="text-gray-500">Additional Requirements:</span>
                                <div class="mt-1 text-gray-700">{{ $viewingOffer->additional_requirements }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    

                    <!-- Conditions -->
                    @if($viewingOffer->conditions)
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Special Conditions</h4>
                        <p class="text-sm text-gray-700">{{ $viewingOffer->conditions }}</p>
                    </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end pt-6 border-t mt-6">
                    <button wire:click="closeViewModal" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Mark as Completed Modal -->
    @if($showCompletedModal && $completedApplication)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Mark as Completed</h3>
                    <button wire:click="closeCompletedModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Application Info -->
                <div class="mt-4">
                    <div class="bg-gray-50 p-3 rounded-lg mb-4">
                        <p class="text-sm font-medium text-gray-900">{{ $completedApplication->application_number }}</p>
                        <p class="text-sm text-gray-600">{{ $completedApplication->applicant_name }}</p>
                    </div>

                    <form wire:submit.prevent="markAsCompleted">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Completion Notes *</label>
                            <textarea wire:model="completion_notes" rows="4" 
                                      class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                      placeholder="Provide details about the completion of this application..."></textarea>
                            @error('completion_notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
                            <button type="button" wire:click="closeCompletedModal" 
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Mark as Completed
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Application Details Modal -->
    @if($showDetailsModal && $detailsApplication)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Application Details</h3>
                        <p class="text-sm text-gray-500">{{ $detailsApplication->application_number }}</p>
                    </div>
                    <button wire:click="closeDetailsModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Application Content -->
                <div class="mt-6 space-y-6">
                    <!-- Application Type & Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Application Type</h4>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                {{ $detailsApplication->application_type === 'PURCHASED' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $detailsApplication->application_type === 'PURCHASED' ? 'Already Bought the Car' : 'Want to Buy a Car' }}
                            </span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Current Status</h4>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $detailsApplication->getStatusBadgeClass() }}">
                                {{ $detailsApplication->getCurrentStepText() }}
                            </span>
                        </div>
                    </div>

                    <!-- Applicant Information -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-3">Applicant Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div><span class="font-medium">Name:</span> {{ $detailsApplication->applicant_name }}</div>
                            <div><span class="font-medium">Email:</span> {{ $detailsApplication->email }}</div>
                            <div><span class="font-medium">Phone:</span> {{ $detailsApplication->phone_number }}</div>
                            <div><span class="font-medium">National ID:</span> {{ $detailsApplication->national_id }}</div>
                            <div class="md:col-span-2"><span class="font-medium">Address:</span> {{ $detailsApplication->address }}</div>
                        </div>
                    </div>

                    <!-- Vehicle Information -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-3">Vehicle Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div><span class="font-medium">Make:</span> {{ $detailsApplication->vehicle_make }}</div>
                            <div><span class="font-medium">Model:</span> {{ $detailsApplication->vehicle_model }}</div>
                            <div><span class="font-medium">Year:</span> {{ $detailsApplication->vehicle_year }}</div>
                            <div><span class="font-medium">Color:</span> {{ $detailsApplication->vehicle_color }}</div>
                            @if($detailsApplication->vehicle_vin)
                                <div><span class="font-medium">VIN:</span> {{ $detailsApplication->vehicle_vin }}</div>
                            @endif
                            @if($detailsApplication->vehicle_mileage)
                                <div><span class="font-medium">Mileage:</span> {{ $detailsApplication->vehicle_mileage }} km</div>
                            @endif
                            @if($detailsApplication->vehicle_engine_size)
                                <div><span class="font-medium">Engine:</span> {{ $detailsApplication->vehicle_engine_size }}</div>
                            @endif
                        </div>
                        
                        <!-- Car URL and Image for WANT_TO_BUY applications -->
                        @if($detailsApplication->application_type === 'WANT_TO_BUY')
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h5 class="font-medium text-gray-900 mb-2">Car Listing Information</h5>
                                <div class="space-y-3">
                                    @if($detailsApplication->car_listing_url)
                                        <div>
                                            <span class="font-medium text-sm">Listing URL:</span>
                                            <a href="{{ $detailsApplication->car_listing_url }}" target="_blank" 
                                               class="text-blue-600 hover:text-blue-800 text-sm ml-2">
                                                View Car Listing →
                                            </a>
                                        </div>
                                    @endif
                                    
                                    @if($detailsApplication->extracted_car_image)
                                        <div>
                                            <span class="font-medium text-sm">Car Image:</span>
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $detailsApplication->extracted_car_image) }}" 
                                                     alt="Car Image" 
                                                     class="w-32 h-24 object-cover rounded border border-gray-200">
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($detailsApplication->extracted_car_details && !empty($detailsApplication->extracted_car_details))
                                        <div>
                                            <span class="font-medium text-sm">Extracted Details:</span>
                                            <div class="mt-2 grid grid-cols-2 gap-2 text-xs">
                                                @foreach($detailsApplication->extracted_car_details as $key => $value)
                                                    @if($value)
                                                        <div>
                                                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                            <span class="text-gray-600">{{ $value }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Financial Information -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-3">Financial Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div><span class="font-medium">CIF Value (USD):</span> ${{ number_format($detailsApplication->cif_value_usd, 2) }}</div>
                            <div><span class="font-medium">CIF Value (TZS):</span> TZS {{ number_format($detailsApplication->cif_value_tzs, 2) }}</div>
                            <div><span class="font-medium">Exchange Rate:</span> {{ $detailsApplication->currency_rate }}</div>
                            @if($detailsApplication->down_payment)
                                <div><span class="font-medium">Down Payment:</span> TZS {{ number_format($detailsApplication->down_payment) }}</div>
                            @endif
                            <div><span class="font-medium">Loan Tenure:</span> {{ $detailsApplication->loan_tenure_months }} months</div>
                        </div>
                    </div>

                    <!-- CF Quotation Information -->
                    @if($detailsApplication->cfQuotations->count() > 0)
                        @php $selectedQuotation = $detailsApplication->cfQuotations->first(); @endphp
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">CF Company Quotation</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div><span class="font-medium">CF Company:</span> {{ $selectedQuotation->cfCompany->name ?? 'N/A' }}</div>
                                <div><span class="font-medium">Total Amount:</span> TZS {{ number_format($selectedQuotation->grand_total) }}</div>
                                <div><span class="font-medium">Clearance Days:</span> {{ $selectedQuotation->estimated_clearance_days }} days</div>
                                <div><span class="font-medium">Status:</span> 
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $selectedQuotation->status === 'SELECTED' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($selectedQuotation->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Lender Offers -->
                    @if($detailsApplication->lenderFinancingOffers->count() > 0)
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">Lender Offers</h4>
                            <div class="space-y-3">
                                @foreach($detailsApplication->lenderFinancingOffers as $offer)
                                    <div class="border border-gray-200 rounded-lg p-3">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                            <div><span class="font-medium">Lender:</span> {{ $offer->lender->name ?? 'N/A' }}</div>
                                            <div><span class="font-medium">Interest Rate:</span> {{ $offer->interest_rate_annual }}% APR</div>
                                            <div><span class="font-medium">Monthly Payment:</span> TZS {{ number_format($offer->monthly_installment) }}</div>
                                            <div><span class="font-medium">Loan Amount:</span> TZS {{ number_format($offer->loan_amount) }}</div>
                                            <div><span class="font-medium">Tenure:</span> {{ $offer->loan_tenure_months }} months</div>
                                            <div><span class="font-medium">Status:</span> 
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                    @if($offer->status === 'ACCEPTED') bg-green-100 text-green-800
                                                    @elseif($offer->status === 'REJECTED') bg-red-100 text-red-800
                                                    @elseif($offer->status === 'EXPIRED') bg-gray-100 text-gray-800
                                                    @else bg-yellow-100 text-yellow-800 @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $offer->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
                    <button wire:click="closeDetailsModal" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Close
                    </button>
                    @if($activeTab === 'import-duty-requests' && !$detailsApplication->lenderFinancingOffers->where('lender_id', $lender->id)->first() && $detailsApplication->cfQuotations->count() > 0)
                        <button wire:click="openOfferModal({{ $detailsApplication->id }})" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Submit Offer
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Loading Overlay -->
    <div wire:loading class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700">Processing...</span>
        </div>
    </div>
</div>