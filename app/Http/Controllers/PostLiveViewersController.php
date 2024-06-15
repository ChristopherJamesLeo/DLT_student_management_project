<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Cache; // cache file ထဲတွင် သုံးရန်  
use App\Events\PostLiveViewerEvent;

class PostLiveViewersController extends Controller
{
    public function incrementviewer(Post $post){  // data အသေးအမွားများအား cache file ထဲတွင် သိမ်းနိုင်သည်
        $count = Cache::increment("postliveview-count_".$post->id); // cache ထဲတွင် postliveview-cout_postId ဖြင့် post တစ်ခုချင်းစီစာအတွက် သိမ်းမည် // object ဖြင့် သိမ်းထားရမည် 

        broadcast(new PostLiveViewerEvent($count , $post->id));

        return response()->json(['success'=>true]);
    }

    // ရှိနေသောကောင်စီမှ နှုတ်ပစ်မည် 
    public function decrementviewer(Post $post){
        $count = Cache::decrement("postliveview-count_".$post->id); // cache ထဲတွင် postliveview-cout_postId ဖြင့် post တစ်ခုချင်းစီစာအတွက် သိမ်းမည် // object ဖြင့် သိမ်းထားရမည် 

        if($count < 0){
            $count = 0 ;
            Cache::put("postliveview-count_".$post->id , $count); // cache ထဲတွင် put ဖြင်ရှီနေသာ count value အား key name ဖြစ်သော postliveview ထဲသို့ ပြန်ထည့်မည် 
        }

        broadcast(new PostLiveViewerEvent($count , $post->id));

        return response()->json(['success'=>true]);
    }
}
