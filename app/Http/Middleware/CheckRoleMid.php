<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRoleMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //  SINGLE PARAMETER ROLE
    // public function handle(Request $request, Closure $next , $rolename): Response
    // {
    //     if(!Auth::check() || !Auth::user() -> hasRole($rolename)){
    //         abort(403,"Unauthorized");
    //     }
    //     return $next($request);
    // }

    // MULTIPLE PARAMETER ROLE
    public function handle(Request $request, Closure $next , ...$rolename): Response
    {
        if(!Auth::check() || !Auth::user() -> hasRole($rolename)){
            // abort(403,"Unauthorized");
            return redirect()->back()->with("error","Unauthorized Permission Access");
        }
        return $next($request);
    }
}
