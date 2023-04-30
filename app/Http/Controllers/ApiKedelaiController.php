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
        $apiKedelais = ApiKedelai::all()->toArray();
        return response()->json($apiKedelais);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApiKedelai $apiKedelai)
    {
        return response()->json($apiKedelai->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApiKedelai $apiKedelai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiKedelai $apiKedelai)
    {
        //
    }
}
