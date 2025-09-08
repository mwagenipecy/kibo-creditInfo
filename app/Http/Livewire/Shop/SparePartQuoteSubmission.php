<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\SparePartRequest;
use App\Models\SparePartQuote;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class SparePartQuoteSubmission extends Component
{
    public $requestId;
    public $shopId;
    public $request;
    public $shop;
    
    // Quote form fields
    public $price = '';
    public $currency = 'TZS';
    public $description = '';
    public $brand = '';
    public $partNumber = '';
    public $quantityAvailable = 1;
    public $deliveryTimeDays = '';
    public $deliveryCost = 0;
    public $shopNotes = '';
    
    // Form state
    public $loading = false;
    public $success = false;
    public $error = '';
    
    protected $rules = [
        'price' => 'required|numeric|min:0',
        'currency' => 'required|string|max:3',
        'description' => 'nullable|string|max:1000',
        'brand' => 'nullable|string|max:255',
        'partNumber' => 'nullable|string|max:255',
        'quantityAvailable' => 'required|integer|min:1',
        'deliveryTimeDays' => 'nullable|integer|min:1|max:365',
        'deliveryCost' => 'required|numeric|min:0',
        'shopNotes' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'price.required' => 'Please enter a price.',
        'price.numeric' => 'Price must be a valid number.',
        'price.min' => 'Price must be at least 0.',
        'quantityAvailable.required' => 'Please enter available quantity.',
        'quantityAvailable.integer' => 'Quantity must be a whole number.',
        'quantityAvailable.min' => 'Quantity must be at least 1.',
        'deliveryTimeDays.integer' => 'Delivery time must be a whole number.',
        'deliveryTimeDays.min' => 'Delivery time must be at least 1 day.',
        'deliveryTimeDays.max' => 'Delivery time cannot exceed 365 days.',
        'deliveryCost.numeric' => 'Delivery cost must be a valid number.',
        'deliveryCost.min' => 'Delivery cost must be at least 0.',
    ];

    public function mount($requestId, $shopId)
    {
        $this->requestId = $requestId;
        $this->shopId = $shopId;
        
        // Load the request
        $this->request = SparePartRequest::with(['make', 'model'])
            ->findOrFail($requestId);
        
        // Load the shop
        $this->shop = Shop::findOrFail($shopId);
        
        // Verify the request is still active
        if (!$this->request->isActive()) {
            $this->error = 'This request has expired or is no longer active.';
        }
        
        // Check if shop has already submitted a quote
        $existingQuote = SparePartQuote::where('spare_part_request_id', $requestId)
            ->where('shop_id', $shopId)
            ->first();
            
        if ($existingQuote) {
            $this->error = 'You have already submitted a quote for this request.';
        }
    }

    public function submitQuote()
    {
        $this->validate();
        
        $this->loading = true;
        
        try {
            // Create the quote
            $quote = SparePartQuote::create([
                'spare_part_request_id' => $this->requestId,
                'shop_id' => $this->shopId,
                'price' => $this->price,
                'currency' => $this->currency,
                'description' => $this->description,
                'brand' => $this->brand,
                'part_number' => $this->partNumber,
                'quantity_available' => $this->quantityAvailable,
                'delivery_time_days' => $this->deliveryTimeDays ?: null,
                'delivery_cost' => $this->deliveryCost,
                'status' => 'pending',
                'shop_notes' => $this->shopNotes,
            ]);
            
            // Set quote expiration (3 days from now)
            $quote->setExpiration(3);
            
            $this->success = true;
            
        } catch (\Exception $e) {
            $this->error = 'Failed to submit quote. Please try again.';
        }
        
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.shop.spare-part-quote-submission');
    }
}
