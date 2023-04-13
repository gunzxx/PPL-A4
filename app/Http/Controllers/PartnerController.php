<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function showPartner()
    {
        $partners = Partner::with(['user'])->where(['user_id'=>auth()->user()->id])->paginate(10);

        return view('partners.index',[
            "css"=> ['main', 'partners/partners'],
            "actives" => 'home',
            'partners' => $partners,
        ]);
    }

    public function create()
    {
        return view('partners.create',[
            "active" => 'home',
            "css"=> ['main','partners/create']
        ]);
    }
    
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|min:1000|numeric',
            'alamat' => 'required',
        ], [
            'harga.min' => 'Harga minimal 1000',
        ]);
        $validate['user_id'] = auth()->user()->id;

        Partner::create($validate);
        // dd($validate);
        return redirect('/partners')->with('sukses', 'Data berhasil ditambahkan!');
    }

    public function edit(Partner $partner)
    {
        if ($partner->user_id != auth()->user()->id) {
            return abort(403);
        }
        return view('partners.edit',[
            "active" => 'home',
            "css"=> ['main','partners/create'],
            'partner' => $partner
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:10000',
            'stok' => 'required|numeric',
            'harga' => 'required|min:1000|numeric',
            'alamat' => 'required',
        ],[
            'harga.min'=>'Harga minimal 1000',
        ]);

        $validated['updated_at'] = date("Y-m-d H-i-s", time());

        $id = $request->only('partner_id');
        Partner::where('id', $id)->update($validated);

        return redirect('/partners')->with('sukses', 'Data berhasil diedit!');
    }

    public function delete(Request $request)
    {
        if(!$request->post('id')){
            return response()->json([
                'message'=>"Id not found",
            ],401);
        }
        $id = $request->post('id');

        Partner::find($id)->delete();
        return response()->json(['id'=>$id, 'message' => 'Data berhasil dihapus'], 200);
    }
}
