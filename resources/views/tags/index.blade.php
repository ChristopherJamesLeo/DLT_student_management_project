@extends("layouts.adminindex")
@section("css")
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endsection
@section("caption","Tag List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('tags.store')}}" method="POST" enctype="multipart/form-data" class=""> 

                     {{csrf_field()}}
                     @method("POST")


                     <div class="row">
                         <div class="col-md-6 col-sm-12 form-group mb-1">
                             <label for="name">Name <span class="text-danger">*</span></label>
                             <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Enter Tag Name" value="{{old('name')}}">
                         </div>
                         <div class="col-md-6 col-sm-12 form-group mb-1">
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
            </div>
        </div>

        <hr>
    
        <table id="mytable" class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>By</th>
                    <th>Cretate at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tags as $idx=>$tag) 
                
                <tr>

                    {{-- <td>{{++$idx}}</td> --}}
                    {{-- pagination တွင် no အစဥ်လိုက်ပြပေးရန် $tags->firstItem() သုံးပေးရမည်--}}
                    {{-- $tags->firstItem() သည် pagination ရှိ ပထမဆုံးူ roll no ကို ထုတ်ပေဂမည်  --}}
                    {{-- $tags->lastItem() သည် pagination ရှိ  နောက်ဆုံး roll no ကို ထုတ်ပေဂမည်  --}}
                    <td>{{$idx+ $tags->firstItem()}}</td>

                    <td>{{$tag->name}}</td>
                    <td>
                        <div class="form-checkbox form-switch">
                            <input type="checkbox" name="" id="" class="form-check-input change-btn" {{$tag->status_id == "3" ? "checked" : ""}}
                            {{-- type ကိုပြင်ရန် id သတ်မှတ်ရမည် --}}
                            data-id = {{$tag->id}}
                            >
                        </div>
                    </td>
                    <td>{{$tag["user"]["name"]}}</td>
                     
                    <td>{{$tag->created_at->format('d m Y')}}</td>
                    <td>{{$tag->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$tag->id}}" data-name="{{$tag->name}}" data-status="{{$tag->status_id}}"><i class="fas fa-pen"></i></a>
                        
                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$tag->id}}" ><i class="fas fa-trash"></i></a>

                    </td>
                    <form id="formdelete{{$tag->id}}" action="{{route('tags.destroy',$tag->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                    
                </tr>
                @endforeach
            </tbody>
            
        </table>

        {{-- paginatin btn များပေါ်ရန် $tags->links() ကိုသုံးပေးရမည် bootstrap version 4 အထိဘဲ support ပေးထားသည် ထို့ကြောင့် ဖြေရှင်းရန် verison ချိန်း သို့မဟုတ် ၄င်းတစ်နေရာအတွက်ဘဲ version 4 ပြောင်းပေး၇မည် --}}

        {{$tags->links("pagination::bootstrap-4")}}
        
    </div>
    <!--End Content Area-->

        <!-- START MODAL AREA-->
        <!-- start edit modal -->
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
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
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="editname" class="form-control rounded-0" placeholder="Enter Status Name" value="{{old('name')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                     <label for="editstatus_id">Status</label>
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
                $("#editstatus_id").val($(this).data("status"));

                const getid = $(this).data("id");

                // $("#form_action").attr('action',`\{\{route('statuses.update',$status->id)\}\}`); // error 

                // use method 1
                // $("#form_action").attr('action',`http://127.0.0.1:8000/statuses/${getid}`);

                // method 2
                $("#form_action").attr('action',`/tags/${getid}`);
                
            })
            // $("#mytable").DataTable();

            // start change status btn
            $(".change-btn").click(function(){
                // console.log($(this).data("id"));

                var getid = $(this).data("id");

                // prop ဖြင့် checkbox သည် prop ဖြင့် check ဖြစ်သလား ဖြစ်လှျင်3 မဖြစ်လှျင် 4
                var setstatus = $(this).prop("checked") === true ? 3 : 4;
                
                // change API 
                $.ajax({
                    url : "tagstatus", //route list ထဲရှီ route name ကို ပို့ပေးရမည်
                    type : "GET", // route ကို ဖမ်းတီးရာတွင် GET ဖြစ်သော ကြောင့် GET ဖြင့် သ့ဒဂပေးရမည်
                    
                    dataType : "json",
                    data : {
                        // columnName : value
                        "id" : getid,
                        "status_id" : setstatus
                    },
                    success : function(response){
                        console.log(response.success); // return ပြန်လာသော data အား ယူမည် 
                    }
                    
                });
            })
            // end change status btn
        })
    </script>
@endsection

