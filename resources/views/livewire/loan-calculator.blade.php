<div>

<div>
<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Loan Calculator</h1>
        <p class="text-gray-600">Calculate your loan payments and view detailed payment schedule</p>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="mt-4 max-w-md mx-auto bg-green-50 border border-green-200 rounded-lg p-3">
                <p class="text-sm text-green-700">{{ session('message') }}</p>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mt-4 max-w-md mx-auto bg-red-50 border border-red-200 rounded-lg p-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column - Input Form -->
        <div class="lg:col-span-2">

            <!-- General Loan Details -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">General Loan Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Loan Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Loan Type <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="loan_type" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500">
                            @foreach($loan_types as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('loan_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Loan Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Loan Amount <span class="text-red-500">*</span>
                        </label>
                        <input type="number" wire:model.debounce.500ms="loan_amount"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500"
                               placeholder="7,000,000">
                        @error('loan_amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Loan Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Loan Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="loan_date"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500">
                        @error('loan_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Repayment Start Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Repayment Start Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="repayment_start_date"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500">
                        @error('repayment_start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Repayment Frequency -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Repayment Frequency <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="repayment_frequency" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500">
                            @foreach($repayment_frequencies as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('repayment_frequency') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Other Charges -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Other charges (If any)
                        </label>
                        <input type="number" step="0.01" wire:model.debounce.500ms="other_charges"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500"
                               placeholder="0">
                        @error('other_charges') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Additional Charges -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Additional charges (If any)
                        </label>
                        <input type="number" step="0.01" wire:model.debounce.500ms="additional_charges"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500"
                               placeholder="0">
                        @error('additional_charges') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Interest Section -->
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Interest</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Interest Percentage -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Percentage <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" step="0.01" wire:model.debounce.500ms="interest_percentage"
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500"
                                   placeholder="12.00">
                            <span class="absolute right-3 top-2 text-gray-500">%</span>
                        </div>
                        @error('interest_percentage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Duration
                        </label>
                        <div class="relative">
                            <input type="number" wire:model.debounce.500ms="duration_months"
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500"
                                   placeholder="12">
                            <span class="absolute right-3 top-2 text-gray-500">Months</span>
                        </div>
                        @error('duration_months') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Interest Calculation Method -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Amortization Method <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <label class="flex items-center p-3 border border-gray-300 rounded cursor-pointer hover:border-green-500 transition-colors {{ $amortization_method === 'reducing_balance' ? 'border-green-500 bg-green-50' : '' }}">
                            <input type="radio" wire:model="amortization_method" value="reducing_balance" class="sr-only">
                            <div class="w-4 h-4 border-2 border-gray-400 rounded-full mr-3 flex items-center justify-center {{ $amortization_method === 'reducing_balance' ? 'border-green-500' : '' }}">
                                @if($amortization_method === 'reducing_balance')
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                @endif
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Reducing Balance</div>
                                <div class="text-xs text-gray-500">Most Common</div>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border border-gray-300 rounded cursor-pointer hover:border-green-500 transition-colors {{ $amortization_method === 'flat_rate' ? 'border-green-500 bg-green-50' : '' }}">
                            <input type="radio" wire:model="amortization_method" value="flat_rate" class="sr-only">
                            <div class="w-4 h-4 border-2 border-gray-400 rounded-full mr-3 flex items-center justify-center {{ $amortization_method === 'flat_rate' ? 'border-green-500' : '' }}">
                                @if($amortization_method === 'flat_rate')
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                @endif
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Flat Rate</div>
                                <div class="text-xs text-gray-500">Fixed Interest</div>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border border-gray-300 rounded cursor-pointer hover:border-green-500 transition-colors {{ $amortization_method === 'compound' ? 'border-green-500 bg-green-50' : '' }}">
                            <input type="radio" wire:model="amortization_method" value="compound" class="sr-only">
                            <div class="w-4 h-4 border-2 border-gray-400 rounded-full mr-3 flex items-center justify-center {{ $amortization_method === 'compound' ? 'border-green-500' : '' }}">
                                @if($amortization_method === 'compound')
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                @endif
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Compound</div>
                                <div class="text-xs text-gray-500">Compounding</div>
                            </div>
                        </label>
                    </div>

                    <!-- Method Explanation -->
                    <div class="mt-3 p-3 bg-gray-50 rounded text-xs text-gray-600">
                        @if($amortization_method === 'reducing_balance')
                            <strong>Reducing Balance:</strong> Interest is calculated on the remaining loan balance. As you pay down the principal, the interest amount decreases over time. This is the most common method used by banks.
                        @elseif($amortization_method === 'flat_rate')
                            <strong>Flat Rate:</strong> Interest is calculated on the original loan amount throughout the entire loan period. The interest amount remains the same for all payments.
                        @elseif($amortization_method === 'compound')
                            <strong>Compound Interest:</strong> Interest is calculated on both the principal and previously accumulated interest. This typically results in higher total payments.
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Action Buttons and Summary -->
        <div class="lg:col-span-1">
            <!-- Action Buttons -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 sticky top-4 mb-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>

                <div class="space-y-2">
                    <button wire:click="calculateLoan"
                            class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition-colors">
                        Calculate
                    </button>

                    <button wire:click="generateSchedule"
                            class="w-full border border-green-600 text-green-600 py-2 px-4 rounded hover:bg-green-50 transition-colors">
                        Generate Schedule
                    </button>

                    @if($show_schedule && count($amortization_schedule) > 0)
                        <button wire:click="exportSchedule"
                                class="w-full border border-green-600 text-green-600 py-2 px-4 rounded hover:bg-green-50 transition-colors">
                            Export Schedule
                        </button>

                        <button wire:click="hideSchedule"
                                class="w-full border border-gray-600 text-gray-600 py-2 px-4 rounded hover:bg-gray-50 transition-colors">
                            Hide Schedule
                        </button>
                    @endif

                    <button wire:click="resetCalculator"
                            class="w-full border border-gray-300 text-gray-600 py-2 px-4 rounded hover:bg-gray-50 transition-colors">
                        Reset
                    </button>
                </div>
            </div>

            <!-- Loan Summary - Only show when calculated -->
            @if($show_summary)
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Loan Summary</h2>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Loan Amount:</span>
                        <span class="text-sm font-medium">{{ number_format($loan_amount) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Fixed Repayment Amount:</span>
                        <span class="text-sm font-medium text-green-600">{{ number_format($fixed_repayment_amount, 2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Total Interest:</span>
                        <span class="text-sm font-medium">{{ number_format($total_interest, 2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Other Charges:</span>
                        <span class="text-sm font-medium">{{ number_format($other_charges + $additional_charges, 2) }}</span>
                    </div>

                    <div class="flex justify-between border-t pt-3">
                        <span class="text-sm font-medium text-gray-600">Total Payments:</span>
                        <span class="text-sm font-bold text-green-600">{{ number_format($total_payments, 2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Payoff Date:</span>
                        <span class="text-sm font-medium">{{ $payoff_date }}</span>
                    </div>

                    <!-- Calculation Method Display -->
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Method:</span>
                        <span class="text-sm font-medium">
                            @if($amortization_method === 'reducing_balance')
                                Reducing Balance
                            @elseif($amortization_method === 'flat_rate')
                                Flat Rate
                            @elseif($amortization_method === 'compound')
                                Compound Interest
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Amortization Schedule - Only show when requested -->
    @if($show_schedule)
    <div class="mt-8 bg-white border border-gray-200 rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Amortization Schedule</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">INSTALLMENT</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PAYMENT DATE</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PRINCIPAL</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">INTEREST</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PAYMENT</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($amortization_schedule as $index => $payment)
                        <tr class="border-b border-gray-100 {{ $index === 0 ? 'bg-green-50' : 'hover:bg-gray-50' }}">
                            <td class="px-4 py-3 text-sm">{{ $payment['installment'] }}</td>
                            <td class="px-4 py-3 text-sm">{{ $payment['payment_date'] }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ $payment['principal'] > 0 ? number_format($payment['principal'], 2) : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $payment['interest'] > 0 ? number_format($payment['interest'], 2) : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">
                                {{ $payment['payment'] > 0 ? number_format($payment['payment'], 2) : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">{{ number_format($payment['balance'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                Click "Generate Schedule" to view payment details
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                @if(count($amortization_schedule) > 1)
                <tfoot class="bg-gray-50 border-t-2 border-gray-200">
                    <tr class="font-medium">
                        <td class="px-4 py-3 text-sm">**TOTALS</td>
                        <td class="px-4 py-3 text-sm">-</td>
                        <td class="px-4 py-3 text-sm">
                            {{ number_format(collect($amortization_schedule)->where('installment', '>', 0)->sum('principal'), 2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ number_format(collect($amortization_schedule)->where('installment', '>', 0)->sum('interest'), 2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ number_format(collect($amortization_schedule)->where('installment', '>', 0)->sum('payment'), 2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">**</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
    @endif

    <!-- Disclaimer -->
    <div class="mt-8 border border-gray-200 rounded-lg p-6">
        <h3 class="text-sm font-semibold text-gray-900 mb-2">**DISCLAIMER**</h3>
        <p class="text-sm text-gray-600">
            The loan calculator is provided for informational purposes only and does not constitute financial advice, a loan offer, or approval. Please consult your financial institution or advisor for personalized guidance.
        </p>
    </div>
</div>

<script>
    // Livewire event listeners
    document.addEventListener('livewire:load', function () {
        console.log('Loan calculator loaded');

        // Listen for download-schedule event
        Livewire.on('download-schedule', function(schedule) {
            const csvContent = convertToCSV(schedule);
            downloadCSV(csvContent, 'loan-schedule-' + new Date().toISOString().split('T')[0] + '.csv');
        });
    });

    document.addEventListener('livewire:update', function () {
        console.log('Loan calculator updated');
    });

    function convertToCSV(schedule) {
        const headers = ['Installment', 'Payment Date', 'Principal', 'Interest', 'Payment', 'Balance'];
        const csvRows = [
            'Loan Payment Schedule',
            'Generated: ' + new Date().toLocaleDateString(),
            '',
            headers.join(',')
        ];

        schedule.forEach(payment => {
            const row = [
                payment.installment,
                payment.payment_date,
                payment.principal || '0',
                payment.interest || '0',
                payment.payment || '0',
                payment.balance
            ];
            csvRows.push(row.join(','));
        });

        const totalPrincipal = schedule.filter(p => p.installment > 0).reduce((sum, p) => sum + (p.principal || 0), 0);
        const totalInterest = schedule.filter(p => p.installment > 0).reduce((sum, p) => sum + (p.interest || 0), 0);
        const totalPayments = schedule.filter(p => p.installment > 0).reduce((sum, p) => sum + (p.payment || 0), 0);

        csvRows.push('');
        csvRows.push(['TOTALS', '', totalPrincipal.toFixed(2), totalInterest.toFixed(2), totalPayments.toFixed(2), ''].join(','));

        return csvRows.join('\n');
    }

    function downloadCSV(csvContent, filename) {
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }
</script>

<style>
    input:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
    }

    @media print {
        .no-print { display: none !important; }
        body { font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 4px; }
        th { background-color: #f0f0f0; }
    }
</style>

</div>
