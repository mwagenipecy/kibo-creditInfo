<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpareBrand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
{
    return $this->belongsTo(SpareCategory::class, 'spare_category_id');
}


public function spareModels()
{
    return $this->hasMany(SpareModel::class);
}

public function models()
{
    return $this->hasMany(SpareModel::class);
}



}
