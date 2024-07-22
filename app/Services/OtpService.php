<?php
// app အောက်တွင်မိမိဘာသာ services ဟူသော folder နှင့် OTP ဟူသော file အား တည်ဆောက်မည်ဖြစ်သည်
    namespace App\Services;
    use App\Models\Otp;
    use Illuminate\Support\Carbon;
    use App\Notifications\OtpEmailNotify;
    use Illuminate\Support\Facades\Notification;
    use Illuminate\Support\Facades\Auth;

    use Illuminate\Support\Facades\Mail;

    use App\Jobs\OtpMailJob;

    
   

    class otpservice {

        function generateotp($userid){
            $randomotp = rand(100000,999999); // နံပါတ် ၆ လံုးကို rand ဖြင့် custom ရိုက်ထုတ်ပေးနေမည်ဖြစ်သည် 
            $expires_at = Carbon::now()->addMinute(1); // expire ဖြစ်သွားအချိန်

            Otp::create([ // OTP ကို database မှာသိမ်းမည်
                'user_id' => $userid,
                'otp' => $randomotp ,
                'expires_at' => $expires_at,
            ]);


            $data = [
                "to" => Auth::user(),
                "subject" => "OTP",
                "content" => $randomotp,
            ];
        
            dispatch(new OtpMailJob($data));// Dispatch the email job
            
            // email notification
            // php artisan make:notification OtpEmailNotify
            // Send OTP via to email or SMS // ရလားသော OTP အား email ပို့မလား sms ပို့မလား ရေးနိုင်သည် 
            // Notification::send(Auth::user(),new OtpEmailNotify($randomotp,$expires_at));


            return $randomotp; // database မှာသိမ်းပြီးနောက် ရလာတဲ့ randomotp ကို return ပြန်မည်

        }

        function verifyotp ($userid,$otp){
            
            $checkotp = Otp::where('user_id',$userid)->where('otp',$otp)->where('expires_at', '>' , \Carbon\Carbon::now()->first()); // လက်ရှီ ရှိနေသော အချိန်ထပ်ကို ကြီးနေမှသာ expire ဖြစ်သွားမည်ဖြစ်ည် 

            if($checkotp){
                // OTP valid 
                $checkotp->delete(); // otp valid ဖြစ်ပါက ဖျက်ပလိုက်လု့ိရပြီ 
                return true;
            }else {
                // Otp invalid
                return false;
            }


        } 

    }

?>