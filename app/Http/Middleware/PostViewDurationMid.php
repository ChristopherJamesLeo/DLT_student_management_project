<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session; // sesison ထဲတွင်သိမ်းနို်ငသည် 

class PostViewDurationMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request -> route("post"); // route သည် မည်သည့် route ကို ေစာင့်ကြည့်မလဲ သိနိုင်သည် // post route ကို စောင့်ကြည့်မည် s ထည့်စရာမလို route သည် post id ရလာမည်ဖြစ်သည် 
        // dd($post);
        if($post) {
            Session::put("entrytime",now()); // လက်ရှိအချိန်ကို ယူမည်
            Session::put("post_id",$post); // put ဖြင့်  session ထဲတွင် ထည့်သိမ့်မည်
            
        }

        return $next($request);
    }
}
