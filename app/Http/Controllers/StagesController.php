<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StagesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stage::all();

        // $statuses = Status::all();
        $statuses = Status::whereIn("id",[3,4])->get();

        return view("stages.index",compact("stages"))->with("statuses",$statuses);
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
            "name" => "required|unique:stages,name"
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $stage = new Stage();

        $stage -> name = $request["name"];
        $stage -> slug = Str::slug($request["name"]);
        $stage -> user_id = $user_id;
        $stage -> status_id = $request["status_id"];

        $stage -> save();

        return redirect(route("stages.index"));

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "name" => "required|unique:stages,name,".$id,
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $stage = Stage::findOrFail($id);

        $stage -> name = $request["name"];
        $stage -> slug = Str::slug($request["name"]);
        $stage -> user_id = $user_id;
        $stage -> status_id = $request["status_id"];

        $stage -> save();

        return redirect(route("stages.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stage = Stage::findOrFail($id);

        $stage -> delete();

        return redirect(route("stages.index"));
    }

    // ---------------------
    public function stagestatus(Request $request){
        $stage = Stage::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည် 

        $stage -> status_id = $request["status_id"];

        $stage -> save();

        // success ဖြစ်ပါက response ပြန်ရန်
        return response()->json(["success" => "Status Change Successful"]);
    }
}
