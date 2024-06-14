<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatEvent;

class ChatsController extends Controller
{
    public function sendmessage(Request $request){
        $message = $request->sms; 

        // ဖန်တီးခဲ့သော သက်ဆိုင်ရာ event ကို လှမ်းခေါ်ပေးရမည်
        broadcast(new ChatEvent($message)); // event method ဖြင့် ေခါ်ေပးရမည် 

        return response()->json(["status" => "Message sent"]);

        // go to event file

    }
}
