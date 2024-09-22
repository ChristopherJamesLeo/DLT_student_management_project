<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Status;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TownshipsController extends Controller
{
    public function index()
    {

        $townships = Township::where(function($query){
            if($getname = request("filtername")){
                $query -> where("name","LIKE","%".$getname."%");
            }
        })->paginate(20);

        $statuses = Status::whereIn("id",[3,4])->get();
        $countries = Country::orderBy('name',"asc")->where("status_id",3)->get();
        $cities= City::orderBy('name',"asc")->where("status_id",3)->get();
        $regions= Region::orderBy('name',"asc")->where("status_id",3)->get();

        // dd($countries);
        return view("townships.index",compact("townships","statuses","countries","cities","regions"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "country_id" => "required",
            "city_id" => "required",
            "region_id" => "required",
            "name" => "required|unique:townships,name"
        ]);

        $user_id = Auth::user() -> id;

        $township = new Township();
        $township -> name = $request["name"];
        $township -> slug = Str::slug($request["name"]);
        $township -> country_id = $request["country_id"];
        $township -> city_id = $request["city_id"];
        $township -> region_id = $request["region_id"];
        $township -> status_id = $request["status_id"];
        $township -> user_id = $user_id ;

        $township -> save();

        return redirect(route("townships.index"));


    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "editname" => "required|unique:townships,name,".$id,
            "editcountry_id" => "required",
            "editcity_id" => "required",
            "editregion_id" => "required",
        ]);

//        dd("hello world");

        $user_id = Auth::user() -> id;

        $township = Township::findOrFail($id);
        $township -> name = $request["editname"];
        $township -> slug = Str::slug($request["editname"]);
        $township -> country_id = $request["editcountry_id"];
        $township -> city_id = $request["editcity_id"];
        $township -> region_id = $request["editregion_id"];
        $township -> status_id = $request["status_id"];

        $township -> user_id = $user_id ;

        $township -> save();
        session()->flash("info","Update successful");
        return redirect(route("townships.index"));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $township = Township::findOrFail($id);

        $township -> delete();

        return redirect(route("townships.index"));
    }

    public function townshipsstatus(Request $request){
        $township = Township::findOrFail($request["id"]);
        $township->status_id = $request["status_id"];
        $township->save();

        return response()->json(["success"=>"Status Update Successful"]);
    }
}
