@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Type List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        <div class="col-md-12">
            <h1>Plan Management</h1>
            <p>Discover our popular services...</p>
        </div>

        <div class="loader_container">
            <div id="packagedata" class="row">

            </div>
            <div class=" loader">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
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

    // end pass header token
    $(document).ready(function(){
        // start fetch all data
        function fetchallpackagedata(){
            $.ajax({
                url: "{{route('plans.index')}}",
                method : "GET",
                beforeSend: function(){
                    // loading ပြန်*ရန် 
                    console.log('before');
                    $(".loader").addClass('show');
                },

                success : function(response){
                    // console.log(response);
                    $("#packagedata").html(response);
                },
                complete : function(){ // complete ဖြစ်လှျင် ပြမည် 
                    console.log("complete");
                    $(".loader").removeClass('show');

                }
            })
        }

        fetchallpackagedata();

        // end fetch all data

        // Start add cart packate
        $(document).on("click",".add-to-cart",function(){
            // console.log("hi");
            const packageid = $(this).data('package-id');
            const packageprice = $(this).data('package-price');

            // console.log(packageid,packageprice);

            $.ajax({
                url : "{{route('carts.add')}}",
                type : "POST",
                data : {
                    package_id : packageid,
                    quantity : 1,
                    price : packageprice
                },
                success : function(response){
                    console.log(response.message);
                }
            })
        })

        // end add cart package



    })
</script>

@endsection