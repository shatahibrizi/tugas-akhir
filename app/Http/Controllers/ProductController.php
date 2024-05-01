<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Petani;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['petani', 'kategori'])->get();
        // dd($products);
        return view('pengepul.product-table', ['productList' => $products]);
    }

    function show($id)
    {
        $product = Product::with(
            ['petani', 'user']
        )->findOrFail($id);
        return view('product-detail', ['product' => $product]);
    }

    function create()
    {
        $products = Product::all();
        $petani = Petani::select('id_petani', 'nama')->get();
        $kategori = Kategori::select('id_kategori', 'nama')->get();
        return view('pengepul.product-add', ['products' => $products, 'petani' => $petani, 'kategori' => $kategori]);
    }

    function store(Request $request)
    {

        $product = Product::distinct('grade')->create($request->all());
        if ($product) {
            session()->flash('status', 'success');
            session()->flash('message', 'add data success!');
        }
        return redirect('/products');
    }
}
