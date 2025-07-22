<?php

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
        // Skip OTP check for certain routes
        $excludedRoutes = [
            'otp-page',
            'verify-otp',
            'logout',
            'login',
            'register',
            'password.request',
            'password.reset',
            'employer.verification',
            'employer.verification.submit',
            'employer.verification.thank-you',
            'employer.verification.invalid',
            'employer.verification.completed'
        ];

        // Check if current route should be excluded
        $currentRouteName = $request->route()->getName();
        if (in_array($currentRouteName, $excludedRoutes)) {
            return $next($request);
        }

        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if user's email is verified (OTP verified)
            if (is_null($user->email_verified_at)) {
                // User needs OTP verification
                return redirect()->route('otp-page');
            }
        }

        return $next($request);
    }
}