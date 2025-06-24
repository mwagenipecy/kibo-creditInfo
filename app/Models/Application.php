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


}
