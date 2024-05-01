<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userManagement()
    {
        // Logika untuk halaman User Management di sini
        // Misalnya, ambil data pengguna dari database dan kirimkan ke view
        $users = \App\Models\User::all(); // Mengambil semua data pengguna dari model User

        return view('user_management', ['users' => $users]);
        // Anda dapat menyesuaikan view yang digunakan dan data yang dikirimkan sesuai dengan kebutuhan aplikasi Anda
    }
}
