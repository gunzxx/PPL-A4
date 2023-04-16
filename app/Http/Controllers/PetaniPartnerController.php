<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\PartnerDetail;
use Illuminate\Http\Request;

class PetaniPartnerController extends Controller
{
    // Halaman kerja sama
    public function showPartner()
    {
        $details = PartnerDetail::with(['partner'])->where(['is_approved' => 0])->paginate(10);

        return view('partners.petani.partners.index', [
            "css" => ['main', 'partners/partners'],
            'details' => $details,
        ]);
    }

    public function detailPartner(Partner $partner)
    {
        dd($partner);
    }


    // Halaman penawaran
    public function showOffers()
    {
        $details = PartnerDetail::with(['partner'])->where(['is_approved' => 0])->paginate(10);

        return view('partners.petani.offers.offers', [
            "css" => ['main', 'partners/partners'],
            'details' => $details,
        ]);
    }

    public function createOffers(Partner $partner)
    {
        $inventories = Inventory::where(['user_id'=>auth()->user()->id])->get();
        // dd($inventories->count());
        return view('partners.petani.offers.createOffers', [
            "css" => ['main', 'partners/partners',"partners/offers/create"],
            'partner'=>$partner,
            'inventories'=>$inventories,
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

        $offer = Offer::create($validated);
        PartnerDetail::create([
            'partner_id' => $partner_id,
            "offer_id" => $offer->id,
        ]);

        return redirect(auth()->user()->getRoleNames()[0] . '/partners')->with('sukses', 'Data has been added');
    }

    // Halaman persetujuan
    public function showAgreements()
    {
        $details = PartnerDetail::with(['partner'])->where(['is_approved' => 0])->paginate(10);

        return view('partners.petani.agreements.index', [
            "css" => ['main', 'partners/partners',"partners/agreement"],
            'details' => $details,
        ]);
    }
}
