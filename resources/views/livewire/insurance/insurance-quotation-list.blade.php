<div class="p-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="text-xs uppercase text-gray-500">Total Requests</div>
            <div class="mt-2 text-2xl font-semibold text-gray-900">{{ $statusCounts['total'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-blue-100 rounded-lg p-4 shadow-sm">
            <div class="text-xs uppercase text-blue-600">Pending</div>
            <div class="mt-2 text-2xl font-semibold text-blue-700">{{ $statusCounts['pending'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-green-100 rounded-lg p-4 shadow-sm">
            <div class="text-xs uppercase text-green-600">Approved</div>
            <div class="mt-2 text-2xl font-semibold text-green-700">{{ $statusCounts['approved'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="text-xs uppercase text-gray-600">Completed</div>
            <div class="mt-2 text-2xl font-semibold text-gray-900">{{ $statusCounts['completed'] ?? 0 }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="px-4 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <h2 class="text-lg font-semibold text-gray-900">Insurance Quotation Requests</h2>
            <div class="flex items-center gap-3">
                <input type="text" wire:model.debounce.400ms="search" placeholder="Search name, phone, email" class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
                <select wire:model="status" class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
                    <option value="">All Statuses</option>
                    <option value="submitted">Submitted</option>
                    <option value="in_review">In review</option>
                    <option value="completed">Completed</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Customer</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Contact</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Vehicle/Cover</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Total Premium</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Document</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Actions</th>
                        <th class="px-4 py-3 text-right font-medium text-gray-700">Submitted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($requests as $req)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $req->customer_name }}</div>
                                <div class="text-xs text-gray-500">#{{ $req->id }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-gray-800">{{ $req->customer_phone }}</div>
                                <div class="text-xs text-gray-500">{{ $req->customer_email }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-gray-800">{{ $req->vehicle_class ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $req->type_of_cover ?? '-' }} | {{ $req->claim_status ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-3">
                                @if(!is_null($req->total_premium))
                                    <span class="font-semibold text-gray-900">TSh {{ number_format($req->total_premium) }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($req->document_path)
                                    <a href="{{ Storage::disk('public')->url($req->document_path) }}" target="_blank" class="text-green-700 hover:underline">Download</a>
                                @else
                                    <span class="text-gray-500">None</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs
                                    @if($req->status === 'approved') bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($req->status === 'completed') bg-green-50 text-green-700 border border-green-200
                                    @else bg-gray-50 text-gray-700 border border-gray-200 @endif">
                                    {{ ucfirst(str_replace('_',' ',$req->status ?? 'pending')) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    @if(!$req->status || $req->status === '' )
                                        <button wire:click="changeStatus({{ $req->id }}, 'approved')" class="px-2 py-1 text-xs rounded border border-blue-300 text-blue-800 hover:bg-blue-50">Approve</button>
                                    @elseif($req->status === 'approved')
                                        <button wire:click="changeStatus({{ $req->id }}, 'completed')" class="px-2 py-1 text-xs rounded border border-green-300 text-green-800 hover:bg-green-50">Complete</button>
                                    @elseif($req->status === 'completed')
                                        <span class="text-xs text-gray-500">No actions</span>
                                    @else
                                        <button wire:click="changeStatus({{ $req->id }}, 'approved')" class="px-2 py-1 text-xs rounded border border-blue-300 text-blue-800 hover:bg-blue-50">Approve</button>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3 text-right text-gray-600">
                                {{ $req->created_at?->format('Y-m-d H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">No insurance quotation requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 border-t border-gray-200">
            {{ $requests->links() }}
        </div>
    </div>
</div>


