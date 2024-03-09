<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CountryContrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(request("filtername")); // url မှ query ကို request() ဖြင့် ဖမ်းမည် 
        // $countries = Country::all();
        // filter ချရန် 
        // $countries = Country::where(function($query){ // query သည် Country မှ query ကို ဆိုလိုသည် 
        //     if($getname = request("filtername")){
        //         $query -> where("name","LIKE","%".$getname."%");
        //     }
        // })->get();

        $countries = Country::where(function($query){ // query သည် Country မှ query ကို ဆိုလိုသည် 
            if($getname = request("filtername")){
                $query -> where("name","LIKE","%".$getname."%");
            }
        })->paginate(2);

        // dd($countries);
        return view("countries.index",compact("countries"));
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
            "name" => "required|unique:countries,name"
        ]);

        $user_id = Auth::user() -> id;

        $country = new Country;
        $country -> name = $request["name"];
        $country -> slug = Str::slug($request["name"]);
        $country -> user_id = $user_id ;

        $country -> save();

        return redirect(route("countries.index"));


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
        $this -> validate($request,[
            "name" => "required|unique:countries,name"
        ]);

        $user_id = Auth::user() -> id;

        $country = Country::findOrFail($id);
        $country -> name = $request["name"];
        $country -> slug = Str::slug($request["name"]);
        $country -> user_id = $user_id ;

        $country -> save();

        return redirect(route("countries.index"));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);

        $country -> delete();

        return redirect(route("countries.index"));
    }
}
