<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengelolaShopController extends Controller
{
    /**
     * Method untuk menampilkan view shop
     */
    public function index()
    {
        return view('shop.pengelola.shop.index', [
            "css" => ['shop/shop'],
            'active' => "shop",
        ]);
    }
}
