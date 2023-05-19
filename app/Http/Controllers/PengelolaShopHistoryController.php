<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PengelolaShopHistoryController extends Controller
{
    /**
     * Method untuk menampilkan view history
     */
    public function index()
    {
        $transactions = Transaction::where([
            'pengelola_id'=>auth()->user()->id,
            'is_active'=>false,
        ])->where(function($query){
            $query->where(['status'=>'cancel'])->orWhere(['status'=>'done']);
        })->with([
            'item' => function ($query) {
                $query->with(['media']);
            },
            'delivery',
            'pengelola','petani',
        ])->latest()->get();

        return view("shop.pengelola.history.index",[
            "css" => ['shop/shop'],
            'active' => 'history',
            'transactions' => $transactions,
        ]);
    }
}
