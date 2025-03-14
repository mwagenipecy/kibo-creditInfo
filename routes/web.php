<?php

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



Route::get('/microfinance_registration_link',[\App\Http\Controllers\CompanyRequest::class,'index']);

Route::post('registration/submition',[\App\Http\Controllers\CompanyRequest::class,'create'])->name('saccossRequestForm');

// Redirect to login page
Route::redirect('/', 'login');

// Route for password reset form submission
Route::post('/password-reset', function (Illuminate\Http\Request $request) {
    $email = $request->input('email');

    Session::put('status',"This password is not registered");
        return redirect()->route('password.request');
})->name('password-reset');

// Group routes that require authentication
Route::middleware(['auth:sanctum', 'verified'])->group(function () {



    // Route for the main dashboard page
    Route::get('/System', \App\Http\Livewire\System::class)->name('System');

    Route::get('/CyberPoint-Pro', \App\Http\Livewire\System::class)->name('CyberPoint-Pro');

    // Route for OTP verification page
    Route::get('/verify-user', function () {
        return view('otp');
    })->name('verify-user');


    Route::fallback(function() {
        return view('pages/utility/404');
    });
});
