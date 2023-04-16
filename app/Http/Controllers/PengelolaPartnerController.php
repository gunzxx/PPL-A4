<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Inventory;
use Illuminate\Http\Request;

class PengelolaPartnerController extends Controller
{
    public function showPartner()
    {
        $partners = Partner::with(['pengelola'])->where(['pengelola_id'=>auth()->user()->id])->paginate(10);

        return view('partners.pengelola.partners.index',[
            // "active" => 'home',
            "css"=> ['main', 'partners/partners'],
            'partners' => $partners,
        ]);
    }

    public function create()
    {
        $inventories = Inventory::where(['user_id' => auth()->user()->id])->get();
        return view('partners.pengelola.partners.create',[
            "css"=> ['main','partners/create'],
            "inventories"=> $inventories,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:10000',
            'stok' => 'required|numeric',
            'price' => 'required|numeric|min:1000',
            'bean_id' => 'required',
        ]);

        $validated['pengelola_id'] = auth()->user()->id;

        Partner::create($validated);
        return redirect('/pengelola/partners/partners')->with('sukses', 'Data berhasil ditambahkan!');
    }

    public function edit(Partner $partner)
    {
        if ($partner->pengelola_id != auth()->user()->id) {
            return abort(403);
        }
        $inventories = Inventory::where(['user_id' => auth()->user()->id])->get();
        return view('partners.pengelola.partners.edit',[
            "css"=> ['main','partners/create'],
            'partner' => $partner,
            'inventories' => $inventories,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:10000',
            'stok' => 'required|numeric',
            'price' => 'required|numeric|min:1000',
            'bean_id' => 'required',
        ]);

        $validated['updated_at'] = date("Y-m-d H-i-s", time());

        $id = $request->only('partner_id');
        Partner::where('id', $id)->update($validated);

        return redirect('/pengelola/partners')->with('sukses', 'Data berhasil diedit!');
    }

    public function delete(Request $request)
    {
        if(!$request->post('id')){
            return response()->json([
                'message'=>"Id not found",
            ],401);
        }
        if(auth()->check()=='false'){
            return response()->json([
                'message'=>"Please login!",
            ],403);
        }
        $id = $request->post('id');

        Partner::find($id)->delete();
        return response()->json(['id'=>$id, 'message' => 'Data berhasil dihapus'], 200);
    }
}
