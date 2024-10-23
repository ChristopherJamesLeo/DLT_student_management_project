<?php

namespace App\Http;

use App\Http\Middleware\CheckRegisterationStepMid;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */

    // page တိုင်းကို ဖြစ်စေချင်ပါက web အောက်တွင်သွားပေးမည် page တိုင်းကို မဖြစ်စေချင်ပါက Auth ထဲတွင် နမည်ပေးပြီး ၄င်း ပေးထားသော route အား web ထဲတွင်ပြန်သံုးမည်
    protected $middlewareGroups = [
        'web' => [  // web မှထုတ်ရန်
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,


            \App\Http\Middleware\PageViewMid::class,
            \App\Http\Middleware\PostViewDurationMid::class,
            \App\Http\Middleware\OnOffUserStatusMid::class,
           


        ],

        'api' => [ // Api မှထုတ်ရန်
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */


    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // page တိုင်းကို မဖြစ်စေချင်ဘဲ မိမိ ဖြစ်စေချင်သော page ကိုသာ ဖြစ်စေချင်သော ကြောင့် Auth ထဲတွင် alias name ပေးပြီး ၄င်း name အား web ထဲတွင်သွားရေးမည်ဖြစ်သည်
        'validate.subscriptions' => \App\Http\Middleware\ValidateSubscriptionMid::class, // 'validate.subscriptions' ၄င်း name အား web ထဲတွင်ပြန်သံုးမည်

        "check.registration.step" => \App\Http\Middleware\CheckRegisterationStepMid::class,

        "autologout" =>  \App\Http\Middleware\AutoLogoutMid::class,  // web route ကို restrist လုပ်နိုင်သည်
    ];
}
