<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RolesController extends Controller
{

    public function index()
    {
        // $roles = Role::all();
        // $roles = Role::where(function($query){
        //     if($statusid = request("filterstatus_id")){
        //         $query -> where("status_id",$statusid);
        //     }
        // })->get();
        $roles = Role::where(function($query){
            if($statusid = request("filterstatus_id")){
                $query -> where("status_id",$statusid);
            }
        })->paginate(10);

        $filterstatuses = Status::whereIn("id",[3,4])->get()->pluck("name","id")->prepend("Choose Status..." , " "); // dropdown ဖြင့် စစ်မည်


        return view("roles.index",compact("roles","filterstatuses"));
    }


    public function create()
    {
        // $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 

        // id နှင့် name သည် ပြောင်းပြန် ပို့ပေးမည်ဖြစ်သည် 
        // $statuses = Status::whereIn("id",[3,4])->get()->pluck("id","name"); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        
        $statuses = Status::whereIn("id",[3,4])->get()->pluck("name","id"); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("roles.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|max:50|unique:roles,name",
            // "image" => "image|mimes:jpg,jpeg,png|max:1024",   // accept လုပ်မည့် file type အများဆုံး 1mb ဘဲလက်ခံမည် 
            "image" => "required|image|mimes:jpg,jpeg,png",   // accept လုပ်မည့် file type
            "status_id" => "required|in:3,4"  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $role = new Role();
        $role -> name = $request["name"];
        $role -> slug = Str::slug($request["name"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည် 
        $role -> status_id = $request["status_id"];  
        $role -> user_id = $user_id;  

        // single img upload
        if(file_exists($request["image"])){
            $file = $request["image"];

            $fname = $file->getClientOriginalName();

            $imagenewname = uniqid($user_id).$role["id"].$fname;   // user_id ကို radom ခေါ်ကဝင်မည် 

            $file -> move(public_path("assets/img/roles/"),$imagenewname);

            $filepath = "assets/img/roles/".$imagenewname;  // public အောက်တွင်ရှီသော folder နျင့် view ထဲတွင်ရှိနေသော folder route ပတ်လမ်းတူ၍ မရပေ

            $role -> image = $filepath; // store database 

            // The requested resource /roles was not found on this server // ၄င်းသည် folder name ကို ချိန်းပေးရမည် route ထဲတါင်ရှိနေသော name နှင့် public အောက်တွင်ရှိသော folder name တူ၍ မရပေ 
        }

        $role -> save();

        return redirect(route("roles.index"));
    }


    // public function show(string $id)
    // {
    //     $role = Role::findOrFail($id);

    //     return view("roles.show",["role"=>$role]);
    // }

    // show by slug
    public function show(Role $role) // role ထဲရှီ column အားလုံးရနေမည် note : route ကို provider ထဲမှ RouteServiceProvider ထဲမှ binding လုပ်ပေးရမည် // provider ထဲရှီ role ည် $role ကို ဆိုလိုသည် 
    {


        return view("roles.show",["role"=>$role]);
    }


    public function edit(Role $role)
    {
        // $role = Role::findOrFail($id);  with search ID
        
        $statuses = Status::whereIn("id",[3,4])->get();
        return view("roles.edit")->with("role",$role)->with("statuses",$statuses);
    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            // method 1 
            // "name" => "required|max:50|unique:roles,name,". $id,

            // method 2 -> array ဖြင့် လဲ ပေးနိုင်သည် pipe နေရာတွင် comer  ထည့်ပီး single code double code ထည့်ပေးနိုင်သည် // မှားနိုင်သည် 
            "name" => ["required","max:50","unique:roles,name,". $id],
            "image" => ["image","mimes:jpg,jpeg,png"],   // accept လုပ်မည့် file type
            "status_id" => ["required","in:3,4"]  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        $role = Role::findOrFail($id);
        $role -> name = $request["name"];
        $role -> slug = Str::slug($request["name"]); 
        $role -> status_id = $request["status_id"];  
        $role -> user_id = $user_id;  

        // Remove Old Img 
        if($request->hasFile("image")){
            $path = $role -> image; // ပတ်လမ်းကို ခေါ်ထုတ်မည် 

            if(File::exists($path)){ // ပတ်လမ်းကြောင်းအတိုင်း file ရှိမရှိ စစ်မည်
                File::delete($path); // file ရှိလျှင်ဖျက်မည် 
            }

        }

        // single img update
        if($request->hasFile("image")){


            $file = $request->file("image");
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$role["id"].$fname;   // user_id ကို radom ခေါ်ကဝင်မည် 

            $file -> move(public_path("assets/img/roles/"),$imagenewname);

            $filepath = "assets/img/roles/".$imagenewname;  // public အောက်တွင်ရှီသော folder နျင့် view ထဲတွင်ရှိနေသော folder route ပတ်လမ်းတူ၍ မရပေ

            $role -> image = $filepath; // store database 

            // The requested resource /roles was not found on this server // ၄င်းသည် folder name ကို ချိန်းပေးရမည် route ထဲတါင်ရှိနေသော name နှင့် public အောက်တွင်ရှိသော folder name တူ၍ မရပေ 
        }

        $role -> save();

        return redirect(route("roles.index"));
    }


    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

         // Remove Old Image

        $path = $role -> image; // ပတ်လမ်းကို ခေါ်ထုတ်မည် 

        if(File::exists($path)){ // ပတ်လမ်းကြောင်းအတိုင်း file ရှိမရှိ စစ်မည်
            File::delete($path); // file ရှိလျှင်ဖျက်မည် 
        }

        $role -> delete();

        return redirect()->back();
    }


    public function rolestatus(Request $request){
        $role = Role::findOrFail($request["id"]);

        $role -> status_id = $request["status_id"];

        $role -> save();

        return response()->json(["success" => "status change successfu;"]);
    }
}
