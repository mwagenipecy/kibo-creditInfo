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
        // Get the applica
        // tion

        $application_id=$id;
        $this->application = Application::
        //with('lender')
            findOrFail($application_id);
        
        // Check if this application belongs to the current user
        // if (Auth::user()->email !== $this->application->email) {
        //     abort(403, 'You do not have permission to view this application.');
        // }
        
        // Get the loan product
        // $this->loanProduct = LoanProduct::find($this->application->loanProductId);
        
        // $vehicleId=$this->application->vehicle_id;


        // dd(  $this->application);

        // // get model and make
        // $vehicle = Vehicle::findOrFail($vehicleId);
        // // get interest rate
        // $this->interest_rate= LenderFinancingCriteria::where('lender_id', $this->application->lender_id)
        //     ->where('make_id', $vehicle->make_id)
        //     ->where('model_id', $vehicle->model_id)
        //     ->value('interest_rate');

        // Calculate monthly payment
        // $this->calculateMonthlyPayment();
    }
    
    /**
     * Calculate the monthly loan payment
     *
     * @return void
     */
    private function calculateMonthlyPayment()
    {
        if (!$this->loanProduct) {
            $this->monthlyPayment = 0;
            return;
        }
        
        $principal = $this->application->loan_amount;
        $rate = $this->loanProduct->interest_rate / 100 / 12; // Monthly interest rate
        $term = $this->loanProduct->term; // Months
        
        // Formula: PMT = P * (r * (1+r)^n) / ((1+r)^n - 1)
        if ($rate == 0) {
           // $this->monthlyPayment = $principal / $term;
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
            'loanProduct' => [],
            'monthlyPayment' =>[],
        ]);
    }



}
