<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\GarageManagementController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\WebsiteController;
use App\Http\Middleware\ClientMiddleware;
use App\Http\Middleware\OTPMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\EmployerVerificationController;

// =================================================================
// PUBLIC ROUTES (No middleware - completely public)
// =================================================================

Route::redirect('/', 'welcome');

// Public website pages
Route::get('welcome', [WebsiteController::class, 'index'])->name('home.page');
Route::get('vehicle/list', [WebsiteController::class, 'vehicleList'])->name('vehicle.list');
Route::get('view/vehicle/{vehicleId}', [WebsiteController::class, 'viewVehicleData'])->name('view.vehicle');
Route::get('/about-us', [WebsiteController::class, 'aboutPage'])->name('about.us');
Route::get('/contact', [WebsiteController::class, 'contactPage'])->name('contact.page');
Route::get('/client-registration', [WebsiteController::class, 'clientRegistration'])->name('client.registration');

// Public service pages
Route::get('garage-list', [GarageManagementController::class, 'index'])->name('garage.list');
Route::get('insurance', [InsuranceController::class, 'index'])->name('insurance.index');

// Password reset
Route::post('/password-reset', function (Illuminate\Http\Request $request) {
    $email = $request->input('email');
    Session::put('status', "This password is not registered");
    return redirect()->route('password.request');
})->name('password-reset');

// Employer verification routes (completely public)
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

// =================================================================
// OTP VERIFICATION ROUTES (Auth only - NO OTP middleware)
// =================================================================

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // OTP verification page - CRITICAL: No OTPMiddleware here to prevent loops
    Route::get('/otp-page', [WebsiteController::class, 'Otp'])->name('otp-page');
    
  
});

// =================================================================
// CLIENT ROUTES (Auth + OTP verified - No department restrictions)
// =================================================================

Route::middleware(['auth:sanctum', OTPMiddleware::class])->group(function () {
    
    // Account settings - Available to all verified users
    Route::get('account', [WebsiteController::class, 'accountPage'])->name('account.setting');

    // Loan application routes - Available to all verified users
    Route::get('loan/application/{id}', function($id) {
        // Add your controller method here
        return view('loan.application', compact('id'));
    })->name('loan.application');
    
    Route::get('loan/list', [WebsiteController::class, 'applicationList'])->name('application.list');
    Route::get('application/status/{id}', [WebsiteController::class, 'applicationStatus'])->name('application.status');
    Route::get('loan/pre-qualify/{vehicleId}/{lenderId}', [WebsiteController::class, 'loanApplication'])->name('loan.pre-qualify');
});

// =================================================================
// ADMIN/STAFF ROUTES (Auth + OTP + Department restrictions)
// =================================================================

Route::middleware(['auth:sanctum', 'verified', OTPMiddleware::class, ClientMiddleware::class])->group(function () {
    
    // Main system/dashboard routes
    Route::get('/System', \App\Http\Livewire\System::class)->name('System');
    Route::get('/CyberPoint-Pro', \App\Http\Livewire\System::class)->name('CyberPoint-Pro');

    // Billing management routes
    Route::get('/billing/bills/{bill}/pdf', [BillingController::class, 'generatePDF'])->name('billing.pdf');
    Route::get('/billing/export', [BillingController::class, 'export'])->name('billing.export');
    Route::get('/payments/{payment}/receipt', [BillingController::class, 'generatePaymentReceipt'])->name('payment.receipt');
});

// =================================================================
// FALLBACK ROUTE
// =================================================================

Route::fallback(function() {
    if (Auth::check()) {
        $user = Auth::user();
        
        // If email not verified, go to OTP page
        if (is_null($user->email_verified_at)) {
            return redirect()->route('otp-page');
        }
        
        // If department 10 (client), go to application list
        if ($user->department == 10) {
            return redirect()->route('application.list');
        }
        
        // Otherwise go to main dashboard
        return redirect()->route('CyberPoint-Pro');
    }
    
    // Not authenticated - show 404
    return view('pages/utility/404');
});