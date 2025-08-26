<?php

namespace App\Http\Livewire\ImportDuty;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ImportDutyApplication;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClientImportDutyList extends Component
{
    use WithPagination;

    public $statusFilter = '';
    public $searchTerm = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $selectedApplications = [];
    public $selectAll = false;

    protected $queryString = [
        'statusFilter' => ['except' => ''],
        'searchTerm' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc']
    ];

    protected $listeners = ['refreshApplications' => '$refresh'];

    public function mount()
    {
        // Reset pagination when component loads
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

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedApplications = $this->getApplications()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedApplications = [];
        }
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->statusFilter = '';
        $this->searchTerm = '';
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function bulkAction($action)
    {
        if (empty($this->selectedApplications)) {
            session()->flash('error', 'Please select at least one application.');
            return;
        }

        switch ($action) {
            case 'export':
                return $this->exportSelected();
            case 'archive':
                return $this->archiveSelected();
            default:
                session()->flash('error', 'Invalid action selected.');
        }
    }

    protected function exportSelected()
    {
        // Implementation for exporting selected applications
        session()->flash('success', 'Export will be available for download shortly.');
    }

    protected function archiveSelected()
    {
        // Implementation for archiving selected applications
        session()->flash('success', count($this->selectedApplications) . ' applications archived successfully.');
        $this->selectedApplications = [];
        $this->selectAll = false;
    }

    public function getApplications()
    {
        $query = ImportDutyApplication::where('email', Auth::user()->email)
            ->with(['selectedCFCompany', 'selectedLender', 'cfQuotations', 'lenderOffers']);

        // Apply filters
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('application_number', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('vehicle_make', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('vehicle_model', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('applicant_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('vehicle_vin', 'like', '%' . $this->searchTerm . '%');
            });
        }

        // Apply sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        return $query->paginate(15);
    }

    public function getApplicationStats()
    {
        $baseQuery = ImportDutyApplication::where('email', Auth::user()->email);
        
        return [
            'total' => $baseQuery->count(),
            'draft' => $baseQuery->where('status', 'DRAFT')->count(),
            'submitted' => $baseQuery->where('status', 'SUBMITTED')->count(),
            'cf_quotation' => $baseQuery->where('status', 'CF_QUOTATION')->count(),
            'cf_selected' => $baseQuery->where('status', 'CF_SELECTED')->count(),
            'lender_review' => $baseQuery->where('status', 'LENDER_REVIEW')->count(),
            'approved' => $baseQuery->where('status', 'APPROVED')->count(),
            'rejected' => $baseQuery->where('status', 'REJECTED')->count(),
            'completed' => $baseQuery->where('status', 'COMPLETED')->count(),
            'total_value' => $baseQuery->sum('cif_value_tzs'),
            'pending_actions' => $baseQuery->whereIn('status', ['CF_QUOTATION', 'LENDER_REVIEW'])->count(),
            'recent_activity' => $baseQuery->where('updated_at', '>=', Carbon::now()->subDays(7))->count(),
        ];
    }

    public function getUrgentActions()
    {
        $urgentActions = [];
        
        // CF Quotations expiring soon
        $expiringQuotations = ImportDutyApplication::where('email', Auth::user()->email)
            ->where('status', 'CF_QUOTATION')
            ->whereHas('cfQuotations', function($query) {
                $query->where('expires_at', '<=', Carbon::now()->addHours(24))
                      ->where('status', 'SUBMITTED');
            })
            ->count();

        if ($expiringQuotations > 0) {
            $urgentActions[] = [
                'type' => 'quotations_expiring',
                'count' => $expiringQuotations,
                'message' => "You have {$expiringQuotations} quotation(s) expiring within 24 hours",
                'action_url' => route('client.applications'),
                'urgency' => 'high'
            ];
        }

        // Lender offers expiring soon
        $expiringOffers = ImportDutyApplication::where('email', Auth::user()->email)
            ->where('status', 'LENDER_REVIEW')
            ->whereHas('lenderOffers', function($query) {
                $query->where('expires_at', '<=', Carbon::now()->addHours(24))
                      ->where('status', 'SUBMITTED');
            })
            ->count();

        if ($expiringOffers > 0) {
            $urgentActions[] = [
                'type' => 'offers_expiring',
                'count' => $expiringOffers,
                'message' => "You have {$expiringOffers} financing offer(s) expiring within 24 hours",
                'action_url' => route('client.applications'),
                'urgency' => 'high'
            ];
        }

        // Applications requiring action
        $pendingActions = ImportDutyApplication::where('email', Auth::user()->email)
            ->whereIn('status', ['CF_QUOTATION', 'LENDER_REVIEW'])
            ->count();

        if ($pendingActions > 0) {
            $urgentActions[] = [
                'type' => 'pending_actions',
                'count' => $pendingActions,
                'message' => "You have {$pendingActions} application(s) requiring your action",
                'action_url' => route('import.duty.applications'),
                'urgency' => 'medium'
            ];
        }

        return $urgentActions;
    }

    public function getTimelineData($applicationId)
    {
        $application = ImportDutyApplication::findOrFail($applicationId);
        $timeline = [];

        // Application submitted
        $timeline[] = [
            'date' => $application->created_at,
            'title' => 'Application Submitted',
            'description' => 'Import duty application submitted successfully',
            'status' => 'completed',
            'icon' => 'document-add'
        ];

        // CF quotations received
        if ($application->cfQuotations->count() > 0) {
            $timeline[] = [
                'date' => $application->cfQuotations->first()->created_at,
                'title' => 'CF Quotations Received',
                'description' => $application->cfQuotations->count() . ' quotations received from CF companies',
                'status' => 'completed',
                'icon' => 'document-text'
            ];
        }

        // CF company selected
        if ($application->selectedCFCompany) {
            $timeline[] = [
                'date' => $application->cfQuotations->where('status', 'SELECTED')->first()?->selected_at,
                'title' => 'CF Company Selected',
                'description' => $application->selectedCFCompany->company_name . ' selected for clearance',
                'status' => 'completed',
                'icon' => 'check-circle'
            ];
        }

        // Lender offers received
        if ($application->lenderOffers->count() > 0) {
            $timeline[] = [
                'date' => $application->lenderOffers->first()->created_at,
                'title' => 'Financing Offers Received',
                'description' => $application->lenderOffers->count() . ' financing offers received',
                'status' => 'completed',
                'icon' => 'currency-dollar'
            ];
        }

        // Financing approved
        if ($application->selectedLender) {
            $timeline[] = [
                'date' => $application->approved_at,
                'title' => 'Financing Approved',
                'description' => 'Financing approved by ' . $application->selectedLender->name,
                'status' => 'completed',
                'icon' => 'badge-check'
            ];
        }

        return collect($timeline)->sortBy('date');
    }

    public function render()
    {
        $applications = $this->getApplications();
        $stats = $this->getApplicationStats();
        $urgentActions = $this->getUrgentActions();

        return view('livewire.import-duty.client-import-duty-list', [
            'applications' => $applications,
            'stats' => $stats,
            'urgentActions' => $urgentActions,
        ]);
    }
}