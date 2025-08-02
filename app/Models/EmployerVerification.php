<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'token',
        'status',
        'message_sent',
        'employer_response',
        'responded_at',
        'expires_at',
        'ip_address',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'expires_at' => 'datetime',
        'employer_response' => 'array',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    public function hasResponded()
    {
        return $this->status === 'completed';
    }
}
