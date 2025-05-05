<?php

namespace App\Http\Livewire\Web;

use App\Models\Loan_sub_products;
use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Lender;
use App\Models\LoanProduct;
use App\Models\Region;
use App\Models\District;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmploymentVerification;
class LoanApplication extends Component
{


    public $vehicle;
    public $lender;
    public $regions;
    public $districts = [];
    public $loanProducts = [];
    
    // Form inputs
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $national_id;
    public $region;
    public $district;
    public $street;
    public $employer_name;
    public $hrEmail;
    public $is_employee = false;
    public $employee_id;

    public $downPaymentPercent;
    public $monthly_income;
    public $purchase_price;
    public $down_payment = 0;
    public $loan_amount;
    public $loanProductId;
    public $terms = false;
    
    // Calculated values
    public $estimated_payment = null;
    
    protected $rules = [
        'first_name' => 'required|string|max:50',
        'middle_name' => 'nullable|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email|max:100',
        'phone_number' => 'required|string|max:20',
        'national_id' => 'required|string|max:50',
        'region' => 'required',
        'district' => 'required',
        'street' => 'required|string|max:100',
        'employer_name' => 'required|string|max:100',
        'hrEmail' => 'required|email|max:100',
        'is_employee' => 'boolean',
        'employee_id' => 'required_if:is_employee,true|nullable|string|max:50',
        'monthly_income' => 'required|numeric|min:100000',
        'down_payment' => 'required|numeric|min:0',
        'loanProductId' => 'required',
        'terms' => 'accepted',
    ];
    
    public function mount($vehicleId ,$lenderid )
    {

     
        $vehicle_id=$vehicleId;
        
         $lender_id=$lenderid;
        $this->vehicle = Vehicle::findOrFail($vehicle_id);


      
        $this->lender = Lender::findOrFail($lender_id);
        $this->regions = Region::all();
        $this->loanProducts = Loan_sub_products::where('institution_id', $this->lender->id)->get();
        
        // Pre-fill values
        if (Auth::check()) {
            $user = Auth::user();
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->phone_number = $user->phone_number;
        }
        
        $this->purchase_price = $this->vehicle->price;
        $this->calculateLoanAmount();
    }
    
    // When region changes, update districts
    public function updatedRegion()
    {
       // $this->districts = District::where('region_id', $this->region)->get();
    }
    
    // When down payment changes, recalculate loan amount
    public function updatedDownPayment()
    {
        $this->calculateLoanAmount();
    }
    
    // When loan product changes, calculate estimated payment
    public function updatedLoanProductId()
    {
        $this->calculateEstimatedPayment();
    }
    
    protected function calculateLoanAmount()
    {
        // Validate down payment is a number
        if (!is_numeric($this->down_payment)) {
            $this->down_payment = 0;
        }
        
        // Calculate loan amount
        $this->loan_amount = $this->purchase_price - $this->down_payment;
        
        // Recalculate estimated payment if loan product is selected
        if ($this->loanProductId) {
            $this->calculateEstimatedPayment();
        }
    }
    
    protected function calculateEstimatedPayment()
    {
        if (!$this->loanProductId || !$this->loan_amount) {
            $this->estimated_payment = null;
            return;
        }
        
        $loanProduct = LoanProduct::find($this->loanProductId);
        if (!$loanProduct) {
            $this->estimated_payment = null;
            return;
        }
        
        // Calculate monthly payment using the loan formula
        $principal = $this->loan_amount;
        $rate = $loanProduct->interest_rate / 100 / 12; // Monthly interest rate
        $term = $loanProduct->term; // Months
        
        // Formula: PMT = P * (r * (1+r)^n) / ((1+r)^n - 1)
        if ($rate == 0) {
            $this->estimated_payment = ($term == 0) ? $principal : $principal / $term;
        } else {
            $this->estimated_payment = $principal * ($rate * pow(1 + $rate, $term)) / (pow(1 + $rate, $term) - 1);
        }
        
        // Round to 2 decimal places
        $this->estimated_payment = round($this->estimated_payment, 2);
    }
    
    public function submitApplication()
    {
      //  $this->validate();
        
        // Create application record
        $application = new Application();
        $application->first_name = $this->first_name;
        $application->middle_name = $this->middle_name;
        $application->last_name = $this->last_name;
        $application->phone_number = $this->phone_number;
        $application->national_id = $this->national_id;
        $application->region = $this->region;
        $application->district =$this->district;
        $application->street = $this->street;
        $application->email = $this->email;
        $application->application_status = 'pending';
        $application->make_and_model = 'toyota'; // $this->vehicle->make . ' ' . $this->vehicle->model;
        $application->year_of_manufacture = $this->vehicle->year;
        $application->vin = $this->vehicle->vin;
        $application->color = $this->vehicle->color;
        $application->mileage = $this->vehicle->mileage;
        $application->purchase_price = $this->purchase_price;
        $application->down_payment = $this->down_payment;
        $application->loan_id = $this->loanProductId;
        $application->loan_amount = $this->loan_amount;
        $application->loanProductId = $this->loanProductId;
        $application->is_employee = $this->is_employee;
        $application->employee_id = $this->employee_id;
        $application->monthly_income = $this->monthly_income;
        $application->employer_name = $this->employer_name;
        $application->lender_id = $this->lender->id;
        $application->hrEmail = $this->hrEmail;
        $application->employer_verification_sent = false;
        $application->employer_verified = false;
        $application->employer_verification_status = 'pending';
        $application->client_id=auth()->user()->id;
        
        // Save the application
        $application->save();
        
        // Send employment verification email
        try {
          //  Mail::to($this->hrEmail)->send(new EmploymentVerification($application));
            
            // Update application status
            // $application->employer_verification_sent = true;
            // $application->employer_verification_sent_at = now();
            // $application->save();
        } catch (\Exception $e) {
            // Log email sending failure
            \Log::error('Failed to send employment verification email: ' . $e->getMessage());
        }

        session()->flash('success', 'Your loan application has been submitted successfully.!');

        
        // Redirect to application confirmation page
     //   return redirect()->route('loan.application.confirmation', $application->id)
       //     ->with('success', 'Your loan application has been submitted successfully.');
    }
    
    public function render()
    {
        return view('livewire.web.loan-application', [
            'vehicle' => $this->vehicle,
            'lender' => $this->lender,
            'regions' => $this->regions,
            'districts' => $this->districts,
            'loanProducts' => $this->loanProducts,
        ]);
    }


}
