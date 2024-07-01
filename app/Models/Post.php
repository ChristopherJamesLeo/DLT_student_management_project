<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $table = "posts";
    protected $primaryKey = "id";
    protected $fillable = [
        "image",
        "title",
        "slug",
        "content",
        "fee",
        "startdate",
        "enddate",
        "starttime",
        "endtime",
        "type_id",
        "tag_id",
        "attshow",
        "status_id",
        "user_id",
    ];

    public function comments(){
        return $this -> morphMany(Comment::class,"commentable");
    }

    public function user(){
        return $this -> belongsTo(User::class); 
    }

    public function attstatus(){
        // return $this -> belongsTo(Status::class,"attshow"); 
                                    // related , foreign key
        return $this -> belongsTo(Status::class,"attshow","id"); 
    }

    public function status(){
        return $this -> belongsTo(Status::class); 
    }

    public function tag(){
        return $this -> belongsTo(Tag::class); 
    }

    public function type(){

        // return $this -> belongsTo(Type::class); 
                                    // related , foreign key
        return $this -> belongsTo(Type::class,"type_id"); 
    }

    public function days(){
        return $this -> morphToMany(Day::class,"dayable");
    }

    public function checkenroll($userid){
        return DB::table("enrolls")->where("post_id",$this -> id)->where("user_id",$userid)->exists();
        // enrolls ထဲတွင် post_id နှင့် user_id ရှိနေသလားသည် exists() ဖြင့် စစ်မည် return သည် true / false ထုတ်ပေးမည် 
        // $this -> သည် လက်ရှိရနေသော post  ထဲတွင်ရေးထားသောကြောင့် လက်ရှိ Post id ကို ဘဲ ထုတ်ပေးနေမည်ဖြစ်သည် 
    }


       
    public function likes(){ // post အား like လုပ်ထားသူ user အားလံုး ကို ယူမည် 
        // return $this -> belongsToMany(Post::class,"post_like");
        return $this -> belongsToMany(User::class,"post_like"); // timestamp ပါ ထည့်ပေးရန် ေပြာသည် 
    }

    public function postviewdurations(){
        return $this -> hasMany(PostViewDuration::class);
    }
}
