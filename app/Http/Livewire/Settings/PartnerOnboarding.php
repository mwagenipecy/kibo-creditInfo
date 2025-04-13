<?php

namespace App\Http\Livewire\Settings;

use App\Models\Lender;
use App\Models\CarDealer;
use App\Models\Region;
use App\Models\City;
use App\Models\PartnerDocument;
use App\Models\Approvals;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class PartnerOnboarding extends Component
{
    use WithFileUploads;
    
    // Tab and step control
    public $activeTab = 'lender'; // Options: 'lender', 'carDealer', 'pending'
    public $currentStep = 1;
    public $totalSteps = 4;
    public $search,$statusFilter,$regionFilter,$dateFilter,$showPartnerSelectionModal;
    // Modal control
    public $showLenderModal = false;
    public $showCarDealerModal = false;
    
    // Common fields for both partner types
    public $name,$termsAccepted;
    public $businessRegistrationNumber;
    public $taxIdentificationNumber;
   // public $filteredCarDealers=[];
    public $address;
    public $city;
    public $region,$acceptTerms;

    public $setPageId=1;


  

    public $postalCode;
    public $country = 'Tanzania';
    public $phoneNumber;
    public $email;
    public $website;
    public $logo;
    
    // Contact person details
    public $contactPersonName;
    public $contactPersonPosition;
    public $contactPersonPhone;
    public $contactPersonEmail;
    
    // Lender specific fields
    public $lenderId;
    public $lenderType; // Bank, Microfinance, Credit Union, etc.
    public $interestRateRange;
    public $loanTermsRange;
    public $minimumLoanAmount;
    public $maximumLoanAmount;
    public $bankAccountDetails;
    public $financialLicenseNumber;
    public $operatingHours;
    public $servicesOffered=[];
    public $additionalNotes;
    public $paymentMethods = [];
    public $settlementPeriod;
    
    // Car Dealer specific fields
    public $carDealerId;
    public $dealerType; // New Cars, Used Cars, Both
    public $brandsList = [];
    public $selectedBrands = [];
    public $establishedYear;
    public $showroomAddress;
    public $serviceCenter;
    public $inventorySize;
    
    // Document uploads
    public $businessRegistrationDoc;
    public $taxClearanceDoc;
    public $financialLicenseDoc;
    public $additionalDoc;
    
    // For editing mode
    public $isEditMode = false;

    // Regions list for dropdown
    public $regions = [];
    public $cities = [];
    
    // Lists for display
    public $lenders = [];
    public $carDealers = [];
    
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'editLender',
        'editCarDealer',
        'approveLender',
        'approveCarDealer',
        'viewLender',
        'viewCarDealer',
        'setStep',
        'openLenderModal',
        'openCarDealerModal',
        'closeModal',
    ];
    
    /**
     * Initialize component properties
     */
    public function mount()
    {
        $this->loadLocations();
        $this->loadPartners();
        $this->loadBrands();
    }
    

    public function setPageId($id){


        $this->setPageId=$id;

        if($id==1){
            $this->activeTab='lender';
        }elseif($id==2){
            $this->activeTab='carDealer';
        }
    }


    /**
     * Load regions and cities for the location dropdown
     */
    public function loadLocations()
    {
        // Load regions from database
        $this->regions = Region::orderBy('name')->pluck('name')->toArray();
    }
    
    /**
     * Update cities based on selected region
     */
    public function updatedRegion($value)
    {
        if (!empty($value)) {
            $regionId = Region::where('name', $value)->value('id');
            $this->cities = City::where('region_id', $regionId)->orderBy('name')->pluck('name')->toArray();
        } else {
            $this->cities = [];
        }
    }
    
    /**
     * Load existing lenders and car dealers
     */
    public function loadPartners()
    {
        $this->lenders = Lender::with('documents')->latest()->get();
        $this->carDealers = CarDealer::with('documents')->latest()->get();
    }
    
    /**
     * Load available car brands
     */
    public function loadBrands()
    {
        // In a real application, you would load this from a database
        $this->brandsList = [
            'Toyota', 'Honda', 'Nissan', 'Mitsubishi', 'Mazda', 
            'Suzuki', 'Subaru', 'Isuzu', 'Mercedes-Benz', 'BMW', 
            'Audi', 'Volkswagen', 'Ford', 'Chevrolet', 'Hyundai', 
            'Kia', 'Volvo', 'Land Rover', 'Jeep', 'Lexus'
        ];
    }
    
    /**
     * Set current step in multi-step form
     */
  
 
    
    /**
     * Render the component view
     */
 


     /**
 * Select partner type and open appropriate modal
 */
public function selectPartnerType($type)
{
    $this->activeTab = $type;
    $this->showPartnerSelectionModal = false;
    $this->currentStep = 1;
    
    if ($type === 'lender') {
        $this->openLenderModal();
    } else {
        $this->openCarDealerModal();
    }
}

/**
 * Open partner selection modal
 */


/**
 * Show partner details in a summary format
 */
public function viewLenderSummary($id)
{
    $lender = Lender::with('documents')->findOrFail($id);
    
    $this->emit('openSummaryModal', [
        'type' => 'lender',
        'data' => $lender->toArray()
    ]);
}

/**
 * Show car dealer details in a summary format
 */
public function viewCarDealerSummary($id)
{
    $dealer = CarDealer::with('documents')->findOrFail($id);
    
    $this->emit('openSummaryModal', [
        'type' => 'carDealer',
        'data' => $dealer->toArray()
    ]);
}

/**
 * Download a specific document
 */
public function downloadDocument($documentId)
{
    $document = PartnerDocument::findOrFail($documentId);
    
    return Storage::disk('public')->download(
        $document->file_path,
        $document->file_name
    );
}

/**
 * Generate and download onboarding report
 */
public function downloadOnboardingReport()
{
    $lenders = Lender::all();
    $carDealers = CarDealer::all();
    
    $data = [
        'lenders' => $lenders,
        'carDealers' => $carDealers,
        'pendingApprovals' => $lenders->where('status', 'PENDING')->count() + 
                              $carDealers->where('status', 'PENDING')->count(),
        'generatedAt' => now()->format('Y-m-d H:i:s'),
        'generatedBy' => Auth::user()->name
    ];
    
    // You could use a package like barryvdh/laravel-dompdf to generate PDFs
    $pdf = PDF::loadView('reports.onboarding-summary', $data);
    
    return $pdf->download('partner-onboarding-report-' . now()->format('Y-m-d') . '.pdf');
}

/**
 * Process search and filtering
 */
public function getFilteredData()
{
    if ($this->activeTab === 'lender') {
        return Lender::query()
            ->when($this->search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('business_registration_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('contact_person_name', 'like', "%{$search}%");
                });
            })
            ->when($this->statusFilter, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($this->regionFilter, function ($query, $region) {
                return $query->where('region', $region);
            })
            ->latest()
            ->paginate(10);
    } elseif ($this->activeTab === 'carDealer') {
        return CarDealer::query()
            ->when($this->search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('business_registration_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('contact_person_name', 'like', "%{$search}%");
                });
            })
            ->when($this->statusFilter, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($this->regionFilter, function ($query, $region) {
                return $query->where('region', $region);
            })
            ->latest()
            ->paginate(10);
    } else { // Pending approvals
        $pendingLenders = Lender::where('status', 'PENDING')->get();
        $pendingDealers = CarDealer::where('status', 'PENDING')->get();
        
        // Combine both types into a collection and paginate
        return collect($pendingLenders)
            ->merge($pendingDealers)
            ->sortByDesc('created_at')
            ->slice(0, 10); // Simple pagination
    }
}

/**
 * Calculate onboarding progress for display in progress bar
 */
private function calculateProgress()
{
    $lendersProgress = 0;
    $carDealersProgress = 0;
    
    // Calculate lenders progress
    $totalLenders = $this->lenders->count();
    if ($totalLenders > 0) {
        $approved = $this->lenders->where('status', 'APPROVED')->count();
        $pending = $this->lenders->where('status', 'PENDING')->count();
        
        // Weighted calculation: Approved = 100%, Pending = 75%, Rejected = 0%
        $lendersProgress = ($approved * 100 + $pending * 75) / $totalLenders;
    }
    
    // Calculate car dealers progress
    $totalDealers = $this->carDealers->count();
    if ($totalDealers > 0) {
        $approved = $this->carDealers->where('status', 'APPROVED')->count();
        $pending = $this->carDealers->where('status', 'PENDING')->count();
        
        // Weighted calculation: Approved = 100%, Pending = 75%, Rejected = 0%
        $carDealersProgress = ($approved * 100 + $pending * 75) / $totalDealers;
    }
    
    return [
        'lendersProgress' => round($lendersProgress),
        'carDealersProgress' => round($carDealersProgress)
    ];
}




public function render()
{
    // Check which methods actually exist in your class
    if (method_exists($this, 'getFilteredLendersProperty')) {
        $filteredLenders = $this->filteredLenders; // Accesses the computed property
    } else {
        // Fallback to query in-line if the method doesn't exist
        $filteredLenders = Lender::query()
            ->when($this->search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('business_registration_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($this->statusFilter, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($this->regionFilter, function ($query, $region) {
                return $query->where('region', $region);
            })
            ->latest()
            ->paginate(10);
    }

    if (method_exists($this, 'getFilteredCarDealersProperty')) {
        $filteredCarDealers = $this->filteredCarDealers; // Accesses the computed property
    } else {
        // Fallback to query in-line if the method doesn't exist
        $filteredCarDealers = CarDealer::query()
            ->when($this->search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('business_registration_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($this->statusFilter, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($this->regionFilter, function ($query, $region) {
                return $query->where('region', $region);
            })
            ->latest()
            ->paginate(10);
    }

    // Make sure all necessary properties are passed to the view
    $data = [
        // Filtered data with appropriate conditional loading
        'filteredLenders' => ($this->activeTab === 'lender' || $this->setPageId === 1) 
            ? $filteredLenders 
            : null,
        'filteredCarDealers' => ($this->activeTab === 'carDealer' || $this->setPageId === 2) 
            ? $filteredCarDealers 
            : null,
        
        // Other data
        'statistics' => $this->getStatisticsData(),
        'regions' => $this->regions,
        'cities' => $this->cities,
        'lenders' => $this->lenders,
        'carDealers' => $this->carDealers,
        'brandsList' => $this->brandsList ?? []
    ];
    
    return view('livewire.settings.partner-onboarding', $data);
}


    
    /**
     * Get pending approvals count
     */
    private function getPendingApprovals()
    {
        $pendingLenders = $this->lenders->where('status', 'PENDING')->count();
        $pendingDealers = $this->carDealers->where('status', 'PENDING')->count();
        
        return $pendingLenders + $pendingDealers;
    }
    
    /**
     * Switch between tabs
     */
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }
    
    /**
     * Open lender registration modal
     */
    public function openLenderModal()
    {
        $this->resetLenderFields();
        $this->isEditMode = false;
        $this->currentStep = 1;
        $this->showLenderModal = true;
    }
    
    /**
     * Open car dealer registration modal
     */
    public function openCarDealerModal()
    {
        $this->resetCarDealerFields();
        $this->isEditMode = false;
        $this->currentStep = 1;
        $this->showCarDealerModal = true;
    }
    
    /**
     * Reset lender form fields
     */
    public function resetLenderFields()
    {
        $this->lenderId = null;
        $this->name = null;
        $this->businessRegistrationNumber = null;
        $this->taxIdentificationNumber = null;
        $this->address = null;
        $this->city = null;
        $this->region = null;
        $this->postalCode = null;
        $this->country = 'Tanzania';
        $this->phoneNumber = null;
        $this->email = null;
        $this->website = null;
        $this->logo = null;
        $this->contactPersonName = null;
        $this->contactPersonPosition = null;
        $this->contactPersonPhone = null;
        $this->contactPersonEmail = null;
        $this->lenderType = null;
        $this->interestRateRange = null;
        $this->loanTermsRange = null;
        $this->minimumLoanAmount = null;
        $this->maximumLoanAmount = null;
        $this->bankAccountDetails = null;
        $this->financialLicenseNumber = null;
        $this->operatingHours = null;
        $this->servicesOffered = [];
        $this->additionalNotes = null;
        $this->paymentMethods = [];
        $this->settlementPeriod = null;
        $this->businessRegistrationDoc = null;
        $this->taxClearanceDoc = null;
        $this->financialLicenseDoc = null;
        $this->additionalDoc = null;
        $this->resetErrorBag();
    }





    
    /**
     * Reset car dealer form fields
     */
    public function resetCarDealerFields()
    {
        $this->carDealerId = null;
        $this->name = null;
        $this->businessRegistrationNumber = null;
        $this->taxIdentificationNumber = null;
        $this->address = null;
        $this->city = null;
        $this->region = null;
        $this->postalCode = null;
        $this->country = 'Tanzania';
        $this->phoneNumber = null;
        $this->email = null;
        $this->website = null;
        $this->logo = null;
        $this->contactPersonName = null;
        $this->contactPersonPosition = null;
        $this->contactPersonPhone = null;
        $this->contactPersonEmail = null;
        $this->dealerType = null;
        $this->selectedBrands = [];
        $this->establishedYear = null;
        $this->showroomAddress = null;
        $this->serviceCenter = null;
        $this->inventorySize = null;
        $this->businessRegistrationDoc = null;
        $this->taxClearanceDoc = null;
        $this->additionalDoc = null;
        $this->resetErrorBag();
    }
    
    /**
     * Close all modals
     */
    public function closeModal()
    {
        $this->showLenderModal = false;
        $this->showCarDealerModal = false;
    }
    
    /**
     * Validate and register a new lender
     */
    public function registerLender()
    {
        // Validate based on current step
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'name' => 'required|string|max:255',
                    'businessRegistrationNumber' => 'required|string|max:50',
                    'taxIdentificationNumber' => 'required|string|max:50',
                    'address' => 'required|string|max:255',
                    'region' => 'required|string|max:100',
                    'city' => 'required|string|max:100',
                    // Corrected versions:
                    'phoneNumber' => 'required',
                    'contactPersonPhone' => 'required',

                    'email' => 'required|email|max:255',
                    'contactPersonName' => 'required|string|max:255',
                    'contactPersonEmail' => 'required|email|max:255',
                ]);
                $this->nextStep();
                return;
                
            case 2:
                $this->validate([
                    'lenderType' => 'required|string|max:50',
                    'minimumLoanAmount' => 'required|numeric|min:0',
                    'maximumLoanAmount' => 'required|numeric|gt:minimumLoanAmount',
                    'interestRateRange' => 'required|string|max:50',
                    'loanTermsRange' => 'required|string|max:50',
                    'bankAccountDetails' => 'required|string',
                ]);
                $this->nextStep();
                return;
                
            case 3:
                $this->validate([
                    'businessRegistrationDoc' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'taxClearanceDoc' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'financialLicenseDoc' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'logo' => 'nullable|image|max:2048', // 2MB max
                ]);
                $this->nextStep();
                return;
                
            case 4:
                // Final step - submit the form
                break;
        }
        
        try {
            // Handle logo upload if provided
            $logoPath = null;
            if ($this->logo) {
                $logoPath = $this->logo->store('lender-logos', 'public');
            }
            
            if ($this->isEditMode && $this->lenderId) {
                // Update existing lender
                $lender = Lender::find($this->lenderId);
                if (!$lender) {
                    throw new \Exception('Lender not found');
                }
                
                // Prepare data for approval
                $oldData = $lender->toArray();
                $newData = $this->prepareLenderData($logoPath);
                
             
                
                Session::flash('message', 'Lender update request submitted for approval');
            } else {
                // Create new lender
                $data = $this->prepareLenderData($logoPath);
                
                // Save lender pending approval
                $lender = new Lender($data);
                $lender->status = 'PENDING';
                $lender->save();
                


              
                User::create([

                    'name'=>$lender->contact_person_name,
                    'email'=>$lender->contact_person_email,
                    'phone_number'=>$lender->contact_person_phone,
                    'password'=>Hash::make('password'),
                    'department'=>2,
                    'status'=>'ACTIVE',
                    'institution_id'=>$lender->id,

                ]);


                /// send email TODO 


                // Save documents
                $this->savePartnerDocuments($lender->id, 'lender');
                
             
                
                // Log activity
                $this->logActivity(
                    'lender_created',
                    'Lender',
                    $lender->id,
                    'Created new lender: ' . $this->name
                );
                
                Session::flash('message', 'Lender registration submitted for approval');
            }
            
            Session::flash('alert-class', 'alert-success');
            $this->closeModal();
            $this->loadPartners();
            
        } catch (\Exception $e) {

            dd($e->getMessage());
            Session::flash('error', 'Error processing request: ' . $e->getMessage());
        }
    }
    
    /**
     * Save partner documents
     */
    private function savePartnerDocuments($partnerId, $partnerType)
    {
        // Save business registration document
        if ($this->businessRegistrationDoc) {
            $path = $this->businessRegistrationDoc->store("documents/{$partnerType}/{$partnerId}", 'public');
            PartnerDocument::create([
                'partner_id' => $partnerId,
                'partner_type' => $partnerType,
                'document_type' => 'business_registration',
                'file_path' => $path,
                'file_name' => $this->businessRegistrationDoc->getClientOriginalName(),
                'file_size' => $this->businessRegistrationDoc->getSize(),
                'mime_type' => $this->businessRegistrationDoc->getMimeType(),
                'status' => 'PENDING'
            ]);
        }
        
        // Save tax clearance document
        if ($this->taxClearanceDoc) {
            $path = $this->taxClearanceDoc->store("documents/{$partnerType}/{$partnerId}", 'public');
            PartnerDocument::create([
                'partner_id' => $partnerId,
                'partner_type' => $partnerType,
                'document_type' => 'tax_clearance',
                'file_path' => $path,
                'file_name' => $this->taxClearanceDoc->getClientOriginalName(),
                'file_size' => $this->taxClearanceDoc->getSize(),
                'mime_type' => $this->taxClearanceDoc->getMimeType(),
                'status' => 'PENDING'
            ]);
        }
        
        // Save financial license document (for lenders only)
        if ($partnerType === 'lender' && $this->financialLicenseDoc) {
            $path = $this->financialLicenseDoc->store("documents/{$partnerType}/{$partnerId}", 'public');
            PartnerDocument::create([
                'partner_id' => $partnerId,
                'partner_type' => $partnerType,
                'document_type' => 'financial_license',
                'file_path' => $path,
                'file_name' => $this->financialLicenseDoc->getClientOriginalName(),
                'file_size' => $this->financialLicenseDoc->getSize(),
                'mime_type' => $this->financialLicenseDoc->getMimeType(),
                'status' => 'PENDING'
            ]);
        }
        
        // Save additional document if provided
        if ($this->additionalDoc) {
            $path = $this->additionalDoc->store("documents/{$partnerType}/{$partnerId}", 'public');
            PartnerDocument::create([
                'partner_id' => $partnerId,
                'partner_type' => $partnerType,
                'document_type' => 'additional',
                'file_path' => $path,
                'file_name' => $this->additionalDoc->getClientOriginalName(),
                'file_size' => $this->additionalDoc->getSize(),
                'mime_type' => $this->additionalDoc->getMimeType(),
                'status' => 'PENDING'
            ]);
        }
    }
    
    /**
     * Prepare lender data for saving
     */
    private function prepareLenderData($logoPath = null)
    {

        
        return [
            'name' => $this->name,
            'business_registration_number' => $this->businessRegistrationNumber,
            'tax_identification_number' => $this->taxIdentificationNumber,
            'address' => $this->address,
            'city' => $this->city,
            'region' => $this->region,
            'postal_code' => $this->postalCode,
            'country' => $this->country,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'website' => $this->website,
            'logo' => $logoPath ?: ($this->isEditMode ? Lender::find($this->lenderId)->logo : null),
            'contact_person_name' => $this->contactPersonName,
            'contact_person_position' => $this->contactPersonPosition,
            'contact_person_phone' => $this->contactPersonPhone,
            'contact_person_email' => $this->contactPersonEmail,
            'lender_type' => $this->lenderType,
            'interest_rate_range' => $this->interestRateRange,
            'loan_terms_range' => $this->loanTermsRange,
            'minimum_loan_amount' => $this->minimumLoanAmount,
            'maximum_loan_amount' => $this->maximumLoanAmount,
            'bank_account_details' => $this->bankAccountDetails,
            'financial_license_number' => $this->financialLicenseNumber,
            'operating_hours' => $this->operatingHours,
            'services_offered' => json_encode($this->servicesOffered),
            'additional_notes' => $this->additionalNotes,
            'payment_methods' => json_encode($this->paymentMethods),
            'settlement_period' => $this->settlementPeriod,
        ];
    }
    
    /**
     * Valid
     * 
     * ate and register a new car dealer
     */


     public function validateCarDealerInputs(){

          // Validate based on current step
          switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'name' => 'required|string|max:255',
                    'businessRegistrationNumber' => 'required|string|max:50',
                    'taxIdentificationNumber' => 'required|string|max:50',
                    'address' => 'required|string|max:255',
                    'region' => 'required|string|max:100',
                    'city' => 'required|string|max:100',
                    'phoneNumber' => 'required|string',
                    'email' => 'required|email|max:255',
                    'contactPersonName' => 'required|string|max:255',
                    'contactPersonPhone' => 'required|string',
                    'contactPersonEmail' => 'required|email|max:255',
                ]);
              
                return;
                
            case 2:
                $this->validate([
                    'dealerType' => 'required|string|max:50',
                    'selectedBrands' => 'required|array|min:1',
                    'establishedYear' => 'required|integer|min:1900|max:' . date('Y'),
                    'inventorySize' => 'required|integer|min:1',
                ]);
                
                return;
                
            case 3:
                $this->validate([
                    'businessRegistrationDoc' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'taxClearanceDoc' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'logo' => 'nullable|image|max:2048', // 2MB max
                ]);
               
                return;
                
            case 4:
                // Final step - submit the form
                break;
        }



     }
    public function registerCarDealer()
    {

     
        try {
            // Handle logo upload if provided
            $logoPath = null;
            if ($this->logo) {
                $logoPath = $this->logo->store('dealer-logos', 'public');
            }
            
            if ($this->isEditMode && $this->carDealerId) {
                // Update existing car dealer
                $dealer = CarDealer::find($this->carDealerId);
                if (!$dealer) {
                    throw new \Exception('Car dealer not found');
                }
                
                // Prepare data for approval
                $oldData = $dealer->toArray();
                $newData = $this->prepareCarDealerData($logoPath);
                
               
                
                Session::flash('message', 'Car dealer update request submitted for approval');
            } else {
                // Create new car dealer
                $data = $this->prepareCarDealerData($logoPath);
                

               
                // Save car dealer pending approval
                try{
                    $dealer = new CarDealer($data);
                    $dealer->status = 'PENDING';
                    $dealer->save();

                    
                }catch(\Exception $e){

                    dd("saved".$e->getMessage());
                    

                }
          

                try{
                  

                    User::create([

                        'name'=>$dealer->contactPersonName,
                        'email'=>$dealer->contactPersonEmail,
                        'phone_number'=>$dealer->contactPersonPhone,
                        'password'=>Hash::make('password'),
                        'department'=>2,
                        'status'=>'ACTIVE',
                        'institution_id'=>$dealer->id,
    
                    ]);
    
                   
                    
                    // Save documents
                    $this->savePartnerDocuments($dealer->id, 'car_dealer');
                    
                  
                    
                    // Log activity
                    $this->logActivity(
                        'car_dealer_created',
                        'CarDealer',
                        $dealer->id,
                        'Created new car dealer: ' . $this->name
                    );



                    
                }catch(\Exception $e){

                    dd("saved".$e->getMessage());
                    

                }

              
                
                Session::flash('message', 'Car dealer registration submitted for approval');
            }
            
            Session::flash('alert-class', 'alert-success');
            $this->closeModal();
            $this->loadPartners();
            
        } catch (\Exception $e) {
            Session::flash('error', 'Error processing request: ' . $e->getMessage());
        }
    }
    
    /**
     * Prepare car dealer data for saving
     */
    private function prepareCarDealerData($logoPath = null)
    {

        return [
            'name' => $this->name,
            'business_registration_number' => $this->businessRegistrationNumber,
            'tax_identification_number' => $this->taxIdentificationNumber,
            'address' => $this->address,
            'city' => $this->city,
            'region' => $this->region,
            'postal_code' => $this->postalCode,
            'country' => $this->country,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'website' => $this->website,
            'logo' => $logoPath ?: ($this->isEditMode ? CarDealer::find($this->carDealerId)->logo : null),
            'contact_person_name' => $this->contactPersonName,
            'contact_person_position' => $this->contactPersonPosition,
            'contact_person_phone' => $this->contactPersonPhone,
            'contact_person_email' => $this->contactPersonEmail,
            'dealer_type' => $this->dealerType,
            'brands_sold' => json_encode($this->selectedBrands),
            'year_established' => $this->establishedYear,
            'showroom_address' => $this->showroomAddress,
            'service_center' => $this->serviceCenter,
            'inventory_size' => $this->inventorySize,
            'servicesOffered'=> json_encode($this->servicesOffered),
        ];
    }
    
    /**
     * Create an approval request
     */
    private function createApprovalRequest($processName, $description, $processCode, $processId, $editPackage = null)
    {
        return Approvals::create([
            'institution' => '',
            'process_name' => $processName,
            'process_description' => $description,
            'approval_process_description' => '',
            'process_code' => $processCode,
            'process_id' => $processId,
            'process_status' => 'PENDING',
            'approval_status' => 'PENDING',
            'user_id' => Auth::id(),
            'team_id' => '',
            'edit_package' => $editPackage,
        ]);
    }
    
    /**
     * Log activity
     */
    private function logActivity($action, $entityType, $entityId, $description = null)
    {
        return ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
    
    /**
     * Load lender data for editing
     */
    public function editLender($id)
    {
        $lender = Lender::find($id);
        if (!$lender) {
            Session::flash('error', 'Lender not found');
            return;
        }
        
        $this->lenderId = $lender->id;
        $this->name = $lender->name;
        $this->businessRegistrationNumber = $lender->business_registration_number;
        $this->taxIdentificationNumber = $lender->tax_identification_number;
        $this->address = $lender->address;
        $this->city = $lender->city;
        $this->region = $lender->region;
        $this->updatedRegion($lender->region);
        $this->postalCode = $lender->postal_code;
        $this->country = $lender->country;
        $this->phoneNumber = $lender->phone_number;
        $this->email = $lender->email;
        $this->website = $lender->website;
        // Logo is not loaded here as it's a file
        $this->contactPersonName = $lender->contact_person_name;
        $this->contactPersonPosition = $lender->contact_person_position;
        $this->contactPersonPhone = $lender->contact_person_phone;
        $this->contactPersonEmail = $lender->contact_person_email;
        $this->lenderType = $lender->lender_type;
        $this->interestRateRange = $lender->interest_rate_range;
        $this->loanTermsRange = $lender->loan_terms_range;
        $this->minimumLoanAmount = $lender->minimum_loan_amount;
        $this->maximumLoanAmount = $lender->maximum_loan_amount;
        $this->bankAccountDetails = $lender->bank_account_details;
        $this->financialLicenseNumber = $lender->financial_license_number;
        $this->operatingHours = $lender->operating_hours;
        $this->servicesOffered = json_decode($lender->services_offered) ?: [];
        $this->additionalNotes = $lender->additional_notes;
        $this->paymentMethods = json_decode($lender->payment_methods) ?: [];
        $this->settlementPeriod = $lender->settlement_period;
        
        $this->isEditMode = true;
        $this->currentStep = 1;
        $this->showLenderModal = true;
    }
    
    /**
     * View lender details
     */
    public function viewLender($id)
    {
        return redirect()->route('lender.view', $id);
    }
    
    /**
     * Approve lender
     */
    public function approveLender($id)
    {
        try {
            $lender = Lender::findOrFail($id);
            $lender->status = 'APPROVED';
            $lender->save();
            
            // Update approval record
            $approval = Approvals::where('process_id', $id)
                ->where('process_name', 'addLender')
                ->where('approval_status', 'PENDING')
                ->first();
                
            if ($approval) {
                $approval->process_status = 'APPROVED';
                $approval->approval_status = 'APPROVED';
                $approval->save();
            }
            
            // Log activity
            $this->logActivity(
                'lender_approved',
                'Lender',
                $id,
                'Approved lender: ' . $lender->name
            );
            
            Session::flash('message', 'Lender has been approved successfully');
            Session::flash('alert-class', 'alert-success');
            
        } catch (\Exception $e) {
            Session::flash('error', 'Error approving lender: ' . $e->getMessage());
        }
        
        $this->loadPartners();
    }
    
    /**
     * Reject lender
     */
    public function rejectLender($id)
    {
        try {
            $lender = Lender::findOrFail($id);
            $lender->status = 'REJECTED';
            $lender->save();
            
            // Update approval record
            $approval = Approvals::where('process_id', $id)
                ->where('process_name', 'addLender')
                ->where('approval_status', 'PENDING')
                ->first();
                
            if ($approval) {
                $approval->process_status = 'REJECTED';
                $approval->approval_status = 'REJECTED';
                $approval->save();
            }
            
            // Log activity
            $this->logActivity(
                'lender_rejected',
                'Lender',
                $id,
                'Rejected lender: ' . $lender->name
            );
            
            Session::flash('message', 'Lender has been rejected');
            Session::flash('alert-class', 'alert-danger');
            
        } catch (\Exception $e) {
            Session::flash('error', 'Error rejecting lender: ' . $e->getMessage());
        }
        
        $this->loadPartners();
    }
    
    /**
     * Load car dealer data for editing
     */
    public function editCarDealer($id)
    {
        $dealer = CarDealer::find($id);
        if (!$dealer) {
            Session::flash('error', 'Car dealer not found');
            return;
        }
        
        $this->carDealerId = $dealer->id;
        $this->name = $dealer->name;
        $this->businessRegistrationNumber = $dealer->business_registration_number;
        $this->taxIdentificationNumber = $dealer->tax_identification_number;
        $this->address = $dealer->address;
        $this->city = $dealer->city;
        $this->region = $dealer->region;
        $this->updatedRegion($dealer->region);
        $this->postalCode = $dealer->postal_code;
        $this->country = $dealer->country;
        $this->phoneNumber = $dealer->phone_number;
        $this->email = $dealer->email;
        $this->website = $dealer->website;
        // Logo is not loaded here as it's a file
        $this->contactPersonName = $dealer->contact_person_name;
        $this->contactPersonPosition = $dealer->contact_person_position;
        $this->contactPersonPhone = $dealer->contact_person_phone;
        $this->contactPersonEmail = $dealer->contact_person_email;
        $this->dealerType = $dealer->dealer_type;
        $this->selectedBrands = json_decode($dealer->brands_sold) ?: [];
        $this->establishedYear = $dealer->year_established;
        $this->showroomAddress = $dealer->showroom_address;
        $this->serviceCenter = $dealer->service_center;
        $this->inventorySize = $dealer->inventory_size;
        
        $this->isEditMode = true;
        $this->currentStep = 1;
        $this->showCarDealerModal = true;
    }
    
    /**
     * View car dealer details
     */
    public function viewCarDealer($id)
    {
        return redirect()->route('car-dealer.view', $id);
    }
    
    /**
     * Approve car dealer
     */
    public function approveCarDealer($id)
    {
        try {
            $dealer = CarDealer::findOrFail($id);
            $dealer->status = 'APPROVED';
            $dealer->save();
            
            // Update approval record
            $approval = Approvals::where('process_id', $id)
                ->where('process_name', 'addCarDealer')
                ->where('approval_status', 'PENDING')
                ->first();
                
            if ($approval) {
                $approval->process_status = 'APPROVED';
                $approval->approval_status = 'APPROVED';
                $approval->save();
            }
            
            // Log activity
            $this->logActivity(
                'car_dealer_approved',
                'CarDealer',
                $id,
                'Approved car dealer: ' . $dealer->name
            );
            
            Session::flash('message', 'Car dealer has been approved successfully');
            Session::flash('alert-class', 'alert-success');
            
        } catch (\Exception $e) {
            Session::flash('error', 'Error approving car dealer: ' . $e->getMessage());
        }
        
        $this->loadPartners();
    }
    
    /**
     * Reject car dealer
     */
    public function rejectCarDealer($id)
    {
        try {
            $dealer = CarDealer::findOrFail($id);
            $dealer->status = 'REJECTED';
            $dealer->save();
            
            // Update approval record
            $approval = Approvals::where('process_id', $id)
                ->where('process_name', 'addCarDealer')
                ->where('approval_status', 'PENDING')
                ->first();
                
            if ($approval) {
                $approval->process_status = 'REJECTED';
                $approval->approval_status = 'REJECTED';
                $approval->save();
            }
            
            // Log activity
            $this->logActivity(
                'car_dealer_rejected',
                'CarDealer',
                $id,
                'Rejected car dealer: ' . $dealer->name
            );
            
            Session::flash('message', 'Car dealer has been rejected');
            Session::flash('alert-class', 'alert-danger');
            
        } catch (\Exception $e) {
            Session::flash('error', 'Error rejecting car dealer: ' . $e->getMessage());
        }
        
        $this->loadPartners();
    }



    public function openPartnerSelectionModal()
{
    $this->resetErrorBag();
    $this->showPartnerSelectionModal = true;
}

public function exportData()
{
    // Generate and download the CSV/Excel file
    $lenders = Lender::all();
    $carDealers = CarDealer::all();
    
    return response()->streamDownload(function() use ($lenders, $carDealers) {
        $output = fopen('php://output', 'w');
        
        // Headers
        fputcsv($output, ['Type', 'Name', 'Business Registration', 'Tax ID', 'Contact Person', 'Status', 'Created At']);
        
        // Lender data
        foreach ($lenders as $lender) {
            fputcsv($output, [
                'Lender', 
                $lender->name, 
                $lender->business_registration_number,
                $lender->tax_identification_number,
                $lender->contact_person_name,
                $lender->status,
                $lender->created_at
            ]);
        }
        
        // Car dealer data
        foreach ($carDealers as $dealer) {
            fputcsv($output, [
                'Car Dealer', 
                $dealer->name, 
                $dealer->business_registration_number,
                $dealer->tax_identification_number,
                $dealer->contact_person_name,
                $dealer->status,
                $dealer->created_at
            ]);
        }
        
        fclose($output);
    }, 'partners-export-' . date('Y-m-d') . '.csv');
}


public function getStatisticsData()
{
    $totalLenders = $this->lenders->count();
    $totalDealers = $this->carDealers->count();
    $pendingApprovals = $this->lenders->where('status', 'PENDING')->count() + 
                        $this->carDealers->where('status', 'PENDING')->count();
                        
    // Calculate growth percentages (last 30 days)
    $thirtyDaysAgo = now()->subDays(30);
    $newLenders = $this->lenders->where('created_at', '>=', $thirtyDaysAgo)->count();
    $lenderGrowth = $totalLenders > 0 ? round(($newLenders / $totalLenders) * 100) : 0;
    
    $newDealers = $this->carDealers->where('created_at', '>=', $thirtyDaysAgo)->count();
    $dealerGrowth = $totalDealers > 0 ? round(($newDealers / $totalDealers) * 100) : 0;
    
    $newPendingApprovals = $this->lenders->where('status', 'PENDING')
                           ->where('created_at', '>=', $thirtyDaysAgo)->count() +
                           $this->carDealers->where('status', 'PENDING')
                           ->where('created_at', '>=', $thirtyDaysAgo)->count();
    
    return [
        'totalLenders' => $totalLenders,
        'totalDealers' => $totalDealers,
        'pendingApprovals' => $pendingApprovals,
        'lenderGrowth' => $lenderGrowth,
        'dealerGrowth' => $dealerGrowth,
        'newPendingApprovals' => $newPendingApprovals
    ];
}




// Control step navigation
public function setStep($step)
{
    // Validate current step before allowing to proceed
    if ($step > $this->currentStep) {
        $this->validateCurrentStep();
    }
    
    $this->currentStep = $step;
}

public function nextStep()
{

    
    $this->validateCurrentStep();
    
    if ($this->currentStep < $this->totalSteps) {
        $this->currentStep++;
    }
}


public function nextStepCarDealer()
{
   $this->validateCarDealerInputs();
    
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

// Validate based on current step
protected function validateCurrentStep()
{
    switch ($this->currentStep) {
        case 1:
            $this->validate([
                'name' => 'required|string|max:255',
                'businessRegistrationNumber' => 'required|string|max:50',
                'taxIdentificationNumber' => 'required|string|max:50',
                'address' => 'required|string',
                'region' => 'required|string',
                'city' => 'required|string',
                'phoneNumber' => 'required',
                'email' => 'required|email',
                'contactPersonName' => 'required|string',
                'contactPersonPhone' => 'required',
                'contactPersonEmail' => 'required|email',
            ]);
            break;
            
        case 2:
            if ($this->activeTab == 'lender') {
                $this->validate([
                    'lenderType' => 'required',
                    'minimumLoanAmount' => 'required|numeric|min:0',
                    'maximumLoanAmount' => 'required|numeric|gt:minimumLoanAmount',
                    'interestRateRange' => 'required|string',
                    'loanTermsRange' => 'required|string',
                    'bankAccountDetails' => 'required|string',
                ]);
            } else {
                $this->validate([
                    'dealerType' => 'required',
                    'selectedBrands' => 'required|array|min:1',
                    'establishedYear' => 'required|integer|min:1900|max:' . date('Y'),
                    'inventorySize' => 'required|integer|min:1',
                ]);
            }
            break;
            
        case 3:
            if ($this->activeTab == 'lender') {
                $this->validate([
                    'businessRegistrationDoc' => $this->isEditMode ? 'nullable' : 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'taxClearanceDoc' => $this->isEditMode ? 'nullable' : 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'financialLicenseDoc' => $this->isEditMode ? 'nullable' : 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                ]);
            } else {
                $this->validate([
                    'businessRegistrationDoc' => $this->isEditMode ? 'nullable' : 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                    'taxClearanceDoc' => $this->isEditMode ? 'nullable' : 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
                ]);
            }
            break;
    }
}




/**
 * Get filtered lenders for the current page
 * This is a computed property that Livewire can access directly in the template
 * 
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
public function getFilteredLendersProperty()
{
    return Lender::query()
        ->when($this->search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('business_registration_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('contact_person_name', 'like', "%{$search}%");
            });
        })
        ->when($this->statusFilter, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($this->regionFilter, function ($query, $region) {
            return $query->where('region', $region);
        })
        ->when($this->dateFilter, function ($query, $dateFilter) {
            if ($dateFilter === 'today') {
                return $query->whereDate('created_at', now());
            } elseif ($dateFilter === 'this_week') {
                return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($dateFilter === 'this_month') {
                return $query->whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year);
            } elseif ($dateFilter === 'this_year') {
                return $query->whereYear('created_at', now()->year);
            }
        })
        ->latest()
        ->paginate(10);
}

/**
 * Get filtered car dealers for the current page
 * This is a computed property that Livewire can access directly in the template
 * 
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
public function getFilteredCarDealersProperty()
{
    return CarDealer::query()
        ->when($this->search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('business_registration_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('contact_person_name', 'like', "%{$search}%");
            });
        })
        ->when($this->statusFilter, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($this->regionFilter, function ($query, $region) {
            return $query->where('region', $region);
        })
        ->when($this->dateFilter, function ($query, $dateFilter) {
            if ($dateFilter === 'today') {
                return $query->whereDate('created_at', now());
            } elseif ($dateFilter === 'this_week') {
                return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($dateFilter === 'this_month') {
                return $query->whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year);
            } elseif ($dateFilter === 'this_year') {
                return $query->whereYear('created_at', now()->year);
            }
        })
        ->latest()
        ->paginate(10);
}

/**
 * Get pending approvals for the current page
 * This is a computed property that Livewire can access directly in the template
 * 
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
public function getPendingApprovalsProperty()
{
    $lenders = Lender::where('status', 'PENDING')->get();
    $carDealers = CarDealer::where('status', 'PENDING')->get();
    
    // Combine and paginate manually
    $combined = collect()
        ->concat($lenders->map(function($item) {
            $item['partner_type'] = 'lender';
            return $item;
        }))
        ->concat($carDealers->map(function($item) {
            $item['partner_type'] = 'carDealer';
            return $item;
        }))
        ->sortByDesc('created_at');
    
    // Manual pagination
    $page = request()->get('page', 1);
    $perPage = 10;
    $total = $combined->count();
    
    $items = $combined->forPage($page, $perPage);
    
    return new \Illuminate\Pagination\LengthAwarePaginator(
        $items,
        $total,
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );
}




/**
 * Get filtered car dealers 
 * This is a computed property Livewire uses in the blade
 */



}