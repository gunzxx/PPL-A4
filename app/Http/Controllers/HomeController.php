<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function showHome()
    {
        // $partners = Partner_detail::with(['partner'])->where(['is_approved' => 0])->paginate(10);
        $partners = Partner::where(['is_active'=>true])->with(['pengelola'])->orderBy('updated_at')->paginate(10);
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
