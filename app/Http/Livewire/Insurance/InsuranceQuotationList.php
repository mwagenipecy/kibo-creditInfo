<?php

namespace App\Http\Livewire\Insurance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InsuranceQuoteRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\InsuranceQuoteStatus;

class InsuranceQuotationList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $status = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function changeStatus($requestId, $newStatus)
    {
        $allowed = ['approved', 'completed'];
        if (!in_array($newStatus, $allowed, true)) {
            return;
        }

        $request = InsuranceQuoteRequest::find($requestId);
        if (!$request) {
            return;
        }

        $request->status = $newStatus;
        $request->save();

        // Send email only on approval
        if ($newStatus === 'approved' && $request->customer_email) {
            try {
                Mail::to($request->customer_email)->send(new InsuranceQuoteStatus(
                    $request->customer_name,
                    $newStatus,
                    $request
                ));
            } catch (\Exception $e) {
                // Silently ignore email errors to not block UI
            }
        }

        session()->flash('message', 'Request status updated to ' . $newStatus . ($newStatus === 'approved' ? ' and email sent.' : '.'));
    }

    public function render()
    {
        $query = InsuranceQuoteRequest::query()
            ->when($this->search, function ($q) {
                $q->where(function ($qq) {
                    $qq->where('customer_name', 'like', '%' . $this->search . '%')
                       ->orWhere('customer_phone', 'like', '%' . $this->search . '%')
                       ->orWhere('customer_email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($q) {
                $q->where('status', $this->status);
            })
            ->orderByDesc('created_at');

        $requests = $query->paginate($this->perPage);

        $statusCounts = [
            'total' => InsuranceQuoteRequest::count(),
            'pending' => InsuranceQuoteRequest::where(function ($query) {
                $query->whereNull('status')->orWhere('status', '');
            })->count(),
            'approved' => InsuranceQuoteRequest::where('status', 'approved')->count(),
            'completed' => InsuranceQuoteRequest::where('status', 'completed')->count(),
        ];

        return view('livewire.insurance.insurance-quotation-list', [
            'requests' => $requests,
            'statusCounts' => $statusCounts,
        ]);
    }
}


