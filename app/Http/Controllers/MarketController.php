<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use App\Models\Pembeli;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $productQuery = Product::query();
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
        $products = $productQuery->paginate(15);

        $vegetables = Product::whereHas('kategori', function ($query) {
            $query->where('nama', 'sayur');
        })->get();
        // Ambil semua nama petani
        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        // Kirim data ke view
        return view('market.landing-page', ['products' => $products, 'petani' => $allPetani, 'kategori' => $allKategori, 'vegetables' => $vegetables]);
    }

    public function products(Request $request)
    {
        $productQuery = Product::query();
        if ($request->keyword) {
            $productQuery->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
        }

        // Filter berdasarkan grade
        if ($request->filter) {
            $productQuery->where('grade', $request->filter);
        }

        // Filter berdasarkan harga
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $productQuery->whereBetween('harga', [$request->min_price, $request->max_price]);
        } elseif ($request->filled('min_price')) {
            $productQuery->where('harga', '>=', $request->min_price);
        } elseif ($request->filled('max_price')) {
            $productQuery->where('harga', '<=', $request->max_price);
        }

        session()->flash('min_price', $request->min_price);
        session()->flash('max_price', $request->max_price);

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
        $products = $productQuery->paginate(9);

        $vegetables = Product::whereHas('kategori', function ($query) {
            $query->where('nama', 'sayur');
        })->get();
        // Ambil semua nama petani
        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        // Kirim data ke view
        return view('market.products', ['products' => $products, 'petani' => $allPetani, 'kategori' => $allKategori, 'vegetables' => $vegetables]);
    }

    public function productDetail($id_produk)
    {
        $product = Product::with(
            ['petani', 'kategori']
        )->findOrFail($id_produk);

        $products = Product::with(['petani', 'kategori'])->get();
        return view('market.product-detail', ['product' => $product, 'products' => $products]);
    }

    public function cart()
    {
        $pembeli = Pembeli::find(auth()->guard('pembeli')->user()->id_pembeli); // Asumsi pembeli terautentikasi

        // Mengambil alamat pembeli
        $alamat = $pembeli ? $pembeli->alamat : null;

        // Mengembalikan view 'market.cart' dengan data alamat
        return view('market.cart', compact('alamat'));
    }

    public function addProducttoCart($id_produk)
    {
        $product = Product::findOrFail($id_produk);
        $cart = session()->get('cart', []);
        if (isset($cart[$id_produk])) {
            $cart[$id_produk]['quantity']++;
        } else {
            $cart[$id_produk] = [
                "nama_produk" => $product->nama_produk,
                "quantity" => 1,
                "harga" => $product->harga,
                "foto_produk" => $product->foto_produk
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product has been added to cart!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id_produk && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id_produkj]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Product added to cart.');
        }
    }

    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
    }
}
