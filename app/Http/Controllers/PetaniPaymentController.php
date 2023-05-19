<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Payment;
use Illuminate\Http\Request;

class PetaniPaymentController extends Controller
{
    /**
     * Method untuk menampilkan view bukti pembayaran
     */
    public function index()
    {
        $payments = Payment::where([
            'petani_id'=>auth()->user()->id,
        ])->where(function($query){
            $query->where(['status'=>'waiting'])->orWhere(['status'=>'accept']);
        })->whereHas('transaction',function($query){
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
                    'petani',
                ]);
            },
            'pengelola',
        ])->latest()->get();

        return view("shop.petani.payment.index",[
            "css" => ['shop/shop'],
            'active' => 'payment',
            'payments' => $payments,
        ]);
    }

    /**
     * Method untuk menerima bukti pembayaran
     */
    public function accept(Request $request)
    {
        if(!$request->post("payment_id")){
            return response()->json(['message'=>"Data tidak valid!"],400);
        }
        $payment_id = $request->post("payment_id");
        $payment = Payment::find($payment_id,['id','status','transaction_id','petani_id','pengelola_id']);
        $payment->update(['status'=>'accept']);

        Delivery::create([
            'transaction_id'=>$payment->transaction_id,
            'petani_id'=>$payment->petani_id,
            'pengelola_id'=>$payment->pengelola_id,
        ]);
        return response()->json(['message'=>"Pembayaran diterima!"]);
    }

    /**
     * Method untuk menampilkan view bukti pembayaran
     */
    public function showPay($payment_id)
    {
        $payment = Payment::where([
            'id'=> $payment_id,
            'petani_id'=>auth()->user()->id,
        ])->where(function($query){
            $query->where(['status'=>'notpay'])->orWhere(['status'=>'waiting'])->orWhere(['status'=>'accept']);
        })->first(['id','status','petani_id','transaction_id']);

        if(!$payment){
            return abort(404);
        }

        return view("shop.petani.payment.proof",[
            "css" => ['shop/shop','shop/proof'],
            'active' => 'payment',
            'payment' => $payment,
        ]);
    }
}