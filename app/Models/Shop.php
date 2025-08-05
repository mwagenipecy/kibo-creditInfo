<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'owner_name',
        'phone_number',
        'email',
        'shop_type',
        'latitude',
        'longitude',
        'address'
    ];

    public function spareParts()
    {
        return $this->hasMany(SparePart::class);
    }
}
