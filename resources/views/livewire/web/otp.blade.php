<div>
    <!-- OTP Verification Form -->
    <div class="py-3 rounded text-center">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">OTP Verification</h1>
        
        <div class="flex flex-col mt-4 mb-4">
            <span class="text-gray-600">Enter the OTP you received at</span>
            <span class="font-bold text-gray-900">{{ auth()->user()->email }}</span>
        </div>

        <!-- Timer Display -->
        <div id="countdown" class="text-lg font-semibold text-green-600 mb-4">
            {{ $otpExpiry > 0 ? gmdate('i:s', $otpExpiry) : '00:00' }}
        </div>

        <!-- Error Messages -->
        @error('otp')
            <div class="text-red-600 text-sm mb-4">{{ $message }}</div>
        @enderror

        <!-- Success/Test Messages -->
        @if (session('test_otp'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                <strong>Test Mode:</strong> Your OTP is: {{ session('test_otp') }}
            </div>
        @endif

        <!-- OTP Input Fields -->
        <div id="otp" class="flex flex-row justify-center text-center px-2 mt-5 mb-6">
            <input wire:model="otp1" 
                   class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-12 w-12 text-center form-control rounded text-lg font-bold" 
                   type="text" 
                   id="otp1" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp2" 
                   class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-12 w-12 text-center form-control rounded text-lg font-bold" 
                   type="text" 
                   id="otp2" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp3" 
                   class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-12 w-12 text-center form-control rounded text-lg font-bold" 
                   type="text" 
                   id="otp3" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp4" 
                   class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-12 w-12 text-center form-control rounded text-lg font-bold" 
                   type="text" 
                   id="otp4" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp5" 
                   class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-12 w-12 text-center form-control rounded text-lg font-bold" 
                   type="text" 
                   id="otp5" 
                   maxlength="1" 
                   autocomplete="off" />
            <input wire:model="otp6" 
                   class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-12 w-12 text-center form-control rounded text-lg font-bold" 
                   type="text" 
                   id="otp6" 
                   maxlength="1" 
                   autocomplete="off" />
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col space-y-4 mt-6">
            <!-- Resend OTP Button -->
            <div class="flex justify-center">
                <div wire:loading wire:target="resendOTP">
                    <button disabled class="flex items-center text-gray-500 cursor-not-allowed">
                        <span class="font-bold">Please wait...</span>
                        <i class='bx bx-caret-right ml-1'></i>
                    </button>
                </div>
                <div wire:loading.remove wire:target="resendOTP">
                    <button wire:click="resendOTP" 
                            class="flex items-center text-blue-700 hover:text-blue-900 cursor-pointer transition-colors">
                        <span class="font-bold">Resend OTP</span>
                        <i class='bx bx-caret-right ml-1'></i>
                    </button>
                </div>
            </div>

            <!-- Cancel Button -->
            <div class="flex justify-center">
                <div wire:loading wire:target="logout">
                    <button disabled class="p-2 text-sm font-medium text-gray-500 cursor-not-allowed bg-gray-100 rounded-lg border border-gray-200">
                        Please wait...
                    </button>
                </div>
                <div wire:loading.remove wire:target="logout">
                    <button wire:click="logout" 
                            type="button" 
                            class="p-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                        Cancel
                    </button>
                </div>
            </div>
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
