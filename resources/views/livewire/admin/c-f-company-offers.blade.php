{{-- resources/views/livewire/cf-company-offers.blade.php --}}
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-green-600 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-white">Import Duty Applications</h1>
                    <p class="text-green-100">{{ $cfCompany->company_name }} - TRA License: {{ $cfCompany->tra_license_number }}</p>
                </div>
                <div class="text-white text-right">
                    <p class="text-sm text-green-100">Welcome back!</p>
                    <p class="font-medium">{{ $cfCompany->contact_person_name }}</p>
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
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">New Applications</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['new_applications'] }}</div>
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
                        <div class="text-sm text-gray-500">My Quotations</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['my_quotations'] }}</div>
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
                        <div class="text-sm text-gray-500">Total Value</div>
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
                    <button wire:click="switchTab('new-applications')" 
                            class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'new-applications' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        New Applications
                        @if($stats['new_applications'] > 0)
                        <span class="ml-2 bg-green-100 text-green-600 rounded-full px-2 py-1 text-xs font-bold">{{ $stats['new_applications'] }}</span>
                        @endif
                    </button>
                    <button wire:click="switchTab('my-quotations')" 
                            class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'my-quotations' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        My Quotations
                        @if($stats['my_quotations'] > 0)
                        <span class="ml-2 bg-purple-100 text-purple-600 rounded-full px-2 py-1 text-xs font-bold">{{ $stats['my_quotations'] }}</span>
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
                            <option value="SUBMITTED">Submitted</option>
                            <option value="CF_QUOTATION">CF Quotation</option>
                            <option value="CF_SELECTED">CF Selected</option>
                            <option value="LENDER_REVIEW">Lender Review</option>
                            <option value="APPROVED">Approved</option>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CIF Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">My Quotation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $application)
                        @php
                            $myQuotation = $application->cfQuotations->first();
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->application_number }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->applicant_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->created_at->format('M d, Y') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $application->vehicle_make }} {{ $application->vehicle_model }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->vehicle_year }} • {{ $application->vehicle_color }}</div>
                                    <div class="text-xs text-gray-400 font-mono">VIN: {{ substr($application->vehicle_vin, 0, 8) }}***</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">${{ number_format($application->cif_value_usd, 2) }}</div>
                                    <div class="text-sm text-gray-500">TZS {{ number_format($application->cif_value_tzs) }}</div>
                                    <div class="text-xs text-gray-500">{{ $application->port_of_entry }}</div>
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($myQuotation)
                                <div>
                                    <div class="text-sm font-medium text-gray-900">TZS {{ number_format($myQuotation->grand_total) }}</div>
                                    <div class="text-sm text-gray-500">{{ $myQuotation->estimated_clearance_days }} days</div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($myQuotation->status === 'SELECTED') bg-green-100 text-green-800
                                        @elseif($myQuotation->status === 'NOT_SELECTED') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $myQuotation->status)) }}
                                    </span>
                                </div>
                                @else
                                <div class="text-sm text-gray-500">No quotation</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($activeTab === 'new-applications' && !$myQuotation)
                                <button wire:click="openQuotationModal({{ $application->id }})" 
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium">
                                    Submit Quote
                                </button>
                                @elseif($myQuotation)
                                <div class="flex space-x-2">
                                    <button wire:click="openViewQuotation({{ $myQuotation->id }})" class="text-green-600 hover:text-green-900">View</button>
                                    @if($myQuotation->status === 'SUBMITTED')
                                    <button wire:click="openEditQuotation({{ $myQuotation->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                                    @endif
                                    @if($myQuotation->status === 'SELECTED' && in_array($application->status, ['APPROVED', 'PROCESSING']))
                                    <button wire:click="openCfCompletedModal({{ $application->id }})" 
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-medium">
                                        Mark Complete
                                    </button>
                                    @endif
                                </div>
                                @else
                                
                                <span class="text-gray-400">No actions</span>
                                @endif
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
                    @if($activeTab === 'new-applications')
                        No new applications available for quotation.
                    @elseif($activeTab === 'my-quotations')
                        You haven't submitted any quotations yet.
                    @elseif($activeTab === 'accepted')
                        No accepted quotations.
                    @else
                        No rejected quotations.
                    @endif
                </p>
            </div>
            @endif
        </div>
    </div>

    <!-- Quotation Modal -->
    @if($showQuotationModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Submit Quotation</h3>
                    <button wire:click="closeQuotationModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if($selectedApplication)
                <!-- Application Details -->
                <div class="bg-gray-50 p-4 rounded-lg mt-4">
                    <h4 class="font-medium text-gray-900 mb-2">Application Details</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Application Number:</span>
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
                        <div>
                            <span class="text-gray-500">CIF Value:</span>
                            <span class="font-medium ml-2">${{ number_format($selectedApplication->cif_value_usd, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quotation Form -->
                <form wire:submit.prevent="submitQuotation" class="mt-6">
                    <div class="space-y-6">
                        <!-- TRA Reference -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">TRA Reference Number *</label>
                            <input type="text" wire:model="tra_reference_number" 
                                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                   placeholder="Enter TRA reference number">
                            @error('tra_reference_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Duties and Taxes Section (TZS) -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Duties and Taxes (TZS)</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Import Duty *</label>
                                    <input type="number" step="0.01" wire:model="import_duty" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('import_duty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">VAT Amount *</label>
                                    <input type="number" step="0.01" wire:model="vat_amount" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('vat_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Railway Development Levy *</label>
                                    <input type="number" step="0.01" wire:model="railway_development_levy" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('railway_development_levy') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Excise Duty</label>
                                    <input type="number" step="0.01" wire:model="excise_duty" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('excise_duty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Service Levy</label>
                                    <input type="number" step="0.01" wire:model="service_levy" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('service_levy') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Other Charges</label>
                                    <input type="number" step="0.01" wire:model="other_charges" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('other_charges') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Service Fees Section (TZS) -->
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Service Fees (TZS)</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Clearing Fee *</label>
                                    <input type="number" step="0.01" wire:model="clearing_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('clearing_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Forwarding Fee *</label>
                                    <input type="number" step="0.01" wire:model="forwarding_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('forwarding_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Documentation Fee *</label>
                                    <input type="number" step="0.01" wire:model="documentation_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('documentation_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Port Charges</label>
                                    <input type="number" step="0.01" wire:model="port_charges" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('port_charges') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Transportation Fee</label>
                                    <input type="number" step="0.01" wire:model="transportation_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('transportation_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Storage Charges</label>
                                    <input type="number" step="0.01" wire:model="storage_charges" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('storage_charges') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Other Service Fees</label>
                                    <input type="number" step="0.01" wire:model="other_service_fees" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('other_service_fees') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Live Summary -->
                        @php
                            $totalDutiesTaxes = ($import_duty ?? 0) + ($vat_amount ?? 0) + ($railway_development_levy ?? 0) + ($excise_duty ?? 0) + ($service_levy ?? 0) + ($other_charges ?? 0);
                            $totalServiceFees = ($clearing_fee ?? 0) + ($forwarding_fee ?? 0) + ($documentation_fee ?? 0) + ($port_charges ?? 0) + ($transportation_fee ?? 0) + ($storage_charges ?? 0) + ($other_service_fees ?? 0);
                            $grandTotal = $totalDutiesTaxes + $totalServiceFees;
                        @endphp
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-3">Summary (TZS)</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                <div class="flex items-center justify-between"><span class="text-gray-600">Total Duties & Taxes</span><span class="font-semibold">{{ number_format($totalDutiesTaxes, 2) }}</span></div>
                                <div class="flex items-center justify-between"><span class="text-gray-600">Total Service Fees</span><span class="font-semibold">{{ number_format($totalServiceFees, 2) }}</span></div>
                                <div class="flex items-center justify-between md:col-span-1 col-span-2"><span class="text-gray-800">Grand Total</span><span class="font-bold text-green-700">{{ number_format($grandTotal, 2) }}</span></div>
                            </div>
                        </div>

                        <!-- Terms and Timeline Section -->
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Terms and Timeline</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Estimated Clearance Days *</label>
                                    <input type="number" min="1" max="30" wire:model="estimated_clearance_days" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('estimated_clearance_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Quotation Validity (Days) *</label>
                                    <input type="number" min="3" max="30" wire:model="validity_days" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('validity_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Payment Terms *</label>
                                <input type="text" wire:model="payment_terms" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                       placeholder="e.g., Payment required before clearance">
                                @error('payment_terms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Special Notes</label>
                                <textarea wire:model="special_notes" rows="3" 
                                          class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                          placeholder="Any special conditions or notes..."></textarea>
                                @error('special_notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Total Summary -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Quotation Summary</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Total Duties & Taxes:</span>
                                    <span class="font-medium">TZS {{ number_format(($import_duty ?? 0) + ($vat_amount ?? 0) + ($railway_development_levy ?? 0) + ($excise_duty ?? 0) + ($service_levy ?? 0) + ($other_charges ?? 0)) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Service Fees:</span>
                                    <span class="font-medium">TZS {{ number_format(($clearing_fee ?? 0) + ($forwarding_fee ?? 0) + ($documentation_fee ?? 0) + ($port_charges ?? 0) + ($transportation_fee ?? 0) + ($storage_charges ?? 0) + ($other_service_fees ?? 0)) }}</span>
                                </div>
                                <div class="flex justify-between border-t pt-2 text-lg font-bold">
                                    <span>Grand Total:</span>
                                    <span class="text-green-600">TZS {{ number_format(($import_duty ?? 0) + ($vat_amount ?? 0) + ($railway_development_levy ?? 0) + ($excise_duty ?? 0) + ($service_levy ?? 0) + ($other_charges ?? 0) + ($clearing_fee ?? 0) + ($forwarding_fee ?? 0) + ($documentation_fee ?? 0) + ($port_charges ?? 0) + ($transportation_fee ?? 0) + ($storage_charges ?? 0) + ($other_service_fees ?? 0)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
                        <button type="button" wire:click="closeQuotationModal" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Submit Quotation
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Edit Quotation Modal -->
    @if($showEditQuotationModal && $editQuotation)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Edit Quotation</h3>
                    <button wire:click="closeEditQuotationModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if($selectedApplication)
                <!-- Application Details -->
                <div class="bg-gray-50 p-4 rounded-lg mt-4">
                    <h4 class="font-medium text-gray-900 mb-2">Application Details</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Application Number:</span>
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
                        <div>
                            <span class="text-gray-500">CIF Value:</span>
                            <span class="font-medium ml-2">${{ number_format($selectedApplication->cif_value_usd, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quotation Form -->
                <form wire:submit.prevent="submitQuotation" class="mt-6">
                    <div class="space-y-6">
                        <!-- TRA Reference -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">TRA Reference Number *</label>
                            <input type="text" wire:model="tra_reference_number" 
                                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                   placeholder="Enter TRA reference number">
                            @error('tra_reference_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Duties and Taxes Section (TZS) -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Duties and Taxes (TZS)</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Import Duty *</label>
                                    <input type="number" step="0.01" wire:model="import_duty" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('import_duty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">VAT Amount *</label>
                                    <input type="number" step="0.01" wire:model="vat_amount" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('vat_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Railway Development Levy *</label>
                                    <input type="number" step="0.01" wire:model="railway_development_levy" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('railway_development_levy') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Excise Duty</label>
                                    <input type="number" step="0.01" wire:model="excise_duty" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('excise_duty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Service Levy</label>
                                    <input type="number" step="0.01" wire:model="service_levy" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('service_levy') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Other Charges</label>
                                    <input type="number" step="0.01" wire:model="other_charges" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('other_charges') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Service Fees Section (TZS) -->
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Service Fees (TZS)</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Clearing Fee *</label>
                                    <input type="number" step="0.01" wire:model="clearing_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('clearing_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Forwarding Fee *</label>
                                    <input type="number" step="0.01" wire:model="forwarding_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('forwarding_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Documentation Fee *</label>
                                    <input type="number" step="0.01" wire:model="documentation_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('documentation_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Port Charges</label>
                                    <input type="number" step="0.01" wire:model="port_charges" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('port_charges') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Transportation Fee</label>
                                    <input type="number" step="0.01" wire:model="transportation_fee" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('transportation_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Storage Charges</label>
                                    <input type="number" step="0.01" wire:model="storage_charges" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('storage_charges') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Other Service Fees</label>
                                    <input type="number" step="0.01" wire:model="other_service_fees" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('other_service_fees') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Live Summary -->
                        @php
                            $totalDutiesTaxes = ($import_duty ?? 0) + ($vat_amount ?? 0) + ($railway_development_levy ?? 0) + ($excise_duty ?? 0) + ($service_levy ?? 0) + ($other_charges ?? 0);
                            $totalServiceFees = ($clearing_fee ?? 0) + ($forwarding_fee ?? 0) + ($documentation_fee ?? 0) + ($port_charges ?? 0) + ($transportation_fee ?? 0) + ($storage_charges ?? 0) + ($other_service_fees ?? 0);
                            $grandTotal = $totalDutiesTaxes + $totalServiceFees;
                        @endphp
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-3">Summary (TZS)</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                <div class="flex items-center justify-between"><span class="text-gray-600">Total Duties & Taxes</span><span class="font-semibold">{{ number_format($totalDutiesTaxes, 2) }}</span></div>
                                <div class="flex items-center justify-between"><span class="text-gray-600">Total Service Fees</span><span class="font-semibold">{{ number_format($totalServiceFees, 2) }}</span></div>
                                <div class="flex items-center justify-between md:col-span-1 col-span-2"><span class="text-gray-800">Grand Total</span><span class="font-bold text-green-700">{{ number_format($grandTotal, 2) }}</span></div>
                            </div>
                        </div>

                        <!-- Terms and Timeline Section -->
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-4">Terms and Timeline</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Estimated Clearance Days *</label>
                                    <input type="number" min="1" max="30" wire:model="estimated_clearance_days" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('estimated_clearance_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Quotation Validity (Days) *</label>
                                    <input type="number" min="3" max="30" wire:model="validity_days" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    @error('validity_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Payment Terms *</label>
                                <input type="text" wire:model="payment_terms" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                       placeholder="e.g., Payment required before clearance">
                                @error('payment_terms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Special Notes</label>
                                <textarea wire:model="special_notes" rows="3" 
                                          class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                          placeholder="Any special conditions or notes..."></textarea>
                                @error('special_notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Total Summary -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Quotation Summary</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Total Duties & Taxes:</span>
                                    <span class="font-medium">TZS {{ number_format(($import_duty ?? 0) + ($vat_amount ?? 0) + ($railway_development_levy ?? 0) + ($excise_duty ?? 0) + ($service_levy ?? 0) + ($other_charges ?? 0)) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Service Fees:</span>
                                    <span class="font-medium">TZS {{ number_format(($clearing_fee ?? 0) + ($forwarding_fee ?? 0) + ($documentation_fee ?? 0) + ($port_charges ?? 0) + ($transportation_fee ?? 0) + ($storage_charges ?? 0) + ($other_service_fees ?? 0)) }}</span>
                                </div>
                                <div class="flex justify-between border-t pt-2 text-lg font-bold">
                                    <span>Grand Total:</span>
                                    <span class="text-green-600">TZS {{ number_format(($import_duty ?? 0) + ($vat_amount ?? 0) + ($railway_development_levy ?? 0) + ($excise_duty ?? 0) + ($service_levy ?? 0) + ($other_charges ?? 0) + ($clearing_fee ?? 0) + ($forwarding_fee ?? 0) + ($documentation_fee ?? 0) + ($port_charges ?? 0) + ($transportation_fee ?? 0) + ($storage_charges ?? 0) + ($other_service_fees ?? 0)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
                        <button type="button" wire:click="closeEditQuotationModal" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Submit Quotation
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- CF Mark as Completed Modal -->
    @if($showCfCompletedModal && $cfCompletedApplication)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Mark Clearance as Complete</h3>
                    <button wire:click="closeCfCompletedModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Application Info -->
                <div class="mt-4">
                    <div class="bg-gray-50 p-3 rounded-lg mb-4">
                        <p class="text-sm font-medium text-gray-900">{{ $cfCompletedApplication->application_number }}</p>
                        <p class="text-sm text-gray-600">{{ $cfCompletedApplication->applicant_name }}</p>
                        <p class="text-sm text-gray-600">{{ $cfCompletedApplication->vehicle_make }} {{ $cfCompletedApplication->vehicle_model }}</p>
                    </div>

                    <form wire:submit.prevent="markCfAsCompleted">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Clearance Completion Notes *</label>
                            <textarea wire:model="cf_completion_notes" rows="4" 
                                      class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                      placeholder="Provide details about the completed clearance process (duties paid, vehicle cleared, etc.)..."></textarea>
                            @error('cf_completion_notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
                            <button type="button" wire:click="closeCfCompletedModal" 
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Mark as Complete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- View Quotation Modal -->
    @if($showViewQuotationModal && $viewQuotation)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Quotation Details</h3>
                <button wire:click="closeViewQuotationModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Quotation #:</span> <span class="font-medium ml-2">{{ $viewQuotation->quotation_number }}</span></div>
                <div><span class="text-gray-500">TRA Ref:</span> <span class="font-medium ml-2">{{ $viewQuotation->tra_reference_number }}</span></div>
                <div><span class="text-gray-500">Total Duties & Taxes:</span> <span class="font-medium ml-2">TZS {{ number_format($viewQuotation->total_duties_taxes, 2) }}</span></div>
                <div><span class="text-gray-500">Total Service Fees:</span> <span class="font-medium ml-2">TZS {{ number_format($viewQuotation->total_service_fees, 2) }}</span></div>
                <div class="md:col-span-2"><span class="text-gray-700">Grand Total:</span> <span class="font-bold text-green-700 ml-2">TZS {{ number_format($viewQuotation->grand_total, 2) }}</span></div>
                <div><span class="text-gray-500">Estimated Days:</span> <span class="font-medium ml-2">{{ $viewQuotation->estimated_clearance_days }}</span></div>
                <div><span class="text-gray-500">Validity:</span> <span class="font-medium ml-2">{{ $viewQuotation->validity_days }} days</span></div>
                <div class="md:col-span-2"><span class="text-gray-500">Payment Terms:</span> <span class="font-medium ml-2">{{ $viewQuotation->payment_terms }}</span></div>
                @if($viewQuotation->special_notes)
                <div class="md:col-span-2"><span class="text-gray-500">Notes:</span> <span class="font-medium ml-2">{{ $viewQuotation->special_notes }}</span></div>
                @endif
                <div class="md:col-span-2"><span class="text-gray-500">Status:</span> <span class="font-medium ml-2">{{ ucfirst(str_replace('_', ' ', $viewQuotation->status)) }}</span></div>
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