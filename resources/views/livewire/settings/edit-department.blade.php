<div class="max-w-6xl mx-auto p-6 space-y-6">
    
    <!-- Success Alert -->
    @if (session()->has('message'))
        @if (session('alert-class') == 'alert-success')
            <div class="bg-green-50 border-l-4 border-green-400 rounded-r-lg p-4 shadow-sm" role="alert">
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
    @endif

    <!-- Main Card Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Role Management</h2>
            <p class="text-sm text-gray-600 mt-1">Edit existing roles and configure their permissions</p>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <div class="col-span-6 sm:col-span-4">
                
                <!-- Role Information Section -->
                <div class="mb-8">
                    <h3 class="text-base font-medium text-gray-900 mb-4 flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full mr-2">1</span>
                        Role Information
                    </h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <!-- Role Selection -->
                            <div class="form-group">
                                <x-jet-label for="selectedrole" value="{{ __('Select a role') }}" class="block text-sm font-medium text-gray-700 mb-2" />
                                <div class="relative">
                                    <select id="selectedrole" wire:model="selectedrole" 
                                            class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-lg shadow-sm 
                                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                                   sm:text-sm transition duration-150 ease-in-out" required>
                                        <option value="" selected>Choose a role to edit...</option>
                                        @foreach($this->roles as $role)
                                            <option value="{{$role->id}}">{{$role->department_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('selectedrole')
                                    <div class="mt-2 bg-red-50 border border-red-200 rounded-md p-3">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-4 w-4 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-sm text-red-700">Please select a role first.</p>
                                            </div>
                                        </div>
                                    </div>
                                @enderror
                            </div>

                            <!-- Role Name -->
                            <div>
                                <label for="role_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Role Name <span class="text-red-500">*</span>
                                </label>
                                <input wire:model="role_name" type="text" id="role_name" 
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                                              bg-gray-50 text-gray-900 placeholder-gray-400
                                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                              sm:text-sm transition duration-150 ease-in-out" 
                                       placeholder="Enter role name" required>
                                @error('role_name')
                                    <div class="mt-2 bg-red-50 border border-red-200 rounded-md p-3">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-4 w-4 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-sm text-red-700">Role name is mandatory and should be more than two characters.</p>
                                            </div>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Role Description <span class="text-red-500">*</span>
                            </label>
                            <textarea wire:model="description" id="description" rows="6" 
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                                             bg-gray-50 text-gray-900 placeholder-gray-400
                                             focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                             sm:text-sm resize-none transition duration-150 ease-in-out" 
                                      placeholder="Describe the role's purpose and responsibilities..."></textarea>
                            @error('description')
                                <div class="mt-2 bg-red-50 border border-red-200 rounded-md p-3">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-4 w-4 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-sm text-red-700">Description is mandatory and should be more than two characters.</p>
                                        </div>
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Permissions Section -->
                @if($this->selectedrole)
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-base font-medium text-gray-900 mb-4 flex items-center">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full mr-2">2</span>
                            Configure Permissions
                        </h3>

                        <div class="bg-gray-50 rounded-lg p-4">
                            @php
                                // Get all menu actions in one query for better performance
                                $permissionIds = array_keys($this->permissions);
                                $menuActions = App\Models\sub_menus::whereIn('ID', $permissionIds)
                                    ->pluck('user_action', 'ID')
                                    ->toArray();
                                
                                $selectedCount = count(array_filter($this->permissions));
                                $totalCount = count($this->permissions);
                            @endphp

                            <!-- Permissions Header -->
                            <div class="flex items-center justify-between mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    Select Permissions
                                </label>
                                <div class="text-xs text-gray-600 bg-white px-2 py-1 rounded-full border">
                                    {{ $selectedCount }} of {{ $totalCount }} selected
                                </div>
                            </div>

                            <!-- Permissions Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                                @foreach($this->permissions as $key => $permission)
                                    @if(isset($menuActions[$key]))
                                        <div class="bg-white rounded-lg border border-gray-200 p-3 hover:shadow-sm transition-all duration-150 {{ $permission ? 'ring-2 ring-blue-200 bg-blue-50' : '' }}">
                                            <label class="flex items-start space-x-3 cursor-pointer" for="permission_{{ $key }}">
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       id="permission_{{ $key }}" 
                                                       value="{{ $key }}" 
                                                       wire:model="permissions.{{ $key }}" 
                                                       @if($permission) checked @endif
                                                       wire:click="togglePermission({{ $key }},'{{$permission}}')"
                                                       class="mt-1 h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded 
                                                              focus:ring-blue-500 focus:ring-2 transition duration-150">
                                                <div class="flex-1 min-w-0">
                                                    <span class="text-sm font-medium text-gray-900 leading-tight {{ $permission ? 'text-blue-700' : '' }}">
                                                        {{ $menuActions[$key] }}
                                                    </span>
                                                    <span class="block text-xs text-gray-500 mt-1">
                                                        ID: {{ $key }}
                                                    </span>
                                                </div>
                                                @if($permission)
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Permission Summary -->
                            <div class="mt-4 bg-blue-50 rounded-lg p-3 border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-blue-900">
                                            {{ $selectedCount }} of {{ $totalCount }} permissions selected
                                        </span>
                                    </div>
                                    <span class="text-xs text-blue-700 bg-blue-100 px-2 py-1 rounded-full">
                                        {{ $totalCount > 0 ? round(($selectedCount / $totalCount) * 100) : 0 }}% coverage
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            
                            <!-- Loading Button -->
                            <div wire:loading wire:target="save">
                                <button disabled class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-400 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-4 w-4 mr-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Please wait...
                                </button>
                            </div>

                            <!-- Save Button -->
                            <div wire:loading.remove wire:target="save">
                                <button wire:click="save" class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update Role
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced hover effects */
.hover\:shadow-sm:hover {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

/* Smooth transitions for all interactive elements */
* {
    transition: all 0.15s ease-in-out;
}

/* Permission item hover effect */
.grid > div:hover {
    transform: translateY(-1px);
}

/* Custom select dropdown styling */
select {
    background-image: none;
}

/* Focus states */
input:focus, select:focus, textarea:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Loading animation */
@keyframes spin {
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>