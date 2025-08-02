<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingConfiguration extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id',
        'billing_type',
        'rate',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function entity()
    {
        if ($this->entity_type === 'lender') {
            return $this->belongsTo(Lender::class, 'entity_id');
        }

        return $this->belongsTo(CarDealer::class, 'entity_id');
    }
}
