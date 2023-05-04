<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Agreement;
use App\Models\OfferDetail;
use Illuminate\Http\Request;
use App\Models\AgreementDetail;

class PengelolaAgreementsController extends Controller
{
    /**
     * Method untuk menampilkan view persetujuan
     */
    public function showAgreements()
    {
        $agreement_details = AgreementDetail::with(['agreement','pengelola','petani',
            "offerDetail"=>function($query){
                $query->with('offer');
            }
        ])->where(['pengelola_id'=>auth()->user()->id])->latest()->paginate(10);
        return view("partners.pengelola.agreements.index",[
            'css'=>['main', 'partners/partners','partners/agreements/index'],
            'agreement_details' => $agreement_details
        ]);
    }

    /**
     * Method untuk menampilkan view tambah persetujuan
     */
    public function createAgreements()
    {
        $partners= Partner::where(["pengelola_id" => auth()->user()->id])->get();
        $partner_id = [];
        foreach($partners as $partner){
            $partner_id[] = $partner->id;
        }
        $offer_details = OfferDetail::where(['is_approved' => 1])->whereIn("partner_id", $partner_id)->with('offer')->get();
        if($offer_details->count()<1){
            return redirect()->back()->withErrors(["message"=>"Belum ada penawaran,\ntidak bisa membuat persetujuan!"])->withInput();
        }
        return view("partners.pengelola.agreements.create",[
            'css'=>['main', 'partners/partners','partners/agreements/create'],
            'offer_details' => $offer_details,
        ]);
    }

    /**
     * Method untuk menyimpan data tambah persetujuan
     */
    public function saveAgreements(Request $request)
    {
        $validated = $request->validate([
            'bean_type'=>'required|max:255',
            "stok"=>"required|numeric",
            "price"=>"required|numeric|min:1000",
        ],[
            "price.min"=>"Harga minimal 1000"
        ]);
        $request->validate(['offer_detail_id' => 'required']);
        
        $offer_detail_id = $request->post('offer_detail_id');
        $offer_detail = OfferDetail::find($offer_detail_id);
        $petani_id = $offer_detail->offer->petani->id;
        $validated['pengelola_id'] = auth()->user()->id;

        $cekDetail = AgreementDetail::where(['pengelola_id'=> auth()->user()->id, "offer_detail_id" => $offer_detail_id])->get();
        
        if($cekDetail->count()>0){
            return redirect()->back()->withErrors(["message"=>"Penawaran sudah pernah dimintai persetujuan,\nPilih penawaran lain!"])->withInput();
        }
        
        $agreement = Agreement::create($validated);
        AgreementDetail::create([
            "agreement_id" => $agreement->id,
            "offer_detail_id" => $offer_detail_id,
            'pengelola_id' => $validated['pengelola_id'],
            'petani_id' => $petani_id,
        ]);
        return redirect(auth()->user()->getRoleNames()[0] . '/partners/agreements')->with('success', 'Data berhasil dikirim!');
    }

    /**
     * Method untuk menampilkan view edit persetujuan
     */
    public function editAgreements($agreementDetailId)
    {
        $agreement_detail = AgreementDetail::with(['agreement',"offerDetail"])->find($agreementDetailId);
        $partners = Partner::where(["pengelola_id" => auth()->user()->id])->get();
        $partner_id = [];
        foreach ($partners as $partner) {
            $partner_id[] = $partner->id;
        }
        $offer_details = OfferDetail::where(['is_approved' => 1])->whereIn("partner_id", $partner_id)->with('offer')->get();
        return view("partners.pengelola.agreements.edit", [
            'css' => ['main', 'partners/partners', 'partners/agreements/create'],
            "agreement_detail" => $agreement_detail,
            'offer_details' => $offer_details
        ]);
    }

    /**
     * Method untuk memperbarui data persetujuan
     */
    public function updateAgreements(Request $request)
    {
        $validated = $request->validate([
            'bean_type' => 'required|max:255',
            "stok" => "required|numeric",
            "price" => "required|numeric|min:1000",
        ], [
            "price.min" => "Harga minimal 1000"
        ]);
        $validated['updated_at']=now();
        $request->validate(['offer_detail_id' => 'required']);
        
        $agreement_id = $request->post('agreement_id');
        
        $agreement_detail_id = $request->post('agreement_detail_id');

        AgreementDetail::where(["id"=> $agreement_detail_id])->update(['updated_at'=>now()]);
        Agreement::where(["id"=> $agreement_id])->update($validated);
        
        return redirect(auth()->user()->getRoleNames()[0] . '/partners/agreements')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Method untuk membatalkan data persetujuan
     */
    public function cancelAgreements(Request $request)
    {
        $agreementId = $request->post("agreementId");
        if (!$agreementId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        Agreement::find($agreementId)->delete();

        return response()->json(["message" => "Persetujuan berhasil dibatalkan."], 200);
    }

    /**
     * Method untuk menghapus data persetujuan
     */
    public function deleteAgreements(Request $request)
    {
        $agreementId = $request->post("agreementId");
        if (!$agreementId) {
            return response()->json(["message" => "Data tidak lengkap!"], 401);
        }
        Agreement::find($agreementId)->delete();

        return response()->json(["message" => "Data berhasil dihapus"], 200);
    }
}
