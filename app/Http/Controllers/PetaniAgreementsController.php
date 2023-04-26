<?php

namespace App\Http\Controllers;

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
}
