
<div>
    <div class="p-2">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <!-- Header with gradient background -->
            <div class="bg-gradient-to-r from-blue-600 to-green-700 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-white">Financing Criteria Settings</h2>
                    <div class="flex space-x-2">
                        <button wire:click="showAddMultipleCriteriaForm" class="px-4 py-2 bg-white text-green-700 rounded-md shadow hover:bg-gray-100 transition-colors duration-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                            </svg>
                            Batch Add
                        </button>
                        <button wire:click="showAddCriteriaForm" class="px-4 py-2 bg-white text-green-700 rounded-md shadow hover:bg-gray-100 transition-colors duration-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add Criteria
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Alert Messages -->
                @if (session()->has('success'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p>{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif



                <!-- Individual Criteria Form -->
                @if($showForm)
                <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-sm mb-6 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-3 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $editMode ? 'Edit' : 'Add' }} Financing Criteria</h3>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Make -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Make *</label>
                                <select
                                    wire:model="criteria.make_id"

                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md shadow-sm"
                                >
                                    <option value="">Select Make</option>
                                    @foreach($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                    @endforeach
                                </select>
                                @error('criteria.make_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Model (Single) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Model (Optional)</label>
                                <select
                                    wire:model="criteria.model_id"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md shadow-sm"
                                >
                                    <option value="">Any Model</option>
                                    @foreach($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Select "Any Model" to apply criteria to all models of this make</p>
                                @error('criteria.model_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Year Range -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Year Range *</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">From</span>
                                            </div>
                                            <input type="number" wire:model="criteria.min_year" class="focus:ring-green-500 focus:border-green-500 block w-full pl-14 pr-4 py-2 border-gray-300 rounded-md">
                                        </div>
                                        @error('criteria.min_year') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">To</span>
                                            </div>
                                            <input type="number" wire:model="criteria.max_year" class="focus:ring-green-500 focus:border-green-500 block w-full pl-12 pr-4 py-2 border-gray-300 rounded-md">
                                        </div>
                                        @error('criteria.max_year') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Max Mileage -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Max Mileage</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="number" wire:model="criteria.max_mileage" class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-12 py-2 border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">km</span>
                                    </div>
                                </div>
                                @error('criteria.max_mileage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Max Price -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Max Price</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" step="0.01" wire:model="criteria.max_price" class="focus:ring-green-500 focus:border-green-500 block w-full pl-7 pr-4 py-2 border-gray-300 rounded-md">
                                </div>
                                @error('criteria.max_price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Min Down Payment % -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Min Down Payment</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" wire:model="criteria.min_down_payment_percent" class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-12 py-2 border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">%</span>
                                    </div>
                                </div>
                                @error('criteria.min_down_payment_percent') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>


                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Interest Rate</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="number"  wire:model="criteria.interest_rate" class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-12 py-2 border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">%</span>
                                    </div>
                                </div>
                                @error('criteria.interest_rate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>


                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button wire:click="cancelForm" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                            @if($editMode)
                            <button wire:click="updateCriteria" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Criteria
                            </button>
                            @else
                            <button wire:click="addCriteria" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Save Criteria
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Batch Criteria Form -->
                @if($showBatchForm ?? false)
                <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-sm mb-6 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-green-50 px-6 py-3 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Add Multiple Criteria for Same Make</h3>
                    </div>

                    <div class="p-6">
                        <p class="text-sm text-gray-600 mb-4">
                            This form lets you create financing criteria for multiple models of the same make at once.
                            All selected models will share the same financing terms.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Make -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Make *</label>
                                <select
                                    wire:model="batchCriteria.make_id"
                                    wire:change="updateBatchModels($event.target.value)"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md shadow-sm"
                                >
                                    <option value="">Select Make</option>
                                    @foreach($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                    @endforeach
                                </select>
                                @error('batchCriteria.make_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Model Selection -->
                            <div class="md:col-span-2" x-data="{ selectAll: false }">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Select Models *</label>

                                @if(count($batchModels ?? []) > 0)
                                <div class="flex items-center mb-2">
                                    <input
                                        type="checkbox"
                                        id="select-all-models"
                                        x-model="selectAll"
                                        @click="$event.preventDefault(); $wire.toggleAllBatchModels(selectAll = !selectAll)"
                                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                                    >
                                    <label for="select-all-models" class="ml-2 text-sm text-gray-700">Select All Models</label>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border border-gray-200 rounded-md p-3 max-h-60 overflow-y-auto">
                                    @foreach($batchModels as $model)
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            id="model-{{ $model->id }}"
                                            value="{{ $model->id }}"
                                            wire:model="selectedBatchModels"
                                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                                        >
                                        <label for="model-{{ $model->id }}" class="ml-2 text-sm text-gray-700">{{ $model->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="border border-gray-200 rounded-md p-3 bg-gray-50 text-gray-500 text-sm h-20 flex items-center justify-center">
                                    Please select a make to view available models
                                </div>
                                @endif

                                @error('selectedBatchModels') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Year Range -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Year Range *</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">From</span>
                                            </div>
                                            <input type="number" wire:model="batchCriteria.min_year" class="focus:ring-green-500 focus:border-green-500 block w-full pl-14 pr-4 py-2 border-gray-300 rounded-md">
                                        </div>
                                        @error('batchCriteria.min_year') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">To</span>
                                            </div>
                                            <input type="number" wire:model="batchCriteria.max_year" class="focus:ring-green-500 focus:border-green-500 block w-full pl-12 pr-4 py-2 border-gray-300 rounded-md">
                                        </div>
                                        @error('batchCriteria.max_year') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Max Mileage -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Max Mileage</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="number" wire:model="batchCriteria.max_mileage" class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-12 py-2 border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">km</span>
                                    </div>
                                </div>
                                @error('batchCriteria.max_mileage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Max Price -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Max Price</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" step="0.01" wire:model="batchCriteria.max_price" class="focus:ring-green-500 focus:border-green-500 block w-full pl-7 pr-4 py-2 border-gray-300 rounded-md">
                                </div>
                                @error('batchCriteria.max_price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Min Down Payment % -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Min Down Payment</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" wire:model="batchCriteria.min_down_payment_percent" class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-12 py-2 border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">%</span>
                                    </div>
                                </div>
                                @error('batchCriteria.min_down_payment_percent') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>



                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Interest Rate</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" wire:model="batchCriteria.interestRate" class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-12 py-2 border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">%</span>
                                    </div>
                                </div>
                                @error('batchCriteria.interest_rate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>




                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button wire:click="cancelBatchForm" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                            <button
                                wire:click="addBatchCriteria"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Create Criteria for All Selected Models
                            </button>
                        </div>
                    </div>
                </div>
                @endif

              <!-- Criteria List as Card Layout -->
<div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
    <!-- Search and Filter Bar -->
    <div class="p-4 bg-gray-50 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between space-y-3 sm:space-y-0 sm:space-x-4">
            <div class="relative w-full sm:w-64">
                <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search by make or model..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <div class="absolute left-3 top-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Card List -->
    <div class="p-4">
        <!-- Group by Make -->
        @php
            $groupedCriteria = $criteriaList->groupBy('make_id');
        @endphp

        @if($groupedCriteria->count() > 0)
            @foreach($groupedCriteria as $makeId => $items)
                @php
                    $make = $items->first()->make;
                @endphp

                <div class="mb-6 last:mb-0">
                    <!-- Make Header -->
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-100 rounded-t-lg px-4 py-2 flex items-center">
                        <h3 class="text-base font-semibold text-indigo-900">{{ $make->name }}</h3>
                        <span class="ml-2 px-2 py-0.5 bg-indigo-100 text-indigo-800 rounded-full text-xs">
                            {{ $items->count() }} {{ Str::plural('criteria', $items->count()) }}
                        </span>
                    </div>

                    <!-- Models Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4 bg-white border-l border-r border-b border-gray-200 rounded-b-lg">
                        @foreach($items as $item)
                            <div class="bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                                <div class="bg-gray-50 px-4 py-2 border-b border-gray-100">
                                    <div class="flex justify-between items-center">
                                        <div class="font-medium text-sm text-gray-800">
                                            @if($item->model)
                                                {{ $item->model->name }}
                                            @else
                                                <span class="text-gray-500">Any Model</span>
                                            @endif
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $item->min_year }} - {{ $item->max_year }}
                                        </span>
                                    </div>
                                </div>

                                <div class="px-4 py-3">
                                    <dl class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <dt class="text-gray-500">Max Mileage:</dt>
                                            <dd class="text-gray-900">
                                                @if($item->max_mileage)
                                                    {{ number_format($item->max_mileage) }} km
                                                @else
                                                    <span class="text-gray-400 italic">No limit</span>
                                                @endif
                                            </dd>
                                        </div>

                                        <div class="flex justify-between">
                                            <dt class="text-gray-500">Max Price:</dt>
                                            <dd class="text-gray-900">
                                                @if($item->max_price)
                                                     {{ number_format($item->max_price, 2) }} TZS
                                                @else
                                                    <span class="text-gray-400 italic">No limit</span>
                                                @endif
                                            </dd>
                                        </div>

                                        <div class="flex justify-between">
                                            <dt class="text-gray-500">Min Down Payment:</dt>
                                            <dd class="text-gray-900">
                                                @if($item->min_down_payment_percent)
                                                    {{ $item->min_down_payment_percent }}%
                                                @else
                                                    <span class="text-gray-400 italic">No minimum</span>
                                                @endif
                                            </dd>
                                        </div>



                                    </dl>
                                </div>

                                <div class="bg-gray-50 px-4 py-2 border-t border-gray-100 flex justify-end space-x-2">
                                    <button wire:click="editCriteria({{ $item->id }})" class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-xs font-medium bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button
                                        wire:click="deleteCriteria({{ $item->id }})"
                                        class="inline-flex items-center p-1.5 border border-red-300 rounded-md text-xs font-medium bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="return confirm('Are you sure you want to delete this criteria?')"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="py-10 text-center text-sm text-gray-500">
                <div class="flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-500 mb-2">No financing criteria found</p>
                    <button wire:click="showAddCriteriaForm" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Your First Criteria
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($criteriaList->hasPages())
        <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
            {{ $criteriaList->links() }}
        </div>
    @endif
</div>



            </div>
        </div>
    </div>
</div>
