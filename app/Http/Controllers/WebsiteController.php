<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{


    public function index(){
        return view('pages.web.home');
    }


    public function vehicleList(){

        return view('pages.web.vehicle-list');
    }


    public function viewVehicleData($vehicleId){

        return view('pages.web.vehicle-detail',['vehicleId'=>$vehicleId]);
    }


    public function aboutPage(){
        return view('pages.web.about');
    }

    
    public function clientRegistration(){

        return view('pages.web.register');
    }


    public function loanApplication($vehicleId,$lenderId){

         
        return view('pages.web.loan-application',['vehicleId'=>$vehicleId,'lenderId'=>$lenderId]);

    }



    public function applicationList(){

        return view('pages.web.application-list');
    }



    public function applicationStatus($id){

        return view('pages.web.application-status',['id'=>$id]);
    }


    public function contactPage(){


        return view('pages.web.contact');
    }


    public function Otp(){
        return view('pages.web.otp');
    }


    public function accountPage(){
        return view('pages.web.account');
    }
}
