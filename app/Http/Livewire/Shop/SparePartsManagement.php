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
use Illuminate\Validation\Rule;

class SparePartsManagement extends Component
{
    use WithFileUploads, WithPagination;

    // Modal states
    public $showModal = false;
    public $editMode = false;
    public $sparePartId = null;
    
    // Delete confirmation
    public $confirmingDeletion = false;
    public $sparePartToDelete = null;

    // Form fields
    public $spare_category_id = '';
    public $spare_brand_id = '';
    public $spare_model_id = '';
    public $unit = '';
    public $price_type = 'per_unit';
    public $price = '';
    public $description = '';
    public $stock_quantity = 0;
    public $minimum_stock = 0;
    public $status = 'available';
    
    // Images
    public $preview_image;
    public $additional_image_1;
    public $additional_image_2;
    
    // Current images for edit mode
    public $current_preview_image = '';
    public $current_additional_image_1 = '';
    public $current_additional_image_2 = '';
    
    // Flags to track if images should be removed
    public $remove_preview_image = false;
    public $remove_additional_image_1 = false;
    public $remove_additional_image_2 = false;

    // Search and filters
    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'spare_category_id' => 'required|exists:spare_categories,id',
            'spare_brand_id' => 'nullable|exists:spare_brands,id',
            'spare_model_id' => 'nullable|exists:spare_models,id',
            'unit' => 'required|string|max:255',
            'price_type' => 'required|in:per_unit,per_bundle',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'stock_quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'status' => 'required|in:available,out_of_stock,discontinued',
            'preview_image' => $this->editMode ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'additional_image_1' => 'nullable|image|max:2048',
            'additional_image_2' => 'nullable|image|max:2048',
        ];
    }

    protected $messages = [
        'spare_category_id.required' => 'Please select a category.',
        'spare_category_id.exists' => 'Selected category is invalid.',
        'unit.required' => 'Unit field is required.',
        'price.required' => 'Price field is required.',
        'price.min' => 'Price must be at least 0.',
        'preview_image.required' => 'Preview image is required.',
        'preview_image.image' => 'Preview image must be a valid image file.',
        'preview_image.max' => 'Preview image must not exceed 2MB.',
        'stock_quantity.required' => 'Stock quantity is required.',
        'stock_quantity.min' => 'Stock quantity must be at least 0.',
        'minimum_stock.required' => 'Minimum stock is required.',
        'minimum_stock.min' => 'Minimum stock must be at least 0.',
    ];

    // Lifecycle hooks
    public function updatedSpareCategoryId()
    {
        $this->spare_brand_id = '';
        $this->spare_model_id = '';
    }

    public function updatedSpareBrandId()
    {
        $this->spare_model_id = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    // Modal management
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->editMode = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    // CRUD Operations
    public function editSparePart($id)
    {
        try {
            $sparePart = SparePart::findOrFail($id);
            
            // Check if user owns this spare part
            if ($sparePart->shop_id !== auth()->user()->shop_id) {
                session()->flash('error', 'Unauthorized access to spare part.');
                return;
            }
            
            $this->sparePartId = $id;
            $this->spare_category_id = $sparePart->spare_category_id;
            $this->spare_brand_id = $sparePart->spare_brand_id;
            $this->spare_model_id = $sparePart->spare_model_id;
            $this->unit = $sparePart->unit;
            $this->price_type = $sparePart->price_type;
            $this->price = $sparePart->price;
            $this->description = $sparePart->description;
            $this->stock_quantity = $sparePart->stock_quantity ?? 0;
            $this->minimum_stock = $sparePart->minimum_stock ?? 0;
            $this->status = $sparePart->status ?? 'available';
            
            $this->current_preview_image = $sparePart->preview_image;
            $this->current_additional_image_1 = $sparePart->additional_image_1;
            $this->current_additional_image_2 = $sparePart->additional_image_2;
            
            // Reset removal flags
            $this->remove_preview_image = false;
            $this->remove_additional_image_1 = false;
            $this->remove_additional_image_2 = false;
            
            $this->editMode = true;
            $this->showModal = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading spare part for editing: ' . $e->getMessage());
        }
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
                'stock_quantity' => $this->stock_quantity,
                'minimum_stock' => $this->minimum_stock,
                'status' => $this->status,
            ];

            if ($this->editMode) {
                $sparePart = SparePart::findOrFail($this->sparePartId);
                
                // Check ownership
                if ($sparePart->shop_id !== auth()->user()->shop_id) {
                    session()->flash('error', 'Unauthorized access to spare part.');
                    return;
                }
                
                // Handle image updates
                $this->handleImageUpdates($sparePart, $data);
                
                $sparePart->update($data);
                session()->flash('message', 'Spare part updated successfully!');
                
            } else {
                // Handle new image uploads
                $this->handleNewImageUploads($data);
                
                SparePart::create($data);
                session()->flash('message', 'Spare part created successfully!');
            }

            $this->resetForm();
            $this->showModal = false;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error saving spare part: ' . $e->getMessage());
        }
    }

    public function confirmDeletion($id)
    {
        $sparePart = SparePart::find($id);
        
        if (!$sparePart || $sparePart->shop_id !== auth()->user()->shop_id) {
            session()->flash('error', 'Spare part not found or unauthorized access.');
            return;
        }
        
        $this->sparePartToDelete = $id;
        $this->confirmingDeletion = true;
    }

    public function deleteSparePart()
    {
        try {
            $sparePart = SparePart::findOrFail($this->sparePartToDelete);
            
            // Check ownership
            if ($sparePart->shop_id !== auth()->user()->shop_id) {
                session()->flash('error', 'Unauthorized access to spare part.');
                return;
            }
            
            // Delete images from storage
            $this->deleteSparePartImages($sparePart);
            
            // Delete the spare part
            $sparePart->delete();
            
            session()->flash('message', 'Spare part deleted successfully!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting spare part: ' . $e->getMessage());
        } finally {
            $this->confirmingDeletion = false;
            $this->sparePartToDelete = null;
        }
    }

    public function cancelDeletion()
    {
        $this->confirmingDeletion = false;
        $this->sparePartToDelete = null;
    }

    // Image management methods
    public function removeCurrentImage($imageType)
    {
        switch ($imageType) {
            case 'preview':
                $this->remove_preview_image = true;
                $this->current_preview_image = '';
                break;
            case 'additional_1':
                $this->remove_additional_image_1 = true;
                $this->current_additional_image_1 = '';
                break;
            case 'additional_2':
                $this->remove_additional_image_2 = true;
                $this->current_additional_image_2 = '';
                break;
        }
    }

    private function handleImageUpdates($sparePart, &$data)
    {
        // Handle preview image
        if ($this->preview_image) {
            // Delete old image if exists
            if ($sparePart->preview_image) {
                Storage::delete('public/' . $sparePart->preview_image);
            }
            $data['preview_image'] = $this->storeImage($this->preview_image, 'spare-parts');
        } elseif ($this->remove_preview_image) {
            // Remove image
            if ($sparePart->preview_image) {
                Storage::delete('public/' . $sparePart->preview_image);
            }
            $data['preview_image'] = null;
        } else {
            // Keep current image
            $data['preview_image'] = $sparePart->preview_image;
        }

        // Handle additional image 1
        if ($this->additional_image_1) {
            if ($sparePart->additional_image_1) {
                Storage::delete('public/' . $sparePart->additional_image_1);
            }
            $data['additional_image_1'] = $this->storeImage($this->additional_image_1, 'spare-parts');
        } elseif ($this->remove_additional_image_1) {
            if ($sparePart->additional_image_1) {
                Storage::delete('public/' . $sparePart->additional_image_1);
            }
            $data['additional_image_1'] = null;
        } else {
            $data['additional_image_1'] = $sparePart->additional_image_1;
        }

        // Handle additional image 2
        if ($this->additional_image_2) {
            if ($sparePart->additional_image_2) {
                Storage::delete('public/' . $sparePart->additional_image_2);
            }
            $data['additional_image_2'] = $this->storeImage($this->additional_image_2, 'spare-parts');
        } elseif ($this->remove_additional_image_2) {
            if ($sparePart->additional_image_2) {
                Storage::delete('public/' . $sparePart->additional_image_2);
            }
            $data['additional_image_2'] = null;
        } else {
            $data['additional_image_2'] = $sparePart->additional_image_2;
        }
    }

    private function handleNewImageUploads(&$data)
    {
        if ($this->preview_image) {
            $data['preview_image'] = $this->storeImage($this->preview_image, 'spare-parts');
        }
        if ($this->additional_image_1) {
            $data['additional_image_1'] = $this->storeImage($this->additional_image_1, 'spare-parts');
        }
        if ($this->additional_image_2) {
            $data['additional_image_2'] = $this->storeImage($this->additional_image_2, 'spare-parts');
        }
    }

    private function deleteSparePartImages($sparePart)
    {
        $images = [
            $sparePart->preview_image,
            $sparePart->additional_image_1,
            $sparePart->additional_image_2
        ];

        foreach ($images as $image) {
            if ($image && Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }
    }

    private function storeImage($image, $folder)
    {
        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
        return $image->storeAs($folder, $filename, 'public');
    }

    // Sorting
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

    // Form reset
    private function resetForm()
    {
        $this->reset([
            'spare_category_id', 'spare_brand_id', 'spare_model_id',
            'unit', 'price_type', 'price', 'description', 'stock_quantity', 'minimum_stock', 'status',
            'preview_image', 'additional_image_1', 'additional_image_2',
            'current_preview_image', 'current_additional_image_1', 'current_additional_image_2',
            'remove_preview_image', 'remove_additional_image_1', 'remove_additional_image_2',
            'sparePartId'
        ]);
        $this->price_type = 'per_unit';
        $this->status = 'available';
        $this->stock_quantity = 0;
        $this->minimum_stock = 0;
    }

    // Render method
    public function render()
    {
        $categories = SpareCategory::orderBy('name')->get();
        $brands = $this->spare_category_id ? 
            SpareBrand::where('spare_category_id', $this->spare_category_id)->orderBy('name')->get() : 
            collect();
        $models = $this->spare_brand_id ? 
            SpareModel::where('spare_brand_id', $this->spare_brand_id)->orderBy('name')->get() : 
            collect();

        $spareParts = SparePart::with(['spareCategory', 'spareBrand', 'spareModel'])
            ->where('shop_id', auth()->user()->shop_id)
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('unit', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhereHas('spareCategory', function($cat) {
                          $cat->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('spareBrand', function($brand) {
                          $brand->where('name', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->categoryFilter, function($query) {
                $query->where('spare_category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(12);

        return view('livewire.shop.spare-parts-management', [
            'categories' => $categories,
            'brands' => $brands,
            'models' => $models,
            'spareParts' => $spareParts
        ]);
    }
}