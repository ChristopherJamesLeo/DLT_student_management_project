<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Status;
use App\Models\Attendance;
use App\Models\Post;

class AttendancesController extends Controller
{
    public function index()
    {
        $attendances = Attendance::orderby("updated_at","desc")->get();
        // $posts = Post::where("attshow",3)>get(); 
        $posts = DB::table("posts")->where("attshow",3)->orderby("title","asc")->get(); // -> db မှ ခေါ်လျှင် object type ဖြင့်သာခေါ်ပေးရမည် // use လုပ်ပေးရမည် 
        return view("attendances.index",compact("attendances","posts"));
    }


    public function create()
    {
        $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("attendances.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "classdate" => "required|date",
            "post_id" => "required",
            "attcode" => "required" 

        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $attendance = new Attendance();
        $attendance -> classdate = $request["classdate"];  
        $attendance -> post_id = $request["post_id"];  
        $attendance -> attcode = Str::upper($request["attcode"]); // စကားလံုးအကြီးပြောင်းမည် 
        $attendance -> user_id = $user_id;  

        $attendance -> save();
        session()->flash("success","Attended successful");
        return redirect(route("attendances.index"));
    }


    public function show(string $id)
    {
        $attendance =Attendance::findOrFail($id);

        return view("attendances.show",["attendance"=>$attendance]);
    }


    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $statuses = Status::whereIn("id",[3,4])->get();
        
        return view("attendances.edit")->with("attendance",$attendance)->with("statuses",$statuses);
    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            // method 1 
            // "name" => "required|max:50|unique:types,name,". $id,

            // method 2 -> array ဖြင့် လဲ ပေးနိုင်သည် pipe နေရာတွင် comer  ထည့်ပီး single code double code ထည့်ပေးနိုင်သည် // မှားနိုင်သည် 
            "name" => ["required","max:50","unique:attendances,name,". $id],
            "status_id" => ["required","in:3,4"]  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        $attendance = Attendance::findOrFail($id);
        $attendance -> name = $request["name"];
        $attendance -> slug = Str::slug($request["name"]); 
        $attendance -> status_id = $request["status_id"];  
        // $attendance -> user_id = $user_id;  



        $attendance -> save();

        return redirect(route("attendances.index"));
    }

}
