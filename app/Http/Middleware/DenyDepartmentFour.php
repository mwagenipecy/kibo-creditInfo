<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenyDepartmentFour
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && (string)($user->department ?? '') === '4') {
            // Hide existence of the page for department 4
            abort(404);
        }

        return $next($request);
    }
}


