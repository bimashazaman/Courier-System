<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StuffMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == 2)
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
