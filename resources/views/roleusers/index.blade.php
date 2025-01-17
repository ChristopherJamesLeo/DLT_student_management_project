@extends("layouts.adminindex")
@section("css")
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endsection
@section("caption","Role List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <form action="{{route('roleusers.store')}}" method="POST">
                @csrf 
                @method("POST")
                <div class="row justify-content-end">
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="form-group">
                            <select name="user_id" id="user_id" class="form-control rounded-0">
                                <option value="" selected disabled>Choose User...</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                            <button type="submit" class="btn btn-primary rounded-0">Create</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
        </div>
        <div class="col-md-12">
            <form action="" method="">
                <div class="row justify-content-end">
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="form-group">
                            <select name="filterstatus_id" id="filterstatus_id" class="form-control form-control-sm rounded-0" value="{{request("filterstatus_id")}}">
                                {{-- အားလုံးပြရန် value ကို " " ထားပေးရမည် method 1 --}}
                                {{-- <option value=" " selected >Choose Status...</option> --}}
                                @foreach ($filterstatuses as $id => $name)
                                {{-- database မှ id နှင့် queryမှ id သည် datatype ကွဲနိုင်သောကြာင့် == ဖြင့်သာ စစ်သင့်သည်  --}}
                                    <option value="{{$id}}" {{$id == request("filterstatus_id") ? "selected" : " " }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div>
            <table id="mytable"  class="table table-hover border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Create At</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach($roleusers as $idx=>$roleuser) 
                    
                    <tr>
    
                        {{-- <td>{{++$idx}}</td> --}}
                        <td>{{$idx+ $roleusers->firstItem()}}</td>
                        
                        <td>{{$roleuser->user["name"]}}</td>
                        <td>{{$roleuser->role["name"]}}</td>
                         
                        <td>{{$roleuser->created_at->format('d m Y')}}</td>
                        <td>{{$roleuser->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$roleuser->id}}" data-user_id="{{$roleuser->user_id}}" data-role_id="{{$roleuser->role_id}}"><i class="fas fa-pen"></i></a>
                            
                            <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$roleuser->id}}" ><i class="fas fa-trash"></i></a>
    
                        </td>
                        <form id="formdelete{{$roleuser->id}}" action="{{route('roleusers.destroy',$roleuser->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        
    
                        
    
                        
                        
                    </tr>
                    @endforeach
                </tbody>
                
            </table>

            {{$roleusers->links("pagination::bootstrap-4")}}
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
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <select name="user_id" id="edit_user_id" class="form-control rounded-0">
                                            <option value="" selected disabled>Choose User...</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <select name="role_id" id="edit_role_id" class="form-control rounded-0">
                                            <option value="" selected disabled>Choose Role...</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role -> name}}</option>
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

        let getfilterstatus = document.getElementById("filterstatus_id");
        getfilterstatus.addEventListener("change",function(){
           
            // const getstatusid = this.value;
            // or
            // const getstatusid =  this.options[this.selectedIndex].value;
            // or
            const getstatusid = this.value || this.options[this.selectedIndex].value;

            // console.log(getstatusid);
            const getcururl = window.location.href;

            window.location.href = getcururl.split("?")[0]  + "?filterstatus_id=" +getstatusid;
        })

        $(document).ready(function(){
            $(".delete-btns").click(function(){
                // console.log("hello");
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
                $("#edit_user_id").val($(this).data("user_id"));
                $("#edit_role_id").val($(this).data("role_id"));

                const getid = $(this).data("id");
                console.log(getid);
                // method 2
                $("#form_action").attr('action',`/roleusers/${getid}`);
                
            })
            
            // end edit form

        })
    </script>
@endsection