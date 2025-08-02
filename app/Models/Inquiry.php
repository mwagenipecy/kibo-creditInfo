<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'dealer_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];

    // Relationships
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function dealer()
    {
        return $this->belongsTo(CarDealer::class);
    }
}
