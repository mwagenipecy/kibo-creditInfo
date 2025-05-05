<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;


    use HasFactory;
    
    protected $fillable = ['make_id', 'name'];
    
    // Relationships
    public function make()
    {
        return $this->belongsTo(Make::class);
    }
    
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class,'model_id');
    }


    
}
