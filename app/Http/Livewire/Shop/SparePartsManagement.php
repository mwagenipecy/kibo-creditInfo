<?php

// app/Http/Livewire/Shop/SparePartsManagement.php
namespace App\Http\Livewire\Shop;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\SparePart;
use App\Models\SpareCategory;
use App\Models\SpareBrand;
use App\Models\SpareModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SparePartsManagement extends Component
{
    use WithFileUploads, WithPagination;

    public $showModal = false;
    public $editMode = false;
    public $sparePartId = null;

    // Form fields
    public $spare_category_id = '';
    public $spare_brand_id = '';
    public $spare_model_id = '';
    public $unit = '';
    public $price_type = 'per_unit';
    public $price = '';
    public $description = '';
    
    // Images
    public $preview_image;
    public $additional_image_1;
    public $additional_image_2;
    
    // Current images for edit mode
    public $current_preview_image = '';
    public $current_additional_image_1 = '';
    public $current_additional_image_2 = '';

    // Search and filters
    public $search = '';
    public $categoryFilter = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'spare_category_id' => 'required|exists:spare_categories,id',
        'spare_brand_id' => 'nullable|exists:spare_brands,id',
        'spare_model_id' => 'nullable|exists:spare_models,id',
        'unit' => 'required|string|max:255',
        'price_type' => 'required|in:per_unit,per_bundle',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'preview_image' => 'required_if:editMode,false|image|max:2048',
        'additional_image_1' => 'nullable|image|max:2048',
        'additional_image_2' => 'nullable|image|max:2048',
    ];

    public function updatedSpareCategoryId()
    {
        $this->spare_brand_id = '';
        $this->spare_model_id = '';
    }

    public function updatedSpareBrandId()
    {
        $this->spare_model_id = '';
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->editMode = false;
    }

    public function editSparePart($id)
    {
        $sparePart = SparePart::findOrFail($id);
        
        $this->sparePartId = $id;
        $this->spare_category_id = $sparePart->spare_category_id;
        $this->spare_brand_id = $sparePart->spare_brand_id;
        $this->spare_model_id = $sparePart->spare_model_id;
        $this->unit = $sparePart->unit;
        $this->price_type = $sparePart->price_type;
        $this->price = $sparePart->price;
        $this->description = $sparePart->description;
        
        $this->current_preview_image = $sparePart->preview_image;
        $this->current_additional_image_1 = $sparePart->additional_image_1;
        $this->current_additional_image_2 = $sparePart->additional_image_2;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function saveSparePart()
    {

        $this->validate();


        try {
            $data = [
                'shop_id' => auth()->user()->shop_id,
                'spare_category_id' => $this->spare_category_id,
                'spare_brand_id' => $this->spare_brand_id ?: null,
                'spare_model_id' => $this->spare_model_id ?: null,
                'unit' => $this->unit,
                'price_type' => $this->price_type,
                'price' => $this->price,
                'description' => $this->description,
            ];

            // Handle image uploads
            if ($this->preview_image) {
                $data['preview_image'] = $this->storeImage($this->preview_image, 'spare-parts');
            }
            if ($this->additional_image_1) {
                $data['additional_image_1'] = $this->storeImage($this->additional_image_1, 'spare-parts');
            }
            if ($this->additional_image_2) {
                $data['additional_image_2'] = $this->storeImage($this->additional_image_2, 'spare-parts');
            }


            if ($this->editMode) {
                $sparePart = SparePart::findOrFail($this->sparePartId);
                
                // Keep current images if no new ones uploaded
                if (!$this->preview_image) $data['preview_image'] = $this->current_preview_image;
                if (!$this->additional_image_1) $data['additional_image_1'] = $this->current_additional_image_1;
                if (!$this->additional_image_2) $data['additional_image_2'] = $this->current_additional_image_2;
                
                $sparePart->update($data);
                session()->flash('message', 'Spare part updated successfully!');
            } else {
                SparePart::create($data);
                session()->flash('message', 'Spare part created successfully!');
            }

            $this->resetForm();
            $this->showModal = false;

        } catch (\Exception $e) {

            dd($e->getMessage());
            session()->flash('error', 'Error saving spare part: ' . $e->getMessage());
        }
    }

    public function deleteSparePart($id)
    {
        try {
            $sparePart = SparePart::findOrFail($id);
            
            // Delete images
            if ($sparePart->preview_image) Storage::delete('public/' . $sparePart->preview_image);
            if ($sparePart->additional_image_1) Storage::delete('public/' . $sparePart->additional_image_1);
            if ($sparePart->additional_image_2) Storage::delete('public/' . $sparePart->additional_image_2);
            
            $sparePart->delete();
            session()->flash('message', 'Spare part deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting spare part: ' . $e->getMessage());
        }
    }

    private function storeImage($image, $folder)
    {
        return $image->store($folder, 'public');
    }

    private function resetForm()
    {
        $this->reset([
            'spare_category_id', 'spare_brand_id', 'spare_model_id',
            'unit', 'price_type', 'price', 'description',
            'preview_image', 'additional_image_1', 'additional_image_2',
            'current_preview_image', 'current_additional_image_1', 'current_additional_image_2',
            'sparePartId'
        ]);
        $this->price_type = 'per_unit';
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function render()
    {
        $categories = SpareCategory::all();
        $brands = $this->spare_category_id ? SpareBrand::where('spare_category_id', $this->spare_category_id)->get() : collect();
        $models = $this->spare_brand_id ? SpareModel::where('spare_brand_id', $this->spare_brand_id)->get() : collect();

        $spareParts = SparePart::with(['spareCategory', 'spareBrand', 'spareModel'])
            ->where('shop_id', auth()->user()->shop_id)
            ->when($this->search, function($query) {
                $query->where('unit', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function($query) {
                $query->where('spare_category_id', $this->categoryFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.shop.spare-parts-management', [
            'categories' => $categories,
            'brands' => $brands,
            'models' => $models,
            'spareParts' => $spareParts
        ]);
    }



}