<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.home', [
            "css" => ['main']
        ]);
    }

    public function partner()
    {
        return view('partners.home', [
            "css" => ['main']
        ]);
    }

    public function shop()
    {
        return view('shop.home', [
            "css" => ['main']
        ]);
    }
}
