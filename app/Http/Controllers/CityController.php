<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cities = City::all();

        // $cities = City::where(function($query){
        //     if($getfilter = request("filtername")){
        //         $query -> where("name","LIKE","%".$getfilter."%");
        //     }
        // })->get();
        $cities = City::where(function($query){
            if($getfilter = request("filtername")){
                $query -> where("name","LIKE","%".$getfilter."%");
            }
        })->paginate(2);

        // return $cities;
        return view("cities.index",compact("cities"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|unique:cities,name"
        ]);
        $user = Auth::user();

        $city = new City();
        $city -> name = $request["name"];
        $city -> slug = Str::slug($request["name"]);
        $city -> user_id = $user -> id;

        $city -> save();

        return redirect(route("cities.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $city = City::findOrFail($id);
        $city -> name = $request["name"];
        $city -> slug = Str::slug($request["name"]);
        $city -> user_id = $user -> id;

        $city -> save();

        return redirect(route("cities.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);

        $city -> delete();

        return redirect() -> back();
    }
}
