<?php

namespace App\Http\Livewire\ImportDuty;


use Livewire\Component;
use App\Models\ImportDutyApplication;
use App\Models\CFQuotation;
use App\Models\LenderFinancingOffer;
use Illuminate\Support\Facades\Auth;

class ImportDutyTracking extends Component
{
    public $application;
    public $selectedQuotationId;
    public $selectedOfferId;
    public $showQuotationModal = false;
    public $showOfferModal = false;
    public $selectedQuotation;
    public $selectedOffer;

    protected $listeners = ['refreshApplication' => '$refresh'];

    public function mount($applicationId)
    {
        $this->application = ImportDutyApplication::with([
            'cfQuotations.cfCompany',
            'lenderOffers.lender',
            'selectedCFCompany',
            'selectedLender',
            'statusHistory'
        ])->findOrFail($applicationId);

        // Ensure user owns this application
        if ($this->application->email !== Auth::user()->email) {
            abort(403, 'Unauthorized access to this application.');
        }
    }

    public function viewQuotation($quotationId)
    {
        $this->selectedQuotation = CFQuotation::with('cfCompany')->findOrFail($quotationId);
        $this->showQuotationModal = true;
    }

    public function closeQuotationModal()
    {
        $this->showQuotationModal = false;
        $this->selectedQuotation = null;
    }

    public function selectQuotation($quotationId)
    {
        try {
            $quotation = CFQuotation::findOrFail($quotationId);
            
            // Update application with selected quotation
            $this->application->update([
                'selected_cf_company_id' => $quotation->cf_company_id,
                'total_duty_amount' => $quotation->grand_total,
                'status' => 'CF_SELECTED'
            ]);

            // Update quotation status
            $quotation->update([
                'status' => 'SELECTED',
                'selected_at' => now()
            ]);

            // Mark other quotations as not selected
            CFQuotation::where('application_id', $this->application->id)
                ->where('id', '!=', $quotationId)
                ->update(['status' => 'NOT_SELECTED']);

            // Refresh application data
            $this->application = $this->application->fresh([
                'cfQuotations.cfCompany',
                'lenderOffers.lender',
                'selectedCFCompany',
                'selectedLender'
            ]);

            // Send notification to lenders
            $this->notifyLenders();

            session()->flash('success', 'CF Company quotation selected successfully! Your application has been sent to lenders for financing offers.');
            $this->closeQuotationModal();

        } catch (\Exception $e) {
            session()->flash('error', 'Error selecting quotation. Please try again.');
            \Log::error('Quotation selection error: ' . $e->getMessage());
        }
    }

    public function viewOffer($offerId)
    {
        $this->selectedOffer = LenderFinancingOffer::with('lender')->findOrFail($offerId);
        $this->showOfferModal = true;
    }

    public function closeOfferModal()
    {
        $this->showOfferModal = false;
        $this->selectedOffer = null;
    }

    public function acceptOffer($offerId)
    {
        try {
            $offer = LenderFinancingOffer::findOrFail($offerId);
            
            // Update offer status
            $offer->update([
                'status' => 'ACCEPTED',
                'accepted_at' => now()
            ]);

            // Update application
            $this->application->update([
                'selected_lender_id' => $offer->lender_id,
                'financing_amount' => $offer->loan_amount,
                'down_payment' => $offer->down_payment_required,
                'loan_tenure_months' => $offer->loan_tenure_months,
                'interest_rate' => $offer->interest_rate_annual,
                'status' => 'APPROVED',
                'approved_at' => now()
            ]);

            // Reject other offers
            LenderFinancingOffer::where('application_id', $this->application->id)
                ->where('id', '!=', $offerId)
                ->update(['status' => 'REJECTED']);

            // Refresh application data
            $this->application = $this->application->fresh([
                'cfQuotations.cfCompany',
                'lenderOffers.lender',
                'selectedCFCompany',
                'selectedLender'
            ]);

            session()->flash('success', 'Financing offer accepted successfully! You will be contacted for next steps.');
            $this->closeOfferModal();

        } catch (\Exception $e) {
            session()->flash('error', 'Error accepting offer. Please try again.');
            \Log::error('Offer acceptance error: ' . $e->getMessage());
        }
    }

    public function rejectOffer($offerId)
    {
        try {
            $offer = LenderFinancingOffer::findOrFail($offerId);
            $offer->update(['status' => 'REJECTED']);

            // Refresh application data
            $this->application = $this->application->fresh([
                'cfQuotations.cfCompany',
                'lenderOffers.lender',
                'selectedCFCompany',
                'selectedLender'
            ]);

            session()->flash('success', 'Offer rejected successfully.');
            $this->closeOfferModal();

        } catch (\Exception $e) {
            session()->flash('error', 'Error rejecting offer. Please try again.');
        }
    }

    protected function notifyLenders()
    {
        // Notify all active lenders about new application
        $lenders = \App\Models\Lender::where('status', 'APPROVED')->get();
        
        foreach ($lenders as $lender) {
         //   \App\Jobs\NotifyLenderNewApplication::dispatch($lender, $this->application);
        }
    }

    public function getAvailableQuotations()
    {
        return $this->application->cfQuotations()
            ->with('cfCompany')
            ->where('status', 'SUBMITTED')
            ->where('expires_at', '>', now())
            ->orderBy('grand_total', 'asc')
            ->get();
    }

    public function getAvailableOffers()
    {
        return $this->application->lenderOffers()
            ->with('lender')
            ->where('status', 'SUBMITTED')
            ->where('expires_at', '>', now())
            ->orderBy('priority_order', 'asc')
            ->orderBy('interest_rate_annual', 'asc')
            ->get();
    }

    public function getPendingActions()
    {
        $actions = [];

        if ($this->application->status === 'CF_QUOTATION') {
            $availableQuotations = $this->getAvailableQuotations();
            if ($availableQuotations->count() > 0) {
                $actions[] = [
                    'type' => 'select_quotation',
                    'title' => 'Select CF Company',
                    'description' => 'You have ' . $availableQuotations->count() . ' quotations available. Compare and select the best option.',
                    'urgency' => 'high'
                ];
            }
        }

        if ($this->application->status === 'LENDER_REVIEW') {
            $availableOffers = $this->getAvailableOffers();
            if ($availableOffers->count() > 0) {
                $actions[] = [
                    'type' => 'review_offers',
                    'title' => 'Review Financing Offers',
                    'description' => 'You have ' . $availableOffers->count() . ' financing offers available. Review and accept the best offer.',
                    'urgency' => 'high'
                ];
            }
        }

        return $actions;
    }

    public function render()
    {
        $availableQuotations = $this->getAvailableQuotations();
        $availableOffers = $this->getAvailableOffers();
        $pendingActions = $this->getPendingActions();

        return view('livewire.import-duty.import-duty-tracking', [
            'availableQuotations' => $availableQuotations,
            'availableOffers' => $availableOffers,
            'pendingActions' => $pendingActions,
        ]);
    }
}