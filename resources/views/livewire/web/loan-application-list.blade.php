<div>
<!-- resources/views/livewire/client-loan-applications.blade.php -->
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">My Loan Applications</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <div class="max-w-6xl mx-auto space-y-8">


        <!-- Import Duty Application Card -->
        <div class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-xl p-6 shadow-sm">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Import Duty Financing</h3>
                        <p class="text-sm text-gray-600">Apply for vehicle import duty financing to get your car on the road faster</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ url('import-duty') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200 shadow-sm w-full sm:w-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Application
                    </a>
                    <a href="{{ route('import.duty.applications') }}" 
                       class="inline-flex items-center justify-center px-4 py-3 border border-green-300 text-sm font-medium rounded-lg text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200 w-full sm:w-auto">
                        View All
                    </a>
                </div>
            </div>
        </div>



            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between flex-wrap">
                <h1 class="text-2xl font-bold text-gray-900">My Loan Applications</h1>



                
                <div class="w-full sm:w-auto">
                    <label class="sr-only" for="loan-status-filter">Filter by status</label>
                    <div class="relative">
                        <select id="loan-status-filter" wire:model="statusFilter" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 pr-10">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="processing">Processing</option>
                            <option value="disbursed">Disbursed</option>
                        </select>
                        <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($applications) > 0)
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Application ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vehicle
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lender
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Loan Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date Applied
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($applications as $application)
                                @php
                                    $statusKey = strtolower($application->application_status);
                                    $statusStyles = [
                                        'pending' => ['bg-yellow-100 text-yellow-800', 'Pending'],
                                        'approved' => ['bg-green-100 text-green-800', 'Approved'],
                                        'accepted' => ['bg-green-100 text-green-800', 'Approved'],
                                        'rejected' => ['bg-red-100 text-red-800', 'Rejected'],
                                        'processing' => ['bg-blue-100 text-blue-800', 'Processing'],
                                        'new client' => ['bg-green-100 text-green-800', 'Processing'],
                                        'disbursed' => ['bg-purple-100 text-purple-800', 'Disbursed'],
                                    ];
                                    $badgeClass = $statusStyles[$statusKey][0] ?? 'bg-purple-100 text-purple-800';
                                    $statusText = $statusStyles[$statusKey][1] ?? 'Processing';
                                @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ $application->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $application->make_and_model }} ({{ $application->year_of_manufacture }})
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ optional($application->lender) ->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            TZS {{ number_format($application->loan_amount) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $application->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <a href="{{ route('application.status',$application->id) }}" class="text-green-600 hover:text-green-900 mr-3">View Details</a>
                                            
                                            @if(strtolower($application->application_status) === 'approved')
                                                <a href="{{ route('loan.agreement', $application->id) }}" class="text-blue-600 hover:text-blue-900">Loan Agreement</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile-friendly cards -->
                <div class="space-y-4 lg:hidden">
                    @foreach($applications as $application)
                        @php
                            $statusKey = strtolower($application->application_status);
                            $statusStyles = [
                                'pending' => ['bg-yellow-100 text-yellow-800', 'Pending'],
                                'approved' => ['bg-green-100 text-green-800', 'Approved'],
                                'accepted' => ['bg-green-100 text-green-800', 'Approved'],
                                'rejected' => ['bg-red-100 text-red-800', 'Rejected'],
                                'processing' => ['bg-blue-100 text-blue-800', 'Processing'],
                                'new client' => ['bg-green-100 text-green-800', 'Processing'],
                                'disbursed' => ['bg-purple-100 text-purple-800', 'Disbursed'],
                            ];
                            $badgeClass = $statusStyles[$statusKey][0] ?? 'bg-purple-100 text-purple-800';
                            $statusText = $statusStyles[$statusKey][1] ?? 'Processing';
                        @endphp
                        <div class="bg-white rounded-xl shadow-md p-5 space-y-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Application</p>
                                    <p class="text-lg font-semibold text-gray-900">#{{ $application->id }}</p>
                                </div>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                    {{ $statusText }}
                                </span>
                            </div>
                            <div class="space-y-3 text-sm text-gray-700">
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-500">Vehicle</span>
                                    <span class="text-right font-medium text-gray-900">{{ $application->make_and_model }} ({{ $application->year_of_manufacture }})</span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-500">Lender</span>
                                    <span class="text-right font-medium text-gray-900">{{ optional($application->lender) ->name }}</span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-500">Loan Amount</span>
                                    <span class="text-right font-semibold text-gray-900">TZS {{ number_format($application->loan_amount) }}</span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-500">Applied</span>
                                    <span class="text-right text-gray-900">{{ $application->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('application.status',$application->id) }}" class="inline-flex w-full sm:w-auto items-center justify-center px-4 py-2 rounded-lg border border-green-200 text-sm font-medium text-green-700 hover:bg-green-50">
                                    View Details
                                </a>
                                @if(strtolower($application->application_status) === 'approved')
                                    <a href="{{ route('loan.agreement', $application->id) }}" class="inline-flex w-full sm:w-auto items-center justify-center px-4 py-2 rounded-lg border border-blue-200 text-sm font-medium text-blue-700 hover:bg-blue-50">
                                        Loan Agreement
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $applications->links() }}
                </div>
                
            @else
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-medium text-gray-900 mb-2">No Loan Applications Yet</h2>
                    <p class="text-gray-600 mb-6">You haven't applied for any vehicle loans yet.</p>
                    <a href="{{ route('vehicle.list') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Browse Vehicles
                    </a>
                </div>
            @endif
            
            <!-- Quick Stats -->
            @if(count($applications) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Total Applications</div>
                                <div class="text-xl font-bold text-gray-900">{{ count($applications) }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Pending</div>
                                <div class="text-xl font-bold text-gray-900">{{ $pendingCount }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Approved</div>
                                <div class="text-xl font-bold text-gray-900">{{ $approvedCount }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Rejected</div>
                                <div class="text-xl font-bold text-gray-900">{{ $rejectedCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

</div>
