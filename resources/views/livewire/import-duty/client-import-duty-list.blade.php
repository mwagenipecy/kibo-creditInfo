<div>
{{-- resources/views/livewire/client-import-duty-list.blade.php --}}
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-green-600 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-white">My Import Duty Applications</h1>
                    <p class="text-green-100">Track and manage your vehicle import duty financing applications</p>
                </div>
                <div class="flex space-x-3">
                    <a href="" 
                       class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        All Applications
                    </a>
                    <a href="" 
                       class="bg-white text-green-600 hover:bg-gray-50 px-4 py-2 rounded-lg font-medium transition-colors">
                        New Application
                    </a>
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

        <!-- Urgent Actions Alert -->
        @if(count($urgentActions) > 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Action Required</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($urgentActions as $action)
                            <li>{{ $action['message'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Applications</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-green-600 font-medium">{{ $stats['approved'] }} approved</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pending Actions</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['pending_actions'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-yellow-600 font-medium">Require attention</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Value</dt>
                                <dd class="text-lg font-medium text-gray-900">TZS {{ number_format($stats['total_value']) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-gray-600 font-medium">All applications</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Recent Activity</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['recent_activity'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-blue-600 font-medium">Last 7 days</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
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
                            <option value="DRAFT">Draft</option>
                            <option value="SUBMITTED">Submitted</option>
                            <option value="CF_QUOTATION">CF Quotations</option>
                            <option value="CF_SELECTED">CF Selected</option>
                            <option value="LENDER_REVIEW">Lender Review</option>
                            <option value="APPROVED">Approved</option>
                            <option value="REJECTED">Rejected</option>
                            <option value="COMPLETED">Completed</option>
                        </select>

                        @if($statusFilter || $searchTerm)
                        <button wire:click="clearFilters" 
                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Clear
                        </button>
                        @endif
                    </div>

                    <!-- Bulk Actions -->
                    @if(count($selectedApplications) > 0)
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700">{{ count($selectedApplications) }} selected</span>
                        <select wire:change="bulkAction($event.target.value)" 
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md">
                            <option value="">Bulk Actions</option>
                            <option value="export">Export Selected</option>
                            <option value="archive">Archive Selected</option>
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <div class="min-w-full divide-y divide-gray-200">
                @if($applications->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" wire:model="selectAll" 
                                       class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" 
                                wire:click="sortBy('application_number')">
                                <div class="flex items-center space-x-1">
                                    <span>Application #</span>
                                    @if($sortBy === 'application_number')
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            @if($sortDirection === 'asc')
                                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                            @else
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            @endif
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vehicle Details
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" 
                                wire:click="sortBy('cif_value_usd')">
                                <div class="flex items-center space-x-1">
                                    <span>CIF Value</span>
                                    @if($sortBy === 'cif_value_usd')
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            @if($sortDirection === 'asc')
                                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                            @else
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            @endif
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Progress
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" 
                                wire:click="sortBy('status')">
                                <div class="flex items-center space-x-1">
                                    <span>Status</span>
                                    @if($sortBy === 'status')
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            @if($sortDirection === 'asc')
                                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                            @else
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            @endif
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" 
                                wire:click="sortBy('created_at')">
                                <div class="flex items-center space-x-1">
                                    <span>Applied</span>
                                    @if($sortBy === 'created_at')
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            @if($sortDirection === 'asc')
                                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                            @else
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            @endif
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $application)
                        <tr class="hover:bg-gray-50 {{ in_array($application->id, $selectedApplications) ? 'bg-blue-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" wire:model="selectedApplications" value="{{ $application->id }}" 
                                       class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $application->application_number }}</div>
                                <div class="text-sm text-gray-500">{{ $application->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $application->vehicle_make }} {{ $application->vehicle_model }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $application->vehicle_year }} • {{ $application->vehicle_color }}
                                </div>
                                <div class="text-xs text-gray-400 font-mono">
                                    VIN: {{ substr($application->vehicle_vin, 0, 8) }}***
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($application->cif_value_usd, 2) }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    TZS {{ number_format($application->cif_value_tzs) }}
                                </div>
                                @if($application->total_duty_amount)
                                <div class="text-xs text-green-600 font-medium">
                                    Duty: TZS {{ number_format($application->total_duty_amount) }}
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
                                            <span>{{ $application->getProgressPercentage() }}%</span>
                                            <span>{{ $application->getCurrentStepText() }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full transition-all duration-300" 
                                                 style="width: {{ $application->getProgressPercentage() }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 flex items-center space-x-2 text-xs">
                                    @if($application->cfQuotations->count() > 0)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $application->cfQuotations->count() }} CF Quotes
                                    </span>
                                    @endif
                                    @if($application->lenderOffers->count() > 0)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $application->lenderOffers->count() }} Offers
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $application->getStatusBadgeClass() }}">
                                    {{ $application->getCurrentStepText() }}
                                </span>
                                @if(in_array($application->status, ['CF_QUOTATION', 'LENDER_REVIEW']))
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Action Required
                                    </span>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $application->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-400">
                                    {{ $application->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('import.duty.tracking', $application->id) }}" 
                                       class="text-green-600 hover:text-green-900 font-medium">
                                        View
                                    </a>
                                    @if($application->status === 'CF_QUOTATION' && $application->cfQuotations->where('status', 'SUBMITTED')->count() > 0)
                                    <a href="" 
                                       class="text-purple-600 hover:text-purple-900 font-medium">
                                        Compare
                                    </a>
                                    @endif
                                    @if($application->status === 'LENDER_REVIEW' && $application->lenderOffers->where('status', 'SUBMITTED')->count() > 0)
                                    <a href="" 
                                       class="text-blue-600 hover:text-blue-900 font-medium">
                                        Offers
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $applications->links() }}
                </div>
                @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No applications found</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if($searchTerm || $statusFilter)
                            No applications match your current filters.
                        @else
                            You haven't submitted any import duty applications yet.
                        @endif
                    </p>
                    <div class="mt-6">
                        @if($searchTerm || $statusFilter)
                            <button wire:click="clearFilters" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Clear Filters
                            </button>
                        @else
                            <a href="{{ route('import-duty.apply') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                New Application
                            </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($applications->count() > 0)
        <!-- Quick Stats Summary -->
        <div class="mt-8 bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Application Summary by Status</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['submitted'] }}</div>
                    <div class="text-sm text-gray-500">Submitted</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-purple-600">{{ $stats['cf_quotation'] }}</div>
                    <div class="text-sm text-gray-500">CF Review</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-indigo-600">{{ $stats['cf_selected'] }}</div>
                    <div class="text-sm text-gray-500">CF Selected</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $stats['lender_review'] }}</div>
                    <div class="text-sm text-gray-500">Lender Review</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $stats['approved'] }}</div>
                    <div class="text-sm text-gray-500">Approved</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</div>
                    <div class="text-sm text-gray-500">Rejected</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-800">{{ $stats['completed'] }}</div>
                    <div class="text-sm text-gray-500">Completed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-400">{{ $stats['draft'] }}</div>
                    <div class="text-sm text-gray-500">Drafts</div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Timeline (for mobile) -->
        <div class="mt-8 bg-white shadow rounded-lg p-6 lg:hidden">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
            <div class="space-y-4">
                @foreach($applications->take(3) as $application)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $application->application_number }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $application->vehicle_make }} {{ $application->vehicle_model }} - {{ $application->getCurrentStepText() }}
                        </p>
                        <p class="text-xs text-gray-400">
                            {{ $application->updated_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Loading indicator -->
    <div wire:loading class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-25">
        <div class="bg-white rounded-lg p-4 flex items-center space-x-2">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-green-600"></div>
            <span class="text-gray-700">Loading...</span>
        </div>
    </div>
</div>

</div>
