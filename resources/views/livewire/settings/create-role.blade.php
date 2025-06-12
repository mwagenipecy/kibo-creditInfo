<div class="role-management-form">
    <!-- Success Alert -->
    @if (session()->has('message') && session('alert-class') == 'alert-success')
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">Process Completed Successfully</h3>
                    <p class="text-sm text-green-700 mt-1">{{ session('message') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <button type="button" class="inline-flex text-green-400 hover:text-green-600" onclick="this.closest('[role=alert]').remove()">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Form Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="space-y-6">
            <!-- Form Header -->
            <div class="border-b border-gray-200 pb-4">
                <h2 class="text-lg font-semibold text-gray-900">Role Management</h2>
                <p class="text-sm text-gray-600 mt-1">Create and configure user roles with specific permissions</p>
            </div>

            <!-- Role Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Role Name -->
                <div class="space-y-2">
                    <label for="role_name" class="block text-sm font-medium text-gray-700">
                        Role Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        wire:model="role_name" 
                        type="text" 
                        id="role_name" 
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                               focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 
                               @error('role_name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror
                               sm:text-sm transition duration-150 ease-in-out" 
                        placeholder="Enter role name (e.g., Administrator, Editor)"
                        required>
                    
                    @error('role_name')
                        <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-4 w-4 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm text-red-700">{{ $message }}</p>
                                </div>
                            </div>
                        </div>
                    @enderror
                </div>

                <!-- Role Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Role Description <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        wire:model="description" 
                        id="description" 
                        rows="3"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                               focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 
                               @error('description') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror
                               sm:text-sm resize-none transition duration-150 ease-in-out" 
                        placeholder="Describe the role's purpose and responsibilities..."></textarea>
                    
                    @error('description')
                        <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-4 w-4 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm text-red-700">{{ $message }}</p>
                                </div>
                            </div>
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Permissions Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-medium text-gray-900">Select Permissions</h3>
                        <p class="text-sm text-gray-600">Choose which actions this role can perform</p>
                    </div>
                    <div class="flex space-x-2">
                      
                        
                    </div>
                </div>

                @php
                    // Get all menu actions in one query for better performance
                    $menuActions = App\Models\sub_menus::whereIn('id', $this->menusArray)
                        ->pluck('user_action', 'id')
                        ->toArray();
                @endphp

                <!-- Permissions Grid -->
                <div class="bg-gray-50 rounded-lg p-4">
                    @if(!empty($this->menusArray) && !empty($menuActions))
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                            @foreach($this->menusArray as $subMenu)
                                @if(isset($menuActions[$subMenu]))
                                    <div class="permission-item bg-white rounded-lg border border-gray-200 p-3 hover:shadow-sm transition-all duration-150">
                                        <label class="flex items-start space-x-3 cursor-pointer">
                                            <input 
                                                type="checkbox" 
                                                value="{{ $subMenu }}" 
                                                wire:model="permissions"
                                                class="mt-1 h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500 focus:ring-2 transition duration-150">
                                            <div class="flex-1 min-w-0">
                                                <span class="text-sm font-medium text-gray-900 leading-tight">
                                                    {{ $menuActions[$subMenu] }}
                                                </span>
                                                <span class="block text-xs text-gray-500 mt-1">
                                                    ID: {{ $subMenu }}
                                                </span>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Selected Permissions Counter -->
                        <div class="mt-4 flex items-center justify-between bg-blue-50 rounded-lg p-3">
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-blue-900">
                                    <span x-data="{ count: @entangle('permissions').length || 0 }" x-text="count"></span> 
                                    of {{ count($this->menusArray) }} permissions selected
                                </span>
                            </div>
                            @if(!empty($permissions))
                                <span class="text-xs text-blue-700 bg-blue-100 px-2 py-1 rounded-full">
                                    {{ round((count($permissions) / count($this->menusArray)) * 100) }}% coverage
                                </span>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Permissions Available</h3>
                            <p class="mt-1 text-sm text-gray-500">No menu items found to assign permissions.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                <!-- Cancel/Reset Button -->
                <!-- <button 
                    type="button"
                    wire:click="resetForm"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150">
                    Reset Form
                </button> -->

                <!-- Save Button with Loading State -->
                <div class="relative">
                    <!-- Loading Button -->
                    <button 
                        wire:loading 
                        wire:target="save"
                        disabled
                        class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-400 cursor-not-allowed">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Saving Role...
                    </button>

                    <!-- Normal Save Button -->
                    <button 
                        wire:loading.remove 
                        wire:target="save"
                        wire:click="save"
                        class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Role
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
/* Custom animations and hover effects */
.permission-item:hover {
    transform: translateY(-1px);
}

.permission-item input[type="checkbox"]:checked + div {
    @apply text-red-700;
}

/* Loading animation improvements */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Responsive improvements */
@media (max-width: 640px) {
    .grid {
        grid-template-columns: 1fr;
    }
    
    .space-x-3 > * + * {
        margin-left: 0.5rem;
    }
}
</style>