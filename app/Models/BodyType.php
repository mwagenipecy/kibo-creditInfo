<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyType extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    // Relationships
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
