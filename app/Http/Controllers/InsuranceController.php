<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index(){

        return view('pages.insurance_management.index');
    }
}
