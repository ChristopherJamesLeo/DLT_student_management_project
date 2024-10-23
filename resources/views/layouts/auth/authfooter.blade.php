

{{-- end Modal Area --}}

{{-- @vite(['public/assets/dist/js/app.js']) --}}
<!--jquery js 1-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript"></script>


{{-- toastr notification css1 js1 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- <script>
    @if(session()->has("success")) // sessin ထဲတွင် success ရှိနေမှ အလုပ်လုပ်မည်
        toastr.success('{{session()->get('success')}}', 'Successful')
    @endif

    @if(session()->has("info")) // sessin ထဲတွင် success ရှိနေမှ အလုပ်လုပ်မည်
        toastr.info('{{session()->get('info')}}', 'Information')
    @endif

    @if($errors) // form ထဲမှ ဖမ်းထားတဲ့ error အားလံဒးကို စုပေါင်းထာသည့်နေရာ array ဖြင့် ထုတ်ပေးသောကြောင့် loop ပတ်ပေးရမည်
        @foreach($errors->all() as $error) // input ရှိ error အားလုံးကို ဖမ်းပေးမည်ဖြ်ပြီး array ြဖင့် ထုတ်ပေးသော်ကြာင့် all() ဖြင့်ယူပြီး looping ပတ်ပေးရမည်
            toastr.error('{{$error}}',"Warning")
        @endforeach
    @endif
</script> --}}

<script>
    toastr.options= {
        "progressBar" : true,
        "closeButton" : true
    }
</script>
@if(session()->has("success"))  {{--// sessin ထဲတွင် success ရှိနေမှ အလုပ်လုပ်မည်  --}}
<script> toastr.success('{{session()->get('success')}}', 'Successful')</script>
@endif

@if(Session::has("info")){{--  // sessin ထဲတွင် success ရှိနေမှ အလုပ်လုပ်မည်  --}}
<script> toastr.info('{{session()->get('info')}}', 'Information')</script>
@endif

@if($errors){{-- // form ထဲမှ ဖမ်းထားတဲ့ error အားလံဒးကို စုပေါင်းထာသည့်နေရာ array ဖြင့် ထုတ်ပေးသောကြောင့် loop ပတ်ပေးရမည် --}}
@foreach($errors->all() as $error){{--  // input ရှိ error အားလုံးကို ဖမ်းပေးမည်ဖြ်ပြီး array ြဖင့် ထုတ်ပေးသော်ကြာင့် all() ဖြင့်ယူပြီး looping ပတ်ပေးရမည်  --}}
<script>toastr.error('{{$error}}',"Warning",{timeOut:5000}) </script>
{{-- warning တစ်ခုတည်းကိုဘဲ option ပေးခြင်းဖြစသ်ည  --}}
@endforeach
@endif
<!--custom js-->
{{-- <script src="{{asset('assets/dist/js/app.js')}}" type="text/javascript"></script> --}}
@vite(['public/assets/dist/js/app.js'])
{{-- vite သည် code များ အား compress လုပ်ထားပေးသည်  --}}
<script>

    $(document).ready(function (){
        // start dynamic select option
        $(document).on("change",".country_id",function (){
            const getcountryid = $(this).val();
            console.log(getcountryid);
            let opforcity = '';
            $.ajax({
                url: `/api/filter/cities/${getcountryid}`,
                type : "GET",
                dataType : "json",
                success : function (response){
                    // console.log(response);
                    $('.city_id').empty();
                    opforcity += `<option selected disabled>Choose a City</option>`;

                    for(let x = 0 ; x < response.data.length ; x++){
                        opforcity += `<option value='${response.data[x].id}'>${response.data[x].name}</option>`;
                    }

                    $(".city_id").append(opforcity);

                },
                error: function (response){
                    console.log("Error", response);
                }

            })
        })
        // end dynamic select option
    })

//     start loading form
    document.getElementById("stepform").addEventListener("submit",function(){
        document.getElementById("loader").classList.remove("d-none");
        document.getElementById("submitbtn").disabled = true;
        document.getElementById("submitbtn").innerText = "Please Wait";

    })
//     end loading form

</script>

@yield("scripts")
</body>
</html>
