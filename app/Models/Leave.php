<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // Notification ပေးပါရမည် ထိုမှသာ ပြည့်စံုမည်

class Leave extends Model
{
    use HasFactory;
    use Notifiable; // notification သံုးပါက notifiable ကို use လုပ်ပေးရမည်

    protected $table = "leaves";

    protected $primaryKey = "id";

    protected $fillable = [
        "post_id",
        "startdate",
        "enddate",
        "tag",
        "title",
        "content",
        "image",
        "stage_id",
        "authorize_id",
        "user_id",
    ];

    public function stage(){
        return $this -> belongsTo(Stage::class);
    }
    
    public function user(){
        return $this -> belongsTo(User::class);
    }


    // for single psot (not json)
    // public function post(){
    //     return $this -> belongsTo(Post::class); 
    // } 

      // for multie post(with json)
    public function tagposts($postjson){

        $postids = json_decode($postjson,true);  //decode from json encodes tags
                                                    // value , key 
        $posts = Post::whereIn("id",$postids)->pluck("title","id");

        return $posts;

    }


    // for single tag (not json)
    // public function tagperson(){
    //     return $this -> belongsTo(User::class,"tag");
    // }


    // for multie tag(with json)
    public function tagpersons($tagjson){

        $tagids = json_decode($tagjson,true);  //decode from json encodes tags

        $tags = User::whereIn("id",$tagids)->pluck("name","id");

        return $tags;
    }

    public function leavefiles(){
        return $this -> hasMany(LeaveFile::class);
    }

    public function scopefilter($query){
        return $query -> where(function($query){
            if($getfilter =  request("filter")){
                $query -> where("post_id",$getfilter);
            }
        }) ;
    }



    public function studentUrl(){
        return Student::where("user_id",$this->user_id)->get(["students.id"])->first();
    }

    public function tagpersonUrl($tagid){
        // return Student::where("user_id",$tagid)->get(["students.id"])->first();
        return Student::where("user_id",$tagid)->value("id"); // first အစား value ကို မိမိလိုချင်သော column ကိုဆွဲထုတ်နိုင်သည် 
    }

    public function maptagtonames ( $users = null ){
        $tagids = json_decode($this->tag,true);  //decode from json encodes tags

        $tagnames = collect($tagids)->map(function($id) use ($users){
            return $users[$id] ?? "Unknown";
        });
        return $tagnames -> join(", ");

    }

    public function isconverted(){
        return $this -> stage_id != 2; // 2 = pending
    }

    public function student($userid){

        // method 1 
        // $students = Student::where("user_id",$userid)->get();

        // // dd($students);
        
        // foreach($students as $student){
        //     // dd($student);

        //     // return $student;
        //     return $student["regnumber"];
        // }

        // -----------------

        // method 2 

        // reg number ကို pluck ဖြင့် သီးသန့်ဆွဲထုတ်ပြိး ပို့မည့်
        $students = Student::where("user_id",$userid)->get()->pluck("regnumber");

        // dd($students);
        
        foreach($students as $student){
            // dd($student);

            return $student;
        }
    }



    public function scopesearchonly($query){
        return $query -> where(function($query){
            if($getsearch = request("search")){
                $query ->where("created_at","LIKE","%".$getsearch."%")
                ->orwhere("updated_at","LIKE","%".$getsearch."%")
                ->orWhereHas("post",function($query) use ($getsearch){
                    $query -> where("title","LIKE","%".$getsearch."%");
                })
                ->orWhereHas("tags",function($query) use($getsearch){
                    $query -> where("name","LIKE","%".$getsearch."%");
                })
                ->orWhereHas("stage",function($query) use($getsearch){
                    $query -> where("name","LIKE","%".$getsearch."%");
                });
            }
        });
    }




}
