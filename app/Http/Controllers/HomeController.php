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
        $partners = Partner::where(['is_active'=>true])->with(['pengelola'])->orderBy('updated_at','DESC')->paginate(10);
        return view('home.home', [
            "css" => ['main','partners/partners','home/style'],
            "partners" => $partners
        ]);
    }

    public function pengelola()
    {
        return view('home.pengelola.home', [
            "css" => ['main']
        ]);
    }

    public function petani()
    {
        return view('home.petani.home', [
            "css" => ['main']
        ]);
    }

}
