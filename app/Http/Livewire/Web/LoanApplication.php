<?php

namespace App\Http\Livewire\Web;

use App\Models\LenderFinancingCriteria;
use App\Models\Loan_sub_products;
use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Lender;
use App\Models\LoanProduct;
use App\Models\Region;
use App\Models\District;
use App\Models\Application;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmploymentVerification;
use Livewire\WithFileUploads;

class LoanApplication extends Component
{
    use WithFileUploads;

    public $vehicle;
    public $lender;
    public $regions;
    public $districts = [];
    public $loanProducts = [];
    
    // Form inputs
    public $first_name;
    public $index=1;
    public $middle_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $national_id;
    public $region;
    public $district;
    public $street;
    
    // Employment Status
    public $is_employed = null;
    
    // Employment Information - only required if employed
    public $employer_name;
    public $hrEmail;
    public $is_employee = false;
    public $employee_id;
    public $monthly_income;
    
    // Loan Details
    public $downPaymentPercent;
    public $purchase_price;
    public $down_payment = 0;
    public $loan_amount;
    public $loanProductId;
    public $tenure;
    public $terms = false;
    
    // Calculated values
    public $estimated_payment = null;
    public $interest_rate = 0;
    public $paymentOptions = [];
    
    // File uploads
    public $id_document;
    public $bank_statement;
    public $payslip;
    public $application_document;

    protected function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|string|max:20',
            'national_id' => ['required', 'regex:/^\d{8}-\d{5}-\d{5}-\d{2}$/'],
            'region' => 'required',
            'district' => 'required',
            'street' => 'required|string|max:100',
            'is_employed' => 'required|boolean',
            'down_payment' => 'required|numeric|min:0',
            'tenure' => 'required',
            'terms' => 'accepted',
            'id_document' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
            'bank_statement' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf',
        ];

        // Only add employment validation rules if the user is employed
        if ($this->is_employed) {
            $rules['employer_name'] = 'required|string|max:100';
            $rules['hrEmail'] = 'required|email|max:100';
            $rules['monthly_income'] = 'required|numeric|min:100000';
            $rules['payslip'] = 'required|file|max:2048|mimes:jpg,jpeg,png,pdf';
            
            // Only required if the person is a government employee
            if ($this->is_employee) {
                $rules['employee_id'] = 'required|string|max:50';
            }
        }
        
        // Application document is optional
        $rules['application_document'] = 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,docx';

        return $rules;
    }

    public function getLoanTeam($lender)
    {
        // Assuming loan_terms_range is a string like "1-32"
        $range = $lender->loan_terms_range;
    
        // Split the string by the dash
        [$start, $end] = explode('-', $range);
    
        // Convert to integers
        $start = (int) $start;
        $end = (int) $end;
    
        // Create the range array
        $terms = range($start, $end);
    
        return $terms;
    }

    public function mount($vehicleId=null, $lenderId=null)
    {

        
        $vehicle_id = $vehicleId;
        $lender_id = $lenderId;


        
        $this->vehicle = Vehicle::findOrFail($vehicle_id);
        $this->lender = Lender::findOrFail($lender_id);
        $this->loanProducts = $this->getLoanTeam($this->lender);


       // dd($this->vehicle->make_id, $this->vehicle->model_id, $lender_id);

        $criteria = LenderFinancingCriteria::where('lender_id', $lender_id)
                                    ->where('make_id', $this->vehicle->make_id)
                                    ->where('model_id', $this->vehicle->model_id)
                                    ->first();
                                    
        $this->downPaymentPercent = $criteria->min_down_payment_percent ?? 0;
        
        // Get interest rate from criteria
        if ($criteria) {
            $this->interest_rate = $criteria->min_interest_rate ?? $criteria->max_interest_rate ?? 0;
        } else {
            // Fallback to lender's general interest rate range
            $lender = $this->lender;
            if ($lender) {
                // Parse the interest rate range (e.g., "12-15%")
                $range = $lender->interest_rate_range ?? '0-0';
                $rates = explode('-', str_replace('%', '', $range));
                $this->interest_rate = isset($rates[0]) ? (float)$rates[0] : 0;
            }
        }

        $this->regions = Region::all();


        $this->down_payment = $this->downPaymentPercent / 100 * $this->vehicle->price;
        
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
        
        // Calculate initial payment options
        if ($this->loan_amount && $this->interest_rate) {
            $this->calculatePaymentOptions();
        }
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
    
    // When tenure changes, calculate estimated payment
    public function updatedTenure()
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
        
        // Recalculate payment options
        if ($this->interest_rate) {
            $this->calculatePaymentOptions();
        }
    }
    
    protected function calculateEstimatedPayment()
    {
        if (!$this->tenure || !$this->loan_amount || !$this->interest_rate) {
            $this->estimated_payment = null;
            return;
        }
        
        // Calculate monthly payment using the loan formula
        $principal = $this->loan_amount;
        $rate = $this->interest_rate / 100 / 12; // Monthly interest rate
        $term = $this->tenure; // Months
        
        // Formula: PMT = P * (r * (1+r)^n) / ((1+r)^n - 1)
        if ($rate == 0) {
            $this->estimated_payment = ($term == 0) ? $principal : $principal / $term;
        } else {
            $this->estimated_payment = $principal * ($rate * pow(1 + $rate, $term)) / (pow(1 + $rate, $term) - 1);
        }
        
        // Round to 2 decimal places
        $this->estimated_payment = round($this->estimated_payment, 2);
        
        // Calculate payment options for different terms
        $this->calculatePaymentOptions();
    }
    
    protected function calculatePaymentOptions()
    {
        if (!$this->loan_amount || !$this->interest_rate) {
            $this->paymentOptions = [];
            return;
        }
        
        $principal = $this->loan_amount;
        $rate = $this->interest_rate / 100 / 12; // Monthly interest rate
        $this->paymentOptions = [];
        
        // Calculate for each available loan term
        foreach ($this->loanProducts as $term) {
            if ($rate == 0) {
                $monthlyPayment = ($term == 0) ? $principal : $principal / $term;
            } else {
                $monthlyPayment = $principal * ($rate * pow(1 + $rate, $term)) / (pow(1 + $rate, $term) - 1);
            }
            
            $totalPayment = $monthlyPayment * $term;
            $totalInterest = $totalPayment - $principal;
            
            $this->paymentOptions[] = [
                'term' => $term,
                'monthly_payment' => round($monthlyPayment, 2),
                'total_payment' => round($totalPayment, 2),
                'total_interest' => round($totalInterest, 2),
                'is_selected' => $term == $this->tenure
            ];
        }
    }
    
    /**
     * Save file attachments
     */
    public function saveAttachment($loan_id, $type, $file)
    {
        try {
            // Define allowed file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
    
            // Generate a unique reference number
            $referenceNumber = time();
    
            // Get file extension
            $extension = strtolower($file->getClientOriginalExtension());
    
            // Check if the extension is allowed
            if (!in_array($extension, $allowedExtensions)) {
                throw new \Exception("Unsupported file type: .$extension");
            }
    
            // Generate a unique filename
            $filename = uniqid() . '.' . $extension;
    
            // Store the file in public storage under assets/attachment
            $storedPath = $file->storeAs('assets/attachment', $filename, 'public');
    
            // Save to database
            Attachment::create([
                'url' => $storedPath,
                'loan_id' => $loan_id,
                'type' => $type,
            ]);
            
            return true;
        } catch (\Exception $e) {
            // Log error
            \Log::error('File upload error: ' . $e->getMessage());
            return false;
        }
    }
    
    public function submitApplication()
    {
        $this->validate();
        
        // Create application record
        $application = new Application();
        $application->first_name = $this->first_name;
        $application->middle_name = $this->middle_name;
        $application->last_name = $this->last_name;
        $application->phone_number = $this->phone_number;
        $application->national_id = $this->national_id;
        $application->region = $this->region;
        $application->district = $this->district;
        $application->street = $this->street;
        $application->email = $this->email;
        $application->application_status = 'pending';
        $application->make_and_model = optional($this->vehicle->make)->name . ' ' . optional($this->vehicle->model)->name;
        $application->year_of_manufacture = $this->vehicle->year;
        $application->vin = $this->vehicle->vin;
        $application->color = $this->vehicle->color;
        $application->mileage = $this->vehicle->mileage;
        $application->purchase_price = $this->purchase_price;
        $application->down_payment = $this->down_payment;
        $application->loan_amount = $this->loan_amount;
        $application->loanProductId = $this->loanProductId;
        $application->tenure = $this->tenure;
        $application->lender_id = $this->lender->id;
        $application->client_id = auth()->user()->id;
        $application->car_dealer_id = $this->vehicle->dealer_id;
        $application->stage_name='car_dealer';
        $application->vehicle_id=$this->vehicle->id;
        
        // Only set employment related fields if employed
        if ($this->is_employed) {
           $application->is_employee =$this->is_employed;
            $application->employer_name = $this->employer_name;
            $application->hrEmail = $this->hrEmail;
            $application->monthly_income = $this->monthly_income;
          // $application->is_employee = $this->is_employee;
            $application->employee_id = $this->employee_id;
            $application->employer_verification_sent = false;
            $application->employer_verified = false;
            $application->employer_verification_status = 'pending';
        } else {
            $application->is_employee =false;
        }
        
        // Save the application
        $application->save();
        
        // Upload and save attachments
        if ($this->id_document) {
            $this->saveAttachment($application->id, 'id_document', $this->id_document);
        }
        
        if ($this->bank_statement) {
            $this->saveAttachment($application->id, 'bank_statement', $this->bank_statement);
        }
        
        // Conditionally upload payslip if employed
        if ($this->is_employed && $this->payslip) {
            $this->saveAttachment($application->id, 'payslip', $this->payslip);
        }
        
        // Optional application document
        if ($this->application_document) {
            $this->saveAttachment($application->id, 'application_document', $this->application_document);
        }
        
        // Send employment verification email if employed
        if ($this->is_employed) {
            try {
               // Mail::to($this->hrEmail)->send(new EmploymentVerification($application));
                
                // Update application status
               // $application->employer_verification_sent = true;
              //  $application->employer_verification_sent_at = now();
               // $application->save();
            } catch (\Exception $e) {
                // Log email sending failure
                \Log::error('Failed to send employment verification email: ' . $e->getMessage());
            }
        }

        session()->flash('success', 'Your loan application has been submitted successfully!');

        return redirect()->route('application.list');
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