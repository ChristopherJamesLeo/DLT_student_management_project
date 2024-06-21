<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// post page ထဲ ဘယ်လောက်ကြာကြာ နေသွားသလဲ ကြည့်နိုင်ရန်
class PostViewDuration extends Model
{
    use HasFactory;
    protected $table = "post_view_durations";
    protected $primaryKey = "id";
    protected $fillable = [
        "user_id",
        "post_id",
        "duration"
    ];

    public function user(){
        return $this -> belongsTo(User::class); 
    }

    public function post(){
        return $this -> belongsTo(Post::class); 
    }
}
