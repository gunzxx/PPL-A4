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
        return view('shop.pengelola.index', [
            "css" => ['main','shop/shop'],
            ''
        ]);
    }
}
