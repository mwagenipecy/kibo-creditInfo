<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CFQuotation extends Model
{
    use HasFactory; 

    protected $guarded= [];

    protected $table = 'cf_quotations';

    
    protected $casts = [
        'import_duty' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'railway_development_levy' => 'decimal:2',
        'excise_duty' => 'decimal:2',
        'service_levy' => 'decimal:2',
        'other_charges' => 'decimal:2',
        'total_duties_taxes' => 'decimal:2',
        'clearing_fee' => 'decimal:2',
        'forwarding_fee' => 'decimal:2',
        'documentation_fee' => 'decimal:2',
        'port_charges' => 'decimal:2',
        'transportation_fee' => 'decimal:2',
        'storage_charges' => 'decimal:2',
        'other_service_fees' => 'decimal:2',
        'total_service_fees' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'submitted_at' => 'datetime',
        'expires_at' => 'datetime',
        'selected_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(ImportDutyApplication::class, 'application_id');
    }

    public function cfCompany()
    {
        return $this->belongsTo(ClearingForwardingCompany::class, 'cf_company_id');
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'DRAFT' => 'bg-gray-100 text-gray-800',
            'SUBMITTED' => 'bg-blue-100 text-blue-800',
            'SELECTED' => 'bg-green-100 text-green-800',
            'EXPIRED' => 'bg-red-100 text-red-800',
            'WITHDRAWN' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

}
