<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Pembeli
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is an admin
        if (!Auth::guard('pembeli')->check()) {
            return redirect()->route('pembeli.login')->with('error', 'You dont have permission to access this page');
        }
        return $next($request);

        // Jika tidak, redirect ke halaman login admin
    }
}
