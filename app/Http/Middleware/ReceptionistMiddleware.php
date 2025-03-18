<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionistMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('receptionists')->check()) {
            return redirect()->route('receptionists.login');
        }

        return $next($request);
    }
}

