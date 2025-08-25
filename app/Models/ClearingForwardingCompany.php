<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearingForwardingCompany extends Model
{
    use HasFactory;

    protected $guarded = [];   
    
    

    protected $fillable = [
        'company_name',
        'registration_number',
        'tra_license_number',
        'contact_person_name',
        'contact_person_position',
        'phone_number',
        'email',
        'physical_address',
        'postal_address',
        'region',
        'city',
        'website',
        'years_in_operation',
        'specializations',
        'service_ports',
        'average_clearance_time_days',
        'languages_supported',
        'operating_hours',
        'verification_documents',
        'status',
        'verified_at',
        'verified_by',
        'rating',
        'total_applications_handled',
        'average_response_time_hours',
        'success_rate_percentage',
    ];

    protected $casts = [
        'specializations' => 'array',
        'service_ports' => 'array',
        'verification_documents' => 'array',
        'verified_at' => 'datetime',
        'rating' => 'decimal:2',
        'average_response_time_hours' => 'decimal:2',
        'success_rate_percentage' => 'decimal:2',
    ];

    public function quotations()
    {
        return $this->hasMany(CFQuotation::class, 'cf_company_id');
    }

    public function applications()
    {
        return $this->hasMany(ImportDutyApplication::class, 'selected_cf_company_id');
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'PENDING' => 'bg-yellow-100 text-yellow-800',
            'VERIFIED' => 'bg-blue-100 text-blue-800',
            'APPROVED' => 'bg-green-100 text-green-800',
            'SUSPENDED' => 'bg-red-100 text-red-800',
            'REJECTED' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }


}
