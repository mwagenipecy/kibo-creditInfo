<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Spare Part Requests Management</h1>
            <p class="text-lg text-gray-600 mt-2">Respond to customer requests and manage your quotes</p>
        </div>

        {{-- Messages --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">New Requests</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_requests'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Quotes</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_quotes'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pending Payment</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_quotes'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Paid Orders</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['paid_quotes'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button class="border-b-2 border-green-500 text-green-600 py-2 px-1 text-sm font-medium">
                        New Requests
                    </button>
                    <button class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 text-sm font-medium">
                        My Quotes
                    </button>
                </nav>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-4 flex-1">
                    <div class="flex-1">
                        <input type="text" wire:model="search" placeholder="Search requests..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div class="min-w-48">
                        <select wire:model="statusFilter" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- New Requests Table --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">New Requests</h3>
                <p class="text-sm text-gray-600">Respond to customer requests with your quotes</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer & Vehicle
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Part Details
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($requests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $request->customer_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $request->year }} {{ $request->make->name }} {{ $request->model->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $request->part_name }}</div>
                                        @if($request->part_number)
                                            <div class="text-sm text-gray-500">Part #: {{ $request->part_number }}</div>
                                        @endif
                                        @if($request->part_condition)
                                            <div class="text-sm text-gray-500">Condition: {{ ucfirst($request->part_condition) }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $request->customer_email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="openQuoteModal({{ $request->id }})" 
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition duration-200">
                                        Send Quote
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No new requests</h3>
                                        <p class="mt-1 text-sm text-gray-500">All customer requests have been responded to.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $requests->links() }}
            </div>
        </div>

        {{-- My Quotes Table --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">My Quotes</h3>
                <p class="text-sm text-gray-600">Track your submitted quotes and payments</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer & Vehicle
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quote Details
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($quotes as $quote)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $quote->sparePartRequest->customer_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $quote->sparePartRequest->year }} {{ $quote->sparePartRequest->make->name }} {{ $quote->sparePartRequest->model->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $quote->sparePartRequest->part_name }}</div>
                                        <div class="text-sm text-green-600 font-semibold">{{ number_format($quote->price, 2) }} TZS</div>
                                        @if($quote->delivery_time)
                                            <div class="text-sm text-gray-500">Delivery: {{ $quote->delivery_time }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($quote->payment && $quote->payment->payment_status === 'completed')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Paid
                                        </span>
                                    @elseif($quote->payment && $quote->payment->payment_status === 'pending')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            No Payment
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $quote->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="openQuoteDetailsModal({{ $quote->id }})" 
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No quotes submitted</h3>
                                        <p class="mt-1 text-sm text-gray-500">Start responding to customer requests to see your quotes here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $quotes->links() }}
            </div>
        </div>

        {{-- Quote Modal --}}
        @if($showQuoteModal && $selectedRequest)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 xl:w-2/3 shadow-lg rounded-md bg-white max-h-screen overflow-y-auto">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b">
                        <h3 class="text-2xl font-semibold text-gray-900">Submit Quote</h3>
                        <button wire:click="closeQuoteModal" class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Request Details --}}
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Request Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium">Customer:</span> {{ $selectedRequest->customer_name }}
                            </div>
                            <div>
                                <span class="font-medium">Vehicle:</span> {{ $selectedRequest->year }} {{ $selectedRequest->make->name }} {{ $selectedRequest->model->name }}
                            </div>
                            <div>
                                <span class="font-medium">Part:</span> {{ $selectedRequest->part_name }}
                            </div>
                            <div>
                                <span class="font-medium">Condition:</span> {{ ucfirst($selectedRequest->part_condition) }}
                            </div>
                            @if($selectedRequest->part_number)
                                <div>
                                    <span class="font-medium">Part Number:</span> {{ $selectedRequest->part_number }}
                                </div>
                            @endif
                            @if($selectedRequest->additional_notes)
                                <div class="md:col-span-2">
                                    <span class="font-medium">Notes:</span> {{ $selectedRequest->additional_notes }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Quote Form --}}
                    <form wire:submit.prevent="submitQuote">
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price (TZS) *</label>
                                    <input type="number" step="0.01" wire:model="quotePrice" placeholder="0.00" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('quotePrice') border-red-500 @enderror">
                                    @error('quotePrice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Time</label>
                                    <input type="text" wire:model="deliveryTime" placeholder="e.g., 2-3 business days" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('deliveryTime') border-red-500 @enderror">
                                    @error('deliveryTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Warranty Information</label>
                                <input type="text" wire:model="warrantyInfo" placeholder="e.g., 6 months warranty" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('warrantyInfo') border-red-500 @enderror">
                                @error('warrantyInfo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                                <textarea wire:model="additionalNotes" rows="3" placeholder="Any additional information about the part or service..." 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('additionalNotes') border-red-500 @enderror"></textarea>
                                @error('additionalNotes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Link (Optional)</label>
                                <input type="url" wire:model="paymentLink" placeholder="https://payment-link.com" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('paymentLink') border-red-500 @enderror">
                                @error('paymentLink') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
                            <button type="button" wire:click="closeQuoteModal" 
                                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Submit Quote & Send Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        {{-- Quote Details Modal --}}
        @if($showQuoteDetailsModal && $selectedQuote)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 xl:w-2/3 shadow-lg rounded-md bg-white max-h-screen overflow-y-auto">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b">
                        <h3 class="text-2xl font-semibold text-gray-900">Quote Details</h3>
                        <button wire:click="closeQuoteDetailsModal" class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-6">
                        {{-- Request Details --}}
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">Request Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-medium">Customer:</span> {{ $selectedQuote->sparePartRequest->customer_name }}
                                </div>
                                <div>
                                    <span class="font-medium">Vehicle:</span> {{ $selectedQuote->sparePartRequest->year }} {{ $selectedQuote->sparePartRequest->make->name }} {{ $selectedQuote->sparePartRequest->model->name }}
                                </div>
                                <div>
                                    <span class="font-medium">Part:</span> {{ $selectedQuote->sparePartRequest->part_name }}
                                </div>
                                <div>
                                    <span class="font-medium">Email:</span> {{ $selectedQuote->sparePartRequest->customer_email }}
                                </div>
                            </div>
                        </div>

                        {{-- Quote Details --}}
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">Your Quote</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-medium">Price:</span> {{ number_format($selectedQuote->price, 2) }} {{ $selectedQuote->currency }}
                                </div>
                                @if($selectedQuote->delivery_time)
                                    <div>
                                        <span class="font-medium">Delivery:</span> {{ $selectedQuote->delivery_time }}
                                    </div>
                                @endif
                                @if($selectedQuote->warranty_info)
                                    <div>
                                        <span class="font-medium">Warranty:</span> {{ $selectedQuote->warranty_info }}
                                    </div>
                                @endif
                                @if($selectedQuote->payment_link)
                                    <div class="md:col-span-2">
                                        <span class="font-medium">Payment Link:</span> 
                                        <a href="{{ $selectedQuote->payment_link }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            {{ $selectedQuote->payment_link }}
                                        </a>
                                    </div>
                                @endif
                                @if($selectedQuote->additional_notes)
                                    <div class="md:col-span-2">
                                        <span class="font-medium">Notes:</span> {{ $selectedQuote->additional_notes }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Payment Status --}}
                        @if($selectedQuote->payment)
                            <div class="bg-green-50 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 mb-3">Payment Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium">Status:</span> 
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($selectedQuote->payment->payment_status === 'completed') bg-green-100 text-green-800
                                            @elseif($selectedQuote->payment->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($selectedQuote->payment->payment_status) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="font-medium">Amount:</span> {{ $selectedQuote->payment->formatted_amount }}
                                    </div>
                                    @if($selectedQuote->payment->payment_date)
                                        <div>
                                            <span class="font-medium">Payment Date:</span> {{ $selectedQuote->payment->payment_date->format('M d, Y H:i') }}
                                        </div>
                                    @endif
                                    @if($selectedQuote->payment->transaction_id)
                                        <div>
                                            <span class="font-medium">Transaction ID:</span> {{ $selectedQuote->payment->transaction_id }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 mb-3">Payment Status</h4>
                                <p class="text-sm text-gray-600">No payment has been made for this quote yet.</p>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end mt-8 pt-6 border-t">
                        <button wire:click="closeQuoteDetailsModal" 
                                class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-200">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
