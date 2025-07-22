<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GarageManagementController extends Controller
{
    public function index(){
        return view('pages.garage_management.index');
    }
}
