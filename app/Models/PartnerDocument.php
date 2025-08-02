<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'partner_type',
        'document_type',
        'file_path',
        'file_name',
        'file_size',
        'mime_type',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'file_size' => 'integer',
        'uploaded_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the owner of the document.
     */
    public function partner()
    {
        return $this->partner_type === 'lender'
            ? $this->belongsTo(Lender::class, 'partner_id')
            : $this->belongsTo(CarDealer::class, 'partner_id');
    }

    /**
     * Get the document URL attribute.
     *
     * @return string
     */
    public function getDocumentUrlAttribute()
    {
        return \Storage::url($this->file_path);
    }

    /**
     * Get the status badge HTML.
     *
     * @return string
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'VERIFIED' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Verified</span>',
            'PENDING' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'REJECTED' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>',
            default => '',
        };
    }
}
