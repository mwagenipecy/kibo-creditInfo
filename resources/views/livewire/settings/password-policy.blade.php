<div class="max-w-4xl mx-auto p-6">
    
    <!-- Success Alert -->
    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-400 rounded-r-lg p-4 mb-6 shadow-sm" role="alert">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">The process is completed</h3>
                    <p class="text-sm text-green-700 mt-1">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Card Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h2 class="text-lg font-semibold text-gray-900">Password Policy Configuration</h2>
                    <p class="text-sm text-gray-600 mt-1">Set security requirements for user passwords</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-6 space-y-6">
            
            <!-- Password Requirements Section -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">1</span>
                    <h3 class="text-base font-medium text-gray-900">Password Composition Requirements</h3>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Special Character Requirement -->
                        <div class="bg-white rounded-lg border border-gray-200 p-3 hover:shadow-sm transition-all duration-150">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       value="1" 
                                       wire:model="requireSpecialCharacter"
                                       class="h-4 w-4 text-red-600 bg-gray-100 border-gray-300 rounded 
                                              focus:ring-red-500 focus:ring-2 transition duration-150">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900">Require Special Character</span>
                                    <p class="text-xs text-gray-500 mt-1">Must include symbols like !@#$%</p>
                                </div>
                            </label>
                        </div>

                        <!-- Uppercase Requirement -->
                        <div class="bg-white rounded-lg border border-gray-200 p-3 hover:shadow-sm transition-all duration-150">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       value="1" 
                                       wire:model="requireUppercase"
                                       class="h-4 w-4 text-red-600 bg-gray-100 border-gray-300 rounded 
                                              focus:ring-red-500 focus:ring-2 transition duration-150">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900">Require Uppercase</span>
                                    <p class="text-xs text-gray-500 mt-1">Must include capital letters A-Z</p>
                                </div>
                            </label>
                        </div>

                        <!-- Numeric Requirement -->
                        <div class="bg-white rounded-lg border border-gray-200 p-3 hover:shadow-sm transition-all duration-150">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       value="1" 
                                       wire:model="requireNumeric"
                                       class="h-4 w-4 text-red-600 bg-gray-100 border-gray-300 rounded 
                                              focus:ring-red-500 focus:ring-2 transition duration-150">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900">Require Numeric</span>
                                    <p class="text-xs text-gray-500 mt-1">Must include numbers 0-9</p>
                                </div>
                            </label>
                        </div>

                        <!-- Password Expiry -->
                        <div class="bg-white rounded-lg border border-gray-200 p-3 hover:shadow-sm transition-all duration-150">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       value="passwordExpire" 
                                       wire:model="passwordExpire"
                                       class="h-4 w-4 text-red-600 bg-gray-100 border-gray-300 rounded 
                                              focus:ring-red-500 focus:ring-2 transition duration-150">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900">Password Expiry</span>
                                    <p class="text-xs text-gray-500 mt-1">Auto-expire passwords after period</p>
                                </div>
                            </label>
                            
                            @if($this->passwordExpire)
                                <div class="mt-3 pl-7">
                                    <div class="flex items-center space-x-2">
                                        <input type="number"
                                               class="block w-20 px-3 py-1 border border-gray-300 rounded-md shadow-sm 
                                                      text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 
                                                      focus:border-red-500 transition duration-150"
                                               wire:model="passwordExpire1" 
                                               placeholder="90"
                                               required />
                                        <span class="text-sm text-gray-600">days</span>
                                    </div>
                                    @error('passwordExpire1')
                                        <p class="text-xs text-red-500 mt-1">Invalid input value for days</p>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Length & Security Section -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">2</span>
                    <h3 class="text-base font-medium text-gray-900">Password Length & Security Settings</h3>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Password Length -->
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            <div class="flex items-center justify-between mb-2">
                                <label for="length" class="text-sm font-medium text-gray-900">
                                    Minimum Password Length
                                </label>
                                <div class="flex items-center space-x-2">
                                    <input type="number"
                                           id="length"
                                           class="block w-16 px-3 py-1 border border-gray-300 rounded-md shadow-sm 
                                                  text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 
                                                  focus:border-red-500 transition duration-150"
                                           wire:model="length" 
                                           min="4" 
                                           max="128"
                                           placeholder="8"
                                           required />
                                    <span class="text-sm text-gray-600">characters</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">Recommended: 8-16 characters</p>
                        </div>

                        <!-- Attempt Limit -->
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            <div class="flex items-center justify-between mb-2">
                                <label for="limiter" class="text-sm font-medium text-gray-900">
                                    Login Attempt Limit
                                </label>
                                <div class="flex items-center space-x-2">
                                    <input type="number"
                                           id="limiter"
                                           class="block w-16 px-3 py-1 border border-gray-300 rounded-md shadow-sm 
                                                  text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 
                                                  focus:border-red-500 transition duration-150"
                                           wire:model="limiter" 
                                           min="1" 
                                           max="10"
                                           placeholder="5"
                                           required />
                                    <span class="text-sm text-gray-600">attempts</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">Account locks after failed attempts</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Policy Summary -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-blue-900">Policy Summary</h4>
                        <div class="mt-2 text-sm text-blue-800">
                            <p>Current policy requires passwords to:</p>
                            <ul class="list-disc list-inside mt-1 space-y-1">
                                @if($this->requireSpecialCharacter)
                                    <li>Include special characters</li>
                                @endif
                                @if($this->requireUppercase)
                                    <li>Include uppercase letters</li>
                                @endif
                                @if($this->requireNumeric)
                                    <li>Include numbers</li>
                                @endif
                                @if($this->length)
                                    <li>Be at least {{ $this->length }} characters long</li>
                                @endif
                                @if($this->passwordExpire && $this->passwordExpire1)
                                    <li>Expire after {{ $this->passwordExpire1 }} days</li>
                                @endif
                                @if($this->limiter)
                                    <li>Lock account after {{ $this->limiter }} failed attempts</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                
                <!-- Loading Button -->
                <div wire:loading wire:target="save">
                    <button disabled class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-400 cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-4 w-4 mr-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Please wait...
                    </button>
                </div>

                <!-- Save Button -->
                <div wire:loading.remove wire:target="save">
                    <button wire:click="save" class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Policy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced hover effects */
.hover\:shadow-sm:hover {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    transform: translateY(-1px);
}

/* Smooth transitions for all interactive elements */
* {
    transition: all 0.15s ease-in-out;
}

/* Focus states */
input:focus {
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* Loading animation */
@keyframes spin {
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Custom number input styling */
input[type="number"] {
    -moz-appearance: textfield;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Responsive improvements */
@media (max-width: 640px) {
    .grid-cols-1.sm\\:grid-cols-2 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }
}
</style>