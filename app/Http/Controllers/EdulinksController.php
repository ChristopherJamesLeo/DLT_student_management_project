<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Edulink;
use App\Models\Stage;
use App\Models\Post;
use App\Models\Status;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EdulinksController extends Controller
{
    public function index()
    {
        // $data["edulinks"] = Edulink::orderby("updated_at","desc")->get();

        

        // $data["edulinks"] = Edulink::orderby("updated_at","desc")->paginate(7);

        // $data["edulinks"] = Edulink::where(function($query){
        //     if($getfilter = request("filter")){
        //         $query -> where("post_id",$getfilter);
        //     }

        //     if($getsearch = request("search")){
        //         $query -> where("classdate","LIKE","%".$getsearch."%");
        //     }
        // })->zaclassdate()->paginate(5); // scopezaclassdate -> model ထဲတွင် ပေးထားသော query method အား ပြန်သုံးရာတွင် scope ဖြုတ်ပြီးသုံးပေးရမည် 


        // method 2
        // \DB::enableQueryLog();  // db ထဲရှိ query ကိုပါ စစ်နို်သည် enableQueryLog နှင့်  getQueryLog ကို ကြားညှပ်ပြီးသုံးပေးရမည်
        // $data["edulinks"] = Edulink::filter()->zaclassdate()->paginate(6); // where တစ်ခုလုံး model ထဲတွင် scopefilter ဟူသော method တည်ဆောက်ပြီး controller ထဲတွင် လာသုံးထားသည် 
        // dd(\DB::getQueryLog());

        // \DB::enableQueryLog();
        // $data['edulinks'] = Edulink::all();

        // dd(\DB::getQueryLog());

        // filter ချထားသော ကောင်ထဲမှ search လုပ်နိုင်ရန် searchonlyဟူသော method အခွဲဖြသ့် ထပ်စစ်ထားခြင်းဖစ်သည်
        $data["edulinks"] = Edulink::filter()->searchonly()->zaclassdate()->paginate(6);

        // $data["stages"] = Stage::whereIn("id",["1","2","3"])->get();
        
        // backward slack on သည် system မှ default ပါသော class ‌ရှေတွင် ထည့်‌ေးလျင်ပို ကောင်းသည် 
        $data["posts"] = \DB::table("posts")->where("attshow",3)->orderby("title","asc")->pluck("title","id"); 

        $data["filterposts"] = Post::whereIn("attshow",[3])->orderby("title","asc")->pluck("title","id")->prepend("Choose Status..." , " ");
        // ပို့ချင်သာ data များ အား data ထဲကောက်ထည့်ပြီး data ပို့ ရုံဖြင့် အလုပ်လုပ်နိုင်သည် 
        return view("edulinks.index",$data);
    }


    public function create()
    {
        $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("edulinks.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        $this -> validate($request,[   
            "classdate" => "required|date", // date ဘဲယူမည်
            "post_id" => "required",
            "url" => "required"
        ]);

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $edulink = new Edulink();
        $edulink -> classdate = $request["classdate"];
        $edulink -> post_id = $request["post_id"]; 
        $edulink -> url = $request["url"]; 
        $edulink -> user_id = $user_id;  

        $edulink -> save();



        // return redirect() -> back();
        // return redirect()->route("edulinks.index");

        // အောင်မြင်ကြောင်း alert ထုတ်ပြရန် 
        return redirect()->route("edulinks.index")->with('success',"Your Post Is Successful");
        // success သည် session ထဲရောက်နေမည်ဖြစ်ပြီး session ဖြင့် ပြန်ခေါ်‌ပေးရမဘ်
    }


    public function show(string $id)
    {
        $edulink = Edulink::findOrFail($id);

        return view("edulinks.show",["role"=>$role]);
    }


    public function edit(string $id)
    {
        $edulink = Edulink::findOrFail($id);
        $statuses = Status::whereIn("id",[3,4])->get();
        return view("edulinks.edit")->with("edulink",$edulink)->with("statuses",$statuses);
    }


    public function update(Request $request, string $id)
    {

        $this -> validate($request,[   
            "editclassdate" => "required|date", // date ဘဲယူမည်
            "editpost" => "required",
            "editurl" => "required"
        ]);

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $edulink = Edulink::findOrFail($id);
        $edulink -> classdate = $request["editclassdate"];
        $edulink -> post_id = $request["editpost"]; 
        $edulink -> url = $request["editurl"]; 
        $edulink -> user_id = $user_id;  


        $edulink -> save();

        // return redirect(route("edulinks.index"));
        // return success message
        // method(1)
        // return redirect(route("edulinks.index"))->with("success","Update Successfully");

        session()->flash("success","Update Successful"); // session ဖြင့် ပြပေးခြင်းဖြစ်သ်ည
        return redirect(route("edulinks.index"));
    }


    public function destroy(string $id)
    {
        $edulink = Edulink::findOrFail($id);


        $edulink -> delete();
        session()->flash("success","Delete Successfully");
        return redirect()->back();
    }


    // download counter
    public function download($id){
        $edulink = Edulink::findOrFail($id);

        $edulink -> increment("counter"); // counter ဆိုသော column ထဲရှီ value ကို တိုးသွားစေမည်ဖြစ်သည် 

        return redirect($edulink->url); // counter ပြီးပါက url ကို return ပြန်ပေးချင်းဖြစ် a tag ရှီ ့href ထဲတွင် return ပြန်ထားသော link ဝင်သွားမည်ဖြစ်သည် 

        
    }

    // download counter
}
