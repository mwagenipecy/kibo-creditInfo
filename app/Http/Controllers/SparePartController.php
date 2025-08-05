<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function index(){

    
        return view('pages.web.spare_parts');


    }


    public function viewDetails($id){

        return view('pages.web.spare_part_details', ['id' => $id]);
    }
}
