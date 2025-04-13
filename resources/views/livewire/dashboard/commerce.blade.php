<div class="bg-white ">
    {{-- The Master doesn't talk, he acts. --}}

    <div class="py-6  min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900"> Dashboard</h1>
                <p class="mt-1 text-sm text-gray-600">
                    Financial performance and loan statistics overview
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
               
               
            </div>
        </div>

        <!-- Key Metrics Section -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <!-- Total Loan Value -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Loan Value</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">TZS {{ number_format($loanAmount,2) }}</div>
                                    <div class="flex items-baseline">
                                        <span class="text-sm text-green-600 font-semibold">+12.3%</span>
                                        <span class="ml-1 text-xs text-gray-500">from last month</span>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Loans -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Loans</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">{{ $activeLoan }}</div>
                                    <div class="flex items-baseline">
                                        <span class="text-sm text-green-600 font-semibold">+8.7%</span>
                                        <span class="ml-1 text-xs text-gray-500">from last month</span>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Average Loan Amount -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Average Loan Amount</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">TZS  {{ $loanAmount/12 }}</div>
                                    <div class="flex items-baseline">
                                        <span class="text-sm text-green-600 font-semibold">+3.2%</span>
                                        <span class="ml-1 text-xs text-gray-500">from last month</span>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Repayment Rate -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Repayment Rate</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">94.7%</div>
                                    <div class="flex items-baseline">
                                        <span class="text-sm text-green-600 font-semibold">+1.2%</span>
                                        <span class="ml-1 text-xs text-gray-500">from last month</span>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      

        <!-- Second Row of Charts/Tables -->
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-1 mb-8">
            <!-- Recent Applications -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Recent Loan Applications</h3>
                    <a href="#" class="text-sm font-medium text-green-600 hover:text-green-500">View all</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Applicant
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Vehicle
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($applicationList as $application)

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $application->first_name.' '.$application->last_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->created_at }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $application->make_and_model }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->year_of_manufacture }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">TZS {{  number_format($application->loan_amount,2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $application->application_status }}
                                    </span>
                                </td>
                            </tr>


                            @empty

                          no data

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

          
        </div>

     
    </div>

</div>
