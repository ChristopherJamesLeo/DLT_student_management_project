@extends("layouts.adminindex")
@section("css")
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endsection
@section("caption","Country List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">

        <div class="col-md-12 my-3">
           <div class="col-md-6"></div>
                <form action="townships" method="POST" enctype="multipart/form-data" class="">

                     {{csrf_field()}}
                     @method("POST")
                    <div class="row">
                        <div class="col-md-2 col-sm-12 form-group mb-1">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control rounded-0 country_id">
                                <option selected disabled>Choose a Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country['name']}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2 col-sm-12 form-group mb-1">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control rounded-0 city_id">
                                <option selected disabled>Choose a City</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city['name']}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2 col-sm-12 form-group mb-1">
                            <label for="region_id">Region</label>
                            <select name="region_id" id="region_id" class="form-control rounded-0 region_id">
                                <option selected disabled>Choose a Region</option>
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}">{{$region['name']}}</option>
                                @endforeach

                            </select>
                        </div>


                         <div class="col-md-3 col-sm-12 form-group mb-1">
                             <label for="name">Township <span class="text-danger">*</span></label>
                             @error("name")
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                             <input type="text" name="name" id="name" class="form-control rounded-0 @error("name") is-invalid @enderror" placeholder="Enter Township" value="{{old('name')}}">
                         </div>
                         <div class="col-md-3 col-sm-12 form-group mb-1">
                            <label for="status_id">Status</label>
                            <select name="status_id" id="status_id" class="form-control rounded-0">
                               @foreach($statuses as $status)
                                   <option value="{{$status->id}}">{{$status['name']}}</option>
                               @endforeach

                            </select>
                        </div>

                         <div class="col-md-12">
                             <div class="d-flex justify-content-end">

                                 <button type="reset" class="btn btn-secondary btn-sm rounded-0 ms-3">Cancel</button>
                                 <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                             </div>
                         </div>

                     </div>
                 </form>
            <hr>
        </div>

        <div class="col-md-12">
            <form action="" method="">
                <div class="row justify-content-end">
                    <div class="col-md-2 col-sm-6 mb-2">
                        <div class="input-group">
                            <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search...">
                            <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <table id="mytable" class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Region</th>
                    <th>Country</th>

                    <th>Status</th>
                    <th>By</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($townships as $idx=>$township)

                <tr>

                    {{-- <td>{{++$idx}}</td> --}}
                    <td>{{$idx + $townships -> firstItem()}}</td>

                    <td>{{$township->name}}</td>
                    <td>{{$township->city->name}}</td>
                    <td>{{$township->region->name}}</td>
                    <td>{{$township->country->name}}</td>

                    <td>
                        <div class="form-checkbox form-switch">
                            <input type="checkbox" name="" id="" class="form-check-input change-btn" {{$township->status_id == "3" ? "checked" : ""}}
                            {{-- type ကိုပြင်ရန် id သတ်မှတ်ရမည် --}}
                            data-id = {{$township->id}}
                            >
                        </div>
                    </td>
                    <td>{{$township->user["name"]}}</td>

                    <td>{{$township->created_at->format('d m Y')}}</td>
                    <td>{{$township->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form"
                           data-bs-toggle="modal"
                           data-bs-target="#editmodal"
                           data-id="{{$township->id}}"
                           data-name="{{$township->name}}"
                           data-country_id = "{{$township->country_id}}"
                           data-city_id="{{$township->city_id}}"
                           data-region_id="{{$township->region_id}}"
                           data-status = "{{$township->status_id}}"><i class="fas fa-pen"></i></a>

                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$township->id}}" ><i class="fas fa-trash"></i></a>

                    </td>
                    <form id="formdelete{{$township->id}}" action="{{route('townships.destroy',$township->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>






                </tr>

                @endforeach
            </tbody>


        </table>

        {{$townships -> links("pagination::bootstrap-4")}}

    </div>
    <!--End Content Area-->

    <!-- singe page upload -->
    <!-- START MODAL AREA-->
        <!-- start edit modal -->
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editform_action" action="" method="POST" enctype="multipart/form-data" class="">

                            {{csrf_field()}}
                            {{ method_field("PUT") }}

                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="editcountry_id">Country</label>
                                    <select name="editcountry_id" id="editcountry_id" class="form-control rounded-0 country_id">
                                        <option selected disabled>Choose a Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="editcity_id">City</label>
                                    <select name="editcity_id" id="editcity_id" class="form-control rounded-0 city_id">
                                        <option selected disabled>Choose a City</option>
{{--                                        @foreach($cities as $city)--}}
{{--                                            <option value="{{$city->id}}">{{$city['name']}}</option>--}}
{{--                                        @endforeach--}}

                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="editregion_id">City</label>
                                    <select name="editregion_id" id="editregion_id" class="form-control rounded-0 region_id">
                                        <option selected disabled>Choose a City</option>
{{--                                        @foreach($regions as $region)--}}
{{--                                            <option value="{{$region->id}}">{{$region['name']}}</option>--}}
{{--                                        @endforeach--}}

                                    </select>
                                </div>

                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="editname" id="editname" class="form-control rounded-0" placeholder="Enter Status Name" value="{{old('editname')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="status_id">Status</label>
                                    <select name="status_id" id="editstatus_id" class="form-control rounded-0">
                                       @foreach($statuses as $status)
                                           <option value="{{$status->id}}">{{$status['name']}}</option>
                                       @endforeach

                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>

        </div>
        <!-- end edit modal -->
    <!-- END MODAL AREA -->




@endsection

@section("scripts")
{{-- datatable css1 js1 --}}
{{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    <script>



        $(document).ready(function(){

            // start dynamic select option
            $(document).on("change",".country_id",function (){
                const getcountryid = $(this).val();
                console.log(getcountryid);
                let opforcity = '';
                let opforregion = '';
                $.ajax({
                    url: `/api/filter/cities/${getcountryid}`,
                    type : "GET",
                    dataType : "json",
                    success : function (response){
                        // console.log(response);
                        $('.city_id').empty();
                        $('.region_id').empty();
                        opforcity += `<option selected disabled>Choose a City</option>`;
                        opforregion += `<option selected disabled>Choose a Region</option>`;

                        for(let x = 0 ; x < response.data.length ; x++){
                            opforcity += `<option value='${response.data[x].id}'>${response.data[x].name}</option>`;
                        }

                        $(".city_id").append(opforcity);
                        $(".region_id").append(opforregion);
                    },
                    error: function (response){
                        console.log("Error", response);
                    }

                })
            })

            $(document).on("change",".city_id",function (){
                const getcityid = $(this).val();
                console.log(getcityid);
                let opforregion = '';
                $.ajax({
                    url: `/filter/regions/${getcityid}`,
                    type : "GET",
                    dataType : "json",
                    success : function (response){
                        // console.log(response);
                        $('.region_id').empty();
                        opforregion += `<option selected disabled>Choose a Region</option>`;

                        for(let x = 0 ; x < response.data.length ; x++){
                            opforregion += `<option value='${response.data[x].id}'>${response.data[x].name}</option>`;
                        }

                        $(".region_id").append(opforregion);

                    },
                    error: function (response){
                        console.log("Error", response);
                    }

                })
            })
            // end dynamic select option

            // start delete item
            $(".delete-btns").click(function(){
                // console.log("hello");
                var getidx = $(this).data("idx");

                // console.log(getidx);

                if(confirm(`Are Your Sure!! You want to delete ${getidx}`)){
                    $("#formdelete"+getidx).submit();
                }else{

                }
            })
            // end delete item

            // start edit form
                // single page upload
            $(document).on("click",".edit_form",function(e){
                e.preventDefault();
                // console.log("hello");
                // console.log($(this).attr("data-name"));
                // console.log($(this).data("id"));
                $("#editname").val($(this).data("name"));
                $("#editstatus_id").val($(this).data("status"));
                $("#editcountry_id").val($(this).data("country_id"));
                $("#editregion_id").val($(this).data("region_id"));
                $("#editcity_id").val($(this).data("city_id"));

                const getid = $(this).data("id");
                console.log(getid);


                // $("#editform_action").attr('action',`\{\{route('statuses.update',$status->id)\}\}`); // error

                // use method 1
                // $("#editform_action").attr('action',`http://127.0.0.1:8000/statuses/${getid}`);

                // method 2
                $("#editform_action").attr('action',`/townships/${getid}`);

            })


            // end edit form

            // $("#mytable").DataTable();

            $(".change-btn").click(function(){
                let getId = $(this).data("id");

                var setStatus_id =  $(this).prop("checked") === true ? 3 : 4;

                $.ajax({
                    method : "GET",
                    url : "townshipsstatus",
                    dataType : "json",
                    data : {
                        "id" : getId,
                        "status_id" : setStatus_id
                    },
                    success : function(response){
                        console.log(response.success);
                    }
                })
            })

        })






    </script>
@endsection
