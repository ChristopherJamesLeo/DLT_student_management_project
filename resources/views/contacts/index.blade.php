@extends("layouts.adminindex")
@section("css")
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endsection
@section("caption","Contact List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <a href="#createmodel" class="btn btn-primary btn-sm rounded-0" data-bs-toggle="modal">Create</a>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-4 col-sm-6 mb-2">
                           
                        </div>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="form-group">
                                <select name="filter" id="filter" class="form-select form-control-sm rounded-0" value="{{request("filter")}}">
                                    {{-- အားလုံးပြရန် value ကို " " ထားပေးရမည် method 1 --}}
                                    {{-- <option value=" " selected >Choose Status...</option> --}}
                                    {{-- @foreach ($filterposts as $id => $title) --}}
                                    {{-- database မှ id နှင့် queryမှ id သည် datatype ကွဲနိုင်သောကြာင့် == ဖြင့်သာ စစ်သင့်သည်  --}}
                                        {{-- <option value="{{$id}}" {{$id == request("filter") ? "selected" : " " }}>{{$title}}</option>
                                    @endforeach --}}

                                    @foreach($relatives as $id => $name)
                                        <option value="{{$id}}" {{$id == request("filter") ? "selected" : " "}}>{{$name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="search" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request("search")}}">
                                <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                                <button type="button" id="btn-clear" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
    
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
        <table id="mytable" class="table table-hover border">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Birthday</th>
                    <th>Relative</th>
                    <th>By</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($contacts as $idx=>$contact) 
                
                <tr>

                    {{-- <td>{{++$idx}}</td> --}}
                    <td>{{$idx + $contacts->firstitem()}}</td>
                    <td>{{$contact->firstname}}</td>
                    <td>{{$contact->lastname}}</td>
                    {{-- data ရှိမရှီကို tinary operator ဖြင့် စစ်ပြိး ရှိပြီဆိုမှ ဖော်ပြပေးမည်  --}}
                    <td>{{$contact->birthday ? date("d M y",strtotime($contact->birthday)) : ""}}</td>
                    <td>{{$contact->relative_id ? $contact["relative"]["name"] : "" }}</td>
                    <td>{{$contact["user"]["name"] }}</td>
                    
                     
                    <td>{{$contact->created_at->format('d m Y')}}</td>
                    <td>{{$contact->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$contact->id}}" data-firstname="{{$contact->firstname}}" data-lastname="{{$contact->lastname}}" data-birthday="{{$contact->birthday}}" data-relative="{{$contact->relative_id}}" data-status="{{$contact->relative_id}}"><i class="fas fa-pen"></i></a>
                        
                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$contact->id}}" ><i class="fas fa-trash"></i></a>

                    </td>
                    <form id="formdelete{{$contact->id}}" action="{{route('contacts.destroy',$contact->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                    
                </tr>
                @endforeach
            </tbody>
            
        </table>

        {{-- appends အား only တွင် filter နှင့် search နှစ်ခလုံးအတွက်ထားမည် --}}
        {{-- {{$contacts->appends(request()->only("filter","search"))->links()}} --}}

        {{-- withQueryString သံုးထားသောကြောင့် appends လု်ပစရာမလိုပေ --}}
        {{$contacts->links()}}
        {{-- {{$contacts->links("pagination::bootstrap-4")}} --}}
       {{-- {{$contacts->links("pagination::bootstrap-5")}} composer ကို update လုပ်ပေးရမည် --}}
        
        
    </div>
    <!--End Content Area-->


        <!-- START MODAL AREA-->

        <!-- start edit modal -->
        <div id="createmodel" class="modal fade">
            <div class="modal-dialog modal-md modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Create Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_action" action="{{route('contacts.store')}}" method="POST" enctype="multipart/form-data" class=""> 

                            {{csrf_field()}}
                            {{ method_field("POST") }}

                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="firstname">Firstname <span class="text-danger">*</span></label>
                                    <input type="text" name="firstname" id="firstname" class="form-control rounded-0" placeholder="Enter First Name" value="{{old('firstname')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="lastname">Lastname <span class="text-danger">*</span></label>
                                    <input type="text" name="lastname" id="lastname" class="form-control rounded-0" placeholder="Enter Last Name" value="{{old('lastname')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="birthday">Birthday <span class="text-danger">*</span></label>
                                    <input type="date" name="birthday" id="birthday" class="form-control rounded-0" placeholder="Enter birthday" value="{{old('birthday')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                     <label for="relative_id">Relatives</label>
                                     <select name="relative_id" id="relative_id" class="form-control rounded-0">
                                        @foreach($relatives as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach

                                     </select>
                                 </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">

                                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
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

        <!-- start edit modal -->
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-md modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editform_action" action="" method="POST" enctype="multipart/form-data" class=""> 

                            @csrf 
                            @method("PUT")

                            <div class="row">
                                <div class="col-md-6 col-sm-12 form-group mb-1">
                                    <label for="editfirstname">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="firstname" id="editfirstname" class="form-control rounded-0" placeholder="Enter First Name" value="{{old('firstname')}}">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group mb-1">
                                    <label for="editlastname">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="lastname" id="editlastname" class="form-control rounded-0" placeholder="Enter Last Name" value="{{old('editlastname')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="editbirthday">Birthday <span class="text-danger">*</span></label>
                                    <input type="date" name="birthday" id="editbirthday" class="form-control rounded-0" placeholder="Enter Birthday" value="{{old('birthday')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                     <label for="editrelative_id">Relative</label>
                                     <select name="relative_id" id="editrelative_id" class="form-control rounded-0">
                                        @foreach($relatives as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
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

        // start filter
        document.getElementById("filter").addEventListener("change",function(){
            let getfilterid = this.value || this.options[this.selectedIndex].value;
            window.location.href = window.location.href.split("?")[0]+"?filter="+getfilterid;

        })
        // end filter

        
        // start clear filter 
        document.getElementById("btn-clear").addEventListener("click",function(){
            // window.location.href = window.location.href.split("?")[0]+"?filter=&search=";
            const getfilter = document.getElementById("filter");
            const getsearch = document.getElementById("search");
            getfilter.selectedIndex = 0; // select box မှ index ကို 0 ပြန်ထားမည်
            getsearch.value = "";

            
            window.location.href = window.location.href.split("?")[0];
        })
        // end clear filter

                // start auto show clear btn
                const autoshowbtn = function(){
            let getBtnClear = document.getElementById("btn-clear");
            let getUrlQuery = window.location.search; // url ထဲရှိ query ကို ဆွဲထုတ်မည်
            let pattern = /[?&]search=/; // url ထဲရှိ search ဟူသော ကောင်ပါသလား ? နှင့် & ပါသလား  (true/false)
            if(pattern.test(getUrlQuery)){
                // pattern ထဲရှိ စာသားသည် test ထဲရှိစာသားနှင့် တူညီသလား စစ်သည် js default function
                getBtnClear.style.display = 'block';
            }else{
                getBtnClear.style.display = 'none';

            }
        }
        autoshowbtn();
        // end auto show clear btn

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
                $("#editfirstname").val($(this).data("firstname"));
                $("#editlastname").val($(this).data("lastname"));
                $("#editbirthday").val($(this).data("birthday"));
                $("#editrelative_id").val($(this).data("relative"));

                const getid = $(this).data("id");

                $("#editform_action").attr('action',`/contacts/${getid}`);
                
            }) 
            // $("#mytable").DataTable();
        })
    </script>
@endsection

<!-- Day (sunday) -->
<!-- Polymorph (m to m) -->