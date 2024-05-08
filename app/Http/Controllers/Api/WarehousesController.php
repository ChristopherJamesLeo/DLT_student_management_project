<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Warehouse;
use App\Http\Resources\WarehousesCollection;

class WarehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new WarehousesCollection(Warehouse::all());
        // WarehousesCollection ထဲသို့ Warehouse model တစ်ခုလံုးထည့်ပေးလိုက်သည် ထို့ေကြာင့် warehousecollection ထဲတွင် model မှ data asset ရပြီး api ထုတ်ပေးမ် 
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
