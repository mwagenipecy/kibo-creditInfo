<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class LenderFinancingOffer extends Model
{

    use HasFactory;

    protected $fillable = [
        'application_id',
        'lender_id',
        'offer_number',
        'total_financing_amount',
        'down_payment_required',
        'loan_amount',
        'interest_rate_annual',
        'loan_tenure_months',
        'monthly_installment',
        'total_repayment',
        'processing_fee',
        'insurance_fee',
        'legal_fee',
        'other_fees',
        'total_fees',
        'minimum_income_required',
        'employment_type_required',
        'collateral_required',
        'guarantor_required',
        'additional_requirements',
        'status',
        'priority_order',
        'validity_hours',
        'conditions',
        'submitted_at',
        'expires_at',
        'response_deadline',
        'accepted_at',
    ];

    protected $casts = [
        'total_financing_amount' => 'decimal:2',
        'down_payment_required' => 'decimal:2',
        'loan_amount' => 'decimal:2',
        'interest_rate_annual' => 'decimal:2',
        'monthly_installment' => 'decimal:2',
        'total_repayment' => 'decimal:2',
        'processing_fee' => 'decimal:2',
        'insurance_fee' => 'decimal:2',
        'legal_fee' => 'decimal:2',
        'other_fees' => 'decimal:2',
        'total_fees' => 'decimal:2',
        'minimum_income_required' => 'decimal:2',
        'guarantor_required' => 'boolean',
        'submitted_at' => 'datetime',
        'expires_at' => 'datetime',
        'response_deadline' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(ImportDutyApplication::class, 'application_id');
    }

    public function lender()
    {
        return $this->belongsTo(Lender::class, 'lender_id');
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'DRAFT' => 'bg-gray-100 text-gray-800',
            'SUBMITTED' => 'bg-blue-100 text-blue-800',
            'ACCEPTED' => 'bg-green-100 text-green-800',
            'REJECTED' => 'bg-red-100 text-red-800',
            'EXPIRED' => 'bg-red-100 text-red-800',
            'WITHDRAWN' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

 

    public function getEffectiveInterestRate(): float
    {
        // Calculate effective interest rate including fees
        $totalCost = $this->total_repayment + $this->total_fees;
        $effectiveRate = (($totalCost / $this->loan_amount) - 1) / ($this->loan_tenure_months / 12);
        return round($effectiveRate * 100, 2);
    }






    /**
     * Relationship with Lender
     */
 

    /**
     * Get status badge CSS class
     */
  

    /**
     * Get human-readable status text
     */
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'DRAFT' => 'Draft',
            'SUBMITTED' => 'Submitted',
            'ACCEPTED' => 'Accepted',
            'REJECTED' => 'Rejected',
            'EXPIRED' => 'Expired',
            'WITHDRAWN' => 'Withdrawn',
            default => 'Unknown',
        };
    }

    /**
     * Check if offer is expired
     */
    public function isExpired()
    {
        return $this->expires_at && Carbon::now()->gt($this->expires_at);
    }

    /**
     * Check if offer is still valid
     */
    public function isValid()
    {
        return $this->status === 'SUBMITTED' && !$this->isExpired();
    }

    /**
     * Check if offer can be modified
     */
    public function canBeModified()
    {
        return in_array($this->status, ['DRAFT', 'SUBMITTED']) && !$this->isExpired();
    }

    /**
     * Check if offer can be withdrawn
     */
    public function canBeWithdrawn()
    {
        return $this->status === 'SUBMITTED' && !$this->isExpired();
    }

    /**
     * Calculate monthly installment using PMT formula
     */
    public function calculateMonthlyInstallment()
    {
        if ($this->loan_amount <= 0 || $this->loan_tenure_months <= 0 || $this->interest_rate_annual <= 0) {
            return 0;
        }

        $monthlyRate = ($this->interest_rate_annual / 100) / 12;
        $numberOfPayments = $this->loan_tenure_months;

        // PMT formula: P * [r(1+r)^n] / [(1+r)^n - 1]
        $denominator = pow(1 + $monthlyRate, $numberOfPayments) - 1;
        
        if ($denominator > 0) {
            return round(
                ($this->loan_amount * $monthlyRate * pow(1 + $monthlyRate, $numberOfPayments)) / $denominator,
                2
            );
        }

        return round($this->loan_amount / $numberOfPayments, 2);
    }

    /**
     * Calculate total repayment amount
     */
    public function calculateTotalRepayment()
    {
        return round($this->calculateMonthlyInstallment() * $this->loan_tenure_months, 2);
    }

    /**
     * Calculate total interest amount
     */
    public function getTotalInterestAttribute()
    {
        return round($this->total_repayment - $this->loan_amount, 2);
    }

    /**
     * Get effective APR including fees
     */
    public function getEffectiveAprAttribute()
    {
        if ($this->loan_amount <= 0) {
            return 0;
        }

        $totalCostOfCredit = $this->total_interest + $this->total_fees;
        return round(($totalCostOfCredit / $this->loan_amount) * (12 / $this->loan_tenure_months) * 100, 2);
    }

    /**
     * Get debt-to-income ratio if minimum income is specified
     */
    public function getDebtToIncomeRatioAttribute()
    {
        if (!$this->minimum_income_required || $this->minimum_income_required <= 0) {
            return null;
        }

        return round(($this->monthly_installment / $this->minimum_income_required) * 100, 2);
    }

    /**
     * Get time until expiration
     */
    public function getTimeUntilExpirationAttribute()
    {
        if (!$this->expires_at) {
            return null;
        }

        $now = Carbon::now();
        if ($now->gt($this->expires_at)) {
            return 'Expired';
        }

        return $now->diffForHumans($this->expires_at, true);
    }

    /**
     * Generate unique offer number
     */
    public static function generateOfferNumber($lenderId)
    {
        $year = date('Y');
        $sequence = static::where('lender_id', $lenderId)
            ->whereYear('created_at', $year)
            ->count() + 1;
        
        return 'LO' . $lenderId . $year . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Boot method to handle automatic calculations and validations
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($offer) {
            // Generate offer number if not provided
            if (empty($offer->offer_number)) {
                $offer->offer_number = static::generateOfferNumber($offer->lender_id);
            }

            // Calculate monthly installment and total repayment
            $offer->monthly_installment = $offer->calculateMonthlyInstallment();
            $offer->total_repayment = $offer->calculateTotalRepayment();

            // Calculate total fees
            $offer->total_fees = ($offer->processing_fee ?? 0) + 
                               ($offer->insurance_fee ?? 0) + 
                               ($offer->legal_fee ?? 0) + 
                               ($offer->other_fees ?? 0);

            // Set expiration date if submitted
            if ($offer->status === 'SUBMITTED' && !$offer->expires_at) {
                $offer->expires_at = now()->addHours($offer->validity_hours ?? 48);
            }

            // Set submitted timestamp
            if ($offer->status === 'SUBMITTED' && !$offer->submitted_at) {
                $offer->submitted_at = now();
            }
        });

        static::updating(function ($offer) {
            // Recalculate if loan parameters changed
            if ($offer->isDirty(['loan_amount', 'interest_rate_annual', 'loan_tenure_months'])) {
                $offer->monthly_installment = $offer->calculateMonthlyInstallment();
                $offer->total_repayment = $offer->calculateTotalRepayment();
            }

            // Recalculate total fees if fee components changed
            if ($offer->isDirty(['processing_fee', 'insurance_fee', 'legal_fee', 'other_fees'])) {
                $offer->total_fees = ($offer->processing_fee ?? 0) + 
                                   ($offer->insurance_fee ?? 0) + 
                                   ($offer->legal_fee ?? 0) + 
                                   ($offer->other_fees ?? 0);
            }

            // Set timestamps for status changes
            if ($offer->isDirty('status')) {
                if ($offer->status === 'SUBMITTED' && !$offer->submitted_at) {
                    $offer->submitted_at = now();
                    if (!$offer->expires_at) {
                        $offer->expires_at = now()->addHours($offer->validity_hours ?? 48);
                    }
                }

                if ($offer->status === 'ACCEPTED' && !$offer->accepted_at) {
                    $offer->accepted_at = now();
                }
            }
        });
    }

    /**
     * Scope for active offers (submitted and not expired)
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'SUBMITTED')
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope for offers by lender
     */
    public function scopeByLender($query, $lenderId)
    {
        return $query->where('lender_id', $lenderId);
    }

    /**
     * Scope for offers by application
     */
    public function scopeByApplication($query, $applicationId)
    {
        return $query->where('application_id', $applicationId);
    }

    /**
     * Scope for filtering by status
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for offers expiring soon
     */
    public function scopeExpiringSoon($query, $hours = 24)
    {
        return $query->where('status', 'SUBMITTED')
                    ->where('expires_at', '<=', now()->addHours($hours))
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope for ordering by priority
     */
    public function scopeOrderByPriority($query)
    {
        return $query->orderBy('priority_order', 'asc')
                    ->orderBy('interest_rate_annual', 'asc')
                    ->orderBy('total_fees', 'asc');
    }



    
}