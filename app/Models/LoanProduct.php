<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table="loan_sub_products";



    public function range($id){

        $amount_range = LoanProduct::where('id',$id)->first();

        return $amount_range->principle_min_value ."-". $amount_range->principle_max_value;
    }


    public function lender(){
        return $this->belongsTo(Lender::class, 'institution_id');
    }   

}
