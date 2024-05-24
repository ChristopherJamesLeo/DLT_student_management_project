   <!--Start Footer Section-->
   {{-- <footer class="footers">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Ninth Programming</h2>
            <span>copy right 2024</span>
        </div>
   </footer> --}}
    <!--End Footer Section-->
    
    {{-- Start Modeal Area --}}
        {{-- Start quick search Modal --}}
        <div id="quicksearchmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Reault</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                        </ul>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        {{-- End quick search Modal --}}
    {{-- end Modal Area --}}


        <!--bootstrap js 1 version 5.3.0-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <!--jquery js 1-->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript"></script>

        <!--Chart js-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
        <script src="{{asset('assets/dist/js/app.js')}}" type="text/javascript"></script>
        <script>


            // Start Quick Search
            async function quicksearch(){
                let getsearch = $("#quicksearch").val();
                // axio ဖြင့် data ပို့မည့်အခါ para သံုးခုထည့်ပေးရမည်
                await $.post("{{route('students.quicksearch')}}",{
                    _token:$('meta[name="csrf-token"]').attr('content'),
                    keyword : getsearch, // ပို့လိုက်သော key name ဖြစ်သော keyword ဖြင့် BK တွင်ဖမ်းပေးရမည်
                },function(response){
                    // console.log(response);
                    showresult(response);
                });
            }

            function showresult(response){
                console.log(response.datas.length);
                let newlis=" ";
                $("#quicksearchmodal").modal("show");


                if(response.datas.length <= 0){
                    // console.log("no data");
                    newlis = `<li class="list-group-item">No data</li>`;


                }else {
                    
                    for(let i = 0 ; i < response.datas.length ; i++){
                        // console.log("llo");
                        newlis += `<li class="list-group-item">
                                <a href="{{URL::to('students/${response.datas[i].id}')}}">${response.datas[i].id} / ${response.datas[i].firstname} ${response.datas[i].lastname}</a>
                            </li>`;

                    }
                    // console.log(newlis);
                }

                

                $("#quicksearchmodal .modal-body ul.list-group").html(newlis);

                // clear form 
                $("#quicksearchform")[0].reset();
                // $("#quickform").trigger("reset");
            }

            $("#quicksearch_btn").click(function(e){
                e.preventDefault();

                quicksearch();
            })
            // End quick search
        </script>

        @yield("scripts")
    </body>
</html>