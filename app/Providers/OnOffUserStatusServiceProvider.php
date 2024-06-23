<?php


// custom provider ဖန်တီးပါက ထဲတွင် meddle မှာ kernal တွင် အသက်သွင်းသကဲ့သို့ config ထဲရှိ app.php ထဲတွင် အသက်သွင်းပေးရမည်

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\User;


// veriable မသိပါက  php artisan confit:clear / php artisan config:cache ကို run ပေးရမည် 
class OnOffUserStatusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // မိမိဘာသာ ဖန်တီးပါက register ထဲတွင် ရေးပေးရမည်
        View::composer("*",function($view){
            $onlineusers = User::Onlineusers();
            $offlineusers = User::Offlineusers();

            $view -> with(["onlineusers" => $onlineusers , "offlineusers" => $offlineusers]);

        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}


