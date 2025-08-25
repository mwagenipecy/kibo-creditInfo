<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function lender(){

        return $this->belongsTo(Lender::class,'lender_id');
    }


    public function billItems()
    {
        return $this->hasMany(BillItem::class);
    }

    public function carDealer()
    {
        return $this->belongsTo(CarDealer::class, 'car_dealer_id');
    }


    // Check if application has been billed
    public function isBilled(): bool
    {
        return $this->billItems()->exists();
    }

    // Get the total amount billed for this application
    public function getTotalBilledAttribute(): float
    {
        return $this->billItems()->sum('total_price');
    }

    // Scope for billable applications
    public function scopeBillable($query)
    {
        return $query->whereIn('application_status', ['APPROVED', 'COMPLETED', 'DISBURSED'])
                    ->whereDoesntHave('billItems');
    }


    public function scopeApproved($query)
    {
        return $query->whereIn('application_status', ['APPROVED', 'COMPLETED', 'DISBURSED']);
    }

    // Get loan amount with fallbacks
    public function getLoanAmountAttribute($value)
    {
        return $value ?? $this->amount ?? $this->purchase_price ?? 0;
    }

    // Get full applicant name
    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->middle_name ?? '') . ' ' . ($this->last_name ?? ''));
    }

    // Check if application is approved/completed
    public function isApproved(): bool
    {
        return in_array($this->application_status, ['APPROVED', 'COMPLETED', 'DISBURSED']);
    }





    // protected $fillable = [
    //     'application_type', // Add this field
    //     'import_duty_application_id', // Add this field
    //     'first_name',
    //     'middle_name',
    //     'last_name',
    //     'phone_number',
    //     'national_id',
    //     'region',
    //     'district',
    //     'street',
    //     'amount',
    //     'email',
    //     'application_status',
    //     'make_and_model',
    //     'year_of_manufacture',
    //     'vin',
    //     'color',
    //     'mileage',
    //     'purchase_price',
    //     'down_payment',
    //     'loan_id',
    //     'loan_amount',
    //     'loanProductId',
    //     'is_employee',
    //     'employee_id',
    //     'monthly_income',
    //     'employer_name',
    //     'lender_id',
    //     'hrEmail',
    //     'employer_verification_sent',
    //     'employer_verification_sent_at',
    //     'employer_verified',
    //     'employer_verified_at',
    //     'employer_verification_status',
    //     'client_id',
    //     'tenure',
    //     'car_dealer_id',
    //     'stage_name',
    //     'vehicle_id',
    // ];

    // protected $casts = [
    //     'amount' => 'decimal:2',
    //     'purchase_price' => 'decimal:2',
    //     'down_payment' => 'decimal:2',
    //     'loan_amount' => 'decimal:2',
    //     'is_employee' => 'boolean',
    //     'employer_verification_sent' => 'boolean',
    //     'employer_verified' => 'boolean',
    //     'employer_verification_sent_at' => 'datetime',
    //     'employer_verified_at' => 'datetime',
    // ];

    public function importDutyApplication()
    {
        return $this->belongsTo(ImportDutyApplication::class, 'import_duty_application_id');
    }

    public function statusHistory()
    {
        return $this->hasMany(ApplicationStatusHistory::class, 'application_id')
                   ->where('application_type', 'LOAN');
    }

    public function getStatusBadgeClass(): string
    {
        return match(strtolower($this->application_status)) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved', 'accepted' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'processing', 'new client' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getFullName(): string
    {
        return trim($this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
    }




}
