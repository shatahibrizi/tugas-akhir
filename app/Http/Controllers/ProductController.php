<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function index(Request $request)
    {
        // Mengambil id_pengepul dari user yang saat ini masuk
        $id_pengepul = auth()->user()->id_pengepul;
        // dd($id_pengepul);

        // Mengambil parameter dari permintaan HTTP
        $keyword = $request->keyword;
        $filter = $request->filter;
        $priceFilter = $request->price_filter;
        $petani = $request->petani;
        $kategori = $request->kategori;

        // Membangun kueri database untuk produk
        $productQuery = Product::query();

        $productQuery = Product::whereExists(function ($query) use ($id_pengepul) {
            $query->select(DB::raw(1))
                ->from('users')
                ->join('tambah_produk', 'users.id_pengepul', '=', 'tambah_produk.id_pengepul')
                ->whereColumn('products.id_produk', 'tambah_produk.id_produk')
                ->where('users.id_pengepul', $id_pengepul);
        });



        // Filter berdasarkan kata kunci
        if ($keyword) {
            $productQuery->where('nama_produk', 'LIKE', '%' . $keyword . '%');
        }

        // Filter berdasarkan grade
        if ($filter) {
            $productQuery->where('grade', $filter);
        }

        // Filter berdasarkan harga
        if ($priceFilter) {
            if ($priceFilter === 'Below 10000') {
                $productQuery->where('harga', '<', 10000);
            } elseif ($priceFilter === '10000 - 50000') {
                $productQuery->whereBetween('harga', [10000, 50000]);
            } elseif ($priceFilter === 'Above 50000') {
                $productQuery->where('harga', '>', 50000);
            }
        }

        // Filter berdasarkan kategori
        if ($kategori) {
            $productQuery->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama', $kategori);
            });
        }

        // Filter berdasarkan petani
        if ($petani) {
            $productQuery->whereHas('petani', function ($query) use ($petani) {
                $query->where('nama', $petani);
            });
        }

        // Lakukan query dan ambil hasil
        $products = $productQuery->paginate(10);

        // Ambil semua nama petani
        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        // Kirim data ke view
        return view('pengepul.product.products', ['products' => $products, 'petani' => $allPetani, 'kategori' => $allKategori]);
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
