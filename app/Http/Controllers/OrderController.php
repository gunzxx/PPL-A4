<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $request->request->add(['total_price'=>($request->qty * 10000),'status'=>"unpaid"]);
        // dd($request->post());
        $order = Order::create($request->all());
        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config("midtrans.server_key");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'name' => $order->name,
                'phone' => $order->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view("tes2",compact('snapToken','order'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512',$request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $order = Order::find($request->order_id);
                $order->update(['status'=>'paid']);
            }
        }
    }
}
