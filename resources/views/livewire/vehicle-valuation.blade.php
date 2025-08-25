<div>
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Tanzania Vehicle Valuation System</h2>
        <p class="text-gray-600">Get official vehicle valuation and tax calculations from TRA</p>
    </div>

    @if($error)
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <div class="flex justify-between items-start">
                <div>
                    <strong>Error:</strong> {{ $error }}
                </div>
                <button wire:click="refreshSession" 
                        class="ml-4 px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                    Refresh Session
                </button>
            </div>
        </div>
    @endif

    @if($debugInfo && config('app.debug'))
        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 text-blue-700 rounded text-sm">
            <strong>Debug:</strong> {{ $debugInfo }}
        </div>
    @endif

    @if($loading)
        <div class="mb-4 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading...
        </div>
    @endif

    <form wire:submit.prevent="getValuation" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Make Selection -->
            <div>
                <label for="make" class="block text-sm font-medium text-gray-700 mb-2">
                    Vehicle Make <span class="text-red-500">*</span>
                </label>
                <select wire:model.live="selectedMake" id="make" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @foreach($makes as $make)
                        <option value="{{ $make['value'] }}">{{ $make['text'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Model Selection -->
            <div>
                <label for="model" class="block text-sm font-medium text-gray-700 mb-2">
                    Vehicle Model <span class="text-red-500">*</span>
                </label>
                <select wire:model.live="selectedModel" id="model" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100"
                        {{ empty($models) ? 'disabled' : '' }}>
                    @if(empty($models))
                        <option value="">Select Make First</option>
                    @else
                        @foreach($models as $model)
                            <option value="{{ $model['value'] }}">{{ $model['text'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Year Selection -->
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                    Year of Manufacture <span class="text-red-500">*</span>
                </label>
                <select wire:model.live="selectedYear" id="year" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100"
                        {{ empty($years) ? 'disabled' : '' }}>
                    @if(empty($years))
                        <option value="">Select Model First</option>
                    @else
                        @foreach($years as $year)
                            <option value="{{ $year['value'] }}">{{ $year['text'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Country Selection -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                    Country of Origin <span class="text-red-500">*</span>
                </label>
                <select wire:model.live="selectedCountry" id="country" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100"
                        {{ empty($countries) ? 'disabled' : '' }}>
                    @if(empty($countries))
                        <option value="">Select Year First</option>
                    @else
                        @foreach($countries as $country)
                            <option value="{{ $country['value'] }}">{{ $country['text'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Fuel Type Selection -->
            <div>
                <label for="fuelType" class="block text-sm font-medium text-gray-700 mb-2">
                    Fuel Type <span class="text-red-500">*</span>
                </label>
                <select wire:model.live="selectedFuelType" id="fuelType" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100"
                        {{ empty($fuelTypes) ? 'disabled' : '' }}>
                    @if(empty($fuelTypes))
                        <option value="">Select Country First</option>
                    @else
                        @foreach($fuelTypes as $fuelType)
                            <option value="{{ $fuelType['value'] }}">{{ $fuelType['text'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Engine Selection -->
            <div>
                <label for="engine" class="block text-sm font-medium text-gray-700 mb-2">
                    Engine Capacity <span class="text-red-500">*</span>
                </label>
                <select wire:model.live="selectedEngine" id="engine" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100"
                        {{ empty($engines) ? 'disabled' : '' }}>
                    @if(empty($engines))
                        <option value="">Select Fuel Type First</option>
                    @else
                        @foreach($engines as $engine)
                            <option value="{{ $engine['value'] }}">{{ $engine['text'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-4 pt-6">
            <button type="submit" 
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    {{ $loading ? 'disabled' : '' }}>
                @if($loading)
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                @else
                    Get Valuation
                @endif
            </button>

            <button type="button" wire:click="resetForm" 
                    class="px-6 py-3 bg-gray-500 text-white font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Reset Form
            </button>
            
            <button type="button" wire:click="refreshSession" 
                    class="px-6 py-3 bg-yellow-500 text-white font-medium rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                Refresh Session
            </button>
        </div>
    </form>

    <!-- Valuation Results -->
    @if($valuationResult)
        <div class="mt-8 bg-green-50 border border-green-200 rounded-lg p-6">
            <h3 class="text-xl font-bold text-green-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Valuation Results
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($valuationResult as $label => $value)
                    <div class="bg-white p-4 rounded-md shadow-sm border">
                        <div class="text-sm font-medium text-gray-600 mb-1">{{ $label }}</div>
                        <div class="text-lg font-semibold text-gray-900 
                            @if(str_contains(strtolower($label), 'total')) text-green-600 @endif">
                            {{ $value }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Section for Important Values -->
            @if(isset($valuationResult['Customs Value CIF (USD)']) || isset($valuationResult['TOTAL TAXES (TSHS)']))
                <div class="mt-6 pt-6 border-t border-green-300">
                    <h4 class="text-lg font-semibold text-green-800 mb-4">Summary</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @if(isset($valuationResult['Customs Value CIF (USD)']))
                            <div class="bg-blue-100 p-4 rounded-md text-center">
                                <div class="text-sm text-blue-600 font-medium">Vehicle Value</div>
                                <div class="text-xl font-bold text-blue-800">
                                    ${{ $valuationResult['Customs Value CIF (USD)'] }}
                                </div>
                            </div>
                        @endif

                        @if(isset($valuationResult['Total Import Taxes (USD)']))
                            <div class="bg-orange-100 p-4 rounded-md text-center">
                                <div class="text-sm text-orange-600 font-medium">Import Taxes</div>
                                <div class="text-xl font-bold text-orange-800">
                                    ${{ $valuationResult['Total Import Taxes (USD)'] }}
                                </div>
                            </div>
                        @endif

                        @if(isset($valuationResult['TOTAL TAXES (TSHS)']))
                            <div class="bg-green-100 p-4 rounded-md text-center">
                                <div class="text-sm text-green-600 font-medium">Total Taxes (TSHS)</div>
                                <div class="text-xl font-bold text-green-800">
                                    {{ $valuationResult['TOTAL TAXES (TSHS)'] }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Print/Export Actions -->
            <div class="mt-6 pt-6 border-t border-green-300 flex justify-center space-x-4">
                <button onclick="window.print()" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Print Results
                </button>
                <button wire:click="exportToPdf" 
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Export to PDF
                </button>
            </div>
        </div>
    @endif

    <!-- Information Section -->
    <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Information</h3>
        <div class="text-sm text-gray-600 space-y-2">
            <p>• This system provides official vehicle valuation from Tanzania Revenue Authority (TRA)</p>
            <p>• All tax calculations are based on current TRA rates and regulations</p>
            <p>• Values are provided in both USD and Tanzanian Shillings (TSHS)</p>
            <p>• Results include import duty, VAT, excise duty, and other applicable fees</p>
            <p>• For official documentation, please visit TRA offices with these calculations</p>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print-area, .print-area * {
            visibility: visible;
        }
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>

</div>
