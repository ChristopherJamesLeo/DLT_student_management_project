<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pageview;

class PageViewMid  // kernel ထဲတွင် သွားပြီးသုံးပေးရမည်
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $getpageurl = $request -> url(); // url ကို ယူမည် 
        $pageview = Pageview::firstOrCreate(['pageurl'=> $getpageurl]); // pageview table ထဲသို ့ ရှိလှျင် ဆွဲထုတ်မည် မရှိလှျင် ထပ်ထည့်မည်
        $pageview->increment("counter"); // pageurl ကို ယူပြီး counter column ကို 1 တိုးမည် 
        return $next($request);
    }
}
