<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengelolaShopController extends Controller
{
    public function index()
    {

        return view('shop.pengelola.index', [
            "css" => ['main','shop/shop'],
            ''
        ]);
    }
}
