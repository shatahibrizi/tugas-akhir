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

    function show($id_produk)
    {
        $products = Product::with(
            ['petani', 'kategori']
        )->findOrFail($id_produk);
        return view('pengepul.product.product-detail', ['products' => $products]);
    }

    function create()
    {
        $products = Product::all();

        $petani = Petani::select('id_petani', 'nama')->get();
        $kategori = Kategori::select('id_kategori', 'nama')->get();
        return view('pengepul.product.product-add', ['products' => $products, 'petani' => $petani, 'kategori' => $kategori]);
    }

    function store(Request $request)
    {
        $newName = '';

        if ($request->file('foto_produk')) {
            $extension = $request->file('foto_produk')->getClientOriginalExtension();
            $newName = $request->nama_produk . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_produk')->storeAs('foto_produk', $newName);
        }
        if (!empty($newName)) {
            $request['foto_produk'] = $newName;
        }
        $request['foto_produk'] = $newName;

        $product = Product::create([
            'nama_produk' => $request->nama_produk,
            'foto_produk' => $newName,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'grade' => $request->grade,
            'id_kategori' => $request->id_kategori,
            'id_petani' => $request->id_petani,
        ]);

        $date = now();

        if ($product) {
            $product->pengepul()->attach(auth()->user()->id_pengepul, [
                'jumlah' => $request->jumlah,
                'tanggal' => $date,
            ]);
            session()->flash('status', 'success');
            session()->flash('message', 'add data success!');
        }
        return redirect('/products');
    }

    public function edit(Request $request, $id_produk)
    {
        $products = Product::with(['petani', 'kategori'])->findOrFail($id_produk);
        // dd($products);
        $petani = Petani::where('id_petani', '!=', $products->id_petani)->get(['id_petani', 'nama']);
        $kategori = Kategori::where('id_kategori', '!=', $products->id_kategori)->get(['id_kategori', 'nama']);
        return view('pengepul.product.product-edit', ['products' => $products, 'petani' => $petani, 'kategori' => $kategori]);
    }


    function update(Request $request, $id_produk)
    {
        $products = Product::findOrFail($id_produk);


        // Perbarui informasi produk lainnya
        $products->update($request->except('foto_produk')); // Hindari menyertakan 'foto_produk' dalam proses update

        // Periksa apakah ada file baru yang diunggah
        if ($request->hasFile('foto_produk')) {
            // Hapus gambar lama jika ada
            if ($products->foto_produk) {
                Storage::delete('foto_produk/' . $products->foto_produk);
            }

            // Simpan gambar baru dan perbarui nama file di basis data
            $extension = $request->file('foto_produk')->getClientOriginalExtension();
            $newName = $request->nama_produk . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_produk')->storeAs('foto_produk', $newName);
            $products->foto_produk = $newName;
        }

        // Simpan perubahan produk
        $products->save();


        session()->flash('status', 'success');
        session()->flash('message', 'edit data success!');

        return redirect('/products');
    }

    function destroy(Request $request, $id_produk)
    {
        $deletedProduct = Product::findOrFail($id_produk);
        $deletedProduct->delete();
        if ($deletedProduct) {
            session()->flash('status', 'success');
            session()->flash('message', 'delete ' . $deletedProduct->nama_produk . ' success!');
        }
        return redirect('/products');
    }
}
