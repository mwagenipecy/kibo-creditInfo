<?php

// App\Http\Middleware\OTPMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OTPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Routes that don't require OTP verification
        $excludedRoutes = [
            'otp-page',
            'verify-otp',
            'logout',
            'login',
            'register',
            'password.request',
            'password.reset',
            'password.email',
            'password.update',
            'password.confirm',
            'employer.verification',
            'employer.verification.submit',
            'employer.verification.thank-you',
            'employer.verification.invalid',
            'employer.verification.completed',
            // Add any other public routes that don't need OTP
            'home.page',
            'about.us',
            'contact.page',
            'vehicle.list',
            'view.vehicle',
            'garage.list',
            'insurance.index',
            'client.registration'
        ];

        // Get current route name
        $currentRouteName = $request->route() ? $request->route()->getName() : null;
        
        // Skip OTP check for excluded routes
        if (in_array($currentRouteName, $excludedRoutes)) {
            return $next($request);
        }

        // Check if user is authenticated
        if (!Auth::check()) {
            // User is not authenticated, redirect to login
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user's email is verified (OTP verified)
        if (is_null($user->email_verified_at)) {
            // User needs OTP verification, redirect to OTP page
            Session::flash('warning', 'Please verify your email with OTP to continue.');
            return redirect()->route('otp-page');
        }

        return $next($request);
    }
}