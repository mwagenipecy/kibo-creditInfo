<?php

namespace App\Http\Livewire\ImportDuty;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ImportDutyApplication;
use App\Models\ClearingForwardingCompany;
use App\Services\CarListingExtractor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ImportDutyApplicationForm extends Component
{
    use WithFileUploads;

    // Applicant Information
    public $applicant_name;
    public $phone_number;
    public $email;
    public $national_id;
    public $address;
    
    // Application Type
    public $application_type = 'PURCHASED'; // PURCHASED or WANT_TO_BUY
    public $car_listing_url;
    public $extracted_car_image;
    public $extracted_car_details = [];

    // Vehicle Information
    public $vehicle_make;
    public $vehicle_model;
    public $vehicle_year;
    public $vehicle_vin;
    public $vehicle_color;
    public $vehicle_mileage;
    public $vehicle_engine_size;
    public $cif_value_usd;
    public $port_of_entry = 'Dar es Salaam';
    public $expected_arrival_date;

    // Documents
    public $bill_of_lading;
    public $commercial_invoice;
    public $packing_list;
    public $certificate_of_origin;
    public $shipping_documents = [];

    // Financing Information
    public $down_payment;
    public $loan_tenure_months = 36;

    public $currentStep = 1;
    public $totalSteps = 4;

    protected $rules = [
        'applicant_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'national_id' => 'required|string|max:50',
        'address' => 'required|string',
        'application_type' => 'required|in:PURCHASED,WANT_TO_BUY',
        'car_listing_url' => 'required_if:application_type,WANT_TO_BUY|nullable|url|max:500',
        'vehicle_make' => 'required|string|max:100',
        'vehicle_model' => 'required|string|max:100',
        'vehicle_year' => 'required|integer|min:1990',
        'vehicle_vin' => 'required_if:application_type,PURCHASED|nullable|string|max:50',
        'vehicle_color' => 'required|string|max:50',
        'cif_value_usd' => 'required|numeric|min:1000',
        'expected_arrival_date' => 'nullable|date|after:today',
        'bill_of_lading' => 'required_if:application_type,PURCHASED|nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'commercial_invoice' => 'required_if:application_type,PURCHASED|nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'packing_list' => 'required_if:application_type,PURCHASED|nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'certificate_of_origin' => 'required_if:application_type,PURCHASED|nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'down_payment' => 'nullable|numeric|min:0',
        'loan_tenure_months' => 'required|integer|min:12|max:84',
    ];

    public function mount()
    {
        // Pre-fill user information if authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $this->applicant_name = $user->name;
            $this->email = $user->email;
            $this->phone_number = $user->phone_number;
        }
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function validateCurrentStep()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'applicant_name' => 'required|string|max:255',
                    'phone_number' => 'required|string|max:20',
                    'email' => 'required|email|max:255',
                    'national_id' => 'required|string|max:50',
                    'address' => 'required|string',
                    'application_type' => 'required|in:PURCHASED,WANT_TO_BUY',
                ]);
                break;
            
            case 2:
                $rules = [
                    'vehicle_make' => 'required|string|max:100',
                    'vehicle_model' => 'required|string|max:100',
                    'vehicle_year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
                    'vehicle_color' => 'required|string|max:50',
                    'cif_value_usd' => 'required|numeric|min:1000',
                ];
                
                if ($this->application_type === 'PURCHASED') {
                    $rules['vehicle_vin'] = 'required|string|max:50';
                } else {
                    $rules['car_listing_url'] = 'required|url|max:500';
                }
                
                $this->validate($rules);
                break;
            
            case 3:
                if ($this->application_type === 'PURCHASED') {
                    $this->validate([
                        'bill_of_lading' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                        'commercial_invoice' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                        'packing_list' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                        'certificate_of_origin' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    ]);
                }
                break;
        }
    }
    
    /**
     * Extract car details from URL
     */
    public function extractCarDetails()
    {
        if (empty($this->car_listing_url)) {
            session()->flash('error', 'Please enter a car listing URL first.');
            return;
        }
        
        try {
            $extractor = new CarListingExtractor();
            $result = $extractor->extractFromUrl($this->car_listing_url);
            
            if ($result['success']) {
                $this->extracted_car_details = $result['car_details'];
                $this->extracted_car_image = $result['image_path'];
                
                // Auto-fill vehicle details if extracted
                if (isset($result['car_details']['make'])) {
                    $this->vehicle_make = $result['car_details']['make'];
                }
                if (isset($result['car_details']['model'])) {
                    $this->vehicle_model = $result['car_details']['model'];
                }
                if (isset($result['car_details']['year'])) {
                    $this->vehicle_year = $result['car_details']['year'];
                }
                if (isset($result['car_details']['color'])) {
                    $this->vehicle_color = $result['car_details']['color'];
                }
                if (isset($result['car_details']['mileage'])) {
                    $this->vehicle_mileage = $result['car_details']['mileage'];
                }
                if (isset($result['car_details']['engine_size'])) {
                    $this->vehicle_engine_size = $result['car_details']['engine_size'];
                }
                
                session()->flash('success', 'Car details extracted successfully! Please review and complete any missing information.');
            } else {
                session()->flash('error', 'Failed to extract car details: ' . $result['error']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while extracting car details: ' . $e->getMessage());
        }
    }
    
    /**
     * Clear extracted car details
     */
    public function clearExtractedDetails()
    {
        $this->extracted_car_details = [];
        $this->extracted_car_image = null;
        $this->car_listing_url = null;
    }

    public function submitApplication()
    {
        $this->validate();

        try {
            // Calculate TZS value (approximate exchange rate)
            $exchangeRate = 2300; // This should come from a real-time source
            $cifValueTzs = $this->cif_value_usd * $exchangeRate;

            // Generate application number
            $applicationNumber = 'ID' . date('Y') . str_pad(ImportDutyApplication::count() + 1, 4, '0', STR_PAD_LEFT);

            // Store documents
            $documents = [];
            if ($this->bill_of_lading) {
                $documents['bill_of_lading'] = $this->bill_of_lading->store('import-duty/bills-of-lading', 'public');
            }
            if ($this->commercial_invoice) {
                $documents['commercial_invoice'] = $this->commercial_invoice->store('import-duty/commercial-invoices', 'public');
            }
            if ($this->packing_list) {
                $documents['packing_list'] = $this->packing_list->store('import-duty/packing-lists', 'public');
            }
            if ($this->certificate_of_origin) {
                $documents['certificate_of_origin'] = $this->certificate_of_origin->store('import-duty/certificates', 'public');
            }

            // Create application
            $application = ImportDutyApplication::create([
                'application_number' => $applicationNumber,
                'applicant_name' => $this->applicant_name,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'national_id' => $this->national_id,
                'address' => $this->address,
                'application_type' => $this->application_type,
                'car_listing_url' => $this->car_listing_url,
                'extracted_car_image' => $this->extracted_car_image,
                'extracted_car_details' => $this->extracted_car_details,
                'vehicle_make' => $this->vehicle_make,
                'vehicle_model' => $this->vehicle_model,
                'vehicle_year' => $this->vehicle_year,
                'vehicle_vin' => $this->vehicle_vin,
                'vehicle_color' => $this->vehicle_color,
                'vehicle_mileage' => $this->vehicle_mileage,
                'vehicle_engine_size' => $this->vehicle_engine_size,
                'cif_value_usd' => $this->cif_value_usd,
                'cif_value_tzs' => $cifValueTzs,
                'currency_rate' => $exchangeRate,
                'port_of_entry' => $this->port_of_entry,
                'expected_arrival_date' => $this->expected_arrival_date,
                'bill_of_lading' => $documents['bill_of_lading'] ?? null,
                'commercial_invoice' => $documents['commercial_invoice'] ?? null,
                'packing_list' => $documents['packing_list'] ?? null,
                'certificate_of_origin' => $documents['certificate_of_origin'] ?? null,
                'down_payment' => $this->down_payment,
                'loan_tenure_months' => $this->loan_tenure_months,
                'status' => 'SUBMITTED',
                'submitted_at' => now(),
                'cf_deadline' => now()->addHours(48), // 48 hours for CF companies to respond
            ]);

            // Notify all active CF companies
            $this->notifyCFCompanies($application);

            session()->flash('success', 'Your import duty financing application has been submitted successfully! Application Number: ' . $applicationNumber);
            
            return redirect()->route('client.applications');

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while submitting your application. Please try again.');
            \Log::error('Import duty application submission error: ' . $e->getMessage());
        }
    }

    protected function notifyCFCompanies($application)
    {
        $cfCompanies = ClearingForwardingCompany::where('status', 'APPROVED')->get();
        
        foreach ($cfCompanies as $company) {
            // Send notification to CF company
            // This could be email, SMS, or internal notification
          //  \App\Jobs\NotifyCFCompanyNewApplication::dispatch($company, $application);
        }
    }

    public function render()
    {
        return view('livewire.import-duty.import-duty-application-form');
    }
}




