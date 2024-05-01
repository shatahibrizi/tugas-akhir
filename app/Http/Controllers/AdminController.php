<?php

namespace App\Http\Controllers;

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
        return view('pengepul.dashboard');
    }

    function show()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required'],
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password']
        ];


        if (Auth::guard('admin')->attempt($data)) {
            // Autentikasi berhasil
            return redirect()->route('admin_dashboard')->with('succes', 'Login succesfully');
        } else {
            return redirect()->route('admin_login')->with('error', 'Invalid credentials');
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function userManagement()
    {
        // Logika untuk halaman User Management di sini
        // Misalnya, ambil data pengguna dari database dan kirimkan ke view
        $users = \App\Models\User::all(); // Mengambil semua data pengguna dari model User

        return view('admin.user_management', ['users' => $users]);
        // Anda dapat menyesuaikan view yang digunakan dan data yang dikirimkan sesuai dengan kebutuhan aplikasi Anda
    }
}
