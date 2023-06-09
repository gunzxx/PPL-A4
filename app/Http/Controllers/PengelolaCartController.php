<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PengelolaCartController extends Controller
{
    /**
     * Method untuk menampilkan view keranjang
     */
    public function index()
    {
        $carts = Cart::where(['pengelola_id'=>auth()->user()->id])->with([
            'item'=>function($query){
                $query->with(['media']);
            }
        ])->latest()->paginate(10);

        return view('shop.pengelola.cart.index', [
            "css" => ['shop/shop'],
            'active' => "cart",
            'carts' => $carts,
        ]);
    }

    /**
     * Method untuk menambah data keranjang
     */
    public function add(Request $request)
    {
        if(!$request->post('item_id')|| !$request->post('amount')){
            return response()->json(['message'=>'Data tidak valid!'],400);
        }
        if($request->post('amount') < 0){
            return response()->json(['message'=>'Data masih kosong!'],400);
        }

        $item_id = $request->post('item_id');
        (int)$amount = $request->post('amount');
        
        $cekCart = Cart::where(['item_id'=>$item_id])->get(['id','amount','updated_at','item_id'])->first();
        if($cekCart){
            $amount = (int)$cekCart->amount + (int)$amount;
            if($amount > $cekCart->item->stok){
                return response()->json(['message'=>'Jumlah melebihi batas stok!'],200);
            }

            $cekCart->update([
                'amount' => $amount,
                'updated_at'=>Carbon::now(),
            ]);

            return response()->json(['message'=>'Data berhasil ditambahkan ke keranjang!','data'=>$cekCart],200);
        }
        
        $pengelola_id = Item::find($item_id)->pengelola_id;
        $cart = Cart::create([
            'amount' => $amount,
            'item_id' => $item_id,
            'pengelola_id' => $pengelola_id,
        ]);
        return response()->json(['message'=> 'Data berhasil ditambahkan ke keranjang!','data'=>$cart],200);
    }

    /**
     * Method untuk memperbarui data keranjang
     */
    public function update(Request $request)
    {
        if(!$request->post('cart_id') || !$request->post('amount')){
            return response()->json(['message'=>'Data tidak valid!'],400);
        }
        $cart_id = $request->post('cart_id');
        $amount = $request->post('amount');

        $cart = Cart::find($cart_id);
        $item = Item::find($cart->item_id);

        if($amount > $item->stok){
            return response()->json(['message'=> 'Jumlah melebihi batas stok!','data'=>$cart],200);
        }

        $cart->update([
            'amount' => $amount,
            'updated_at' => now(),
        ]);
        return response()->json(['message'=>'Data berhasil diupdate!','data'=>$cart],200);
    }

    /**
     * Method untuk menghapus data keranjang
     */
    public function delete(Request $request)
    {
        if(!$request->post('cart_id')){
            return response()->json(['message'=>'Data tidak valid!'],400);
        }
        $cart_id = $request->post('cart_id');

        $cart = Cart::find($cart_id)->delete();
        
        return response()->json(['message'=>'Data berhasil dihapus!','data'=>$cart],200);
    }
}
