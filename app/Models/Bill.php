<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'bill_number',
        'entity_type',
        'entity_id',
        'billing_period_start',
        'billing_period_end',
        'subtotal',
        'tax_amount',
        'total_amount',
        'currency',
        'status',
        'due_date',
        'issued_date',
        'paid_date',
        'payment_method',
        'payment_reference',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'billing_period_start' => 'date',
        'billing_period_end' => 'date',
        'due_date' => 'date',
        'issued_date' => 'date',
        'paid_date' => 'date'
    ];

    public function billItems()
    {
        return $this->hasMany(BillItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function entity()
    {
        if ($this->entity_type === 'lender') {
            return $this->belongsTo(Lender::class, 'entity_id');
        }
        return $this->belongsTo(CarDealer::class, 'entity_id');
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 'completed')->sum('amount');
    }

    public function getRemainingBalanceAttribute()
    {
        return $this->total_amount - $this->total_paid;
    }

    public function isFullyPaid(): bool
    {
        return $this->remaining_balance <= 0;
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($bill) {
            $bill->bill_number = 'BILL-' . date('Y') . '-' . str_pad(
                static::whereYear('created_at', date('Y'))->count() + 1, 
                4, 
                '0', 
                STR_PAD_LEFT
            );
        });
    }
}