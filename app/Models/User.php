<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function comments(){
        return $this -> morphMany(Comment::class,"commentable");
    }


    // user မှ like လုပ်မည့် ကောင်ကို ရှာမည်
    public function likes(){
        // naming ကို လိုက်နာသောကြောင့်  parameter နှစ်ခုပေးရမသည်

        // return $this -> belongsToMany(Post::class,"post_like");
        return $this -> belongsToMany(Post::class,"post_like")->withTimestamps(); // timestamp ပါ ထည့်ပေးရန် ေပြာသည် 
    }

    public function checkpostlike($post_id){
        // like ထဲရှီ data များမှ ဆွဲထုတ်ပြီး post_id သည် $post_id ရှိသလား စစ်ခြင်းဖြစ်သည် 
        return $this -> likes() -> where("post_id",$post_id)->exists(); // true of false
    }

    public function followings(){
        // naming ကို မလိုက်နာသောကြောင့်  parameter လေးခုပေးရမသည်
                                        // pt      secondary table  secondary_fk    pt f_k     
        return $this -> belongsToMany(User::class,"follower_user","follower_id","user_id")->withTimestamps();
    }

    public function checkuserfollowing($following_id){
                                            //follower Table ထဲတွင်ရှိသော မိမိ follow ထားသော User ၏ id 
        return $this -> followings() -> where("user_id",$following_id)->exists(); 
    }

    // check online 
    public function scopeOnlineusers($query){  // query ဟု ရေးလိုက်တာနဲ့ use modal ကို လှမ်းခေါ်မည်ဆိုတာ အလို အလေှာက်သိထားပြိးသာ်း
        return $query -> where("is_online",1)->get();
    }

    public function scopeOfflineusers($query){  // query ဟု ရေးလိုက်တာနဲ့ use modal ကို လှမ်းခေါ်မည်ဆိုတာ အလို အလေှာက်သိထားပြိးသာ်း
        return $query -> where("is_online",0)->get();
        

    }

    // log in log out သိစေရန် provider တစ်ခု listener တစ်ခု ဖန်တီးပေးရမည် 
    // php artisan make:provider OnOffUserStatusServiceProvider  // provider အား config -> app ထဲတွင် သွားရောက်အသက်သွင်းပေးရမည် 
    // php artisan make:listener OnOffUserStatusListener // listener အား Provider ထဲရှီ eventserviceprovider ထဲရှီ listen ထဲတွင် အသက်သွင်းပေးရမ် 

    public function carts(){
        return $this -> hasMany(Cart::class);
    }

    public function userpoint(){
        return $this -> hasOne(UserPoint::class);
    }

}
