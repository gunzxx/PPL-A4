<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ApiKedelai;
use Illuminate\Http\Request;

class KedelaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!$request->tahun){
            return response()->json([
                'message' => "Data tidak valid."
            ],404);
        }
        $apiKedelais = ApiKedelai::where(['tahun'=>$request->tahun])->get(['id', 'bulan', 'harga'])->toArray();
        return response()->json($apiKedelais);
    }
}
