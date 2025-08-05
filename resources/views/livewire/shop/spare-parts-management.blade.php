<div>
{{-- resources/views/livewire/shop/spare-parts-management.blade.php --}}
<div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Spare Parts Management</h1>
            <p class="text-lg text-gray-600 mt-2">Manage your shop's spare parts inventory</p>
        </div>

        {{-- Messages --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Controls --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                {{-- Search and Filter --}}
                <div class="flex flex-col sm:flex-row gap-4 flex-1">
                    <div class="flex-1">
                        <input type="text" wire:model="search" placeholder="Search spare parts..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div class="min-w-48">
                        <select wire:model="categoryFilter" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Add Button --}}
                <button wire:click="openModal" 
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Spare Part
                </button>
            </div>
        </div>

        {{-- Spare Parts Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-6">
            @forelse($spareParts as $part)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                    {{-- Image --}}
                    <div class="aspect-w-16 aspect-h-12 bg-gray-200">
                        @if($part->preview_image)
                            <img src="{{ Storage::url($part->preview_image) }}" 
                                 alt="{{ $part->unit }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $part->unit }}</h3>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-3">
                            <div>
                                <span class="font-medium">Category:</span> {{ $part->spareCategory->name }}
                            </div>
                            @if($part->spareBrand)
                                <div>
                                    <span class="font-medium">Brand:</span> {{ $part->spareBrand->name }}
                                </div>
                            @endif
                            @if($part->spareModel)
                                <div>
                                    <span class="font-medium">Model:</span> {{ $part->spareModel->name }}
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-lg font-bold text-green-600">
                                Tzs {{ number_format($part->price, 2) }}
                            </span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                {{ ucfirst(str_replace('_', ' ', $part->price_type)) }}
                            </span>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2">
                            <button wire:click="editSparePart({{ $part->id }})" 
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-3 rounded transition duration-200">
                                Edit
                            </button>
                            <button wire:click="deleteSparePart({{ $part->id }})" 
                                    onclick="confirm('Are you sure you want to delete this spare part?') || event.stopImmediatePropagation()"
                                    class="flex-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium py-2 px-3 rounded transition duration-200">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No spare parts found</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by adding your first spare part.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        {{ $spareParts->links() }}

        {{-- Modal --}}
        @if($showModal)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                    {{-- Modal Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900">
                            {{ $editMode ? 'Edit Spare Part' : 'Add New Spare Part' }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Form --}}
                    <form wire:submit.prevent="saveSparePart">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            {{-- Category --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                                <select wire:model="spare_category_id" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('spare_category_id') border-red-500 @enderror">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('spare_category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Brand --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                <select wire:model="spare_brand_id" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('spare_brand_id') border-red-500 @enderror">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('spare_brand_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Model --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                                <select wire:model="spare_model_id" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('spare_model_id') border-red-500 @enderror">
                                    <option value="">Select Model</option>
                                    @foreach($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                                    @endforeach
                                </select>
                                @error('spare_model_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Unit --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Unit *</label>
                                <input type="text" wire:model="unit" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('unit') border-red-500 @enderror">
                                @error('unit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Price Type --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price Type *</label>
                                <select wire:model="price_type" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('price_type') border-red-500 @enderror">
                                    <option value="per_unit">Per Unit</option>
                                    <option value="per_bundle">Per Bundle</option>
                                </select>
                                @error('price_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Price --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                                <input type="number" step="0.01" wire:model="price" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('price') border-red-500 @enderror">
                                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea wire:model="description" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('description') border-red-500 @enderror"></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Images --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-4">Images</label>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                {{-- Preview Image --}}
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">Preview Image *</label>
                                    <input type="file" wire:model="preview_image" accept="image/*" 
                                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                    @error('preview_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    
                                    @if($editMode && $current_preview_image)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($current_preview_image) }}" alt="Current" class="w-20 h-20 object-cover rounded">
                                        </div>
                                    @endif
                                </div>

                                {{-- Additional Image 1 --}}
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">Additional Image 1</label>
                                    <input type="file" wire:model="additional_image_1" accept="image/*" 
                                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                    @error('additional_image_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    
                                    @if($editMode && $current_additional_image_1)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($current_additional_image_1) }}" alt="Current" class="w-20 h-20 object-cover rounded">
                                        </div>
                                    @endif
                                </div>

                                {{-- Additional Image 2 --}}
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">Additional Image 2</label>
                                    <input type="file" wire:model="additional_image_2" accept="image/*" 
                                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                    @error('additional_image_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    
                                    @if($editMode && $current_additional_image_2)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($current_additional_image_2) }}" alt="Current" class="w-20 h-20 object-cover rounded">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Modal Actions --}}
                        <div class="flex justify-end gap-3">
                            <button type="button" wire:click="closeModal" 
                                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                                {{ $editMode ? 'Update' : 'Create' }} Spare Part
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

</div>
