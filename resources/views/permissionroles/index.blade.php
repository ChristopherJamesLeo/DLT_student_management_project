@extends("layouts.adminindex")
@section("css")
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endsection
@section("caption","Role List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <form action="{{route('permissionroles.store')}}" method="POST">
                @csrf 
                @method("POST")
                <div class="row justify-content-end">
                   
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="form-group">
                            <select name="role_id" id="role_id" class="form-control rounded-0">
                                <option value="" selected disabled>Choose Role...</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="form-group">
                            <select name="permission_id" id="permission_id" class="form-control rounded-0">
                                <option value="" selected disabled>Choose Permission...</option>
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary rounded-0">Create</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
        </div>
        
        <div>
            <table id="mytable"  class="table table-hover border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th>Create At</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach($permissionroles as $idx=>$permissionrole) 
                    
                    <tr>
    
                        {{-- <td>{{++$idx}}</td> --}}
                        <td>{{$idx+ $permissionroles->firstItem()}}</td>

                        <td>{{$permissionrole->role->name}}</td>
                        <td>{{$permissionrole->permission["name"]}}</td>
                        <td>{{$permissionrole->created_at->format('d m Y')}}</td>
                        <td>{{$permissionrole->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$permissionrole->id}}" data-permission_id="{{$permissionrole->permission_id}}" data-role_id="{{$permissionrole->role_id}}"><i class="fas fa-pen"></i></a>
                            
                            <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$permissionrole->id}}" ><i class="fas fa-trash"></i></a>
    
                        </td>
                        <form id="formdelete{{$permissionrole->id}}" action="{{route('permissionroles.destroy',$permissionrole->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        
                        
                    </tr>
                    @endforeach
                </tbody>
                
            </table>

            {{$permissionroles->links("pagination::bootstrap-4")}}
        </div>
        
        
    </div>
    <!--End Content Area-->

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
                                <div class="col-md-12 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <select name="role_id" id="edit_role_id" class="form-control rounded-0">
                                            <option value="" selected disabled>Choose Role...</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <select name="permission_id" id="edit_permission_id" class="form-control rounded-0">
                                            <option value="" selected disabled>Choose Permission...</option>
                                            @foreach($permissions as $permission)
                                                <option value="{{$permission->id}}">{{$permission -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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

        console.log("hello");
        $(document).ready(function(){
            
            $(".delete-btns").click(function(){
               
                var getidx = $(this).data("idx");

                console.log(getidx);

                if(confirm(`Are Your Sure!! You want to delete ${getidx}`)){

                    // alert("hello");
                    $("#formdelete"+getidx).submit();
                }else{

                }
            })
            // $("#mytable").DataTable();

                        // start edit form
                // single page upload
            $(document).on("click",".edit_form",function(e){
                e.preventDefault();
                $("#edit_permission_id").val($(this).data("permission_id"));
                $("#edit_role_id").val($(this).data("role_id"));

                const getid = $(this).data("id");
                console.log(getid);
                // method 2
                $("#form_action").attr('action',`/permissionroles/${getid}`);
                
            })
            
            // end edit form

        })
    </script>
@endsection