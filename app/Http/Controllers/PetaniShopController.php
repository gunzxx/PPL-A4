<?php

namespace App\Http\Controllers;

use App\Models\AgreementDetail;
use App\Models\Item;
use Illuminate\Http\Request;

class PetaniShopController extends Controller
{
    /**
     * Method untuk menampilkan view penjualan
     */
    public function index()
    {
        $items = Item::where(['petani_id'=>auth()->user()->id])->with(['media','agreementDetail','inventory'])->orderBy('updated_at',"DESC")->paginate(10);
        
        return view('shop.petani.shop.index', [
            "css" => ['shop/shop'],
            "active" => "shop",
            'items' => $items,
        ]);
    }

    /**
     * Method untuk menampilkan view tambah penjualan
     */
    public function create()
    {
        $agreement_details = AgreementDetail::where(['petani_id' => auth()->user()->id,'status'=>'accept','is_active'=>true])->with(['petani','agreement'])->get();

        if(!$agreement_details || $agreement_details->count()<1){
            return redirect('/petani/shop/shop')->with('error',"Persetujuan masih kosong!");
        }
        return view('shop.petani.shop.create', [
            "css" => ['shop/form'],
            "active" => "shop",
            'agreement_details' => $agreement_details,
        ]);
    }

    /**
     * Method untuk menyimpan data tambah penjualan
     */
    public function store(Request $request)
    {
        $cekItem = Item::where([
            'agreement_detail_id'=>$request->post('agreement_detail_id'),
            'petani_id' => auth()->user()->id,
        ])->get();
        if($cekItem->count()>0){
            return back()->with('error','Persetujuan sudah dijual!')->withInput();
        }

        $validated = $request->validate([
            'bean_type'=>'required',
            'stok'=>'required|numeric',
            'price'=>'required|numeric',
            'no_rek'=>'required|max:16',
            'agreement_detail_id'=>'required',
        ],[
            'no_rek' => [
                'max'=>'Maksimal 16 digit'
            ]
        ]);
        $validated['petani_id']=auth()->user()->id;
        
        $agreement_details = AgreementDetail::find($request->post('agreement_detail_id'));
        $pengelolaId = $agreement_details->pengelola->id;
        $validated['pengelola_id']= $pengelolaId;

        $request->validate([
            'product_img'=>'image',
        ]);

        $item = Item::create($validated);
        if($request->file('product_img')){
            $item->addMediaFromRequest("product_img")->toMediaCollection('product');
        }

        return redirect('/petani/shop/shop')->with("success",'Data berhasil ditambahkan');
    }

    /**
     * Method untuk menampilkan view edit penjualan
     */
    public function edit(Item $item)
    {
        if($item->petani_id != auth()->user()->id){
            return abort(403);
        }
        return view('shop.petani.shop.edit', [
            "css" => ['shop/form'],
            "active" => "shop",
            'item'=>$item,
        ]);
    }

    /**
     * Method untuk memperbarui data penjualan
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'stok' => 'required|numeric',
            'price' => 'required|numeric',
            'no_rek' => 'required|numeric',
        ]);

        if ($request->file('product_img')) {
            $request->validate([
                'product_img' => 'image',
            ]);
        }
        
        $item_id = $request->post('item_id');
        $validated['updated_at']=now();

        $item = Item::find($item_id)->update($validated);
        $item = Item::find($item_id);
        if ($request->file('product_img')) {
            $item->addMediaFromRequest("product_img")->toMediaCollection('product');
        }

        return redirect('/petani/shop/shop')->with("success", 'Data berhasil diupdate!');
    }

    /**
     * Method untuk menghapus data penjualan
     */
    public function delete(Request $request)
    {
        if(!$request->post("item_id")){
            return response()->json(['message'=>'Data tidak lengkap!'],401);
        }
        $item_id = $request->post("item_id");
        Item::find($item_id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!'], 200);
    }
}
