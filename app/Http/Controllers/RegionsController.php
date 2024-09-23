<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegionsController extends Controller
{
    public function index()
    {

        $regions = Region::where(function($query){
            if($getname = request("filtername")){
                $query -> where("name","LIKE","%".$getname."%");
            }
        })->paginate(20);

        $statuses = Status::whereIn("id",[3,4])->get();
        $countries = Country::orderBy('name',"asc")->where("status_id",3)->get();
        $cities= City::orderBy('name',"asc")->where("status_id",3)->get();

        // dd($countries);
        return view("regions.index",compact("regions","statuses","countries","cities"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "country_id" => "required",
            "city_id" => "required",
            "name" => "required"
        ]);

        $user_id = Auth::user() -> id;

        $region = new Region;
        $region -> name = $request["name"];
        $region -> slug = Str::slug($request["name"]);
        $region -> country_id = $request["country_id"];
        $region -> city_id = $request["city_id"];
        $region -> status_id = $request["status_id"];
        $region -> user_id = $user_id ;

        $region -> save();

        return redirect(route("regions.index"));


    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "editname" => "required",
            "editcountry_id" => "required",
            "editcity_id" => "required",
        ]);

//        dd("hello world");

        $user_id = Auth::user() -> id;

        $region = Region::findOrFail($id);
        $region -> name = $request["editname"];
        $region -> slug = Str::slug($request["editname"]);
        $region -> country_id = $request["editcountry_id"];
        $region -> city_id = $request["editcity_id"];
        $region -> status_id = $request["status_id"];

        $region -> user_id = $user_id ;

        $region -> save();
        session()->flash("info","Update successful");
        return redirect(route("regions.index"));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);

        $region -> delete();

        return redirect(route("regions.index"));
    }

    public function regionsstatus(Request $request){
        $region = Region::findOrFail($request["id"]);
        $region->status_id = $request["status_id"];
        $region->save();

        return response()->json(["success"=>"Status Update Successful"]);
    }
}
