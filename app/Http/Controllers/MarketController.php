<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Petani;
use App\Models\Favorit;
use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrderNotification;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $products = $this->filterProducts($request)->with('pengepul', 'kategori')->paginate(15);

        $vegetables = Product::whereHas('kategori', function ($query) {
            $query->where('nama', 'sayur');
        })->get();

        $allPetani = Petani::pluck('nama');
        $allKategori = Kategori::pluck('nama');

        return view('market.landing-page', compact('products', 'allPetani', 'allKategori', 'vegetables'));
    }

    public function products(Request $request)
    {
        $products = $this->filterProducts($request)->with('pengepul', 'kategori')->paginate(9);

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
                "foto_produk" => $product->foto_produk,
                "jumlah" => $product->jumlah
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
        $kabupaten = $pembeli ? $pembeli->kabupaten : null;
        $kecamatan = $pembeli ? $pembeli->kecamatan : null;

        $totalPrice = $this->calculateTotalPrice($cart);

        // Menentukan biaya pengiriman berdasarkan kabupaten dan kecamatan
        $kabupatenKecamatanDistance = [
            'Lombok Utara' => [
                'Bayan' => 23,
                'Gangga' => 59,
                'Kayangan' => 43,
                'Pemenang' => 74,
                'Tanjung' => 67,
            ],
            'Lombok Timur' => [
                'Aikmel' => 39,
                'Jerowaru' => 85,
                'Keruak' => 70,
                'Labuan Haji' => 55,
                'Lenek' => 42,
                'Masbagik' => 48,
                'Montong Gading' => 55,
                'Pringgabaya' => 38,
                'Pringgasela' => 46,
                'Sakra' => 56,
                'Sakra Timur' => 61,
                'Sakra Barat' => 64,
                'Sambelia' => 33,
                'Selong' => 51,
                'Sembalun' => 7,
                'Sikur' => 51,
                'Sukamulia' => 50,
                'Suralaga' => 44,
            ],
            'Lombok Tengah' => [
                'Batukliang' => 68,
                'Batukliang Utara' => 74,
                'Janapria' => 64,
                'Jonggat' => 83,
                'Kopang' => 63,
                'Praya' => 77,
                'Praya Barat' => 103,
                'Praya Barat Daya' => 90,
                'Praya Tengah' => 78,
                'Praya Timur' => 75,
                'Pringgarata' => 76,
                'Pujut' => 99,
            ],
            'Mataram' => [
                'Ampenan' => 99,
                'Cakranegara' => 101,
                'Mataram' => 90,
                'Sandubaya' => 90,
                'Sekarbela' => 102,
                'Selaparang' => 97,
            ],
            'Lombok Barat' => [
                'Batu Layar' => 94,
                'Gunungsari' => 94,
                'Lingsar' => 88,
                'Narmada' => 82,
                'Kediri' => 88,
                'Labuapi' => 93,
                'Kuripan' => 95,
                'Gerung' => 102,
                'Lembar' => 106,
                'Sekotong' => 146,
            ]
        ];

        $shippingCost = 0;

        if (isset($kabupatenKecamatanDistance[$kabupaten]) && isset($kabupatenKecamatanDistance[$kabupaten][$kecamatan])) {
            $distance = $kabupatenKecamatanDistance[$kabupaten][$kecamatan];

            if ($distance <= 40) {
                $shippingCost = 5000;
            } elseif ($distance <= 50) {
                $shippingCost = 10000;
            } elseif ($distance <= 60) {
                $shippingCost = 15000;
            } elseif ($distance <= 70) {
                $shippingCost = 20000;
            } elseif ($distance <= 80) {
                $shippingCost = 25000;
            } elseif ($distance <= 90) {
                $shippingCost = 30000;
            } elseif ($distance <= 100) {
                $shippingCost = 35000;
            } else {
                $shippingCost = 50000;
            }
        } else {
            $shippingCost = 30000; // Default shipping cost if not found
        }

        // Tambahkan biaya tambahan jika jumlah pembelian lebih besar dari 10
        $additionalShippingCost = 0;
        $totalItems = array_sum(array_column($cart, 'quantity'));
        // Tambahkan biaya tambahan berdasarkan berat total pesanan
        if ($totalItems > 10 && $totalItems <= 25) {
            $additionalShippingCost = 5000;
        } elseif ($totalItems > 25 && $totalItems <= 50) {
            $additionalShippingCost = 10000;
        } elseif ($totalItems > 50) {
            $additionalShippingCost = 25000;
        }

        // Menghitung total harga dengan biaya pengiriman
        $totalPriceWithShipping = $totalPrice + $shippingCost + $additionalShippingCost;

        // Mendapatkan nomor rekening admin
        $admin = Admin::select('no_rek')->first();

        // Mengirim data ke view 'market.checkout'
        return view('market.checkout', compact('cart', 'totalPrice', 'totalPriceWithShipping', 'alamat', 'admin', 'shippingCost', 'kabupaten', 'kecamatan', 'totalItems', 'additionalShippingCost'));
    }



    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        $user = auth()->guard('pembeli')->user();

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja Anda kosong!');
        }

        // Validate the request
        $request->validate([
            'metode_pembayaran' => 'required|in:COD,Transfer',
            'bukti_bayar' => 'required|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Check if the payment method is Transfer and proof of payment is provided
        if ($request->metode_pembayaran == 'Transfer' && !$request->hasFile('bukti_bayar')) {
            return redirect()->route('checkout')->with('error', 'Anda harus mengunggah bukti bayar untuk metode Transfer!');
        }

        // Calculate total price
        $totalPrice = $this->calculateTotalPrice($cart);

        // Get authenticated pembeli and their address details
        $pembeli = $this->getAuthenticatedPembeli();
        $alamat = $pembeli ? $pembeli->alamat : null;
        $kabupaten = $pembeli ? $pembeli->kabupaten : null;
        $kecamatan = $pembeli ? $pembeli->kecamatan : null;

        // Determine shipping cost based on kabupaten and kecamatan
        $kabupatenKecamatanDistance = [
            'Lombok Utara' => [
                'Bayan' => 23,
                'Gangga' => 59,
                'Kayangan' => 43,
                'Pemenang' => 74,
                'Tanjung' => 67,
            ],
            'Lombok Timur' => [
                'Aikmel' => 39,
                'Jerowaru' => 85,
                'Keruak' => 70,
                'Labuan Haji' => 55,
                'Lenek' => 42,
                'Masbagik' => 48,
                'Montong Gading' => 55,
                'Pringgabaya' => 38,
                'Pringgasela' => 46,
                'Sakra' => 56,
                'Sakra Timur' => 61,
                'Sakra Barat' => 64,
                'Sambelia' => 33,
                'Selong' => 51,
                'Sembalun' => 7,
                'Sikur' => 51,
                'Sukamulia' => 50,
                'Suralaga' => 44,
            ],
            'Lombok Tengah' => [
                'Batukliang' => 68,
                'Batukliang Utara' => 74,
                'Janapria' => 64,
                'Jonggat' => 83,
                'Kopang' => 63,
                'Praya' => 77,
                'Praya Barat' => 103,
                'Praya Barat Daya' => 90,
                'Praya Tengah' => 78,
                'Praya Timur' => 75,
                'Pringgarata' => 76,
                'Pujut' => 99,
            ],
            'Mataram' => [
                'Ampenan' => 99,
                'Cakranegara' => 101,
                'Mataram' => 90,
                'Sandubaya' => 90,
                'Sekarbela' => 102,
                'Selaparang' => 97,
            ],
            'Lombok Barat' => [
                'Batu Layar' => 94,
                'Gunungsari' => 94,
                'Lingsar' => 88,
                'Narmada' => 82,
                'Kediri' => 88,
                'Labuapi' => 93,
                'Kuripan' => 95,
                'Gerung' => 102,
                'Lembar' => 106,
                'Sekotong' => 146,
            ]
        ];

        $shippingCost = 0;

        if (isset($kabupatenKecamatanDistance[$kabupaten]) && isset($kabupatenKecamatanDistance[$kabupaten][$kecamatan])) {
            $distance = $kabupatenKecamatanDistance[$kabupaten][$kecamatan];

            if ($distance <= 40) {
                $shippingCost = 5000;
            } elseif ($distance <= 50) {
                $shippingCost = 10000;
            } elseif ($distance <= 60) {
                $shippingCost = 15000;
            } elseif ($distance <= 70) {
                $shippingCost = 20000;
            } elseif ($distance <= 80) {
                $shippingCost = 25000;
            } elseif ($distance <= 90) {
                $shippingCost = 30000;
            } elseif ($distance <= 100) {
                $shippingCost = 35000;
            } else {
                $shippingCost = 50000;
            }
        } else {
            $shippingCost = 30000; // Default shipping cost if not found
        }

        // Tambahkan biaya tambahan jika jumlah pembelian lebih besar dari 10
        $totalItems = array_sum(array_column($cart, 'quantity'));
        // Tambahkan biaya tambahan berdasarkan berat total pesanan
        if ($totalItems > 10 && $totalItems <= 25) {
            $shippingCost += 5000;
        } elseif ($totalItems > 25 && $totalItems <= 50) {
            $shippingCost += 10000;
        } elseif ($totalItems > 50) {
            $shippingCost += 25000;
        }

        $totalPriceWithShipping = $totalPrice + $shippingCost;

        // Handle file upload using the new function
        $buktiBayarPath = $this->storePaymentProofImage($request);

        // Create an order with the application's timezone
        $order = Pesanan::create([
            'id_pembeli' => $user->id_pembeli,
            'status' => 'Pending', // Initial status
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $totalPriceWithShipping,
            'tanggal_pesanan' => now(), // Use now() to get the current time in the app's timezone
            'created_at' => now(),
            'updated_at' => now(),
            'bukti_bayar' => $buktiBayarPath
        ]);

        $pengepulsNotified = []; // Array to keep track of notified pengepuls

        // Process each product in the cart
        foreach ($cart as $id_produk => $details) {
            // Fetch the product
            $product = Product::findOrFail($id_produk);

            // Check if stock is sufficient
            if ($product->jumlah < $details['quantity']) {
                return redirect()->route('cart')->with('error', 'Stok tidak mencukupi untuk produk: ' . $product->nama_produk);
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

            $pengepulIds = DB::table('tambah_produk')->where('id_produk', $id_produk)->pluck('id_pengepul');
            $pengepulUsers = User::whereIn('id_pengepul', $pengepulIds)->get();

            foreach ($pengepulUsers as $pengepulUser) {
                if (!in_array($pengepulUser->id_pengepul, $pengepulsNotified)) {
                    // Send notification to each seller only once
                    $pengepulUser->notify(new NewOrderNotification($order));
                    $pengepulsNotified[] = $pengepulUser->id_pengepul; // Mark pengepul as notified
                }
            }
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('market')->with('success', 'Pesanan berhasil dilakukan!');
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

    public function addToFavorite($id_produk)
    {
        $user = auth()->guard('pembeli')->user();
        $product = Product::find($id_produk);

        if ($product && $user) {
            // Cek jika produk sudah ada di daftar favorit
            if (!$user->favoriteProducts->contains($id_produk)) {
                $user->favoriteProducts()->attach($id_produk);

                return redirect()->back()->with('status', 'Produk berhasil ditambahkan ke favorit!');
            } else {
                return redirect()->back()->with('status', 'Produk sudah ada di daftar favorit!');
            }
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan, produk tidak ditemukan.');
    }

    public function showFavorites()
    {
        $user = auth()->guard('pembeli')->user();
        $favorites = $user->favoriteProducts; // Mengambil produk favorit

        return view('market.product-favorit', compact('favorites'));
    }

    public function removeFromFavorite($id_produk)
    {
        $user = auth()->guard('pembeli')->user();
        $user->favoriteProducts()->detach($id_produk);

        return redirect()->back()->with('status', 'Produk berhasil dihapus dari favorit!');
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

    public function destroy($id_pesanan)
    {
        $order = Pesanan::findOrFail($id_pesanan);
        $order->delete();

        return redirect()->route('admin.viewAllOrders')->with('status', 'Pesanan berhasil dihapus!');
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

        // Filter Harga
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $productQuery->whereBetween('harga', [$request->min_price, $request->max_price]);
        } elseif ($request->filled('min_price')) {
            $productQuery->where('harga', '>=', $request->min_price);
        } elseif ($request->filled('max_price')) {
            $productQuery->where('harga', '<=', $request->max_price);
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

    private function storePaymentProofImage($request)
    {
        if ($request->hasFile('bukti_bayar')) {
            $extension = $request->file('bukti_bayar')->getClientOriginalExtension();
            $newName = 'bukti-bayar-' . now()->timestamp . '.' . $extension;
            $request->file('bukti_bayar')->storeAs('bukti_bayar', $newName, 'public');
            return $newName;
        }
        return null;
    }
}
