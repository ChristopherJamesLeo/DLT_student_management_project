<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast  // event တစ်ခု ဖန်တီးပေးရမည်  // ShouldBroadcast ကို implements လုပ်ပေးရမ် 
{ 
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $message ; // getter ;
    
    public function __construct($message) // controller မှလာသော ကောင်အား လှမ်းပြီးရယူမည် 
    {
        $this -> message = $message;  // message ဖြင့် ပြန်သံုးပေးရမည် 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    // channel လုပ်ပေးရန် 
    public function broadcastOn(): array
    {
        // return [
        //     new PrivateChannel('chat-channel'), // တစ်ယောက်ချင်းစာပိုမှသာ သံုစသည် မိမိ ပို့ မည့် channel name ကို ပို့ပေးရမည်
        // ];

        return ['chat-channel'];
    }

    // event ရေးလုပ်ပေးရန်
    public function broadcastAs()
    {
        return 'message-event'; // array သံုးစရာမလိုပေ
    }
}
