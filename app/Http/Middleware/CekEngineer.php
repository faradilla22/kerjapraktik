<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekEngineer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $pabrik
     * @return mixed
     */
    public function handle($request, Closure $next, $pabrik)
    {
        $user = Auth::user();

        if ($user->status === 'engineer' && $user->pabrik->nama_pabrik === $pabrik) {
            return $next($request);
        }

        abort(403, 'You do not have access to this page');
    }
}
