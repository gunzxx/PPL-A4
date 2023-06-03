<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Delivery;
use Illuminate\Http\Request;

class PetaniDeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::where([
            'petani_id'=>auth()->user()->id,
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
            'pengelola',
        ])->latest()->get();

        return view("shop.petani.delivery.index",[
            "css" => ['shop/shop'],
            'active' => 'delivery',
            'deliveries' => $deliveries,
        ]);
    }

    /**
     * Method untuk menampilkan view edit bukti pengiriman
     */
    public function send($delivery_id)
    {
        $delivery = Delivery::where([
            'id' => $delivery_id,
            'petani_id' => auth()->user()->id,
        ])->where(function ($query) {
            $query->where(['status' => 'notsend'])->orWhere(['status' => 'waiting']);
        })->first(['id', 'status', 'petani_id', 'pengelola_id', 'transaction_id']);

        if (!$delivery) {
            return abort(404);
        }

        return view("shop.petani.delivery.proof", [
            "css" => ['shop/shop', 'shop/proof'],
            'active' => 'delivery',
            'delivery' => $delivery,
        ]);
    }
    
    /**
     * Method untuk menyimpan bukti pengiriman
     */
    public function save(Request $request)
    {
        $request->validate([
            'delivery_id' => 'required',
            'proof' => 'image',
        ]);

        $delivery = Delivery::where([
            'id'=> $request->post('delivery_id'),
            'petani_id'=>auth()->user()->id,
        ])->where(function($query){
            $query->where(['status'=>'notsend'])->orWhere(['status'=>'waiting']);
        })->first();
        
        if(!$delivery){
            return redirect("/petani/shop/delivery")->with('error', "Pengiriman tidak ditemukan!");
        }
        
        if ($request->file('proof')) {
            if($delivery->getFirstMediaUrl('delivery_proof') == ''){
                $delivery->update([
                    'status'=>'waiting',
                ]);
                $delivery->addMediaFromRequest("proof")->toMediaCollection('delivery_proof');
                $delivery->update([
                    'send_at' => Carbon::now(),
                ]);
                return redirect("/petani/shop/delivery")->with('success',"Bukti pengiriman berhasil diunggah!");
            }
            
            $delivery->addMediaFromRequest("proof")->toMediaCollection('delivery_proof');
            $delivery->update([
                'send_at' => Carbon::now(),
            ]);
            return redirect("/petani/shop/delivery")->with('success',"Berhasil dikirim!");
        }

        return redirect("/petani/shop/delivery");
    }

    /**
     * Method untuk menampilkan view bukti pengiriman
     */
    public function proof($delivery_id)
    {
        $delivery = Delivery::where([
            'id' => $delivery_id,
            'petani_id' => auth()->user()->id,
            'status' => 'accept',
        ])->first(['id', 'status', 'pengelola_id', 'petani_id', 'transaction_id']);

        if (!$delivery) {
            return abort(404);
        }

        return view("shop.petani.delivery.proof", [
            "css" => ['shop/shop', 'shop/proof'],
            'active' => 'delivery',
            'delivery' => $delivery,
        ]);
    }
}
