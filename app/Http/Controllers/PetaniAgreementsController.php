<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use App\Models\AgreementDetail;

class PetaniAgreementsController extends Controller
{
    /**
     * Method untuk menampilkan view persetujuan
     */
    public function showAgreements()
    {
        $agreement_details = AgreementDetail::where(["is_active" => true])
        ->where(['petani_id' => auth()->user()->id,'is_active'=>true])->where(function($query){
            $query->where('status','=','accept')->orWhere('status','=','waiting');
        })->with([
            'agreement', 'pengelola', 'petani',
            "offerDetail" => function ($query) {
                $query->with('offer');
            }
        ])->latest()->paginate(10);
        return view("partners.petani.agreements.index", [
            'css'=>[ 'partners/partners','partners/agreements/index'],
            'agreement_details' => $agreement_details,
            'search'=>request()->get('search'),
        ]);
    }

    /**
     * Method untuk membatalkan persetujuan
     */
    public function cancelAgreements(Request $request)
    {
        $agreementId = $request->post("agreementId");
        if (!$agreementId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        Agreement::find($agreementId)->delete();

        return response()->json(["message" => "Data berhasil dihapus"], 200);
    }

    /**
     * Method untuk menolak persetujuan
     */
    public function rejectAgreements(Request $request)
    {
        $agreementDetailId = $request->post("agreementDetailId");
        if (!$agreementDetailId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        AgreementDetail::find($agreementDetailId)->update(['status'=>"reject"]);

        return response()->json(["message" => "Persetujuan berhasil ditolak."], 200);
    }

    /**
     * Method untuk menerima persetujuan
     */
    public function confirmAgreements(Request $request)
    {
        $agreementDetailId = $request->post("agreementDetailId");
        if (!$agreementDetailId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        AgreementDetail::where(["id" => $agreementDetailId])->update([
            "status" => "accept",
        ]);

        return response()->json(["message" => "Data berhasil diterima."], 200);
    }
}
