<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            // Periksa apakah pengguna adalah admin
            if ($role == 'admin' && Auth::user() instanceof \App\Models\Admin) {
                return $next($request);
            }
            // Periksa apakah pengguna adalah pengguna biasa
            elseif ($role == 'user' && Auth::user() instanceof \App\Models\User) {
                return $next($request);
            }
        }

        if ($role == 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/dashboard');
        }
    }
}
