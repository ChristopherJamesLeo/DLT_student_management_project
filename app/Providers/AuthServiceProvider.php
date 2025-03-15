<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\Leave;
use App\Policies\AnnouncementPol;
use App\Policies\PostPol;
use App\Policies\LeavePol;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Announcement::class => AnnouncementPol::class, 
        Post::class => PostPol::class, 
        Leave::class => LeavePol::class, 
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this -> registerPolicies();  // -> policy အား on ပေးရမည် 

        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');   // default

        Passport::loadKeysFrom(base_path("secrets/oauth"));

        // check file found or not 
        // if(!file_exists(base_path('secrets/oauth/private.key')) || !file_exists(base_path('secrets/oauth/public.key'))){
        //     \Log::error("auth key are missioing");
        // }else {
        //     \Log::error("auth key are found");
        // }


        // authorize permission ခွဲနိုင်သည် 
    }
}


// 12 Jan 2025 27:30 min