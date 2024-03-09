<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relative;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RelativesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relatives = Relative::all();

        // $statuses = Status::all();
        $statuses = Status::whereIn("id",[3,4])->get();

        return view("relatives.index",compact("relatives"))->with("statuses",$statuses);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|unique:relatives,name"
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $relative = new Relative();

        $relative -> name = $request["name"];
        $relative -> slug = Str::slug($request["name"]);
        $relative -> user_id = $user_id;
        $relative -> status_id = $request["status_id"];

        $relative -> save();

        session()->flash("success","Insert Successful");

        return redirect(route("relatives.index"));

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "name" => "required|unique:relatives,name,".$id,
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $relative = Relative::findOrFail($id);

        $relative -> name = $request["name"];
        $relative -> slug = Str::slug($request["name"]);
        $relative -> user_id = $user_id;
        $relative -> status_id = $request["status_id"];

        $relative -> save();

        session()->flash("success","Update Successful");

        return redirect(route("relatives.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relative = Relative::findOrFail($id);

        $relative -> delete();

        session()->flash("success","Delete Successful");
        
        return redirect(route("relatives.index"));
    }

    // ajax change statu

    public function relativestatus(Request $request) {
        $relative = Relative::findOrFail($request["id"]);

        $relative->status_id = $request["status_id"];

        $relative -> save();

        return response()->json(["success" => "status change successfu;"]);
    }
}
