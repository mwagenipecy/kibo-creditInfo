<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchesModel extends Model
{
    use HasFactory;
    use Search;

    protected $guarded = [];
    protected $table = 'branches';
}