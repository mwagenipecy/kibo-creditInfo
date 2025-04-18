<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id'
    ];

    /**
     * Get the region that owns the city.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
