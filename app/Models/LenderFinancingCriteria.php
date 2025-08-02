<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LenderFinancingCriteria extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }

    /**
     * Get the make associated with the criteria
     */
    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    /**
     * Get the model associated with the criteria
     */
    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }
}
