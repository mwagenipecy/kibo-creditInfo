<?php

// App/Models/ImportDutyApplication.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ImportDutyApplication extends Model
{
    protected $fillable = [
        'application_number',
        'applicant_name',
        'phone_number',
        'email',
        'national_id',
        'address',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'vehicle_vin',
        'vehicle_color',
        'vehicle_mileage',
        'vehicle_engine_size',
        'cif_value_usd',
        'cif_value_tzs',
        'currency_rate',
        'bill_of_lading',
        'commercial_invoice',
        'packing_list',
        'certificate_of_origin',
        'shipping_documents',
        'port_of_entry',
        'expected_arrival_date',
        'status',
        'selected_cf_company_id',
        'selected_lender_id',
        'total_duty_amount',
        'financing_amount',
        'down_payment',
        'loan_tenure_months',
        'interest_rate',
        'submitted_at',
        'cf_deadline',
        'lender_deadline',
        'approved_at',
    ];

    protected $casts = [
        'cif_value_usd' => 'decimal:2',
        'cif_value_tzs' => 'decimal:2',
        'currency_rate' => 'decimal:4',
        'total_duty_amount' => 'decimal:2',
        'financing_amount' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'submitted_at' => 'datetime',
        'cf_deadline' => 'datetime',
        'lender_deadline' => 'datetime',
        'approved_at' => 'datetime',
        'expected_arrival_date' => 'date',
        'shipping_documents' => 'array',
    ];

    public function cfQuotations(): HasMany
    {
        return $this->hasMany(CFQuotation::class, 'application_id');
    }

    public function selectedCFQuotation(): HasOne
    {
        return $this->hasOne(CFQuotation::class, 'application_id')->where('status', 'SELECTED');
    }

    public function selectedCFCompany(): BelongsTo
    {
        return $this->belongsTo(ClearingForwardingCompany::class, 'selected_cf_company_id');
    }

    public function lenderOffers(): HasMany
    {
        return $this->hasMany(LenderFinancingOffer::class, 'application_id');
    }

    public function selectedLender(): BelongsTo
    {
        return $this->belongsTo(Lender::class, 'selected_lender_id');
    }

    public function statusHistory(): HasMany
    {
        return $this->hasMany(ApplicationStatusHistory::class, 'application_id')
                   ->where('application_type', 'IMPORT_DUTY');
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'DRAFT' => 'bg-gray-100 text-gray-800',
            'SUBMITTED' => 'bg-blue-100 text-blue-800',
            'CF_QUOTATION' => 'bg-purple-100 text-purple-800',
            'CF_SELECTED' => 'bg-indigo-100 text-indigo-800',
            'LENDER_REVIEW' => 'bg-yellow-100 text-yellow-800',
            'APPROVED' => 'bg-green-100 text-green-800',
            'REJECTED' => 'bg-red-100 text-red-800',
            'PROCESSING' => 'bg-blue-100 text-blue-800',
            'DUTY_PAID' => 'bg-green-100 text-green-800',
            'COMPLETED' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getProgressPercentage(): int
    {
        return match($this->status) {
            'DRAFT' => 0,
            'SUBMITTED' => 17,
            'CF_QUOTATION' => 33,
            'CF_SELECTED' => 50,
            'LENDER_REVIEW' => 67,
            'APPROVED' => 83,
            'PROCESSING', 'DUTY_PAID' => 90,
            'COMPLETED' => 100,
            default => 0,
        };
    }

    public function getCurrentStepText(): string
    {
        return match($this->status) {
            'DRAFT' => 'Draft Application',
            'SUBMITTED' => 'Application Submitted',
            'CF_QUOTATION' => 'Awaiting CF Quotations',
            'CF_SELECTED' => 'CF Company Selected',
            'LENDER_REVIEW' => 'Lender Review',
            'APPROVED' => 'Financing Approved',
            'PROCESSING' => 'Processing Payment',
            'DUTY_PAID' => 'Duty Paid',
            'COMPLETED' => 'Vehicle Cleared',
            default => 'Unknown Status',
        };
    }






    public function isStatus($status)
    {
        return $this->status === $status;
    }

    /**
     * Check if application is ready for CF quotations
     */
    public function isReadyForCFQuotations()
    {
        return in_array($this->status, ['SUBMITTED', 'CF_QUOTATION']);
    }

    /**
     * Check if application is ready for lender offers
     */
    public function isReadyForLenderOffers()
    {
        return $this->status === 'CF_SELECTED' && $this->selectedCFQuotation;
    }

    /**
     * Check if application has expired deadlines
     */
    public function hasExpiredDeadlines()
    {
        $now = Carbon::now();
        
        return ($this->cf_deadline && $now->gt($this->cf_deadline)) ||
               ($this->lender_deadline && $now->gt($this->lender_deadline));
    }

    /**
     * Generate unique application number
     */
    public static function generateApplicationNumber()
    {
        $year = date('Y');
        $sequence = static::whereYear('created_at', $year)->count() + 1;
        
        return 'IDA' . $year . str_pad($sequence, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Boot method to auto-generate application number
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($application) {
            if (empty($application->application_number)) {
                $application->application_number = static::generateApplicationNumber();
            }
            
            if (empty($application->submitted_at) && $application->status === 'SUBMITTED') {
                $application->submitted_at = now();
            }
        });
        
        static::updating(function ($application) {
            // Set submitted_at when status changes to SUBMITTED
            if ($application->isDirty('status') && $application->status === 'SUBMITTED' && !$application->submitted_at) {
                $application->submitted_at = now();
            }
            
            // Set approved_at when status changes to APPROVED
            if ($application->isDirty('status') && $application->status === 'APPROVED' && !$application->approved_at) {
                $application->approved_at = now();
            }
        });
    }

    /**
     * Scope for filtering by status
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for search functionality
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('application_number', 'like', "%{$term}%")
              ->orWhere('applicant_name', 'like', "%{$term}%")
              ->orWhere('phone_number', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%")
              ->orWhere('vehicle_make', 'like', "%{$term}%")
              ->orWhere('vehicle_model', 'like', "%{$term}%")
              ->orWhere('vehicle_vin', 'like', "%{$term}%");
        });
    }

    /**
     * Scope for applications within date range
     */
    public function scopeCreatedBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }


    public function lenderFinancingOffers()
    {
        return $this->hasMany(LenderFinancingOffer::class, 'application_id');
    }

     
    /**
     * Get total number of CF quotations received
     */
    public function getCFQuotationCountAttribute()
    {
        return $this->cfQuotations()->count();
    }

    /**
     * Get total number of lender offers received
     */
    public function getLenderOfferCountAttribute()
    {
        return $this->lenderFinancingOffers()->count();
    }

    /**
     * Check if application has any pending offers
     */
    public function hasPendingOffers()
    {
        return $this->lenderFinancingOffers()
            ->where('status', 'SUBMITTED')
            ->where('expires_at', '>', now())
            ->exists();
    }

    /**
     * Get the best lender offer (lowest interest rate)
     */
    public function getBestLenderOffer()
    {
        return $this->lenderFinancingOffers()
            ->where('status', 'SUBMITTED')
            ->where('expires_at', '>', now())
            ->orderBy('interest_rate_annual', 'asc')
            ->orderBy('total_fees', 'asc')
            ->first();
    }



}





// App/Models/LenderFinancingOffer.php
// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;



