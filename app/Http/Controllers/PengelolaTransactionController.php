<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PengelolaTransactionController extends Controller
{
    /**
     * Method untuk menambahkan data transaksi dan pembayaran
     */
    public function add(Request $request)
    {
        if (!$request->post('cart_id') || !$request->post('item_id')) {
            return response()->json(['message' => "Data tidak valid!"], 404);
        }
        $cart_id = $request->post('cart_id');
        $item_id = $request->post('item_id');

        $cart = Cart::find($cart_id);
        $item = Item::find($item_id);
        if (!$cart || !$item) {
            return response()->json(['message'=>"Data tidak ditemukan!"], 404);
        }

        $transaction = Transaction::create([
            'bean_type' => $item->bean_type,
            'price' => $item->price,
            'amount' => $cart->amount,
            'total_cost' => ((int)$cart->amount * (int)$item->price),
            'address' => User::find($item->pengelola_id, ['address'])->address,
            'item_id' => $item_id,
            'inventory_id' => $item->agreementDetail->offerDetail->offer->inventory->id,
            'petani_id' => $item->petani_id,
            'pengelola_id' => $item->pengelola_id,
        ]);

        Payment::create([
            "transaction_id" => $transaction->id,
            'petani_id' => $item->petani_id,
            'pengelola_id' => $item->pengelola_id,
        ]);

        $stok = (int)$item->stok - (int)$cart->amount;
        $item->update([
            'stok' => $stok,
        ]);

        $cart->delete();

        return response()->json(["message" => "Barang berhasil dibeli"], 200);
    }

    /**
     * Method untuk membatalkan transaksi
     */
    public function cancel(Request $request)
    {
        if (!$request->post('payment_id')) {
            return response()->json(['message' => "Data tidak valid!"], 400);
        }
        $payment_id = $request->post('payment_id');
        $payment = Payment::find($payment_id);

        if(!$payment){
            return response()->json(['message'=>"Data tidak valid"], 400);
        }

        $transaction = $payment->transaction;
        $transaction->update([
            'status'=>'cancel',
            'is_active'=>false,
        ]);

        $item = $transaction->item;
        $stok = (int)$item->stok + (int)$transaction->amount;
        $item->update([
            'stok'=>$stok,
        ]);

        $payment->delete();

        return response()->json(['message'=>"Data berhasil dibatalkan!"], 200);
    }
}
