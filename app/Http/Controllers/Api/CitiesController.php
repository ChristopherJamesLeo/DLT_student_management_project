<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illumiate\Support\Facades\Auth;
use App\Models\City;
use App\Http\Resources\CitiesResource;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cities = City::all();
        $cities = City::paginate(10);

        return CitiesResource::collection($cities); // collection မဖြစ်မနေထည့်ေပးရမ် 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|unique:cities,name"
        ]);
        // $user = Auth::user();

        $city = new City();
        $city -> name = $request["name"];
        $city -> slug = Str::slug($request["name"]);
        $city -> country_id = $request["country_id"];
        $city -> status_id = $request["status_id"];
        $city -> user_id = $request["user_id"];

        $city -> save();

        return new CitiesResource($city);
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
        

        $city = City::findOrFail($id);
        $city -> name = $request["editname"];
        $city -> slug = Str::slug($request["editname"]);
        $city -> user_id = $request["edituser_id"];
        $city -> country_id = $request["editcountry_id"];
        $city -> status_id = $request["editstatus_id"];

        $city -> save();

        return new CitiesResource($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        
        $city -> delete();

        return new CitiesResource($city);
    }


    public function citiesstatus(Request $request){
        // return response()->json(["success" => "Status Change Successful"]);

        $city = City::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည် 

        // dd("hello");

        $city -> status_id = $request["status_id"];

        $city -> save();

        // success ဖြစ်ပါက response ပြန်ရန်
        return new CitiesResource($city);
    }
}
