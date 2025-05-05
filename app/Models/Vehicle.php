<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'make_id',
        'model_id',
        'dealer_id',
        'body_type_id',
        'fuel_type_id',
        'transmission_id',
        'year',
        'price',
        'mileage',
        'color',
        'vin',
        'engine_size',
        'engine_type',
        'horsepower',
        'drivetrain',
        'length',
        'width',
        'height',
        'wheelbase',
        'seating_capacity',
        'cargo_volume',
        'condition',
        'description',
        'trim',
        'owners',
        'location',
        'is_featured',
        'vehicle_condition',
        'downPaymentPercent'
    ];
    
    protected $casts = [
        'year' => 'integer',
        'price' => 'integer',
        'mileage' => 'integer',
        'horsepower' => 'integer',
        'length' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'wheelbase' => 'integer',
        'seating_capacity' => 'integer',
        'cargo_volume' => 'integer',
        'owners' => 'integer',
        'is_featured' => 'boolean',
    ];
    
    // Relationships
    public function make()
    {
        return $this->belongsTo(Make::class);
    }
    
    public function model()
    {
        return $this->belongsTo(VehicleModel::class);
    }
    
    public function dealer()
    {
        return $this->belongsTo(CarDealer::class,'dealer_id');
    }
    
    public function bodyType()
    {
        return $this->belongsTo(BodyType::class);
    }
    
    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }
    
    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }
    
    public function images()
    {
        return $this->hasMany(VehicleImage::class);

    }
    
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
    
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    
    // Accessors & Mutators
    public function getFeaturedImageAttribute()
    {
        $featuredImage = $this->images()->where('is_featured', true)->first();
        if ($featuredImage) {
            return $featuredImage->image_url;
        }
        
        // If no featured image, return the first image
        $firstImage = $this->images()->first();
        return $firstImage ? $firstImage->image_url : '/img/default-vehicle.jpg';
    }
    
    public function getImagesAttribute()
    {
        return $this->images()->orderBy('is_featured', 'desc')->pluck('image_url')->toArray();
    }
    
    public function getFeaturesAttribute()
    {
        return $this->features()->pluck('name')->toArray();
    }
    
    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    
    public function scopeWithinPriceRange($query, $min, $max)
    {
        return $query->where('price', '>=', $min)->where('price', '<=', $max);
    }
    
    public function scopeByMake($query, $makeId)
    {
        return $query->where('make_id', $makeId);
    }
    
    public function scopeByModel($query, $modelId)
    {
        return $query->where('model_id', $modelId);
    }
    
    public function scopeByBodyType($query, $bodyTypeId)
    {
        return $query->where('body_type_id', $bodyTypeId);
    }
    
    public function scopeByYear($query, $from, $to)
    {
        $query = $from ? $query->where('year', '>=', $from) : $query;
        return $to ? $query->where('year', '<=', $to) : $query;
    }
    
    public function scopeByMileage($query, $max)
    {
        return $max ? $query->where('mileage', '<=', $max) : $query;
    }
}
