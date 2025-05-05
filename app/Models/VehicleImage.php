<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;
    
    protected $fillable = ['vehicle_id', 'image_url', 'is_featured'];
    
    protected $casts = [
        'is_featured' => 'boolean',
    ];
    
    // Relationships
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}