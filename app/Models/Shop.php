<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'owner_name',
        'phone_number',
        'email',
        'shop_type',
        'latitude',
        'longitude',
        'address',
        'status'
    ];

    public function spareParts()
    {
        return $this->hasMany(SparePart::class);
    }


    public function supervisor()
    {
        return $this->hasOne(User::class, 'shop_id')->where('role', 'shop_supervisor');
    }


    public function users()
    {
        return $this->hasMany(User::class, 'shop_id');
    }

    // Scope for active shops
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for shop types
    public function scopeOfType($query, $type)
    {
        return $query->where('shop_type', $type);
    }

    // Get formatted shop type
    public function getFormattedShopTypeAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->shop_type));
    }

    // Get full address with coordinates
    public function getFullLocationAttribute()
    {
        return $this->address . ' (' . $this->latitude . ', ' . $this->longitude . ')';
    }

    
}
