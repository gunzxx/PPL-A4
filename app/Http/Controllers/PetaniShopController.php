<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaniShopController extends Controller
{
    public function index()
    {
        return view('shop.petani.shop.index', [
            "css" => ['shop/shop'],
            "active" => "shop",
        ]);
    }
}
