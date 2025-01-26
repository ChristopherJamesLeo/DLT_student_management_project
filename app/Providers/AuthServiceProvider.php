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
    }
}
