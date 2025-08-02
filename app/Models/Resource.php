<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path_url',
        'descriptions',
        'lender_id',
        'status',
    ];

    public function lender()
    {

        return $this->belongsTo(Lender::class, 'lender_id');
    }
}
