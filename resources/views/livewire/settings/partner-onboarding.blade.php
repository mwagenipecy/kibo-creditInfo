<div>

      <!-- Partner Onboarding System - Improved Version -->
<div class="min-h-screen bg-white ">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-green-800">Partner Onboarding System</h1>
                <div class="flex space-x-4">
                    
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="px-4 mx-auto  sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Lenders -->
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
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Lenders
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ count($lenders) }}
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Increased by</span>
                                        12%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
             
            </div>

            <!-- Total Car Dealers -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Car Dealers
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ count($carDealers) }}
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Increased by</span>
                                        8%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
               
            </div>

            <!-- Pending Approvals -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Pending Approvals
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ count(array_filter($lenders->toArray(), function($lender) { return $lender['status'] === 'PENDING'; })) + 
                                           count(array_filter($carDealers->toArray(), function($dealer) { return $dealer['status'] === 'PENDING'; })) }}
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Increased by</span>
                                        5
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>

       




        <!-- Car Dealer Option -->
         <div class="flex gap-6 space-x-4">

         <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm hover:border-gray-400 hover:ring-1 hover:ring-gray-400 focus-within:ring-2 focus-within:ring-green-500 focus-within:ring-offset-2 cursor-pointer" wire:click="selectPartnerType('carDealer')">
    <div class="flex items-center">
        <div class="flex-shrink-0 bg-green-100 rounded-md p-2">
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
            </svg>
        </div>
        <div class="ml-3">
            <h3 class="text-lg font-medium text-gray-900">Car Dealer</h3>
            <p class="text-sm text-gray-500">New/Used Car Dealerships</p>
        </div>
    </div>
</div>


<div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm hover:border-gray-400 hover:ring-1 hover:ring-gray-400 focus-within:ring-2 focus-within:ring-green-500 focus-within:ring-offset-2 cursor-pointer" wire:click="openLenderModal" >
    <div class="flex items-center">
        <div class="flex-shrink-0 bg-green-100 rounded-md p-2">
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="ml-3">
            <h3 class="text-lg font-medium text-gray-900">Lenders</h3>
            <p class="text-sm text-gray-500">New Lender / Lender Onboarding </p>
        </div>
    </div>
</div>



         </div>





        <!-- Tabs for Lenders/Car Dealers -->
        <div class="mb-8">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <select id="tabs" name="tabs" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                    <option selected>Lenders</option>

                    <option>Car Dealers</option>
                    <option>Pending Approvals</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button wire:click="setPageId(1)"  class=" @if($this->setPageId==1) border-green-500 text-green-600 border-b-2  @endif  whitespace-nowrap py-4 px-1  font-medium text-sm" aria-current="page">
                            Lenders
                        </button>

                        <button wire:click="setPageId(2)" class="   @if($this->setPageId==2) border-green-500 text-green-600 border-b-2  @endif   text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Car Dealers
                        </button>

                      

                    </nav>
                </div>
            </div>
        </div>


        @if($this->setPageId==1)
        <!-- Lender List -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md mb-8">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Registered Lenders</h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">A list of all registered financial institutions</p>
                </div>
                <div>
                    <button type="button" wire:click="openLenderModal" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Lender
                    </button>
                </div>
            </div>
            <div class="bg-white overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Institution
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact Person
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Onboarding Date
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($lenders as $lender)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($lender['logo'])
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $lender['logo']) }}" alt="{{ $lender['name'] }} logo">

                                            @else
                                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                    <span class="text-green-700 font-semibold text-sm">{{ substr($lender['name'], 0, 2) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $lender['name'] }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $lender['email'] }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $lender['lenderType'] }}</div>
                                    <div class="text-sm text-gray-500">License: {{ $lender['financialLicenseNumber'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $lender['city'] }}, {{ $lender['region'] }}</div>
                                    <div class="text-sm text-gray-500">{{ $lender['country'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $lender['contact_person_name'] }}  - {{ $lender['contact_person_email'] }}   </div>
                                    <div class="text-sm text-gray-500">{{ $lender['contact_person_position'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($lender['status'] === 'APPROVED')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                    @elseif($lender['status'] === 'PENDING')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($lender['status'] === 'REJECTED')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $lender['created_at']->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                       
                                   <!-- Improved Lender Action Buttons with Better UI/UX -->
<div class="flex space-x-2">
    <!-- Edit Button -->
    <button 
        wire:click="editLender({{ $lender['id'] }})"
        wire:loading.attr="disabled"
        class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        <span wire:loading.remove wire:target="editLender({{ $lender['id'] }})">Edit</span>
        <span wire:loading wire:target="editLender({{ $lender['id'] }})">Editing...</span>
    </button>
    
    <!-- Approve Button (Only shown for PENDING lenders) -->
    @if($lender['status'] === 'PENDING')
        <button 
            wire:click="approveLender({{ $lender['id'] }})"
            wire:loading.attr="disabled"
            wire:confirm="Are you sure you want to approve this lender?"
            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span wire:loading.remove wire:target="approveLender({{ $lender['id'] }})">Approve</span>
            <span wire:loading wire:target="approveLender({{ $lender['id'] }})">Approving...</span>
        </button>
    @endif
</div>




                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <!-- Pagination -->
                <nav class="flex items-center justify-between" aria-label="Pagination">
                    <div class="hidden sm:block">
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ count($lenders) }}</span> results
                        </p>
                    </div>
                    <div class="flex-1 flex justify-between sm:justify-end">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        @endif 



        @if($this->setPageId==2)

<!-- Car Dealer List -->
<div class="bg-white shadow overflow-hidden sm:rounded-md mb-8">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h2 class="text-lg leading-6 font-medium text-gray-900">Registered Car Dealers</h2>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">A list of all registered car dealerships</p>
        </div>
        <div>
            <button type="button" wire:click="openCarDealerModal" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New Car Dealer
            </button>
        </div>
    </div>
    
    <!-- Search and Filters -->
    <div class="px-4 py-3 border-b border-gray-200 sm:px-6 bg-gray-50">
        <div class="flex flex-col sm:flex-row justify-between space-y-3 sm:space-y-0 sm:space-x-4">
            <div class="flex-1">
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" wire:model.debounce.300ms="search" class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search dealers...">
                </div>
            </div>
            <div class="flex flex-wrap justify-end space-x-2">
                <select wire:model="statusFilter" class="block w-full sm:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                    <option value="">All Statuses</option>
                    <option value="APPROVED">Approved</option>
                    <option value="PENDING">Pending</option>
                    <option value="REJECTED">Rejected</option>
                </select>
                <select wire:model="regionFilter" class="block w-full sm:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                    <option value="">All Regions</option>
                    @foreach($regions as $regionName)
                        <option value="{{ $regionName }}">{{ $regionName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
    <div class="bg-white overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Dealership
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type & Brands
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Contact Person
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Since
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($filteredCarDealers as $dealer)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($dealer->logo)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($dealer->logo) }}" alt="{{ $dealer->name }} logo">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <span class="text-green-700 font-semibold text-sm">{{ substr($dealer->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $dealer->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $dealer->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $dealer->dealer_type }}</div>
                            <div class="text-sm text-gray-500">
                                @if(is_string($dealer->brands_sold) && $brands = json_decode($dealer->brands_sold, true))
                                    {{ count($brands) > 2 ? implode(', ', array_slice($brands, 0, 2)) . ' +' . (count($brands) - 2) : implode(', ', $brands) }}
                                @else
                                    {{ is_array($dealer->brands_sold) ? (count($dealer->brands_sold) > 2 ? implode(', ', array_slice($dealer->brands_sold, 0, 2)) . ' +' . (count($dealer->brands_sold) - 2) : implode(', ', $dealer->brands_sold)) : 'No brands specified' }}
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $dealer->city }}, {{ $dealer->region }}</div>
                            <div class="text-sm text-gray-500">{{ $dealer->country }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $dealer->contact_person_name }}</div>
                            <div class="text-sm text-gray-500">{{ $dealer->contact_person_position ?: 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dealer->status === 'APPROVED')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @elseif($dealer->status === 'PENDING')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($dealer->status === 'REJECTED')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $dealer->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900" 
                                        wire:click="editCarDealer({{ $dealer->id }})"
                                        wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-wait"
                                        wire:target="editCarDealer({{ $dealer->id }})">
                                            <span wire:loading.remove wire:target="editCarDealer({{ $dealer->id }})">Edit</span>
                                            <span wire:loading wire:target="editCarDealer({{ $dealer->id }})">
                                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-indigo-600 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Loading...
                                            </span>
                                        </a>

                                @if($dealer->status === 'PENDING')
                                    <a href="#" class="text-green-600 hover:text-green-900" 
                                    wire:click="approveCarDealer({{ $dealer->id }})"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50 cursor-wait"
                                    wire:target="approveCarDealer({{ $dealer->id }})">
                                        <span wire:loading.remove wire:target="approveCarDealer({{ $dealer->id }})">Approve</span>
                                        <span wire:loading wire:target="approveCarDealer({{ $dealer->id }})">
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-green-600 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Approving...
                                        </span>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No car dealers found. <a href="#" wire:click="openCarDealerModal" class="text-green-600 hover:text-green-900">Add a new one</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

   

    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <!-- Pagination -->
        @if ($activeTab === 'carDealer' || $setPageId === 2)
    @if ($filteredCarDealers && count($filteredCarDealers) > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <!-- Table header -->
            <thead>...</thead>
            <tbody>
                @foreach($filteredCarDealers as $dealer)
                    <!-- Car dealer rows -->
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="hidden sm:block">
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{ $filteredCarDealers->firstItem() ?: 0 }}</span>
                        to
                        <span class="font-medium">{{ $filteredCarDealers->lastItem() ?: 0 }}</span>
                        of
                        <span class="font-medium">{{ $filteredCarDealers->total() }}</span>
                        results
                    </p>
                </div>
                <div class="flex-1 flex justify-between sm:justify-end">
                    {{ $filteredCarDealers->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">No car dealers found matching your criteria.</p>
        </div>
    @endif
@endif


    </div>


</div>
@endif 



        
    </main>



    <!-- Lender Registration Modal -->
    <div class="@if($showLenderModal) fixed @else hidden @endif inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <!-- Modal header -->
                <div class="bg-green-600 px-4 py-3 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">
                        {{ $isEditMode ? 'Edit Lender' : 'Register New Lender' }}
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Modal content with stepper -->
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 max-h-[70vh] overflow-y-auto">
                    <!-- Stepper navigation -->
                    <div class="mb-8">
                        <nav class="flex items-center justify-between" aria-label="Progress">
                            <ol role="list" class="space-y-3 md:flex md:space-y-0 md:space-x-8">
                                <li class="md:flex-1">
                                    <button wire:click="setStep(1)" class="flex flex-col border-l-4 md:border-l-0 md:border-t-4 @if($currentStep==1) border-green-600 @else border-gray-200  @endif  py-2 pl-4 md:pl-0 md:pt-4 md:pb-0">
                                        <span class="text-xs text-green-600 font-semibold tracking-wide uppercase">Step 1</span>
                                        <span class="text-sm font-medium">Basic Information</span>
                                    </button>
                                </li>
                                <li class="md:flex-1">
                                    <button wire:click="setStep(2)" class="flex flex-col border-l-4 md:border-l-0 md:border-t-4  @if($currentStep==2) border-green-600 @else border-gray-200  @endif  py-2 pl-4 md:pl-0 md:pt-4 md:pb-0">
                                        <span class="text-xs text-gray-500 font-semibold tracking-wide uppercase">Step 2</span>
                                        <span class="text-sm font-medium">Financial Details</span>
                                    </button>
                                </li>
                                <li class="md:flex-1">
                                    <button wire:click="setStep(3)" class="flex flex-col border-l-4 md:border-l-0 md:border-t-4  @if($currentStep==3) border-green-600 @else border-gray-200  @endif  py-2 pl-4 md:pl-0 md:pt-4 md:pb-0">
                                        <span class="text-xs text-gray-500 font-semibold tracking-wide uppercase">Step 3</span>
                                        <span class="text-sm font-medium">Documentation</span>
                                    </button>
                                </li>
                                <li class="md:flex-1">
                                    <button wire:click="setStep(4)" class="flex flex-col border-l-4 md:border-l-0 md:border-t-4 @if($currentStep==4) border-green-600 @else border-gray-200  @endif   py-2 pl-4 md:pl-0 md:pt-4 md:pb-0">
                                        <span class="text-xs text-gray-500 font-semibold tracking-wide uppercase">Step 4</span>
                                        <span class="text-sm font-medium">Review & Submit</span>
                                    </button>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <form wire:submit.prevent="registerLender">
                        <!-- Step 1: Basic Information (shown by default) -->
                        <div class="@if($currentStep === 1) block @else hidden @endif">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Institution Information -->
                                <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                                    <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Institution Information
                                    </h4>
                                    <div class="space-y-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700">Institution Name</label>
                                            <input type="text" id="name" wire:model.defer="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            @error('name') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="businessRegistrationNumber" class="block text-sm font-medium text-gray-700">Business Registration Number</label>
                                                <input type="number" id="businessRegistrationNumber" wire:model.defer="businessRegistrationNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                                @error('businessRegistrationNumber') 
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="taxIdentificationNumber" class="block text-sm font-medium text-gray-700">Tax Identification Number</label>
                                                <input type="number" id="taxIdentificationNumber" wire:model.defer="taxIdentificationNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                                @error('taxIdentificationNumber') 
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                                <input type="text" id="phoneNumber" wire:model.defer="phoneNumber" placeholder="+255XXXXXXXXX" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                                @error('phoneNumber') 
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                                <input type="email" id="email" wire:model.defer="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                                @error('email') 
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="website" class="block text-sm font-medium text-gray-700">Website (Optional)</label>
                                            <input type="url" id="website" wire:model.defer="website" placeholder="https://example.com" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Location Information -->
                                <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                                    <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        Location Information
                                    </h4>
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                                                <select id="region" wire:model="region" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                                    <option value="">Select Region</option>
                                                    @foreach($regions as $regionName)
                                                        <option value="{{ $regionName }}">{{ $regionName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('region') 
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="city" class="block text-sm font-medium text-gray-700">City/District</label>
                                                <select id="city" wire:model.defer="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                                    <option value="">Select City/District</option>
                                                    @foreach($cities as $cityName)
                                                        <option value="{{ $cityName }}">{{ $cityName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city') 
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="address" class="block text-sm font-medium text-gray-700">Street Address</label>
                                            <input type="text" id="address" wire:model.defer="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            @error('address') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="postalCode" class="block text-sm font-medium text-gray-700">Postal Code (Optional)</label>
                                                <input type="text" id="postalCode" wire:model.defer="postalCode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            </div>
                                            
                                            <div>
                                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                                <input type="text" id="country" wire:model.defer="country" value="Tanzania" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 bg-gray-100" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contact Person Information -->
                            <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                                <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    Contact Person Information
                                </h4>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div class="space-y-4">
                                        <div>
                                            <label for="contactPersonName" class="block text-sm font-medium text-gray-700">Full Name</label>
                                            <input type="text" id="contactPersonName" wire:model.defer="contactPersonName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            @error('contactPersonName') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="contactPersonPosition" class="block text-sm font-medium text-gray-700">Position</label>
                                            <input type="text" id="contactPersonPosition" wire:model.defer="contactPersonPosition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            @error('contactPersonPosition') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="contactPersonPhone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                            <input type="text" id="contactPersonPhone" wire:model.defer="contactPersonPhone" placeholder="+255XXXXXXXXX" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            @error('contactPersonPhone') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="contactPersonEmail" class="block text-sm font-medium text-gray-700">Email Address</label>
                                            <input type="email" id="contactPersonEmail" wire:model.defer="contactPersonEmail" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            @error('contactPersonEmail') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2: Financial Details -->
                        <div class="@if($currentStep === 2) block @else hidden @endif">
                            <!-- Lender Specific Information -->
                            <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                                <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    Financial Institution Details
                                </h4>
                                <div class="space-y-4">
                                    <div>
                                        <label for="lenderType" class="block text-sm font-medium text-gray-700">Lender Type</label>
                                        <select id="lenderType" wire:model.defer="lenderType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            <option value="">Select Type</option>
                                            <option value="Bank">Bank</option>
                                            <option value="Microfinance">Microfinance Institution</option>
                                            <option value="Credit Union">Credit Union</option>
                                            <option value="SACCO">SACCO</option>
                                            <option value="Other">Other Financial Institution</option>
                                        </select>
                                        @error('lenderType') 
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="financialLicenseNumber" class="block text-sm font-medium text-gray-700">Financial License Number</label>
                                        <input type="text" id="financialLicenseNumber" wire:model.defer="financialLicenseNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        @error('financialLicenseNumber') 
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Loan Terms -->
                            <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                                <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg>
                                    Loan Terms and Conditions
                                </h4>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="minimumLoanAmount" class="block text-sm font-medium text-gray-700">Minimum Loan Amount (TZS)</label>
                                            <input type="number" id="minimumLoanAmount" wire:model.defer="minimumLoanAmount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            @error('minimumLoanAmount') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="maximumLoanAmount" class="block text-sm font-medium text-gray-700">Maximum Loan Amount (TZS)</label>
                                            <input type="number" id="maximumLoanAmount" wire:model.defer="maximumLoanAmount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                            @error('maximumLoanAmount') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="interestRateRange" class="block text-sm font-medium text-gray-700">Interest Rate Range (%)</label>
                                            <input type="text" id="interestRateRange" wire:model.defer="interestRateRange" placeholder="e.g., 12-18" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            @error('interestRateRange') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="loanTermsRange" class="block text-sm font-medium text-gray-700">Loan Terms Range (months)</label>
                                            <input type="text" id="loanTermsRange" wire:model.defer="loanTermsRange" placeholder="e.g., 6-36" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            @error('loanTermsRange') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Banking Details -->
                            <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                                <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Banking Details
                                </h4>
                                <div class="space-y-4">
                                    <div>
                                        <label for="bankAccountDetails" class="block text-sm font-medium text-gray-700">Bank Account Details</label>
                                        <textarea id="bankAccountDetails" wire:model.defer="bankAccountDetails" rows="3" placeholder="Bank name, Account number, Branch, etc." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"></textarea>
                                        @error('bankAccountDetails') 
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="paymentMethods" class="block text-sm font-medium text-gray-700">Accepted Payment Methods</label>
                                            <div class="mt-2 space-y-2">
                                                <div class="flex items-center">
                                                    <input id="paymentMethod1" name="paymentMethods[]" type="checkbox" wire:model.defer="paymentMethods" value="Bank Transfer" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                                    <label for="paymentMethod1" class="ml-2 block text-sm text-gray-700">Bank Transfer</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="paymentMethod2" name="paymentMethods[]" type="checkbox" wire:model.defer="paymentMethods" value="Mobile Money" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                                    <label for="paymentMethod2" class="ml-2 block text-sm text-gray-700">Mobile Money</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="paymentMethod3" name="paymentMethods[]" type="checkbox" wire:model.defer="paymentMethods" value="Cheque" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                                    <label for="paymentMethod3" class="ml-2 block text-sm text-gray-700">Cheque</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="paymentMethod4" name="paymentMethods[]" type="checkbox" wire:model.defer="paymentMethods" value="Cash" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                                    <label for="paymentMethod4" class="ml-2 block text-sm text-gray-700">Cash</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="settlementPeriod" class="block text-sm font-medium text-gray-700">Settlement Period (days)</label>
                                            <input type="number" id="settlementPeriod" wire:model.defer="settlementPeriod" placeholder="e.g., 3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            @error('settlementPeriod') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        
       <!-- Step 3: Documentation -->
<div class="@if($currentStep === 3) block @else hidden @endif">
    <div class="mb-6 p-4 border border-gray-200 rounded-lg">
        <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
            </svg>
            Required Documents
        </h4>
        <p class="text-sm text-gray-500 mb-4">Please upload the following documents in PDF, JPG, or PNG format. Maximum file size: 5MB per document.</p>
        
        <div class="space-y-6">
            <!-- Business Registration Certificate -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Business Registration Certificate</label>
                
                <div class="mt-1 flex items-center">
                    <input type="file" id="businessRegistrationDoc" wire:model="businessRegistrationDoc" 
                        class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                    
                    <label for="businessRegistrationDoc" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Select File
                    </label>
                    
                    @if ($businessRegistrationDoc)
                        <span class="ml-2 text-sm text-green-600">File selected: {{ $businessRegistrationDoc->getClientOriginalName() }}</span>
                    @elseif ($isEditMode && !$businessRegistrationDoc && isset($existingBusinessRegistrationDoc))
                        <span class="ml-2 text-sm text-gray-600">Current file will be retained</span>
                    @else
                        <span class="ml-2 text-sm text-gray-500">Required</span>
                    @endif
                </div>

                <!-- Preview/Download Section for Business Registration -->
                @if ($isEditMode && isset($existingBusinessRegistrationDoc) && !$businessRegistrationDoc)
                    <div class="mt-2 p-3 bg-gray-50 rounded-md border">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ basename($existingBusinessRegistrationDoc) }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <!-- Preview Button -->
                                <button type="button" 
                                    wire:click="previewDocument('businessRegistrationDoc')"
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview
                                </button>
                                <!-- Download Button -->
                                <a href="{{ route('document.download', ['type' => 'businessRegistrationDoc', 'id' => $recordId ?? 0]) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-600 bg-green-100 rounded hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="businessRegistrationDoc" class="mt-1 text-sm text-gray-500">
                    Uploading...
                </div>
                @error('businessRegistrationDoc') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tax Clearance Certificate -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tax Clearance Certificate</label>
              
                <div class="mt-1 flex items-center">
                    <input type="file" id="taxClearanceDoc" wire:model="taxClearanceDoc" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                    <label for="taxClearanceDoc" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Select File
                    </label>
                    @if ($taxClearanceDoc)
                        <span class="ml-2 text-sm text-green-600">File selected: {{ $taxClearanceDoc->getClientOriginalName() }}</span>
                    @elseif ($isEditMode && !$taxClearanceDoc && isset($existingTaxClearanceDoc))
                        <span class="ml-2 text-sm text-gray-600">Current file will be retained</span>
                    @else
                        <span class="ml-2 text-sm text-gray-500">Required</span>
                    @endif
                </div>

                <!-- Preview/Download Section for Tax Clearance -->
                @if ($isEditMode && isset($existingTaxClearanceDoc) && !$taxClearanceDoc)
                    <div class="mt-2 p-3 bg-gray-50 rounded-md border">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ basename($existingTaxClearanceDoc) }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button" 
                                    wire:click="previewDocument('taxClearanceDoc')"
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview
                                </button>
                                <a href="{{ route('document.download', ['type' => 'taxClearanceDoc', 'id' => $recordId ?? 0]) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-600 bg-green-100 rounded hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="taxClearanceDoc" class="mt-1 text-sm text-gray-500">
                    Uploading...
                </div>
                @error('taxClearanceDoc') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Financial License -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Financial License</label>
                
                <div class="mt-1 flex items-center">
                    <input type="file" id="financialLicenseDoc" wire:model="financialLicenseDoc" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                    <label for="financialLicenseDoc" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Select File
                    </label>
                    @if ($financialLicenseDoc)
                        <span class="ml-2 text-sm text-green-600">File selected: {{ $financialLicenseDoc->getClientOriginalName() }}</span>
                    @elseif ($isEditMode && !$financialLicenseDoc && isset($existingFinancialLicenseDoc))
                        <span class="ml-2 text-sm text-gray-600">Current file will be retained</span>
                    @else
                        <span class="ml-2 text-sm text-gray-500">Required</span>
                    @endif
                </div>

                <!-- Preview/Download Section for Financial License -->
                @if ($isEditMode && isset($existingFinancialLicenseDoc) && !$financialLicenseDoc)
                    <div class="mt-2 p-3 bg-gray-50 rounded-md border">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ basename($existingFinancialLicenseDoc) }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button" 
                                    wire:click="previewDocument('financialLicenseDoc')"
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview
                                </button>
                                <a href="{{ route('document.download', ['type' => 'financialLicenseDoc', 'id' => $recordId ?? 0]) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-600 bg-green-100 rounded hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="financialLicenseDoc" class="mt-1 text-sm text-gray-500">
                    Uploading...
                </div>
                @error('financialLicenseDoc') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Company Logo -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Company Logo (Optional)</label>
               
                <div class="mt-1 flex items-center">
                    <input type="file" id="logo" wire:model="logo" class="hidden" accept="image/*">
                    <label for="logo" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Select Logo
                    </label>
                    @if ($logo)
                        <span class="ml-2 text-sm text-green-600">Logo selected: {{ $logo->getClientOriginalName() }}</span>
                    @elseif ($isEditMode && !$logo && isset($existingLogo))
                        <span class="ml-2 text-sm text-gray-600">Current logo will be retained</span>
                    @else
                        <span class="ml-2 text-sm text-gray-500">Optional</span>
                    @endif
                </div>

                <!-- Preview/Download Section for Logo -->
                @if ($isEditMode && isset($existingLogo) && !$logo)
                    <div class="mt-2 p-3 bg-gray-50 rounded-md border">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ Storage::url($existingLogo) }}" alt="Current Logo" class="h-8 w-8 object-cover rounded mr-2">
                                <span class="text-sm text-gray-700">{{ basename($existingLogo) }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button" 
                                    wire:click="previewDocument('logo')"
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview
                                </button>
                                <a href="{{ route('document.download', ['type' => 'logo', 'id' => $recordId ?? 0]) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-600 bg-green-100 rounded hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="logo" class="mt-1 text-sm text-gray-500">
                    Uploading...
                </div>
                @error('logo') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Additional Documents -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Additional Documents (Optional)</label>
               
                <div class="mt-1 flex items-center">
                    <input type="file" id="additionalDoc" wire:model="additionalDoc" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                    <label for="additionalDoc" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Select File
                    </label>
                    @if ($additionalDoc)
                        <span class="ml-2 text-sm text-green-600">File selected: {{ $additionalDoc->getClientOriginalName() }}</span>
                    @elseif ($isEditMode && !$additionalDoc && isset($existingAdditionalDoc))
                        <span class="ml-2 text-sm text-gray-600">Current file will be retained</span>
                    @else
                        <span class="ml-2 text-sm text-gray-500">Optional</span>
                    @endif
                </div>

                <!-- Preview/Download Section for Additional Documents -->
                @if ($isEditMode && isset($existingAdditionalDoc) && !$additionalDoc)
                    <div class="mt-2 p-3 bg-gray-50 rounded-md border">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ basename($existingAdditionalDoc) }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button" 
                                    wire:click="previewDocument('additionalDoc')"
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview
                                </button>
                                <a href="{{ route('document.download', ['type' => 'additionalDoc', 'id' => $recordId ?? 0]) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-600 bg-green-100 rounded hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="additionalDoc" class="mt-1 text-sm text-gray-500">
                    Uploading...
                </div>
                @error('additionalDoc') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<!-- Document Preview Modal -->
@if($showPreviewModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closePreview"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Document Preview
                        </h3>
                        <button type="button" 
                            wire:click="closePreview"
                            class="text-gray-400 hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="mt-2">
                        @if($previewDocumentType && $previewDocumentPath)
                            @php
                                $extension = strtolower(pathinfo($previewDocumentPath, PATHINFO_EXTENSION));
                                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $isPdf = $extension === 'pdf';
                            @endphp
                            
                            @if($isImage)
                                <div class="text-center">
                                    <img src="{{ Storage::url($previewDocumentPath) }}" 
                                         alt="Document Preview" 
                                         class="max-w-full h-auto mx-auto rounded-lg shadow-lg"
                                         style="max-height: 70vh;">
                                </div>
                            @elseif($isPdf)
                                <div class="w-full h-96">
                                    <iframe src="{{ Storage::url($previewDocumentPath) }}" 
                                            class="w-full h-full border-0 rounded-lg"
                                            type="application/pdf">
                                        <p class="text-center text-gray-500 py-8">
                                            Your browser doesn't support PDF preview. 
                                            <a href="{{ Storage::url($previewDocumentPath) }}" 
                                               target="_blank" 
                                               class="text-blue-600 hover:text-blue-800 underline">
                                                Click here to download and view the document.
                                            </a>
                                        </p>
                                    </iframe>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-gray-500 mb-4">Preview not available for this file type.</p>
                                    <a href="{{ Storage::url($previewDocumentPath) }}" 
                                       target="_blank" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Download Document
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" 
                        wire:click="closePreview"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                    
                    @if($previewDocumentPath)
                        <a href="{{ route('document.download', ['type' => $previewDocumentType, 'id' => $recordId ?? 0]) }}" 
                           class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif








<!-- Step 4: Review & Submit -->
<div class="@if($currentStep === 4) block @else hidden @endif">
    <div class="mb-6 p-4 border border-gray-200 rounded-lg">
        <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Review Information
        </h4>
        <p class="text-sm text-gray-500 mb-4">Please review all information below before submitting. You can go back to any step to make corrections.</p>
        
        <div class="space-y-6">
            <!-- Basic Information Review -->
            <div class="border-b border-gray-200 pb-4">
                <h5 class="text-md font-medium text-gray-700 mb-2">Basic Information</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Institution Name</p>
                        <p class="text-sm text-gray-900">{{ $name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Business Registration Number</p>
                        <p class="text-sm text-gray-900">{{ $businessRegistrationNumber }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tax Identification Number</p>
                        <p class="text-sm text-gray-900">{{ $taxIdentificationNumber }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Phone Number</p>
                        <p class="text-sm text-gray-900">{{ $phoneNumber }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email Address</p>
                        <p class="text-sm text-gray-900">{{ $email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Website</p>
                        <p class="text-sm text-gray-900">{{ $website ?: 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Address</p>
                        <p class="text-sm text-gray-900">{{ $address }}, {{ $city }}, {{ $region }}, {{ $country }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Person Review -->
            <div class="border-b border-gray-200 pb-4">
                <h5 class="text-md font-medium text-gray-700 mb-2">Contact Person Information</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Full Name</p>
                        <p class="text-sm text-gray-900">{{ $contactPersonName }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Position</p>
                        <p class="text-sm text-gray-900">{{ $contactPersonPosition ?: 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Phone Number</p>
                        <p class="text-sm text-gray-900">{{ $contactPersonPhone }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email Address</p>
                        <p class="text-sm text-gray-900">{{ $contactPersonEmail }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Financial Details Review -->
            <div class="border-b border-gray-200 pb-4">
                <h5 class="text-md font-medium text-gray-700 mb-2">Financial Information</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Lender Type</p>
                        <p class="text-sm text-gray-900">{{ $lenderType }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Financial License Number</p>
                        <p class="text-sm text-gray-900">{{ $financialLicenseNumber ?: 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Loan Amount Range</p>
                        <p class="text-sm text-gray-900">TZS {{ number_format($minimumLoanAmount) }} - TZS {{ number_format($maximumLoanAmount) }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Interest Rate Range</p>
                        <p class="text-sm text-gray-900">{{ $interestRateRange }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Loan Terms Range</p>
                        <p class="text-sm text-gray-900">{{ $loanTermsRange }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Payment Methods</p>
                        <p class="text-sm text-gray-900">{{ count($paymentMethods) > 0 ? implode(', ', $paymentMethods) : 'Not provided' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Documents Review -->
            <div>
                <h5 class="text-md font-medium text-gray-700 mb-2">Uploaded Documents</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Business Registration Certificate</p>
                        <p class="text-sm text-green-600">
                            @if ($businessRegistrationDoc)
                                <svg class="inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                File uploaded
                            @elseif ($isEditMode)
                                <svg class="inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Previously uploaded
                            @else
                                <span class="text-red-600">Document required</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tax Clearance Certificate</p>
                        <p class="text-sm text-green-600">
                            @if ($taxClearanceDoc)
                                <svg class="inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                File uploaded
                            @elseif ($isEditMode)
                                <svg class="inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Previously uploaded
                            @else
                                <span class="text-red-600">Document required</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Financial License</p>
                        <p class="text-sm text-green-600">
                            @if ($financialLicenseDoc)
                                <svg class="inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                File uploaded
                            @elseif ($isEditMode)
                                <svg class="inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Previously uploaded
                            @else
                                <span class="text-red-600">Document required</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Terms and Conditions -->
            <div class="mt-4">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="termsAccepted" wire:model.defer="termsAccepted" type="checkbox" class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="termsAccepted" class="font-medium text-gray-700">I agree to the terms and conditions</label>
                        <p class="text-gray-500">By submitting this form, I certify that all information provided is true and accurate. I understand that false information may result in rejection of the application.</p>
                        @error('termsAccepted') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Modal footer with navigation buttons -->
<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
    @if($currentStep > 1)
        <button type="button" wire:click="prevStep" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm">
            Previous
        </button>
    @endif
    
    @if($currentStep < $totalSteps)
        <button type="button" wire:click="nextStep" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
            Next
        </button>
    @else
        <button type="button" wire:click="registerLender" wire:loading.attr="disabled" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
            <span wire:loading.remove wire:target="registerLender">{{ $isEditMode ? 'Update Lender' : 'Register Lender' }}</span>
            <span wire:loading wire:target="registerLender" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            </span>
        </button>
    @endif
    
    <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
        Cancel
    </button>
</div>




                        
                    </form>
                </div>
            </div>
        </div>
    </div>







    
  





    <!-- Car Dealer Registration Modal -->
<!-- Car Dealer Registration Modal -->

<!-- Car Dealer Registration Modal -->
<div  class="@if($showCarDealerModal) fixed @else hidden @endif inset-0 z-50 overflow-y-auto"  aria-labelledby="car-dealer-modal-title"  role="dialog"  aria-modal="true">
<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
<!-- Background overlay -->
<div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"  wire:click="closeModal" aria-hidden="true"></div>
<!-- Modal panel -->
<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
<!-- Modal header -->
<div class="bg-green-600 px-4 py-3 flex justify-between items-center">
   <h3 class="text-lg leading-6 font-medium text-white" id="car-dealer-modal-title">
      {{ $isEditMode ? 'Edit Car Dealer' : 'Register New Car Dealer' }}
   </h3>
   <button 
      type="button" 
      wire:click="closeModal" 
      class="text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white"
      aria-label="Close modal"
      >
      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
   </button>
</div>





<!-- Modal content with stepper -->
<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 max-h-[70vh] overflow-y-auto">
<!-- Stepper navigation -->
        <div class="mb-8">
        <nav class="flex flex-col md:flex-row" aria-label="Registration progress">
            <ol role="list" class="flex flex-col space-y-3 md:flex-row md:space-y-0 md:space-x-8 w-full">
                @foreach(['Basic Information', 'Dealer Details', 'Documentation', 'Review & Submit'] as $index => $stepName)
                <li class="md:flex-1">
                    <button 
                    type="button"
                    wire:click="setStep({{ $index + 1 }})" 
                    class="group flex flex-col w-full border-l-4 md:border-l-0 md:border-t-4 {{ $currentStep >= $index + 1 ? 'border-green-600' : 'border-gray-200' }} py-2 pl-4 md:pl-0 md:pt-4 md:pb-0 hover:bg-gray-50 md:hover:bg-transparent focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-md md:rounded-none transition-colors"
                    aria-current="{{ $currentStep == $index + 1 ? 'step' : 'false' }}"
                    >
                    <span class="text-xs {{ $currentStep >= $index + 1 ? 'text-green-600' : 'text-gray-500' }} font-semibold tracking-wide uppercase group-hover:text-green-700">
                    Step {{ $index + 1 }}
                    </span>
                    <span class="text-sm font-medium {{ $currentStep == $index + 1 ? 'text-gray-900' : 'text-gray-700' }} group-hover:text-gray-900">
                    {{ $stepName }}
                    </span>
                    </button>
                </li>
                @endforeach
            </ol>
        </nav>
        </div>


<!-- Form content -->
<form wire:submit.prevent="registerCarDealer" id="car-dealer-form" class="space-y-8">
<!-- Step 1: Basic Information -->
                                            <div class="@if($currentStep === 1) block @else hidden @endif space-y-6" aria-labelledby="step1-heading">
                                            <h4 id="step1-heading" class="sr-only">Basic Information</h4>
                                            <!-- Business Details Section -->
                                                            <section aria-labelledby="business-details-heading" class="bg-white rounded-lg border border-gray-200 shadow-sm">
                                                                    <h5 id="business-details-heading" class="text-lg font-medium text-gray-900 px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg flex items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                                        </svg>
                                                                        Business Details
                                                                    </h5>
                                                                    <div class="p-4 space-y-4">
                                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                                                            <div>
                                                                            <label for="name" class="block text-sm font-medium text-gray-700">Business Name</label>
                                                                            <input  type="text"  id="name"   wire:model.defer="name"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"  required >
                                                                            @error('name') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                            </div>
                                                                            <div>
                                                                            <label for="businessRegistrationNumber" class="block text-sm font-medium text-gray-700">Business Registration Number</label>
                                                                            <input  type="text"  id="businessRegistrationNumber"   wire:model.defer="businessRegistrationNumber"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"  required >
                                                                            @error('businessRegistrationNumber') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                            </div>
                                                                            <div>
                                                                            <label for="taxIdentificationNumber" class="block text-sm font-medium text-gray-700">Tax Identification Number</label>
                                                                            <input  type="text"  id="taxIdentificationNumber"   wire:model.defer="taxIdentificationNumber"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"   required >
                                                                            @error('taxIdentificationNumber') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                            </div>
                                                                            <div>
                                                                            <label for="website" class="block text-sm font-medium text-gray-700">Website <span class="text-gray-500 text-xs">(Optional)</span></label>
                                                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">https://</span>
                                                                                <input  type="text"    id="website"   wire:model.defer="website"  placeholder="www.example.com"   class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                                            </div>
                                                                            @error('website') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>


                                                                <!-- Address Section -->
                                                                <section aria-labelledby="address-heading" class="bg-white rounded-lg border border-gray-200 shadow-sm">
                                                                    <h5 id="address-heading" class="text-lg font-medium text-gray-900 px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg flex items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                        </svg>
                                                                        Address Information
                                                                    </h5>
                                                                    <div class="p-4 space-y-4">
                                                                        <div>
                                                                            <label for="address" class="block text-sm font-medium text-gray-700">Street Address</label>
                                                                            <textarea 
                                                                            id="address" 
                                                                            wire:model.defer="address" 
                                                                            rows="2" 
                                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                                                                            required
                                                                            ></textarea>
                                                                            @error('address') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-4">
                                                                            <div>
                                                                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                                                            <input 
                                                                                type="text" 
                                                                                id="city" 
                                                                                wire:model.defer="city"
                                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" 
                                                                                required
                                                                                >
                                                                            @error('city') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                            </div>
                                                                            <div>
                                                                            <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                                                                            <input 
                                                                                type="text" 
                                                                                id="region" 
                                                                                wire:model.defer="region"
                                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" 
                                                                                required
                                                                                >
                                                                            @error('region') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                            </div>
                                                                            <div>
                                                                            <label for="postalCode" class="block text-sm font-medium text-gray-700">Postal Code <span class="text-gray-500 text-xs">(Optional)</span></label>
                                                                            <input 
                                                                                type="text" 
                                                                                id="postalCode" 
                                                                                wire:model.defer="postalCode"
                                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                                                                                >
                                                                            @error('postalCode') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                                                            <select 
                                                                            id="country" 
                                                                            wire:model.defer="country" 
                                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                                                                            >
                                                                            <option value="Tanzania">Tanzania</option>
                                                                            <option value="Kenya">Kenya</option>
                                                                            <option value="Uganda">Uganda</option>
                                                                            <option value="Rwanda">Rwanda</option>
                                                                            <option value="Burundi">Burundi</option>
                                                                            </select>
                                                                            @error('country') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </section>


                                            <!-- Contact Information Section -->
                                                            <section aria-labelledby="contact-heading" class="bg-white rounded-lg border border-gray-200 shadow-sm">
                                                                <h5 id="contact-heading" class="text-lg font-medium text-gray-900 px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg flex items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                    </svg>
                                                                    Contact Information
                                                                </h5>
                                                                <div class="p-4 space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                                                        <div>
                                                                        <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                                                        <div class="mt-1 relative rounded-md shadow-sm">
                                                                            <input 
                                                                                type="tel" 
                                                                                id="phoneNumber" 
                                                                                wire:model.defer="phoneNumber"
                                                                                class="block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 pl-10" 
                                                                                placeholder="+255 XXX XXX XXX"
                                                                                required
                                                                                >
                                                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                                <span class="text-gray-500 sm:text-sm">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                                    </svg>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <p class="mt-1 text-xs text-gray-500">Format: +255XXXXXXXXX or 0XXXXXXXXX</p>
                                                                        @error('phoneNumber') 
                                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                        @enderror
                                                                        </div>
                                                                        <div>
                                                                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                                                        <div class="mt-1 relative rounded-md shadow-sm">
                                                                            <input 
                                                                                type="email" 
                                                                                id="email" 
                                                                                wire:model.defer="email"
                                                                                class="block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 pl-10" 
                                                                                placeholder="business@example.com"
                                                                                required
                                                                                >
                                                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                        @error('email') 
                                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                        @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!-- Contact Person -->
                                                                    <div class="border-t border-gray-200 pt-4 mt-4">
                                                                        <h6 class="font-medium text-gray-700 mb-3">Primary Contact Person</h6>
                                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                                                        <div>
                                                                            <label for="contactPersonName" class="block text-sm font-medium text-gray-700">Full Name</label>
                                                                            <input 
                                                                                type="text" 
                                                                                id="contactPersonName" 
                                                                                wire:model.defer="contactPersonName"
                                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" 
                                                                                required
                                                                                >
                                                                            @error('contactPersonName') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="contactPersonPosition" class="block text-sm font-medium text-gray-700">Position <span class="text-gray-500 text-xs">(Optional)</span></label>
                                                                            <input 
                                                                                type="text" 
                                                                                id="contactPersonPosition" 
                                                                                wire:model.defer="contactPersonPosition"
                                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                                                                                placeholder="e.g. Sales Manager"
                                                                                >
                                                                            @error('contactPersonPosition') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="contactPersonPhone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                                                <input 
                                                                                    type="tel" 
                                                                                    id="contactPersonPhone" 
                                                                                    wire:model.defer="contactPersonPhone"
                                                                                    class="block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 pl-10" 
                                                                                    placeholder="+255 XXX XXX XXX"
                                                                                    required
                                                                                    >
                                                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                                    <span class="text-gray-500 sm:text-sm">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                                    </svg>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            @error('contactPersonPhone') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="contactPersonEmail" class="block text-sm font-medium text-gray-700">Email Address</label>
                                                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                                                <input 
                                                                                    type="email" 
                                                                                    id="contactPersonEmail" 
                                                                                    wire:model.defer="contactPersonEmail"
                                                                                    class="block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 pl-10" 
                                                                                    placeholder="contact@example.com"
                                                                                    required
                                                                                    >
                                                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            @error('contactPersonEmail') 
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                            </div>



                <!-- Step 2: Dealer Specific Information -->
                <div class="@if($currentStep === 2) block @else hidden @endif space-y-6" aria-labelledby="step2-heading">
                        <h4 id="step2-heading" class="sr-only">Dealer Details</h4>
                        <!-- Dealership Information -->
                        <section aria-labelledby="dealership-heading" class="bg-white rounded-lg border border-gray-200 shadow-sm">
                            <h5 id="dealership-heading" class="text-lg font-medium text-gray-900 px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h2v5a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-9a1 1 0 00-1-1h-8a1 1 0 00-.8.4L8.35 4H3z" />
                                </svg>
                                Dealership Information
                            </h5>
                            <div class="p-4 space-y-5">
                                <!-- Dealer Type -->
                                <div>
                                    <label for="dealerType" class="block text-sm font-medium text-gray-700">Dealer Type</label>
                                    <select 
                                    id="dealerType" 
                                    wire:model.defer="dealerType" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" 
                                    required
                                    >
                                    <option value="">Select Type</option>
                                    <option value="New Cars">New Cars Only</option>
                                    <option value="Used Cars">Used Cars Only</option>
                                    <option value="Both">Both New and Used Cars</option>
                                    <option value="Other">Other</option>
                                    </select>
                                    @error('dealerType') 
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Year and Inventory -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                    <label for="establishedYear" class="block text-sm font-medium text-gray-700">Year Established</label>
                                    <input 
                                        type="number" 
                                        id="establishedYear" 
                                        wire:model.defer="establishedYear" 
                                        min="1900" 
                                        max="{{ date('Y') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" 
                                        required
                                        >
                                    @error('establishedYear') 
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    </div>
                                    <div>
                                    <label for="inventorySize" class="block text-sm font-medium text-gray-700">Inventory Size (# of vehicles)</label>
                                    <input 
                                        type="number" 
                                        id="inventorySize" 
                                        wire:model.defer="inventorySize" 
                                        min="1" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" 
                                        required
                                        >
                                    @error('inventorySize') 
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div>
                                <!-- Brands Sold -->
                                <div>
                                    <label for="selectedBrands" class="block text-sm font-medium text-gray-700 mb-1">Brands Sold</label>
                                    <p class="text-xs text-gray-500 mb-3">Select all car brands that your dealership sells or services</p>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 max-h-64 overflow-y-auto p-2 border border-gray-200 rounded-md">
                                    @foreach($brandsList as $brand)
                                    <div class="flex items-center">
                                        <input 
                                            id="brand-{{ $loop->index }}" 
                                            type="checkbox" 
                                            wire:model.defer="selectedBrands" 
                                            value="{{ $brand }}" 
                                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                                            >
                                        <label for="brand-{{ $loop->index }}" class="ml-2 block text-sm text-gray-700">
                                        {{ $brand }}
                                        </label>
                                    </div>
                                    @endforeach
                                    </div>
                                    @error('selectedBrands') 
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>
                  <!-- Services Information -->
                    <section aria-labelledby="services-heading" class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <h5 id="services-heading" class="text-lg font-medium text-gray-900 px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                        Services & Facilities
                    </h5>
                    <div class="p-4 space-y-5">
                        <!-- Showroom Address -->
                        <div>
                            <label for="showroomAddress" class="block text-sm font-medium text-gray-700">Showroom Address</label>
                            <textarea   id="showroomAddress"   wire:model.defer="showroomAddress"  rows="2"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"  placeholder="If different from main business address"  ></textarea>
                            @error('showroomAddress') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Service Center -->
                        <div>
                            <label for="serviceCenter" class="block text-sm font-medium text-gray-700">Service Center Details</label>
                            <textarea  id="serviceCenter"  wire:model.defer="serviceCenter"  rows="2"    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"   placeholder="Location and capabilities of your service center"></textarea>
                            @error('serviceCenter') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Services Offered -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Services Offered</label>
                            <p class="text-xs text-gray-500 mb-3">Select all services that your dealership provides to customers</p>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                
                                @foreach([
                                ['id' => 'service1', 'value' => 'Sales', 'label' => 'Vehicle Sales', 'icon' => '
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                '],
                                ['id' => 'service2', 'value' => 'Financing', 'label' => 'Financing', 'icon' => '
                                <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                '],
                                ['id' => 'service3', 'value' => 'Maintenance', 'label' => 'Maintenance', 'icon' => '
                                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                '],
                                ['id' => 'service4', 'value' => 'Parts', 'label' => 'Parts & Accessories', 'icon' => '
                                <path d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                '],
                                ['id' => 'service5', 'value' => 'Insurance', 'label' => 'Insurance', 'icon' => '
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                '],
                                ['id' => 'service6', 'value' => 'BodyWork', 'label' => 'Body Work & Painting', 'icon' => '
                                <path d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                ']
                                ] as $service)


                                <div class="flex items-start p-2 border border-gray-200 rounded-md hover:bg-gray-50">
                                    <input  id="{{ $service['id'] }}"  type="checkbox"   wire:model.defer="servicesOffered"  value="{{ $service['value'] }}"  class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded mt-0.5" >
                                    <label for="{{ $service['id'] }}" class="ml-2 block">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            {!! $service['icon'] !!}
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">{{ $service['label'] }}</span>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>


                            @error('servicesOffered') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    </section>


                </div>


 

<!-- Step 3: Documentation -->
<div class="@if($currentStep === 3) block @else hidden @endif space-y-6" aria-labelledby="step3-heading">
   <h4 id="step3-heading" class="sr-only">Documentation</h4>
 
 
  




   <section aria-labelledby="documents-heading" class="bg-white rounded-lg border border-gray-200 shadow-sm">
   <h5 id="documents-heading" class="text-lg font-medium text-gray-900 px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
      Required Documentation
   </h5>

   <div class="p-4 space-y-6">
      <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
         <div class="flex">
            <div class="flex-shrink-0">
               <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
               </svg>
            </div>
            <div class="ml-3">
               <p class="text-sm text-blue-800">
                  Please upload the following required documents. All documents must be in PDF, JPG, JPEG, or PNG format and not exceed 5MB in size.
               </p>
            </div>
         </div>
      </div>

      <!-- Business Registration Document -->
      <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
         <div class="p-4">
            <div class="flex items-start">
               <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
               </div>
               <div class="ml-4 flex-1">
                  <h6 class="text-base font-medium text-gray-900">Business Registration Certificate</h6>
                  <p class="mt-1 text-sm text-gray-500">The official business registration document from the registrar.</p>
               </div>
            </div>
            
            <div class="mt-4">
               @if(!$businessRegistrationDoc)
                  <label for="businessRegistrationDoc" class="relative border-2 border-gray-300 border-dashed rounded-md p-6 flex justify-center cursor-pointer hover:bg-gray-50 transition-colors block">
                     <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                           <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                           <span class="font-medium text-green-600 hover:text-green-500">
                              Upload a file
                           </span>
                           <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PDF, JPG, JPEG, PNG up to 5MB</p>
                     </div>
                  </label>
                  <input 
                     id="businessRegistrationDoc" 
                     wire:model="businessRegistrationDoc" 
                     type="file" 
                     class="hidden"
                     accept=".pdf,.jpg,.jpeg,.png"
                  >
               @else
                  <div class="bg-gray-50 rounded-md border border-gray-300 p-3">
                     <div class="flex items-center justify-between">
                        <div class="flex items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                           </svg>
                           <span class="text-sm font-medium text-gray-900">
                              @if(is_object($businessRegistrationDoc))
                                 {{ $businessRegistrationDoc->getClientOriginalName() }}
                              @else
                                 Business Registration Document
                              @endif
                           </span>
                        </div>
                        <button 
                           type="button" 
                           wire:click="removeBusinessRegistrationDoc"
                           class="text-sm font-medium text-red-600 hover:text-red-500 transition-colors">
                           Remove
                        </button>
                     </div>
                  </div>
               @endif
               
               @error('businessRegistrationDoc') 
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
               @enderror
               
               <div wire:loading wire:target="businessRegistrationDoc" class="mt-2">
                  <div class="flex items-center text-sm text-gray-600">
                     <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                     </svg>
                     Uploading...
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Tax Clearance Document -->
      <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
         <div class="p-4">
            <div class="flex items-start">
               <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
               </div>
               <div class="ml-4 flex-1">
                  <h6 class="text-base font-medium text-gray-900">Tax Clearance Certificate</h6>
                  <p class="mt-1 text-sm text-gray-500">Current tax clearance document from the revenue authority.</p>
               </div>
            </div>
            
            <div class="mt-4">
               @if(!$taxClearanceDoc)
                  <label for="taxClearanceDoc" class="relative border-2 border-gray-300 border-dashed rounded-md p-6 flex justify-center cursor-pointer hover:bg-gray-50 transition-colors block">
                     <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                           <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                           <span class="font-medium text-green-600 hover:text-green-500">
                              Upload a file
                           </span>
                           <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PDF, JPG, JPEG, PNG up to 5MB</p>
                     </div>
                  </label>
                  <input 
                     id="taxClearanceDoc" 
                     wire:model="taxClearanceDoc" 
                     type="file" 
                     class="hidden"
                     accept=".pdf,.jpg,.jpeg,.png"
                  >
               @else
                  <div class="bg-gray-50 rounded-md border border-gray-300 p-3">
                     <div class="flex items-center justify-between">
                        <div class="flex items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                           </svg>
                           <span class="text-sm font-medium text-gray-900">
                              @if(is_object($taxClearanceDoc))
                                 {{ $taxClearanceDoc->getClientOriginalName() }}
                              @else
                                 Tax Clearance Document
                              @endif
                           </span>
                        </div>
                        <button 
                           type="button" 
                           wire:click="removeTaxClearanceDoc"
                           class="text-sm font-medium text-red-600 hover:text-red-500 transition-colors">
                           Remove
                        </button>
                     </div>
                  </div>
               @endif
               
               @error('taxClearanceDoc') 
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
               @enderror
               
               <div wire:loading wire:target="taxClearanceDoc" class="mt-2">
                  <div class="flex items-center text-sm text-gray-600">
                     <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                     </svg>
                     Uploading...
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Company Logo (Optional) -->
      <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
         <div class="p-4">
            <div class="flex items-start">
               <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
               </div>
               <div class="ml-4 flex-1">
                  <h6 class="text-base font-medium text-gray-900">Company Logo <span class="text-gray-500 text-sm font-normal">(Optional)</span></h6>
                  <p class="mt-1 text-sm text-gray-500">Your company logo for display on the platform.</p>
               </div>
            </div>
            
            <div class="mt-4">
               @if(!$logo)
                  <label for="logo" class="relative border-2 border-gray-300 border-dashed rounded-md p-6 flex justify-center cursor-pointer hover:bg-gray-50 transition-colors block">
                     <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                           <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                           <span class="font-medium text-green-600 hover:text-green-500">
                              Upload a file
                           </span>
                           <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                     </div>
                  </label>
                  <input 
                     id="logo" 
                     wire:model="logo" 
                     type="file" 
                     class="hidden"
                     accept="image/*"
                  >
               @else
                  <div class="bg-gray-50 rounded-md border border-gray-300 p-3">
                     <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                           @if($logo && method_exists($logo, 'temporaryUrl'))
                              <img src="{{ $logo->temporaryUrl() }}" class="h-14 w-14 object-contain bg-white border rounded" alt="Logo preview">
                           @else
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                           @endif
                           <span class="text-sm font-medium text-gray-900">
                              @if(is_object($logo))
                                 {{ $logo->getClientOriginalName() }}
                              @else
                                 Company Logo
                              @endif
                           </span>
                        </div>
                        <button 
                           type="button" 
                           wire:click="removeLogo"
                           class="text-sm font-medium text-red-600 hover:text-red-500 transition-colors">
                           Remove
                        </button>
                     </div>
                  </div>
               @endif
               
               @error('logo') 
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
               @enderror
               
               <div wire:loading wire:target="logo" class="mt-2">
                  <div class="flex items-center text-sm text-gray-600">
                     <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                     </svg>
                     Uploading...
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


 </div>



      <!-- Step 4: Review & Submit -->
    <div class="@if($currentStep === 4) block @else hidden @endif space-y-6" aria-labelledby="step4-heading">
         <h4 id="step4-heading" class="sr-only">Review & Submit</h4>
         <section aria-labelledby="review-heading" class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <h5 id="review-heading" class="text-lg font-medium text-gray-900 px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg flex items-center">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
               </svg>
               Review Your Information
            </h5>
            <div class="p-4 space-y-6">
               <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                  <div class="flex">
                     <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                     </div>
                     <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                           Please review all information carefully before submitting. Your application will be sent for approval.
                        </p>
                     </div>
                  </div>
               </div>

               <!-- Business Information Review -->
               <div class="rounded-lg border border-gray-200 overflow-hidden">
                  <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                     <h6 class="text-sm font-medium text-gray-900">Business Information</h6>
                  </div>
                  <div class="px-4 py-3 divide-y divide-gray-200">
                     <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Business Name</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $name ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Registration Number</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $businessRegistrationNumber ?? 'Not provided' }}</dd>
                        </div>
                     </dl>
                     <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Tax ID Number</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $taxIdentificationNumber ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Year Established</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $establishedYear ?? 'Not provided' }}</dd>
                        </div>
                     </dl>
                  </div>
               </div>
               <!-- Address & Contact Review -->
               <div class="rounded-lg border border-gray-200 overflow-hidden">
                  <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                     <h6 class="text-sm font-medium text-gray-900">Address & Contact Information</h6>
                  </div>
                  <div class="px-4 py-3 divide-y divide-gray-200">
                     <dl class="grid grid-cols-1 gap-y-2 py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Address</dt>
                           <dd class="mt-1 text-sm text-gray-900">
                              {{ $address ?? 'Not provided' }}, 
                              {{ $city ?? '' }}{{ $region ? ', '.$region : '' }}{{ $postalCode ? ' '.$postalCode : '' }}{{ $country ? ', '.$country : '' }}
                           </dd>
                        </div>
                     </dl>
                     <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Phone Number</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $phoneNumber ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Email Address</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $email ?? 'Not provided' }}</dd>
                        </div>
                     </dl>
                     <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Website</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $website ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Contact Person</dt>
                           <dd class="mt-1 text-sm text-gray-900">
                              {{ $contactPersonName ?? 'Not provided' }}
                              {{ $contactPersonPosition ? ' ('.$contactPersonPosition.')' : '' }}
                           </dd>
                        </div>
                     </dl>
                  </div>
               </div>
               <!-- Dealer Information Review -->
               <div class="rounded-lg border border-gray-200 overflow-hidden">
                  <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                     <h6 class="text-sm font-medium text-gray-900">Dealership Information</h6>
                  </div>
                  <div class="px-4 py-3 divide-y divide-gray-200">
                     <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Dealer Type</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $dealerType ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Inventory Size</dt>
                           <dd class="mt-1 text-sm text-gray-900">{{ $inventorySize ?? 'Not provided' }} vehicles</dd>
                        </div>
                     </dl>
                     <dl class="py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Brands Sold</dt>
                           <dd class="mt-1 text-sm text-gray-900">
                              @if(isset($selectedBrands) && count($selectedBrands) > 0)
                              <div class="flex flex-wrap gap-1">
                                 @foreach($selectedBrands as $brand)
                                 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                 {{ $brand }}
                                 </span>
                                 @endforeach
                              </div>
                              @else
                              Not provided
                              @endif
                           </dd>
                        </div>
                     </dl>
                     <dl class="py-2">
                        <div>
                           <dt class="text-xs font-medium text-gray-500">Services Offered</dt>
                           <dd class="mt-1 text-sm text-gray-900">
                           
                            @if(is_array($servicesOffered) && count($servicesOffered) > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach($servicesOffered as $service)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $service }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                Not provided
                            @endif

                           </dd>
                        </div>
                     </dl>
                  </div>
               </div>
               <!-- Documentation Review -->
               <div class="rounded-lg border border-gray-200 overflow-hidden">
                  <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                     <h6 class="text-sm font-medium text-gray-900">Documentation</h6>
                  </div>
                  <div class="px-4 py-3">
                     <ul class="divide-y divide-gray-200">
                        <li class="py-2 flex items-center justify-between">
                           <div class="flex items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                              </svg>
                              <span class="text-sm text-gray-800">Business Registration Certificate</span>
                           </div>
                           @if($businessRegistrationDoc)
                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                              <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                 <circle cx="4" cy="4" r="3" />
                              </svg>
                              Uploaded
                           </span>
                           @else
                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                              <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                 <circle cx="4" cy="4" r="3" />
                              </svg>
                              Missing
                           </span>
                           @endif
                        </li>
                        <li class="py-2 flex items-center justify-between">
                           <div class="flex items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                              </svg>
                              <span class="text-sm text-gray-800">Tax Clearance Certificate</span>
                           </div>
                           @if($taxClearanceDoc)
                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                              <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                 <circle cx="4" cy="4" r="3" />
                              </svg>
                              Uploaded
                           </span>
                           @else
                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                              <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                 <circle cx="4" cy="4" r="3" />
                              </svg>
                              Missing
                           </span>
                           @endif
                        </li>
                        <li class="py-2 flex items-center justify-between">
                           <div class="flex items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                              <span class="text-sm text-gray-800">Company Logo</span>
                           </div>
                           @if($logo)
                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                              <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                 <circle cx="4" cy="4" r="3" />
                              </svg>
                              Uploaded
                           </span>
                           @else
                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                           Optional
                           </span>
                           @endif
                        </li>
                     </ul>
                  </div>
               </div>
               <!-- Terms & Conditions -->
               <div class="rounded-lg border border-gray-200 overflow-hidden">
                  <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                     <h6 class="text-sm font-medium text-gray-900">Terms & Conditions</h6>
                  </div>
                  <div class="px-4 py-3">
                     <div class="flex items-start">
                        <div class="flex items-center h-5">
                           <input 
                              id="terms" 
                              type="checkbox" 
                              wire:model.defer="acceptTerms"
                              class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                              required
                              >
                        </div>
                        <div class="ml-3 text-sm">
                           <label for="terms" class="font-medium text-gray-700">I agree to the terms and conditions</label>
                           <p class="text-gray-500">
                              By submitting this registration, I confirm that all information provided is accurate and complete.
                              I understand that this application will be reviewed and is subject to approval.
                           </p>
                        </div>
                     </div>
                     @error('acceptTerms') 
                     <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                     @enderror
                  </div>
               </div>
            </div>
        </section>


    </div>
      <!-- Modal footer -->
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
         @if($currentStep < $totalSteps)
         <button 
            type="button" 
            wire:click="nextStepCarDealer" 
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
         Continue to Next Step  
         </button>
         @else
         <button 
            type="button" 
            wire:click="registerCarDealer" 
            wire:loading.attr="disabled" 
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
            <span wire:loading.remove wire:target="registerCarDealer">
            {{ $isEditMode ? 'Update Car Dealer' : 'Submit Registration' }}
            </span>
            <span wire:loading wire:target="registerCarDealer" class="flex items-center">
               <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
               </svg>
               Processing...
            </span>
         </button>
         @endif
         @if($currentStep > 1)
         <button 
            type="button" 
            wire:click="prevStep" 
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Previous Step
         </button>
         @endif
         <button 
            type="button" 
            wire:click="closeModal" 
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
         Cancel
         </button>
      </div>
   </div>
</div>

               </div>
               </div>

               </div>


<!-- #region -->









<!-- Partner Selection Modal -->
<div class="@if($showPartnerSelectionModal) fixed @else hidden @endif inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <!-- Modal header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <h3 class="text-xl leading-6 font-medium text-white" id="modal-title">
                    Add New Partner
                </h3>
                <p class="mt-1 text-sm text-green-100">
                    Select the type of partner you wish to register in the system
                </p>
            </div>
            
            <!-- Modal content -->
            <div class="bg-white px-6 pt-5 pb-6">
                <div class="space-y-6">
                    <!-- Lender Option Card -->
                    <div class="relative rounded-lg border-2 border-gray-200 hover:border-green-500 bg-white px-6 py-5 shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer group" wire:click="selectPartnerType('lender')">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-full p-3 group-hover:bg-green-200 transition-colors duration-200">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900 group-hover:text-green-700">Financial Institution</h3>
                                <div class="mt-1 flex flex-col">
                                    <p class="text-sm text-gray-500 group-hover:text-gray-700">Banks, Microfinance, Credit Unions, SACCOs</p>
                                    <ul class="mt-2 text-xs text-gray-500 list-disc list-inside">
                                        <li>Offer loans and financing options for vehicles</li>
                                        <li>Set interest rates and payment terms</li>
                                        <li>Process credit applications from buyers</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0 self-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Car Dealer Option Card -->
                    <div class="relative rounded-lg border-2 border-gray-200 hover:border-green-500 bg-white px-6 py-5 shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer group" wire:click="selectPartnerType('carDealer')">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-full p-3 group-hover:bg-green-200 transition-colors duration-200">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900 group-hover:text-green-700">Car Dealership</h3>
                                <div class="mt-1 flex flex-col">
                                    <p class="text-sm text-gray-500 group-hover:text-gray-700">New Cars, Used Cars, or Both</p>
                                    <ul class="mt-2 text-xs text-gray-500 list-disc list-inside">
                                        <li>List and sell vehicles through our platform</li>
                                        <li>Connect with lenders for customer financing</li>
                                        <li>Manage inventory and service offerings</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0 self-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal footer -->
            <div class="bg-gray-50 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-xs text-gray-500">
                        <svg class="inline-block h-4 w-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        All partners undergo verification before approval
                    </div>
                    <button type="button" wire:click="closeModal" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



    
    
</div>    
                        

</div>

    