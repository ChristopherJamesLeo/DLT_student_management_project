<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Warehouse;
use App\Http\Resources\WarehousesCollection;
use App\Http\Resources\WarehousesResource;

class WarehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // method 1 (from collection)
        // return new WarehousesCollection(Warehouse::all());
        // WarehousesCollection ထဲသို့ Warehouse model တစ်ခုလံုးထည့်ပေးလိုက်သည် ထို့ေကြာင့် warehousecollection ထဲတွင် model မှ data asset ရပြီး api ထုတ်ပေးမ် 

        // method 2 (not use collection)
        $warehouses = Warehouse::paginate(3); // paginate ပေးပါက web controller ထဲတွင်ပါ paginate ထည့်ပေးရမည်

        return WarehousesResource::collection($warehouses);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate ($request , [
            "name" => "required|unique:warehouses,name",
            "status_id" => "required",
            "user_id" => "required"
        ]);

        // API ဖြင့်ခေါ်ထားသောကြောင့် Auth ကို သံုးမရပေ  ထို့ကြောင့် front end မှသာ ပို့ပေးရမည်ဖြစ်သည်
        // $user = Auth::user();
        // $user_id = $user["id"];

        $warehouse = new Warehouse();

        $warehouse -> name = $request["name"];
        $warehouse -> slug = Str::slug($request["name"]);
        $warehouse -> status_id = $request["status_id"];
        $warehouse -> user_id = $request["user_id"];

        $warehouse -> save();

        return new WarehousesResource($warehouse);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate ($request , [
            "name" => "required|unique:warehouses,name,".$id,
            "status_id" => "required",
            "user_id" => "required"
        ]);

        // API ဖြင့်ခေါ်ထားသောကြောင့် Auth ကို သံုးမရပေ  ထို့ကြောင့် front end မှသာ ပို့ပေးရမည်ဖြစ်သည်
        // $user = Auth::user();
        // $user_id = $user["id"];

        $warehouse = Warehouse::findOrFail($id);

        $warehouse -> name = $request["name"];
        $warehouse -> slug = Str::slug($request["name"]);
        $warehouse -> status_id = $request["status_id"];
        $warehouse -> user_id = $request["user_id"];

        $warehouse -> save();

        return new WarehousesResources($warehouse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse -> delete();

        return new WarehousesResource($warehouse); // collection မလိုသောကြောင့် new ဖြင့် ခေါ်ပေးရမည်
    }

    public function warehousesstatus(Request $request){
        // return response()->json(["success" => "Status Change Successful"]);

        $warehouse = Warehouse::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည် 

        // dd("hello");

        $warehouse -> status_id = $request["status_id"];

        $warehouse -> save();

        // success ဖြစ်ပါက response ပြန်ရန်
        return new WarehousesResource($warehouse);
    }
}
