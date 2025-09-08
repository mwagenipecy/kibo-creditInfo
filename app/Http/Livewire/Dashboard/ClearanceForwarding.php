<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\ImportDutyApplication;
use App\Models\CFQuotation;
use App\Models\ClearingForwardingCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClearanceForwarding extends Component
{
    public $totalApplications = 0;
    public $newApplications = 0;
    public $myQuotations = 0;
    public $acceptedQuotations = 0;
    public $rejectedQuotations = 0;
    public $totalValue = 0;
    public $pendingExpiry = 0;
    public $recentApplications = [];
    public $recentQuotations = [];
    public $monthlyStats = [];
    public $cfCompany;

    public function loadData()
    {
        $this->cfCompany = ClearingForwardingCompany::where('email', Auth::user()->email)->first();
        
        if (!$this->cfCompany) {
            $this->cfCompany = (object) [
                'company_name' => 'CF Company',
                'tra_license_number' => 'N/A',
                'contact_person_name' => Auth::user()->full_name ?? 'User'
            ];
        }

        // Basic statistics
        $this->totalApplications = ImportDutyApplication::count();
        
        $this->newApplications = ImportDutyApplication::whereIn('status', ['SUBMITTED', 'CF_QUOTATION'])
            ->whereDoesntHave('cfQuotations', function($q) {
                $q->where('cf_company_id', $this->cfCompany->id ?? 0);
            })->count();

        $this->myQuotations = CFQuotation::where('cf_company_id', $this->cfCompany->id ?? 0)->count();

        $this->acceptedQuotations = CFQuotation::where('cf_company_id', $this->cfCompany->id ?? 0)
            ->where('status', 'SELECTED')->count();

        $this->rejectedQuotations = CFQuotation::where('cf_company_id', $this->cfCompany->id ?? 0)
            ->whereIn('status', ['NOT_SELECTED', 'EXPIRED'])->count();

        $this->totalValue = CFQuotation::where('cf_company_id', $this->cfCompany->id ?? 0)
            ->where('status', 'SELECTED')->sum('grand_total');

        $this->pendingExpiry = CFQuotation::where('cf_company_id', $this->cfCompany->id ?? 0)
            ->where('status', 'SUBMITTED')
            ->where('expires_at', '<=', now()->addHours(24))
            ->count();

        // Recent applications (last 5)
        $this->recentApplications = ImportDutyApplication::with(['cfQuotations' => function($q) {
            $q->where('cf_company_id', $this->cfCompany->id ?? 0);
        }])
        ->whereIn('status', ['SUBMITTED', 'CF_QUOTATION'])
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

        // Recent quotations (last 5)
        $this->recentQuotations = CFQuotation::where('cf_company_id', $this->cfCompany->id ?? 0)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Monthly statistics for the last 6 months
        $this->monthlyStats = CFQuotation::where('cf_company_id', $this->cfCompany->id ?? 0)
        ->where('created_at', '>=', now()->subMonths(6))
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as quotation_count'),
            DB::raw('SUM(grand_total) as total_value')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();
    }

    public function render()
    {
        $this->loadData();
        
        return view('livewire.dashboard.clearance-forwarding');
    }
}
