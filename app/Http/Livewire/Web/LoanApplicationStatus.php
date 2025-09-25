<?php

namespace App\Http\Livewire\Web;

use App\Models\LenderFinancingCriteria;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Application;
use App\Models\LoanProduct;
use Illuminate\Support\Facades\Auth;

class LoanApplicationStatus extends Component
{

    public $application;
    public $loanProduct;
    public $monthlyPayment;
    public $interest_rate;
    
    public function mount($id)
    {
        $application_id = $id;
        $this->application = Application::findOrFail($application_id);
        
        // Get the vehicle to determine make and model
        $vehicle = Vehicle::find($this->application->vehicle_id);
        
        if ($vehicle) {
            // Get interest rate from LenderFinancingCriteria
            $criteria = LenderFinancingCriteria::where('lender_id', $this->application->lender_id)
                ->where('make_id', $vehicle->make_id)
                ->where('model_id', $vehicle->model_id)
                ->first();
                
            if ($criteria) {
                // Use the interest rate from criteria, or default to lender's range
                $this->interest_rate = $criteria->min_interest_rate ?? $criteria->max_interest_rate ?? 0;
            } else {
                // Fallback to lender's general interest rate range
                $lender = $this->application->lender;
                if ($lender) {
                    // Parse the interest rate range (e.g., "12-15%")
                    $range = $lender->interest_rate_range ?? '0-0';
                    $rates = explode('-', str_replace('%', '', $range));
                    $this->interest_rate = isset($rates[0]) ? (float)$rates[0] : 0;
                }
            }
        }
        
        // Calculate monthly payment
        $this->calculateMonthlyPayment();
    }
    
    /**
     * Calculate the monthly loan payment
     *
     * @return void
     */
    private function calculateMonthlyPayment()
    {
        if (!$this->application || !$this->interest_rate) {
            $this->monthlyPayment = 0;
            return;
        }
        
        $principal = $this->application->loan_amount;
        $rate = $this->interest_rate / 100 / 12; // Monthly interest rate
        $term = $this->application->tenure; // Months
        
        // Formula: PMT = P * (r * (1+r)^n) / ((1+r)^n - 1)
        if ($rate == 0) {
            $this->monthlyPayment = ($term == 0) ? $principal : $principal / $term;
        } else {
            $this->monthlyPayment = $principal * ($rate * pow(1 + $rate, $term)) / (pow(1 + $rate, $term) - 1);
        }
        
        // Round to 2 decimal places
        $this->monthlyPayment = round($this->monthlyPayment, 2);
    }
    
    public function render()
    {
        return view('livewire.web.loan-application-status', [
            'application' => $this->application,
            'monthlyPayment' => $this->monthlyPayment,
            'interest_rate' => $this->interest_rate,
        ]);
    }



}
