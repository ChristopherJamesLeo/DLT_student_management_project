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


    <!-- END MODAL AREA -->




@endsection

@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection

@section("scripts")
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

            $(".package").each(function(){
                packageid = $(this).data('packageid');
                console.log(packageid);
                $.ajax({
                    url: "{{ route('carts.paybypoints') }}", 
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}", 
                        packageid: packageid,
                    },
                    success : function(response){
                        window.alert(response.massage);
                        location.reload();
                        console.log(response.message);
                    },
                    error : function(response){
                        console.log(response);
                        window.alert(response.json.message);
                    }
                })
            })
            // console.log(packageid);

        })
        // end pay py point
    })



</script>

@endsection