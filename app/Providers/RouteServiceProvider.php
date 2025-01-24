<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Models\Role;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboards';  // log ဝင်ပြိးသည်နှင့် တန်းပေါ်စေချင်သော route ိကု ထည့်ပေးရမည် 

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        // web တွင် slug သုံးရန် ဒီထဲဝင်ရေးပေးရမည် 
        // For role slug 
        Route::bind("role",function($value){
            return Role::where("id",$value)
                            ->orWhere("slug",$value)->first(); // id ထဲမှာ ရှိရင် ID ကို return ပြန်မည် or slug ထဲမှာရှိရင်လဲ first ကို return ပြန်ပေးမည် 
        });

        
    }
}
