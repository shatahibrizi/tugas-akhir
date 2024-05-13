<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetaniController extends Controller
{
    function index(Request $request)
    {
        // Mengambil id_pengepul dari user yang saat ini masuk
        $id_pengepul = auth()->user()->id_pengepul;
        // dd($id_pengepul);

        $petani = Petani::paginate(5);


        // Lakukan query dan ambil hasil

        // Ambil semua nama petani
        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        // Kirim data ke view
        return view('pengepul.petani.petani', ['petani' => $petani]);
    }

    function show($id_petani)
    {
        $petani = Petani::with('products')->findOrFail($id_petani);
        return view('pengepul.petani.petani-detail', ['petani' => $petani]);
    }

    function create()
    {
        $petani = Petani::all();

        return view('pengepul.petani.petani-add', ['petani' => $petani]);
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

        $petani = Petani::create([
            'nama' => $request->nama,
            'foto' => $newName,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'luas_lahan' => $request->luas_lahan,
            'lokasi_lahan' => $request->lokasi_lahan,
            'grup_petani' => $request->grup_petani,
        ]);

        $date = now();

        if ($petani) {
            session()->flash('status', 'success');
            session()->flash('message', 'add data success!');
        }
        return redirect('/petani');
    }

    public function edit(Request $request, $id_petani)
    {
        $petani = Petani::findOrFail($id_petani);
        // dd($petani);
        return view('pengepul.petani.petani-edit', ['petani' => $petani]);
    }


    function update(Request $request, $id_petani)
    {
        $petani = Petani::findOrFail($id_petani);

        // Perbarui informasi produk lainnya
        $petani->update($request->except('foto')); // Hindari menyertakan 'foto_produk' dalam proses update

        // Periksa apakah ada file baru yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($petani->foto) {
                Storage::delete('foto/' . $petani->foto);
            }

            // Simpan gambar baru dan perbarui nama file di basis data
            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('foto', $newName);
            $petani->foto = $newName;
        }

        // Simpan perubahan produk
        $petani->save();


        session()->flash('status', 'success');
        session()->flash('message', 'edit data success!');

        return redirect('/petani');
    }

    function destroy(Request $request, $id_petani)
    {
        $deletedPetani = Product::findOrFail($id_petani);
        $deletedPetani->delete();
        if ($deletedPetani) {
            session()->flash('status', 'success');
            session()->flash('message', 'delete ' . $deletedPetani->nama . ' success!');
        }
        return redirect('/petani');
    }
}
