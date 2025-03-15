<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Warehouse;
use App\Http\Resources\WarehousesCollection;
use App\Http\Resources\WarehousesResource;

class WarehousesController extends Controller  // common controller လှမ်းခေါ်ထားပြီးသာဖြစ်သည် 
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

        $result = WarehousesResource::collection($warehouses);

        // return WarehousesResource::collection($warehouses);

        return $this -> sendRespond($result,"Warehouse Retrived Successfully"); // controller ထဲသို့ ပို့ထားသည့်အတွက်ကြောင့် json data သည် နှစ်ဆင့်ဖြစ်သွားသည် 
       


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this -> validate ($request , [
        //     "name" => "required|unique:warehouses,name",
        //     "status_id" => "required",
        //     "user_id" => "required"
        // ]);

        // API အတွက် validator နှင့်သုံးမှသာ alert ထုတ်ပြန်ရန် အဆင်ပြေမည်  

        $validator = Validator::make($request->all(),[
            "name" => "required|unique:warehouses,name",
            "status_id" => "required",
            "user_id" => "required"
        ]);

        if($validator->fails()){

            return $this -> sendError("Validation Error",$validator->errors());

        }


        // API ဖြင့်ခေါ်ထားသောကြောင့် Auth ကို သံုးမရပေ  ထို့ကြောင့် front end မှသာ ပို့ပေးရမည်ဖြစ်သည်
        // $user = Auth::user();
        // $user_id = $user["id"];

        $warehouse = new Warehouse();

        $warehouse -> name = $request["name"];
        $warehouse -> slug = Str::slug($request["name"]);
        $warehouse -> status_id = $request["status_id"];
        $warehouse -> user_id = $request["user_id"];

        $warehouse -> save();

        // return new WarehousesResource($warehouse);


        return $this -> sendRespond(new WarehousesResource($warehouse),"Warehouse Store Successfully");  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);

        if(is_null($warehouse)){
            return $this -> sendError("Warehouse not found");
        }

        return $this -> sendRespond($warehouse,"Warehouse Retrived Successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate ($request , [
            "name" => "required|unique:warehouses,name".$id,
            "status_id" => "required",
            "user_id" => "required"
        ]);

        // for api  
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:warehouses,name,".$id,
            "status_id" => "required",
            "user_id" => "required"
        ]);

        if($validator->fails()){

            return $this -> sendError("Validation Error",$validator->errors());

        }

        // API ဖြင့်ခေါ်ထားသောကြောင့် Auth ကို သံုးမရပေ  ထို့ကြောင့် front end မှသာ ပို့ပေးရမည်ဖြစ်သည်
        // $user = Auth::user();
        // $user_id = $user["id"];

        $warehouse = Warehouse::findOrFail($id);

        $warehouse -> name = $request["name"];
        $warehouse -> slug = Str::slug($request["name"]);
        $warehouse -> status_id = $request["status_id"];
        $warehouse -> user_id = $request["user_id"];

        $warehouse -> save();

        // return new WarehousesResources($warehouse);

        return $this -> sendRespond(new WarehousesResources($warehouse),"Warehouse Update Successfully"); // for api

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse -> delete();

        // return new WarehousesResource($warehouse); // collection မလိုသောကြောင့် new ဖြင့် ခေါ်ပေးရမည်

        return $this -> sendRespond(new WarehousesResources($warehouse),"Warehouse Delete Successfully"); // for api

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
