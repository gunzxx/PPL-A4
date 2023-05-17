<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Partner;
use App\Models\Inventory;
use App\Models\OfferDetail;
use Illuminate\Http\Request;

class PetaniOfferController extends Controller
{
    /**
     * Method untuk menampilkan view penawaran
     */
    public function showOffers()
    {
        $details = OfferDetail::where(['petani_id'=>auth()->user()->id])->with([
            'petani'=>function($query){
                $query->with(['media']);
            },
            'pengelola',
            'partner',
            'offer'=>function($query){
                $query->with([
                    'petani'=>function($query){
                        $query->with(['media']);
                    },
                    'inventory',
                    // 'inventory'=>function($query){
                    //     $query->with([

                    //     ]);
                    // },
                ]);
            },
        ])->orderBy('updated_at','DESC')->paginate(10);

        return view('partners.petani.offers.index', [
            "css" => [ 'partners/partners', 'partners/offers/index'],
            'details' => $details,
            'search'=>request()->get('search'),
        ]);
    }

    /**
     * Method untuk menampilkan view tambah penawaran
     */
    public function createOffers($partner_id)
    {
        $partner = Partner::where(['id'=>$partner_id,'is_active'=>true,'is_open'=>true])->get()->first();
        if (!$partner) {
            return back()->with(['error' => 'Kerja sama tidak ditemukan!'])->withInput();
        }
        $cekpartner = OfferDetail::where([
            'partner_id' => $partner->id,
            "petani_id" => auth()->user()->id,
        ])
        ->where(function($query){
            $query->where(['status'=>'waiting'])->orWhere(['status'=>'accept']);
        })
        ->get();
        if ($cekpartner->count() > 0) {
            return back()->with(['error' => 'Kerja sama sudah pernah ditawar, silahkan cek penawaran anda pada menu kerja sama.']);
        }

        $inventories = Inventory::where(['user_id' => auth()->user()->id])->get();

        return view('partners.petani.offers.createOffers', [
            "css" => [ 'partners/partners', "partners/offers/create"],
            'partner' => $partner,
            'inventories' => $inventories,
        ]);
    }

    /**
     * Method untuk menyimpan data tambah penawaran
     */
    public function saveOffers(Request $request)
    {
        if(!$request->post('bean_id')){
            return back()->with("error","Stok masih kosong")->withInput();
        }

        # inventory
        $inventory = Inventory::find($request->post("bean_id"));

        $validated = $request->validate([
            'description' => 'required|max:10000',
            "stok" => "required|numeric|max:{$inventory->stok}",
            "price" => "required|numeric|min:1000",
            "bean_id" => "required",
        ],[
            'stok.max' => "Stok melebihi batas inventory"
        ]);
        $validated['petani_id'] = auth()->user()->id;

        # partner id
        $partner_id = $request->post('partner_id');
        $pengelola_id = Partner::find($partner_id)->pengelola_id;

        $cekpartner = OfferDetail::where([
            'partner_id' => $partner_id,
            "petani_id" => auth()->user()->id,
        ])
        ->where(function($query){
            $query->where(['status'=>'waiting'])->orWhere(['status'=>'accept']);
        })
        ->get();
        if ($cekpartner->count() > 0) {
            return back()->withErrors(['error' => 'Kerja sama sudah pernah ditawar'])->withInput();
        }

        $offer = Offer::create($validated);

        OfferDetail::create([
            'partner_id' => $partner_id,
            "offer_id" => $offer->id,
            "petani_id" => auth()->user()->id,
            "pengelola_id" => $pengelola_id,
        ]);

        return redirect(auth()->user()->getRoleNames()[0] . '/partners/offers')->with('success','Data berhasil diupload!');
    }

    /**
     * Method untuk view edit penawaran
     */
    public function editOffers($detail_id)
    {
        $detail = OfferDetail::where(['id'=>$detail_id,'status'=>"waiting",'is_active'=>true])->with([
            'partner' => function($query){
                $query->with('pengelola');
            },
            'offer' => function ($query) {
                $query->with('petani');
            },
        ])->get();

        
        if(!$detail){
            return abort(404);
        }
        if($detail->count()<1){
            return abort(404);
        }
        $detail = $detail->first();
        if($detail->petani_id != auth()->user()->id){
            return abort(403);
        }
        $inventories = Inventory::where(['user_id' => auth()->user()->id])->get();

        return view('partners.petani.offers.editOffers', [
            "css" => [ 'partners/partners', "partners/offers/create"],
            'detail' => $detail,
            'inventories' => $inventories,
        ]);
    }

    /**
     * Method untuk memperbarui data penawaran
     */
    public function updateOffers(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|max:10000',
            "stok" => "required|numeric",
            "price" => "required|numeric",
            "bean_id" => "required",
        ]);
        $offer_id = $request->post('offer_id');

        Offer::where(['id'=>$offer_id])->update($validated);

        return redirect(auth()->user()->getRoleNames()[0] . '/partners/offers')->with('success', 'Data berhasil diupdate!');
    }
}
