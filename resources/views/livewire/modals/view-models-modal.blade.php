<!-- Modal -->
<div 
    class="fixed inset-0 z-50 overflow-y-auto" 
    style="display: {{ $showModal ? 'block' : 'none' }}"
>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div 
            class="fixed inset-0 transition-opacity" 
            aria-hidden="true"
            wire:click="closeModal"
        >
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Centered modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div 
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" 
            aria-modal="true" 
            aria-labelledby="modal-headline"
        >
            <!-- Modal header -->
            <div class="bg-gradient-to-r from-green-600 to-green-800 px-4 py-3 sm:px-6 text-white flex justify-between items-center">
                <h3 class="text-lg leading-6 font-medium" id="modal-headline">
                    @if($criteria)
                        Vehicle Models for {{ $criteria->make->name ?? 'Selected Make' }}
                    @else
                        Vehicle Models
                    @endif
                </h3>
                <button 
                    type="button" 
                    class="text-white hover:text-gray-200 focus:outline-none transition duration-150"
                    wire:click="closeModal"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal content -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                @if($criteria)
                    @if(count($models) > 0)
                        <div class="mb-4 text-sm text-gray-600">
                            This financing criteria includes <span class="font-semibold">{{ count($models) }}</span> specific {{ Str::plural('model', count($models)) }} for {{ $criteria->make->name ?? 'this make' }}.
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-96 overflow-y-auto">
                            @foreach($models as $model)
                                <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-150">
                                    <div class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $model->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-4 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No specific models selected</h3>
                            <p class="mt-1 text-sm text-gray-500">This criteria applies to all models of {{ $criteria->make->name ?? 'the selected make' }}.</p>
                        </div>
                    @endif
                @else
                    <div class="py-4 text-center">
                        <p class="text-gray-500">Loading models...</p>
                    </div>
                @endif
            </div>
            
            <!-- Modal footer -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button 
                    type="button" 
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                    wire:click="closeModal"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>