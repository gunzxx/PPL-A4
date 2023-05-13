<?php

namespace App\Http\Controllers;

use App\Models\PartnerHistory;
use Illuminate\Http\Request;

class PengelolaPartnerHistoryController extends Controller
{
    /**
     * Method untuk menampilkan view riwayat
     */
    public function index()
    {
        $partnerHistories = PartnerHistory::latest()->paginate(10);

        return view("partners.pengelola.history.index",[
            "css"=> [ 'partners/partners','partners/history/index'],
            'partnerHistories' => $partnerHistories,
            'search'=>request()->get('search'),
        ]);
    }
}
