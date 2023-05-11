<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Partner;
use App\Models\OfferDetail;
use Illuminate\Http\Request;

class PengelolaOfferController extends Controller
{
    /**
     * Method untuk menampilkan view penawaran
     */
    public function showOffers()
    {
        $details = OfferDetail::where(["pengelola_id" => auth()->user()->id])->where(function($query){
            $query
                ->where(["status"=>"waiting"])
                ->orWhere(["status"=>"accept"]);
        })->with([
            'offer' => function ($query) {
                $query->with(['petani', 'inventory']);
            }
        ])->latest()->paginate(10);

        return view('partners.pengelola.offers.index', [
            "css" => ['main', 'partners/partners', 'partners/offers/index'],
            'details' => $details,
        ]);
    }

    /**
     * Method untuk menerima penawaran
     */
    public function confirmOffers(Request $request)
    {
        if(!$request->post("detail_id") || !$request->post("offer_id") || !$request->post("partner_id")){
            return response()->json(["message" => "Data tidak lengkap"], 403);
        }
        $detail_id = $request->post('detail_id');
        $offer_id = $request->post('offer_id');
        $partner_id = $request->post('partner_id');

        OfferDetail::where([
            "id" => $detail_id,
            "offer_id" => $offer_id,
        ])->update([
            "status"=>"accept",
        ]);

        Partner::find($partner_id)->update(['is_open'=>false]);

        OfferDetail::where([
            'partner_id'=> $partner_id,
            "status" => "waiting",
        ])->get()->each->delete();

        return response()->json(["message"=>"Anda berhasil menerima penawaran petani!"],200);
    }

    /**
     * Method untuk membatalkan penawaran
     */
    public function cancelOffers(Request $request)
    {
        if(!$request->post("detail_id") || !$request->post("offer_id")){
            return response()->json(["message" => "Data tidak lengkap"], 403);
        }
        $detail_id = $request->post('detail_id');
        $offer_id = $request->post('offer_id');
        OfferDetail::where([
            "id" => $detail_id,
            "offer_id" => $offer_id,
        ])->update([
            "is_active"=>false,
            "status"=>"deleted",
        ]);
        // Offer::find($offer_id)->delete();
        return response()->json(["message"=>"Data berhasil dihapus"],200);
    }

    /**
     * Method untuk menolak penawaran
     */
    public function rejectOffers(Request $request)
    {
        if(!$request->post("detail_id") || !$request->post("offer_id")){
            return response()->json(["message" => "Data tidak lengkap"], 403);
        }
        $detail_id = $request->post('detail_id');
        $offer_id = $request->post('offer_id');
        OfferDetail::where([
            "id" => $detail_id,
            "offer_id" => $offer_id,
        ])->update([
            "status"=>"reject",
        ]);
        // Offer::find($offer_id)->delete();
        return response()->json(["message"=>"Penawaran berhasil ditolak"],200);
    }


    /**
     * Method untuk mengambil satu data penawaran
     */
    public function single($id)
    {
        $offers = OfferDetail::where(['offer_id'=>$id,'status'=>'accept','is_active'=>true])->get('offer')->first()->offer()->get("bean_id")->first()->inventory()->get("bean_type")->first();
        return response()->json($offers);
    }
}
