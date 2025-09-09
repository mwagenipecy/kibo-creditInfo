<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ImportDutyApplication;
use App\Models\CFQuotation;
use App\Models\ClearingForwardingCompany;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CFCompanyOffers extends Component
{
    use WithPagination;

    public $activeTab = 'new-applications';
    public $statusFilter = '';
    public $searchTerm = '';
    public $showQuotationModal = false;
    public $selectedApplication;
    public $cfCompany;

    // Mark as completed modal
    public $showCfCompletedModal = false;
    public $cfCompletedApplication = null;
    public $cf_completion_notes = '';

    // View quotation modal
    public $showViewQuotationModal = false;
    public $viewQuotation = null;
    public $showEditQuotationModal = false;
    public $editQuotation = null;

    // Quotation form properties
    public $tra_reference_number = '';
    public $import_duty = 0;
    public $vat_amount = 0;
    public $railway_development_levy = 0;
    public $excise_duty = 0;
    public $service_levy = 0;
    public $other_charges = 0;
    public $clearing_fee = 0;
    public $forwarding_fee = 0;
    public $documentation_fee = 0;
    public $port_charges = 0;
    public $transportation_fee = 0;
    public $storage_charges = 0;
    public $other_service_fees = 0;
    public $estimated_clearance_days = 7;
    public $validity_days = 7;
    public $payment_terms = 'Payment required before clearance';
    public $special_notes = '';

    protected $rules = [
        'tra_reference_number' => 'required|string|max:100',
        'import_duty' => 'required|numeric|min:0',
        'vat_amount' => 'required|numeric|min:0',
        'railway_development_levy' => 'required|numeric|min:0',
        'excise_duty' => 'nullable|numeric|min:0',
        'service_levy' => 'nullable|numeric|min:0',
        'other_charges' => 'nullable|numeric|min:0',
        'clearing_fee' => 'required|numeric|min:0',
        'forwarding_fee' => 'required|numeric|min:0',
        'documentation_fee' => 'required|numeric|min:0',
        'port_charges' => 'nullable|numeric|min:0',
        'transportation_fee' => 'nullable|numeric|min:0',
        'storage_charges' => 'nullable|numeric|min:0',
        'other_service_fees' => 'nullable|numeric|min:0',
        'estimated_clearance_days' => 'required|integer|min:1|max:30',
        'validity_days' => 'required|integer|min:3|max:30',
        'payment_terms' => 'required|string|max:255',
        'special_notes' => 'nullable|string|max:1000',
        'cf_completion_notes' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->cfCompany = ClearingForwardingCompany::where('email', Auth::user()->email)->first();
        
        if (!$this->cfCompany) {
            abort(403, 'CF Company not found for this user.');
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
        // Reset filters that could hide data when switching tabs
        $this->statusFilter = '';
        $this->searchTerm = '';
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function openQuotationModal($applicationId)
    {
        $this->selectedApplication = ImportDutyApplication::findOrFail($applicationId);
        $this->resetQuotationForm();
        $this->showQuotationModal = true;
    }

    public function openEditQuotation($quotationId)
    {
        $quotation = CFQuotation::where('cf_company_id', $this->cfCompany->id)->findOrFail($quotationId);
        $this->editQuotation = $quotation;
        $this->selectedApplication = ImportDutyApplication::findOrFail($quotation->application_id);

        // Prefill form fields from existing quotation
        $this->tra_reference_number = $quotation->tra_reference_number;
        $this->import_duty = $quotation->import_duty;
        $this->vat_amount = $quotation->vat_amount;
        $this->railway_development_levy = $quotation->railway_development_levy;
        $this->excise_duty = $quotation->excise_duty;
        $this->service_levy = $quotation->service_levy;
        $this->other_charges = $quotation->other_charges;
        $this->clearing_fee = $quotation->clearing_fee;
        $this->forwarding_fee = $quotation->forwarding_fee;
        $this->documentation_fee = $quotation->documentation_fee;
        $this->port_charges = $quotation->port_charges;
        $this->transportation_fee = $quotation->transportation_fee;
        $this->storage_charges = $quotation->storage_charges;
        $this->other_service_fees = $quotation->other_service_fees;
        $this->estimated_clearance_days = $quotation->estimated_clearance_days;
        $this->validity_days = $quotation->validity_days;
        $this->payment_terms = $quotation->payment_terms;
        $this->special_notes = $quotation->special_notes;

        $this->showEditQuotationModal = true;
    }

    public function openViewQuotation($quotationId)
    {
        $this->viewQuotation = CFQuotation::where('cf_company_id', $this->cfCompany->id)->findOrFail($quotationId);
        $this->showViewQuotationModal = true;
    }

    public function closeViewQuotationModal()
    {
        $this->showViewQuotationModal = false;
        $this->viewQuotation = null;
    }

    public function closeEditQuotationModal()
    {
        $this->showEditQuotationModal = false;
        $this->editQuotation = null;
        $this->resetValidation();
    }

    public function closeQuotationModal()
    {
        $this->showQuotationModal = false;
        $this->selectedApplication = null;
        $this->resetQuotationForm();
        $this->resetValidation();
    }

    public function openCfCompletedModal($applicationId)
    {
        $this->cfCompletedApplication = ImportDutyApplication::findOrFail($applicationId);
        $this->cf_completion_notes = '';
        $this->showCfCompletedModal = true;
    }

    public function closeCfCompletedModal()
    {
        $this->showCfCompletedModal = false;
        $this->cfCompletedApplication = null;
        $this->cf_completion_notes = '';
    }

    public function markCfAsCompleted()
    {
        $this->validate([
            'cf_completion_notes' => 'required|string|max:500',
        ]);

        try {
            $this->cfCompletedApplication->update([
                'status' => 'DUTY_PAID',
                'cf_completion_notes' => $this->cf_completion_notes,
                'cf_completed_at' => now(),
            ]);

            session()->flash('success', 'Clearance process marked as completed successfully.');
            $this->closeCfCompletedModal();

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the application.');
            \Log::error('CF completion error: ' . $e->getMessage());
        }
    }

    protected function resetQuotationForm()
    {
        $this->tra_reference_number = '';
        $this->import_duty = 0;
        $this->vat_amount = 0;
        $this->railway_development_levy = 0;
        $this->excise_duty = 0;
        $this->service_levy = 0;
        $this->other_charges = 0;
        $this->clearing_fee = 0;
        $this->forwarding_fee = 0;
        $this->documentation_fee = 0;
        $this->port_charges = 0;
        $this->transportation_fee = 0;
        $this->storage_charges = 0;
        $this->other_service_fees = 0;
        $this->estimated_clearance_days = 7;
        $this->validity_days = 7;
        $this->payment_terms = 'Payment required before clearance';
        $this->special_notes = '';
    }

    public function submitQuotation()
    {


        try {

            $this->validate();

            // Check if quotation already exists
            $existingQuotation = CFQuotation::where('application_id', $this->selectedApplication->id)
                ->where('cf_company_id', $this->cfCompany->id)
                ->first();

            if ($existingQuotation) {
                session()->flash('error', 'You have already submitted a quotation for this application.');
                return;
            }

            // Calculate totals
            $totalDutiesTaxes = $this->import_duty + $this->vat_amount + $this->railway_development_levy + 
                               $this->excise_duty + $this->service_levy + $this->other_charges;
            
            $totalServiceFees = $this->clearing_fee + $this->forwarding_fee + $this->documentation_fee + 
                               $this->port_charges + $this->transportation_fee + $this->storage_charges + 
                               $this->other_service_fees;
            
            $grandTotal = $totalDutiesTaxes + $totalServiceFees;

            // Generate quotation number
            $quotationNumber = 'Q' . $this->cfCompany->id . date('Y') . str_pad(CFQuotation::count() + 1, 4, '0', STR_PAD_LEFT);

            CFQuotation::create([
                'application_id' => $this->selectedApplication->id,
                'cf_company_id' => $this->cfCompany->id,
                'quotation_number' => $quotationNumber,
                'tra_reference_number' => $this->tra_reference_number,
                'duty_calculation_source' => 'TRA_TANCIS',
                'import_duty' => $this->import_duty,
                'vat_amount' => $this->vat_amount,
                'railway_development_levy' => $this->railway_development_levy,
                'excise_duty' => $this->excise_duty,
                'service_levy' => $this->service_levy,
                'other_charges' => $this->other_charges,
                'total_duties_taxes' => $totalDutiesTaxes,
                'clearing_fee' => $this->clearing_fee,
                'forwarding_fee' => $this->forwarding_fee,
                'documentation_fee' => $this->documentation_fee,
                'port_charges' => $this->port_charges,
                'transportation_fee' => $this->transportation_fee,
                'storage_charges' => $this->storage_charges,
                'other_service_fees' => $this->other_service_fees,
                'total_service_fees' => $totalServiceFees,
                'grand_total' => $grandTotal,
                'estimated_clearance_days' => $this->estimated_clearance_days,
                'validity_days' => $this->validity_days,
                'payment_terms' => $this->payment_terms,
                'special_notes' => $this->special_notes,
                'status' => 'SUBMITTED',
                'submitted_at' => now(),
                'expires_at' => now()->addDays($this->validity_days),
            ]);

            // Update application status if this is the first quotation
            if (CFQuotation::where('application_id', $this->selectedApplication->id)->count() == 1) {
                $this->selectedApplication->update(['status' => 'CF_QUOTATION']);
            }

            session()->flash('success', 'Quotation submitted successfully! Quotation Number: ' . $quotationNumber);
            $this->closeQuotationModal();

        } catch (\Exception $e) {


            // dd("error", $e->getMessage());
            session()->flash('error', 'An error occurred while submitting the quotation.');
            \Log::error('CF quotation submission error: ' . $e->getMessage());
        }
    }

    public function getApplications()
    {
        $query = ImportDutyApplication::query();

        switch ($this->activeTab) {
            case 'new-applications':
                $query->whereIn('status', ['SUBMITTED', 'CF_QUOTATION'])
                    ->whereDoesntHave('cfQuotations', function($q) {
                        $q->where('cf_company_id', $this->cfCompany->id);
                    });
                break;
            
            case 'my-quotations':
                $query->whereHas('cfQuotations', function($q) {
                    $q->where('cf_company_id', $this->cfCompany->id);
                });
                break;
            
            case 'accepted':
                $query->where('selected_cf_company_id', $this->cfCompany->id)
                    ->whereHas('cfQuotations', function($q) {
                        $q->where('cf_company_id', $this->cfCompany->id)
                          ->where('status', 'SELECTED');
                    });
                break;

            case 'rejected':
                $query->whereHas('cfQuotations', function($q) {
                    $q->where('cf_company_id', $this->cfCompany->id)
                      ->whereIn('status', ['NOT_SELECTED', 'EXPIRED']);
                });
                break;
        }

        // In "my-quotations" tab, don't restrict by application status filter (it can hide user's quotations)
        if ($this->statusFilter && $this->activeTab !== 'my-quotations') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('application_number', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('applicant_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('vehicle_make', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('vehicle_model', 'like', '%' . $this->searchTerm . '%');
            });
        }

        return $query->with(['cfQuotations' => function($q) {
            $q->where('cf_company_id', $this->cfCompany->id)
              ->orderBy('created_at', 'desc');
        }])->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getStats()
    {
        return [
            'new_applications' => ImportDutyApplication::whereIn('status', ['SUBMITTED', 'CF_QUOTATION'])
                ->whereDoesntHave('cfQuotations', function($q) {
                    $q->where('cf_company_id', $this->cfCompany->id);
                })->count(),
            'my_quotations' => CFQuotation::where('cf_company_id', $this->cfCompany->id)->count(),
            'accepted' => CFQuotation::where('cf_company_id', $this->cfCompany->id)
                ->where('status', 'SELECTED')->count(),
            'rejected' => CFQuotation::where('cf_company_id', $this->cfCompany->id)
                ->whereIn('status', ['NOT_SELECTED', 'EXPIRED'])->count(),
            'total_value' => CFQuotation::where('cf_company_id', $this->cfCompany->id)
                ->where('status', 'SELECTED')->sum('grand_total'),
            'pending_expiry' => CFQuotation::where('cf_company_id', $this->cfCompany->id)
                ->where('status', 'SUBMITTED')
                ->where('expires_at', '<=', Carbon::now()->addHours(24))
                ->count(),
        ];
    }
    
    public function render()
    {
        $applications = $this->getApplications();
        $stats = $this->getStats();

        return view('livewire.admin.c-f-company-offers', [
            'applications' => $applications,
            'stats' => $stats,
        ]);
    }
}
