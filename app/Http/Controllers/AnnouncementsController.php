<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Notification;
use App\Notifications\AnnouncementNotify;

use App\Models\Announcement;
use App\Models\Day;
use App\Models\User;
use App\Models\Dayable;

use App\Models\Status;
use App\Models\Type;
use App\Models\Tag;
use App\Models\Comment;
class AnnouncementsController extends Controller
{

    public function index()
    {
        $this -> authorize("view",Announcement::class);  

        $announcements = Announcement::all();

        return view("announcements.index",compact("announcements"));
    }


    public function create()
    {
        $this -> authorize("create",Announcement::class);  // policy ထဲမှာ create အား ဖန်တီးပေးရမယ် ဖြစ်ပြီး ၄င်း create အား authorize ထဲတွင် string type ဖြင့်ထည့်ပေးရမယ် second parameter ကို model အား ထည့်ပေးရမယ် 
        
        $posts = \DB::table("posts")->where("attshow",3)->orderby("title","asc")->get()->pluck("title","id"); 

        return view("announcements.create",compact("posts"));

    }


    public function store(Request $request)
    {
        // return $request;
        
        $this -> validate($request,[

            "image" => "image|mimes:jpg,jpeg,png|max:2048",
            "title" => "required|max:300",
            "content" => "required",
            "post_id" => "required"
        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        

        $announcement = new Announcement();
        
        $this -> authorize("create",$announcement);  

        $announcement -> title = $request["title"];
        $announcement -> post_id = $request["post_id"];  
        $announcement -> content = $request["content"];
        $announcement -> user_id = $user_id;  

        // single img upload
        if(file_exists($request["image"])){

            $file = $request->file("image");

            $fname = $file->getClientOriginalName();

            $imagenewname = uniqid($user_id).$announcement["id"].$fname;   

            $file -> move(public_path("assets/img/announcements/"),$imagenewname);

            $filepath = "assets/img/announcements/".$imagenewname;  

            $announcement -> image = $filepath; 

        }

        $announcement -> save();

        

        $users = User::where("id","!=",Auth::user()->id)->get();
                        // ပို့ေစချင်သော user     ပို့မည့် notification
        Notification::send($users,new AnnouncementNotify($announcement->id,$announcement->title,$announcement->image));

        session()->flash("success","Announcement Create Successful");
        return redirect(route("announcements.index"));
    }


    public function show(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        // dd($post -> checkenroll(1)); check 

        $this -> authorize("view",$announcement);  

        $user_id = Auth::user()->id;


        $comments = $announcement->comments()->orderby("updated_at","desc")->get(); // restrict for only post
        

        $posts = \DB::table("posts")->where("attshow",3)->orderby("title","asc")->get()->pluck("title","id");

        $type = "App\Notifications\AnnouncementNotify";

        $getnoti = \DB::table("notifications")->where("type",$type)->where("notifiable_id",$user_id,$id)->where("data->id",$id)->pluck("id");

        // dd($getnoti);

        \DB::table("notifications")->where("id",$getnoti)->update(["read_at"=>now()]);

        return view("announcements.show",["announcement"=>$announcement,"comments"=>$comments]);
    }


    public function edit(string $id)
    {

        $announcement = Announcement::findOrFail($id);

        $this -> authorize("edit",$announcement); 

        $posts = \DB::table("posts")->where("attshow",3)->orderby("title","asc")->get()->pluck("title","id"); 

        return view("announcements.edit")->with("announcement",$announcement)->with("posts",$posts);

    }


    public function update(Request $request, string $id)
    {
        

        $this -> validate($request,[

            "image" => "image|mimes:jpg,jpeg,png",
            "title" => "required|max:100",
            "content" => "required",
            "post_id" => "required"

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        $announcement = Announcement::findOrFail($id);

        $this -> authorize("update",$announcement);  

        $announcement -> title = $request["title"];
        $announcement -> content = $request["content"]; 
        $announcement -> post_id = $request["post_id"];  
        $announcement -> user_id = $user_id;  

        // Remove Old Img 
        if($request->hasfile("image")){
            $path = $announcement -> image; // ပတ်လမ်းကို ခေါ်ထုတ်မည် 

            if(File::exists($path)){ // ပတ်လမ်းကြောင်းအတိုင်း file ရှိမရှိ စစ်မည်
                File::delete($path); // file ရှိလျှင်ဖျက်မည် 
            }

        }
       
        // single img update
        if($request->hasfile("image")){

            $file = $request->file("image");
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$announcement["id"].$fname;  

            $file -> move(public_path("assets/img/announcements/"),$imagenewname);

            $filepath = "assets/img/announcements/".$imagenewname;  

            $announcement -> image = $filepath;


        }

        $announcement -> save();

        return redirect(route("announcements.index"));
    }


    public function destroy(string $id)
    {
        $this -> authorize("delete",Announcement::class);  

        $announcement = Announcement::findOrFail($id);

         // Remove Old Image

        $path = $announcement -> image; // ပတ်လမ်းကို ခေါ်ထုတ်မည် 

        if(File::exists($path)){ // ပတ်လမ်းကြောင်းအတိုင်း file ရှိမရှိ စစ်မည်
            File::delete($path); // file ရှိလျှင်ဖျက်မည် 
        }

        $announcement -> delete();

        return redirect()->back();
    }
}
