<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PembeliController extends Controller
{
    public function create()
    {
        return view('pembeli.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pembeli',
            'password' => 'required|string|min:5|confirmed',
            'terms' => 'accepted'
        ]);

        // Hash the password before saving
        $attributes['password'] = bcrypt($attributes['password']);

        $pembeli = Pembeli::create($attributes);
        Log::info('Signup berhasil');
        auth()->guard('pembeli')->login($pembeli);
        Log::info('Signup2 berhasil');
        return redirect()->route('market');
    }


    public function show()
    {
        return view('pembeli.login');
    }

    public function login(Request $request)
    {
        Log::info('Login request received', ['request' => $request->all()]);

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        Log::info('Credentials', ['credentials' => $credentials]);

        if (auth()->guard('pembeli')->attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('Login berhasil');
            return redirect()->route('market')->with('success', 'Login berhasil');
        } else {
            Log::info('Login gagal', ['credentials' => $credentials]);
            return redirect()->route('pembeli.login')->with('error', 'Email atau password salah');
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('pembeli')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pembeli.login');
    }

    public function edit($id_pembeli)
    {
        $pembeli = Pembeli::findOrFail($id_pembeli);
        return view('pembeli.profile', ['pembeli' => $pembeli]);
    }

    public function update(Request $request, $id_pembeli)
    {
        $attributes = $request->validate([
            'nama' => ['required', 'max:64', 'min:2'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pembeli')->ignore($id_pembeli, 'id_pembeli'),
            ],
            'alamat' => ['nullable', 'max:100'],
            'username' => ['nullable', 'max:20'],
            'no_hp' => ['nullable', 'max:15'],
            'no_rek' => ['nullable', 'numeric'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $pembeli = Pembeli::findOrFail($id_pembeli);

        // Log before update
        Log::info('Updating user:', ['attributes' => $attributes]);

        // Update pembeli data except foto_profil
        $pembeli->update($request->except('foto_profil'));

        // Handle file upload
        if ($request->hasFile('foto_profil')) {
            if ($pembeli->foto_profil) {
                Storage::delete('foto_profil/' . $pembeli->foto_profil);
            }

            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_profil')->storeAs('foto_profil', $newName);
            $pembeli->foto_profil = $newName;
        }

        // Save changes
        $pembeli->save();

        // Log after update
        Log::info('Updated user:', ['pembeli' => $pembeli->toArray()]);

        session()->flash('status', 'success');
        session()->flash('message', 'Edit data success!');
        return back()->with('success', 'Profile successfully updated');
    }

    public function daftarPembeli()
    {
        // Mengambil data dari tabel pembeli
        $pembeli = Pembeli::all();

        return view('pengepul.daftar-pembeli', compact('pembeli'));
    }
}
