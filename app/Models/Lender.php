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
        'status',
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
        return match ($this->status) {
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





    // // Accessors
    // public function getLogoUrlAttribute()
    // {
    //     if ($this->logo) {
    //         return asset('storage/' . $this->logo);
    //     }
    //     return asset('images/default-lender-logo.png');
    // }

    public function getFormattedEstablishedYearAttribute()
    {
        return $this->established_year ? 'Established ' . $this->established_year : '';
    }

    // Methods
    public function canFinanceVehicle($makeId, $modelId, $vehiclePrice, $vehicleYear = null)
    {
        return $this->financingCriteria()
            ->where('make_id', $makeId)
            ->where('model_id', $modelId)
            ->where('status', 'active')
            ->where('min_loan_amount', '<=', $vehiclePrice)
            ->where('max_loan_amount', '>=', $vehiclePrice)
            ->when($vehicleYear, function($query) use ($vehicleYear) {
                $query->where(function($q) use ($vehicleYear) {
                    $q->whereNull('min_vehicle_year')
                      ->orWhere('min_vehicle_year', '<=', $vehicleYear);
                })
                ->where(function($q) use ($vehicleYear) {
                    $q->whereNull('max_vehicle_year')
                      ->orWhere('max_vehicle_year', '>=', $vehicleYear);
                });
            })
            ->exists();
    }

    public function getFinancingCriteriaForVehicle($makeId, $modelId)
    {
        return $this->financingCriteria()
            ->where('make_id', $makeId)
            ->where('model_id', $modelId)
            ->where('status', 'active')
            ->first();
    }

    public function getSupportedMakes()
    {
        return Make::whereHas('financingCriteria', function($query) {
            $query->where('lender_id', $this->id)
                  ->where('status', 'active');
        })->orderBy('name')->get();
    }

    public function getSupportedModelsForMake($makeId)
    {
        return VehicleModel::whereHas('financingCriteria', function($query) use ($makeId) {
            $query->where('lender_id', $this->id)
                  ->where('make_id', $makeId)
                  ->where('status', 'active');
        })->orderBy('name')->get();
    }

    public function getMinInterestRate()
    {
        return $this->financingCriteria()
            ->where('status', 'active')
            ->min('interest_rate');
    }

    public function getMaxInterestRate()
    {
        return $this->financingCriteria()
            ->where('status', 'active')
            ->max('interest_rate');
    }

    public function getInterestRateRange()
    {
        $min = $this->getMinInterestRate();
        $max = $this->getMaxInterestRate();

        if ($min && $max) {
            if ($min == $max) {
                return $min . '%';
            }
            return $min . '% - ' . $max . '%';
        }

        return $this->interest_rate_range;
    }

    public function getLoanTermsArray()
    {
        if ($this->loan_terms_range) {
            // Assuming format like "12-60" for 12 to 60 months
            $range = explode('-', $this->loan_terms_range);
            if (count($range) == 2) {
                $start = (int) $range[0];
                $end = (int) $range[1];

                $terms = [];
                for ($i = $start; $i <= $end; $i += 6) {
                    $terms[] = $i;
                }

                // Ensure end value is included
                if (!in_array($end, $terms)) {
                    $terms[] = $end;
                }

                return $terms;
            }
        }

        // Default terms if no range specified
        return [12, 18, 24, 30, 36, 42, 48, 54, 60];
    }

    public function getMinLoanAmount()
    {
        return $this->financingCriteria()
            ->where('status', 'active')
            ->min('min_loan_amount');
    }

    public function getMaxLoanAmount()
    {
        return $this->financingCriteria()
            ->where('status', 'active')
            ->max('max_loan_amount');
    }

    public function getLoanAmountRange()
    {
        $min = $this->getMinLoanAmount();
        $max = $this->getMaxLoanAmount();

        if ($min && $max) {
            return 'TZS ' . number_format($min) . ' - ' . number_format($max);
        }

        return 'Contact for details';
    }

    public function getTotalApplications()
    {
        return $this->applications()->count();
    }

    public function getApprovedApplications()
    {
        return $this->applications()->where('application_status', 'approved')->count();
    }

    public function getApprovalRate()
    {
        $total = $this->getTotalApplications();
        if ($total == 0) {
            return 0;
        }

        $approved = $this->getApprovedApplications();
        return round(($approved / $total) * 100, 1);
    }




}
