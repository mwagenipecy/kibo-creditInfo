<div>
{{-- resources/views/livewire/import-duty-application-form.blade.php --}}
    <!-- Header -->
    <div class="w-full bg-green-600 text-white py-8 px-6 text-center">
        <h1 class="text-3xl font-bold text-white mb-2">Apply for Import Duty Financing</h1>
        <p class="text-green-100">Get financing for your vehicle import duties through our network of clearing & forwarding companies and lenders.</p>
        
        <!-- Progress Bar -->
        <div class="mt-6 max-w-2xl mx-auto">
            <div class="flex items-center justify-between text-sm text-green-100 mb-2">
                <span>Step {{ $currentStep }} of {{ $totalSteps }}</span>
                <span>{{ round(($currentStep / $totalSteps) * 100) }}% Complete</span>
            </div>
            <div class="w-full bg-green-700 rounded-full h-2">
                <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
            </div>
        </div>
    </div>

<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Steps -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <!-- Step 1: Applicant Information -->
                @if($currentStep === 1)
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Applicant Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="applicant_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" wire:model="applicant_name" id="applicant_name" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="Enter your full name">
                            @error('applicant_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" wire:model="phone_number" id="phone_number" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="+255712345678">
                            @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" wire:model="email" id="email" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="your@email.com">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="national_id" class="block text-sm font-medium text-gray-700 mb-1">National ID *</label>
                            <input type="text" wire:model="national_id" id="national_id" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="National ID Number">
                            @error('national_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                            <textarea wire:model="address" id="address" rows="3" 
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                      placeholder="Your full address"></textarea>
                            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Application Type *</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="relative flex cursor-pointer rounded-lg p-4 focus:outline-none border-2 {{ $application_type === 'PURCHASED' ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                                    <input type="radio" wire:model="application_type" value="PURCHASED" class="sr-only">
                                    <div class="flex w-full items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-900">I Already Bought the Car</div>
                                                <div class="text-gray-500">I have already purchased the vehicle and have all documents</div>
                                            </div>
                                        </div>
                                        <div class="text-green-600">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="relative flex cursor-pointer rounded-lg p-4 focus:outline-none border-2 {{ $application_type === 'WANT_TO_BUY' ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                                    <input type="radio" wire:model="application_type" value="WANT_TO_BUY" class="sr-only">
                                    <div class="flex w-full items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-900">I Want to Buy a Car</div>
                                                <div class="text-gray-500">I found a car online and want to apply for financing</div>
                                            </div>
                                        </div>
                                        <div class="text-green-600">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('application_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                @endif

                <!-- Step 2: Vehicle Information -->
                @if($currentStep === 2)
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Vehicle Information</h2>
                    
                    @if($application_type === 'WANT_TO_BUY')
                    <!-- Car URL Section -->
                    <div class="mb-8 p-6 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="text-lg font-medium text-blue-900 mb-4">Car Listing Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="car_listing_url" class="block text-sm font-medium text-gray-700 mb-1">Car Listing URL *</label>
                                <div class="flex space-x-2">
                                    <input type="url" wire:model="car_listing_url" id="car_listing_url" 
                                           class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                           placeholder="https://example.com/car-listing">
                                    <button type="button" wire:click="extractCarDetails" 
                                            wire:loading.attr="disabled"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50">
                                        <div wire:loading wire:target="extractCarDetails" class="flex items-center">
                                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                                            Extracting...
                                        </div>
                                        <span wire:loading.remove wire:target="extractCarDetails">Extract Details</span>
                                    </button>
                                </div>
                                @error('car_listing_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <p class="text-sm text-gray-500 mt-1">Paste the URL of the car listing you want to buy</p>
                            </div>
                            
                            @if($extracted_car_image)
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Extracted Car Image</label>
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $extracted_car_image) }}" 
                                         alt="Extracted car image" 
                                         class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                                    <button type="button" wire:click="clearExtractedDetails" 
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endif
                            
                            @if(!empty($extracted_car_details))
                            <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <h4 class="font-medium text-green-900 mb-2">Extracted Car Details</h4>
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    @foreach($extracted_car_details as $key => $value)
                                        @if($value)
                                            <div>
                                                <span class="font-medium text-green-800">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                <span class="text-green-700">{{ $value }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="vehicle_make" class="block text-sm font-medium text-gray-700 mb-1">Vehicle Make *</label>
                            <input type="text" wire:model="vehicle_make" id="vehicle_make" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="e.g., Toyota, BMW, Mercedes">
                            @error('vehicle_make') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="vehicle_model" class="block text-sm font-medium text-gray-700 mb-1">Vehicle Model *</label>
                            <input type="text" wire:model="vehicle_model" id="vehicle_model" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="e.g., Prado, X5, C-Class">
                            @error('vehicle_model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="vehicle_year" class="block text-sm font-medium text-gray-700 mb-1">Year of Manufacture *</label>
                            <input type="number" wire:model="vehicle_year" id="vehicle_year" min="1990" max="{{ date('Y') + 1 }}" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="{{ date('Y') }}">
                            @error('vehicle_year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="vehicle_color" class="block text-sm font-medium text-gray-700 mb-1">Color *</label>
                            <input type="text" wire:model="vehicle_color" id="vehicle_color" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="e.g., White, Black, Silver">
                            @error('vehicle_color') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        @if($application_type === 'PURCHASED')
                        <div>
                            <label for="vehicle_vin" class="block text-sm font-medium text-gray-700 mb-1">VIN Number *</label>
                            <input type="text" wire:model="vehicle_vin" id="vehicle_vin" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="17-character VIN">
                            @error('vehicle_vin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div>
                            <label for="cif_value_usd" class="block text-sm font-medium text-gray-700 mb-1">CIF Value (USD) *</label>
                            <input type="number" wire:model="cif_value_usd" id="cif_value_usd" step="0.01" min="1000" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="15000.00">
                            @error('cif_value_usd') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <p class="text-sm text-gray-500 mt-1">Cost, Insurance, and Freight value in US Dollars</p>
                        </div>

                        <div>
                            <label for="vehicle_engine_size" class="block text-sm font-medium text-gray-700 mb-1">Engine Size</label>
                            <input type="text" wire:model="vehicle_engine_size" id="vehicle_engine_size" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="e.g., 2.0L, 3.5L">
                        </div>

                        <div>
                            <label for="port_of_entry" class="block text-sm font-medium text-gray-700 mb-1">Port of Entry</label>
                            <select wire:model="port_of_entry" id="port_of_entry" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                <option value="Dar es Salaam">Dar es Salaam</option>
                                <option value="Mtwara">Mtwara</option>
                                <option value="Tanga">Tanga</option>
                            </select>
                        </div>

                        <div>
                            <label for="vehicle_mileage" class="block text-sm font-medium text-gray-700 mb-1">Mileage (KM)</label>
                            <input type="number" wire:model="vehicle_mileage" id="vehicle_mileage" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="50000">
                        </div>

                        <div>
                            <label for="expected_arrival_date" class="block text-sm font-medium text-gray-700 mb-1">Expected Arrival Date</label>
                            <input type="date" wire:model="expected_arrival_date" id="expected_arrival_date" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                        </div>
                    </div>
                </div>
                @endif

                <!-- Step 3: Document Upload -->
                @if($currentStep === 3)
                <div>
                    @if($application_type === 'PURCHASED')
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Required Documents</h2>
                    <p class="text-gray-600 mb-6">Please upload the following documents. All files must be in PDF, JPG, or PNG format and under 5MB.</p>
                    @else
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Document Information</h2>
                    <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex">
                            <svg class="h-5 w-5 text-yellow-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="font-medium text-yellow-900">No Documents Required Yet</h3>
                                <p class="text-sm text-yellow-800 mt-1">
                                    Since you haven't purchased the car yet, you don't need to upload documents at this stage. 
                                    Once you select a CF company and they help you purchase the vehicle, you'll need to provide the required documents.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($application_type === 'PURCHASED')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition-colors">
                            <label for="bill_of_lading" class="block text-sm font-medium text-gray-700 mb-2">Bill of Lading *</label>
                            <input type="file" wire:model="bill_of_lading" id="bill_of_lading" accept=".pdf,.jpg,.jpeg,.png" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('bill_of_lading') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @if($bill_of_lading)
                                <div class="mt-2 p-2 bg-green-50 border border-green-200 rounded">
                                    <p class="text-sm text-green-600">✓ File uploaded: {{ $bill_of_lading->getClientOriginalName() }}</p>
                                </div>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Shipping document showing goods details</p>
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition-colors">
                            <label for="commercial_invoice" class="block text-sm font-medium text-gray-700 mb-2">Commercial Invoice *</label>
                            <input type="file" wire:model="commercial_invoice" id="commercial_invoice" accept=".pdf,.jpg,.jpeg,.png" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('commercial_invoice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @if($commercial_invoice)
                                <div class="mt-2 p-2 bg-green-50 border border-green-200 rounded">
                                    <p class="text-sm text-green-600">✓ File uploaded: {{ $commercial_invoice->getClientOriginalName() }}</p>
                                </div>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Purchase invoice from seller</p>
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition-colors">
                            <label for="packing_list" class="block text-sm font-medium text-gray-700 mb-2">Packing List *</label>
                            <input type="file" wire:model="packing_list" id="packing_list" accept=".pdf,.jpg,.jpeg,.png" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('packing_list') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @if($packing_list)
                                <div class="mt-2 p-2 bg-green-50 border border-green-200 rounded">
                                    <p class="text-sm text-green-600">✓ File uploaded: {{ $packing_list->getClientOriginalName() }}</p>
                                </div>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Detailed list of shipped items</p>
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition-colors">
                            <label for="certificate_of_origin" class="block text-sm font-medium text-gray-700 mb-2">Certificate of Origin *</label>
                            <input type="file" wire:model="certificate_of_origin" id="certificate_of_origin" accept=".pdf,.jpg,.jpeg,.png" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('certificate_of_origin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @if($certificate_of_origin)
                                <div class="mt-2 p-2 bg-green-50 border border-green-200 rounded">
                                    <p class="text-sm text-green-600">✓ File uploaded: {{ $certificate_of_origin->getClientOriginalName() }}</p>
                                </div>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Document certifying country of origin</p>
                        </div>
                    </div>

                    <!-- Upload Progress Indicator -->
                    <div wire:loading wire:target="bill_of_lading,commercial_invoice,packing_list,certificate_of_origin" 
                         class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-center">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 mr-2"></div>
                            <span class="text-blue-700 text-sm">Uploading file...</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h4 class="font-medium text-blue-900 mb-2">Document Guidelines:</h4>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• All documents must be clear and legible</li>
                            <li>• File size should not exceed 5MB per document</li>
                            <li>• Accepted formats: PDF, JPG, JPEG, PNG</li>
                            <li>• Ensure all information is visible and complete</li>
                        </ul>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Step 4: Financing Preferences -->
                @if($currentStep === 4)
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Financing Preferences</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="down_payment" class="block text-sm font-medium text-gray-700 mb-1">Preferred Down Payment (TZS)</label>
                            <input type="number" wire:model="down_payment" id="down_payment" step="1000" min="0" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="Optional - Leave blank for minimum">
                            @error('down_payment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <p class="text-sm text-gray-500 mt-1">Higher down payment may result in better interest rates</p>
                        </div>

                        <div>
                            <label for="loan_tenure_months" class="block text-sm font-medium text-gray-700 mb-1">Loan Tenure (Months) *</label>
                            <select wire:model="loan_tenure_months" id="loan_tenure_months" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                <option value="12">12 months</option>
                                <option value="18">18 months</option>
                                <option value="24">24 months</option>
                                <option value="36">36 months</option>
                                <option value="48">48 months</option>
                                <option value="60">60 months</option>
                                <option value="72">72 months</option>
                                <option value="84">84 months</option>
                            </select>
                            @error('loan_tenure_months') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Summary Section -->
                    <div class="mt-8 p-6 bg-gray-50 border border-gray-200 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Applicant:</span>
                                <span class="font-medium text-gray-900 ml-2">{{ $applicant_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-900 ml-2">{{ $email }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Vehicle:</span>
                                <span class="font-medium text-gray-900 ml-2">{{ $vehicle_make }} {{ $vehicle_model }} {{ $vehicle_year }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">CIF Value:</span>
                                <span class="font-medium text-gray-900 ml-2">${{ number_format($cif_value_usd, 2) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Loan Tenure:</span>
                                <span class="font-medium text-gray-900 ml-2">{{ $loan_tenure_months }} months</span>
                            </div>
                            @if($down_payment)
                            <div>
                                <span class="text-gray-600">Down Payment:</span>
                                <span class="font-medium text-gray-900 ml-2">TZS {{ number_format($down_payment) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <h4 class="font-medium text-yellow-900 mb-2">Important Information:</h4>
                        <ul class="text-sm text-yellow-800 space-y-1">
                            <li>• Your application will be sent to all registered clearing & forwarding companies</li>
                            <li>• CF companies will provide quotations based on TRA calculations within 48 hours</li>
                            <li>• You can compare and select the best quotation</li>
                            <li>• Selected quotation will then be sent to lenders for financing offers</li>
                            <li>• First lender to approve secures the deal (or you can choose from multiple offers)</li>
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                    <div>
                        @if($currentStep > 1)
                            <button type="button" wire:click="previousStep" 
                                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Previous
                            </button>
                        @endif
                    </div>

                    <div class="flex space-x-3">
                        @if($currentStep < $totalSteps)
                            <button type="button" wire:click="nextStep" 
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Next Step
                            </button>
                        @else
                            <button type="button" wire:click="submitApplication" 
                                    wire:loading.attr="disabled"
                                    class="px-8 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50">
                                <div wire:loading wire:target="submitApplication" class="flex items-center">
                                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                                    Submitting...
                                </div>
                                <span wire:loading.remove wire:target="submitApplication">Submit Application</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Process Flow Information -->
            <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">What Happens After Submission?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3">1</div>
                        <h4 class="font-medium text-gray-900 mb-2">CF Companies Review</h4>
                        <p class="text-sm text-gray-600">Clearing & forwarding companies review your application and get official duty calculations from TRA.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3">2</div>
                        <h4 class="font-medium text-gray-900 mb-2">Compare Quotations</h4>
                        <p class="text-sm text-gray-600">You receive multiple quotations with exact duty amounts and service fees. Select the best option.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3">3</div>
                        <h4 class="font-medium text-gray-900 mb-2">Get Financing</h4>
                        <p class="text-sm text-gray-600">Lenders compete to finance your import duties. First to approve or best terms wins.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
