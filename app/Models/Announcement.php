<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable; // notification သံဒး ရန် Model ထဲတွငါ အရင် use လုပ်ပေးရမည် 

class Announcement extends Model
{
    use HasFactory;

    use Notifiable; // class ထဲတွင်ပါ use ရမည် 

    protected $table = "announcements";

    protected $primaryKey = "id";

    protected $fillable = [
        "image",
        "title",
        "content",
        "post_id",
        "user_id",
    ];

    public function post(){
        return $this -> belongsTo(Post::class); 
    } 

    public function user(){
        return $this -> belongsTo(User::class);
    }


    public function comments(){
        return $this -> morphMany(Comment::class,"commentable");
    }
    
}

