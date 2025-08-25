<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ImportDutyApplication;
use App\Models\LenderFinancingOffer;
use App\Models\Lender;
use App\Models\Application;
use App\Models\CFQuotation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LenderDashboard extends Component
{
    use WithPagination;

    public $activeTab = 'import-duty-requests';
    public $statusFilter = '';
    public $searchTerm = '';
    public $lender;

    // Financing offer form properties
    public $selectedApplication;
    public $showOfferModal = false;
    public $editingOffer = null;
    public $isEditing = false;
    
    // Financing details
    public $down_payment_required = 0;
    public $interest_rate_annual = 18.0;
    public $loan_tenure_months = 36;
    public $processing_fee = 0;
    public $insurance_fee = 0;
    public $legal_fee = 0;
    public $other_fees = 0;
    
    // Calculated amounts
    public $loan_amount = 0;
    public $monthly_installment = 0;
    public $total_repayment = 0;
    public $total_fees = 0;
    
    // Requirements
    public $minimum_income_required;
    public $employment_type_required = 'Formal Employment';
    public $collateral_required;
    public $guarantor_required = false;
    public $additional_requirements;
    
    // Offer terms
    public $validity_hours = 48;
    public $conditions;

    // View offer modal
    public $showViewModal = false;
    public $viewingOffer = null;

    // Mark as completed modal
    public $showCompletedModal = false;
    public $completedApplication = null;
    public $completion_notes = '';

    protected $rules = [
        'down_payment_required' => 'required|numeric|min:0',
        'interest_rate_annual' => 'required|numeric|min:0|max:50',
        'loan_tenure_months' => 'required|integer|min:12|max:84',
        'processing_fee' => 'nullable|numeric|min:0',
        'insurance_fee' => 'nullable|numeric|min:0',
        'legal_fee' => 'nullable|numeric|min:0',
        'other_fees' => 'nullable|numeric|min:0',
        'minimum_income_required' => 'nullable|numeric|min:0',
        'employment_type_required' => 'required|string',
        'collateral_required' => 'nullable|string',
        'validity_hours' => 'required|integer|min:12|max:168',
        'conditions' => 'nullable|string|max:1000',
        'completion_notes' => 'required|string|max:500',
    ];

    public function mount()
    {
        // Try different methods to get lender
        $this->lender = Lender::where('email', Auth::user()->email)->first() 
                     ?? Lender::where('id', Auth::user()->institution_id)->first()
                     ?? Lender::where('contact_person_email', Auth::user()->email)->first();
        
        if (!$this->lender) {
            abort(403, 'Lender profile not found for this user.');
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function openOfferModal($applicationId)
    {
        $this->selectedApplication = ImportDutyApplication::with([
            'cfQuotations' => function($query) {
                $query->where('status', 'SELECTED');
            }
        ])->findOrFail($applicationId);
        
        $this->resetOfferForm();
        $this->isEditing = false;
        $this->editingOffer = null;
        
        // Pre-calculate suggested down payment (20% of total duty amount)
        $selectedQuotation = $this->selectedApplication->cfQuotations->first();
        if ($selectedQuotation) {
            $totalAmount = $selectedQuotation->grand_total;
            $this->down_payment_required = round($totalAmount * 0.20, 2);
            $this->calculateLoanDetails();
        }
        
        $this->showOfferModal = true;
    }

    public function editOffer($offerId)
    {
        $this->editingOffer = LenderFinancingOffer::with('application.cfQuotations')->findOrFail($offerId);
        
        if ($this->editingOffer->lender_id !== $this->lender->id) {
            session()->flash('error', 'Unauthorized action.');
            return;
        }

        if (!$this->editingOffer->canBeModified()) {
            session()->flash('error', 'This offer can no longer be modified.');
            return;
        }

        $this->selectedApplication = $this->editingOffer->application;
        $this->isEditing = true;
        
        // Load existing offer data
        $this->down_payment_required = $this->editingOffer->down_payment_required;
        $this->interest_rate_annual = $this->editingOffer->interest_rate_annual;
        $this->loan_tenure_months = $this->editingOffer->loan_tenure_months;
        $this->processing_fee = $this->editingOffer->processing_fee;
        $this->insurance_fee = $this->editingOffer->insurance_fee;
        $this->legal_fee = $this->editingOffer->legal_fee;
        $this->other_fees = $this->editingOffer->other_fees;
        $this->minimum_income_required = $this->editingOffer->minimum_income_required;
        $this->employment_type_required = $this->editingOffer->employment_type_required;
        $this->collateral_required = $this->editingOffer->collateral_required;
        $this->guarantor_required = $this->editingOffer->guarantor_required;
        $this->additional_requirements = $this->editingOffer->additional_requirements;
        $this->validity_hours = $this->editingOffer->validity_hours;
        $this->conditions = $this->editingOffer->conditions;
        
        $this->calculateLoanDetails();
        $this->showOfferModal = true;
    }

    public function viewOffer($offerId)
    {
        $this->viewingOffer = LenderFinancingOffer::with(['application', 'lender'])->findOrFail($offerId);
        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->viewingOffer = null;
    }

    public function openCompletedModal($applicationId)
    {
        $this->completedApplication = ImportDutyApplication::findOrFail($applicationId);
        $this->completion_notes = '';
        $this->showCompletedModal = true;
    }

    public function closeCompletedModal()
    {
        $this->showCompletedModal = false;
        $this->completedApplication = null;
        $this->completion_notes = '';
    }

    public function markAsCompleted()
    {
        $this->validate([
            'completion_notes' => 'required|string|max:500',
        ]);

        try {
            $this->completedApplication->update([
                'status' => 'COMPLETED',
                'completion_notes' => $this->completion_notes,
                'completed_at' => now(),
            ]);

            session()->flash('success', 'Application marked as completed successfully.');
            $this->closeCompletedModal();

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the application.');
            \Log::error('Application completion error: ' . $e->getMessage());
        }
    }

    public function closeOfferModal()
    {
        $this->showOfferModal = false;
        $this->selectedApplication = null;
        $this->editingOffer = null;
        $this->isEditing = false;
        $this->resetOfferForm();
        $this->resetValidation();
    }

    protected function resetOfferForm()
    {
        $this->down_payment_required = 0;
        $this->interest_rate_annual = 18.0;
        $this->loan_tenure_months = 36;
        $this->processing_fee = 0;
        $this->insurance_fee = 0;
        $this->legal_fee = 0;
        $this->other_fees = 0;
        $this->loan_amount = 0;
        $this->monthly_installment = 0;
        $this->total_repayment = 0;
        $this->total_fees = 0;
        $this->minimum_income_required = null;
        $this->employment_type_required = 'Formal Employment';
        $this->collateral_required = '';
        $this->guarantor_required = false;
        $this->additional_requirements = '';
        $this->validity_hours = 48;
        $this->conditions = '';
    }

    public function updatedDownPaymentRequired()
    {
        $this->calculateLoanDetails();
    }

    public function updatedInterestRateAnnual()
    {
        $this->calculateLoanDetails();
    }

    public function updatedLoanTenureMonths()
    {
        $this->calculateLoanDetails();
    }

    public function updatedProcessingFee()
    {
        $this->calculateTotalFees();
    }

    public function updatedInsuranceFee()
    {
        $this->calculateTotalFees();
    }

    public function updatedLegalFee()
    {
        $this->calculateTotalFees();
    }

    public function updatedOtherFees()
    {
        $this->calculateTotalFees();
    }

    protected function calculateLoanDetails()
    {
        if (!$this->selectedApplication || !$this->selectedApplication->cfQuotations->first()) {
            return;
        }

        $selectedQuotation = $this->selectedApplication->cfQuotations->first();
        $totalFinancingAmount = $selectedQuotation->grand_total;
        
        // Calculate loan amount after down payment
        $this->loan_amount = max(0, $totalFinancingAmount - $this->down_payment_required);
        
        // Calculate monthly installment using PMT formula
        if ($this->loan_amount > 0 && $this->loan_tenure_months > 0 && $this->interest_rate_annual > 0) {
            $monthlyRate = ($this->interest_rate_annual / 100) / 12;
            
            // PMT formula: P * [r(1+r)^n] / [(1+r)^n - 1]
            $denominator = pow(1 + $monthlyRate, $this->loan_tenure_months) - 1;
            if ($denominator > 0) {
                $this->monthly_installment = round(
                    ($this->loan_amount * $monthlyRate * pow(1 + $monthlyRate, $this->loan_tenure_months)) / $denominator,
                    2
                );
            } else {
                $this->monthly_installment = round($this->loan_amount / $this->loan_tenure_months, 2);
            }
            
            $this->total_repayment = round($this->monthly_installment * $this->loan_tenure_months, 2);
        } else {
            $this->monthly_installment = 0;
            $this->total_repayment = 0;
        }

        $this->calculateTotalFees();
    }

    protected function calculateTotalFees()
    {
        $this->total_fees = ($this->processing_fee ?? 0) + 
                           ($this->insurance_fee ?? 0) + 
                           ($this->legal_fee ?? 0) + 
                           ($this->other_fees ?? 0);
    }

    public function submitOffer()
    {
        $this->validate();

        try {
            $selectedQuotation = $this->selectedApplication->cfQuotations->first();
            $totalFinancingAmount = $selectedQuotation->grand_total;

            if ($this->isEditing && $this->editingOffer) {
                // Update existing offer
                $this->editingOffer->update([
                    'total_financing_amount' => $totalFinancingAmount,
                    'down_payment_required' => $this->down_payment_required,
                    'loan_amount' => $this->loan_amount,
                    'interest_rate_annual' => $this->interest_rate_annual,
                    'loan_tenure_months' => $this->loan_tenure_months,
                    'monthly_installment' => $this->monthly_installment,
                    'total_repayment' => $this->total_repayment,
                    'processing_fee' => $this->processing_fee ?? 0,
                    'insurance_fee' => $this->insurance_fee ?? 0,
                    'legal_fee' => $this->legal_fee ?? 0,
                    'other_fees' => $this->other_fees ?? 0,
                    'total_fees' => $this->total_fees,
                    'minimum_income_required' => $this->minimum_income_required,
                    'employment_type_required' => $this->employment_type_required,
                    'collateral_required' => $this->collateral_required,
                    'guarantor_required' => $this->guarantor_required,
                    'additional_requirements' => $this->additional_requirements,
                    'validity_hours' => $this->validity_hours,
                    'conditions' => $this->conditions,
                    'expires_at' => now()->addHours($this->validity_hours),
                ]);

                session()->flash('success', 'Financing offer updated successfully!');
            } else {
                // Check if offer already exists
                $existingOffer = LenderFinancingOffer::where('application_id', $this->selectedApplication->id)
                    ->where('lender_id', $this->lender->id)
                    ->where('status', '!=', 'WITHDRAWN')
                    ->first();

                if ($existingOffer) {
                    session()->flash('error', 'You have already submitted an offer for this application.');
                    return;
                }

                // Generate offer number
                $offerNumber = 'LO' . $this->lender->id . date('Y') . str_pad(LenderFinancingOffer::count() + 1, 4, '0', STR_PAD_LEFT);

                // Calculate priority order
                $existingOffers = LenderFinancingOffer::where('application_id', $this->selectedApplication->id)
                    ->where('status', 'SUBMITTED')
                    ->count();
                $priorityOrder = $existingOffers + 1;

                LenderFinancingOffer::create([
                    'application_id' => $this->selectedApplication->id,
                    'lender_id' => $this->lender->id,
                    'offer_number' => $offerNumber,
                    'total_financing_amount' => $totalFinancingAmount,
                    'down_payment_required' => $this->down_payment_required,
                    'loan_amount' => $this->loan_amount,
                    'interest_rate_annual' => $this->interest_rate_annual,
                    'loan_tenure_months' => $this->loan_tenure_months,
                    'monthly_installment' => $this->monthly_installment,
                    'total_repayment' => $this->total_repayment,
                    'processing_fee' => $this->processing_fee ?? 0,
                    'insurance_fee' => $this->insurance_fee ?? 0,
                    'legal_fee' => $this->legal_fee ?? 0,
                    'other_fees' => $this->other_fees ?? 0,
                    'total_fees' => $this->total_fees,
                    'minimum_income_required' => $this->minimum_income_required,
                    'employment_type_required' => $this->employment_type_required,
                    'collateral_required' => $this->collateral_required,
                    'guarantor_required' => $this->guarantor_required,
                    'additional_requirements' => $this->additional_requirements,
                    'status' => 'SUBMITTED',
                    'priority_order' => $priorityOrder,
                    'validity_hours' => $this->validity_hours,
                    'conditions' => $this->conditions,
                    'submitted_at' => now(),
                    'expires_at' => now()->addHours($this->validity_hours),
                    'response_deadline' => now()->addHours(72),
                ]);

                // Update application status if this is the first lender offer
                if (LenderFinancingOffer::where('application_id', $this->selectedApplication->id)->count() == 1) {
                    $this->selectedApplication->update(['status' => 'LENDER_REVIEW']);
                }

                session()->flash('success', 'Financing offer submitted successfully! Offer Number: ' . $offerNumber);
            }

            $this->closeOfferModal();

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while submitting the offer.');
            \Log::error('Lender offer submission error: ' . $e->getMessage());
        }
    }

    public function getApplications()
    {
        $query = ImportDutyApplication::query();

        switch ($this->activeTab) {
            case 'import-duty-requests':
                $query->where('status', 'CF_SELECTED')
                    ->whereHas('cfQuotations', function($q) {
                        $q->where('status', 'SELECTED');
                    })
                    ->whereDoesntHave('lenderFinancingOffers', function($q) {
                        $q->where('lender_id', $this->lender->id);
                    });
                break;
            
            case 'my-offers':
                $query->whereHas('lenderFinancingOffers', function($q) {
                    $q->where('lender_id', $this->lender->id);
                });
                break;
            
            case 'accepted':
                $query->where('selected_lender_id', $this->lender->id)
                    ->whereHas('lenderFinancingOffers', function($q) {
                        $q->where('lender_id', $this->lender->id)
                          ->where('status', 'ACCEPTED');
                    });
                break;

            case 'rejected':
                $query->whereHas('lenderFinancingOffers', function($q) {
                    $q->where('lender_id', $this->lender->id)
                      ->where('status', 'REJECTED');
                });
                break;
        }

        if ($this->statusFilter) {
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

        return $query->with([
            'cfQuotations' => function($q) {
                $q->where('status', 'SELECTED');
            },
            'lenderFinancingOffers' => function($q) {
                $q->where('lender_id', $this->lender->id);
            }
        ])->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getStats()
    {
        return [
            'new_requests' => ImportDutyApplication::where('status', 'CF_SELECTED')
                ->whereHas('cfQuotations', function($q) {
                    $q->where('status', 'SELECTED');
                })
                ->whereDoesntHave('lenderFinancingOffers', function($q) {
                    $q->where('lender_id', $this->lender->id);
                })->count(),
            'my_offers' => LenderFinancingOffer::where('lender_id', $this->lender->id)->count(),
            'accepted' => LenderFinancingOffer::where('lender_id', $this->lender->id)
                ->where('status', 'ACCEPTED')->count(),
            'rejected' => LenderFinancingOffer::where('lender_id', $this->lender->id)
                ->where('status', 'REJECTED')->count(),
            'total_value' => LenderFinancingOffer::where('lender_id', $this->lender->id)
                ->where('status', 'ACCEPTED')->sum('loan_amount'),
            'pending_expiry' => LenderFinancingOffer::where('lender_id', $this->lender->id)
                ->where('status', 'SUBMITTED')
                ->where('expires_at', '<=', Carbon::now()->addHours(24))
                ->count(),
        ];
    }
    public function render()
    {
        $applications = $this->getApplications();
        $stats = $this->getStats();

        return view('livewire.admin.lender-dashboard', [
            'applications' => $applications,
            'stats' => $stats,
        ]);
    }
}