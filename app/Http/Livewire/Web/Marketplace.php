<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Make;
use App\Models\VehicleModel;
use App\Models\Shop;
use App\Models\SparePartRequest;
use App\Jobs\SendSparePartRequestEmails;
use Illuminate\Support\Facades\Log;

class Marketplace extends Component
{
    public $selectedMake = '';
    public $selectedModel = '';
    public $selectedYear = '';
    public $partName = '';
    public $partNumber = '';
    public $partSize = '';
    public $partCondition = '';
    public $additionalNotes = '';
    public $customerName = '';
    public $customerEmail = '';

    public $makes;
    public $models = [];
    public $years = [];
    public $shops;

    public function mount()
    {
        $this->loadMakes();
        $this->loadYears();
        $this->loadShops();
    }

    public function loadMakes()
    {
        $this->makes = Make::orderBy('name')->get();
    }

    public function loadYears()
    {
        $currentYear = date('Y');
        $this->years = range($currentYear, $currentYear - 30);
    }

    public function loadShops()
    {
        $this->shops = Shop::where('status', 'active')->get();
    }

    public function updatedSelectedMake($value)
    {
        $this->selectedModel = '';
        $this->models = [];
        
        if ($value) {
            $this->models = VehicleModel::where('make_id', $value)
                ->orderBy('name')
                ->get();
        }
    }

    public function submitRequest()
    {
        $this->validate($this->rules());

        try {
            // Create the spare part request
            $request = SparePartRequest::create([
                'make_id' => $this->selectedMake,
                'model_id' => $this->selectedModel,
                'year' => $this->selectedYear,
                'part_name' => $this->partName,
                'part_number' => $this->partNumber,
                'part_size' => $this->partSize,
                'part_condition' => $this->partCondition,
                'additional_notes' => $this->additionalNotes,
                'customer_name' => $this->customerName,
                'customer_email' => $this->customerEmail,
                'customer_phone' => null, // No phone number required
                'status' => 'pending',
            ]);

            // Set expiration date (7 days from now)
            $request->setExpiration();

            // Dispatch job to send emails asynchronously
            SendSparePartRequestEmails::dispatch($request, $this->shops);

            // Reset form
            $this->resetForm();

            session()->flash('success', 'Your request has been submitted successfully! Shops will contact you with quotes via email.');

        } catch (\Exception $e) {
            Log::error('Failed to create spare part request', [
                'error' => $e->getMessage(),
                'data' => [
                    'selectedMake' => $this->selectedMake,
                    'selectedModel' => $this->selectedModel,
                    'selectedYear' => $this->selectedYear,
                    'partName' => $this->partName,
                    'partCondition' => $this->partCondition,
                    'customerName' => $this->customerName,
                    'customerEmail' => $this->customerEmail,
                ]
            ]);

            session()->flash('error', 'Failed to submit request. Please try again.');
        }
    }

    public function resetForm()
    {
        $this->selectedMake = '';
        $this->selectedModel = '';
        $this->selectedYear = '';
        $this->partName = '';
        $this->partNumber = '';
        $this->partSize = '';
        $this->partCondition = '';
        $this->additionalNotes = '';
        $this->customerName = '';
        $this->customerEmail = '';
        $this->models = [];
    }

    protected function rules()
    {
        return [
            'selectedMake' => 'required',
            'selectedModel' => 'required',
            'selectedYear' => 'required',
            'partName' => 'required|string|max:255',
            'partCondition' => 'required|in:all,new,used',
            'customerName' => 'required|string|max:255',
            'customerEmail' => 'required|email|max:255',
            'partNumber' => 'nullable|string|max:100',
            'partSize' => 'nullable|string|max:100',
            'additionalNotes' => 'nullable|string',
        ];
    }

    public function render()
    {
        return view('livewire.web.marketplace');
    }
}