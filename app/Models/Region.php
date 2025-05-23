<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_code'
    ];

    /**
     * Get the cities for the region.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
    
}
