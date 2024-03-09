@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Enrolls List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('attendances.store')}}" method="POST" enctype="multipart/form-data" class=""> 

                     {{csrf_field()}}
                     @method("POST")

                     <div class="row">
                         <div class="col-md-4 col-sm-12 form-group mb-1">
                             <label for="classdate">Class Date <span class="text-danger">*</span></label>
                             <input type="date" name="classdate" id="classdate" class="form-control rounded-0" placeholder="Enter Attendance Name" value="{{old('classdate')}}">
                         </div>
                         <div class="col-md-4 col-sm-12 form-group mb-1">
                             <label for="post_id">Class</label>
                             @error("post_id")
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                             <select name="post_id" id="post_id" class="form-control rounded-0 @error("post_id") is-invalid @enderror">
                                <option selected disabled>Choose Class</option>
                                @foreach($posts as $post)
                                    <option value="{{$post->id}}">{{$post->title}}</option>
                                @endforeach
                                
                             </select>
                         </div>
                         <div class="col-md-4 col-sm-12 form-group mb-1">
                             <label for="attcode">Att Code <span class="text-danger">*</span></label>
                             @error("attcode")
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                             <input type="text" name="attcode" id="attcode" class="form-control rounded-0 @error("attcode") is-invalid @enderror" placeholder="Enter Attendance Name" value="{{old('attcode')}}">
                         </div>
                         
                         <div class="col-md-12">
                             <div class="d-flex justify-content-end">
                                 <button type="reset" class="btn btn-secondary btn-sm rounded-0 ms-3">Cancel</button>
                                 <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                             </div>
                         </div>

                     </div>
                 </form>
            </div>
        </div>

        <hr>

        <table id="mytable" class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Student Id</th>
                    <th>Class</th>
                    
                    <th>Stage</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($enrolls as $idx=>$enroll) 
                
                <tr>

                    <td>{{++$idx}}</td>
                    {{-- <td>{{$enroll ->student($enroll->user_id)}}</td> --}}
                    <td><a href="{{route('students.show',$enroll -> studenturl())}}">{{$enroll ->student($enroll->user_id)}}</a></td>
                    <td>{{$enroll ->post->title}}</td>
                    
                    <td>{{$enroll->stage->name}}</td>
                     
                    <td>{{$enroll->created_at->format('d m Y')}}</td>
                    <td>{{$enroll->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editmodal" 
                            data-id="{{$enroll->id}}" 
                            data-name="{{$enroll->name}}" 
                            data-status="{{$enroll->stage->id}}">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>

                    
                </tr>
                @endforeach
            </tbody>
            
        </table>
        
    </div>
    <!--End Content Area-->

        <!-- START MODAL AREA-->
        <!-- start edit modal -->
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-md modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_action" action="" method="POST" enctype="multipart/form-data" class=""> 

                            {{csrf_field()}}
                            {{ method_field("PUT") }}

                            <div class="row">
                                <div class="col-md-4 col-sm-12 form-group mb-1">
                                    <label for="editstage_id">Permission</label>
                                     <select name="stage_id" id="editstage_id" class="form-control rounded-0">
                                        @foreach($stages as $stage)
                                            <option value="{{$stage->id}}">{{$stage->name}}</option>
                                        @endforeach
                                     </select>
                                 </div>
                                <div class="col-md-8 col-sm-12 form-group mb-1">
                                     <label for="editpost_id">Remark</label>
                                     <textarea name="remark" class="form-control rounded-0" id="" cols="30" rows="3"></textarea>
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
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

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

            $(document).on("click",".edit_form",function(e){
                e.preventDefault();
                // console.log("hello");
                // console.log($(this).attr("data-name"));
                // console.log($(this).data("id"));
                $("#editname").val($(this).data("name"));
                $("#editstage_id").val($(this).data("status"));

                const getid = $(this).data("id");

                // $("#form_action").attr('action',`\{\{route('statuses.update',$status->id)\}\}`); // error 

                // use method 1
                // $("#form_action").attr('action',`http://127.0.0.1:8000/statuses/${getid}`);

                // method 2
                $("#form_action").attr('action',`/enrolls/${getid}`);
                
            })
            // for my table
            // let table = new DataTable('#mytable');
            $("#mytable").DataTable();
        })
    </script>
@endsection

<!-- edit show -->