<!-- livewire.web.o-t-p.blade.php -->
<div>
    <div class="min-h-screen flex">
        <!-- Left side - Image Section (Hidden on mobile) -->
        <div class="hidden lg:block lg:w-1/2 relative">
            <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-green-800 opacity-90"></div>
            <img src="{{ asset('/cars/image.png') }}" alt="Vehicle Financing" class="w-full h-full object-cover">
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12">
                <div class="max-w-md text-center">
                    <h1 class="text-4xl font-bold mb-6">Verify Your Account</h1>
                    <p class="text-xl mb-8">We've sent a one-time password to your phone and email. Enter it below to continue.</p>
                    <div class="space-y-6 mb-8">
                        <div class="flex items-center">
                            <svg class="h-8 w-8 mr-4 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div class="text-left">
                                <h3 class="font-semibold text-lg">Enhanced Security</h3>
                                <p>We use OTP verification to keep your account secure</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-8 w-8 mr-4 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-left">
                                <h3 class="font-semibold text-lg">Expires Soon</h3>
                                <p>Your OTP is valid for 10 minutes only</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-8 w-8 mr-4 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div class="text-left">
                                <h3 class="font-semibold text-lg">Multi-Channel</h3>
                                <p>OTP sent to both email and phone for your convenience</p>
                            </div>
                        </div>
                    </div>
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ route('home.page') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-white hover:bg-gray-50">
                            Back to Home
                            <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side - OTP Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Verify Your Identity
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        We've sent a verification code to your phone and email
                    </p>
                </div>

                <!-- Alert for successful registration -->
                <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                Registration successful! Please verify your account to continue.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form wire:submit.prevent="verifyOTP" class="space-y-6">
                        <div class="mb-6">
                            <div class="text-center mb-4">
                                <p class="text-sm text-gray-600">Enter the 6-digit code we sent to:</p>
                                <p class="font-medium text-gray-900">{{ substr($phone, 0, 3) . '*** ***' . substr($phone, -4) }}</p>
                                <p class="font-medium text-gray-900">{{ substr($email, 0, 1) . '***' . substr($email, strpos($email, '@')) }}</p>
                            </div>

                            <!-- OTP Input Fields -->
                            <div class="flex justify-center space-x-3 mb-4">
                                @for ($i = 1; $i <= 6; $i++)
                                <input type="text" wire:model.defer="otp{{ $i }}" maxlength="1" 
                                    class="w-12 h-12 text-center text-xl font-semibold border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                    x-on:input="moveToNextInput($event.target)" required>
                                @endfor
                            </div>

                            @error('otp')
                                <p class="mt-1 text-center text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @foreach(['otp1', 'otp2', 'otp3', 'otp4', 'otp5', 'otp6'] as $otpField)
                                @error($otpField)
                                    <p class="mt-1 text-center text-sm text-red-600">{{ $message }}</p>
                                    @break
                                @enderror
                            @endforeach
                        </div>

                        <!-- Timer and Resend Code -->
                        <div class="flex justify-between items-center text-sm">
                            <div class="text-gray-600">
                                <span x-data="{ timeLeft: {{ $otpExpiry }} }" 
                                      x-init="setInterval(() => { 
                                          if(timeLeft > 0) timeLeft--; 
                                          $dispatch('timerUpdated', { timeLeft: timeLeft });
                                      }, 1000)"
                                      x-text="Math.floor(timeLeft / 60) + ':' + (timeLeft % 60 < 10 ? '0' : '') + (timeLeft % 60)">
                                    09:59
                                </span> remaining
                            </div>
                            <button type="button" wire:click="resendOTP" 
                                    x-data
                                    x-on:timerUpdated.window="$el.disabled = $event.detail.timeLeft > 0"
                                    class="font-medium text-green-600 hover:text-green-500">
                                Resend Code
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Verify Account
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 text-center">
                       
                   


                        <div class="flex items-center justify-center">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="font-medium text-green-600 hover:text-green-500 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                                Back to Login
                            </button>
                        </form>
                    </div>


                    </div>
                </div>

                <!-- Mobile Version Banner (only shown on small screens) -->
                <div class="mt-10 lg:hidden bg-green-600 text-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-3">Verify Your Account</h3>
                    <p class="mb-4">We've sent a one-time password to your phone and email. Enter it above to continue.</p>
                    <ul class="space-y-2 mb-4">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Enhanced security for your account
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            OTP valid for 10 minutes only
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for OTP functionality -->
    <script>
        function moveToNextInput(field) {
            // Allow only numbers
            field.value = field.value.replace(/[^0-9]/g, '');
            
            // Move to next input if value is entered
            if (field.value !== '') {
                const nextField = field.nextElementSibling;
                if (nextField) {
                    nextField.focus();
                }
            }
        }
        
        // We'll set up Livewire event listeners
        document.addEventListener('livewire:load', function () {
            Livewire.on('otp-sent', function (data) {
                alert(data.message);
            });
            
            Livewire.on('otp-resent', function (data) {
                alert(data.message);
                
                // Clear OTP fields and focus on first field
                const otpInputs = document.querySelectorAll('input[wire\\:model\\.defer^="otp"]');
                otpInputs.forEach(input => {
                    input.value = '';
                });
                
                // Focus on first field
                otpInputs[0].focus();
            });
        });
    </script>
</div>