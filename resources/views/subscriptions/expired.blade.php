@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Type List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        <div class="col-md-12">
            <h1>Soubscription Expired</h1>
            <p>Your Lincense has expired. Please contact support or <a href="{{route('plans.index')}}">click here</a> to renew your subscription</p>
        </div>
        
    </div>
    <!--End Content Area-->


    <!-- END MODAL AREA -->




@endsection

@section("scripts")


@endsection