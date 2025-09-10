<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SparePartRequest;
use App\Models\SparePartQuote;
use App\Models\SparePartPayment;
use App\Models\Make;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendSparePartQuoteEmail;

class SparePartRequestsManagement extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // Filters
    public $statusFilter = '';
    public $paymentFilter = '';
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Quote modal
    public $showQuoteModal = false;
    public $selectedRequest = null;
    public $quotePrice = '';
    public $deliveryTime = '';
    public $warrantyInfo = '';
    public $additionalNotes = '';
    public $paymentLink = '';

    // Quote details modal
    public $showQuoteDetailsModal = false;
    public $selectedQuote = null;

    protected function rules()
    {
        return [
            'quotePrice' => 'required|numeric|min:0',
            'deliveryTime' => 'nullable|string|max:100',
            'warrantyInfo' => 'nullable|string|max:500',
            'additionalNotes' => 'nullable|string|max:1000',
            'paymentLink' => 'nullable|url|max:500',
        ];
    }

    protected $messages = [
        'quotePrice.required' => 'Price is required.',
        'quotePrice.numeric' => 'Price must be a number.',
        'quotePrice.min' => 'Price must be at least 0.',
        'paymentLink.url' => 'Payment link must be a valid URL.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPaymentFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
        $this->resetPage();
    }

    public function openQuoteModal($requestId)
    {
        $this->selectedRequest = SparePartRequest::with(['make', 'model'])->findOrFail($requestId);
        $this->showQuoteModal = true;
    }

    public function closeQuoteModal()
    {
        $this->showQuoteModal = false;
        $this->selectedRequest = null;
        $this->resetQuoteForm();
    }

    public function submitQuote()
    {
        $this->validate();

        try {
            $quote = SparePartQuote::create([
                'spare_part_request_id' => $this->selectedRequest->id,
                'shop_id' => Auth::user()->shop_id,
                'price' => $this->quotePrice,
                'currency' => 'TZS',
                'delivery_time' => $this->deliveryTime,
                'warranty_info' => $this->warrantyInfo,
                'additional_notes' => $this->additionalNotes,
                'payment_link' => $this->paymentLink,
                'status' => 'pending',
                'expires_at' => now()->addDays(7), // Quote expires in 7 days
            ]);

            // Send email notification to customer asynchronously
            SendSparePartQuoteEmail::dispatch($quote);

            session()->flash('message', 'Quote submitted successfully! Email notification sent to customer.');
            $this->closeQuoteModal();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error submitting quote: ' . $e->getMessage());
        }
    }

    public function openQuoteDetailsModal($quoteId)
    {
        $this->selectedQuote = SparePartQuote::with(['sparePartRequest.make', 'sparePartRequest.model', 'payment'])
            ->where('shop_id', Auth::user()->shop_id)
            ->findOrFail($quoteId);
        $this->showQuoteDetailsModal = true;
    }

    public function closeQuoteDetailsModal()
    {
        $this->showQuoteDetailsModal = false;
        $this->selectedQuote = null;
    }

    public function updateQuoteStatus($quoteId, $status)
    {
        try {
            $quote = SparePartQuote::where('shop_id', Auth::user()->shop_id)
                ->findOrFail($quoteId);
            
            $quote->update(['status' => $status]);
            
            session()->flash('message', 'Quote status updated successfully!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating quote status: ' . $e->getMessage());
        }
    }

    private function resetQuoteForm()
    {
        $this->reset([
            'quotePrice', 'deliveryTime', 'warrantyInfo', 
            'additionalNotes', 'paymentLink'
        ]);
    }

    public function render()
    {
        $shopId = Auth::user()->shop_id;

        // Get requests that this shop can respond to
        $requests = SparePartRequest::with(['make', 'model', 'quotes' => function($query) use ($shopId) {
                $query->where('shop_id', $shopId);
            }])
            ->whereDoesntHave('quotes', function($query) use ($shopId) {
                $query->where('shop_id', $shopId);
            })
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('part_name', 'like', '%' . $this->search . '%')
                      ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('customer_email', 'like', '%' . $this->search . '%')
                      ->orWhereHas('make', function($make) {
                          $make->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('model', function($model) {
                          $model->where('name', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        // Get quotes submitted by this shop
        $quotes = SparePartQuote::with(['sparePartRequest.make', 'sparePartRequest.model', 'payment'])
            ->where('shop_id', $shopId)
            ->when($this->paymentFilter, function($query) {
                if ($this->paymentFilter === 'paid') {
                    $query->whereHas('payment', function($q) {
                        $q->where('payment_status', 'completed');
                    });
                } elseif ($this->paymentFilter === 'unpaid') {
                    $query->whereDoesntHave('payment', function($q) {
                        $q->where('payment_status', 'completed');
                    });
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Statistics
        $stats = [
            'total_requests' => SparePartRequest::whereDoesntHave('quotes', function($query) use ($shopId) {
                $query->where('shop_id', $shopId);
            })->count(),
            'total_quotes' => SparePartQuote::where('shop_id', $shopId)->count(),
            'paid_quotes' => SparePartQuote::where('shop_id', $shopId)
                ->whereHas('payment', function($query) {
                    $query->where('payment_status', 'completed');
                })->count(),
            'pending_quotes' => SparePartQuote::where('shop_id', $shopId)
                ->whereDoesntHave('payment', function($query) {
                    $query->where('payment_status', 'completed');
                })->count(),
        ];

        return view('livewire.shop.spare-part-requests-management', [
            'requests' => $requests,
            'quotes' => $quotes,
            'stats' => $stats
        ]);
    }
}
