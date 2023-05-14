<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PetaniShopController extends Controller
{
    public function index()
    {
        $items = Item::where(['id'=>1])->with(['agreementDetail'])->get()->first();
        dd($items->agreementDetail);
        return view('shop.petani.shop.index', [
            "css" => ['shop/shop'],
            "active" => "shop",
        ]);
    }
}
