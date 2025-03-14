<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExpensesModel;
use App\Models\grants;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table='employees';

    public function benefits()
    {
        return $this->hasMany(ExpensesModel::class);
    }

    public function absences()
    {
        return $this->hasMany(ExpensesModel::class);
    }
}
