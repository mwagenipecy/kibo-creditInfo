<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Application;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class LoanApplicationList extends Component
{

    use WithPagination;
    
    protected $paginationTheme = 'tailwind';
    
    public $statusFilter = '';
    
    // Listen for status filter changes to reset pagination
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        // Get the currently authenticated user
       // $user = Auth::user();
        
        // Query applications for the current user
        $applicationsQuery = Application::
        
        where('client_id', auth()->user()->id)->
          //  ->with('lender') // Eager load the lender relationship
            orderBy('created_at', 'desc');
        
        // Apply status filter if selected
        if ($this->statusFilter) {
            $applicationsQuery->where('application_status', $this->statusFilter);
        }
        
        // Get applications with pagination
        $applications = $applicationsQuery->paginate(10);
        
        // Count applications by status
        $pendingCount = $this->getStatusCount('pending');
        $approvedCount = $this->getStatusCount('approved');
        $rejectedCount = $this->getStatusCount('rejected');
        
        return view('livewire.web.loan-application-list', [
            'applications' => $applications,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
        ]);
    }
    
    /**
     * Get count of applications with specific status
     *
     * @param string $status
     * @return int
     */
    private function getStatusCount($status)
    {
        return Application::
        //where('email', Auth::user()->email)
            where('application_status', $status)
            ->count();
    }


   
}
