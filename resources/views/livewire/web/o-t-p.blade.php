<!-- livewire.web.o-t-p.blade.php (Two-column layout like register page) -->
<div class="min-h-screen bg-gray-100 flex">
    <!-- Left side - Image Section (same as register page) -->
    <div class="hidden lg:block lg:w-1/2 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600  to-green-800 opacity-90"></div>
        <img src="{{ asset('/cars/image.png') }}" alt="Vehicle Financing" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12">
            <div class="max-w-md text-center">
                <h1 class="text-4xl font-bold mb-6">Verify Your Account</h1>
                <p class="text-xl mb-8">Complete your account verification to access all features.</p>
                <ul class="text-left space-y-4 mb-8">
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Secure account verification
                    </li>
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Quick and easy process
                    </li>
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Access to all features
                    </li>
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Enhanced security protection
                    </li>
                </ul>
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('about.us') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-white hover:bg-gray-50">
                        Learn More
                        <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right side - OTP Verification Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Verify Your Account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter the 5-digit code sent to your email
                </p>
                @if(!empty($maskedEmail))
                    <p class="mt-1 text-xs text-gray-500">Code sent to: {{ $maskedEmail }}</p>
                @endif
            </div>

            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="space-y-6">
                    <!-- Success message for resend -->
                    <div id="otp-success" class="hidden rounded-md bg-green-50 p-3 border border-green-200">
                        <p class="text-sm text-green-800" id="otp-success-text">A new verification code has been sent.</p>
                    </div>
                    <div>
                        <label for="full_otp" class="block text-sm font-medium text-gray-700">Verification Code</label>
                        <div class="mt-1">
                            <input
                                type="text"
                                wire:model.defer="full_otp"
                                maxlength="5"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                id="full_otp"
                                autocomplete="one-time-code"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                placeholder="Enter 5-digit code"
                                required
                            >
                        </div>
                        @error('full_otp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <button type="button" wire:click="logout" class="text-sm text-gray-600 hover:text-gray-700">
                            Cancel
                        </button>
                        <button type="button" wire:click.prevent="resendOTP" id="resend-btn" class="text-sm text-green-600 hover:text-green-700">
                            <span wire:loading.remove wire:target="resendOTP">Resend Code</span>
                            <span wire:loading wire:target="resendOTP">Sending...</span>
                        </button>
                        <button wire:click="verifyOTP" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="verifyOTP">Verify Account</span>
                            <span wire:loading wire:target="verifyOTP">Verifying...</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Version Banner (only shown on small screens) -->
            <div class="mt-10 lg:hidden bg-green-600 text-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-3">Verify Your Account</h3>
                <p class="mb-4">Complete your account verification to access all features.</p>
                <ul class="space-y-2 mb-4">
                    <li class="flex items-center">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Secure account verification
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Quick and easy process
                    </li>
                </ul>
                <a href="{{ route('about.us') }}" class="inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-600 bg-white hover:bg-gray-50">
                    Learn More
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Ensure only numbers
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.getElementById('full_otp');
            if (!input) return;
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5);
            });
            input.focus();

            // Listen for Livewire resend success event and show banner
            window.addEventListener('otp-resent', function (e) {
                var box = document.getElementById('otp-success');
                var text = document.getElementById('otp-success-text');
                if (text && e && e.detail && e.detail.message) {
                    text.textContent = e.detail.message;
                }
                if (box) {
                    box.classList.remove('hidden');
                    setTimeout(function () { box.classList.add('hidden'); }, 4000);
                }
            });
        });
    </script>
</div>
</div>