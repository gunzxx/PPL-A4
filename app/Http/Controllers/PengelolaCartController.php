<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengelolaCartController extends Controller
{
    public function add(Request $request)
    {
        if(!$request->post('item_id')){
            return response()->json(['message'=>'Data tidak lengkap!'],401);
        }
        return response()->json(['message'=>'Data lengkap'],200);
    }
}
