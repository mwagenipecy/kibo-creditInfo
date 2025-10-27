<div>
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <svg class="animate-spin h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-gray-700 font-medium">Verifying...</span>
            </div>
        </div>
    </div>

    <!-- User Email Display -->
    <div class="text-center mb-6">
        <span class="text-gray-600 text-sm">Code sent to: {{ substr(auth()->user()->email, 0, 2) . '****' . substr(auth()->user()->email, strpos(auth()->user()->email, '@')) }}</span>
    </div>

    <!-- Timer Display -->
    <div id="countdown" class="text-center text-lg font-semibold text-green-600 mb-6">
        {{ $otpExpiry > 0 ? gmdate('i:s', $otpExpiry) : '00:00' }}
    </div>

    <!-- Error Messages -->
    @error('otp')
        <div class="text-red-600 text-sm text-center mb-4">{{ $message }}</div>
    @enderror

    <!-- Success/Test Messages -->
    @if (session('test_otp'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4 text-center">
            <strong>Test Mode:</strong> Your OTP is: {{ session('test_otp') }}
        </div>
    @endif

    <!-- OTP Input Fields -->
    <div class="mb-8">
        <label class="block text-sm font-medium text-gray-700 text-center mb-4">Verification Code</label>
        <div class="flex flex-row justify-center text-center px-2">
            <input wire:model.live="otp1"
                   @keydown="handleKeyDown($event, 1)"
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model.live="otp2"
                   @keydown="handleKeyDown($event, 2)"
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model.live="otp3"
                   @keydown="handleKeyDown($event, 3)"
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model.live="otp4"
                   @keydown="handleKeyDown($event, 4)"
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model.live="otp5"
                   @keydown="handleKeyDown($event, 5)"
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model.live="otp6"
                   @keydown="handleKeyDown($event, 6)"
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   maxlength="1" 
                   autocomplete="off" />
        </div>
        <p class="text-center text-sm text-gray-500 mt-2">Enter 6-digit code</p>
    </div>

    <!-- Action Buttons -->
    <div class="space-y-4">
        <!-- Cancel Button -->
        <div class="text-center">
            <div wire:loading wire:target="logout">
                <button disabled class="px-6 py-2 text-sm font-medium text-gray-500 cursor-not-allowed bg-gray-100 rounded-lg border border-gray-200">
                    Please wait...
                </button>
            </div>
            <div wire:loading.remove wire:target="logout">
                <button wire:click="logout" 
                        type="button" 
                        class="px-6 py-2 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-300 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                    Cancel
                </button>
            </div>
        </div>

        <!-- Resend OTP Button -->
        <div class="text-center">
            <div wire:loading wire:target="resendOTP">
                <button disabled class="text-gray-500 cursor-not-allowed font-medium">
                    Please wait...
                </button>
            </div>
            <div wire:loading.remove wire:target="resendOTP">
                <button wire:click="resendOTP" 
                        class="text-green-600 hover:text-green-700 cursor-pointer transition-colors font-medium">
                    Resend Code
                </button>
            </div>
        </div>

        <!-- Verify Button -->
        <div class="text-center">
            <div wire:loading wire:target="verifyOTP">
                <button disabled class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 cursor-not-allowed">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Verifying...
                </button>
            </div>
            <div wire:loading.remove wire:target="verifyOTP">
                <button wire:click="verifyOTP" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                    Verify Account
                </button>
            </div>
        </div>
    </div>

    <script>
        // Handle keyboard input for OTP fields
        function handleKeyDown(event, fieldNumber) {
            const key = event.key;
            
            // Allow only numbers
            if (!/^[0-9]$/.test(key) && key !== 'Backspace' && key !== 'Delete' && key !== 'ArrowLeft' && key !== 'ArrowRight' && key !== 'Tab') {
                event.preventDefault();
                return;
            }
            
            // Handle numbers
            if (/^[0-9]$/.test(key)) {
                event.preventDefault();
                
                // Set the value using Livewire
                @this.set('otp' + fieldNumber, key);
                
                // Focus next field
                if (fieldNumber < 6) {
                    setTimeout(() => {
                        const nextField = document.querySelector(`input[wire\\:model\\.live="otp${fieldNumber + 1}"]`);
                        if (nextField) {
                            nextField.focus();
                        }
                    }, 10);
                }
            }
            
            // Handle backspace
            if (key === 'Backspace' || key === 'Delete') {
                setTimeout(() => {
                    const currentField = document.querySelector(`input[wire\\:model\\.live="otp${fieldNumber}"]`);
                    if (!currentField.value && fieldNumber > 1) {
                        const prevField = document.querySelector(`input[wire\\:model\\.live="otp${fieldNumber - 1}"]`);
                        if (prevField) {
                            prevField.focus();
                        }
                    }
                }, 10);
            }
        }

        // Timer countdown using Livewire
        let timeLeft = {{ $otpExpiry }};
        const countdownElement = document.getElementById('countdown');
        
        if (timeLeft > 0) {
            const timer = setInterval(() => {
                timeLeft--;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    countdownElement.textContent = '00:00';
                    countdownElement.className = 'text-lg font-semibold text-red-600 mb-6';
                } else {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }
            }, 1000);
        }

        // Livewire event listeners
        document.addEventListener('livewire:load', function () {
            Livewire.on('otp-sent', (data) => {
                alert(data.message);
            });
            
            // Handle OTP verification events
            Livewire.on('otp-verified', (data) => {
                // Show success message
                if (data.message) {
                    alert(data.message);
                }
                
                // Redirect to the specified URL
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 500);
                }
            });
            
            // Monitor Livewire updates to detect when verification completes
            Livewire.hook('message.processed', (message, component) => {
                // Check if we're getting redirected
                if (component.fingerprint.name === 'web.o-t-p') {
                    // If the component is trying to redirect, show loading
                    const loadingOverlay = document.getElementById('loading-overlay');
                    if (message.response.effects?.redirect) {
                        if (loadingOverlay) {
                            loadingOverlay.classList.remove('hidden');
                        }
                    }
                }
            });
            
            // Watch for all fields filled and auto-verify
            Livewire.hook('message.processed', (message, component) => {
                if (message.component.fingerprint.name === 'web.o-t-p') {
                    const otp1 = document.querySelector('input[wire\\:model\\.live="otp1"]').value;
                    const otp2 = document.querySelector('input[wire\\:model\\.live="otp2"]').value;
                    const otp3 = document.querySelector('input[wire\\:model\\.live="otp3"]').value;
                    const otp4 = document.querySelector('input[wire\\:model\\.live="otp4"]').value;
                    const otp5 = document.querySelector('input[wire\\:model\\.live="otp5"]').value;
                    const otp6 = document.querySelector('input[wire\\:model\\.live="otp6"]').value;
                    
                    if (otp1 && otp2 && otp3 && otp4 && otp5 && otp6) {
                        // All fields filled, auto-verify after a short delay
                        setTimeout(() => {
                            @this.call('verifyOTP');
                        }, 500);
                    }
                }
            });
        });
        
        // Auto-focus first input on page load
        document.addEventListener('DOMContentLoaded', function() {
            const firstInput = document.querySelector('input[wire\\:model\\.live="otp1"]');
            if (firstInput) {
                firstInput.focus();
            }
            
            // Add click handler to verify button to show loading overlay
            const verifyButtons = document.querySelectorAll('button[wire\\:click="verifyOTP"]');
            verifyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const loadingOverlay = document.getElementById('loading-overlay');
                    if (loadingOverlay) {
                        loadingOverlay.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</div>