<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Petani;
use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $products = $this->filterProducts($request)->paginate(15);

        $vegetables = Product::whereHas('kategori', function ($query) {
            $query->where('nama', 'sayur');
        })->get();

        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        return view('market.landing-page', compact('products', 'allPetani', 'allKategori', 'vegetables'));
    }

    public function products(Request $request)
    {
        $products = $this->filterProducts($request)->paginate(9);

        $vegetables = Product::whereHas('kategori', function ($query) {
            $query->where('nama', 'sayur');
        })->get();

        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        return view('market.products', compact('products', 'allPetani', 'allKategori', 'vegetables'));
    }

    public function productDetail($id_produk)
    {
        $product = Product::with(['petani', 'kategori'])->findOrFail($id_produk);
        $products = Product::with(['petani', 'kategori'])->get();

        return view('market.product-detail', compact('product', 'products'));
    }

    public function cart()
    {
        $pembeli = $this->getAuthenticatedPembeli();
        $alamat = $pembeli ? $pembeli->alamat : null;

        return view('market.cart', compact('alamat'));
    }

    public function addProductToCart($id_produk)
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
            $cart[$request->id_produk]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Product quantity updated.');
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

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $pembeli = $this->getAuthenticatedPembeli();
        $alamat = $pembeli ? $pembeli->alamat : null;

        $totalPrice = $this->calculateTotalPrice($cart);
        $totalPriceWithShipping = $totalPrice + 30000; // Flat rate shipping

        return view('market.checkout', compact('cart', 'totalPrice', 'totalPriceWithShipping', 'alamat'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        $user = auth()->guard('pembeli')->user();

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        // Validate the request
        $request->validate([
            'metode_pembayaran' => 'required|in:COD,Transfer',
        ]);

        // Calculate total price
        $totalPrice = $this->calculateTotalPrice($cart);
        $totalPriceWithShipping = $totalPrice + 30000; // Flat rate shipping cost

        // Create an order with the application's timezone
        $order = Pesanan::create([
            'id_pembeli' => $user->id_pembeli,
            'status' => 'Pending', // Initial status
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $totalPriceWithShipping,
            'tanggal_pesanan' => now(), // Use now() to get the current time in the app's timezone
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Process each product in the cart
        foreach ($cart as $id_produk => $details) {
            // Fetch the product
            $product = Product::findOrFail($id_produk);

            // Check if stock is sufficient
            if ($product->jumlah < $details['quantity']) {
                return redirect()->route('cart')->with('error', 'Stock is insufficient for product: ' . $product->nama_produk);
            }

            // Reduce the stock
            $product->jumlah -= $details['quantity'];
            $product->save();

            // Attach product to the order
            $order->products()->attach($id_produk, [
                'jumlah' => $details['quantity'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('market')->with('success', 'Order placed successfully!');
    }


    public function showOrders()
    {
        $user = auth()->guard('pembeli')->user();
        $orders = Pesanan::where('id_pembeli', $user->id_pembeli)
            ->with('products')
            ->get();

        error_log("Jumlah pesanan: " . $orders->count());

        foreach ($orders as $order) {
            error_log("Pesanan ID: " . $order->id_pesanan);
            error_log("Jumlah produk dalam pesanan: " . $order->products->count());
            foreach ($order->products as $product) {
                error_log("Produk: " . $product->nama_produk . ", Jumlah: " . $product->pivot->jumlah);
            }
        }

        return view('market.orders', compact('orders'));
    }

    public function updateStatus(Request $request, $id_pesanan, $status)
    {
        $order = Pesanan::find($id_pesanan);

        if ($order) {
            $order->status = $status;
            $order->save();

            return redirect()->back()->with('status', 'Status pesanan berhasil diperbarui.');
        }

        return redirect()->back()->with('status', 'Pesanan tidak ditemukan.');
    }



    private function filterProducts(Request $request)
    {
        $productQuery = Product::query();

        if ($request->keyword) {
            $productQuery->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filter) {
            $productQuery->where('grade', $request->filter);
        }

        if ($request->price_filter) {
            switch ($request->price_filter) {
                case 'Below 10000':
                    $productQuery->where('harga', '<', 10000);
                    break;
                case '10000 - 50000':
                    $productQuery->whereBetween('harga', [10000, 50000]);
                    break;
                case 'Above 50000':
                    $productQuery->where('harga', '>', 50000);
                    break;
            }
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

        return $productQuery;
    }

    private function calculateTotalPrice($cart)
    {
        return array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['harga'] * $item['quantity']);
        }, 0);
    }

    private function getAuthenticatedPembeli()
    {
        return Pembeli::find(auth()->guard('pembeli')->user()->id_pembeli);
    }
}
