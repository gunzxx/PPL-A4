<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Partner;
use App\Models\Inventory;
use App\Models\OfferDetail;
use Illuminate\Http\Request;

class PengelolaOfferController extends Controller
{
    public function showOffers()
    {
        $details = OfferDetail::with([
            'offer' => function ($query) {
                $query->with(['petani', 'inventory']);
            }
        ])->where(['is_approved' => 0])->paginate(10);

        return view('partners.pengelola.offers.index', [
            "css" => ['main', 'partners/partners', 'partners/offers/index'],
            'details' => $details,
        ]);
    }
}
