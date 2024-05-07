<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    function dashboard()
    {
        return view('admin.dashboard');
    }

    function show()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');



        if (auth()->guard('admin')->attempt($credentials)) {
            // Autentikasi berhasil

            $request->session()->regenerate();
            \Log::info('Login berhasil');
            return redirect()->route('admin_dashboard')->with('success', 'Login berhasil');
        } else {
            // Autentikasi gagal
            \Log::info('Login gagal');
            return redirect()->route('admin_login')->with('error', 'Email atau password salah');
        }
    }




    function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin_login')->with('success', 'Logout succesfully');
    }
}
