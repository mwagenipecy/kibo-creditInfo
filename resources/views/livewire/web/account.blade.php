<div>
    <div class="bg-white">
        <!-- Breadcrumb -->
        <div class="bg-gray-100 py-4 border-b border-gray-200">
            <div class="container mx-auto px-4 md:px-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 transition duration-300">
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
                                    @if(auth()->user()->profile_photo_path)
                                        <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="h-12 w-12 rounded-full object-cover">
                                    @else
                                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <h2 class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</h2>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <nav class="space-y-1">
                            <a href="#profile" 
                               wire:click.prevent="setActiveTab('profile')" 
                               class="{{ $activeTab === 'profile' ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} block px-4 py-3 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Personal Information
                                </div>
                            </a>
                            <a href="#security" 
                               wire:click.prevent="setActiveTab('security')" 
                               class="{{ $activeTab === 'security' ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} block px-4 py-3 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Security
                                </div>
                            </a>
                            <a href="#preferences" 
                               wire:click.prevent="setActiveTab('preferences')" 
                               class="{{ $activeTab === 'preferences' ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} block px-4 py-3 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Preferences
                                </div>
                            </a>
                            <a href="#danger" 
                               wire:click.prevent="setActiveTab('danger')" 
                               class="{{ $activeTab === 'danger' ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} block px-4 py-3 font-medium transition duration-150">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Account
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="md:col-span-3">
                    <!-- Profile Information Section -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div id="profile" class="p-6 border-b border-gray-200" x-show="$wire.activeTab === 'profile'">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h2>
                            <form wire:submit.prevent="updateProfile">
                                <!-- Profile Photo -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Profile Photo
                                    </label>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                            @if($currentPhoto)
                                                <img src="{{ Storage::url($currentPhoto) }}" alt="{{ $name }}" class="h-16 w-16 rounded-full object-cover">
                                            @else
                                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <label for="photo" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                Change Photo
                                            </label>
                                            <input id="photo" wire:model="photo" name="photo" type="file" class="hidden">
                                            @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF up to 2MB</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Name and Email -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" id="name" wire:model="name" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input type="email" id="email" wire:model="email" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Phone and Address -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="tel" id="phone" wire:model="phone" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <input type="text" id="address" wire:model="address" 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
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
                        <div id="security" class="p-6 border-b border-gray-200" x-show="$wire.activeTab === 'security'">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Security Settings</h2>
                            <form wire:submit.prevent="updatePassword" class="space-y-6">
                                <!-- Current Password -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" id="current_password" wire:model.defer="current_password" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="••••••••">
                                    @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" id="password" wire:model.defer="password" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        placeholder="••••••••">
                                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Confirm New Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" wire:model.defer="password_confirmation" 
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

                                <!-- Save Button -->
                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Preferences Section -->
                        <div id="preferences" class="p-6 border-b border-gray-200" x-show="$wire.activeTab === 'preferences'">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Preferences</h2>
                            <p class="text-gray-600">Customize your application preferences here.</p>
                            <!-- Add your preferences form here -->
                        </div>
                    </div>

                    <!-- Delete Account Section -->
                    <div id="danger" class="mt-8 bg-white rounded-lg shadow overflow-hidden" x-show="$wire.activeTab === 'danger'">
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
                                <button type="button" wire:click="deleteAccount" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
   

    <!-- Delete Account Confirmation Modal -->
    <div 
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50" 
        style="display: none;"
        x-data="{ open: false }"
        x-show="open"
        x-on:show-delete-confirmation.window="open = true"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Account</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete your account? All of your data will be permanently removed. This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button 
                    type="button" 
                    wire:click="confirmDeleteAccount"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Delete
                </button>
                <button 
                    type="button" 
                    @click="open = false"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- Alpine.js for tab functionality and modals -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tabs', () => ({
                activeTab: @entangle('activeTab')
            }));
        });
    </script>
</div>

                   
                </div>



            </div>
        </div>
    </div>

    <!-- Footer would go here -->
    <script>
    // Complete JavaScript for Profile Settings - Fixed for Livewire compatibility
    document.addEventListener('DOMContentLoaded', function() {
        
        // Initialize Alpine.js data for tab functionality
        document.addEventListener('alpine:init', () => {
            Alpine.data('tabs', () => ({
                activeTab: 'profile' // Default tab, this will be synced with Livewire
            }));
        });

        // Wait for Livewire to be ready
        if (typeof Livewire !== 'undefined') {
            document.addEventListener('livewire:load', function () {
                initializeProfileNavigation();
            });
        }
        
        // Also initialize immediately in case Livewire is already loaded
        setTimeout(initializeProfileNavigation, 100);
    });

    function initializeProfileNavigation() {
        // Use more specific selector that matches your actual navigation structure
        const navLinks = document.querySelectorAll('nav a[wire\\:click\\.prevent]');
        
        if (navLinks.length === 0) {
            // Fallback selector if the above doesn't work
            const fallbackLinks = document.querySelectorAll('nav a[href^="#"]');
            fallbackLinks.forEach(link => {
                setupLinkHandler(link);
            });
        } else {
            navLinks.forEach(link => {
                setupLinkHandler(link);
            });
        }
    }

    function setupLinkHandler(link) {
        // Remove any existing event listeners to prevent duplicates
        link.removeEventListener('click', handleNavClick);
        link.addEventListener('click', handleNavClick);
    }

    function handleNavClick(e) {
        // For Livewire links, don't prevent default - let Livewire handle it
        if (this.hasAttribute('wire:click.prevent')) {
            // Extract tab name from wire:click.prevent attribute
            const wireClick = this.getAttribute('wire:click.prevent');
            const tabMatch = wireClick.match(/setActiveTab\('(\w+)'\)/);
            
            if (tabMatch) {
                const tabName = tabMatch[1];
                
                // Smooth scroll to the section after Livewire updates
                setTimeout(() => {
                    scrollToSection(tabName);
                }, 150);
                
                // Update URL hash
                updateUrlHash(tabName);
            }
        } else {
            // Handle regular anchor links
            e.preventDefault();
            
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                const tabName = href.substring(1);
                
                // Manually update active states for non-Livewire links
                updateActiveStates(this);
                
                // Show/hide sections
                showSection(tabName);
                
                // Smooth scroll
                scrollToSection(tabName);
                
                // Update URL hash
                updateUrlHash(tabName);
            }
        }
    }

    function updateActiveStates(activeLink) {
        // Remove active class from all links
        const allLinks = document.querySelectorAll('nav a');
        allLinks.forEach(link => {
            link.classList.remove('bg-green-50', 'text-green-700', 'border-l-4', 'border-green-600');
            link.classList.add('text-gray-700', 'hover:bg-gray-50', 'hover:text-gray-900');
        });
        
        // Add active class to clicked link
        activeLink.classList.add('bg-green-50', 'text-green-700', 'border-l-4', 'border-green-600');
        activeLink.classList.remove('text-gray-700', 'hover:bg-gray-50', 'hover:text-gray-900');
    }

    function showSection(tabName) {
        // Hide all sections
        const allSections = document.querySelectorAll('[id][x-show]');
        allSections.forEach(section => {
            section.style.display = 'none';
        });
        
        // Show target section
        const targetSection = document.getElementById(tabName);
        if (targetSection) {
            targetSection.style.display = 'block';
        }
    }

    function scrollToSection(tabName) {
        const targetSection = document.getElementById(tabName);
        if (targetSection) {
            // Calculate offset accounting for any fixed headers
            const headerOffset = 80; // Adjust based on your header height
            const elementPosition = targetSection.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            
            window.scrollTo({
                top: Math.max(0, offsetPosition),
                behavior: 'smooth'
            });
        }
    }

    function updateUrlHash(tabName) {
        if (history.pushState && tabName) {
            const newUrl = window.location.protocol + "//" + 
                          window.location.host + 
                          window.location.pathname + '#' + tabName;
            window.history.pushState({tab: tabName}, '', newUrl);
        }
    }

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.tab) {
            const tabName = e.state.tab;
            
            // Try to trigger Livewire method first
            if (typeof Livewire !== 'undefined' && Livewire.emit) {
                Livewire.emit('setActiveTab', tabName);
            } else {
                // Fallback to manual handling
                const targetLink = document.querySelector(`nav a[href="#${tabName}"]`);
                if (targetLink) {
                    updateActiveStates(targetLink);
                    showSection(tabName);
                    scrollToSection(tabName);
                }
            }
        }
    });

    // Listen for Livewire events to sync URL hash
    document.addEventListener('livewire:load', function () {
        if (typeof Livewire !== 'undefined') {
            // Listen for tab changes from Livewire component
            Livewire.on('tabChanged', tabName => {
                updateUrlHash(tabName);
                setTimeout(() => scrollToSection(tabName), 100);
            });
        }
    });

    // Handle direct access via URL hash on page load
    window.addEventListener('load', function() {
        const hash = window.location.hash.substring(1);
        const validTabs = ['profile', 'security', 'preferences', 'danger'];
        
        if (hash && validTabs.includes(hash)) {
            if (typeof Livewire !== 'undefined') {
                // Wait for Livewire to be fully loaded
                setTimeout(() => {
                    if (Livewire.emit) {
                        Livewire.emit('setActiveTab', hash);
                    }
                }, 300);
            } else {
                // Fallback for non-Livewire setup
                const targetLink = document.querySelector(`nav a[href="#${hash}"]`);
                if (targetLink) {
                    setTimeout(() => {
                        updateActiveStates(targetLink);
                        showSection(hash);
                        scrollToSection(hash);
                    }, 100);
                }
            }
        }
    });

    // Handle file input changes for profile photo
    document.addEventListener('change', function(e) {
        if (e.target.type === 'file' && e.target.id === 'photo') {
            const file = e.target.files[0];
            if (file) {
                // Basic file validation
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPG, PNG, or GIF)');
                    e.target.value = '';
                    return;
                }
                
                if (file.size > maxSize) {
                    alert('File size must be less than 2MB');
                    e.target.value = '';
                    return;
                }
                
                // Preview the image (optional)
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector('img[alt*="Profile"]');
                    if (preview) {
                        preview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    });

    // Handle modal functionality for delete account
    function setupModalHandlers() {
        // Listen for custom events to show/hide modals
        window.addEventListener('show-delete-confirmation', function() {
            const modal = document.querySelector('[x-data*="open"]');
            if (modal && modal.__x) {
                modal.__x.$data.open = true;
            }
        });
        
        // Handle Escape key to close modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('[x-data*="open"][x-show="open"]');
                if (openModal && openModal.__x) {
                    openModal.__x.$data.open = false;
                }
            }
        });
    }

    // Initialize modal handlers when DOM is ready
    document.addEventListener('DOMContentLoaded', setupModalHandlers);

    // Smooth scrolling for any remaining anchor links
    document.addEventListener('click', function(e) {
        const target = e.target.closest('a[href^="#"]');
        if (target && !target.hasAttribute('wire:click.prevent')) {
            const href = target.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const targetElement = document.querySelector(href);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        }
    });

    // Form validation helpers
    function validateForm(formElement) {
        const requiredFields = formElement.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        return isValid;
    }

    // Add form validation on submit
    document.addEventListener('submit', function(e) {
        if (!e.target.hasAttribute('wire:submit.prevent')) {
            if (!validateForm(e.target)) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        }
    });

    // Console log for debugging
    console.log('Profile Settings JavaScript loaded successfully');
</script>



                                                    
      </div>
