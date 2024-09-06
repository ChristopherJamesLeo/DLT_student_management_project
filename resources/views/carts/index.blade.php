@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Type List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid ">
        <div class="row px-3 mt-3">
            <div class="col-md-8 mb-3">
                <h6><a href="{{route('plans.index')}}" class="nav-link">Continue Shoppig</a></h6>
                <hr>

                <div class="text-center">
                    <span>You have {{Auth::user()->carts()->count()}} items in your carts</span>
                </div>

                @foreach ($carts as $idx => $cart)
                    <div data-packageid = "{{$cart->package['id']}}" id="package_{{$cart->id}}" class="mt-3 p-2 d-flex justify-content-between align-items-center package">
                        <div>
                            <span>{{++$idx}}</span>
                            <span>{{$cart->package->name}}</span>
                            
                        </div>
                        <div>
                            <span>{{$cart->package->duration}} days</span>
                        </div>
                        <div>
                            <span class="me-3">{{$cart->price}} x {{$cart->quantity}}</span>
                            <a href="javascript:void(0)" class="removefromcart" data-cartid = "{{$cart->id}}" data-packageid="{{$cart->package->id}}"><i class="fas fa-trash text-danger"></i></a>
                            
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <h6>Payment details</h6>
                <hr>
                <div class="d-flex justify-content-between px-3">
                    <span>Total</span>
                    <span class="">{{$totalcost}}</span>
                </div>
                <div class="d-flex justify-content-between px-3">
                    <span>Payment Method</span>
                    <span class="">Point Pay</span>
                </div>
                <div class="d-grid ">
                    <button type="button" id="paybypoints" class="btn btn-primary btn-sm mt-3 rounded-0"  >Pay Now</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Content Area-->

    {{-- start verification box --}}
        <!-- start OTP modal -->
        <div id="otpmodal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        {{-- <form id="form_action" action="" method="POST" enctype="multipart/form-data" class="">  --}}
                        <form id="verifyform" > 

                            {{-- {{csrf_field()}}
                            {{ method_field("PUT") }} --}}
                            <input type="hidden" name="edituser_id" id="user_id" value="{{$userdata['id']}}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-3">
                                    <label for="otpcode">OTP Code <span class="text-danger">*</span></label>
                                    <input type="text" name="otpcode" id="otpcode" class="form-control rounded-0" placeholder="Enter Status Name" >
                                </div>

                                 <input type="hidden" name="otpuser_id" id="otpuser_id" value="{{$userdata['id']}}">

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">

                                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                    </div>
                                </div>

                               

                            </div>

                            <p id="optmessage"></p>
                            <p>Exprie in : <span id="otptimer"></span>Seconds</p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- end OTP modal -->
    {{-- end verification box --}}


    <!-- END MODAL AREA -->




@endsection

@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection

@section("scripts")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    // Start Pass Header Token
    // header token ကို စကတညါးကပို့ထားမည် 
    $.ajaxSetup(   // ajax ဖြင့် စကတည်းက ပို့ထားမည် csrf ကို ပို့ထားမည် 
        {
            headers : { 
                // header အား သံုးနုိင်ရန် html ရှိ header ထဲတွင် meta tag ဖြင့် attribute name = "csrf-token" content="{{csrf_token()}}"
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("content"), // meta tag ထဲတွင် ရှိသော value အား ယူမည် 
            }
        }
    )
    $(document).ready(function(){
        // remove from cart

        $(document).on("click",".removefromcart",function(){
            // console.log($(this).data('packageid'));
            let packageId = $(this).data('packageid');
            let getcartid = $(this).data("cartid");
            $.ajax({
                url : "{{route('carts.remove')}}",
                type : "POST",
                data : {
                    _token : "{{csrf_token()}}",
                    packageid : packageId
                },
                success : function (response){
                    console.log(response.message);
                    $("#package_"+getcartid).remove();

                },
                error : function (respose){
                    console.log(respose);
                }
            })
        })
        // end remove from cart

        // start pay by point
        $("#paybypoints").click(function(){
            let packageid;
            console.log("hi");
            Swal.fire({
                    title: "Processing...!",
                    text: "Please wait while sending your OTP .",
                    allowOutsideClick: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        
                    },
                
                });

            
                $.ajax({
                    url : "/generateotps",
                    type : "POST",
                    success : function(response){
                        console.log(response.otp);
                        Swal.close();
                        $("#optmessage").text("your otp code is " + response.otp);
                        $("#otpmodal").modal("show");
                        startotptimer(60); // otp will expire at 120 minutes ( 1 minutes)
                    },
                    error: function(response){
                        console.log("Error",response);
                    }
                })

            // console.log(packageid);

        })
        // end pay py point
    })

     function startotptimer(duration){
        // let minutes, seconds;
        // let timer = duration;
    
        let timer = duration,minutes, seconds; // veriable တူတူဘဲဖြစ်သည်
        console.log(timer,minutes,seconds);
        let setinv=setInterval(dectimer, 1000);
        $("#otptimer").text(`${minutes} : ${seconds}`);
        
        function dectimer(){
            minutes = parseInt(timer/60,10); // 10 သည် default ဖြစ်သည် 
            seconds = parseInt(timer%60);
            // console.log(parseInt("123 hello")) // -> return 123 ဘဲထွက်မည်ဖြစ်သည် 
            // console.log(parseInt("123",10)) // -> return 123 ဘဲထွက်မည်ဖြစ်သည်  10 သည် base 10 ကို ဆိုလိုသည်
            // console.log(parseInt("    123 ",10)) ; // 123 ဘဲထွက်မည် 
            // console.log(parseInt("0123 ",10)) ; // 0 ဘဲထွက်မည် 
            minutes = minutes < 10 ? "0"+minutes : minutes;
            seconds = seconds < 10 ? "0"+seconds : seconds;
            $("#otptimer").text(`${minutes} : ${seconds}`);
            if(timer-- < 0){
                clearInterval(setinv);
                $("#otpmodal").modal("hide");
            }
        }
        
    }

    $("#verifyform").on("submit",function(e){
        e.preventDefault();
        console.log("hello");
        $.ajax({
            url : "/verifyotps",
            type : "POST",
            data: $(this).serialize(),
            success : function(response){
                if(response.message){
                    packageid = $(".package").data('packageid');
                    console.log(packageid);
                    $.ajax({
                        url: "{{ route('carts.paybypoints') }}", 
                        type: "POST",
                        data: {
                            _token : "{{csrf_token()}}", 
                            packageid: packageid,
                        },
                        success : function(response){
                            $("#otpmodal").modal("hide");
                            window.alert(response.message);
                            location.reload();
                            
                            console.log(response.message);
                        },
                        error : function(response){
                            $("#otpmodal").modal("hide");
                            console.log(response);
                            window.alert(response.json.message);
                        }
                    })
                }
                
            },
            error : function(response){
                console.log("error at OTP", response);
            }
        })
    })


    // $(".package").each(function(){
    //             packageid = $(this).data('packageid');
    //             console.log(packageid);
    //             $.ajax({
    //                 url: "{{ route('carts.paybypoints') }}", 
    //                 type: "POST",
    //                 data: {
    //                     _token : "{{csrf_token()}}", 
    //                     packageid: packageid,
    //                 },
    //                 success : function(response){
    //                     window.alert(response.massage);
    //                     location.reload();
    //                     console.log(response.message);
    //                 },
    //                 error : function(response){
    //                     console.log(response);
    //                     window.alert(response.json.message);
    //                 }
    //             })
    //         })


</script>

@endsection