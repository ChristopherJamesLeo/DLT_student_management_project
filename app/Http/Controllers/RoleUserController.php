<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleUser;
use App\Models\Status;
use App\Models\User;
use App\Models\Role;

class RoleUserController extends Controller
{
    public function index()
    {

        $roleusers = RoleUser::where(function($query){
            if($statusid = request("filterstatus_id")){
                $query -> where("status_id",$statusid);
            }
        })->paginate(10);

        $users = User::all();
        $roles = Role::all();

        $filterstatuses = Status::whereIn("id",[3,4])->get()->pluck("name","id")->prepend("Choose Status..." , " "); // dropdown ဖြင့် စစ်မည်


        return view("roleusers.index",compact("roleusers","filterstatuses","users","roles"));
    }


    // public function create()
    // {

    //     $statuses = Status::whereIn("id",[3,4])->get()->pluck("name","id"); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
    //     return view("roles.create",compact("statuses"));
    // }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "user_id" => "required",
            "role_id" => "required",
        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $roleuser = new RoleUser(); 
        $roleuser -> user_id = $request["user_id"];  
        $roleuser -> role_id = $request["role_id"];

        $roleuser -> save();

        return redirect(route("roleusers.index"));
    }


    // public function show(string $id)
    // {
    //     $roleuser = Role::findOrFail($id);

    //     return view("roleusers.show",["roleuser"=>$roleuser]);
    // }


    // public function edit(string $id)
    // {
    //     $roleuser = RoleUser::findOrFail($id);
    //     $statuses = Status::whereIn("id",[3,4])->get();
    //     return view("roles.edit")->with("roleuser",$roleuser)->with("statuses",$statuses);
    // }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "user_id" => "required",
            "role_id" => "required",

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        $roleuser = RoleUser::findOrFail($id);
        $roleuser -> user_id = $request["user_id"];  
        $roleuser -> role_id = $request["role_id"];

        $roleuser -> save();

        return redirect(route("roleusers.index"));
    }


    public function destroy(string $id)
    {
        $roleuser = RoleUser::findOrFail($id);


        $roleuser -> delete();

        return redirect()->back();
    }


    public function rolestatus(Request $request){
        $roleuser = RoleUser::findOrFail($request["id"]);

        $roleuser -> status_id = $request["status_id"];

        $roleuser -> save();

        return response()->json(["success" => "status change successfu;"]);
    }
}
