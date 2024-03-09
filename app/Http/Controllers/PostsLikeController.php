<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Post;

class PostsLikeController extends Controller
{
    public function like(Post $post){  // post များလိုချငိသောေကြာင့် post အားလံုး like functionထဲသို့ ရောက်လာမည် use လုပ်ပေးဖို့လိုအပ်သည်

        // dd($post);

        $user = Auth::user(); // user ကို လှမ်းခေ်မည် ထို့ကြောင့် model ထဲရှီ method များ သံုး နိုင်သည် 


        // attach ဖြင့် ထည့်မည်
        $user -> likes()->attach($post); // user ထဲရှီ like method မှ ရလာသော data ထဲတွင် Post ထဲရှိ data အားလံုး  attach ဖြင့် table ထဲသို့ ထည့်သွင်းမည်

        session()->flash("success","You Liked This Post");
        return redirect()->back();

    }

    public function unlike(Post $post){
         // dd($post);

        $user = Auth::user(); // user ကို လှမ်းခေ်မည် ထို့ကြောင့် model ထဲရှီ method များ သံုး နိုင်သည် 

        // detach ဖြင့် ဖျက်မည်
        $user -> likes()->detach($post); // user ထဲရှီ like method မှ ရလာသော data ထဲတွင် Post ထဲရှိ data အားလံုး  attach ဖြင့် table ထဲသို့ ထည့်သွင်းမည်
        
        session()->flash("success","You Unliked This Post");
        return redirect()->back();
    }
}
