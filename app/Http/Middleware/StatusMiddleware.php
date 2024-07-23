<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $status
     * @return mixed
     */
    public function handle($request, Closure $next, $status)
    {
        if (Auth::check() && Auth::user()->status === $status) {
            return $next($request);
        }

        // Redirect or abort if the user doesn't have the correct status
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
