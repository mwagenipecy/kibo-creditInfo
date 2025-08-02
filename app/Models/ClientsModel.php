<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsModel extends Model
{
    use HasFactory;
    use Search;

    protected $table = 'clients';

    protected $guarded = [];

    protected $searchable = [
        'client_number', 'first_name',  'last_name', 'mobile_phone_number',
    ];
}
