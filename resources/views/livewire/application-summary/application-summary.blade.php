<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white shadow-sm rounded-2xl p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Loan Applications</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage and review loan applications</p>
                </div>
                
                <!-- Search and Filter Section -->
                <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                        <input 
                            type="text" 
                            wire:model="search" 
                            placeholder="Search applications..." 
                            class="pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-transparent w-full sm:w-64 transition-all"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                </div>

                    <select 
                        wire:model="statusFilter" 
                        class="rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-transparent py-2.5 px-4 transition-all"
                    >
                    <option value="">All Statuses</option>
                    <option value="NEW CLIENT">New Application</option>
                    <option value="ACCEPTED">Accepted</option>
                    <option value="REJECTED">Rejected</option>
                    <option value="IN REVIEW">In Review</option>
                </select>
                </div>
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

        <!-- Success Message -->
        @if(session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-start animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="font-medium">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        @if(!$selectedApplication)
            <!-- Applications Table View -->
            <div class="bg-white shadow-md rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Applicant</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                @forelse($applicationx as $application)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-semibold">
                                                {{ substr($application->first_name, 0, 1) }}{{ substr($application->last_name, 0, 1) }}
                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $application->first_name }} {{ $application->last_name }}
                                                </div>
                                                <div class="text-sm text-gray-500">ID: {{ $application->national_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $application->phone_number }}</div>
                                        <div class="text-xs text-gray-500">{{ $application->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $application->region }}</div>
                                        <div class="text-sm text-gray-500">{{ $application->district }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $application->application_status === 'Approved' ? 'bg-green-100 text-green-800' : 
                                       ($application->application_status === 'Rejected' ? 'bg-red-100 text-red-800' : 
                                       ($application->application_status === 'In Review' ? 'bg-blue-100 text-blue-800' : 
                                                'bg-amber-100 text-amber-800')) }}">
                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full
                                                {{ $application->application_status === 'Approved' ? 'bg-green-600' : 
                                                   ($application->application_status === 'Rejected' ? 'bg-red-600' : 
                                                   ($application->application_status === 'In Review' ? 'bg-blue-600' : 
                                                    'bg-amber-600')) }}">
                                            </span>
                                    {{ $application->application_status }}
                                </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            type="button"
                                            wire:click="selectApplication({{ $application->id }})"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all"
                                        >
                                            View Details
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                                        </button>
                                    </td>
                                </tr>
                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                                        <p class="mt-4 text-gray-500">No loan applications match your search criteria.</p>
                                    </td>
                                </tr>
                @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $applicationx->links() }}
            </div>
            </div>
        @endif

                @if($selectedApplication)
            <!-- Application Details View -->
            <div class="flex gap-6">
                <!-- Sidebar Navigation -->
                <div class="w-64 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-sm p-4 sticky top-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-sm font-semibold text-gray-900">Navigation</h3>
                            <button
                                wire:click="$set('selectedApplication', null)"
                                class="p-2 hover:bg-gray-100 rounded-lg transition-colors"
                                title="Back to list"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <nav class="space-y-1">
                            <button wire:click="$set('activeTab', 'applicant')"
                                    class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all
                                           {{ $activeTab === 'applicant' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Applicant Info
                            </button>
                            
                            <button wire:click="$set('activeTab', 'vehicle')"
                                    class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all
                                           {{ $activeTab === 'vehicle' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                Vehicle Info
                                    </button>

                            <button wire:click="$set('activeTab', 'financial')"
                                    class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all
                                           {{ $activeTab === 'financial' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                Financial Info
                            </button>
                            
                            <button wire:click="$set('activeTab', 'statement')"
                                    class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all
                                           {{ $activeTab === 'statement' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                Statement
                            </button>
                            
                            <button wire:click="$set('activeTab', 'documents')"
                                    class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all
                                           {{ $activeTab === 'documents' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                Documents
                            </button>
                            
                            <button wire:click="$set('activeTab', 'employment')"
                                    class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all
                                           {{ $activeTab === 'employment' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Employment
                            </button>

                            <button wire:click="$set('activeTab', 'affordability')"
                                    class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all
                                           {{ $activeTab === 'affordability' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 8 4-16 3 8h4" />
                                </svg>
                                Affordability
                            </button>
                        </nav>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <button
                                wire:click="$set('selectedApplication', null)"
                                class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Applications
                            </button>
                        </div>
                    </div>
                                </div>

                <!-- Main Content Area -->
                <div class="flex-1 bg-white rounded-2xl shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-white">Application Details</h2>
                                <p class="text-green-100 text-sm mt-1">Application ID: #{{ $selectedApplication->id }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="p-2 rounded-lg bg-green-500 hover:bg-green-600 text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </div>
                            </div>
                        </div>
                        
                    <!-- Content Area -->
                    <div class="p-8">
                        @if($activeTab === 'applicant')
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Personal Information Card -->
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                        <div class="flex items-center mb-4">
                                            <div class="p-2 bg-green-100 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-900 ml-3">Personal Information</h4>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="flex items-start">
                                                <span class="text-sm text-gray-500 w-32 flex-shrink-0">Full Name</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->first_name }} {{ $selectedApplication->middle_name }} {{ $selectedApplication->last_name }}</span>
                                        </div>
                                            <div class="flex items-start">
                                                <span class="text-sm text-gray-500 w-32 flex-shrink-0">National ID</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->national_id }}</span>
                                        </div>
                                            <div class="flex items-start">
                                                <span class="text-sm text-gray-500 w-32 flex-shrink-0">Phone Number</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->phone_number }}</span>
                                        </div>
                                            <div class="flex items-start">
                                                <span class="text-sm text-gray-500 w-32 flex-shrink-0">Email</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->email }}</span>
                                        </div>
                                        </div>
                                    </div>

                                    <!-- Address Information Card -->
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                        <div class="flex items-center mb-4">
                                            <div class="p-2 bg-blue-100 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-900 ml-3">Address Information</h4>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="flex items-start">
                                                <span class="text-sm text-gray-500 w-32 flex-shrink-0">Region</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->region }}</span>
                                        </div>
                                            <div class="flex items-start">
                                                <span class="text-sm text-gray-500 w-32 flex-shrink-0">District</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->district }}</span>
                                        </div>
                                            <div class="flex items-start">
                                                <span class="text-sm text-gray-500 w-32 flex-shrink-0">Street</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $selectedApplication->street }}</span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endif

                        @if($activeTab === 'vehicle')
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                <div class="flex items-center mb-6">
                                    <div class="p-2 bg-purple-100 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 ml-3">Vehicle Information</h4>
                                    </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <span class="text-xs text-gray-500 block mb-1">Make & Model</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $selectedApplication->make_and_model }}</span>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <span class="text-xs text-gray-500 block mb-1">Year</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $selectedApplication->year_of_manufacture }}</span>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <span class="text-xs text-gray-500 block mb-1">Color</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $selectedApplication->color }}</span>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <span class="text-xs text-gray-500 block mb-1">VIN</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $selectedApplication->vin }}</span>
                                </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <span class="text-xs text-gray-500 block mb-1">Mileage</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ number_format($selectedApplication->mileage, 0) }} km</span>
                            </div>
                                </div>
                            </div>
                        @endif

                        @if($activeTab === 'financial')
                            <div class="space-y-6">
                                <!-- Financial Summary Card -->
                                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                                    <div class="flex items-center mb-6">
                                        <div class="p-2 bg-green-600 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                    </div>
                                        <h4 class="text-lg font-semibold text-gray-900 ml-3">Financial Information</h4>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="bg-white rounded-lg p-5 shadow-sm">
                                            <span class="text-xs text-gray-500 block mb-2">Purchase Price</span>
                                            <span class="text-xl font-bold text-gray-900">TZS {{ number_format($selectedApplication->purchase_price, 2) }}</span>
                                    </div>
                                        <div class="bg-white rounded-lg p-5 shadow-sm">
                                            <span class="text-xs text-gray-500 block mb-2">Down Payment</span>
                                            <span class="text-xl font-bold text-green-600">TZS {{ number_format($selectedApplication->down_payment, 2) }}</span>
                                        </div>
                                        <div class="bg-white rounded-lg p-5 shadow-sm">
                                            <span class="text-xs text-gray-500 block mb-2">Loan Amount</span>
                                            <span class="text-xl font-bold text-blue-600">TZS {{ number_format($selectedApplication->purchase_price - $selectedApplication->down_payment, 2) }}</span>
                                        </div>
                                </div>
                            </div>

                                <!-- Status Messages -->
                                @if(session('success'))
                                    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 flex items-start space-x-3">
                                        <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
                                        <span class="text-green-800">{{ session('success') }}</span>
    </div>
@endif

                                @if(session('error'))
                                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 flex items-start space-x-3">
                                        <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
                                        <span class="text-red-800">{{ session('error') }}</span>
    </div>
@endif

                                @if(session('info'))
                                    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 flex items-start space-x-3">
                                        <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
        </svg>
                                        <span class="text-blue-800">{{ session('info') }}</span>
    </div>
@endif

                                <!-- Action Buttons Based on Status -->
                            @if($selectedApplication->application_status == 'pending')
                                    <div class="bg-gradient-to-br from-amber-50 to-amber-100 border-l-4 border-amber-500 rounded-xl p-6">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
            <div class="bg-amber-500 text-white w-12 h-12 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
            </div>
        </div>
        <div class="flex-grow">
                                                <h5 class="text-amber-900 font-semibold text-lg mb-2">Action Required</h5>
                                                <p class="text-gray-700 mb-3">Please review this application and make a decision. You can either approve it to proceed or reject it with an appropriate reason.</p>
                                                <p class="text-sm text-amber-800 font-medium">Note: This decision cannot be changed once submitted.</p>
                                                
                                                <div class="mt-6 flex justify-end space-x-3">
                                                    <button 
                                                        wire:click="actionFunction('REJECTED', {{ $selectedApplication->id }})" 
                                                        class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                                                    >
                                                        Reject Application
                </button>
                                                    <button 
                                                        wire:click="actionFunction('NEW CLIENT',{{ $selectedApplication->id }})" 
                                                        class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all font-medium focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-md"
                                                    >
                                                        Approve Application
                </button>
            </div>
        </div>
    </div>
</div>
@elseif($selectedApplication->application_status == 'REJECTED')
                                    <div class="bg-gradient-to-br from-red-50 to-red-100 border-l-4 border-red-500 rounded-xl p-6">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
            <div class="bg-red-500 text-white w-12 h-12 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
            </div>
        </div>
        <div class="flex-grow">
                                                <h5 class="text-red-900 font-semibold text-lg mb-2">Application Rejected</h5>
            <p class="text-gray-700">This application has been rejected. No further action is required. Contact support if this was done in error.</p>
        </div>
    </div>
</div>
@else
                                    <div class="bg-gradient-to-br from-green-50 to-green-100 border-l-4 border-green-500 rounded-xl p-6">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
            <div class="bg-green-500 text-white w-12 h-12 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
            </div>
        </div>
        <div class="flex-grow">
                                                <h5 class="text-green-900 font-semibold text-lg mb-2">Application Approved</h5>
            <p class="text-gray-700">This application has been successfully approved. You may now proceed with the next steps.</p>
        </div>
    </div>
</div>
                                @endif
                            </div>
@endif

                        @if($activeTab === 'statement')
                            <div class="space-y-6">
        <livewire:statement-verification :statement="$statementData" />
                            </div>
                        @endif

                        @if($activeTab === 'documents')
                            <div class="space-y-6">
                                <!-- Application Documents -->
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                    <div class="flex items-center mb-6">
                                        <div class="p-2 bg-indigo-100 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-semibold text-gray-900 ml-3">Application Documents</h4>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @forelse($applicationDocuments as $appDocument)
                                            <button 
                                                wire:click="download('{{ $appDocument->url }}')" 
                                                type="button" 
                                                class="bg-white border-2 border-gray-200 hover:border-green-500 rounded-lg p-4 transition-all hover:shadow-md group"
                                            >
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                                                        <div class="p-2 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                        <span class="text-sm font-medium text-gray-900 truncate">{{ $appDocument->type }}</span>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-green-600 transition-colors flex-shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </div>
                                            </button>
                                        @empty
                                            <div class="col-span-full text-center py-12">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="mt-4 text-gray-500">No documents available</p>
                                            </div>
                                        @endforelse
    </div>
</div>

                                <!-- Attached Images -->
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                    <div class="flex items-center mb-6">
                                        <div class="p-2 bg-pink-100 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-semibold text-gray-900 ml-3">Attached Images</h4>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach($images as $index => $image)
                                            <div class="group relative">
                                                <img 
                                                    src="{{ asset('storage/' . $image) }}" 
                                                    class="w-full h-40 object-cover rounded-lg cursor-pointer border-2 border-gray-200 hover:border-green-500 transition-all shadow-sm hover:shadow-lg" 
                                                    wire:click="showImageModal({{ $index }})"
                                                />
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Image Modal -->
                            @if($selectedImageIndex !== null)
                                <div class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4 animate-fade-in">
                                    <div class="relative w-full max-w-6xl h-[90vh] bg-white rounded-2xl shadow-2xl overflow-hidden flex">
                                        <!-- Image Container -->
                                        <div class="w-3/4 bg-gray-900 flex items-center justify-center relative">
                                            <img 
                                                src="{{ asset('storage/' . $images[$selectedImageIndex]) }}" 
                                                class="max-w-full max-h-full object-contain"
                                                alt="Application Image {{ $selectedImageIndex + 1 }}"
                                            />
                                            
                                            <!-- Navigation Buttons -->
                                            <button 
                                                wire:click="previousImage"
                                                @if($selectedImageIndex <= 0) disabled @endif
                                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-100 rounded-full p-3 disabled:opacity-30 disabled:cursor-not-allowed transition-all shadow-lg"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            
                                            <button 
                                                wire:click="nextImage"
                                                @if($selectedImageIndex >= count($images) - 1) disabled @endif
                                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-100 rounded-full p-3 disabled:opacity-30 disabled:cursor-not-allowed transition-all shadow-lg"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                            
                                            <!-- Image Counter -->
                                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full text-sm font-medium">
                                                {{ $selectedImageIndex + 1 }} / {{ count($images) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Image Details Sidebar -->
                                        <div class="w-1/4 bg-white p-6 overflow-y-auto border-l border-gray-200">
                                            <div class="flex justify-between items-start mb-6">
                                                <h3 class="text-lg font-semibold text-gray-800">Image Details</h3>
                                                <button 
                                                    wire:click="closeImageModal" 
                                                    class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            
                                            <div class="space-y-6">
                                                @php
                                                    $imagePath = $images[$selectedImageIndex];
                                                    $imageInfo = pathinfo($imagePath);
                                                    $fileSize = filesize(storage_path('app/public/' . $imagePath));
                                                @endphp
                                                
                                                <div>
                                                    <span class="text-xs text-gray-500 block mb-1">Filename</span>
                                                    <span class="text-sm font-medium text-gray-900 break-all">{{ $imageInfo['basename'] }}</span>
                                                </div>
                                                
                                                <div>
                                                    <span class="text-xs text-gray-500 block mb-1">File Type</span>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ strtoupper($imageInfo['extension']) }}
                                                    </span>
                                                </div>
                                                
                                                <div>
                                                    <span class="text-xs text-gray-500 block mb-1">File Size</span>
                                                    <span class="text-sm font-medium text-gray-900">{{ number_format($fileSize / 1024, 2) }} KB</span>
                                                </div>
                                                
                                                <div class="pt-4 border-t border-gray-200">
    <button 
                                                        wire:click="downloadImage('{{ $imagePath }}')"
                                                        class="w-full flex items-center justify-center space-x-2 bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg hover:from-green-700 hover:to-green-800 transition-all shadow-md"
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
                        @endif

                        @if($activeTab === 'employment')
 @if($selectedApplication->is_employee)
                                <div class="space-y-6">
                                    <!-- Employment Information Card -->
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                        <div class="flex items-center mb-6">
                                            <div class="p-2 bg-teal-100 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
            </div>
                                            <h4 class="text-lg font-semibold text-gray-900 ml-3">Employment Information</h4>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                                <span class="text-xs text-gray-500 block mb-1">Employee Number</span>
                                                <span class="text-sm font-semibold text-gray-900">{{ $selectedApplication->employee_id }}</span>
                                            </div>
                                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                                <span class="text-xs text-gray-500 block mb-1">Employer Email</span>
                                                <span class="text-sm font-semibold text-gray-900">{{ $selectedApplication->hrEmail }}</span>
                                            </div>
            </div>
        </div>

                                    <!-- Employment Verification Section -->
                                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                                        <div class="flex justify-between items-center mb-6">
                                            <h3 class="text-lg font-semibold text-gray-900">Employment Verification</h3>
                
                @if($employerMessageSent)
                                                <div class="flex items-center space-x-3">
                                                    <span class="text-sm text-gray-600">Sent: {{ $employerMessageSentDate }}</span>
                        <button 
                            wire:click="resendVerification" 
                                                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Resend
                        </button>
                    </div>
                @else
                    <button 
                        wire:click="toggleEmployerMessageForm" 
                                                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors"
                    >
                        {{ $showEmployerMessageForm ? 'Cancel' : 'Contact Employer' }}
                    </button>
                @endif
            </div>

            @if($showEmployerMessageForm)
                                            <div wire:loading.class="opacity-50" class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                                <label for="messageToEmployer" class="block text-sm font-medium text-gray-700 mb-3">Message to Employer</label>
                    <textarea 
                        id="messageToEmployer"
                        wire:model.defer="messageToEmployer" 
                        rows="6"
                                                    class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm"
                        placeholder="Write a message to the employer with your questions..."
                    ></textarea>
                    @error('messageToEmployer') 
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                                                <div class="mt-4 flex justify-end">
                        <button 
                            wire:click="sendToEmployer"
                            wire:loading.attr="disabled"
                                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 transition-all disabled:opacity-50 shadow-md"
                                                    >
                                                        <span wire:loading.remove wire:target="sendToEmployer">Send Verification Request</span>
                                                        <span wire:loading wire:target="sendToEmployer" class="inline-flex items-center">
                                                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                            </svg>
                                                            Sending...
                                                        </span>
                        </button>
                    </div>
                </div>
            @else
                @if($employerMessageSent)
                                                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                                                    <div class="flex items-start space-x-3 text-green-700 mb-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                                                        <div>
                                                            <p class="font-medium">Verification request sent to employer</p>
                                                            <p class="text-sm text-green-600 mt-1">{{ $employerMessageSentDate }}</p>
                        </div>
                            </div>
                            
                                                    @if($selectedApplication->employer_verified)
                                                        <div class="mt-4 pt-4 border-t border-green-200">
                                                            <h4 class="font-semibold text-green-900 mb-3">Employer Verification Result</h4>
                                    @php
                                        $verification = App\Models\EmployerVerification::where('application_id', $selectedApplication->id)
                                            ->where('status', 'completed')
                                            ->latest()
                                            ->first();
                                        
                                        $response = $verification ? $verification->employer_response : null;
                                    @endphp
                                    
                                    @if($response)
                                                                <div class="space-y-3 text-sm">
                                                                    <div class="flex items-center">
                                                                        <span class="font-medium text-gray-700 w-48">Knows Employee:</span>
                                                @if($response['knows_employee'] === 'yes')
                                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Yes</span>
                                                @else
                                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">No</span>
                                                @endif
                                                                    </div>
                                            
                                            @if($response['knows_employee'] === 'yes')
                                                                        <div class="flex items-center">
                                                                            <span class="font-medium text-gray-700 w-48">Position:</span>
                                                                            <span class="text-gray-900">{{ $response['position'] }}</span>
                                                                        </div>
                                                                        <div class="flex items-center">
                                                                            <span class="font-medium text-gray-700 w-48">Status:</span>
                                                                            <span class="text-gray-900">{{ ucfirst(str_replace('-', ' ', $response['employment_status'])) }}</span>
                                                                        </div>
                                                                        <div class="flex items-center">
                                                                            <span class="font-medium text-gray-700 w-48">Length of Employment:</span>
                                                                            <span class="text-gray-900">{{ ucfirst(str_replace('-', ' ', $response['employment_length'])) }}</span>
                                                                        </div>
                                                                        <div class="flex items-center">
                                                                            <span class="font-medium text-gray-700 w-48">Recommendation:</span>
                                                    @if($response['recommend'] === 'yes')
                                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Recommended</span>
                                                    @elseif($response['recommend'] === 'no')
                                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Not Recommended</span>
                                                    @else
                                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Unsure</span>
                                                    @endif
                                                                        </div>
                                                
                                                @if(!empty($response['comments']))
                                                                            <div class="pt-3">
                                                                                <span class="font-medium text-gray-700 block mb-2">Additional Comments:</span>
                                                                                <div class="bg-white rounded-lg p-4 italic text-gray-600 border border-gray-200">
                                                                                    {{ $response['comments'] }}
                                                                                </div>
                                                                            </div>
                                                @endif
                                            @endif
                                                                </div>
                                    @else
                                        <div class="text-gray-600">Detailed verification results are not available.</div>
                                    @endif
                            </div>
                        @else
                                                        <div class="mt-4 flex items-center text-blue-600">
                                                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                            </svg>
                                Awaiting employer response
                            </div>
                        @endif
                    </div>
                @else
                                                <div class="text-center py-12">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                    <p class="mt-4 text-gray-600">Click "Contact Employer" to send a verification request.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
                            @endif
    @endif
    
                        @if($activeTab === 'affordability')
                            <div class="space-y-6">
                                <!-- Affordability Overview -->
                                <div class="bg-gradient-to-r from-sky-50 to-indigo-50 border border-indigo-100 rounded-2xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="p-2 rounded-xl bg-indigo-600 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">Affordability Assessment</h3>
                                                <p class="text-xs text-gray-600">Snapshot of product limits, income, deductions and loan metrics.</p>
                                            </div>
                                        </div>
                                        <div class="text-right text-xs text-gray-500">
                                            <div>Today Year: <span class="font-semibold text-gray-800">2025</span></div>
                                        </div>
</div>

                                    <!-- Product Parameters -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                                        <div class="bg-white rounded-xl border border-gray-200 p-4">
                                            <h4 class="font-semibold text-gray-800 mb-3">Product Parameters</h4>
                                            <dl class="space-y-2">
                                                <div class="flex justify-between">
                                                    <dt class="text-gray-600">Max Vehicle Age (Years)</dt>
                                                    <dd class="font-semibold text-gray-900">10</dd>
                                                </div>
                                                <div class="flex justify-between">
                                                    <dt class="text-gray-600">Interest Rate</dt>
                                                    <dd class="font-semibold text-gray-900">15%</dd>
                                                </div>
                                                <div class="flex justify-between">
                                                    <dt class="text-gray-600">Maximum Tenor (Months)</dt>
                                                    <dd class="font-semibold text-gray-900">72</dd>
                                                </div>
                                                <div class="flex justify-between">
                                                    <dt class="text-gray-600">Maximum Limit / Applicant</dt>
                                                    <dd class="font-semibold text-gray-900">160,000,000</dd>
                                                </div>
                                            </dl>
                                        </div>

                                        <div class="bg-white rounded-xl border border-gray-200 p-4">
                                            <h4 class="font-semibold text-gray-800 mb-3">Risk Parameters</h4>
                                            <dl class="space-y-2">
                                                <div class="flex justify-between items-center">
                                                    <dt class="text-gray-600">Max DSR</dt>
                                                    <dd class="font-semibold text-gray-900">
                                                        <input type="number" wire:model.live="maxDSR" 
                                                               step="0.1"
                                                               class="w-20 text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                               placeholder="50" />
                                                        <span class="ml-1">%</span>
                                                    </dd>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <dt class="text-gray-600">Insurance - Free Claim</dt>
                                                    <dd class="font-semibold text-gray-900">
                                                        <input type="number" wire:model.live="insuranceFreeClaim" 
                                                               step="0.1"
                                                               class="w-20 text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                               placeholder="3.5" />
                                                        <span class="ml-1">%</span>
                                                    </dd>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <dt class="text-gray-600">Insurance - With Claim</dt>
                                                    <dd class="font-semibold text-gray-900">
                                                        <input type="number" wire:model.live="insuranceWithClaim" 
                                                               step="0.1"
                                                               class="w-20 text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                               placeholder="4.0" />
                                                        <span class="ml-1">%</span>
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
    </div>
</div>

                                @php
                                    $purchasePrice = $selectedApplication->purchase_price ?? 0;
                                @endphp

                                <!-- Applicant & Vehicle Block -->
                                <div class="bg-white border border-gray-200 rounded-2xl p-6">
                                    <h4 class="text-sm font-semibold text-gray-800 mb-4">Applicant & Vehicle Details</h4>
                                    <div class="overflow-x-auto text-xs">
                                        <table class="min-w-full border border-gray-200 rounded-lg">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Applicant Name</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Vehicle Purchase Price</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Date of Birth</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Months to Retirement</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Insurance Status</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Vehicle Make Year</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Requested Tenure (Months)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        {{ $selectedApplication->full_name }}
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        {{ $purchasePrice ? 'TZS ' . number_format($purchasePrice, 0) : '-' }}
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        @if(!empty($selectedApplication->date_of_birth))
                                                            {{ \Carbon\Carbon::parse($selectedApplication->date_of_birth)->format('d-M-Y') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        {{ $this->monthsToRetirement !== null ? $this->monthsToRetirement : '-' }}
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        {{ $selectedApplication->insurance_status ?? 'N/A' }}
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        {{ $selectedApplication->year_of_manufacture ?? '-' }}
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        {{ $selectedApplication->tenure ?? '-' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="mt-4 min-w-full border border-gray-200 rounded-lg">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Min Deposit %</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Min Required Deposit</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Max Vehicle Loan Amount</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Life Cover %</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Valuation Fee</th>
                                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium text-gray-600">Vehicle Age OK?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-2 border-b text-gray-900">30%</td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        {{ $purchasePrice ? 'TZS ' . number_format($purchasePrice * 0.30, 0) : '-' }}
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        TZS {{ number_format($this->totalRepaymentsCapital, 0) }}
                                                    </td>
                                                    <td class="px-3 py-2 border-b text-gray-900">0.068%</td>
                                                    <td class="px-3 py-2 border-b text-gray-900">0.5%</td>
                                                    <td class="px-3 py-2 border-b text-gray-900">
                                                        @if($this->isVehicleAgeOk === null)
                                                            -
                                                        @else
                                                            {{ $this->isVehicleAgeOk ? 'Yes' : 'No' }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                </div>
                
                                <!-- Income & Deductions -->
                                <div class="bg-white border border-gray-200 rounded-2xl p-6">
                                    <h4 class="text-sm font-semibold text-gray-800 mb-4">Income & Deductions (TZS)</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                    <div>
                                            <h5 class="font-semibold text-gray-800 mb-2">A. Monthly Pay</h5>
                                            <table class="min-w-full text-xs">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">1. Basic Salary</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="basicSalary" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">2. Housing Allowance</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="housingAllowance" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">3. Transport Allowance</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="transportAllowance" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">4. Other Allowance</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="otherAllowance" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr class="border-t border-gray-200">
                                                        <td class="py-1 font-semibold text-gray-800">Total Monthly Pay</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->totalMonthlyPay, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Taxable Income</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->taxableIncome, 0) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                    </div>
                    
                                        <div>
                                            <h5 class="font-semibold text-gray-800 mb-2">B. Non-Loan Monthly Deductions</h5>
                                            <table class="min-w-full text-xs">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">1. TAX</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="taxDeduction" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">2. NSSF Contribution</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="nssfContribution" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">3. Creditinfo Saccos Contribution</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="saccosContribution" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">4. Credit Union Contribution (Investment)</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="creditUnionContribution" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">5. Other (Specify)</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="otherDeductions" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr class="border-t border-gray-200">
                                                        <td class="py-1 font-semibold text-gray-800">Total Non-Loan Deductions</td>
                                                        <td class="py-1 text-right font-semibold text-red-700">
                                                            TZS {{ number_format($this->totalNonLoanDeductions, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="border-t border-gray-200">
                                                        <td class="py-1 font-semibold text-gray-800">C. Net Pay (A - B)</td>
                                                        <td class="py-1 text-right font-semibold text-blue-700">
                                                            TZS {{ number_format($this->netPayAfterDeductions, 0) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                    </div>
                    
                                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                                        <div>
                                            <h5 class="font-semibold text-gray-800 mb-2">D. Loan Monthly Deductions (EMI)</h5>
                                            <table class="min-w-full text-xs">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">1. Saccos Loan Repayment</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="saccosLoanRepayment" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">2. Housing Advance (if not settled)</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="housingAdvanceDeduction" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">3. Vehicle Loan EMI</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->vehicleLoanEMI, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">4. Other EMIs</td>
                                                        <td class="py-1 text-right">
                                                            <input type="number" wire:model.live="otherLoanEMIs" 
                                                                   class="w-full text-right border-gray-300 rounded-md shadow-sm text-xs px-2 py-1 focus:ring-green-500 focus:border-green-500" 
                                                                   placeholder="0" />
                                                        </td>
                                                    </tr>
                                                    <tr class="border-t border-gray-200">
                                                        <td class="py-1 font-semibold text-gray-800">Total EMI Deductions</td>
                                                        <td class="py-1 text-right font-semibold text-green-700">
                                                            TZS {{ number_format($this->totalEMIDeductions, 0) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="bg-gradient-to-br {{ $this->dsrFits ? 'from-green-50 to-green-100 border-green-200' : 'from-red-50 to-red-100 border-red-200' }} rounded-xl p-4 border">
                                            <h5 class="font-semibold {{ $this->dsrFits ? 'text-green-900' : 'text-red-900' }} mb-2">E. DSR – Debt Service Ratio</h5>
                                            <p class="text-xs text-gray-700 mb-2">
                                                TOTAL LOANS DEDUCTIONS AS % OF NET MONTHLY PAY AFTER NON-LOAN DEDUCTIONS [(D / C) %]
                                            </p>
                                            <div class="space-y-2 mt-3">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs text-gray-600">Calculated DSR</span>
                                                    <span class="text-lg font-bold {{ $this->dsrFits ? 'text-green-800' : 'text-red-800' }}">
                                                        {{ number_format($this->calculatedDSR, 2) }}%
                                                    </span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs text-gray-600">Max DSR (Limit)</span>
                                                    <span class="text-sm font-semibold text-gray-800">
                                                        {{ number_format($this->maxDSR, 1) }}%
                                                    </span>
                                                </div>
                                                <div class="flex items-center justify-between pt-2 border-t border-gray-300">
                                                    <span class="text-xs font-medium text-gray-700">Status</span>
                                                    <span class="text-sm font-bold {{ $this->dsrFits ? 'text-green-700' : 'text-red-700' }}">
                                                        @if($this->dsrFits)
                                                            ✓ Fits within limit
                                                        @else
                                                            ✗ Exceeds limit
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            </div>

                                <!-- Repayments & LTV -->
                                <div class="bg-white border border-gray-200 rounded-2xl p-6">
                                    <h4 class="text-sm font-semibold text-gray-800 mb-4">Repayments & Limits</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                            <div>
                                            <table class="min-w-full">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Total repayments – Capital amount</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->totalRepaymentsCapital, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Total Interest</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->totalInterest, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">1st Year Life Cover Premium</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->firstYearLifeCoverPremium, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Requested Vehicle Loan Amount</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->requestedVehicleLoanAmount, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">1st Year Vehicle Cover Premium</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->firstYearVehicleCoverPremium, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Vehicle Valuation Fee</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->vehicleValuationFee, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Total Loan Amount Required</td>
                                                        <td class="py-1 text-right font-semibold text-blue-700">
                                                            TZS {{ number_format($this->totalLoanAmountRequired, 0) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                            <div>
                                            <table class="min-w-full">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Total to be repaid</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->totalToBeRepaid, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Total Loan to be Booked</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->totalLoanToBeBooked, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Credit to Vehicle Dealer</td>
                                                        <td class="py-1 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->creditToVehicleDealer, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="border-t border-gray-200">
                                                        <td class="py-2 text-gray-600">Maximum Product Limit</td>
                                                        <td class="py-2 text-right font-semibold text-gray-900">
                                                            TZS {{ number_format($this->maximumProductLimit, 0) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1 text-gray-600">Loan To Value Ratio (LTV)</td>
                                                        <td class="py-1 text-right font-semibold text-indigo-700">
                                                            {{ number_format($this->loanToValueRatio, 1) }}%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
    </div>

                    <!-- Final Action Buttons -->
 @php
    $applicationStatus = DB::table('applications')
     ->where('id', session('applicationId'))
     ->value('application_status');
@endphp

@if(in_array($applicationStatus, ['ACCEPTED', 'REJECTED']))
                        <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                            <div class="flex items-center justify-end text-sm text-gray-600 italic">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
        Application {{ strtolower($applicationStatus) }} on {{ 
            DB::table('applications')
                ->where('id', session('applicationId'))
                ->value('updated_at') 
                                }}
                            </div>
                        </div>
@else 
                        <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                            <div class="flex justify-end space-x-4">
    <button 
      wire:click="rejectApplication" 
                                    class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-medium rounded-lg hover:from-red-700 hover:to-red-800 transition-all shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
        >
      Reject Application
        </button>
     <button 
         wire:click="acceptApplication" 
                                    class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 transition-all shadow-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
        >
       Accept Application
        </button>
                            </div>
    </div>
@endif
        </div>
</div>
                            @endif 
                        </div>



    <style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-fade-in {
    animation: fade-in 0.2s ease-out;
}
</style>


    </div>

