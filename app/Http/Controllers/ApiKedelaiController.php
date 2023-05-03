<?php

namespace App\Http\Controllers;

use App\Models\ApiKedelai;
use Illuminate\Http\Request;

class ApiKedelaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apiKedelais = ApiKedelai::get(['id','bulan','harga'])->toArray();
        return response()->json($apiKedelais);
    }

    /**
     * Display the specified resource.
     */
    public function show($apiKedelai)
    {
        $apiKedelai = ApiKedelai::find($apiKedelai);
        if(!$apiKedelai){
            return response()->json([]);
        }
        return response()->json($apiKedelai->toArray());
    }
}
