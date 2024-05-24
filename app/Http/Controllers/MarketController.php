<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        return view('market.landing-page');
    }

    public function products()
    {
        return view('market.products');
    }

    public function productDetail()
    {
        return view('market.product-detail');
    }
}
