<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petani;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    function index(Request $request)
    {
        // Mengambil id_pengepul dari user yang saat ini masuk
        $user = auth()->user();

        // Membangun kueri database untuk produk
        $productQuery = Product::query();

        if ($user instanceof User) {
            // Jika pengguna adalah pengepul, batasi akses hanya ke produk yang terkait dengan pengepul tersebut
            $id_pengepul = $user->id_pengepul;

            $productQuery->whereExists(function ($query) use ($id_pengepul) {
                $query->select(DB::raw(1))
                    ->from('tambah_produk')
                    ->whereColumn('products.id_produk', 'tambah_produk.id_produk')
                    ->where('tambah_produk.id_pengepul', $id_pengepul);
            });
        }

        // Filter berdasarkan kata kunci
        if ($request->keyword) {
            $productQuery->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
        }

        // Filter berdasarkan grade
        if ($request->filter) {
            $productQuery->where('grade', $request->filter);
        }

        // Filter berdasarkan harga
        if ($request->price_filter) {
            if ($request->price_filter === 'Below 10000') {
                $productQuery->where('harga', '<', 10000);
            } elseif ($request->price_filter === '10000 - 50000') {
                $productQuery->whereBetween('harga', [10000, 50000]);
            } elseif ($request->price_filter === 'Above 50000') {
                $productQuery->where('harga', '>', 50000);
            }
        }

        // Filter berdasarkan kategori
        if ($request->kategori) {
            $productQuery->whereHas('kategori', function ($query) use ($request) {
                $query->where('nama', $request->kategori);
            });
        }

        // Filter berdasarkan petani
        if ($request->petani) {
            $productQuery->whereHas('petani', function ($query) use ($request) {
                $query->where('nama', $request->petani);
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

    public function store(Request $request)
    {
        $newName = '';

        // Simpan foto produk
        if ($request->hasFile('foto_produk')) {
            $extension = $request->file('foto_produk')->getClientOriginalExtension();
            $newName = $request->nama_produk . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_produk')->storeAs('foto_produk', $newName);
        }

        // Buat produk baru
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

        // Attach data pengepul
        $date = now();
        if ($product) {
            $product->pengepul()->attach(auth()->user()->id_pengepul, [
                'jumlah' => $request->jumlah,
                'tanggal' => $date,
            ]);

            // Buat data untuk QR code
            $qrData = "Nama Produk: " . $product->nama_produk . "\n" .
                "Grade: " . $product->grade . "\n" .
                "Nama Petani: " . $product->petani->nama . "\n" . // Anda perlu mengganti 'nama' dengan kolom yang sesuai
                "Created At: " . $product->created_at->toDateTimeString() . "\n" .
                "Updated At: " . $product->updated_at->toDateTimeString();

            // Generate QR code dan simpan sebagai file
            $qrCodePath = 'qrcodes/' . $product->nama_produk . '-' . $product->petani->nama . '-' . now()->timestamp . '.png';
            QrCode::format('png')->size(200)->generate($qrData, public_path($qrCodePath));

            // Simpan path QR code ke produk
            $product->update(['qr_code_path' => $qrCodePath]);

            // Flash message
            session()->flash('status', 'success');
            session()->flash('message', 'add data success, and QR-code has been generated!');
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
