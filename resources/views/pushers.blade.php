{{-- testing pusher --}}

<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> 

</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>

  <div id="display">

  </div>

  <input type="text" id="message" placeholder="Write something...">
  <button type="button" id="send">Send</button>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>

        $(document).ready(function(){
            console.log("hello");
                    // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true; // pusher js ကို လှမ်းေခါ်ထားသည် bodyအေပါ်တွင် ထည့်ပေးရမည် // operation run လှျင် ထုတ်ပြရန် မလိုပေ ကုဒ်စမ်းနေပါက ချိတ်မိမချိတ်မိသိရန် ထုတ်ကြည့်သင့်သည် 

            var pusher = new Pusher('a3714922c14fb66ed312', {  // app key ထည့်ပေးရမည် 
            cluster: 'ap1'  // cluster ထည့်ပေးရမည် 
            });

            var channel = pusher.subscribe('my-channel'); // channel တစ်ခုရှိရမည် event // တစ်ခုရှိရမည် ဖန်တီးပေးရမည် channel ကို chat-channel // channel မှန်းသိအောင် channel ရေးထည့်ရေးပေးရမည်
            channel.bind('my-event', function(data) {  // message event မှန်းသိေအာင် message-event ဟုပေးသည်
                // alert(JSON.stringify(data));
                console.log(data);
            });
        })


  </script>
</body>