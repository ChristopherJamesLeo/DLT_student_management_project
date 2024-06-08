<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edulink extends Model
{
    use HasFactory;

    protected $table = "edulinks";

    protected $primaryKey = "id";

    protected $fillbale = [
        "classdate",
        "post_id",
        "url",
        "counter",
        "user_id"
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function status(){
        return $this -> belongsTo("App\Models\Status");
    }

    public function post(){
        return $this -> belongsTo(Post::class); 
    } 
    

    // define local scope
    // scope ဟူသော အမည်ဖြင့်စပြီး နောက်မှ မိမိရေးချင်သော name ကို ရေးနိုင်သည်
    // controller ထဲတွင်ပြန်ခေါ်သုံးသည့်အခါ scope ဟူသော naming ကို ဖြုတ်ပေးရမည် 
    // public function scopename($query){
    //     return $query -> [method]
    // }

    public function scopezaclassdate($query){
        return $query ->orderby("updated_at","desc");
    }

    public function scopefilter($query){ // where တစ်ခုလုံး scopefilter ထဲတွင် ထည့်ရေးထားသည် 
        return $query -> where(function($query){
            if($getfilter = request("filter")){
                $query -> where("post_id",$getfilter);
            }

            if($getsearch = request("search")){
                // $query -> where("classdate","LIKE","%".$getsearch."%");

                // search by clssdata column / created at / updated at
                // search box ထဲတွင်ရှိနေသော တန်ဖိုးကို မိမိစစ်စေချင်သော column တစ်ခုခြင်းစီကို orwhere ဖြင့် စစ်ပေးမည 
                // method 1 
                // $query -> where("classdate","LIKE","%".$getsearch."%") 
                // ->orwhere("created_at","LIKE","%".$getsearch."%")
                // ->orwhere("updated_at","LIKE","%".$getsearch."%");

                // method 2
                // $query-> where("classdate","LIKE","%".$getsearch."%") ;
                // $query-> orwhere("created_at","LIKE","%".$getsearch."%");
                // $query-> orwhere("updated_at","LIKE","%".$getsearch."%");


                // orwhereHas(relation,callbackfunction); // foreign key ပေးထားသော related tagble အား belongTo ဖြစ်ခေါ်ထားသော method  ကို string ဖြင့် ရေးပေးရမည် 
                // $query -> where("classdate","LIKE","%".$getsearch."%") 
                // ->orwhere("created_at","LIKE","%".$getsearch."%")
                // ->orwhere("updated_at","LIKE","%".$getsearch."%")
                // ->orwhereHas("post",function($query) use($getsearch){ // global ဖြစ်သောကြောင့် functin ထဲယူသုံးနိုင်ရန် use လုပ်ပေးခြင်းဖြစ်သည် "post" သည် belong To ခေါ်ထားသော method name ဖြစ်သည် 
                //     $query -> where("title","LIKE","%".$getsearch."%"); // post table ထဲရှိ title များအား စစ်မည် 
                // });


            }
        });


    }

    // filter ချထားသော data များကိုသာ searc လုပ်နိုင်ရန် if ဖြင် funciton ထပ်လုပ်လိုက်ခြင်းဖြစ်သည် 
    public function scopesearchonly($query){
        if($getsearch = request("search")){

            //orwhereHas(relation,callbackfunction); // foreign key ပေးထားသော related tagble အား belongTo ဖြစ်ခေါ်ထားသော method  ကို string ဖြင့် ရေးပေးရမည် 
            $query -> where("classdate","LIKE","%".$getsearch."%") 
            ->orwhere("created_at","LIKE","%".$getsearch."%")
            ->orwhere("updated_at","LIKE","%".$getsearch."%")
            ->orwhereHas("post",function($query) use($getsearch){ // global ဖြစ်သောကြောင့် functin ထဲယူသုံးနိုင်ရန် use လုပ်ပေးခြင်းဖြစ်သည် "post" သည် belong To ခေါ်ထားသော method name ဖြစ်သည် 
                $query -> where("title","LIKE","%".$getsearch."%"); // post table ထဲရှိ title များအား စစ်မည် 
            });


        }
    }
    
}
