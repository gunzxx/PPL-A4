<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PetaniPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::where([
            'pengelola_id'=>auth()->user()->id,
        ])->whereHas('transaction',function($query){
            $query->where([
                'is_active'=>true,
                'status'=>'process',
            ]);
        })->with([
            'transaction'=>function($query){
                $query->with([
                    'item'=>function($query){
                        $query->with(['media']);
                    },
                    'pengelola',
                ]);
            },
            'petani',
        ])->get();

        return view("shop.pengelola.payment.index",[
            "css" => ['shop/shop'],
            'active' => 'payment',
            'payments' => $payments,
        ]);
    }
}
