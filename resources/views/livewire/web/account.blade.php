<div>


    <div class="bg-white">
        <!-- Breadcrumb -->
        <div class="bg-gray-100 py-4 border-b border-gray-200">
            <div class="container mx-auto px-4 md:px-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 transition duration-300">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Profile Settings</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Page Header -->
        <div class="py-6 border-b border-gray-200 bg-white">
            <div class="container mx-auto px-4 md:px-8">
                <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
                <p class="mt-1 text-sm text-gray-600">Manage your account information and preferences</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 md:px-8 py-8">
            <!-- Alerts -->
            @if (session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Sidebar Navigation -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h2 class="text-sm font-medium text-gray-900">John Doe</h2>
                                    <p class="text-xs text-gray-500">john.doe@example.com</p>
                                </div>
                            </div>
                        </div>
                        <nav class="space-y-1">
                            <a href="#profile" class="block px-4 py-3 bg-green-50 text-green-700 border-l-4 border-green-600 font-medium">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Personal Information
                                </div>
                            </a>
                            <a href="#security" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Security
                                </div>
                            </a>
                            <a href="#preferences" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Preferences
                                </div>
                            </a>
                            <a href="#notifications" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    Notifications
                                </div>
                            </a>
                            <a href="#applications" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    Applications
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="md:col-span-3">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <!-- Profile Information Section -->
                        <div id="profile" class="p-6 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h2>
                            <form method="POST" action=" " enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Profile Photo -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Profile Photo
                                    </label>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                            <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <label for="photo" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                Change Photo
                                            </label>
                                            <input id="photo" name="photo" type="file" class="hidden">
                                            <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF up to 2MB</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Name and Email -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" id="name" name="name" value="John Doe" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input type="email" id="email" name="email" value="john.doe@example.com" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Phone and Address -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" value="+255 123 456 789" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <input type="text" id="address" name="address" value="123 Main Street, Dar es Salaam" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Employment and Income Info -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="employment" class="block text-sm font-medium text-gray-700 mb-1">Employment Status</label>
                                        <select id="employment" name="employment" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <option value="full-time">Full Time Employed</option>
                                            <option value="part-time">Part Time Employed</option>
                                            <option value="self-employed">Self Employed</option>
                                            <option value="unemployed">Unemployed</option>
                                            <option value="retired">Retired</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="income" class="block text-sm font-medium text-gray-700 mb-1">Monthly Income (TZS)</label>
                                        <input type="text" id="income" name="income" value="2,500,000" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Bio -->
                                <div class="mb-6">
                                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">About</label>
                                    <textarea id="bio" name="bio" rows="3" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="Write a brief description about yourself..."></textarea>
                                </div>

                                <!-- Save Button -->
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Security Section -->
                        <div id="security" class="p-6 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Security Settings</h2>
                            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <!-- Current Password -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="••••••••">
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" id="password" name="password" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="••••••••">
                                </div>

                                <!-- Confirm New Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="••••••••">
                                </div>

                                <!-- Password Requirements -->
                                <div class="rounded-md bg-gray-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-700">Password requirements:</h3>
                                            <div class="mt-2 text-sm text-gray-500">
                                                <ul class="list-disc space-y-1 pl-5">
                                                    <li>Minimum 8 characters</li>
                                                    <li>Include at least one uppercase letter</li>
                                                    <li>Include at least one number</li>
                                                    <li>Include at least one special character</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Two-Factor Authentication -->
                                <div class="pt-4 border-t border-gray-200">
                                    <h3 class="text-md font-medium text-gray-900 mb-3">Two-Factor Authentication</h3>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-600 mb-1">Add an extra layer of security to your account</p>
                                            <p class="text-xs text-gray-500">We'll send a verification code to your phone when you log in.</p>
                                        </div>
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Enable 2FA
                                        </button>
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Notification Preferences -->
                        <div id="notifications" class="p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Notification Settings</h2>
                            <form method="POST" action=" ">
                                @csrf
                                @method('PUT')

                                <div class="space-y-4">
                                    <!-- Email Notifications -->
                                    <div class="bg-gray-50 p-4 rounded-md">
                                        <h3 class="text-md font-medium text-gray-900 mb-3">Email Notifications</h3>
                                        <div class="space-y-3">
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="application_updates" name="email_notifications[]" value="application_updates" type="checkbox" checked
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="sms_application_updates" class="font-medium text-gray-700">Application Updates</label>
                                                    <p class="text-gray-500">Receive SMS alerts about your financing applications</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="sms_payment_reminders" name="sms_notifications[]" value="payment_reminders" type="checkbox" checked
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="sms_payment_reminders" class="font-medium text-gray-700">Payment Reminders</label>
                                                    <p class="text-gray-500">Receive SMS reminders about upcoming payments</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="flex justify-end pt-6">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Save Preferences
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Linked Accounts Section -->
                    <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Linked Accounts</h2>
                            <p class="text-sm text-gray-600 mb-6">Connect your accounts for a more personalized experience</p>
                            
                            <div class="space-y-4">
                                <!-- Google Account -->
                                <div class="flex items-center justify-between py-3 border-t border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-white rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-900">Google</h3>
                                            <p class="text-xs text-gray-500">Connect your Google account for easier login</p>
                                        </div>
                                    </div>
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Connect
                                    </button>
                                </div>
                                
                                <!-- Facebook Account -->
                                <div class="flex items-center justify-between py-3 border-t border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-white rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-900">Facebook</h3>
                                            <p class="text-xs text-gray-500">Connect your Facebook account for easier login</p>
                                        </div>
                                    </div>
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Connect
                                    </button>
                                </div>
                                
                                <!-- Mobile Banking Account -->
                                <div class="flex items-center justify-between py-3 border-t border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-white rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-900">Mobile Banking</h3>
                                            <p class="text-xs text-gray-500">Connect for easier payments and transfers</p>
                                        </div>
                                    </div>
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Connect
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Account Section -->
                    <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Delete Account</h2>
                            <p class="text-sm text-gray-600 mb-6">Once you delete your account, there is no going back. Please be certain.</p>
                            
                            <div class="rounded-md bg-red-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Warning: This action cannot be undone</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>When you delete your account, you will lose all your data, applications, and financing information. This action is permanent and cannot be recovered.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer would go here -->

    <script>
        // Script to handle navigation between profile sections
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav a');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    navLinks.forEach(l => {
                        l.classList.remove('bg-green-50', 'text-green-700', 'border-l-4', 'border-green-600');
                        l.classList.add('text-gray-700', 'hover:bg-gray-50', 'hover:text-gray-900');
                    });
                    
                    // Add active class to clicked link
                    this.classList.add('bg-green-50', 'text-green-700', 'border-l-4', 'border-green-600');
                    this.classList.remove('text-gray-700', 'hover:bg-gray-50', 'hover:text-gray-900');
                    
                    // Get the target section ID from the href attribute
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    // Scroll to the target section
                    window.scrollTo({
                        top: targetSection.offsetTop - 20,
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>

                                              
                                                    
                                                    
                                                    </div>
