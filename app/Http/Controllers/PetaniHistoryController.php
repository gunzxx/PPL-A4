<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PetaniHistoryController extends Controller
{
    /**
     * Method untuk menampilkan view history
     */
    public function index()
    {
        $transactions = Transaction::where([
            'petani_id'=>auth()->user()->id,
            'is_active'=>false,
            'status'=>'done',
        ])->with([
            'item' => function ($query) {
                $query->with(['media']);
            },
            'delivery',
            'pengelola','petani',
        ])->latest()->get();

        return view("shop.petani.history.index",[
            "css" => ['shop/shop'],
            'active' => 'history',
            'transactions' => $transactions,
        ]);
    }
}
