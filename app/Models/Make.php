<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'logo'];
    
    // Relationships
    public function models()
    {
        return $this->hasMany(Model::class);
    }
    
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}