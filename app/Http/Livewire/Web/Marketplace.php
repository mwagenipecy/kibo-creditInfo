<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Make;
use App\Models\VehicleModel;
use App\Models\Shop;
use App\Models\SparePartRequest;
use App\Models\SparePartRequestImage;
use App\Jobs\SendSparePartRequestEmails;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class Marketplace extends Component
{
    use WithFileUploads;
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
    public $customerPhone = '';
    public $images = [];

    public $makes;
    public $models = [];
    public $years = [];
    public $shops;

    // Livewire-driven image preview state
    public $previewOpen = false;
    public $previewSrc = '';

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
                'customer_phone' => $this->customerPhone,
                'status' => 'pending',
            ]);

            // Set expiration date (1 day from now)
            $request->setExpiration(1);

            // Store uploaded images (optional)
            if (is_array($this->images) && count($this->images) > 0) {
                foreach ($this->images as $file) {
                    try {
                        if (!$file) { continue; }
                        $path = $file->store('spare-part-requests', 'public');
                        SparePartRequestImage::create([
                            'spare_part_request_id' => $request->id,
                            'path' => $path,
                            'original_name' => method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : null,
                            'mime_type' => method_exists($file, 'getMimeType') ? $file->getMimeType() : null,
                            'size_bytes' => method_exists($file, 'getSize') ? $file->getSize() : null,
                        ]);
                    } catch (\Throwable $e) {
                        Log::error('Failed to save request image', ['error' => $e->getMessage()]);
                        // Continue processing other images
                    }
                }
            }

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

    // Preview controls (no Alpine)
    public function openPreview($src)
    {
        $this->previewSrc = $src;
        $this->previewOpen = true;
    }

    public function closePreview()
    {
        $this->previewOpen = false;
        $this->previewSrc = '';
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
        $this->customerPhone = '';
        $this->images = [];
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
            'customerPhone' => 'required|string|max:30',
            'images.*' => 'nullable|image|max:4096',
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