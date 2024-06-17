<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Admin;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Exports\ProductEntryExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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

    public function edit($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        return view('admin.profile', ['admin' => $admin]);
    }

    public function update(Request $request, $id_admin)
    {
        $attributes = $request->validate([
            'nama' => ['required', 'max:64', 'min:2'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id_admin, 'id_admin'),
            ],
            'alamat' => ['nullable', 'max:100'],
            'username' => ['nullable', 'max:20'],
            'no_hp' => ['nullable', 'max:15'],
            'no_rek' => ['nullable', 'numeric'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $admin = Admin::findOrFail($id_admin);

        // Log before update
        Log::info('Updating user:', ['attributes' => $attributes]);

        // Update admin data except foto_profil
        $admin->update($request->except('foto_profil'));

        // Handle file upload
        if ($request->hasFile('foto_profil')) {
            if ($admin->foto_profil) {
                Storage::delete('foto_profil/' . $admin->foto_profil);
            }

            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_profil')->storeAs('foto_profil', $newName);
            $admin->foto_profil = $newName;
        }

        // Save changes
        $admin->save();

        // Log after update
        Log::info('Updated user:', ['admin' => $admin->toArray()]);

        session()->flash('status', 'success');
        session()->flash('message', 'Edit data success!');
        return back()->with('success', 'Profile successfully updated');
    }

    public function viewAllOrders()
    {
        // Mengambil semua data pesanan dari database
        $orders = Pesanan::with(['products', 'pembeli', 'products.pengepul'])->get();

        // Debugging
        if ($orders->isEmpty()) {
            \Log::info('No orders found');
        } else {
            \Log::info('Orders found: ' . $orders->count());
        }

        return view('admin.orders', compact('orders'));
    }
    public function viewAllProductEntries()
    {
        // Mengambil semua data dari tabel tambah_produk
        $tambahProduk = DB::table('tambah_produk')
            ->join('products', 'tambah_produk.id_produk', '=', 'products.id_produk')
            ->join('users', 'tambah_produk.id_pengepul', '=', 'users.id_pengepul')
            ->select('tambah_produk.*', 'products.nama_produk', 'products.foto_produk', 'users.nama as pengepul_nama')
            ->orderBy('tambah_produk.created_at', 'desc')
            ->get();

        return view('admin.product-masuk', compact('tambahProduk'));
    }

    public function exportProductEntries()
    {
        return Excel::download(new ProductEntryExport, 'produk_masuk.xlsx');
    }
}
