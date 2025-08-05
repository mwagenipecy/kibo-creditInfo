<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpareModel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
{
    return $this->belongsTo(SpareBrand::class);
}


}
