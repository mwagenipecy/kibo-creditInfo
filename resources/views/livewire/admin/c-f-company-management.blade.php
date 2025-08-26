<div>

{{-- resources/views/livewire/cf-company-management.blade.php --}}
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-green-600 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-white">CF Company Management</h1>
                    <p class="text-green-100">Manage clearing & forwarding companies and their users</p>
                </div>
                <button wire:click="openModal('create')" 
                        class="bg-white text-green-600 hover:bg-gray-50 px-4 py-2 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add CF Company
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Companies</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pending</dt>
                                <dd class="text-lg font-medium text-yellow-600">{{ $stats['pending'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Approved</dt>
                                <dd class="text-lg font-medium text-green-600">{{ $stats['approved'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Rejected</dt>
                                <dd class="text-lg font-medium text-red-600">{{ $stats['rejected'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Suspended</dt>
                                <dd class="text-lg font-medium text-orange-600">{{ $stats['suspended'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Recent (7d)</dt>
                                <dd class="text-lg font-medium text-blue-600">{{ $stats['recent'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" wire:model.debounce.300ms="searchTerm" 
                                   placeholder="Search companies..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-green-500 focus:border-green-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <select wire:model="statusFilter" 
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md">
                            <option value="">All Statuses</option>
                            <option value="PENDING">Pending</option>
                            <option value="VERIFIED">Verified</option>
                            <option value="APPROVED">Approved</option>
                            <option value="SUSPENDED">Suspended</option>
                            <option value="REJECTED">Rejected</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Companies Table -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            @if($companies->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TRA License</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($companies as $company)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $company->getStatusBadgeClass() }}">
                                {{ $company->status }}
                            </span>
                            @if($company->verified_at)
                            <div class="text-xs text-gray-500 mt-1">
                                Verified {{ $company->verified_at->format('M d, Y') }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($company->rating > 0)
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $company->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-1 text-sm text-gray-600">{{ number_format($company->rating, 1) }}</span>
                                </div>
                                @else
                                <span class="text-sm text-gray-500">No rating</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $company->total_applications_handled }} applications handled
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button wire:click="openModal('view', {{ $company->id }})" 
                                        class="text-blue-600 hover:text-blue-900">View</button>
                                <button wire:click="openModal('edit', {{ $company->id }})" 
                                        class="text-green-600 hover:text-green-900">Edit</button>
                                
                                @if($company->status === 'PENDING')
                                <button wire:click="updateStatus({{ $company->id }}, 'APPROVED')" 
                                        class="text-green-600 hover:text-green-900">Approve</button>
                                <button wire:click="updateStatus({{ $company->id }}, 'REJECTED')" 
                                        class="text-red-600 hover:text-red-900">Reject</button>
                                @endif
                                
                                @if($company->status === 'APPROVED')
                                <button wire:click="updateStatus({{ $company->id }}, 'SUSPENDED')" 
                                        class="text-orange-600 hover:text-orange-900">Suspend</button>
                                @endif
                                
                                @if($company->status === 'SUSPENDED')
                                <button wire:click="updateStatus({{ $company->id }}, 'APPROVED')" 
                                        class="text-green-600 hover:text-green-900">Reactivate</button>
                                @endif
                                
                                <button wire:click="openUserModal({{ $company->id }})" 
                                        class="text-purple-600 hover:text-purple-900">Create User</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $companies->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No companies found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding a new CF company.</p>
                <div class="mt-6">
                    <button wire:click="openModal('create')" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add CF Company
                    </button>
                </div>
            </div>
            @endif
        </div>

        <!-- Company Modal -->
        @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">
                        @if($modalMode === 'create') Add New CF Company
                        @elseif($modalMode === 'edit') Edit CF Company
                        @else View CF Company Details @endif
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="space-y-6">
                    <!-- Company Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                            <input type="text" wire:model="company_name" 
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                   {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            @error('company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Registration Number *</label>
                            <input type="text" wire:model="registration_number" 
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                   {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            @error('registration_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">TRA License Number *</label>
                            <input type="text" wire:model="tra_license_number" 
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                   {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            @error('tra_license_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Years in Operation</label>
                            <input type="number" wire:model="years_in_operation" min="0" max="100"
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                   {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            @error('years_in_operation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="border-t pt-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-4">Contact Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Person Name *</label>
                                <input type="text" wire:model="contact_person_name" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                                @error('contact_person_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                                <input type="text" wire:model="contact_person_position" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                <input type="tel" wire:model="phone_number" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                <input type="email" wire:model="email" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                <input type="url" wire:model="website" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            </div>
                        </div>
                    </div>

                    <!-- Location Information -->
                    <div class="border-t pt-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-4">Location Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Region *</label>
                                <input type="text" wire:model="region" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                                @error('region') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                                <input type="text" wire:model="city" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                                @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Physical Address *</label>
                                <textarea wire:model="physical_address" rows="2" 
                                          class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                          {{ $modalMode === 'view' ? 'readonly' : '' }}></textarea>
                                @error('physical_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Postal Address</label>
                                <input type="text" wire:model="postal_address" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            </div>
                        </div>
                    </div>

                    <!-- Service Information -->
                    <div class="border-t pt-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-4">Service Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Specializations</label>
                                <div class="space-y-2">
                                    @foreach($specializationOptions as $key => $label)
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="specializations" value="{{ $key }}" 
                                               class="rounded border-gray-300 text-green-600 focus:ring-green-500" 
                                               {{ $modalMode === 'view' ? 'disabled' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Service Ports</label>
                                <div class="space-y-2">
                                    @foreach($servicePortOptions as $key => $label)
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="service_ports" value="{{ $key }}" 
                                               class="rounded border-gray-300 text-green-600 focus:ring-green-500" 
                                               {{ $modalMode === 'view' ? 'disabled' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Average Clearance Time (Days)</label>
                                <input type="number" wire:model="average_clearance_time_days" min="1" max="30" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                                @error('average_clearance_time_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Languages Supported</label>
                                <input type="text" wire:model="languages_supported" placeholder="e.g., English, Swahili, French" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours</label>
                                <input type="text" wire:model="operating_hours" placeholder="e.g., Mon-Fri 8:00 AM - 6:00 PM" 
                                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                       {{ $modalMode === 'view' ? 'readonly' : '' }}>
                            </div>
                        </div>
                    </div>

                    @if($modalMode !== 'view')
                    <!-- Status -->
                    <div class="border-t pt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model="status" 
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="PENDING">Pending</option>
                                <option value="VERIFIED">Verified</option>
                                <option value="APPROVED">Approved</option>
                                <option value="SUSPENDED">Suspended</option>
                                <option value="REJECTED">Rejected</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <!-- Modal Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t">
                        <button type="button" wire:click="closeModal" 
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            {{ $modalMode === 'view' ? 'Close' : 'Cancel' }}
                        </button>
                        @if($modalMode !== 'view')
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            {{ $modalMode === 'create' ? 'Create Company' : 'Update Company' }}
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- User Creation Modal -->
        @if($showUserModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Create User Account</h3>
                    <button wire:click="closeUserModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="createUser" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                        <input type="text" wire:model="user_name" 
                               class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @error('user_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                        <input type="email" wire:model="user_email" 
                               class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @error('user_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                        <input type="password" wire:model="user_password" 
                               class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @error('user_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" wire:model="user_phone_number" 
                               class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @error('user_phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select wire:model="user_role" 
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="cf_company">CF Company User</option>
                            <option value="cf_admin">CF Company Admin</option>
                        </select>
                    </div>

                    @if($selectedCompany)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <p class="text-sm text-blue-800">
                            <strong>Company:</strong> {{ $selectedCompany->company_name }}<br>
                            <strong>TRA License:</strong> {{ $selectedCompany->tra_license_number }}
                        </p>
                    </div>
                    @endif

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="closeUserModal" 
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>

    <!-- Loading indicator -->
    <div wire:loading class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-25">
        <div class="bg-white rounded-lg p-4 flex items-center space-x-2">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-green-600"></div>
            <span class="text-gray-700">Loading...</span>
        </div>
    </div>
</div>


</div>
