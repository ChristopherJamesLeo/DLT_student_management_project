<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!-- bootstarp လဲသု့ုးနုိင်သည် -->
    <style>
        body{
            font-size: 12px;
            padding: 20px;
            margin: 0;
        }

        .card-body {
            text-indent: 50px;
            text-align: justify;
        }

        .list-unstyled {
            list-style: none;
            padding: 0;
            margin: 0;
        }

    </style>
</head>
<body>
    <section>
        <b>Dear Student</b>
    </section>
    <section>
        <div class="card">
            <div class="card-body">
                <span></span>
                {{-- content သည်ဝင်လာမည်ဖြစသ်ည် summer note error ကို ရှင်းထားသည်  --}}
                <h4>{!! $data['content'] !!}</h4>
              
            </div>
        </div>
    </section>

    <section>
        <ul class="list-unstyled">
            <li>Best Regard,</li>
            {{-- app.name ကို ယူသံုးထားသည်  --}}
            <li>{{config("app.name")}}</li>


        </ul>
    </section>

</body>
</html>