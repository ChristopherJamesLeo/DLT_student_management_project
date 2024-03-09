<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\Day;
use App\Models\Dayable;
use App\Models\Post;
use App\Models\Status;
use App\Models\Type;
use App\Models\Tag;
use App\Models\Comment;


class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view("posts.index",compact("posts"));
    }


    public function create()
    {
        $attshows = Status::whereIn("id",[3,4])->get(); 

        $days = Day::where("status_id",3)->get();
        
        $statuses = Status::whereIn("id",[7,10,11])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        
        $tags = Tag::where("status_id",3)->get(); 

        $types = Type::whereIn("id",[1,2])->get(); 

        return view("posts.create",compact("attshows","days","statuses","tags","types"));

    }


    public function store(Request $request)
    {
        // return $request;
        $this -> validate($request,[

            "image" => "image|mimes:jpg,jpeg,png|max:2048",
            "title" => "required|max:300|unique:posts,title",
            "content" => "required",
            "fee" => "required",
            "startdate"  => "required",
            "enddate"  => "required",
            "starttime"  => "required",
            "endtime"  => "required",
            "type_id"  => "required|in:1,2",
            "tag_id" => "required",
            "attshow" => "required|in:3,4",
            "status_id" => "required|in:7,10,11"
        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $post = new Post();
        $post -> title = $request["title"];
        $post -> slug = Str::slug($request["title"]); 
        $post -> content = $request["content"];  
        $post -> fee = $request["fee"];  
        $post -> startdate = $request["startdate"];  
        $post -> enddate = $request["enddate"];  
        $post -> starttime = $request["starttime"];  
        $post -> endtime = $request["endtime"];  
        $post -> type_id = $request["type_id"];  
        $post -> tag_id = $request["tag_id"];  
        $post -> attshow = $request["attshow"];  
        $post -> status_id = $request["status_id"];  
        $post -> user_id = $user_id;  

        // single img upload
        if(file_exists($request["image"])){

            $file = $request->file("image");

            $fname = $file->getClientOriginalName();

            $imagenewname = uniqid($user_id).$post["id"].$fname;   

            $file -> move(public_path("assets/img/posts/"),$imagenewname);

            $filepath = "assets/img/posts/".$imagenewname;  

            $post -> image = $filepath; 

        }

        $post -> save();

        // method 1
        // if($post->id){ // post ထဲသို့ data ထည့်တာ အောင်မြင်မှသာ
        //     // create dayable 
        //     if(count($request["day_id"] ) > 0){
        //         foreach($request["day_id"] as $key => $value){
        //             Dayable::create([
        //                 // "day_id" => $request["day_id"]["key"], // method 1
        //                 "day_id" => $value, // method 2
        //                 "dayable_id" => $post->id,
        //                 "dayable_type" => $request["dayable_type"] // post အတွက်ဘဲ လာမည်ဖြစ်သောကြောင့် တန်းရေးလို့ရသည် 
        //             ]);
        //         }
                
        //     }
        // }

        // method 2 
        if($post->id){ // post ထဲသို့ data ထည့်တာ အောင်မြင်မှသာ
            // create dayable 
            if(count($request["day_id"] ) > 0){
                foreach($request["day_id"] as $key => $value){
                    $day = [
                        // "day_id" => $request["day_id"]["key"], // method 1
                        "day_id" => $value, // method 2
                        "dayable_id" => $post->id,
                        "dayable_type" => $request["dayable_type"] // post အတွက်ဘဲ လာမည်ဖြစ်သောကြောင့် တန်းရေးလို့ရသည် 
                    ];

                    Dayable::insert($day);
                }
            }
        }

        return redirect(route("posts.index"));
    }


    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        $attshows = Status::whereIn("id",[3,4])->get(); 

        $dayables = $post-> days() -> get();

        // dd($post -> checkenroll(1)); check 


        // $comments = Comment::where("commentable_id",$post->id)->where("commentable_type","App\Models\Post")->orderBy("created_at","desc")->get(); // restrict for only post

        $comments = $post->comments()->orderBy("updated_at","desc")->get(); // error
        return view("posts.show",["post"=>$post,"comments"=>$comments,"dayables"=>$dayables,"attshows"=>$attshows]);
    }


    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        $attshows = Status::whereIn("id",[3,4])->get(); 

        $days = Day::where("status_id",3)->get();

        $dayables = $post-> days() -> get();

        // dd($dayables);

        $statuses = Status::whereIn("id",[7,10,11])->get();

        $tags = Tag::where("status_id",3)->get(); 

        $types = Type::whereIn("id",[1,2])->get(); 

        return view("posts.edit")->with("post",$post)->with("attshows",$attshows)->with("days",$days)->with("dayables",$dayables)->with("statuses",$statuses)->with("tags",$tags)->with("types",$types);

    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[

            "image" => "image|mimes:jpg,jpeg,png",
            "title" => "required|max:300|unique:posts,title,".$id,
            "content" => "required",
            "fee" => "required",
            "startdate"  => "required",
            "enddate"  => "required",
            "starttime"  => "required",
            "endtime"  => "required",
            "type_id"  => "required|in:1,2",
            "tag_id" => "required",
            "attshow" => "required|in:3,4",
            "status_id" => "required|in:7,10,11"

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        $post = Post::findOrFail($id);
        $post -> title = $request["title"];
        $post -> slug = Str::slug($request["title"]); 
        $post -> content = $request["content"];  
        $post -> fee = $request["fee"];  
        $post -> startdate = $request["startdate"];  
        $post -> enddate = $request["enddate"];  
        $post -> starttime = $request["starttime"];  
        $post -> endtime = $request["endtime"];  
        $post -> type_id = $request["type_id"];  
        $post -> tag_id = $request["tag_id"];  
        $post -> attshow = $request["attshow"];  
        $post -> status_id = $request["status_id"];  
        $post -> user_id = $user_id;  

        // Remove Old Img 
        if($request->hasfile("image")){
            $path = $post -> image; // ပတ်လမ်းကို ခေါ်ထုတ်မည် 

            if(File::exists($path)){ // ပတ်လမ်းကြောင်းအတိုင်း file ရှိမရှိ စစ်မည်
                File::delete($path); // file ရှိလျှင်ဖျက်မည် 
            }

        }
       
        // single img update
        if($request->hasfile("image")){

            $file = $request->file("image");
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$post["id"].$fname;  

            $file -> move(public_path("assets/img/posts/"),$imagenewname);

            $filepath = "assets/img/posts/".$imagenewname;  

            $post -> image = $filepath;


        }

        $post -> save();

        return redirect(route("posts.index"));
    }


    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

         // Remove Old Image

        $path = $post -> image; // ပတ်လမ်းကို ခေါ်ထုတ်မည် 

        if(File::exists($path)){ // ပတ်လမ်းကြောင်းအတိုင်း file ရှိမရှိ စစ်မည်
            File::delete($path); // file ရှိလျှင်ဖျက်မည် 
        }

        $post -> delete();

        return redirect()->back();
    }


    
}
