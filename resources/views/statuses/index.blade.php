@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        .loading {
            font-weight: bold;
            position:  fixed;
            left : 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            display: none
        }
    </style>
@endsection
@section("caption","Status List List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
           <div class="col-md-12 mb-2">
                <form action="{{route('statuses.store')}}" method="POST" enctype="multipart/form-data" class=""> 

                     {{csrf_field()}}
                     @method("POST")

                     {{-- old('firstname')  သည် refresh ဖြစ်ပြီး data reject ဖြစ်၍ ပြန်လာပါက မူလပေးခဲ့သောစာသားကို မပြောက်ဘဲ invalit ဖြစ်နေသော data input box တစ်ခုတည်းသာ blank ဖြစ်ပြီး အရင် ထည့်ခဲ့သော data ကိူ ပြန်ဖော်ပြပေးနေမည် --}}
                     <div class="row">
                         <div class="col-md-12 col-sm-12 form-group mb-1">
                             <label for="name">Name <span class="text-danger">*</span></label>
                             <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Enter Status Name" value="{{old('name')}}">
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
            <div >
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request("filtername")}}">
                                {{-- ရှာထားပြိးသား vlaue ကို ပြန်ယူတည့်ရန်  --}}
                                {{-- <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button> --}}
                                {{-- <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button> --}}
    
                                {{-- with javascript --}}
                                <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
        </div>

    
        <table id="mytable" class="table table-hover border">
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
                {{-- @foreach($statuses as $idx=>$status) 
                
                
                    <tr>

                        <td>{{++$idx}}</td>
                        
                        <td>{{$status->name}}</td>
                        <td>{{$status->user["name"]}}</td> 

                        <td>{{$status->created_at->format('d m Y')}}</td>
                        <td>{{$status->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$status->id}}" data-name="{{$status->name}}"><i class="fas fa-pen"></i></a>
                            
                            
                            <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$status->id}}" ><i class="fas fa-trash"></i></a>
    
                        </td>
                        <form id="formdelete{{$status->id}}" action="{{route('statuses.destroy',$status->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        

                        

                        
                        
                    </tr>
                @endforeach --}}
            </tbody>
            
        </table>
        <div class="text-center loading">Loading...</div>
        
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
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>

        

        $(document).ready(function(){
            // start passing header token
            $.ajaxSetup(   // ajax ဖြင့် စကတည်းက ပို့ထားမည် csrf ကို ပို့ထားမည် 
                {
                    headers : { 
                        // header အား သံုးနုိင်ရန် html ရှိ header ထဲတွင် meta tag ဖြင့် attribute name = "csrf-token" content="{{csrf_token()}}"
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("content"), // meta tag ထဲတွင် ရှိသော value အား ယူမည် 
                    }
                }
            )
            // end passing header token

                        // start fetch all data
            async function fetchalldata(query = ""){
                await $.ajax({
                    
                    // url: "{{url('api/warehouses')}}", // url နှင့်သံုးသည်
                    // url: "{{route('api.warehouses.index')}}", // API use with route name
                    // url: "{{'api/warehouses'}}", // url နှင့်သံုးသည်
                    // url: "{{url('api/statuses')}}", // url နှင့်သံုးသည်
                    url:"{{url('api/statusessearch')}}",
                    method : "GET",
                    type : "JSON",
                    data : {"query" : query}, // search မှလာသော query အား para ထည့်၍ data ဖြင့် လှမ်းပို့မည်
                    success : function(response){
                        console.log(response);
                        const datas = response.data;
                        console.log(response.test);
                        console.log(datas);
                        $(".loading").hide(); // loading အား ပြန်ဖျောက်မည် 
                        $("#mytable tbody").empty();
                        let html;
                        // console.log("hello");
                        datas.forEach(function(data,idx){
                            // console.log(data);
                            console.log(data.status_id);
                            console.log(data);  

                            html +=  `<tr id="${'delete_'+data.id}">

                                        <td>${++idx}</td>
                                        <td>${data.name}</td>
                                        

                                        <!-- <td>${data.user['name']}</td> bracket notation and dot notation-->
                                        <td>${data.user.name}</td>


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
                       
                        // $("#mytable tbody").html(html);
                        $("#mytable tbody").prepend(html); // prepend သံုးလိုပါက function စကတည်းက အရင် ရှငိးထုတ်ထားရမည်
                        
                    }
                })
            }

            fetchalldata();

            // end fetch all data




            // ----------------------

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
                $("#form_action").attr('action',`/statuses/${getid}`);
                
            })
            
            // end edit form
            // $("#mytable").DataTable();

            // start filter by search query

            // with keyup 
            // $("#filtername").on("keyup",function(){
            //     const query = $(this).val();
            //     // console.log(query);
            //     fetchalldata(query);
            // })

            // with click
            $("#btn-search").on("click",function(e){
                e.preventDefault();
                
                const query = $("#filtername").val();
                // console.log(query);
                if(query.length > 0){
                    $(".loading").show();
                }
                fetchalldata(query);
            })
            // end filter by search query

        })





        
    </script>
@endsection