<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\AccountsModel;
use App\Models\ClientsModel;
use App\Models\Employee;
use App\Models\general_ledger;
use App\Models\Lender;
use App\Models\LoanProduct;
use App\Models\loans_schedules;
use App\Exports\LoanRepayment;
use App\Mail\LoanProgress; 
use App\Models\LoansModel;
use App\Models\Image;
use App\Models\Teller;
use Carbon\Carbon;
use App\Http\Livewire\Document\StatementReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class FrontDesk extends Component
{
    use WithFileUploads;

    // Personal Information
    public $firstname;
    public $middlename;
    public $lastname;
    public $nidanumber;
    public $phonenumber;
    public $region;
    public $district,$applicationStep=0;
    public $ward;
    public $email;
    public $isEmployee = false;
    public $employeeId;
    public $employmentDate;
    public $employmentPosition;
    public $employerName;
    public $monthlyIncome;
    public $otherLoans = false;
    public $otherLoanDetails;
    
    // Application & Loan Info
    public $accountSelected;
    public $loanProduct = [];
    public $loanProductId;

    public $lenderList=[];
    public $loan_product;
    public $amount2;
    public $referenceNumber;

    // Car Details
    public $make_and_model;
    public $year_of_manufacture;
    public $vin;
    public $color;
    public $mileage;

    // Purchase Information
    public $purchase_price;
    public $down_payment;
    public $loan_amount;
    public $loan_term;

    // Vehicle Ownership
    public $currentVehicleOwner;
    public $dealerName;
    public $dealerContactInfo;
    
    // Loan Calculator Variables
    public $calculatorPrincipal = 0;
    public $calculatorInterestRate = 0;
    public $calculatorTenure = 12;
    public $calculatorInterestMethod = 'reducing';
    public $calculatorGracePeriod = 0;
    public $calculatorPaymentFrequency = 'monthly';
    public $calculatorStartDate;
    public $calculatorScheduleData = null;
    
    // Additional fields
    public $amount3,$hrEmail;
    public $lender;
    public $step = 1; // For multi-step form
    public $totalSteps = 4;

    // Image upload fields
    public $images = [];
    public $uploadedImages = [];
    public $imagePreviews = []; // Stores temporary image previews

    public $principal = 0;
public $interestRate = 0;
public $tenure = 12;
public $interestMethod = 'reducing';
public $startDate;
public $gracePeriod = 0;
public $paymentFrequency = 'monthly';
public $scheduleData = null;



// Add properties for application steps
public $activeTab = 'application';



    public function boot()
    {
      //  $this->loanProduct = LoanProduct::where('sub_product_status', 'active')->get();
        $this->calculatorStartDate = Carbon::today()->format('Y-m-d');
    }

    // Method to navigate through steps
    public function nextStep()
    {
        // Validate current step before proceeding
        $this->validateStep($this->step);
        
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }


    public function downloadRepaymentSchedule()
{
    // Check if schedule data exists
    if (!$this->scheduleData) {
        session()->flash('message_fail', 'No repayment schedule to download.');
        return;
    }

    try {
        // Create a filename with timestamp
        $filename = 'loan_repayment_schedule_' . time() . '.xlsx';
        
        // Use your existing export class if available
        return Excel::download(new LoanRepayment([$this->scheduleData]), $filename);
        
        // If you don't have an export class set up, you might want to create a simple one
        // or use a different download approach based on your application's setup
    } catch (\Exception $e) {
        session()->flash('message_fail', 'Failed to download repayment schedule: ' . $e->getMessage());
    }
}


    public function calculateSchedule()
{
    
    
    $this->validate([
        'calculatorPrincipal' => 'required|numeric|min:1',
        'calculatorInterestRate' => 'required|numeric|min:0',
        'calculatorTenure' => 'required|integer|min:1',
        'calculatorInterestMethod' => 'required|in:reducing,flat',
        'calculatorStartDate' => 'required|date',
        'calculatorGracePeriod' => 'integer|min:0',
        'calculatorPaymentFrequency' => 'required|in:monthly,daily,quarterly,semi_annual,annual',
    ]);
    
    // Map calculator variables to the ones used by your service
    $this->principal = $this->calculatorPrincipal;
    $this->interestRate = $this->calculatorInterestRate;
    $this->tenure = $this->calculatorTenure;
    $this->interestMethod = $this->calculatorInterestMethod;
    $this->startDate = $this->calculatorStartDate;
    $this->gracePeriod = $this->calculatorGracePeriod;
    $this->paymentFrequency = $this->calculatorPaymentFrequency;
    
    $service = new \App\Services\LoanScheduleService();
    $this->scheduleData = $service->generateLoanRepaymentSchedule(
        $this->principal,
        $this->interestRate,
        $this->tenure,
        $this->startDate,
        $this->interestMethod,
        $this->gracePeriod,
        $this->paymentFrequency
    );
    
    // Also assign to calculatorScheduleData for the template to use
    $this->calculatorScheduleData = $this->scheduleData;
}




public function nextApplicationStep()
{
   $this->validateStep($this->applicationStep+1);
    
    // Increment step
    $this->applicationStep++;
}

public function prevApplicationStep()
{
    // Decrement step but not below 0
    if ($this->applicationStep > 0) {
        $this->applicationStep--;
    }
}

private function validateApplicationStep()
{
    // Add your validation logic for each step
    // Similar to what I provided before
}



    public function validateStep($step)
    {

        
        switch ($step) {
            case 1: // Personal Information
                $this->validate([
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'nidanumber' => 'required|string|max:50',
                    'phonenumber' => 'required|string|max:20',
                    'region' => 'required|string|max:100',
                    'district' => 'required|string|max:100',
                    'email' => 'required|email|max:255',
                    // Optional validation for employee fields
                    'employeeId' => $this->isEmployee ? 'nullable|string' : 'nullable',
                    'employerName' => $this->isEmployee ? 'nullable|string' : 'nullable',
                    'monthlyIncome' => 'required|numeric|min:0',
                ]);



                break;
                
            case 2: // Vehicle Information
                $this->validate([
                    'make_and_model' => 'required|string|max:255',
                    'year_of_manufacture' => 'required|string|max:4',
                    'vin' => 'required|string|max:50',
                    'color' => 'required|string|max:50',
                    'mileage' => 'required|min:0',
                    'currentVehicleOwner' => 'required|string',
                ]);

            

                break;
                
            case 3: // Loan Information
                $this->validate([
                    'purchase_price' => 'required|numeric|min:0',
                    'down_payment' => 'required|numeric|min:0',
                    'loan_amount' => 'required|numeric|min:0',
                    'loanProductId' => 'required|exists:loan_sub_products,id',
                ]);
                
                break;
                
            case 4: // Document Upload
                $this->validate([
                    'images' => 'array',
                    'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                break;
        }
    }

    // Method to check if user is an employee
    public function updatedIsEmployee()
    {
        if (!$this->isEmployee) {
            $this->employeeId = null;
            $this->employmentDate = null;
            $this->employmentPosition = null;
            $this->employerName = null;
        }
    }

    // Loan calculator methods
    // public function calculateSchedule()
    // {
    //     $this->validate([
    //         'calculatorPrincipal' => 'required|numeric|min:1',
    //         'calculatorInterestRate' => 'required|numeric|min:0',
    //         'calculatorTenure' => 'required|integer|min:1',
    //         'calculatorInterestMethod' => 'required|in:reducing,flat',
    //         'calculatorStartDate' => 'required|date',
    //         'calculatorGracePeriod' => 'integer|min:0',
    //         'calculatorPaymentFrequency' => 'required|in:monthly,daily,quarterly,semi_annual,annual',
    //     ]);
        
    //     $service = new \App\Services\LoanScheduleService();
    //     $this->calculatorScheduleData = $service->generateLoanRepaymentSchedule(
    //         $this->calculatorPrincipal,
    //         $this->calculatorInterestRate,
    //         $this->calculatorTenure,
    //         $this->calculatorStartDate,
    //         $this->calculatorInterestMethod,
    //         $this->calculatorGracePeriod,
    //         $this->calculatorPaymentFrequency
    //     );
    // }

    // Method to copy calculator values to loan application
    public function useCalculatedValues()
    {
        if ($this->calculatorScheduleData) {
            $this->loan_amount = $this->calculatorPrincipal;
            $this->loan_term = $this->calculatorTenure;
            // Set loan product based on interest rate if possible
            foreach ($this->loanProduct as $product) {
                if ($product->interest_value == $this->calculatorInterestRate) {
                    $this->loanProductId = $product->id;
                    break;
                }
            }
            $this->step = 3; // Move to loan information step
        }
    }

    // Image upload methods
    public function updatedImages()
    {
        $this->imagePreviews = [];
        foreach ($this->images as $key => $image) {
            try {
                $this->imagePreviews[$key] = [
                    'url' => $image->temporaryUrl(),
                    'name' => $image->getClientOriginalName()
                ];
            } catch (\Exception $e) {
                // Handle the exception
            }
        }
    }

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1); // Remove the image from the array
        array_splice($this->imagePreviews, $index, 1); // Remove the corresponding preview
    }

    public function saveImages($loan_id)
    {
        $this->validate([
            'images.*' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048', // 2MB max
            ]
        ], [
            'images.*.max' => 'Each image must be less than 2MB.',
            'images.*.mimes' => 'Only JPEG, PNG, and JPG files are allowed.'
        ]);
    
        try {
            // Clear previous uploaded images
            $this->uploadedImages = [];
    
            // Generate a unique reference number
            $this->referenceNumber = time();
    
            foreach ($this->images as $image) {
                // Validate each image
                if (!$image->isValid()) {
                    throw new \Exception("Invalid file upload");
                }
    
                // Generate a unique filename
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
    
                // Define the storage path (using storage_path for better Laravel practices)
                $destinationPath = storage_path('app/public/assets/img/cars');
    
                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                // Store the image
                $storedPath = $image->storeAs('assets/img/cars', $filename, 'public');
    
                // Save to database
                $imageRecord = Image::create([
                    'url' => $storedPath,
                    'loan_id' => $loan_id,
                ]);
    
                // Store the path in the uploadedImages array
                $this->uploadedImages[] = $storedPath;
            }
    
            // Reset images after upload
            $this->images = [];
    
            // Flash success message
            session()->flash('success', 'Images uploaded successfully.');
    
            // Optional: return uploaded image IDs or paths
            return $this->uploadedImages;
    
        } catch (\Exception $e) {
            // Log the full error for debugging
            \Log::error('Image upload error: ' . $e->getMessage());
    
            // Flash error message
            session()->flash('error', 'An error occurred while uploading images: ' . $e->getMessage());
        }
    }
    

    // Main method to process loan application
    public function submitApplication()
    {

        
        // Validate all steps
        for ($i = 1; $i <= $this->totalSteps; $i++) {
           $this->validateStep($i);
        }

        // Create client record
        try{

   
        $clientId = ClientsModel::create([
            'first_name' => $this->firstname,
            'middle_name' => $this->middlename,
            'last_name' => $this->lastname,
            'phone_number' => $this->phonenumber,
            'national_id' => $this->nidanumber,
            'region' => $this->region,
            'district' => $this->district,
            'street' => $this->ward,
            'amount' => $this->loan_amount,
            'lender_id'=>auth()->user()->institution_id,

            'email' => $this->email,
            'is_employee' => $this->isEmployee,
            'employee_id' => $this->employeeId,
            'monthly_income' => $this->monthlyIncome,
            'employer_name' => $this->employerName,
            'client_status' => "NEW CLIENT"
        ])->id;

        // Create item record
        $itemId = DB::table('items')->insertGetId([
            'make_and_model' => $this->make_and_model,
            'year_of_manufacture' => $this->year_of_manufacture,
            'vin' => $this->vin,
            'color' => $this->color,
            'mileage' => $this->mileage,
            'purchase_price' => $this->purchase_price,
            'down_payment' => $this->down_payment,
            'current_owner' => $this->currentVehicleOwner,
            'dealer_name' => $this->dealerName,
            'lender_id'=>auth()->user()->institution_id,

            'dealer_contact' => $this->dealerContactInfo,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create loan record
        $loan_id = LoansModel::create([
            'principle' => $this->loan_amount,
            'client_id' => $clientId,
            'client_number' => DB::table('clients')->where('id', $clientId)->value('client_number'),
            'loan_sub_product' => $this->loan_product,
            'pay_method' => '',
            'bank' => '',
            'bank_account_number' => '',
            'LoanPhoneNo' => $this->phonenumber,
            'status' => 'NEW LOAN',
            'interest' => DB::table('loan_sub_products')->where('id', $this->loanProductId)->value('interest_value'),
            'tenure' => DB::table('loan_sub_products')->where('id', $this->loanProductId)->value('interest_tenure'),
            'supervisor_id' => 1,
            'item_id' => $itemId,
            'lender_id'=>auth()->user()->institution_id,

            'monthly_income' => $this->monthlyIncome,
            'other_loans' => $this->otherLoans,
            'other_loan_details' => $this->otherLoanDetails,
        ])->id;

        // Create application record
        $applicationId = DB::table('applications')->insertGetId([
            'first_name' => $this->firstname,
            'middle_name' => $this->middlename,
            'last_name' => $this->lastname,
            'phone_number' => $this->phonenumber,
            'national_id' => $this->nidanumber,
            'region' => $this->region,
            'district' => $this->district,
            'street' => $this->ward,
            'amount' => $this->loan_amount,
            'email' => $this->email,
            'application_status' => "NEW CLIENT",
            'make_and_model' => $this->make_and_model,
            'year_of_manufacture' => $this->year_of_manufacture,
            'vin' => $this->vin,
            'color' => $this->color,
            'mileage' => $this->mileage,
            'purchase_price' => $this->purchase_price,
            'down_payment' => $this->down_payment,
            'loan_amount' => $this->loan_amount,
            'loan_id' => $loan_id,
            'loanProductId' => $this->loanProductId,
            'is_employee' => $this->isEmployee,
            'employee_id' => $this->employeeId,
            'monthly_income' => $this->monthlyIncome,
            'employer_name' => $this->employerName,
            'lender_id'=>$this->lender,
            'hrEmail'=>$this->hrEmail,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }catch(\Exception $e){


    dd($e->getMessage());


    }

        // Update image references
       
           $this->saveImages($loan_id);
     
        // Send email notification
        try {
            Mail::to($this->email)->send(new LoanProgress(
                $this->phonenumber, 
                $this->firstname,
                'We acknowledge the successful receipt of your loan application. Our team is now processing it and will be in touch shortly regarding further stages.'
            ));
        } catch (\Exception $e) {
            // Log email error but continue with the process
            \Log::error('Failed to send email: ' . $e->getMessage());
        }

        // Reset form and show success message
        $this->resetFormFields();
        session()->flash('message_2', 'Your loan application has been submitted successfully. We will review your application and contact you soon.');
    }

    public function setAccount($account)
    {
        $this->accountSelected = $account;
    }

    public function resetFormFields()
    {
        // Reset all form fields
        $this->reset([
            'firstname', 'middlename', 'lastname', 'nidanumber', 'phonenumber',
            'region', 'district', 'ward', 'email', 'isEmployee', 'employeeId',
            'employmentDate', 'employmentPosition', 'employerName', 'monthlyIncome',
            'otherLoans', 'otherLoanDetails', 'loanProductId', 'loan_product',
            'make_and_model', 'year_of_manufacture', 'vin', 'color', 'mileage',
            'purchase_price', 'down_payment', 'loan_amount', 'loan_term',
            'currentVehicleOwner', 'dealerName', 'dealerContactInfo', 'step',
            'images', 'imagePreviews', 'uploadedImages', 'referenceNumber'
        ]);
        
        $this->step = 1;
    }

    public function render()
    {
        $this->amount3 = 600;
        $this->amount3 = $this->amount3 ?: null;


        $this->lenderList=Lender::get();

        if($this->lender){

            $this->loanProduct = LoanProduct::where('institution_id', $this->lender)->get();
        }

        return view('livewire.dashboard.front-desk');
    }
}