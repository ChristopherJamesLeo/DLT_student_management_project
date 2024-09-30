<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegisterationStepMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */                                                // parameter သည် $next, နောက်တွင်ဝင်လာမည်ဖြစ်သည်
    public function handle(Request $request, Closure $next,$step): Response
    {
        $regdatas = $request->session()->get('registerationdatas');

        if($step === "step2" && !$regdatas){  // para ထဲရှိ value နှင့်ညီခဲ့သလား
            return redirect()->route('register.step1')->with('error','You must be complete step 1');
        }elseif($step === "step3" && (!$regdatas || !isset($regdatas['lead']))){  // value ပါလား မပါလား စစ်ပြီး route ကိုပြန်ညွန်းထားသည်
            return redirect()->route('register.step2')->with('error','You must be complete step 2');
        }
        return $next($request);
    }
}
