<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class AutoLogoutMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            // $dueinactivetime = config("session.lifetime"); // config ထဲရှိ session fie ထဲရှိ lifetime ဟူသော variable ကိုလှမ်းခေါ်မည် 
            $dueinactivetime = config("session.lifetime") * 60; // convert mintues to second
            $lastactivity = Session::get("lastactivity",now()); // keep on session 

                        // အချိန် အား diff ရှာမည် 
            if(now() ->diffInSeconds($lastactivity) > $dueinactivetime) {
                Auth::logout();  // logout ဖစ်မည်
                Session::flush(); // session အားလုံးဖျက်မည်

                return redirect()->route("login")->with('message',""); // login ကိုပို့ပေးမည် 
            }

            // Update the last activity time 

            Session::put("lastactivity",now()); // lastactivity ကို တောက်လျှောက် update ဖြစ်နေအာ်င် လုပ်ရမည် သို့မှသာ diff ရှာရတာ အဆင်ပြေမည်
            
            
        }
        return $next($request);
    }
}


// php artisan make:middleware AutoLogoutMid