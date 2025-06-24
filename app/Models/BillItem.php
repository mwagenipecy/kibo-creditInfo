<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $fillable = [
        'bill_id',
        'application_id',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'item_date'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'item_date' => 'date'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}