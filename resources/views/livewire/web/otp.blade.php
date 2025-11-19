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
   

    <!-- OTP Input Field -->
    <div class="mb-8 max-w-sm mx-auto">
        <label for="otp_code" class="block text-sm font-medium text-gray-700 text-center mb-4">
            Verification Code
        </label>
        <input
            id="otp_code"
            type="number"
            inputmode="numeric"
            pattern="[0-9]*"
            maxlength="6"
            autocomplete="one-time-code"
            wire:model.live="full_otp"
            min="0"
            max="999999"
            step="1"
            class="w-full text-center tracking-widest text-2xl font-semibold px-4 py-3 border-2 border-gray-300 rounded-xl shadow-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
            placeholder="Enter 6-digit code"
            oninput="sanitizeOtpInput(this)"
        />
        <p class="text-center text-sm text-gray-500 mt-2">
            Enter the 6-digit code we sent to your email{{ $phone ? ' and phone' : '' }}.
        </p>
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
        function sanitizeOtpInput(input) {
            const sanitized = (input.value || '').replace(/\D/g, '').slice(0, 6);
            if (input.value !== sanitized) {
                input.value = sanitized;
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
            
            // Handle OTP verification redirect
            Livewire.on('otp-verified', (data) => {
                // Show success message
                if (data.message) {
                    alert(data.message);
                }
                
                // Redirect to the specified URL
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            });
            
        });
        
        // Auto-focus first input on page load
        document.addEventListener('DOMContentLoaded', function() {
            const firstInput = document.getElementById('otp_code');
            if (firstInput) {
                firstInput.focus();
            }
        });
    </script>
</div>
