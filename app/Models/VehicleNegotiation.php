<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleNegotiation extends Model
{
    protected $fillable = [
        'vehicle_id',
        'buyer_id',
        'seller_id',
        'offered_price',
        'status'
    ];

    protected $casts = [
        'offered_price' => 'decimal:2'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function messages()
    {
        return $this->hasMany(NegotiationMessage::class, 'negotiation_id');
    }
}

