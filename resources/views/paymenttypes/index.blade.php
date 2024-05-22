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
                <form id="create_form" method="POST" enctype="multipart/form-data" class=""> 

                     
                     {{-- @method("POST") --}}


                     <div class="row">
                         <div class="col-md-6 col-sm-12 form-group mb-1">
                             <label for="name">Name <span class="text-danger">*</span></label>
                             <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Enter Type Name" value="{{old('name')}}">
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
                                 <button type="submit" id="create_btn" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
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
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($paymenttypes as $idx=>$paymenttype) 
                
                <tr id="delete_{{$paymenttype->id}}">

                    <td>{{++$idx}}</td>
                    <td>{{$paymenttype->name}}</td>
                    <td>
                        <div class="form-checkbox form-switch">
                            <input type="checkbox" name="" id="" class="form-check-input change-btn" {{$paymenttype->status_id == "3" ? "checked" : ""}}
                            {{-- type ကိုပြင်ရန် id သတ်မှတ်ရမည် --}}
                            data-id = {{$paymenttype->id}}
                            >
                        </div>
                    </td>

                    <td>{{$paymenttype["user"]["name"]}}</td>
                     
                    <td>{{$paymenttype->created_at->format('d m Y')}}</td>
                    <td>{{$paymenttype->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$paymenttype->id}}" data-name="{{$paymenttype->name}}" data-status="{{$paymenttype->status_id}}"><i class="fas fa-pen"></i></a>
                        
                        {{-- <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                        data-idx = "{{$type->$idx}}" ><i class="fas fa-trash"></i></a> --}}

                        <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                        data-id = "{{$paymenttype->id}}" ><i class="fas fa-trash"></i></a>

                    </td>

                    {{-- <form id="formdelete{{$type->$idx}}" action="{{route('types.destroy',$type->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form> --}}

                    
                </tr>
                @endforeach
            </tbody>
            
        </table>
        
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
                                        <button type="submit" id="update_btn" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button>
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
    <script >

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

        // start notify box
        function notify(stage,title,msg=null){
            switch(stage){
                case "success":
                    toastr.success(msg, title , {
                        timeOut:1000
                    });
                    break;
                case "warning":
                    toastr.warning(msg, title , {
                        timeOut:1000
                    });
                    break;
                case "error":
                    toastr.error(msg, title , {
                        timeOut:1000
                    });
                    break;
            }
        }
        // end notify box

        // end pass header token
        $(document).ready(function(){

            async function createhandler(){
                let result;
                try {
                    result = await $.ajax({
                        url: "{{ route('paymenttypes.store') }}",  // Blade route usage
                        type: "POST",
                        dataType: "JSON",
                        data: $("#create_form").serializeArray(), // Serialize the form data
                    });
                    // console.log( result );
                    return result;
                } catch (err) {
                    console.log("Error", err);
                }

            }

            // start create form 
            $("#create_form").submit(async function(e){
                e.preventDefault();
                // console.log("hello");
                // let data = createhandler();
                // console.log(data);
                $("#create_btn").text("Sending...");
                await createhandler().then(response=>{
                    const getdata = response.data;

                    $("#mytable tbody").prepend(
                        `<tr id="${'delete_'+getdata.id}">

                            <td>${getdata.id}</td>
                            <td>${getdata.name}</td>
                            <td>
                                <div class="form-checkbox form-switch">
                                    <input type="checkbox" name="" id="" class="form-check-input change-btn" 
                                    ${getdata.status_id === "3" ? "checked" : " "}
                                
                                    
                                    data-id = ${getdata.id}
                                    >
                                </div>
                            </td>

                            <td>${getdata.user_id}</td>
                            
                            <td>${getdata.created_at}</td>
                            <td>${getdata.updated_at}</td>
                            <td>
                                <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${getdata.id}" data-name="${getdata.name}" data-status="${getdata.status_id}"><i class="fas fa-pen"></i></a>
                                
                                {{-- <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                                data-idx = "{{$type->$idx}}" ><i class="fas fa-trash"></i></a> --}}

                                <a href="javascript:void(0)" class="text-danger me-3 delete-btns" 

                                data-id = "${getdata.id}" ><i class="fas fa-trash"></i></a>

                            </td>

                            {{-- <form id="formdelete{{$type->$idx}}" action="{{route('types.destroy',$type->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form> --}}


                            </tr>`
                    )
                    // $("#create_form")[0].reset(); // form ကို reset ချမည်
                    $("#create_form").trigger("reset"); // form ကို reset ချမည် 
                    $("#create_btn").text("Submit");
                    notify("success","Create Successful");

                })
                console.log("hello");
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
            $(".delete-btns").click(function(){
                let getid = $(this).data("id");
                // console.log(getid);

                if(confirm("Are You Sure!! You Want to delete")){

                    // just ui remove
                    // ui ပါ တစ်ခါတည်းဖျက်မည် 
                    // $(this).parent().parent().remove();

                    // data remove
                    // 419 Error တက်နေသည် ၄င်းသည် header ၏ authantication လိုအပ်နေသည့် ပြသနာဖြစ်သည် csrf ကို တိုက်စစ်နေသောကြောင့် data တွင် token ေပးရမည်
                    $.ajax({
                        url : `paymenttypes/${getid}`,
                        type : "DELETE",
                        dataType : "json",
                        data : {_token : "{{csrf_token()}}"},
                        success : function(response){
                            if(response && response.status=="success"){
                                const getdata = response.data;
                                $(`#delete_${getdata.id}`).remove();
                                // toastr.success('Delete Successful', 'Successful');
                                // notify("warning","Delete Successful","Deleted");
                                notify("warning","Delete Successful");
                            }
                        }
                    })
                }else{
                    return false;
                }

                
            });
            // end delete

            $(document).on("click",".edit_form",function(e){
                e.preventDefault();
                // console.log("hello");
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
                // $("#form_action").attr('action',`/paymenttypes/${getid}`);

                
            })

            $("#form_action").submit(function(e){
                e.preventDefault();
                // console.log("hello");
                const getid = $(this).attr("data-id");
                console.log(getid);
                $("#update_btn").text("Sending");
                $.ajax({
                    url : `paymenttypes/${getid}`,
                    type : "PUT",
                    dataType : "json",
                    data : $("#form_action").serialize(), // form action ထဲရှိ data အကုန်ပို့မည် 
                    success : function(response){
                        // console.log(response);
                        $("#update_btn").text("Update");
                        let data = response.data;
                        console.log(response.status);
                        console.log(data);
                        $("#editmodal").modal('hide'); // to close modal
                        notify("warning","Update Successful");

                        // window.location.reload(); 
                    }

                })
            });

            $("#mytable").DataTable();


            // start change status btn
            $(".change-btn").click(async function(){
                // console.log($(this).data("id"));

                var getid = $(this).data("id");

                // prop ဖြင့် checkbox သည် prop ဖြင့် check ဖြစ်သလား ဖြစ်လှျင်3 မဖြစ်လှျင် 4
                var setstatus = $(this).prop("checked") === true ? 3 : 4;
                // change API 
                await $.ajax({
                    url : "paymenttypesstatus", //route list ထဲရှီ route name ကို ပို့ပေးရမည်
                    type : "GET", // route ကို ဖမ်းတီးရာတွင် GET ဖြစ်သော ကြောင့် GET ဖြင့် သ့ဒဂပေးရမည်
                    
                    dataType : "json",
                    data : {
                        // columnName : value
                        "id" : getid,
                        "status_id" : setstatus
                    },
                    success : function(response){
                        // console.log(response.success); // return ပြန်လာသော data အား ယူမည် 

                    }
                    
                });
            })
            // end change status btn


            // type delete 

        })
    </script>
@endsection