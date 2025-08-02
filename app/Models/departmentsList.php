<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departmentsList extends Model
{
    use HasFactory;

    /**
     * @var mixed|null
     */
    protected $table = 'departments';

    protected $guarded = [];
}
