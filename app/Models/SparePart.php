<?php

// app/Models/SparePart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SparePart extends Model
{
    protected $fillable = [
        'shop_id',
        'spare_category_id',
        'spare_brand_id',
        'spare_model_id',
        'unit',
        'price_type',
        'price',
        'preview_image',
        'additional_image_1',
        'additional_image_2',
        'description',
    ];

    // Relationships

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function spareCategory()
    {
        return $this->belongsTo(SpareCategory::class, 'spare_category_id');
    }



    public function spareBrand()
    {
        return $this->belongsTo(SpareBrand::class, 'spare_brand_id');
    }

    public function spareModel()
    {
        return $this->belongsTo(SpareModel::class, 'spare_model_id');
    }



    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('unit', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereHas('spareCategory', function ($cat) use ($search) {
                  $cat->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('spareBrand', function ($brand) use ($search) {
                  $brand->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('spareModel', function ($model) use ($search) {
                  $model->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Methods
    public function updateStock($quantity, $operation = 'subtract')
    {
        if ($operation === 'add') {
            $this->increment('stock_quantity', $quantity);
        } else {
            $this->decrement('stock_quantity', $quantity);
        }

        // Auto update status based on stock
        if ($this->stock_quantity <= 0) {
            $this->update(['status' => 'out_of_stock']);
        } elseif ($this->status === 'out_of_stock' && $this->stock_quantity > 0) {
            $this->update(['status' => 'available']);
        }
    }

    public function getImages()
    {
        $images = [];
        
        if ($this->preview_image) {
            $images[] = $this->preview_image_url;
        }
        
        if ($this->additional_image_1) {
            $images[] = $this->additional_image_1_url;
        }
        
        if ($this->additional_image_2) {
            $images[] = $this->additional_image_2_url;
        }
        
        return $images;
    }

    public function deleteImages()
    {
        $images = [
            $this->preview_image,
            $this->additional_image_1,
            $this->additional_image_2
        ];

        foreach ($images as $image) {
            if ($image && Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }
    }

    // Boot method
    protected static function boot()
    {
        parent::boot();

        // When deleting, also delete associated images
        static::deleting(function ($sparePart) {
            $sparePart->deleteImages();
        });
    }



    public function getFormattedPriceAttribute()
    {
        return 'TZS ' . number_format($this->price, 2);
    }

    public function getPreviewImageUrlAttribute()
    {
        return $this->preview_image ? Storage::url($this->preview_image) : null;
    }

    public function getAdditionalImage1UrlAttribute()
    {
        return $this->additional_image_1 ? Storage::url($this->additional_image_1) : null;
    }

    public function getAdditionalImage2UrlAttribute()
    {
        return $this->additional_image_2 ? Storage::url($this->additional_image_2) : null;
    }

    public function getFormattedPriceTypeAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->price_type));
    }

    public function getFormattedStatusAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    public function getIsLowStockAttribute()
    {
        return $this->stock_quantity <= $this->minimum_stock;
    }

    public function getFullNameAttribute()
    {
        $parts = [];
        
        if ($this->spareBrand) {
            $parts[] = $this->spareBrand->name;
        }
        
        if ($this->spareModel) {
            $parts[] = $this->spareModel->name;
        }
        
        $parts[] = $this->unit;
        
        return implode(' - ', $parts);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('status', 'out_of_stock');
    }

    public function scopeDiscontinued($query)
    {
        return $query->where('status', 'discontinued');
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock_quantity', '<=', 'minimum_stock');
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('spare_category_id', $categoryId);
    }

    public function scopeByBrand($query, $brandId)
    {
        return $query->where('spare_brand_id', $brandId);
    }

    public function scopeByModel($query, $modelId)
    {
        return $query->where('spare_model_id', $modelId);
    }

    public function scopeByShop($query, $shopId)
    {
        return $query->where('shop_id', $shopId);
    }




}
