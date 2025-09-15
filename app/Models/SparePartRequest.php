<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class SparePartRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'make_id',
        'model_id',
        'year',
        'part_name',
        'part_number',
        'part_size',
        'part_condition',
        'description',
        'customer_name',
        'customer_email',
        'customer_phone',
        'additional_notes',
        'status',
        'expires_at',
        'location',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'year' => 'integer',
        'expires_at' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Relationships
    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    public function quotes()
    {
        return $this->hasMany(SparePartQuote::class);
    }

    public function images()
    {
        return $this->hasMany(SparePartRequestImage::class);
    }

    public function acceptedQuote()
    {
        return $this->hasOne(SparePartQuote::class)->where('status', 'accepted');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'pending')
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'pending')
                    ->where('expires_at', '<=', now());
    }

    public function scopeByMake($query, $makeId)
    {
        return $query->where('make_id', $makeId);
    }

    public function scopeByModel($query, $modelId)
    {
        return $query->where('model_id', $modelId);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    // Accessors
    public function getVehicleInfoAttribute()
    {
        return "{$this->year} {$this->make->name} {$this->model->name}";
    }

    public function getIsExpiredAttribute()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function getQuotesCountAttribute()
    {
        return $this->quotes()->count();
    }

    public function getLowestQuoteAttribute()
    {
        return $this->quotes()->orderBy('price')->first();
    }

    public function getHighestQuoteAttribute()
    {
        return $this->quotes()->orderByDesc('price')->first();
    }

    // Methods
    public function setExpiration($days = 7)
    {
        $this->update(['expires_at' => now()->addDays($days)]);
    }

    public function markAsCompleted()
    {
        $this->update(['status' => 'completed']);
    }

    public function markAsCancelled()
    {
        $this->update(['status' => 'cancelled']);
    }

    public function isActive()
    {
        return $this->status === 'pending' && 
               (!$this->expires_at || $this->expires_at->isFuture());
    }

    public function getFormattedExpiresAtAttribute()
    {
        if (!$this->expires_at) {
            return 'No expiration';
        }
        
        return $this->expires_at->format('M d, Y H:i');
    }

    public function getTimeRemainingAttribute()
    {
        if (!$this->expires_at || $this->expires_at->isPast()) {
            return 'Expired';
        }
        
        return $this->expires_at->diffForHumans();
    }
}
