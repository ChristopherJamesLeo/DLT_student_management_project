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
                    <span>You have 5 items in your carts</span>
                </div>
            </div>
            <div class="col-md-4">
                <h6>Payment details</h6>
                <hr>
                <div class="d-flex justify-content-between px-3">
                    <span>Total</span>
                    <span class="">0</span>
                </div>
                <div class="d-flex justify-content-between px-3">
                    <span>Payment Method</span>
                    <span class="">Point Pay</span>
                </div>
                <div class="d-grid ">
                    <button type="button" id="paybypoints" class="btn btn-primary btn-sm mt-3 rounded-0">Pay Now</button>
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

</script>

@endsection