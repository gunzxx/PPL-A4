<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Premium;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function order(Request $request)
    {
        $premium = Premium::where(['user_id'=>auth()->user()->id])->first();
        if(!$premium){
            $premium = Premium::create([
                'uuid'=> Uuid::uuid4(),
                'user_id'=>auth()->user()->id,
            ]);
            $premium = Premium::find($premium->id);
            dd($premium);
    
            \Midtrans\Config::$serverKey = config("midtrans.server_key");
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $premium->uuid,
                    'gross_amount' => $premium->total_price,
                ),
                'customer_details' => array(
                    'name' => $premium->name,
                    'phone' => $premium->phone,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $premium->update([
                'snapToken'=>$snapToken,
            ]);
            return view("premium.index")->with('snapToken',$snapToken)->with("premium",$premium)->with('success','Pesanan berhasil dibuat, silahkan selesaikan pembayaran!');
        }
        $snapToken = $premium->snapToken;
        return view("premium.index", compact('snapToken', 'premium'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $premium = Premium::where(['uuid'=>$request->order_id])->first();
                $premium->update(['status' => 'paid']);

                $user = User::find($premium->user_id);
                $user->update(['premium'=>true]);
            }
        }
    }
}
