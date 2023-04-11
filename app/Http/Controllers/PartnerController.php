<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return view('partners.index',[
            "css"=> ['main', 'partners/partners'],
            'partners' => [],
        ]);
    }

    public function create()
    {
        return view('partners.create',[
            "css"=> ['main','partners/create']
        ]);
    }
}
