<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin_login')->with('error', 'You dont have permission to access this page');
        }
        return $next($request);

        // Jika tidak, redirect ke halaman login admin
    }
}
