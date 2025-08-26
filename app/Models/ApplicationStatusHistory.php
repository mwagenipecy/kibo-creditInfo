<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ApplicationStatusHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'application_status_history';



    protected $fillable = [
        'application_id',
        'application_type',
        'previous_status',
        'new_status',
        'changed_by_type',
        'changed_by_id',
        'reason',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->created_at = now();
        });
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(ImportDutyApplication::class, 'application_id');
    }

    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'application_id');
    }



    
}
