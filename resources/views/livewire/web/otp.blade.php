<div>
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
        <div id="otp" class="flex flex-row justify-center text-center px-2">
            <input wire:model="otp1" 
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   id="otp1" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp2" 
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   id="otp2" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp3" 
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   id="otp3" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp4" 
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   id="otp4" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp5" 
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   id="otp5" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp6" 
                   class="m-2 border-2 border-gray-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 focus:ring-opacity-50 h-14 w-14 text-center rounded-lg text-xl font-bold shadow-sm" 
                   type="text" 
                   id="otp6" 
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
            <button wire:click="verifyOTP" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                Verify Account
            </button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Auto-focus first input
            document.getElementById('otp1').focus();

            // OTP Input handling
            const inputs = document.querySelectorAll('#otp input');
            
            inputs.forEach((input, index) => {
                input.addEventListener('keydown', function(event) {
                    // Handle backspace
                    if (event.key === "Backspace") {
                        if (input.value === '' && index > 0) {
                            inputs[index - 1].focus();
                        }
                        input.value = '';
                        return;
                    }

                    // Handle number input
                    if (event.key >= '0' && event.key <= '9') {
                        input.value = event.key;
                        
                        // Auto-focus next input
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        } else {
                            // All inputs filled, trigger verification
                            setTimeout(() => {
                                let otpValue = '';
                                inputs.forEach(inp => otpValue += inp.value);
                                
                                if (otpValue.length === 6) {
                                    // Trigger Livewire method
                                    @this.call('verifyOTP');
                                }
                            }, 100);
                        }
                    }
                });

                // Handle paste
                input.addEventListener('paste', function(event) {
                    event.preventDefault();
                    const pastedData = event.clipboardData.getData('text');
                    const numbers = pastedData.replace(/\D/g, '').split('');
                    
                    if (numbers.length >= 6) {
                        inputs.forEach((inp, idx) => {
                            if (idx < 6) {
                                inp.value = numbers[idx] || '';
                            }
                        });
                        
                        // Focus last input
                        inputs[5].focus();
                        
                        // Trigger verification
                        setTimeout(() => {
                            @this.call('verifyOTP');
                        }, 100);
                    }
                });
            });
        });

        // Timer countdown
        let timeLeft = {{ $otpExpiry }};
        const countdownElement = document.getElementById('countdown');
        
        if (timeLeft > 0) {
            const timer = setInterval(() => {
                timeLeft--;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    countdownElement.textContent = '00:00';
                    countdownElement.className = 'text-lg font-semibold text-red-600 mb-4';
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
        });
    </script>
</div>
