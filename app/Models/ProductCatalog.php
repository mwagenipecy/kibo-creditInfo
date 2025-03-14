<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TermsAndConditions;

class ProductCatalog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_catalog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fsp_code',
        'fsp_name',
        'product_code',
        'product_name',
        'min_tenure',
        'max_tenure',
        'interest_rate',
        'processing_fee',
        'insurance',
        'amount_min',
        'amount_max',
        'repayment_type',
        'description',
        'for_executive',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the terms and conditions for the product catalog.
     */
    public function termsAndConditions()
    {
        return $this->hasMany(TermsAndConditions::class, 'product_catalog_id');
    }
}
