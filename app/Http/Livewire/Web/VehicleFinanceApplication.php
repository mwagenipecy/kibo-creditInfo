<?php

namespace App\Http\Livewire\Web;

use App\Models\Application;
use App\Models\Attachment;
use App\Models\Make;
use App\Models\VehicleModel;
use App\Models\Lender;
use App\Models\LenderFinancingCriteria;
use App\Models\Region;
use App\Models\District;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class VehicleFinanceApplication extends Component
{
    use WithFileUploads;

    // Step management
    public $currentStep = 1;
    public $totalSteps = 4;

    // Step 1: Insurance Verification
    public $registration_number = '';
    public $insurance_data = null;
    public $insurance_verified = false;
    public $insurance_valid = false;
    public $verification_loading = false;

    // Step 2: Vehicle Information
    public $makes = [];
    public $models = [];
    public $selected_make_id = '';
    public $selected_model_id = '';
    public $year_of_manufacture = '';
    public $color = '';
    public $mileage = '';
    public $purchase_price = '';
    public $vin = '';

    // Step 3: Personal Information
    public $first_name = '';
    public $middle_name = '';
    public $last_name = '';
    public $email = '';
    public $phone_number = '';
    public $national_id = '';
    public $regions = [];
    public $districts = [];
    public $selected_region = '';
    public $selected_district = '';
    public $street = '';
    
    // Employment Information
    public $is_employed = null;
    public $employer_name = '';
    public $hrEmail = '';
    public $is_employee = false;
    public $employee_id = '';
    public $monthly_income = '';

    // Step 4: Lender Selection & Documents
    public $qualified_lenders = [];
    public $selected_lender_id = '';
    public $down_payment = 0;
    public $loan_amount = 0;
    public $tenure = '';
    public $terms_accepted = false;

    // File uploads
    public $id_document;
    public $bank_statement;
    public $payslip;
    public $vehicle_images = [];
    public $image_previews = [];

    protected $rules = [
        'registration_number' => 'required|string',
        'selected_make_id' => 'required|exists:makes,id',
        'selected_model_id' => 'required|exists:vehicle_models,id',
        'year_of_manufacture' => 'required|integer|min:1990|max:2025',
        'color' => 'required|string|max:50',
        'mileage' => 'required|numeric|min:0',
        'purchase_price' => 'required|numeric|min:1000',
        'vin' => 'required|string|max:50',
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email|max:100',
        'phone_number' => 'required|string|max:20',
        'national_id' => ['required', 'regex:/^\d{8}-\d{5}-\d{5}-\d{2}$/'],
        'selected_region' => 'required',
        'selected_district' => 'required',
        'street' => 'required|string|max:100',
        'is_employed' => 'required|boolean',
        'selected_lender_id' => 'required|exists:lenders,id',
        'down_payment' => 'required|numeric|min:0',
        'tenure' => 'required',
        'terms_accepted' => 'accepted',
        'id_document' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
        'bank_statement' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf',
        'vehicle_images' => 'required|array|min:3|max:10',
        'vehicle_images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
    ];

    public function mount()
    {
        $this->makes = Make::orderBy('name')->get();
        $this->regions = Region::orderBy('name')->get();
        
        // Pre-fill user data if authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $this->first_name = $user->first_name ?? '';
            $this->last_name = $user->last_name ?? '';
            $this->email = $user->email ?? '';
            $this->phone_number = $user->phone_number ?? '';
        }
    }

    public function verifyInsurance()
    {
        // Add CORS headers immediately
        if (request()->getMethod() === 'OPTIONS') {
            return response('', 200)
                ->header('Access-Control-Allow-Origin', 'https://kiboauto.co.tz')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-CSRF-TOKEN, X-Livewire')
                ->header('Access-Control-Allow-Credentials', 'true');
        }
    
        $this->validate(['registration_number' => 'required|string']);
        
        $this->verification_loading = true;
        $this->insurance_verified = false;
        $this->insurance_valid = false;
    
        try {
            $response = Http::post('https://tiramis.tira.go.tz/covernote/api/public/portal/verify', [
                'paramType' => 2,
                'searchParam' => strtoupper($this->registration_number)
            ]);
    
            // Check if the response is successful
            Log::info('Insurance verification response: ', ['response' => $response->body()]);
            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['code'] == 1000 && !empty($data['data'])) {
                    $this->insurance_data = $data['data'][0];
                    $this->insurance_verified = true;
                    
                    // Check if insurance is valid (end date > 1 month from now)
                    $endDate = Carbon::createFromTimestampMs($this->insurance_data['coverNoteEndDate']);
                    $oneMonthFromNow = Carbon::now()->addMonth();
                    
                    if ($endDate->gt($oneMonthFromNow)) {
                        $this->insurance_valid = true;
                        session()->flash('success', 'Insurance verified successfully! Valid until ' . $endDate->format('Y-m-d'));
                    } else {
                        session()->flash('error', 'Insurance expires too soon. Please renew your insurance first.');
                    }
                } else {
                    session()->flash('error', 'No valid insurance found for this registration number.');
                }
            } else {
                session()->flash('error', 'Failed to verify insurance. Please try again.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Insurance verification service unavailable. Please try again later.');
            \Log::error('Insurance verification error: ' . $e->getMessage());
        }
    
        $this->verification_loading = false;
        
        // Add CORS headers to the final response
        $this->dispatchBrowserEvent('cors-headers', [
            'headers' => [
                'Access-Control-Allow-Origin' => 'https://kiboauto.co.tz',
                'Access-Control-Allow-Credentials' => 'true'
            ]
        ]);
    }

    
    public function updatedSelectedMakeId($makeId)
    {
        $this->models = [];
        $this->selected_model_id = '';
        
        if ($makeId) {
            $this->models = VehicleModel::where('make_id', $makeId)->orderBy('name')->get();
        }
        
        $this->findQualifiedLenders();
    }

    public function updatedSelectedModelId()
    {
        $this->findQualifiedLenders();
    }

    public function updatedPurchasePrice()
    {
        $this->calculateLoanAmount();
        $this->findQualifiedLenders();
    }

    public function updatedDownPayment()
    {
        $this->calculateLoanAmount();
    }

    protected function calculateLoanAmount()
    {

       // dd($this->purchase_price, $this->down_payment);
        if (is_numeric((float)$this->down_payment) && is_numeric((float)$this->purchase_price)) {
            $this->loan_amount = $this->purchase_price - $this->down_payment;

        }

       // dd($this->loan_amount);
    }

    protected function findQualifiedLenders()
    {
        if ($this->selected_make_id && $this->selected_model_id && $this->purchase_price) {
            $this->qualified_lenders = Lender::whereHas('financingCriteria', function($query) {
                $query->where('make_id', $this->selected_make_id)
                      ->where('model_id', $this->selected_model_id);
                     // ->where('min_loan_amount', '<=', $this->loan_amount ?: $this->purchase_price)
                    //  ->where('max_loan_amount', '>=', $this->loan_amount ?: $this->purchase_price);
            })->with(['financingCriteria' => function($query) {
                $query->where('make_id', $this->selected_make_id)
                      ->where('model_id', $this->selected_model_id);
            }])->get();

            // Set minimum down payment based on first qualified lender
            if ($this->qualified_lenders->isNotEmpty()) {
                $firstLender = $this->qualified_lenders->first();
                $criteria = $firstLender->financingCriteria->first();
                if ($criteria) {
                    $minDownPayment = ($criteria->min_down_payment_percent / 100) * $this->purchase_price;
                    if ($this->down_payment < $minDownPayment) {
                        $this->down_payment = $minDownPayment;
                        $this->calculateLoanAmount();
                    }
                }
            }
        }
    }

    public function updatedSelectedRegion($regionId)
    {
        $this->districts = [];
        $this->selected_district = '';
        
        if ($regionId) {
           // $this->districts = District::where('region_id', $regionId)->orderBy('name')->get();
        }
    }

    public function updatedVehicleImages()
    {
        $this->image_previews = [];
        foreach ($this->vehicle_images as $key => $image) {
            try {
                $this->image_previews[$key] = [
                    'url' => $image->temporaryUrl(),
                    'name' => $image->getClientOriginalName()
                ];
            } catch (\Exception $e) {
                // Handle exception
            }
        }
    }

    public function removeImage($index)
    {
        array_splice($this->vehicle_images, $index, 1);
        array_splice($this->image_previews, $index, 1);
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function prevStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    protected function validateCurrentStep()
    {
        switch ($this->currentStep) {
            case 1:
                if (!$this->insurance_verified || !$this->insurance_valid) {
                    throw new \Exception('Please verify valid insurance first.');
                }
                break;
                
            case 2:
                $this->validate([
                    'selected_make_id' => 'required|exists:makes,id',
                    'selected_model_id' => 'required|exists:vehicle_models,id',
                    'year_of_manufacture' => 'required|integer|min:1990|max:2025',
                    'color' => 'required|string|max:50',
                    'mileage' => 'required|numeric|min:0',
                    'purchase_price' => 'required|numeric|min:1000',
                    'vin' => 'required|string|max:50',
                ]);
                break;
                
            case 3:
                $rules = [
                    'first_name' => 'required|string|max:50',
                    'last_name' => 'required|string|max:50',
                    'email' => 'required|email|max:100',
                    'phone_number' => 'required|string|max:20',
                    'national_id' => ['required', 'regex:/^\d{8}-\d{5}-\d{5}-\d{2}$/'],
                    'selected_region' => 'required',
                    'selected_district' => 'required',
                    'street' => 'required|string|max:100',
                    'is_employed' => 'required|boolean',
                ];
                
                if ($this->is_employed) {
                    $rules['employer_name'] = 'required|string|max:100';
                    $rules['hrEmail'] = 'required|email|max:100';
                    $rules['monthly_income'] = 'required|numeric|min:100000';
                    
                    if ($this->is_employee) {
                        $rules['employee_id'] = 'required|string|max:50';
                    }
                }
                
                $this->validate($rules);
                break;
        }
    }

    public function saveAttachment($application_id, $type, $file)
    {
        try {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
            $extension = strtolower($file->getClientOriginalExtension());
            
            if (!in_array($extension, $allowedExtensions)) {
                throw new \Exception("Unsupported file type: .$extension");
            }
            
            $filename = uniqid() . '.' . $extension;
            $storedPath = $file->storeAs('assets/attachment', $filename, 'public');
            
            Attachment::create([
                'url' => $storedPath,
                'loan_id' => $application_id,
                'type' => $type,
            ]);
            
            return true;
        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());
            return false;
        }
    }

    public function saveVehicleImages($application_id)
    {
        try {
            foreach ($this->vehicle_images as $key => $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $storedPath = $image->storeAs('assets/vehicles', $filename, 'public');
                
                Attachment::create([
                    'url' => $storedPath,
                    'loan_id' => $application_id,
                    'type' => 'vehicle_image_' . ($key + 1),
                ]);
            }
            return true;
        } catch (\Exception $e) {
            \Log::error('Vehicle image upload error: ' . $e->getMessage());
            return false;
        }
    }

    public function submitApplication()
    {
        // Validate all steps
        for ($i = 1; $i <= $this->totalSteps; $i++) {
            $this->currentStep = $i;
            $this->validateCurrentStep();
        }

        // Final validation
        $this->validate([
            'selected_lender_id' => 'required|exists:lenders,id',
            'down_payment' => 'required|numeric|min:0',
            'tenure' => 'required',
            'terms_accepted' => 'accepted',
            'id_document' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
            'bank_statement' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf',
            'vehicle_images' => 'required|array|min:3|max:10',
        ]);

        if ($this->is_employed) {
            $this->validate([
                'payslip' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
            ]);
        }

        try {
            // Create application record
            $application = new Application();
            $application->first_name = $this->first_name;
            $application->middle_name = $this->middle_name;
            $application->last_name = $this->last_name;
            $application->phone_number = $this->phone_number;
            $application->national_id = $this->national_id;
            $application->region = $this->selected_region;
            $application->district = $this->selected_district;
            $application->street = $this->street;
            $application->email = $this->email;
            $application->application_status = 'pending';
            
            // Vehicle information
            $selectedMake = Make::find($this->selected_make_id);
            $selectedModel = VehicleModel::find($this->selected_model_id);
            $application->make_and_model = $selectedMake->name . ' ' . $selectedModel->name;
            $application->year_of_manufacture = $this->year_of_manufacture;
            $application->vin = $this->vin;
            $application->color = $this->color;
            $application->mileage = $this->mileage;
            $application->purchase_price = $this->purchase_price;
            $application->down_payment = $this->down_payment;
            $application->loan_amount = $this->loan_amount;
            $application->tenure = $this->tenure;
            $application->lender_id = $this->selected_lender_id;
            $application->client_id = auth()->user()->id ?? null;
            $application->stage_name = 'direct_application';
            
            // Employment information
            if ($this->is_employed) {
                $application->is_employee = $this->is_employed;
                $application->employer_name = $this->employer_name;
                $application->hrEmail = $this->hrEmail;
                $application->monthly_income = $this->monthly_income;
                $application->employee_id = $this->employee_id;
                $application->employer_verification_sent = false;
                $application->employer_verified = false;
                $application->employer_verification_status = 'pending';
            } else {
                $application->is_employee = false;
            }
            
            $application->save();
            
            // Upload attachments
            if ($this->id_document) {
                $this->saveAttachment($application->id, 'id_document', $this->id_document);
            }
            
            if ($this->bank_statement) {
                $this->saveAttachment($application->id, 'bank_statement', $this->bank_statement);
            }
            
            if ($this->is_employed && $this->payslip) {
                $this->saveAttachment($application->id, 'payslip', $this->payslip);
            }
            
            // Upload vehicle images
            $this->saveVehicleImages($application->id);
            
            session()->flash('success', 'Your vehicle finance application has been submitted successfully! Reference ID: ' . $application->id);
            
            // Reset form
            $this->reset();
            $this->currentStep = 1;
            
            return redirect()->route('application.success', ['id' => $application->id]);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to submit application: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.web.vehicle-finance-application');
    }
}

