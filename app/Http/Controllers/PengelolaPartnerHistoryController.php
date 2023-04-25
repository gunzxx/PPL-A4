<?php

namespace App\Http\Controllers;

use App\Models\PartnerHistory;
use Illuminate\Http\Request;

class PengelolaPartnerHistoryController extends Controller
{
    public function index()
    {
        $partnerHistories = PartnerHistory::latest()->paginate(10);

        return view("partners.pengelola.history.index",[
            "css"=> ['main', 'partners/partners','partners/history/index'],
            'partnerHistories' => $partnerHistories
        ]);
    }
}
