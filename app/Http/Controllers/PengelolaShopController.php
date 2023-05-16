<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PengelolaShopController extends Controller
{
    /**
     * Method untuk menampilkan view shop
     */
    public function index()
    {
        $items = Item::where(['pengelola_id' => auth()->user()->id])->with(['media', 'agreementDetail', 'inventory'])->latest()->paginate();

        return view('shop.pengelola.shop.index', [
            "css" => ['shop/shop'],
            'active' => "shop",
            'items' => $items,
        ]);
    }
}
