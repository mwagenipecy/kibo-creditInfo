<div>
   

<div>
    <!-- Background illustration -->
    <div class="p-2">

        <!-- Welcome banner -->
        <div class="relative p-4 mb-2 overflow-hidden rounded-lg bg-white">
            <!-- Background illustration -->
            <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
                <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                        <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                        <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                        <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                            <stop stop-color="#005A06" offset="0%" /> <!-- Dark Blue -->
                            <stop stop-color="#005A06" offset="100%" /> <!-- Light Blue -->
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#005A06" offset="0%" /> <!-- Light Blue -->
                            <stop stop-color="#005A06" stop-opacity="0" offset="100%" /> <!-- Dark Blue -->
                        </linearGradient>
                    </defs>
                    <g fill="none" fill-rule="evenodd">
                        <g transform="rotate(64 36.592 105.604)">
                            <mask id="welcome-d" fill="#fff">
                                <use xlink:href="#welcome-a" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                        </g>
                        <g transform="rotate(-51 91.324 -105.372)">
                            <mask id="welcome-f" fill="#fff">
                                <use xlink:href="#welcome-e" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                        <g transform="rotate(44 61.546 392.623)">
                            <mask id="welcome-h" fill="#fff">
                                <use xlink:href="#welcome-g" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                    </g>
                </svg>
            </div>

            <!-- Content -->
            <div class="relative w-full">
                <div class="min-w-full text-center text-sm font-light">
                    <div class="text-xl text-green-800 font-bold mb-1">
                        DOCUMENT MANAGEMENT SYSTEM
                    </div>
                </div>
                <div>
                    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Total Documents: <span class="ml-1 font-medium">{{ $totalDocuments }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Active Documents: <span class="ml-1 font-medium">{{ $activeDocuments }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Inactive Documents: <span class="ml-1 font-medium">{{ $inactiveDocuments }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container mx-auto ">
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Documents Library</h3>
                        <button wire:click="createDocument" class="px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Upload Document
                        </button>
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Success message -->
                    @if (session()->has('message'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p>{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Error message -->
                    @if (session()->has('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p>{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Search box -->
                    <div class="mb-6">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input wire:model.debounce.300ms="searchTerm" type="text" 
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                placeholder="Search documents...">
                        </div>
                    </div>
                    
                    <!-- Documents table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lender ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Upload Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($documents as $document)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $document->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $document->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ Str::limit($document->descriptions, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $document->lender_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $document->status == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $document->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $document->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a wire:click="downloadDocument({{  $document->id }})" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                   

                                                    <svg data-slot="icon" class="h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                                                    </svg>


                                                </a>
                                                <button wire:click="editDocument({{ $document->id }})" class="text-indigo-600 hover:text-indigo-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button wire:click="deleteConfirmation({{ $document->id }})" class="text-red-600 hover:text-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No documents found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
            
            <!-- Create/Edit Modal -->
            @if($isOpen)
                <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay with blur effect -->
                        <div class="fixed inset-0 bg-gray-10 bg-opacity-50 backdrop-blur-md transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <!-- Modal container with solid background for focus -->
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                           
                            <div class="bg-green-600 px-4 py-3">
                                <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">
                                    {{ $editMode ? 'Edit Document' : 'Upload New Document' }}
                                </h3>
                            </div>
                            <!-- Form container with solid background -->
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <form wire:submit.prevent="store" enctype="multipart/form-data">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Document Name</label>
                                            <input type="text" id="name" wire:model="name"
                                                class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md @error('name') border-red-300 @enderror">
                                            @error('name') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                            <select id="status" wire:model="status"
                                                class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md @error('status') border-red-300 @enderror">
                                                <option value="">Select status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                            @error('status') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="lender_id" class="block text-sm font-medium text-gray-700 mb-1">Lender ID</label>
                                            <input type="text" id="lender_id" wire:model="lender_id"
                                                class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md @error('lender_id') border-red-300 @enderror">
                                            @error('lender_id') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="document" class="block text-sm font-medium text-gray-700 mb-1">
                                                Document File {{ $editMode ? '(Leave empty to keep current file)' : '' }}
                                            </label>
                                            <input type="file" id="document" wire:model="document"
                                                class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md @error('document') border-red-300 @enderror">
                                            <div wire:loading wire:target="document" class="mt-1 text-sm text-blue-600">
                                                Uploading...
                                            </div>
                                            @error('document') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            @if($editMode && $path_url)
                                                <p class="mt-1 text-sm text-gray-500">Current file: {{ $path_url }}</p>
                                            @endif
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label for="descriptions" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                            <textarea id="descriptions" wire:model="descriptions" rows="3"
                                                class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md @error('descriptions') border-red-300 @enderror"></textarea>
                                            @error('descriptions') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                        <div class="flex justify-end">
                                            <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                                                Cancel
                                            </button>
                                        </div>
                                        <div class="flex justify-start">
                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                                {{ $editMode ? 'Update' : 'Upload' }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Delete Confirmation Modal -->
            @if($showDeleteModal)
                <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay with blur effect -->
                        <div class="fixed inset-0 bg-gray-10 bg-opacity-50 backdrop-blur-md transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <!-- Modal container -->
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <!-- Header -->
                            <div class="bg-red-600 px-4 py-3">
                                <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">
                                    Delete Document
                                </h3>
                            </div>
                            
                            <!-- Content -->
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <!-- Warning Icon -->
                                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Confirm Deletion
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Are you sure you want to delete this document? This action cannot be undone and the document file will be permanently removed from storage.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Footer with action buttons -->
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" wire:click="deleteDocument" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Delete
                                </button>
                                <button type="button" wire:click="$toggle('showDeleteModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>



{{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
