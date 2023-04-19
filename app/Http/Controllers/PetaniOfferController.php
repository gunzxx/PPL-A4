<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Partner;
use App\Models\Inventory;
use App\Models\OfferDetail;
use Illuminate\Http\Request;

class PetaniOfferController extends Controller
{
    // Halaman penawaran
    public function showOffers()
    {
        $details = OfferDetail::where(['petani_id'=>auth()->user()->id])->with([
            'petani','pengelola',
            'offer'=>function($query){
                $query->with(['petani','inventory']);
            },
        ])->latest()->paginate(10);

        return view('partners.petani.offers.index', [
            "css" => ['main', 'partners/partners', 'partners/offers/index'],
            'details' => $details,
        ]);
    }

    public function createOffers(Partner $partner)
    {
        $cekpartner = OfferDetail::where([
            'partner_id' => $partner->id, 
            "petani_id" => auth()->user()->id,
        ])->get();
        if ($cekpartner->count() > 0) {
            return redirect()->back()->with(['duplicate' => 'Kerja sama sudah pernah ditawar, silahkan cek penawaran anda!']);
        }

        $inventories = Inventory::where(['user_id' => auth()->user()->id])->get();

        return view('partners.petani.offers.createOffers', [
            "css" => ['main', 'partners/partners', "partners/offers/create"],
            'partner' => $partner,
            'inventories' => $inventories,
        ]);
    }

    public function saveOffers(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            'description' => 'required|max:10000',
            "stok" => "required|numeric",
            "price" => "required|numeric",
            "bean_id" => "required",
        ]);
        $validated['petani_id'] = auth()->user()->id;
        $partner_id = $request->post('partner_id');
        $partner = Partner::find($partner_id);
        $pengelola_id = $partner->pengelola_id;

        $cekpartner = OfferDetail::where([
            'partner_id' => $partner_id,
            "petani_id" => auth()->user()->id,
            'is_rejected' => 0,
            'is_approved' => 0,
        ])->get();
        if ($cekpartner->count() > 0) {
            return redirect()->back()->withErrors(['duplicate' => 'Kerja sama sudah pernah ditawar'])->withInput();
        }

        $offer = Offer::create($validated);

        OfferDetail::create([
            'partner_id' => $partner_id,
            "offer_id" => $offer->id,
            "petani_id" => auth()->user()->id,
            "pengelola_id" => $pengelola_id,
        ]);

        return redirect(auth()->user()->getRoleNames()[0] . '/partners/offers');
    }

    public function editOffers($detail_id)
    {
        $detail = OfferDetail::where(['id'=>$detail_id,'is_approved'=>0,'is_rejected'=>0])->with(['partner','offer'])->get();
        if($detail->count()<1){
            return redirect()->back()->withErrors(["message"=>"Data tidak ditemukan"]);
        }
        $detail = $detail->first();
        $inventories = Inventory::where(['user_id' => auth()->user()->id])->get();

        return view('partners.petani.offers.editOffers', [
            "css" => ['main', 'partners/partners', "partners/offers/create"],
            'detail' => $detail,
            'inventories' => $inventories,
        ]);
    }

    public function updateOffers(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            'description' => 'required|max:10000',
            "stok" => "required|numeric",
            "price" => "required|numeric",
            "bean_id" => "required",
        ]);
        $offer_id = $request->post('offer_id');

        Offer::where(['id'=>$offer_id])->update($validated);

        return redirect(auth()->user()->getRoleNames()[0] . '/partners/offers');
    }

    public function cancelOffers(Request $request)
    {
        if (!$request->post()) {
            return response()->json(["message" => "method not allowed"], 401);
        }
        if (!$request->post('offer_id') || !$request->post('detail_id')) {
            return response()->json(["message" => "Data tidak lengkap"], 403);
        }
        $detail_id = $request->post('detail_id');
        $offer_id = $request->post('offer_id');
        OfferDetail::find($detail_id)->delete();
        Offer::find($offer_id)->delete();
        return response()->json(["message" => "Penawaran berhasil dihapus"], 200);
    }
}
