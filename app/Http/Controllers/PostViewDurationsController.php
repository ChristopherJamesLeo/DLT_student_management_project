<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\PostViewDuration;


class PostViewDurationsController extends Controller
{
    public function trackduration(Request $request){
        // တွက်ချက်နိုင်ရန် laravel format ဖြစ်အောင်ပြောင်းပေးရမည် ထို့ကြောသ့် carbon ထဲကောက်ထည့်ပေးရမည် 
        $entrytime = Carbon::parse(Session::get("entrytime")); // session မှ value ကို ရယူရန်
        $exittime = Carbon::parse($request->input("exittime")); // front end မှယူရန်
        $postId = Session::get("post_id")->id; // post id ယူရန် // post နှင့် ပတ်သတ်သမှျ အားလံုး kernal မှထည့်ပေးလုိက်သည် 

        $userId = Auth::id();


        if ($entrytime && $exittime && $postId && $userId) {
            // Calculate duration in seconds
            // $durationInSecond = $entrytime->diffInSeconds($exittime);
            $durationInSecond = $entrytime->diffInMinutes($exittime);

            // Create a new PostViewDuration instance and save the data
            $postviewduration = new PostViewDuration();
            $postviewduration->user_id = $userId;
            $postviewduration->post_id = $postId;
            $postviewduration->duration = $durationInSecond;
            $postviewduration->save();

            // Clear session variables
            Session::forget("entrytime");
            Session::forget("post_id");

            // Return successful response
            return response()->json([
                "status" => "Successful",
                "entrytime" => $entrytime,
                "exittime" => $exittime,
                "post_id" => $postId,
                "duration" => $durationInSecond
            ]);
        }
        
       
    }
}
