<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengepulController extends Controller
{
    function index()
    {
        // Mengambil id_pengepul dari user yang saat ini masuk
        // $id_pengepul = auth()->user()->id_pengepul;
        // dd($id_pengepul);

        $pengepul = User::paginate(5);
        // dd($pengepul);

        // Kirim data ke view
        return view('admin.pengepul', ['pengepul' => $pengepul]);
    }

    function show($id_pengepul)
    {
        $pengepul = User::findOrFail($id_pengepul);
        return view('admin.pengepul-detail', ['pengepul' => $pengepul]);
    }

    function create()
    {
        $pengepul = User::all();

        return view('admin.pengepul-add', ['pengepul' => $pengepul]);
    }

    function store(Request $request)
    {
        $newName = '';

        if ($request->file('foto_profil')) {
            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_profil')->storeAs('foto_profil', $newName);
        }
        if (!empty($newName)) {
            $request['foto_profil'] = $newName;
        }
        $request['foto_profil'] = $newName;

        $pengepul = User::create([
            'nama' => $request->nama,
            'foto_profil' => $newName,
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_rek' => $request->no_rek,
        ]);

        $date = now();

        if ($pengepul) {
            session()->flash('status', 'success');
            session()->flash('message', 'add data success!');
        }
        return redirect()->route('pengepul');
    }

    public function edit(Request $request, $id_pengepul)
    {
        $pengepul = User::findOrFail($id_pengepul);
        // dd($pengepul);
        return view('admin.pengepul-edit', ['pengepul' => $pengepul]);
    }


    public function update(Request $request, $id_pengepul)
    {
        $attributes = $request->validate([
            'nama' => ['required', 'max:64', 'min:2'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id_pengepul, 'id_pengepul'),
            ],
            'alamat' => ['max:100'],
            'username' => ['max:20'],
            'no_hp' => ['nullable'],
            'no_rek' => ['numeric'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Ambil pengguna berdasarkan ID pengepul
        $pengepul = User::findOrFail($id_pengepul);
        $pengepul->update($request->except('foto_profil')); // Hindari menyertakan 'foto_profil_produk' dalam proses update

        // Periksa apakah ada file baru yang diunggah
        if ($request->hasFile('foto_profil')) {
            // Hapus gambar lama jika ada
            if ($pengepul->foto_profil) {
                Storage::delete('foto_profil/' . $pengepul->foto_profil);
            }

            // Simpan gambar baru dan perbarui nama file di basis data
            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_profil')->storeAs('foto_profil', $newName);
            $pengepul->foto_profil = $newName;
        }

        // Isi atribut pengguna dan simpan
        $pengepul->save();

        // Set flash message
        session()->flash('status', 'success');
        session()->flash('message', 'Edit data success!');

        // Redirect ke halaman pengepul
        return redirect()->route('pengepul');
    }
    function destroy(Request $request, $id_pengepul)
    {
        $deletedPengepul = User::findOrFail($id_pengepul);
        $deletedPengepul->delete();
        if ($deletedPengepul) {
            session()->flash('status', 'success');
            session()->flash('message', 'delete ' . $deletedPengepul->nama . ' success!');
        }
        return redirect()->route('pengepul');
    }

    public function editProfile($id_pengepul)
    {
        $pengepul = User::findOrFail($id_pengepul);
        return view('pengepul.user-profile', ['pengepul' => $pengepul]);
    }

    public function updateProfile(Request $request, $id_pengepul)
    {
        $attributes = $request->validate([
            'nama' => ['required', 'max:64', 'min:2'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id_pengepul, 'id_pengepul'),
            ],
            'alamat' => ['nullable', 'max:100'],
            'username' => ['nullable', 'max:20'],
            'no_hp' => ['nullable', 'max:15'],
            'no_rek' => ['nullable', 'numeric'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $pengepul = User::findOrFail($id_pengepul);

        // Log before update


        // Update pengepul data except foto_profil
        $pengepul->update($request->except('foto_profil'));

        // Handle file upload
        if ($request->hasFile('foto_profil')) {
            if ($pengepul->foto_profil) {
                Storage::delete('foto_profil/' . $pengepul->foto_profil);
            }

            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_profil')->storeAs('foto_profil', $newName);
            $pengepul->foto_profil = $newName;
        }

        // Save changes
        $pengepul->save();

        // Log after update


        session()->flash('status', 'success');
        session()->flash('message', 'Edit data success!');
        return back()->with('success', 'Profile successfully updated');
    }

    public function viewNotifications()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to login first.');
        }

        $notifications = $user->unreadNotifications;

        return view('penjual.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->unreadNotifications->markAsRead();
        }

        return response()->json(['success' => true]);
    }
}
