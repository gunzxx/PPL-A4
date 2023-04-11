<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengelolaHomeController extends Controller
{
    public function index()
    {
        return view('pengelola.home', [
            "css" => ['pengelola']
        ]);
    }

    public function partner()
    {
        return view('pengelola.home', [
            "css" => ['pengelola']
        ]);
    }

    public function shop()
    {
        return view('pengelola.home', [
            "css" => ['pengelola']
        ]);
    }

    public function inventory()
    {
        return view('pengelola.inventory', [
            "css" => ['pengelola']
        ]);
    }
}
