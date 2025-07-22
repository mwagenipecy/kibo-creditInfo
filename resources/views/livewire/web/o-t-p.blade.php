<!-- livewire.web.o-t-p.blade.php -->
<div >
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
                                Please verify your account to continue.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Show test OTP in development -->
                @if(session('test_otp') && app()->environment('local', 'testing'))
                    <div class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Test Environment:</strong> Your OTP is <strong>{{ session('test_otp') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <div  class="space-y-6">
                        <div class="mb-6">
                            <div class="text-center mb-4">
                                <p class="text-sm text-gray-600">Enter the 6-digit code we sent to:</p>
                                @if($phone)
                                    <p class="font-medium text-gray-900">{{ substr($phone, 0, 3) . '*** ***' . substr($phone, -4) }}</p>
                                @endif
                                <p class="font-medium text-gray-900">{{ substr($email, 0, 1) . '***' . substr($email, strpos($email, '@')) }}</p>
                            </div>

                            <!-- OTP Input Fields -->
                            <div class="flex justify-center space-x-3 mb-4" id="otp-container" wire:ignore>
                                @for ($i = 1; $i <= 6; $i++)
                                <input 
                                    type="text" 
                                    wire:model.lazy="otp{{ $i }}" 
                                    maxlength="1" 
                                    class="w-12 h-12 text-center text-xl font-semibold border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                                    id="otp{{ $i }}"
                                    data-position="{{ $i }}"
                                    autocomplete="off"
                                    required>
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
                                <span id="timer-display">
                                    {{ $otpExpiry > 0 ? gmdate('i:s', $otpExpiry) : '0:00' }}
                                </span> remaining
                            </div>
                            <button type="button" 
                                    wire:click.prevent="resendOTP" 
                                    id="resend-btn"
                                    class="font-medium transition-colors duration-200 text-green-600 hover:text-green-500">
                                <span wire:loading.remove wire:target="resendOTP">Resend Code</span>
                                <span wire:loading wire:target="resendOTP">Sending...</span>
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <div>
                        <button wire:click="verifyOTP" 
    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
    wire:loading.attr="disabled">

    {{-- Show this span when not loading --}}
    <span wire:loading.remove wire:target="verifyOTP">Verify Account</span>

    {{-- Show this span when loading --}}
    <span wire:loading.flex wire:target="verifyOTP" class="items-center">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 
                  3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Verifying...
    </span>
</button>


                        </div>
                        </div>

                    <div class="mt-6 text-center">
                        <div class="flex items-center justify-center">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="font-medium text-green-600 hover:text-green-500 flex items-center transition-colors duration-200">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeOTPComponent();
        });

        // Initialize when Livewire loads
        document.addEventListener('livewire:load', function() {
            initializeOTPComponent();
        });

        // Reinitialize after Livewire updates
        document.addEventListener('livewire:updated', function() {
            setTimeout(initializeOTPComponent, 100);
        });

        let timerInterval;
        let timeLeft = {{ $otpExpiry > 0 ? $otpExpiry : 0 }};

        function initializeOTPComponent() {
            setupOTPInputs();
            startTimer();
            focusFirstInput();
        }

        function setupOTPInputs() {
            const inputs = document.querySelectorAll('#otp-container input');
            
            inputs.forEach((input, index) => {
                // Remove existing event listeners
                input.removeEventListener('input', handleOtpInput);
                input.removeEventListener('keydown', handleOtpKeydown);
                input.removeEventListener('paste', handleOtpPaste);
                
                // Add fresh event listeners
                input.addEventListener('input', function(e) {
                    handleOtpInput(e, index + 1);
                });
                
                input.addEventListener('keydown', function(e) {
                    handleOtpKeydown(e, index + 1);
                });
                
                input.addEventListener('paste', function(e) {
                    handleOtpPaste(e);
                });
            });
        }

        function startTimer() {
            const timerDisplay = document.getElementById('timer-display');
            const resendBtn = document.getElementById('resend-btn');
            
            if (!timerDisplay || !resendBtn) return;
            
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            
            timerInterval = setInterval(function() {
                if (timeLeft > 0) {
                    timeLeft--;
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    timerDisplay.textContent = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                    
                    if (timeLeft > 0) {
                        resendBtn.disabled = true;
                        resendBtn.className = 'font-medium text-gray-400 cursor-not-allowed transition-colors duration-200';
                    } else {
                        resendBtn.disabled = false;
                        resendBtn.className = 'font-medium text-green-600 hover:text-green-500 cursor-pointer transition-colors duration-200';
                    }
                } else {
                    clearInterval(timerInterval);
                    timerDisplay.textContent = '0:00';
                    resendBtn.disabled = false;
                    resendBtn.className = 'font-medium text-green-600 hover:text-green-500 cursor-pointer transition-colors duration-200';
                }
            }, 1000);
        }

        function focusFirstInput() {
            setTimeout(function() {
                const firstInput = document.getElementById('otp1');
                if (firstInput) {
                    firstInput.focus();
                }
            }, 100);
        }

        function handleOtpInput(event, position) {
            const element = event.target;
            const value = element.value;
            
            // Allow only numbers
            const numericValue = value.replace(/[^0-9]/g, '');
            element.value = numericValue;
            
            // Update Livewire model
            @this.set('otp' + position, numericValue);
            
            // Move to next input if value is entered and not the last input
            if (numericValue && position < 6) {
                const nextInput = document.getElementById('otp' + (position + 1));
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        function handleOtpKeydown(event, position) {
            const element = event.target;
            
            if (event.key === 'Backspace') {
                if (!element.value && position > 1) {
                    const prevInput = document.getElementById('otp' + (position - 1));
                    if (prevInput) {
                        prevInput.focus();
                        prevInput.select();
                    }
                }
            }
            
            if (event.key === 'Delete') {
                element.value = '';
                @this.set('otp' + position, '');
            }
            
            if (event.key === 'ArrowLeft' && position > 1) {
                event.preventDefault();
                const prevInput = document.getElementById('otp' + (position - 1));
                if (prevInput) {
                    prevInput.focus();
                }
            }
            
            if (event.key === 'ArrowRight' && position < 6) {
                event.preventDefault();
                const nextInput = document.getElementById('otp' + (position + 1));
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        function handleOtpPaste(event) {
            event.preventDefault();
            
            const pastedData = (event.clipboardData || window.clipboardData).getData('text');
            const otpCode = pastedData.replace(/[^0-9]/g, '').slice(0, 6);
            
            for (let i = 0; i < otpCode.length && i < 6; i++) {
                const input = document.getElementById('otp' + (i + 1));
                if (input) {
                    input.value = otpCode[i];
                    @this.set('otp' + (i + 1), otpCode[i]);
                }
            }
            
            const nextEmptyIndex = otpCode.length < 6 ? otpCode.length + 1 : 6;
            if (nextEmptyIndex <= 6) {
                const nextInput = document.getElementById('otp' + nextEmptyIndex);
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        function clearOtpInputs() {
            for (let i = 1; i <= 6; i++) {
                const input = document.getElementById('otp' + i);
                if (input) {
                    input.value = '';
                }
            }
            focusFirstInput();
        }

        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(n => n.remove());
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'notification fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-lg shadow-lg border-l-4 p-4 transform transition-transform duration-300';
            
            if (type === 'success') {
                notification.classList.add('border-green-500');
            } else if (type === 'error') {
                notification.classList.add('border-red-500');
            } else {
                notification.classList.add('border-blue-500');
            }
            
            notification.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 ${type === 'success' ? 'text-green-400' : type === 'error' ? 'text-red-400' : 'text-blue-400'}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            ${type === 'success' ? 
                                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />' :
                                '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />'
                            }
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">${message}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 5000);
        }

        // Livewire event listeners
        window.addEventListener('otp-sent', function(event) {
            showNotification(event.detail.message, 'success');
        });
        
        window.addEventListener('otp-resent', function(event) {
            showNotification(event.detail.message, 'success');
            clearOtpInputs();
            // Reset timer
            if (event.detail.timeLeft) {
                timeLeft = event.detail.timeLeft;
                startTimer();
            }
        });
        
        window.addEventListener('clear-otp-fields', function() {
            clearOtpInputs();
        });
    </script>



</div>