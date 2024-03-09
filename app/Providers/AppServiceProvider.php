<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator; // paginatin ကို bootstrap 5 ကို default ပြောင်းရန် 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer("*",function($view){
            $view->with("userdata",Auth::user());
        });

        Paginator::useBootstrapFive(); // paginatin ကို bootstrap 5 ကို default ပြောင်းရန် 
    }
}
