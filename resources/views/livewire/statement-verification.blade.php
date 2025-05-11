<div>
    <!-- Main Status Card - Minimalist Design -->
    <div class="bg-{{ $isVerified ? 'green' : 'red' }}-50 border-l-4 mb-4 border-{{ $isVerified ? 'green' : 'red' }}-500 rounded-lg shadow-sm p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="bg-{{ $isVerified ? 'green' : 'red' }}-500 text-white w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            @if($isVerified)
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            @endif
                        </svg>
                    </div>
                </div>
                <div>
                    <h5 class="text-{{ $isVerified ? 'green' : 'red' }}-800 font-medium text-base">
                        Statement {{ $isVerified ? 'Verified' : 'Verification Failed' }}
                    </h5>
                    <p class="text-gray-600 text-sm">
                        {{ $isVerified ? 'Financial statement has been successfully verified.' : 'Statement verification was unsuccessful.' }}
                    </p>
                </div>
            </div>
            <button 
                wire:click="toggleModal" 
                class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded transition-colors duration-200">
                View Details
            </button>
        </div>
    </div>

    <!-- Modal for Statement Details -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" wire:click.self="toggleModal">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Statement Summary</h3>
                    <button wire:click="toggleModal" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4">
                    @if(isset($statement))
                        <!-- Account & Verification Status -->
                        <div class="mb-6">
                            <div class="bg-{{ $isVerified ? 'green' : 'red' }}-50 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-{{ $isVerified ? 'green' : 'red' }}-100 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $isVerified ? 'green' : 'red' }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            @if($isVerified)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            @endif
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-{{ $isVerified ? 'green' : 'red' }}-800">
                                            {{ $isVerified ? 'Statement Verified' : 'Verification Failed' }}
                                        </p>
                                        <p class="text-sm text-gray-600">Acc: {{ $statement['profile']['account'] ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cash Flow Summary Card -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Cash Flow Summary</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <div class="text-xs text-gray-500 mb-1">Total Cash In</div>
                                    <div class="font-bold text-green-700">{{ number_format($statement['2d_analysis']['total_cash_inflow'] ?? 0) }} {{ $statement['profile']['currency_code'] ?? 'TZS' }}</div>
                                </div>
                                <div class="bg-red-50 p-4 rounded-lg">
                                    <div class="text-xs text-gray-500 mb-1">Total Cash Out</div>
                                    <div class="font-bold text-red-700">{{ number_format($statement['2d_analysis']['total_cash_outflow'] ?? 0) }} {{ $statement['profile']['currency_code'] ?? 'TZS' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Key Financial Indicators -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Key Indicators</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500">Current Balance</p>
                                        <p class="font-medium">{{ number_format($statement['1d_analysis']['customer_profile']['wallet_balance'] ?? 0) }} {{ $statement['profile']['currency_code'] ?? 'TZS' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Total Transactions</p>
                                        <p class="font-medium">{{ $statement['1d_analysis']['customer_profile']['total_transactions'] ?? 0 }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Active Days</p>
                                        <p class="font-medium">{{ $statement['1d_analysis']['initial_info']['total_active_days'] ?? 0 }} / {{ $statement['1d_analysis']['initial_info']['total_days'] ?? 0 }} days</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Period</p>
                                        <p class="font-medium">
                                            {{ isset($statement['profile']['start_date']) ? date('M d', strtotime($statement['profile']['start_date'])) : 'N/A' }} - 
                                            {{ isset($statement['profile']['end_date']) ? date('M d, Y', strtotime($statement['profile']['end_date'])) : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Affordability Score -->
                        @if(isset($statement['affordability_scores']))
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Affordability</h4>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3
                                            {{ $statement['affordability_scores']['rank'] == 1 ? 'bg-green-100 text-green-600' : 
                                               ($statement['affordability_scores']['rank'] == 2 ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                                            {{ $statement['affordability_scores']['rank'] }}
                                        </div>
                                        <span class="font-medium">
                                            {{ $statement['affordability_scores']['rank'] == 1 ? 'High' : 
                                               ($statement['affordability_scores']['rank'] == 2 ? 'Moderate' : 'Low') }} Affordability
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mt-2">
                                        <div class="text-center">
                                            <div class="text-xs text-gray-500 mb-1">High</div>
                                            <div class="font-medium text-green-600">{{ number_format($statement['affordability_scores']['high']) }}</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-xs text-gray-500 mb-1">Moderate</div>
                                            <div class="font-medium text-yellow-600">{{ number_format($statement['affordability_scores']['moderate']) }}</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-xs text-gray-500 mb-1">Low</div>
                                            <div class="font-medium text-red-600">{{ number_format($statement['affordability_scores']['low']) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-500">No statement data available.</p>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                    <button wire:click="toggleModal" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>