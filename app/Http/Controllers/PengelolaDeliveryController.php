<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Delivery;
use App\Models\Inventory;
use Illuminate\Http\Request;

class PengelolaDeliveryController extends Controller
{
    /**
     * Method untuk menampilkan view bukti pengiriman
     */
    public function index()
    {
        $delivery = Delivery::where([
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
                    'petani',
                ]);
            },
            'pengelola',
        ])->latest()->get();

        return view("shop.pengelola.delivery.index",[
            "css" => ['shop/shop'],
            'active' => 'delivery',
            'deliveries' => $delivery,
        ]);
    }

    /**
     * Method untuk menampilkan view bukti pengiriman
     */
    public function proof($delivery_id)
    {
        $delivery = Delivery::where([
            'id' => $delivery_id,
            'pengelola_id' => auth()->user()->id,
        ])->where(function ($query) {
            $query->where(['status' => 'waiting'])->orWhere(['status' => 'accept']);
        })->first(['id', 'status', 'petani_id', 'transaction_id']);

        if (!$delivery) {
            return abort(404);
        }

        return view("shop.pengelola.delivery.proof", [
            "css" => ['shop/shop', 'shop/proof'],
            'active' => 'delivery',
            'delivery' => $delivery,
        ]);
    }
    
    /**
     * Method untuk menerima bukti pengiriman
     */
    public function accept(Request $request)
    {
        if(!$request->post("delivery_id")){
            return response()->json(['message'=>"Data tidak valid!"],400);
        }
        $delivery_id = $request->post("delivery_id");
        $delivery = Delivery::find($delivery_id,['id','status','transaction_id','petani_id','pengelola_id']);
        $delivery->update([
            'status'=>'accept',
            'accept_at'=>Carbon::now(),
        ]);

        $transaction = $delivery->transaction;

        $inventory = $transaction->inventory;
        return response()->json(['message'=>"Pengiriman diterima!", $inventory]);
        $stok = (int)$inventory->stok + (int)$transaction->amount;
        Inventory::create([
            'bean_type'=>$transaction->bean_type,
            "stok"=>$stok,
            'user_id'=>$transaction->pengelola_id,
        ]);

        $transaction->update([
            'status' => 'done',
            'is_active' => false,
        ]);
        
        return response()->json(['message'=>"Pengiriman diterima!",$transaction]);
    }
}