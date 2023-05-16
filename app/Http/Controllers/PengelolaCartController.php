<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;

class PengelolaCartController extends Controller
{
    public function index()
    {
        $carts = Cart::where(['pengelola_id'=>auth()->user()->id])->with([
            'item'=>function($query){
                $query->with(['media']);
            }
        ])->orderBy('updated_at',"DESC")->paginate(10);

        return view('shop.pengelola.cart.index', [
            "css" => ['shop/shop'],
            'active' => "cart",
            'carts' => $carts,
        ]);
    }

    public function add(Request $request)
    {
        if(!$request->post('item_id')|| !$request->post('amount') || !$request->post('pengelola_id')){
            return response()->json(['message'=>'Data tidak valid!'],400);
        }
        if($request->post('amount') == 0){
            return response()->json(['message'=>'Data masih kosong!'],400);
        }
        $item_id = $request->post('item_id');
        $item = Item::find($item_id,['price']);

        $amount = $request->post('amount');
        
        $cekCart = Cart::where(['item_id'=>$item_id])->get(['amount'])->first();
        if($cekCart){
            $amount = $cekCart->amount + $amount;

            Cart::where(['item_id' => $item_id])->get()->first()->update([
                'amount' => $amount,
            ]);

            return response()->json(['message'=>'Barang berhasil ditambahkan!','data'=>$cekCart],200);
        }
        
        $pengelola_id = $request->post('pengelola_id');
        $cart = Cart::create([
            'amount' => $amount,
            'item_id' => $item_id,
            'pengelola_id' => $pengelola_id,
        ]);
        return response()->json(['message'=>'Barang berhasil ditambahkan!','data'=>$cart],200);
    }

    public function update(Request $request)
    {
        if(!$request->post('cart_id') || !$request->post('amount')){
            return response()->json(['message'=>'Data tidak valid!'],400);
        }
        $cart_id = $request->post('cart_id');
        $amount = $request->post('amount');

        $cart = Cart::find($cart_id);
        $item = Item::find($cart->item_id);

        $cost = $item->price * $amount;
        
        $cart->update([
            'amount' => $amount,
            'cost' => $cost,
            'updated_at' => now(),
        ]);
        return response()->json(['message'=>'Keranjang berhasil diperbarui!','data'=>$cart],200);
    }

    public function delete(Request $request)
    {
        if(!$request->post('cart_id')){
            return response()->json(['message'=>'Data tidak valid!'],400);
        }
        $cart_id = $request->post('cart_id');

        $cart = Cart::find($cart_id)->delete();
        
        return response()->json(['message'=>'Keranjang berhasil dihapus!','data'=>$cart],200);
    }
}
