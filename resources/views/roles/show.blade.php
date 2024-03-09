@extends("layouts.adminindex")

@section("caption","Role List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <a href="{{route('roles.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>

            <hr>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card rounded-0">
                    <div class="card-body">
                        <h5 class="card-title">{{$role -> name}} | <small class="text-muted">{{$role -> status["name"]}}</small></h5>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item fw-bold"><img src="{{asset($role->image)}}" class="" style="width:100px;height:100px" alt="{{$role->image}}"></li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fas fa-user fa-sm me-2"></i><span>{{$role["user"]["name"]}}</span>
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-calendar fa-sm me-2"></i><span>{{date("d M Y ",strtotime($role->created_at))}} | {{date("h:m:s a ",strtotime($role->created_at))}}</span>
                                <br>
                                <!-- date(fomat type , databaseမှvalue အား string ပြောင်းရန် strtotime() သုံးပေးရမည်) -->
                                <i class="fas fa-edit fa-sm me-2"></i><span>{{date("d M Y h:m:s A",strtotime($role->updated_at))}}</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-8">
                <div class="card rounded-0">
                    <ul class="list-group rounded-0 text-center">
                        <li class="active list-group-item">Information</li>
                    </ul>

                    <!-- start remark  -->
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nothing To Show</td>
                            </tr>
                        </tbody>
                        
                    </table>
                    <!-- end remark -->
                </div>
            </div>
        </div>
    </div>
    <!--End Content Area-->




@endsection

@section("scripts")

    <script>
        $(document).ready(function(){
            $(".delete-btns").click(function(){
                // console.log("hello");
                var getidx = $(this).data("idx");

                // console.log(getidx);

                if(confirm(`Are Your Sure!! You want to delete ${getidx}`)){
                    $("#formdelete"+getidx).submit();
                }else{

                }
            })
        })
    </script>
@endsection