<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Partner;
use App\Models\OfferDetail;
use Illuminate\Http\Request;
use App\Models\PartnerHistory;

class PengelolaPartnerController extends Controller
{
    public function showPartner()
    {
        $partners = Partner::with(['pengelola'])->where(['pengelola_id'=>auth()->user()->id])->latest()->paginate(10);

        return view('partners.pengelola.partners.index',[
            "css"=> ['main', 'partners/partners','partners/offers/index'],
            'partners' => $partners,
        ]);
    }

    public function create()
    {
        return view('partners.pengelola.partners.create',[
            "css"=> ['main','partners/create'],
        ]);
    }
    
    public function store(Request $request)
    {
        $messages = array(
            'required' => 'Data tidak valid!',
        );
        
        $request->validate([
            'address' => 'required',
        ]);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:10000',
            'stok' => 'required|numeric',
            'price' => 'required|numeric|min:1000',
            'bean_type' => 'required',
        ]);

        $validated['pengelola_id'] = auth()->user()->id;

        Partner::create($validated);
        return redirect('/pengelola/partners/partners')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($partner_id)
    {
        $partner = Partner::where(['id'=> $partner_id,'is_active'=>1])->get()->first();
        if(!$partner){
            return back();
        }
        if ($partner->pengelola_id != auth()->user()->id) {
            return abort(403);
        }
        return view('partners.pengelola.partners.edit',[
            "css"=> ['main','partners/create'],
            'partner' => $partner,
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
            'bean_type' => 'required',
        ]);

        $validated['updated_at'] = date("Y-m-d H-i-s", time());

        $id = $request->only('partner_id');
        Partner::where('id', $id)->update($validated);

        return redirect('/pengelola/partners')->with('sukses', 'Data berhasil diedit!')->with(['success', 'Data berhasil diperbarui!']);
    }

    public function stop(Request $request)
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

        $partner = Partner::where('id', $id)->update(['is_active'=>false]);

        $offer_detail = OfferDetail::where(["partner_id"=>$id])->get()->first();
        OfferDetail::where(["partner_id"=>$id])->delete();
        Offer::find($offer_detail->offer_id)->delete();

        return response()->json(['id'=>$id, 'message' => 'Kerja sama berhasil diberhentikan!','data'=>$partner], 200);
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

        $partner = Partner::where('id', $id)->get(["name", "description", 'stok', 'price', 'bean_type', 'pengelola_id','created_at'])->first();
        $partnerHistory = PartnerHistory::create([
            'name' => $partner->name,
            'description' => $partner->description,
            'stok' => $partner->stok,
            'price' => $partner->price,
            'bean_type' => $partner->bean_type,
            'pengelola_id' => $partner->pengelola_id,
            'created_at' => $partner->created_at,
        ]);
        Partner::find($id)->delete();

        return response()->json(['id'=>$id, 'message' => 'Kerja sama berhasil dihapus','data'=>$partnerHistory], 200);
    }
}
