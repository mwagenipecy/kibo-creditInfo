<div class="fixed bottom-4 right-4 z-40 sm:z-50" 
     x-data="{ 
         open: @entangle('isOpen'),
         minimized: @entangle('isMinimized'),
         unreadCount: @entangle('unreadCount')
     }"
     x-init="
         // Ensure header is always visible
         $nextTick(() => {
             const header = document.getElementById('chat-header');
             if (header) {
                 header.style.display = 'flex';
                 header.style.visibility = 'visible';
                 header.style.opacity = '1';
                 header.style.height = '3rem';
                 header.style.minHeight = '3rem';
             }
         });
         
         $watch('open', value => {
             if (value) {
                 setTimeout(() => {
                     $dispatch('scrollToBottom');
                     const input = $refs.chatInput;
                     if (input) {
                         input.focus();
                     }
                     // Ensure header stays visible
                     const header = document.getElementById('chat-header');
                     if (header) {
                         header.style.display = 'flex';
                         header.style.visibility = 'visible';
                         header.style.opacity = '1';
                         header.style.height = '3rem';
                         header.style.minHeight = '3rem';
                     }
                 }, 200);
             }
         });
         $watch('minimized', value => {
             if (!value) {
                 setTimeout(() => {
                     $dispatch('scrollToBottom');
                     const input = $refs.chatInput;
                     if (input) {
                         input.focus();
                     }
                     // Ensure header stays visible
                     const header = document.getElementById('chat-header');
                     if (header) {
                         header.style.display = 'flex';
                         header.style.visibility = 'visible';
                         header.style.opacity = '1';
                         header.style.height = '3rem';
                         header.style.minHeight = '3rem';
                     }
                 }, 200);
             }
         });
     ">
    <div class="flex flex-col items-end space-y-2">
        <!-- Debug Header - Always Visible -->
        <div x-show="open" class="w-72 sm:w-80 md:w-96 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-t-2xl px-3 py-2 flex items-center justify-between" style="height: 3rem; z-index: 1000;">
            <div class="flex items-center space-x-2">
                <div class="h-6 w-6 rounded-full bg-white/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div>
                    <div class="font-semibold text-xs">KiboAuto AI</div>
                    <div class="text-xs text-green-100">Online</div>
                </div>
            </div>
            <div class="flex items-center space-x-1">
                <select wire:model="language" class="bg-white/20 text-white text-xs rounded px-1 py-1">
                    <option value="en">EN</option>
                    <option value="sw">SW</option>
                </select>
                <button @click="minimized = !minimized" class="p-1 rounded hover:bg-white/20" title="Minimize">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button @click="open = false" class="p-1 rounded hover:bg-white/20" title="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Chat Window -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="w-72 sm:w-80 md:w-96 bg-white rounded-b-2xl shadow-2xl border border-gray-200 border-t-0"
             :class="minimized ? 'h-16' : 'h-80 sm:h-96'"
             x-bind:style="minimized ? 'height: 4rem;' : ''"
             style="max-height: calc(100vh - 6rem); min-height: 4rem; display: flex; flex-direction: column;">
            
         

            <!-- Chat Messages -->
            <div x-show="!minimized" 
                 class="flex-1 overflow-y-auto p-3 sm:p-4 space-y-2 sm:space-y-3 bg-gray-50"
                 x-ref="messagesContainer"
                 style="min-height: 0; flex: 1;">
                @forelse($messages as $message)
                    <div class="flex {{ $message['sender'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%] sm:max-w-[80%] relative">
                            @if($message['sender'] === 'user')
                                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-3 sm:px-4 py-2 rounded-2xl rounded-br-md text-xs sm:text-sm">
                                    {{ $message['text'] }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1 text-right">{{ $message['timestamp'] }}</div>
                            @else
                                <div class="bg-white text-gray-800 px-3 sm:px-4 py-2 rounded-2xl rounded-bl-md text-xs sm:text-sm shadow-sm border border-gray-100">
                                    {{ $message['text'] }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">{{ $message['timestamp'] }}</div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 text-sm pt-8">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <p>{{ $language === 'sw' ? 'Anza mazungumzo...' : 'Start the conversation...' }}</p>
                    </div>
                @endforelse

                <!-- Typing indicator -->
                <div class="flex justify-start" wire:loading wire:target="sendMessage">
                    <div class="bg-white text-gray-800 px-4 py-2 rounded-2xl rounded-bl-md text-sm shadow-sm border border-gray-100">
                        <div class="flex items-center space-x-1">
                            <span class="sr-only">Typing…</span>
                            <span class="dot h-2 w-2 rounded-full bg-gray-400 inline-block"></span>
                            <span class="dot h-2 w-2 rounded-full bg-gray-400 inline-block"></span>
                            <span class="dot h-2 w-2 rounded-full bg-gray-400 inline-block"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div x-show="!minimized && showQuickActions && count($messages) <= 1" 
                 class="px-3 sm:px-4 py-2 bg-white border-t border-gray-100 flex-shrink-0">
                <div class="text-xs text-gray-500 mb-2">{{ $language === 'sw' ? 'Haraka:' : 'Quick actions:' }}</div>
                <div class="flex flex-wrap gap-1">
                    @php
                        $quickActions = [
                            'en' => ['help' => 'Help', 'loan' => 'Loans', 'vehicle' => 'Vehicles', 'spare' => 'Parts'],
                            'sw' => ['help' => 'Msaada', 'loan' => 'Mikopo', 'vehicle' => 'Magari', 'spare' => 'Vipuri']
                        ];
                    @endphp
                    @foreach($quickActions[$language] as $key => $label)
                        <button wire:click="sendQuickAction('{{ $key }}')" 
                                class="px-2 py-1 text-xs bg-gray-100 hover:bg-green-100 text-gray-700 hover:text-green-700 rounded-full transition-colors">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Input Form -->
            <form wire:submit.prevent="sendMessage" 
                  class="border-t bg-white p-2 sm:p-3 flex-shrink-0"
                  x-show="!minimized">
                <div class="flex items-center space-x-2">
                    <input type="text" 
                           wire:model="currentMessage" 
                           placeholder="{{ $language === 'sw' ? 'Andika ujumbe...' : 'Type a message...' }}" 
                           class="flex-1 px-3 py-2 text-xs sm:text-sm border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                           wire:loading.attr="disabled" 
                           wire:target="sendMessage"
                           x-ref="chatInput"
                           @keydown.enter.prevent="if (!$event.shiftKey) $wire.sendMessage()"
                           @input="$wire.currentMessage = $event.target.value">
                    <button type="submit" 
                            class="p-2 bg-green-600 hover:bg-green-700 text-white rounded-full disabled:opacity-60 transition-colors" 
                            wire:loading.attr="disabled" 
                            wire:target="sendMessage">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 2L11 13" />
                            <path d="M22 2l-7 20-4-9-9-4 20-7z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Chat Toggle Button -->
        <button @click="open = !open" 
                class="relative flex items-center space-x-1 sm:space-x-2 px-3 sm:px-4 py-2 sm:py-3 rounded-full shadow-2xl bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white transition-all duration-200 transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="font-medium text-xs sm:text-sm hidden sm:inline">{{ $language === 'sw' ? 'Zungumza Nasi' : 'Chat with us' }}</span>
            <span class="font-medium text-xs sm:hidden">{{ $language === 'sw' ? 'Chat' : 'Chat' }}</span>
            
            <!-- Unread Count Badge -->
            <span x-show="unreadCount > 0" 
                  x-text="unreadCount"
                  class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 bg-red-500 text-white text-xs rounded-full h-4 w-4 sm:h-5 sm:w-5 flex items-center justify-center font-bold">
            </span>
        </button>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure chat header is always visible
    function ensureHeaderVisible() {
        const header = document.getElementById('chat-header');
        if (header) {
            header.style.display = 'flex';
            header.style.visibility = 'visible';
            header.style.opacity = '1';
            header.style.height = '3rem';
            header.style.minHeight = '3rem';
            header.style.position = 'relative';
            header.style.zIndex = '100';
        }
    }

    // Run immediately
    ensureHeaderVisible();

    // Run every 100ms to ensure it stays visible
    setInterval(ensureHeaderVisible, 100);

    // Auto-scroll to bottom when new messages arrive
    window.livewire.on('scrollToBottom', () => {
        setTimeout(() => {
            const container = document.querySelector('[x-ref="messagesContainer"]');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }, 100);
    });

    // Focus input when requested
    window.livewire.on('focusChatInput', () => {
        setTimeout(() => {
            const input = document.querySelector('[x-ref="chatInput"]');
            if (input) {
                input.focus();
            }
        }, 100);
    });

    // Auto-focus input when chat opens
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            if (component.el.querySelector('[x-ref="chatInput"]')) {
                const input = component.el.querySelector('[x-ref="chatInput"]');
                if (input && !input.disabled) {
                    input.focus();
                }
            }
            // Ensure header stays visible after Livewire updates
            ensureHeaderVisible();
        });
    });
});
</script>

<style>
@keyframes blink {
    0% { opacity: 0.2; }
    20% { opacity: 1; }
    100% { opacity: 0.2; }
}
.dot { animation: blink 1.4s infinite both; }
.dot:nth-child(1) { animation-delay: 0s; }
.dot:nth-child(2) { animation-delay: 0.2s; }
.dot:nth-child(3) { animation-delay: 0.4s; }

/* Custom scrollbar for chat messages */
.h-48::-webkit-scrollbar,
.h-64::-webkit-scrollbar {
    width: 4px;
}
.h-48::-webkit-scrollbar-track,
.h-64::-webkit-scrollbar-track {
    background: #f1f5f9;
}
.h-48::-webkit-scrollbar-thumb,
.h-64::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 2px;
}
.h-48::-webkit-scrollbar-thumb:hover,
.h-64::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Ensure header is always visible */
#chat-header,
.chat-header {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 100 !important;
    height: 3rem !important;
    min-height: 3rem !important;
}

.fixed.bottom-4.right-4 #chat-header,
.fixed.bottom-4.right-4 .chat-header {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 100 !important;
}

/* Mobile responsive adjustments */
@media (max-width: 640px) {
    .fixed.bottom-4.right-4 {
        bottom: 1rem;
        right: 1rem;
        left: 1rem;
        width: auto;
    }
    
    .fixed.bottom-4.right-4 > div {
        width: 100%;
        max-width: none;
    }
    
    .fixed.bottom-4.right-4 .w-72 {
        width: 100%;
    }
    
    /* Ensure header is always visible on mobile */
    .fixed.bottom-4.right-4 .min-h-\[3rem\] {
        min-height: 3rem;
        padding: 0.5rem;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    /* Make sure buttons are touch-friendly */
    .fixed.bottom-4.right-4 button {
        min-height: 2rem;
        min-width: 2rem;
    }
    
    /* Ensure language selector is visible */
    .fixed.bottom-4.right-4 select {
        min-width: 3rem;
        font-size: 0.75rem;
    }
}

/* Smooth transitions */
.transition-all {
    transition: all 0.2s ease-in-out;
}

/* Hover effects */
.hover\:scale-105:hover {
    transform: scale(1.05);
}

/* Gradient animations */
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.bg-gradient-to-r {
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
}
</style>
