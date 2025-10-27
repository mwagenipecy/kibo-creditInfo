<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ $editMode ? 'Edit Vehicle' : 'Register Your Vehicle for Sale' }}
            </h1>
            <p class="text-gray-600">Fill in the details about your vehicle</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit.prevent="save" class="bg-white rounded-lg shadow-md p-6 space-y-6">
            {{-- Make and Model --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Make*</label>
                    <select wire:model="make_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">Select Make</option>
                        @foreach($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Model*</label>
                    <select wire:model="model_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">Select Model</option>
                        @foreach($models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Year, Price, Mileage --}}
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Year*</label>
                    <input type="number" wire:model="year" min="1900" max="{{ date('Y') + 1 }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., 2020">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price (TSh)*</label>
                    <input type="number" wire:model="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., 15000000">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mileage (km)*</label>
                    <input type="number" wire:model="mileage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., 50000">
                </div>
            </div>

            {{-- Body Type, Fuel Type, Transmission --}}
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Body Type*</label>
                    <select wire:model="body_type_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">Select Body Type</option>
                        @foreach($bodyTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fuel Type*</label>
                    <select wire:model="fuel_type_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">Select Fuel Type</option>
                        @foreach($fuelTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transmission*</label>
                    <select wire:model="transmission_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">Select Transmission</option>
                        @foreach($transmissions as $transmission)
                            <option value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Color, VIN, Location --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Color*</label>
                    <input type="text" wire:model="color" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Black">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">VIN (Vehicle Identification Number)*</label>
                    <input type="text" wire:model="vin" maxlength="17" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., 1HGBH41JXMN109186">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location*</label>
                <input type="text" wire:model="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Dar es Salaam, Tanzania">
            </div>

            {{-- Vehicle Condition and Description --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Condition*</label>
                    <select wire:model="vehicle_condition" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">Select Condition</option>
                        <option value="Brand New">Brand New</option>
                        <option value="Used - Excellent">Used - Excellent</option>
                        <option value="Used - Good">Used - Good</option>
                        <option value="Used - Fair">Used - Fair</option>
                        <option value="Used - Needs Repair">Used - Needs Repair</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trim</label>
                    <input type="text" wire:model="trim" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Sport">
                </div>
            </div>

            {{-- Optional Fields --}}
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Engine Size</label>
                    <input type="text" wire:model="engine_size" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., 2.0L">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Horsepower</label>
                    <input type="number" wire:model="horsepower" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., 250">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Seating Capacity</label>
                    <input type="number" wire:model="seating_capacity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., 5">
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description*</label>
                <textarea wire:model="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="Describe your vehicle..."></textarea>
            </div>

            {{-- Images --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Front View Image*</label>
                <input type="file" wire:model="front_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                @if($front_image)
                    <div class="mt-2">
                        <img src="{{ $front_image->temporaryUrl() }}" alt="Preview" class="h-32 object-cover rounded">
                    </div>
                @endif
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Side View Image</label>
                    <input type="file" wire:model="side_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @if($side_image)
                        <div class="mt-2">
                            <img src="{{ $side_image->temporaryUrl() }}" alt="Preview" class="h-32 object-cover rounded">
                        </div>
                    @endif
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Back View Image</label>
                    <input type="file" wire:model="back_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @if($back_image)
                        <div class="mt-2">
                            <img src="{{ $back_image->temporaryUrl() }}" alt="Preview" class="h-32 object-cover rounded">
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Images</label>
                <input type="file" wire:model="additional_images" multiple accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            {{-- Submit Buttons --}}
            <div class="flex gap-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    {{ $editMode ? 'Update Vehicle' : 'Register Vehicle' }}
                </button>
                <a href="{{ route('my.vehicles') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
