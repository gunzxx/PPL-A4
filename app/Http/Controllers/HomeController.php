<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Method untuk menampilkan view home
     */
    public function showHome()
    {
        $partners = Partner::where(['is_active'=>true,'is_open'=>true])->with([
            'pengelola',
            // 'offerDetail'=>function($query){
            //     $query->where('status','!=','accept');
            // },
        ])->orderBy('updated_at','DESC')->paginate(10);
        return view('home.home', [
            "css" => ['partners/partners','home/style'],
            "partners" => $partners
        ]);
    }
}
