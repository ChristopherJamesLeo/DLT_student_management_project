<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ValidateSubscriptionMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // login လည်းဝင်ထားရမည် user ၏ subscription date သည် now ထပ်ကြီးနေရမည် 
        if(Auth::check() && Auth::user()->subscription_expires_at > now()){ // expire သည် လက်ရှိရှိနေသော date ထပ်ကြီးနေပါက page ကို ဆက်သွားမည်
            return $next($request);
        }
        // condition မှားနေပါက expired ကို redirect လုပ်ပေးမည်ဖြစ်သည် 
        return redirect()->route('subscription.expired');
    }
}


// auth()->user() or Auth::user();
// auth()->check() or Auth::check();