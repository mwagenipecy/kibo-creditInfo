<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportDutyController extends Controller
{
    

    public function importDutyForm(){

        return view('pages.import-duty.import-duty-application-form');
    }


    public function applicationsList(){

        return view('pages.import-duty.import-duty-applications-list');
    }


    public function importDutyTracking($applicationId){

        return view('pages.import-duty.import-duty-tracking', ['applicationId' => $applicationId]);
    }


    
}
