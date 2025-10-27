<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Negotiations</h1>
            <p class="text-gray-600">View and manage your price negotiation requests</p>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Listed Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">My Offer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($myNegotiations as $negotiation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $negotiation->vehicle->make->name ?? 'N/A' }} {{ $negotiation->vehicle->model->name ?? 'N/A' }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $negotiation->vehicle->year }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    TSh {{ number_format($negotiation->vehicle->price) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-orange-600">
                                    TSh {{ number_format($negotiation->offered_price) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded 
                                        @if($negotiation->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($negotiation->status == 'accepted') bg-green-100 text-green-800
                                        @elseif($negotiation->status == 'rejected') bg-red-100 text-red-800
                                        @elseif($negotiation->status == 'completed') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($negotiation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $negotiation->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @php
                                        $hasUnreadMessages = $negotiation->messages->where('sender_id', '!=', Auth::id())
                                            ->where('created_at', '>', now()->subMinutes(5))
                                            ->count() > 0;
                                    @endphp
                                    @if($negotiation->status == 'accepted')
                                        <button wire:click="openChat({{ $negotiation->id }})" 
                                                class="text-green-600 hover:text-green-900 relative inline-flex items-center">
                                            Chat Now
                                            @if($hasUnreadMessages)
                                                <span class="ml-2 w-2 h-2 bg-red-500 rounded-full"></span>
                                            @endif
                                        </button>
                                    @elseif($negotiation->status == 'pending')
                                        <span class="text-gray-400">Waiting for response</span>
                                    @elseif($negotiation->status == 'completed')
                                        <span class="text-blue-600">✓ Sale Completed</span>
                                    @else
                                        <span class="text-gray-400">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-gray-600">No negotiation requests yet. Start by making an offer on a vehicle!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chat Modal -->
    @if($showChatModal && $selectedNegotiation)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeChat">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white" wire:click.stop>
                <div class="flex flex-col h-[600px]">
                    <!-- Chat Header -->
                    <div class="flex justify-between items-center mb-4 pb-4 border-b">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Chat with Seller</h3>
                            <p class="text-sm text-gray-600">{{ $selectedNegotiation->vehicle->make->name ?? '' }} {{ $selectedNegotiation->vehicle->model->name ?? '' }}</p>
                            <p class="text-xs text-gray-500">My Offer: TSh {{ number_format($selectedNegotiation->offered_price) }}</p>
                        </div>
                        <button wire:click="closeChat" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Chat Messages -->
                    <div class="flex-1 overflow-y-auto mb-4 space-y-4 chat-messages" 
                         id="buyer-chat-messages"
                         x-data
                         x-init="setTimeout(() => $el.scrollTop = $el.scrollHeight, 100)"
                         wire:poll.2s>
                        @if($selectedNegotiation->messages && $selectedNegotiation->messages->count() > 0)
                            @foreach($selectedNegotiation->messages as $message)
                                <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-xs md:max-w-md">
                                        <div class="flex items-start gap-2">
                                            @if($message->sender_id != Auth::id())
                                                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm font-medium">
                                                    {{ substr($message->sender->name ?? 'U', 0, 1) }}
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <p class="text-xs text-gray-500 mb-1 {{ $message->sender_id == Auth::id() ? 'text-right' : '' }}">
                                                    {{ $message->sender->name ?? 'Unknown' }}
                                                </p>
                                                <div class="px-4 py-2 rounded-lg {{ $message->sender_id == Auth::id() ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-900' }}">
                                                    <p class="text-sm">{{ $message->message }}</p>
                                                </div>
                                                <p class="text-xs text-gray-400 mt-1 {{ $message->sender_id == Auth::id() ? 'text-right' : '' }}">
                                                    {{ $message->created_at->format('H:i') }}
                                                </p>
                                            </div>
                                            @if($message->sender_id == Auth::id())
                                                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center text-sm font-medium">
                                                    {{ substr(Auth::user()->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-gray-500 py-8">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Chat Input -->
                    <div class="border-t pt-4">
                        <div class="flex gap-2">
                            <input type="text" wire:model="chatMessage" 
                                   wire:keydown.enter="sendMessage"
                                   placeholder="Type your message..." 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                            <button wire:click="sendMessage" 
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
