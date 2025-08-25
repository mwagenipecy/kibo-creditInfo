<div>
{{-- resources/views/livewire/import-duty-application-form.blade.php --}}
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Apply for Import Duty Financing</h1>
                <p class="text-gray-600">Get financing for your vehicle import duties through our network of clearing & forwarding companies and lenders.</p>
                
                <!-- Progress Bar -->
                <div class="mt-6">
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span>Step {{ $currentStep }} of {{ $totalSteps }}</span>
                        <span>{{ round(($currentStep / $totalSteps) * 100) }}% Complete</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full transition-all duration-300" style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
                    </div>
                </div>
            </div>

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
                    </div>
                </div>
                @endif

                <!-- Step 2: Vehicle Information -->
                @if($currentStep === 2)
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Vehicle Information</h2>
                    
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

                        <div>
                            <label for="vehicle_vin" class="block text-sm font-medium text-gray-700 mb-1">VIN Number *</label>
                            <input type="text" wire:model="vehicle_vin" id="vehicle_vin" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" 
                                   placeholder="17-character VIN">
                            @error('vehicle_vin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

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
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Required Documents</h2>
                    <p class="text-gray-600 mb-6">Please upload the following documents. All files must be in PDF, JPG, or PNG format and under 5MB.</p>
                    
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
