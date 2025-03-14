<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharesModel extends Model
{
    use HasFactory;
    protected $table = 'issured_shares';
    protected $guarded = [];
}