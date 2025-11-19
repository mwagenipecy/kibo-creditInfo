<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InsuranceQuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'insurable_value',
        'year',
        'start_date',
        'vehicle_class',
        'type_of_cover',
        'claim_status',
        'no_passengers',
        'total_premium',
        'premium_breakdown',
        'document_path',
        'status',
    ];

    protected $casts = [
        'premium_breakdown' => 'array',
        'start_date' => 'date',
    ];
}



