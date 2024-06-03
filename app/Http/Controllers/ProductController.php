<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Petani;
use App\Models\Product;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $productQuery = Product::query();

        if ($user instanceof User) {
            $id_pengepul = $user->id_pengepul;

            $productQuery->whereExists(function ($query) use ($id_pengepul) {
                $query->select(DB::raw(1))
                    ->from('tambah_produk')
                    ->whereColumn('products.id_produk', 'tambah_produk.id_produk')
                    ->where('tambah_produk.id_pengepul', $id_pengepul);
            });
        }

        if ($request->keyword) {
            $productQuery->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filter) {
            $productQuery->where('grade', $request->filter);
        }

        if ($request->price_filter) {
            $this->applyPriceFilter($productQuery, $request->price_filter);
        }

        if ($request->kategori) {
            $productQuery->whereHas('kategori', function ($query) use ($request) {
                $query->where('nama', $request->kategori);
            });
        }

        if ($request->petani) {
            $productQuery->whereHas('petani', function ($query) use ($request) {
                $query->where('nama', $request->petani);
            });
        }

        $products = $productQuery->paginate(5);

        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        return view('pengepul.product.products', compact('products', 'allPetani', 'allKategori'));
    }

    public function show($id_produk)
    {
        $product = Product::with(['petani', 'kategori'])->findOrFail($id_produk);
        return view('pengepul.product.product-detail', compact('product'));
    }

    public function create()
    {
        $petani = Petani::select('id_petani', 'nama')->get();
        $kategori = Kategori::select('id_kategori', 'nama')->get();
        return view('pengepul.product.product-add', compact('petani', 'kategori'));
    }

    public function store(Request $request)
    {
        $newName = $this->storeProductImage($request);

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

        if ($product) {
            $this->attachPengepulData($product, $request->jumlah);
            $this->generateAndStoreQrCode($product);

            session()->flash('status', 'success');
            session()->flash('message', 'Add data success, and QR-code has been generated!');
        }

        return redirect('/products');
    }

    public function edit($id_produk)
    {
        $product = Product::with(['petani', 'kategori'])->findOrFail($id_produk);
        $petani = Petani::where('id_petani', '!=', $product->id_petani)->get(['id_petani', 'nama']);
        $kategori = Kategori::where('id_kategori', '!=', $product->id_kategori)->get(['id_kategori', 'nama']);

        return view('pengepul.product.product-edit', compact('product', 'petani', 'kategori'));
    }

    public function update(Request $request, $id_produk)
    {
        $product = Product::findOrFail($id_produk);

        $product->update($request->except('foto_produk'));

        if ($request->hasFile('foto_produk')) {
            $this->updateProductImage($product, $request);
        }

        $product->save();

        $this->generateAndStoreQrCode($product);

        session()->flash('status', 'success');
        session()->flash('message', 'Edit data success!');

        return redirect('/products');
    }

    public function destroy($id_produk)
    {
        $product = Product::findOrFail($id_produk);
        $product->delete();

        session()->flash('status', 'success');
        session()->flash('message', 'Delete ' . $product->nama_produk . ' success!');
        return redirect('/products');
    }

    public function track(Request $request)
    {
        $user = auth()->user();
        $productQuery = Product::query();

        if ($user instanceof User) {
            $id_pengepul = $user->id_pengepul;

            $productQuery->whereExists(function ($query) use ($id_pengepul) {
                $query->select(DB::raw(1))
                    ->from('tambah_produk')
                    ->whereColumn('products.id_produk', 'tambah_produk.id_produk')
                    ->where('tambah_produk.id_pengepul', $id_pengepul);
            });
        }

        if ($request->keyword) {
            $productQuery->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filter) {
            $productQuery->where('grade', $request->filter);
        }

        if ($request->price_filter) {
            $this->applyPriceFilter($productQuery, $request->price_filter);
        }

        if ($request->kategori) {
            $productQuery->whereHas('kategori', function ($query) use ($request) {
                $query->where('nama', $request->kategori);
            });
        }

        if ($request->petani) {
            $productQuery->whereHas('petani', function ($query) use ($request) {
                $query->where('nama', $request->petani);
            });
        }

        $products = $productQuery->paginate(10);

        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        return view('pengepul.product.product-lacak', compact('products', 'allPetani', 'allKategori'));
    }

    private function storeProductImage($request)
    {
        if ($request->hasFile('foto_produk')) {
            $extension = $request->file('foto_produk')->getClientOriginalExtension();
            $newName = $request->nama_produk . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto_produk')->storeAs('foto_produk', $newName);
            return $newName;
        }
        return '';
    }

    private function updateProductImage($product, $request)
    {
        if ($product->foto_produk) {
            Storage::delete('foto_produk/' . $product->foto_produk);
        }

        $extension = $request->file('foto_produk')->getClientOriginalExtension();
        $newName = $request->nama_produk . '-' . now()->timestamp . '.' . $extension;
        $request->file('foto_produk')->storeAs('foto_produk', $newName);
        $product->foto_produk = $newName;
    }

    private function attachPengepulData($product, $jumlah)
    {
        $product->pengepul()->attach(auth()->user()->id_pengepul, [
            'jumlah' => $jumlah,
            'tanggal' => now(),
        ]);
    }

    private function generateAndStoreQrCode($product)
    {
        $createdAtWITA = Carbon::parse($product->created_at)->timezone('Asia/Makassar');
        $updatedAtWITA = Carbon::parse($product->updated_at)->timezone('Asia/Makassar');
        $petani = $product->petani;

        $qrData = "Nama Produk: " . $product->nama_produk . "\n"
            . "Grade: " . $product->grade . "\n"
            . "Nama Petani: " . $petani->nama . "\n"
            . "Tanggal masuk: " . $createdAtWITA->format('Y-m-d H:i:s') . "\n"
            . "Terakhir diubah: " . $updatedAtWITA->format('Y-m-d H:i:s');

        $qrCode = QrCode::format('png')->size(200)->generate($qrData);

        $qrCodePath = public_path('qrcodes');
        if (!file_exists($qrCodePath)) {
            mkdir($qrCodePath, 0777, true);
        }

        $qrCodeFilePath = $qrCodePath . '/' . $product->nama_produk . '-' . $product->petani->nama . '-' . now()->timestamp . '.png';
        file_put_contents($qrCodeFilePath, $qrCode);

        $product->update(['qr_code_path' => 'qrcodes/' . $product->nama_produk . '-' . $product->petani->nama . '-' . now()->timestamp . '.png']);
    }

    private function applyPriceFilter($productQuery, $priceFilter)
    {
        if ($priceFilter === 'Below 10000') {
            $productQuery->where('harga', '<', 10000);
        } elseif ($priceFilter === '10000 - 50000') {
            $productQuery->whereBetween('harga', [10000, 50000]);
        } elseif ($priceFilter === 'Above 50000') {
            $productQuery->where('harga', '>', 50000);
        }
    }

    public function orders()
    {
        // Fetch all orders with their associated products
        $orders = Pesanan::with('products', 'pembeli')->get();

        // Return the view with the fetched orders
        return view('pengepul.orders', compact('orders'));
    }
}
