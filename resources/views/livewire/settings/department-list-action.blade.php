<div class="permissions-container">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">User Permissions</h3>
        
        @php
            // Clean and process permissions data
            $permissionIds = [];
            
            if (!empty($permissions)) {
                if (is_string($permissions)) {
                    // If it's a JSON string, decode it
                    $decoded = json_decode($permissions, true);
                    $permissionIds = is_array($decoded) ? $decoded : [];
                } elseif (is_array($permissions)) {
                    // If it's already an array
                    $permissionIds = $permissions;
                }
                
                // Clean up the array - remove empty values and duplicates
                $permissionIds = array_filter(array_unique($permissionIds));
                
                // Sort the permissions
                sort($permissionIds, SORT_NUMERIC);
            }
            
            // Fetch all permission names in one query for better performance
            $permissionNames = [];
            if (!empty($permissionIds)) {
                $permissionNames = App\Models\sub_menus::whereIn('id', $permissionIds)
                    ->pluck('user_action', 'id')
                    ->toArray();
            }
        @endphp

        @if(!empty($permissionIds) && !empty($permissionNames))
            <!-- Grid Layout for larger screens, stacked for mobile -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach($permissionIds as $permissionId)
                    @if(isset($permissionNames[$permissionId]))
                        <div class="permission-item bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-3 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center space-x-2">
                                <!-- Permission Icon -->
                                <div class="flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <!-- Permission Text -->
                                <span class="text-sm font-medium text-gray-700 leading-tight">
                                    {{ $permissionNames[$permissionId] }}
                                </span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Permission Count Badge -->
            <div class="mt-4 flex justify-between items-center">
               
                
               
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No Permissions</h3>
                <p class="mt-1 text-sm text-gray-500">No permissions have been assigned to this user.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* Optional: Add custom hover effects */
.permission-item:hover {
    transform: translateY(-1px);
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .permissions-container .grid {
        grid-template-columns: 1fr;
    }
}

/* Print styles */
@media print {
    .permission-item {
        break-inside: avoid;
        border: 1px solid #ccc !important;
        background: white !important;
    }
}
</style>
