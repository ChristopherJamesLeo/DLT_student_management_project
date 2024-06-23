<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OnOffUserStatusListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // handle ထဲ တွင် ရေးပေးရမည် 
    public function handle(object $event): void
    {
        $user = $event -> user; // user ဟုရေးသည်နှင့် user model ကို သံုးမည်ကို တန်းသိမည်ဖြစ်သည် name ဖြင့် ခေါ်သံုးသောကြာင့် user ကို use လုပ်စရာမလိုပေ
        $user -> is_online = false;
        $user -> save() ;
    }
}
