<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     * This middleware restricts access to admin/staff routes for department 10 users
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // This middleware assumes user is already authenticated and OTP verified
        // because it's applied after auth:sanctum and OTPMiddleware
        
        $user = Auth::user();
        
        // If user is department 10 (client), they shouldn't access admin routes
        if ($user && $user->department == 10) {
            Session::flash('error', 'You do not have permission to access this area.');
            return redirect()->route('application.list');
        }

        return $next($request);
    }
}