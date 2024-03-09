@extends("layouts.adminindex")
@section("css")
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endsection
@section("caption","City List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
           <div class="col-md-12"></div>
                <form action="{{route('cities.store')}}" method="POST" enctype="multipart/form-data" class=""> 

                     {{csrf_field()}}
                     @method("POST")

                     <div class="row">
                         <div class="col-md-12 col-sm-12 form-group mb-1">
                             <label for="name">Name <span class="text-danger">*</span></label>
                             @error("name") 
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                             <input type="text" name="name" id="name" class="form-control rounded-0 @error("name") is-invalid @enderror" placeholder="Enter Status Name" value="{{old('name')}}">
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
                            <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request("filtername")}}">
                            {{-- ရှာထားပြိးသား vlaue ကို ပြန်ယူတည့်ရန်  --}}
                            {{-- <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button> --}}
                            {{-- <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button> --}}

                            {{-- with javascript --}}
                            <button type="button" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    
        <table id="mytable"  class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>By</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cities as $idx=>$city) 
                    
                <tr>

                    {{-- <td>{{++$idx}}</td> --}}
                    <td>{{$idx+ $cities->firstItem()}}</td>
                    
                    <td>{{$city->name}}</td>
                    <td>{{$city->user["name"]}}</td> 

                    <td>{{$city->created_at->format('d m Y')}}</td>
                    <td>{{$city->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$city->id}}" data-name="{{$city->name}}"><i class="fas fa-pen"></i></a>
                        
                        
                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$city->id}}" ><i class="fas fa-trash"></i></a>
 
                    </td>
                    <form id="formdelete{{$city->id}}" action="{{route('cities.destroy',$city->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    

                    

                    
                    
                </tr>
               
                @endforeach
            </tbody>
            
            
        </table>

        {{$cities->links("pagination::bootstrap-4")}}
        
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
                        <form id="form_action" action="" method="POST" enctype="multipart/form-data" class=""> 

                            {{csrf_field()}}
                            {{ method_field("PUT") }}

                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="editname" class="form-control rounded-0" placeholder="Enter Status Name" value="{{old('name')}}">
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

        // start filter 
        let getfilterbtn = document.getElementById("btn-search");
        getfilterbtn.addEventListener("click",function(e){
           
            const getfiltername = document.querySelector("#filtername").value;
            const getcururl = window.location.href;
            // console.log(getcururl);
            // console.log(getcururl.split("?"));
            // console.log(getcururl.split("?")[0]); လက်ရှိ route ကို ယူရန်

            window.location.href = getcururl.split("?")[0]  + "?filtername=" +getfiltername;
            e.preventDefault();
        })

        // end filter 


        $(document).ready(function(){
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

                const getid = $(this).data("id");

                // $("#form_action").attr('action',`\{\{route('statuses.update',$status->id)\}\}`); // error 

                // use method 1
                // $("#form_action").attr('action',`http://127.0.0.1:8000/statuses/${getid}`);

                // method 2
                $("#form_action").attr('action',`/cities/${getid}`);
                
            })
            
            // $("#mytable").DataTable();
            // end edit form
        })





        
    </script>
@endsection