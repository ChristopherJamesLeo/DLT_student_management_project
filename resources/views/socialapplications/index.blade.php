@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Type List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:void(0)" id="modal-btn" class="btn btn-primary btn-sm rounded-0">Create</a>
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
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- @foreach($socialapplications as $idx=>$socialapplication) 
                
                <tr id="delete_{{$socialapplication->id}}">

                    <td>{{++$idx}}</td>
                    <td>{{$socialapplication->name}}</td>
                    <td>
                        <div class="form-checkbox form-switch">
                            <input type="checkbox" name="" id="" class="form-check-input change-btn" {{$socialapplication->status_id == "3" ? "checked" : ""}} --}}
                            {{-- type ကိုပြင်ရန် id သတ်မှတ်ရမည်
                            data-id = {{$socialapplication->id}}
                            >
                        </div>
                    </td>

                    <td>{{$socialapplication["user"]["name"]}}</td>
                     
                    <td>{{$socialapplication->created_at->format('d m Y')}}</td>
                    <td>{{$socialapplication->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$socialapplication->id}}" data-name="{{$socialapplication->name}}" data-status="{{$socialapplication->status_id}}"><i class="fas fa-pen"></i></a> --}}
                        
                        {{-- <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                        data-idx = "{{$type->$idx}}" ><i class="fas fa-trash"></i></a> --}}

                        {{-- <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                        data-id = "{{$socialapplication->id}}" ><i class="fas fa-trash"></i></a>

                    </td> --}}

                    {{-- <form id="formdelete{{$type->$idx}}" action="{{route('types.destroy',$type->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form> --}}

                    
                {{-- </tr>
                @endforeach --}}
            </tbody>
            
        </table>
        
    </div>
    <!--End Content Area-->

        <!-- START MODAL AREA-->
         <!-- start create modal -->
        <div id="createmodel" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Create Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_action"  method="POST" enctype="multipart/form-data" class=""> 

                            
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Enter Application Name" value="{{old('name')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                     <label for="status_id">Status</label>
                                     <select name="status_id" id="status_id" class="form-control rounded-0">
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}">{{$status['name']}}</option>
                                        @endforeach

                                     </select>
                                 </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">

                                        <button type="submit" id="" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
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
        <!-- end create modal -->

        <!-- start edit modal -->
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <form id="form_action" action="" method="POST" enctype="multipart/form-data" class="">  --}}
                        <form id="form_action" action="" method="" enctype="multipart/form-data" class=""> 

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

                                        {{-- <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button> --}}
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
{{-- jquyer validate --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

{{-- datatable css1 js1 --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            function fetchalldata(){
                $.ajax({
                    url: "{{route('socialapplications.fatchalldatas')}}",
                    method : "GET",
                    type : "JSON",
                    success : function(response){
                        // console.log(response);
                        const datas = response.data;
                        console.log(datas);
                        let html;
                        
                        datas.forEach(function(data,idx){
                            // console.log(data);
                            console.log(data.status_id);

                            html +=  `<tr id="${'delete_'+data.id}">

                                        <td>${++idx}</td>
                                        <td>${data.name}</td>
                                        <td>
                                            <div class="form-checkbox form-switch">
                                                <input type="checkbox" name="" id="" class="form-check-input change-btn" 
                                                ${data.status_id === 3 ? "checked" : " "}
                                            
                                                
                                                data-id = ${data.id}
                                                >
                                            </div>
                                        </td>

                                        <td>${data.user_id}</td>

                                        <td>${data.created_at}</td>
                                        <td>${data.updated_at}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                            
                                            {{-- <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                                            data-idx = "{{$type->$idx}}" ><i class="fas fa-trash"></i></a> --}}

                                            <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                                            data-id = "${data.id}" ><i class="fas fa-trash"></i></a>

                                        </td>

                                        {{-- <form id="formdelete{{$type->$idx}}" action="{{route('types.destroy',$type->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form> --}}


                                        </tr>`;
                                    // console.log(html);
                        })
                        $("#mytable tbody").prepend(html);
                        
                    }
                })
            }

            fetchalldata();

            // end fetch all data


            // start create form 
            $("#modal-btn").click(function(){
                $("#createmodel").modal("show");
            })
            $("#form_action").validate({  // form သည် validate ဖြစ်ခဲ့လျှင် jquery ေအာက်တွင်ရှိသည် တိုက်ရိုက်မဟုတ်ဘဲ သူ့အတွက်သက်သက်ချိတ်ပေးရမည်

                // validate rule ေပးရန် 
                rules : {
                    name : "required",

                },
                messages : {
                    name : "Enter Application Name",
                },
                submitHandler:function(form){
                    // let formdata = $("#form_action").serialize();
                    // let formdata = $("#form_action").serializeArray();
                    let formdata = $(form).serializeArray(); // parameter ကို ပြန်သံုးထားသည် 
                    $.ajax({
                        // data:$("#form_action").serialize(),
                        data: formdata,
                        url : "{{route('socialapplications.store')}}",
                        type : "POST",
                        dataType : "json",
                        success : function(response){
                            console.log(response);
                            if(response && response.status === "success"){
                                $("#createmodel").modal("hide");
                                Swal.fire({
                                    title: "Updated",
                                    text: "Update Successful",
                                    icon: "success"
                                });
                            }
                        },
                        error:function(response){
                            console.log("Error ",response);
                        }
                    })
                }
            })
            // end create form
            // ---------------------
            // $(".delete-btns").click(function(){
            //     // console.log("hello");
            //     var getidx = $(this).data("idx");

            //     // console.log(getidx);

            //     if(confirm(`Are Your Sure!! You want to delete ${getidx}`)){
            //         $("#formdelete"+getidx).submit();
            //     }else{

            //     }
            // })

            // start delete
            // using default laravel route
            // $(".delete-btns").click(function(){
            $(document).on("click",".delete-btns",function(e){
                let getid = $(this).data("id");
                console.log(getid);

                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert this! for ${getid}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url : `socialapplications/${getid}`,
                            type : "DELETE",
                            dataType : "json",
                            // data : {_token : "{{csrf_token()}}"},
                            success : function(response){
                                // console.log(response); ၁
                                if(response){
                                    // const getdata = response.data;
                                    $(`#delete_${getid}`).remove();
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    });
                                }
                            },
                            error: function(response){
                                console.log("error :" ,response)
                            }
                        })

                        
                    }
                });


                // if(confirm("Are You Sure!! You Want to delete")){

                    // just ui remove
                    // ui ပါ တစ်ခါတည်းဖျက်မည် 
                    // $(this).parent().parent().remove();

                    // data remove
                    // 419 Error တက်နေသည် ၄င်းသည် header ၏ authantication လိုအပ်နေသည့် ပြသနာဖြစ်သည် csrf ကို တိုက်စစ်နေသောကြောင့် data တွင် token ေပးရမည်
                    
                // }

                
            });
            // end delete

            $(document).on("click",".edit_form",function(e){
                e.preventDefault();
                console.log("hello");
                // console.log($(this).attr("data-name"));
                // console.log($(this).data("id"));
                $("#editname").val($(this).data("name"));
                $("#editstatus_id").val($(this).data("status"));

                const getid = $(this).data("id");

                $("#form_action").attr("data-id",getid);

                // $("#form_action").attr('action',`\{\{route('statuses.update',$status->id)\}\}`); // error 

                // use method 1
                // $("#form_action").attr('action',`http://127.0.0.1:8000/statuses/${getid}`);

                // method 2
                // $("#form_action").attr('action',`/socialapplications/${getid}`);

                
            })

            $("#form_action").submit(function(e){
                e.preventDefault();
                // console.log("hello");
                const getid = $(this).attr("data-id");
                console.log(getid);
                $.ajax({
                    url : `socialapplications/${getid}`,
                    type : "PUT",
                    dataType : "json",
                    data : $("#form_action").serialize(), // form action ထဲရှိ data အကုန်ပို့မည် 
                    success : function(response){
                        // console.log(response);
                        let data = response.data;
                        console.log(response.status);
                        console.log(data);
                        $("#editmodal").modal('hide'); // to close modal 
                    }

                })
            });

            $("#mytable").DataTable();


            // start change status btn
            // $(".change-btn").click(function(){ // js မှလှမ်းပို့ပါက အလုပ်မလုပ်တော့ပေ
            $(document).on("change",".change-btn",function(){ // ထို့ကြောင့် document ကို သံုးပေးရသည် 
                // console.log($(this).data("id"));
                // console.log("hello");
                var getid = $(this).data("id");

                // prop ဖြင့် checkbox သည် prop ဖြင့် check ဖြစ်သလား ဖြစ်လှျင်3 မဖြစ်လှျင် 4
                var setstatus = $(this).prop("checked") === true ? 3 : 4;

                // console.log(setstatus);
                // change API 
                $.ajax({
                    url : "socialapplicationstatus", //route list ထဲရှီ route name ကို ပို့ပေးရမည်
                    type : "GET", // route ကို ဖမ်းတီးရာတွင် GET ဖြစ်သော ကြောင့် GET ဖြင့် သ့ဒဂပေးရမည်
                    
                    dataType : "json",
                    data : {
                        // columnName : value
                        "id" : getid,
                        "status_id" : setstatus
                    },
                    success : function(response){
                        console.log(response.success); // return ပြန်လာသော data အား ယူမည် 
                        Swal.fire({
                            title: "Updated",
                            text: "Update Successful",
                            icon: "success"
                        });
                    }
                    
                });
            })
            // end change status btn


            // type delete 

        })
    </script>
@endsection