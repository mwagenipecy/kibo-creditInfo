<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerReview extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'dealer_id',
        'user_id',
        'rating',
        'review',
        'status',
    ];
    
    // Relationships
    public function dealer()
    {
        return $this->belongsTo(CarDealer::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}