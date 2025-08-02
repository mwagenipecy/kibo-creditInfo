<?php

namespace App\Http\Controllers;

class GarageManagementController extends Controller
{
    public function index()
    {
        return view('pages.garage_management.index');
    }
}
