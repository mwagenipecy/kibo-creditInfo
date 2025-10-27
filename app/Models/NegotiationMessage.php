<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NegotiationMessage extends Model
{
    protected $fillable = [
        'negotiation_id',
        'sender_id',
        'message'
    ];

    public function negotiation()
    {
        return $this->belongsTo(VehicleNegotiation::class, 'negotiation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
