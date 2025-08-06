<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class LoanCalculator extends Component
{
    // General Loan Details
    public $loan_type = 'vehicle_loan';
    public $loan_amount = 7000000; // TSH 7M default
    public $loan_date;
    public $repayment_start_date;
    public $repayment_frequency = 'monthly';
    public $other_charges = 0;
    public $additional_charges = 0;
    
    // Interest Details
    public $interest_percentage = 12; // Annual percentage rate
    public $duration_months = 12; // Duration in months
    public $amortization_method = 'reducing_balance'; // Amortization calculation method
    
    // Display Control
    public $show_summary = false;
    public $show_schedule = false;
    
    // Calculated Results
    public $fixed_repayment_amount = 0;
    public $total_interest = 0;
    public $total_payments = 0;
    public $payoff_date = '';
    public $amortization_schedule = [];
    
    // Loan Types
    public $loan_types = [
        'vehicle_loan' => 'Vehicle Loan',
        'personal_loan' => 'Personal Loan',
        'business_loan' => 'Business Loan',
        'mortgage_loan' => 'Mortgage Loan',
        'asset_financing' => 'Asset Financing',
    ];
    
    // Repayment Frequencies
    public $repayment_frequencies = [
        'weekly' => 'Weekly',
        'bi_weekly' => 'Bi-Weekly',
        'monthly' => 'Monthly',
        'quarterly' => 'Quarterly',
        'semi_annual' => 'Semi-Annual',
        'annual' => 'Annual',
    ];

    protected $rules = [
        'loan_type' => 'required|string',
        'loan_amount' => 'required|numeric|min:100000|max:1000000000',
        'loan_date' => 'required|date',
        'repayment_start_date' => 'required|date|after_or_equal:loan_date',
        'repayment_frequency' => 'required|string',
        'other_charges' => 'numeric|min:0',
        'additional_charges' => 'numeric|min:0',
        'interest_percentage' => 'required|numeric|min:0|max:50',
        'duration_months' => 'required|numeric|min:1|max:600',
    ];

    public function mount()
    {
        $this->loan_date = Carbon::now()->format('Y-m-d');
        $this->repayment_start_date = Carbon::now()->addMonth()->format('Y-m-d');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
        // Auto-adjust repayment start date if loan date changes
        if ($propertyName === 'loan_date') {
            $this->repayment_start_date = Carbon::parse($this->loan_date)->addMonth()->format('Y-m-d');
        }
    }

    public function calculateLoan()
    {
        try {
            $this->validate();
            
            // Get payment frequency multiplier
            $payments_per_year = $this->getPaymentsPerYear();
            $total_payments = $this->duration_months * ($payments_per_year / 12);
            
            // Calculate periodic interest rate
            $periodic_rate = ($this->interest_percentage / 100) / $payments_per_year;
            
            // Calculate based on amortization method
            switch ($this->amortization_method) {
                case 'reducing_balance':
                    $this->calculateReducingBalance($periodic_rate, $total_payments);
                    break;
                case 'flat_rate':
                    $this->calculateFlatRate($total_payments);
                    break;
                case 'compound':
                    $this->calculateCompoundInterest($periodic_rate, $total_payments);
                    break;
            }
            
            // Calculate totals
            $total_other_charges = $this->other_charges + $this->additional_charges;
            $this->total_payments = ($this->fixed_repayment_amount * $total_payments) + $total_other_charges;
            $this->total_interest = $this->total_payments - $this->loan_amount - $total_other_charges;
            
            // Calculate payoff date
            $this->calculatePayoffDate();
            
            // Show summary after calculation
            $this->show_summary = true;
            
            session()->flash('message', 'Loan calculation completed successfully!');
            
        } catch (\Exception $e) {
            // Handle validation errors gracefully
            $this->fixed_repayment_amount = 0;
            $this->total_interest = 0;
            $this->total_payments = 0;
            $this->amortization_schedule = [];
            $this->show_summary = false;
            
            session()->flash('error', 'Please check your input values and try again.');
        }
    }

    private function calculateReducingBalance($periodic_rate, $total_payments)
    {
        // Calculate fixed repayment amount using PMT formula
        if ($periodic_rate > 0) {
            $this->fixed_repayment_amount = $this->loan_amount * 
                ($periodic_rate * pow(1 + $periodic_rate, $total_payments)) / 
                (pow(1 + $periodic_rate, $total_payments) - 1);
        } else {
            $this->fixed_repayment_amount = $this->loan_amount / $total_payments;
        }
    }

    private function calculateFlatRate($total_payments)
    {
        $this->total_interest = ($this->loan_amount * $this->interest_percentage * $this->duration_months) / (100 * 12);
        $this->fixed_repayment_amount = ($this->loan_amount + $this->total_interest) / $total_payments;
    }

    private function calculateCompoundInterest($periodic_rate, $total_payments)
    {
        $compound_amount = $this->loan_amount * pow(1 + $periodic_rate, $total_payments);
        $this->total_interest = $compound_amount - $this->loan_amount;
        $this->fixed_repayment_amount = $compound_amount / $total_payments;
    }

    public function generateSchedule()
    {
        // First calculate if not already done
        if (!$this->show_summary) {
            $this->calculateLoan();
        }
        
        $this->show_schedule = true;
        $this->generateAmortizationSchedule();
        
        session()->flash('message', 'Amortization schedule generated successfully!');
    }

    public function hideSchedule()
    {
        $this->show_schedule = false;
        $this->amortization_schedule = [];
    }

    private function getPaymentsPerYear()
    {
        switch ($this->repayment_frequency) {
            case 'weekly':
                return 52;
            case 'bi_weekly':
                return 26;
            case 'monthly':
                return 12;
            case 'quarterly':
                return 4;
            case 'semi_annual':
                return 2;
            case 'annual':
                return 1;
            default:
                return 12;
        }
    }

    private function calculatePayoffDate()
    {
        $start_date = Carbon::parse($this->repayment_start_date);
        $payments_per_year = $this->getPaymentsPerYear();
        $total_payments = $this->duration_months * ($payments_per_year / 12);
        
        switch ($this->repayment_frequency) {
            case 'weekly':
                $payoff = $start_date->addWeeks($total_payments - 1);
                break;
            case 'bi_weekly':
                $payoff = $start_date->addWeeks(($total_payments - 1) * 2);
                break;
            case 'monthly':
                $payoff = $start_date->addMonths($total_payments - 1);
                break;
            case 'quarterly':
                $payoff = $start_date->addMonths(($total_payments - 1) * 3);
                break;
            case 'semi_annual':
                $payoff = $start_date->addMonths(($total_payments - 1) * 6);
                break;
            case 'annual':
                $payoff = $start_date->addYears($total_payments - 1);
                break;
            default:
                $payoff = $start_date->addMonths($total_payments - 1);
        }
        
        $this->payoff_date = $payoff->format('d-M-Y');
    }

    private function generateAmortizationSchedule()
    {
        $this->amortization_schedule = [];
        $remaining_balance = $this->loan_amount;
        $payments_per_year = $this->getPaymentsPerYear();
        $periodic_rate = ($this->interest_percentage / 100) / $payments_per_year;
        $total_payments = $this->duration_months * ($payments_per_year / 12);
        
        $current_date = Carbon::parse($this->repayment_start_date);
        
        // Add initial balance entry
        $this->amortization_schedule[] = [
            'installment' => 0,
            'payment_date' => Carbon::parse($this->loan_date)->format('d-M-Y'),
            'principal' => 0,
            'interest' => 0,
            'payment' => 0,
            'balance' => $remaining_balance,
        ];
        
        for ($payment_num = 1; $payment_num <= $total_payments; $payment_num++) {
            // Calculate based on amortization method
            if ($this->amortization_method === 'reducing_balance') {
                $interest_payment = $remaining_balance * $periodic_rate;
                $principal_payment = $this->fixed_repayment_amount - $interest_payment;
                $actual_payment = $this->fixed_repayment_amount;
            } elseif ($this->amortization_method === 'flat_rate') {
                $interest_payment = ($this->loan_amount * $this->interest_percentage) / (100 * 12);
                $principal_payment = ($this->loan_amount) / $total_payments;
                $actual_payment = $this->fixed_repayment_amount;
            } else { // compound
                $interest_payment = $remaining_balance * $periodic_rate;
                $principal_payment = $this->fixed_repayment_amount - $interest_payment;
                $actual_payment = $this->fixed_repayment_amount;
            }
            
            // Adjust for final payment to avoid rounding errors
            if ($payment_num == $total_payments) {
                $principal_payment = $remaining_balance;
                $actual_payment = $principal_payment + $interest_payment;
            }
            
            // Update remaining balance
            $remaining_balance -= $principal_payment;
            
            // Add to schedule
            $this->amortization_schedule[] = [
                'installment' => $payment_num,
                'payment_date' => $current_date->format('d-M-Y'),
                'principal' => round($principal_payment, 2),
                'interest' => round($interest_payment, 2),
                'payment' => round($actual_payment, 2),
                'balance' => round(max(0, $remaining_balance), 2),
            ];
            
            // Move to next payment date
            switch ($this->repayment_frequency) {
                case 'weekly':
                    $current_date->addWeek();
                    break;
                case 'bi_weekly':
                    $current_date->addWeeks(2);
                    break;
                case 'monthly':
                    $current_date->addMonth();
                    break;
                case 'quarterly':
                    $current_date->addMonths(3);
                    break;
                case 'semi_annual':
                    $current_date->addMonths(6);
                    break;
                case 'annual':
                    $current_date->addYear();
                    break;
            }
        }
    }

    public function exportSchedule()
    {
        if (empty($this->amortization_schedule)) {
            session()->flash('error', 'No schedule data available for export. Please generate schedule first.');
            return;
        }

        $csvContent = $this->generateCSVContent();
        
        // Trigger download via JavaScript
        $this->emit('download-schedule', $this->amortization_schedule);
        
        session()->flash('message', 'Schedule export initiated. Download should start automatically.');
    }

    private function generateCSVContent()
    {
        $headers = ['Installment', 'Payment Date', 'Principal', 'Interest', 'Payment', 'Balance'];
        $csvRows = [
            'Loan Payment Schedule',
            'Generated: ' . now()->format('Y-m-d H:i:s'),
            '',
            implode(',', $headers)
        ];
        
        foreach ($this->amortization_schedule as $payment) {
            $row = [
                $payment['installment'],
                $payment['payment_date'],
                $payment['principal'] ?: '0',
                $payment['interest'] ?: '0',
                $payment['payment'] ?: '0',
                $payment['balance']
            ];
            $csvRows[] = implode(',', $row);
        }

        // Add totals
        $totalPrincipal = collect($this->amortization_schedule)->where('installment', '>', 0)->sum('principal');
        $totalInterest = collect($this->amortization_schedule)->where('installment', '>', 0)->sum('interest');
        $totalPayments = collect($this->amortization_schedule)->where('installment', '>', 0)->sum('payment');
        
        $csvRows[] = '';
        $csvRows[] = implode(',', ['TOTALS', '', number_format($totalPrincipal, 2), number_format($totalInterest, 2), number_format($totalPayments, 2), '']);
        
        return implode("\n", $csvRows);
    }

    public function resetCalculator()
    {
        $this->reset([
            'loan_amount', 'interest_percentage', 'duration_months', 
            'other_charges', 'additional_charges', 'show_summary', 'show_schedule'
        ]);
        $this->loan_amount = 7000000;
        $this->interest_percentage = 12;
        $this->duration_months = 12;
        $this->loan_date = Carbon::now()->format('Y-m-d');
        $this->repayment_start_date = Carbon::now()->addMonth()->format('Y-m-d');
        $this->amortization_schedule = [];
        
        session()->flash('message', 'Calculator has been reset to default values.');
    }

    public function render()
    {
        return view('livewire.loan-calculator');
    }
}