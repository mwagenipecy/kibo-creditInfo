<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDealer extends Model
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
        'dealer_type',
        'year_established',
        'brands_sold',
        'inventory_size',
        'services_offered',
        'operating_hours',
        'additional_notes',
        'logo',
        'status',
        'servicesOffered'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'year_established' => 'integer',
        'inventory_size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the documents for the car dealer.
     */
    public function documents()
    {
        return $this->hasMany(PartnerDocument::class, 'partner_id')
            ->where('partner_type', 'car_dealer');
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


    public function bills()
    {
        return $this->hasMany(Bill::class, 'entity_id')->where('entity_type', 'car_dealer');
    }

    public function billingConfiguration()
    {
        return $this->hasOne(BillingConfiguration::class, 'entity_id')->where('entity_type', 'car_dealer');
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
     * Scope a query to only include pending car dealers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'PENDING');
    }

    /**
     * Scope a query to only include approved car dealers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'APPROVED');
    }

    /**
     * Scope a query to only include rejected car dealers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'REJECTED');
    }



    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }


    public function dealerCarCount(){

        return Vehicle::where('dealer_id', $this->id)
           // ->where('status', 'ACTIVE')
            ->count();
    }


    public function rateCarDealer()
    {
        return rand(7, 9);
    }
    /**
     * Get the reviews for the car dealer.
     */


    
    public function reviews()
    {
        return $this->hasMany(DealerReview::class);
    }
    
    // Accessors
    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    
    
}
