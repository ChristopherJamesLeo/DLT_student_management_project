
<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

  </script>
</head>
<body>
  <h1>Chat Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>

  <div>
    <div id="display">
        {{-- Message will show in here  --}}
        <div id="showmessage"></div>

        <input type="text" name="message" id="message" placeholder="Write Something...">
        <button type="button" id="send">Send</button>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script>
    $(document).ready(function(){
        console.log("hello");


    // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('a3714922c14fb66ed312', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('chat-channel');
            channel.bind('message-event', function(data) {
                // alert(JSON.stringify(data));

                $("#showmessage").append("<p>" + data.message + "</p>");


        });


        $("#send").click(function(){
            // console.log($("#message").val());
            const message = $("#message").val();
            // console.log(message);

            $.ajax({
                url : "/chatmessage",
                type : "POST",
                data : {
                    sms : message,
                    
                },
                headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success : function(response){
                    console.log(response);
                }
                
            })
        })
    })


  </script>
</body>
</html>