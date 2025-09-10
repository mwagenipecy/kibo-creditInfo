<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Make;
use App\Models\VehicleModel;
use App\Models\SparePartRequest;
use App\Models\Shop;
use App\Mail\SparePartRequestNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SparePartRequestForm extends Component
{
    // Vehicle Information
    public $selectedMake = '';
    public $selectedModel = '';
    public $selectedYear = '';
    
    // Part Information
    public $partName = '';
    public $partNumber = '';
    public $partSize = '';
    public $description = '';
    
    // Customer Information
    public $customerName = '';
    public $customerEmail = '';
    public $customerPhone = '';
    public $additionalNotes = '';
    
    // Form State
    public $step = 1;
    public $loading = false;
    public $success = false;
    public $requestId = null;
    
    // Available Options
    public $makes = [];
    public $models = [];
    public $years = [];
    
    protected function rules()
    {
        return [
            'selectedMake' => 'required|exists:makes,id',
            'selectedModel' => 'required|exists:vehicle_models,id',
            'selectedYear' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'partName' => 'required|string|max:255',
            'partNumber' => 'nullable|string|max:100',
            'partSize' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'customerName' => 'required|string|min:2|max:255',
            'customerEmail' => 'required|email|max:255',
            'customerPhone' => 'required|string|max:20',
            'additionalNotes' => 'nullable|string|max:1000',
        ];
    }

    protected $messages = [
        'selectedMake.required' => 'Please select a vehicle make.',
        'selectedModel.required' => 'Please select a vehicle model.',
        'selectedYear.required' => 'Please select a vehicle year.',
        'partName.required' => 'Please enter the part name.',
        'customerName.required' => 'Please enter your name.',
        'customerEmail.required' => 'Please enter your email address.',
        'customerEmail.email' => 'Please enter a valid email address.',
        'customerPhone.required' => 'Please enter your phone number.',
    ];

    

    public function mount()
    {
        $this->loadMakes();
        $this->loadYears();
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

    public function updatedSelectedMake()
    {
        $this->selectedModel = '';
        $this->models = [];
        
        if ($this->selectedMake) {
            $this->models = VehicleModel::where('make_id', $this->selectedMake)
                ->orderBy('name')
                ->get();
        }
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'selectedMake' => 'required|exists:makes,id',
                'selectedModel' => 'required|exists:vehicle_models,id',
                'selectedYear' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'partName' => 'required|string|max:255',
                'partNumber' => 'nullable|string|max:100',
                'partSize' => 'nullable|string|max:100',
                'description' => 'nullable|string|max:1000',
            ]);
            
            $this->step = 2;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submitRequest()
    {
        $this->validate($this->rules());
        
        $this->loading = true;
        
        try {
            // Create the spare part request
            $request = SparePartRequest::create([
                'make_id' => $this->selectedMake,
                'model_id' => $this->selectedModel,
                'year' => $this->selectedYear,
                'part_name' => $this->partName,
                'part_number' => $this->partNumber,
                'part_size' => $this->partSize,
                'description' => $this->description,
                'customer_name' => $this->customerName,
                'customer_email' => $this->customerEmail,
                'customer_phone' => $this->customerPhone,
                'additional_notes' => $this->additionalNotes,
                'status' => 'pending',
            ]);

            // Set expiration (7 days from now)
            $request->setExpiration(7);
            
            // Get all shops and send notifications
            $shops = Shop::where('status', 'active')->get();
            
            foreach ($shops as $shop) {
                try {
                    Mail::to($shop->email)->send(new SparePartRequestNotification($request, $shop));
                } catch (\Exception $e) {
                    Log::error('Failed to send spare part request email', [
                        'shop_id' => $shop->id,
                        'request_id' => $request->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }
            
            $this->requestId = $request->id;
            $this->success = true;
            $this->step = 3;
            
        } catch (\Exception $e) {
            Log::error('Failed to create spare part request', [
                'error' => $e->getMessage(),
                'data' => $this->only([
                    'selectedMake', 'selectedModel', 'selectedYear', 'partName',
                    'customerName', 'customerEmail', 'customerPhone'
                ])
            ]);
            
            session()->flash('error', 'Failed to submit request. Please try again.');
        }
        
        $this->loading = false;
    }

    public function resetForm()
    {
        $this->reset([
            'selectedMake', 'selectedModel', 'selectedYear',
            'partName', 'partNumber', 'partSize', 'description',
            'customerName', 'customerEmail', 'customerPhone', 'additionalNotes',
            'step', 'success', 'requestId'
        ]);
        
        $this->models = [];
        $this->loadMakes();
        $this->loadYears();
    }

    public function render()
    {
        return view('livewire.web.spare-part-request-form');
    }
}
