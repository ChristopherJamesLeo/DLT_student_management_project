<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


// php artisan make:middleware OnOffUserStatusMid 
class OnOffUserStatusMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){// log in ဝင်ထားသလား စစ်မည်
            $user = Auth::user();
            $user -> is_online = true;
            $user -> last_active = now();
            $user -> save();
        }
        return $next($request);
    }
}
