<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Township;
use App\Http\Resources\TownshipsResource;

class TownshipController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $townships = township::all();
        $townships = Township::paginate(10);

        return TownshipsResource::collection($townships); // collection မဖြစ်မနေထည့်ေပးရမ်
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|unique:townships,name"
        ]);
        // $user = Auth::user();

        $township = new Township();
        $township -> name = $request["name"];
        $township -> slug = Str::slug($request["name"]);
        $township -> country_id = $request["country_id"];
        $township -> region_id = $request["region_id"];
        $township -> city_id = $request["city_id"];
        $township -> status_id = $request["status_id"];
        $township -> user_id = $request["user_id"];

        $township -> save();

        return new TownshipsResource($township);
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


        $township = Township::findOrFail($id);
        $township -> name = $request["editname"];
        $township -> slug = Str::slug($request["editname"]);
        $township -> user_id = $request["edituser_id"];
        $township -> country_id = $request["editcountry_id"];
        $township -> region_id = $request["editregion_id"];
        $township -> city_id = $request["editcity_id"];
        $township -> status_id = $request["editstatus_id"];

        $township -> save();

        return new TownshipsResource($township);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $township = Township::findOrFail($id);

        $township -> delete();

        return new TownshipsResource($township);
    }


    public function townshipsstatus(Request $request){
        // return response()->json(["success" => "Status Change Successful"]);

        $township = Township::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည်

        // dd("hello");

        $township -> status_id = $request["status_id"];

        $township -> save();

        // success ဖြစ်ပါက response ပြန်ရန်
        return new TownshipsResource($township);
    }

    public function filterbycityid($filter){
        return TownshipsResource::collection(township::where("city_id",$filter)->where("status_id",3)->get());
    }
}
