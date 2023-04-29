<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use App\Models\AgreementDetail;

class PetaniAgreementsController extends Controller
{
    public function showAgreements()
    {
        $agreement_details = AgreementDetail::with([
            'agreement', 'pengelola','petani',
            "offerDetail" => function ($query) {
                $query->with('offer');
            }
        ])->where(['petani_id' => auth()->user()->id])->latest()->paginate(10);
        return view("partners.petani.agreements.index", [
            'css'=>['main', 'partners/partners','partners/agreements/index'],
            'agreement_details' => $agreement_details
        ]);
    }

    public function cancelAgreements(Request $request)
    {
        $agreementId = $request->post("agreementId");
        if (!$agreementId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        Agreement::find($agreementId)->delete();

        return response()->json(["message" => "Data berhasil dihapus"], 200);
    }

    public function rejectAgreements(Request $request)
    {
        $agreementId = $request->post("agreementId");
        if (!$agreementId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        Agreement::find($agreementId)->delete();

        return response()->json(["message" => "Persetujuan berhasil ditolak."], 200);
    }

    public function confirmAgreements(Request $request)
    {
        $agreementDetailId = $request->post("agreementDetailId");
        if (!$agreementDetailId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        AgreementDetail::where(["id" => $agreementDetailId])->update([
            "is_approved" => 1,
        ]);

        return response()->json(["message" => "Data berhasil diterima."], 200);
    }
}
