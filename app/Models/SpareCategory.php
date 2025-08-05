<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpareCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brands()
{
    return $this->hasMany(SpareBrand::class);
}


public function spareParts()
{
    return $this->hasMany(SparePart::class);
}

}
