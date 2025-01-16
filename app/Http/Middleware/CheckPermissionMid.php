<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $permissionname): Response
    {
        if(!Auth::check() || !Auth::user() -> hasPermission($permissionname)){
            // abort(403,"Unauthorized");
            return redirect()->back()->with("error","Unauthorized Permission Access");
        }
        return $next($request);
    }

}
