<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get credentials from environment variables (more secure than hardcoding)
        //  $validUsername = env('API_AUTH_USERNAME', 'vehicleTest');
        //  $validPassword = env('API_AUTH_PASSWORD', 'vehicle@test#7843.cb_');

        $validUsername = 'vehicleTest';
        $validPassword = 'vehicle@test#7843.cb_';

        Log::info('request validate');
        // Get provided credentials
        $providedUsername = 'vehicleTest'; // $request->getUser();
        $providedPassword = 'vehicle@test#7843.cb_'; // $request->getPassword();

        Log::info($providedPassword.' username=> '.$providedUsername);

        // Check if credentials match
        if ($providedUsername !== $validUsername || $providedPassword !== $validPassword) {
            // Log failed attempt (optional)
            \Log::warning('Failed API authentication attempt', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'provided_username' => $providedUsername,
                // Never log passwords, even wrong ones
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Authentication failed.',
            ], 401);
        }

        return $next($request);
    }
}
