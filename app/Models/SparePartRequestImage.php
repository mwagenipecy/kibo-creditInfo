<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartRequestImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'spare_part_request_id',
        'path',
        'original_name',
        'mime_type',
        'size_bytes',
    ];

    public function sparePartRequest()
    {
        return $this->belongsTo(SparePartRequest::class);
    }
}
