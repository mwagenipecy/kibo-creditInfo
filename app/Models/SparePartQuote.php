<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'spare_part_request_id',
        'shop_id',
        'price',
        'currency',
        'delivery_time',
        'warranty_info',
        'additional_notes',
        'payment_link',
        'status',
        'expires_at'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'expires_at' => 'datetime',
    ];

    // Relationships
    public function sparePartRequest()
    {
        return $this->belongsTo(SparePartRequest::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function payment()
    {
        return $this->hasOne(SparePartPayment::class, 'quote_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    // Helper methods
    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isPaid()
    {
        return $this->payment && $this->payment->payment_status === 'completed';
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' ' . $this->currency;
    }
}
