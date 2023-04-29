<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferDetail;
use Illuminate\Http\Request;

class PengelolaOfferController extends Controller
{
    public function showOffers()
    {
        $details = OfferDetail::where(["pengelola_id"=>auth()->user()->id])->with([
            'offer' => function ($query) {
                $query->with(['petani', 'inventory']);
            }
        ])->latest()->paginate(10);

        return view('partners.pengelola.offers.index', [
            "css" => ['main', 'partners/partners', 'partners/offers/index'],
            'details' => $details,
        ]);
    }

    public function confirmOffers(Request $request)
    {
        if($request->method() != "POST"){
            return response()->json(['message'=>"Method not allow!"],401);
        }
        if(!$request->post("detail_id") || !$request->post("offer_id")){
            return response()->json(["message" => "Data tidak lengkap"], 403);
        }
        $detail_id = $request->post('detail_id');
        $offer_id = $request->post('offer_id');
        OfferDetail::where([
            "id" => $detail_id,
            "offer_id" => $offer_id,
        ])->update([
            "is_approved"=>1,
        ]);
        return response()->json(["message"=>"Anda berhasil menerima penawaran petani!"],200);
    }

    public function cancelOffers(Request $request)
    {
        if($request->method() != "POST"){
            return response()->json(['message'=>"Method not allow!"],401);
        }
        if(!$request->post("detail_id") || !$request->post("offer_id")){
            return response()->json(["message" => "Data tidak lengkap"], 403);
        }
        $detail_id = $request->post('detail_id');
        $offer_id = $request->post('offer_id');
        OfferDetail::where([
            "id" => $detail_id,
            "offer_id" => $offer_id,
        ])->update([
            "is_rejected"=>1,
        ]);
        Offer::find($offer_id)->delete();
        return response()->json(["message"=>"Data berhasil dihapus"],200);
    }

    public function rejectOffers(Request $request)
    {
        if($request->method() != "POST"){
            return response()->json(['message'=>"Method not allow!"],401);
        }
        if(!$request->post("detail_id") || !$request->post("offer_id")){
            return response()->json(["message" => "Data tidak lengkap"], 403);
        }
        $detail_id = $request->post('detail_id');
        $offer_id = $request->post('offer_id');
        OfferDetail::where([
            "id" => $detail_id,
            "offer_id" => $offer_id,
        ])->update([
            "is_rejected"=>1,
        ]);
        Offer::find($offer_id)->delete();
        return response()->json(["message"=>"Penawaran berhasil ditolak"],200);
    }
}
