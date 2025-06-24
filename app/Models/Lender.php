<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_registration_number',
        'tax_identification_number',
        'phone_number',
        'email',
        'website',
        'region',
        'city',
        'address',
        'postal_code',
        'country',
        'contact_person_name',
        'contact_person_position',
        'contact_person_phone',
        'contact_person_email',
        'lender_type',
        'financial_license_number',
        'minimum_loan_amount',
        'maximum_loan_amount',
        'interest_rate_range',
        'loan_terms_range',
        'bank_account_details',
        'payment_methods',
        'settlement_period',
        'operating_hours',
        'services_offered',
        'additional_notes',
        'logo',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'minimum_loan_amount' => 'decimal:2',
        'maximum_loan_amount' => 'decimal:2',
        'payment_methods' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the documents for the lender.
     */
    public function documents()
    {
        return $this->hasMany(PartnerDocument::class, 'partner_id')
            ->where('partner_type', 'lender');
    }

    /**
     * Get the loan products for the lender.
     */
    public function loanProducts()
    {
        return $this->hasMany(LoanProduct::class);
    }

    /**
     * Get the logo URL attribute.
     *
     * @return string|null
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    /**
     * Get the status badge HTML.
     *
     * @return string
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'APPROVED' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>',
            'PENDING' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'REJECTED' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>',
            default => '',
        };
    }

    /**
     * Scope a query to only include pending lenders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'PENDING');
    }

    /**
     * Scope a query to only include approved lenders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'APPROVED');
    }

    /**
     * Scope a query to only include rejected lenders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'REJECTED');
    }



    public function bills()
    {
        return $this->hasMany(Bill::class, 'entity_id')->where('entity_type', 'lender');
    }

    public function billingConfiguration()
    {
        return $this->hasOne(BillingConfiguration::class, 'entity_id')->where('entity_type', 'lender');
    }


    public function financingCriteria()
    {
        return $this->hasMany(LenderFinancingCriteria::class);
    }

    
    
}
