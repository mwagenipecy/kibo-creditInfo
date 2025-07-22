<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'opening_hours',
        'services',
        'image',
        'rating',
        'is_active',
        'featured',
    ];

    protected $casts = [
        'services' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'rating' => 'decimal:2',
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

    protected $appends = ['full_address'];

    /**
     * Get the full address attribute
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->zip_code,
            $this->country
        ]);

        return implode(', ', $parts);
    }

    /**
     * Scope for active garages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured garages
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for nearby garages
     */
    public function scopeNearby($query, $latitude, $longitude, $radius = 10)
    {
        return $query->selectRaw("
            *,
            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
        ", [$latitude, $longitude, $latitude])
        ->having('distance', '<=', $radius)
        ->orderBy('distance');
    }

    /**
     * Scope for garages with specific services
     */
    public function scopeWithServices($query, array $services)
    {
        return $query->where(function ($q) use ($services) {
            foreach ($services as $service) {
                $q->orWhereJsonContains('services', $service);
            }
        });
    }

    /**
     * Scope for garages by rating
     */
    public function scopeByRating($query, $minRating = 4.0)
    {
        return $query->where('rating', '>=', $minRating);
    }

    /**
     * Get distance to a specific point
     */
    public function getDistanceTo($latitude, $longitude)
    {
        if (!$this->latitude || !$this->longitude) {
            return null;
        }

        $earthRadius = 6371; // Earth's radius in kilometers

        $latDelta = deg2rad($latitude - $this->latitude);
        $lonDelta = deg2rad($longitude - $this->longitude);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($this->latitude)) * cos(deg2rad($latitude)) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c * 0.621371; // Convert to miles
    }

    /**
     * Check if garage offers a specific service
     */
    public function hasService($service)
    {
        if (!$this->services) {
            return false;
        }

        return in_array($service, $this->services);
    }

    /**
     * Get formatted opening hours
     */
    public function getFormattedHoursAttribute()
    {
        if (!$this->opening_hours) {
            return 'Hours not available';
        }

        // You can customize this based on your opening_hours format
        return $this->opening_hours;
    }

    /**
     * Get rating stars as HTML
     */
    public function getRatingStarsAttribute()
    {
        $rating = $this->rating ?? 0;
        $stars = '';
        
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= '★';
            } else {
                $stars .= '☆';
            }
        }
        
        return $stars;
    }

    /**
     * Get the garage's Google Maps URL
     */
    public function getGoogleMapsUrlAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps/search/?api=1&query={$this->latitude},{$this->longitude}";
        }

        return "https://www.google.com/maps/search/?api=1&query=" . urlencode($this->full_address);
    }

    /**
     * Get directions URL from a specific location
     */
    public function getDirectionsUrl($fromLatitude = null, $fromLongitude = null)
    {
        if ($fromLatitude && $fromLongitude) {
            if ($this->latitude && $this->longitude) {
                return "https://www.google.com/maps/dir/{$fromLatitude},{$fromLongitude}/{$this->latitude},{$this->longitude}";
            }
            return "https://www.google.com/maps/dir/{$fromLatitude},{$fromLongitude}/" . urlencode($this->full_address);
        }

        return $this->google_maps_url;
    }

    /**
     * Geocode the address and update coordinates
     */
    public function geocodeAddress()
    {
        if (!$this->full_address) {
            return false;
        }

        try {
            $googleApiKey = config('services.google.maps_api_key');
            
            if (!$googleApiKey) {
                return false;
            }

            $response = \Illuminate\Support\Facades\Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $this->full_address,
                'key' => $googleApiKey
            ]);

            if ($response->successful() && $response->json()['status'] === 'OK') {
                $result = $response->json()['results'][0];
                $this->latitude = $result['geometry']['location']['lat'];
                $this->longitude = $result['geometry']['location']['lng'];
                $this->save();
                
                return true;
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Geocoding error for garage ' . $this->id . ': ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Search garages by text
     */
    public static function search($searchTerm)
    {
        return static::where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('address', 'like', "%{$searchTerm}%")
                  ->orWhere('city', 'like', "%{$searchTerm}%")
                  ->orWhereJsonContains('services', $searchTerm);
        });
    }

    /**
     * Get popular services across all garages
     */
    public static function getPopularServices($limit = 10)
    {
        $garages = static::whereNotNull('services')->get();
        $services = [];

        foreach ($garages as $garage) {
            if ($garage->services) {
                foreach ($garage->services as $service) {
                    $services[$service] = ($services[$service] ?? 0) + 1;
                }
            }
        }

        arsort($services);
        return array_slice(array_keys($services), 0, $limit);
    }

    /**
     * Get garage statistics
     */
    public static function getStatistics()
    {
        return [
            'total_garages' => static::count(),
            'active_garages' => static::active()->count(),
            'featured_garages' => static::featured()->count(),
            'average_rating' => static::avg('rating'),
            'total_services' => count(static::getPopularServices(100))
        ];
    }

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-geocode when address changes
        static::saving(function ($garage) {
            if ($garage->isDirty(['address', 'city', 'state', 'zip_code', 'country'])) {
                if (!$garage->latitude || !$garage->longitude) {
                    $garage->geocodeAddress();
                }
            }
        });
    }
}