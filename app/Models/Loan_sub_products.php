<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan_sub_products extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function lender(){

        return $this->belongsTo( Lender::class, 'institution_id', 'id');
    }
}
