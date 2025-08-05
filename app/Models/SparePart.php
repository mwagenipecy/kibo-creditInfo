<?php

// app/Models/SparePart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
