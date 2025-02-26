<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enroll;
use App\Models\Stage;
use App\Models\Status;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class EnrollsController extends Controller
{
    public function index()
    {
        $enrolls = Enroll::orderby("updated_at","desc")->get();

        $stages = Stage::whereIn("id",["1","2","3"])->get();

        $posts = DB::table("posts")->where("attshow",3)->orderby("title","asc")->get(); 

        return view("enrolls.index",compact("enrolls","posts","stages"));
    }


    public function create()
    {
        $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("enrolls.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "image" => "required|image|mimes:jpg,jpeg,png",   // accept လုပ်မည့် file type
            "remark" => "required"
        ]);

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $enroll = new Enroll();
        $enroll -> post_id = $request["post_id"];
        $enroll -> remark = $request["remark"]; 
        $enroll -> user_id = $user_id;  

        // single img upload
        if(file_exists($request["image"])){
            $file = $request["image"];

            $fname = $file->getClientOriginalName();

            $imagenewname = uniqid($user_id).$enroll["id"].$fname;   // user_id ကို radom ခေါ်ကဝင်မည် 

            $file -> move(public_path("assets/img/enrolls/"),$imagenewname);

            $filepath = "assets/img/enrolls/".$imagenewname;  

            $enroll -> image = $filepath; // store database 

        }

        $enroll -> save();

        session()->flash("success","Enroll Created");

        return redirect() -> back();
    }


    public function show(string $id)
    {
        $enroll = Enroll::findOrFail($id);

        $allLeaves = Leave::where("user_id",$id)->orderBy("id","desc")->get();

        $stages = Stage::whereIn("id",[1,2,3])->where("status_id",3)->get();

        $enrollments = Enroll::where("user_id",$enroll->user_id)->get();

        return view("enrolls.show",["enroll"=>$enroll,"stages"=>$stages,"enrollments"=>$enrollments,"allLeaves"=>$allLeaves]);
    }


    public function edit(string $id)
    {
        $enroll = Enroll::findOrFail($id);
        $statuses = Status::whereIn("id",[3,4])->get();
        return view("enrolls.edit")->with("enroll",$enroll)->with("statuses",$statuses);
    }


    public function update(Request $request, string $id)
    {
        // $this -> validate($request,[
        //     // method 1 
        //     // "name" => "required|max:50|unique:enrolls,name,". $id,

        //     // method 2 -> array ဖြင့် လဲ ပေးနိုင်သည် pipe နေရာတွင် comer  ထည့်ပီး single code double code ထည့်ပေးနိုင်သည် // မှားနိုင်သည် 
        //     "name" => ["required","max:50","unique:enrolls,name,". $id],
        //     "image" => ["image","mimes:jpg,jpeg,png"],   // accept လုပ်မည့် file type
        //     "status_id" => ["required","in:3,4"]  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

        // ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            $enroll = Enroll::findOrFail($id);
            $enroll -> stage_id = $request["editstage_id"];
            $enroll -> remark = $request["editremark"];
            $enroll -> user_id = $user_id;

            $enroll -> save();

            if($enroll){
                session()->flash("success","Permission Successful");
                return response()->json(["status"=>"success","data"=>$enroll]);
            }

            return response()->json(["status"=>"failed","message"=>"Failed to update"]);
            
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"fail","message"=>$e->getMessage()]);
        }

    }


    public function destroy(string $id)
    {
        $enroll = Enroll::findOrFail($id);

         // Remove Old Image

        $path = $enroll -> image; // ပတ်လမ်းကို ခေါ်ထုတ်မည် 

        if(File::exists($path)){ // ပတ်လမ်းကြောင်းအတိုင်း file ရှိမရှိ စစ်မည်
            File::delete($path); // file ရှိလျှင်ဖျက်မည် 
        }

        $enroll -> delete();

        return redirect()->back();
    }

    public function updatestage(Request $request,$id){

        $leave = Enroll::findOrFail($id);

        $leave -> stage_id = $request->stage_id;

        $leave -> save();

        // session()->flash("success","Successful");

        return redirect()->back()->with("success","Stage update successfully");
    }
}
