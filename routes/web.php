<?php

use App\Http\Controllers\WebsiteController;
use App\Http\Livewire\Web\Account;
use App\Http\Middleware\ClientMiddleware;
use App\Http\Middleware\OTPMiddleware;
use App\Models\departmentsList;
use App\Http\Livewire\VerifyOtp;
use App\Models\approvals;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Traits\MailSender;
use App\Http\Controllers\EmployerVerificationController;



// Redirect to login page
Route::redirect('/', 'welcome');

// Route for password reset form submission
Route::post('/password-reset', function (Illuminate\Http\Request $request) {
    $email = $request->input('email');
    Session::put('status',"This password is not registered");
        return redirect()->route('password.request');
})->name('password-reset');

// Group routes that require authentication
Route::middleware(['auth:sanctum', 'verified',ClientMiddleware::class])->group(function () {



    // Route for the main dashboard page
    Route::get('/System', \App\Http\Livewire\System::class)->name('System');
    Route::get('/CyberPoint-Pro', \App\Http\Livewire\System::class)->name('CyberPoint-Pro');
   // Route::get('/otp-page',[WebsiteController::class,'Otp'])->name('otp-page');


    Route::fallback(function() {

        // If the user is authenticated, redirect to the dashboard
        if (Auth::check()) {
            return redirect()->route('CyberPoint-Pro');
        }

       // dd("okkk");
        return view('pages/utility/404');
    });


});




////// OTP verifications 
Route::middleware(['auth:sanctum', 'verified', ClientMiddleware::class])->group(function () {
    // OTP verification page doesn't need the OTP middleware
    Route::get('/otp-page', [WebsiteController::class, 'Otp'])->name('otp-page');
    
    // OTP verification submission route
   // Route::post('/verify-otp', [WebsiteController::class, 'verifyOtp'])->name('verify-otp');
});


    //////////////////////////////////// OTP //////////////////////////////








// Employer verification routes
Route::get('/employer/verification/{token}', [EmployerVerificationController::class, 'showForm'])
    ->name('employer.verification');
    
Route::post('/employer/verification/{token}', [EmployerVerificationController::class, 'submitForm'])
    ->name('employer.verification.submit');
    
Route::get('/employer/verification-thank-you', [EmployerVerificationController::class, 'thankYou'])
    ->name('employer.verification.thank-you');
    
Route::get('/employer/verification-invalid', [EmployerVerificationController::class, 'invalid'])
    ->name('employer.verification.invalid');
    
Route::get('/employer/verification-completed', [EmployerVerificationController::class, 'completed'])
    ->name('employer.verification.completed');




    ///// website management section 
    Route::get('welcome',[WebsiteController::class,'index'])->name('home.page');
    Route::get('vehicle/list',[WebsiteController::class,'vehicleList'])->name('vehicle.list');
    Route::get('view/vehicle/{vehicleId}',[WebsiteController::class,'viewVehicleData'])->name('view.vehicle');


    /////////////////////ABOUT US PAGE ///////////////
    Route::get('/about-us',[WebsiteController::class,'aboutPage'])->name('about.us');




    ///////////////////CLIENT REGISTRATION FORM ///////////////////
    Route::get('/client-registration',[WebsiteController::class,'clientRegistration'])->name('client.registration');






   
    Route::get('/contact',[WebsiteController::class,'contactPage'])->name('contact.page');



    Route::middleware(['auth:sanctum', 'verified'])->group(function () {


            //////////////////////////////////// OTP /////////////////////////////
            Route::get('account',[WebsiteController::class,'accountPage'])->name('account.setting');



          ////////////////////// LOAN APPLICATION /////////////////////////////////
          Route::get('loan/application/{id}',[])->name('loan.application');
          Route::get('loan/list',[WebsiteController::class,'applicationList'])->name('application.list');
          Route::get('application/status/{id}',[WebsiteController::class,'applicationStatus'])->name('application.status');
         

         /////////////////// CLIENT LOAN APPLICATION /////////////////////////
          Route::get('loan/pre-qualify/{vehicleId}/{lenderId}',[WebsiteController::class,'loanApplication'])->name('loan.pre-qualify');

    });