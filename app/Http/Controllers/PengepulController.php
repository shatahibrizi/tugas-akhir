<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;
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

        if ($request->file('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('foto', $newName);
        }
        if (!empty($newName)) {
            $request['foto'] = $newName;
        }
        $request['foto'] = $newName;

        $pengepul = User::create([
            'nama' => $request->nama,
            'foto' => $newName,
            'email' => $request->email,
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
        return redirect('/petani');
    }

    public function edit(Request $request, $id_pengepul)
    {
        $pengepul = User::findOrFail($id_pengepul);
        // dd($pengepul);
        return view('admin.pengepul-edit', ['pengepul' => $pengepul]);
    }


    function update(Request $request, $id_pengepul)
    {
        $pengepul = User::findOrFail($id_pengepul);

        // Perbarui informasi produk lainnya
        $pengepul->update($request->except('foto')); // Hindari menyertakan 'foto_produk' dalam proses update

        // Periksa apakah ada file baru yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($pengepul->foto) {
                Storage::delete('foto/' . $pengepul->foto);
            }

            // Simpan gambar baru dan perbarui nama file di basis data
            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('foto', $newName);
            $pengepul->foto = $newName;
        }

        // Simpan perubahan produk
        $pengepul->save();


        session()->flash('status', 'success');
        session()->flash('message', 'edit data success!');

        return redirect('/petani');
    }

    function destroy(Request $request, $id_pengepul)
    {
        $deletedPengepul = User::findOrFail($id_pengepul);
        $deletedPengepul->delete();
        if ($deletedPengepul) {
            session()->flash('status', 'success');
            session()->flash('message', 'delete ' . $deletedPengepul->nama . ' success!');
        }
        return redirect('/petani');
    }
}
