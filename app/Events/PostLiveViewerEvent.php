<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostLiveViewerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $count;
    public $post_id;
    public function __construct($count,$post_id)
    {
        $this -> count = $count;
        $this -> post_id = $post_id;
    }


    public function broadcastOn(): array
    {
        return [
            "postliveviewer-channel_".$this -> post_id  // chanel ခွဲထုတ်ရန် / ***post တစ်ခုချင်းစီအတွက် channel ခွဲထုတ်ပေးမှသာ data မရောနေမည်ဖြစ်သည် 
        ];
    }

    public function broadcastAs()
    {
        return 'postliveviewer-event';
    }

}


// php artisan make:event PostLiveViewerEvent