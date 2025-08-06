<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{


    public function HasAccess()
    {

        if(optional(auth()->user())->department==1 || optional(auth()->user())->department==2 || optional(auth()->user())->department==3){
            abort(403, 'Unauthorized action.');
        }

    }

    public function index(){
        return view('pages.web.home');
    }


    public function loanCalculator(){

        return view('pages.web.loan-calculator');
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

        $this->HasAccess();
         
        return view('pages.web.loan-application',['vehicleId'=>$vehicleId,'lenderId'=>$lenderId]);

    }



    public function applicationList(){

        $this->HasAccess();
        return view('pages.web.application-list');
    }



    public function applicationStatus($id){

        return view('pages.web.application-status',['id'=>$id]);
    }


    public function contactPage(){


        return view('pages.web.contact');
    }


    public function Otp()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        $user = Auth::user();
        
        // If user is already verified, redirect to dashboard
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('CyberPoint-Pro')->with('success', 'Your account is already verified.');
        }
        
        return view('pages.web.otp');
    }


    public function accountPage(){
        return view('pages.web.account');
    }



    public function customLoanApplication(){

        return view('pages.web.custom-loan-application');
    }


    public function weddingVehicles(){

        return view('pages.web.wedding-vehicles');
    }

    public function viewWeddingVehicle($vehicleId){

        return view('pages.web.view-wedding-vehicle',['vehicleId'=>$vehicleId]);
   
    }
}
