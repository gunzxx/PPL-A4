<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PengelolaPaymentController extends Controller
{
    /**
     * Method untuk menampilkan view pembayaran
     */
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
        ])->latest()->get();

        return view("shop.pengelola.payment.index",[
            "css" => ['shop/shop'],
            'active' => 'payment',
            'payments' => $payments,
        ]);
    }

    /**
     * Method untuk menampilkan view bukti pembayaran
     */
    public function pay($payment_id)
    {
        $payment = Payment::where([
            'id'=> $payment_id,
            'pengelola_id'=>auth()->user()->id,
        ])->where(function($query){
            $query->where(['status'=>'notpay'])->orWhere(['status'=>'waiting']);
        })->first(['id','status','petani_id','transaction_id']);

        if(!$payment){
            return abort(404);
        }

        return view("shop.pengelola.payment.proof",[
            "css" => ['shop/shop','shop/proof'],
            'active' => 'payment',
            'payment' => $payment,
        ]);
    }

    /**
     * Method untuk menyimpan bukti pembayaran
     */
    public function savePay(Request $request)
    {
        $request->validate([
            'payment_id' => 'required',
            'proof' => 'image',
        ]);

        $payment = Payment::where([
            'id'=> $request->post('payment_id'),
            'pengelola_id'=>auth()->user()->id,
        ])->where(function($query){
            $query->where(['status'=>'notpay'])->orWhere(['status'=>'waiting']);
        })->first();
        
        if(!$payment){
            return redirect("/pengelola/shop/payment")->with('error', "Pembayaran sudah diterima!");
        }
        
        if ($request->file('proof')) {
            if($payment->getFirstMediaUrl('payment_proof') == ''){
                $payment->update([
                    'status'=>'waiting',
                ]);
                $payment->addMediaFromRequest("proof")->toMediaCollection('payment_proof');
                return redirect("/pengelola/shop/payment")->with('success',"Bukti pembayaran berhasil diunggah!");
            }

            $payment->addMediaFromRequest("proof")->toMediaCollection('payment_proof');
            return redirect("/pengelola/shop/payment")->with('success',"Bukti pembayaran berhasil diperbarui!");
        }

        return redirect("/pengelola/shop/payment");
    }
}
