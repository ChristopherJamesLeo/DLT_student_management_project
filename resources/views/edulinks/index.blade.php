@extends("layouts.adminindex")

@section("css")
@endsection

@section("caption","Download List")

@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                {{-- method 1 --}}
                {{-- @if($getsuccess = session("success"))
                    <div class="alert alert-success rounded-0">{{$getsuccess}}</div>
                @endif --}}

                {{-- method 2 --}}
                @if(session("success"))
                    <div class="alert alert-success rounded-0">{{session("success")}}</div>
                @endif

                <form action="{{route('edulinks.store')}}" method="POST" enctype="multipart/form-data" class=""> 

                     {{csrf_field()}}
                     @method("POST")

                     <div class="row">
                         <div class="col-md-4 col-sm-12 form-group mb-1">
                             <label for="classdate">Class Date <span class="text-danger">*</span></label>
                             @error("classdate")
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                             <input type="date" name="classdate" id="classdate" class="form-control rounded-0 @error("classdate") is-invalid @enderror" placeholder="Enter Attendance Name" value="{{old('classdate')}}">
                         </div>
                         <div class="col-md-4 col-sm-12 form-group mb-1">
                             <label for="post_id">Class</label>
                             @error("post_id")
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                             <select name="post_id" id="post_id" class="form-control rounded-0 @error("post_id") is-invalid @enderror">
                                <option selected disabled>Choose Class</option>
                                @foreach($posts as $id => $title)
                                    <option value="{{$id}}">{{$title}}</option>
                                @endforeach
                                
                             </select>
                         </div>
                         <div class="col-md-4 col-sm-12 form-group mb-1">
                             <label for="url">URL Colde<span class="text-danger">*</span></label>
                             @error("url")
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                             <input type="text" name="url" id="url" class="form-control rounded-0 @error("url") is-invalid @enderror" placeholder="Enter URL" value="{{old('url')}}">
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
                                @foreach ($filterposts as $id => $title)
                                {{-- database မှ id နှင့် queryမှ id သည် datatype ကွဲနိုင်သောကြာင့် == ဖြင့်သာ စစ်သင့်သည်  --}}
                                    <option value="{{$id}}" {{$id == request("filter") ? "selected" : " " }}>{{$title}}</option>
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

        <table id="mytable" class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Class</th>
                    <th>URL</th>
                    <th>Counter</th>
                    <th>By</th>
                    <th>Class Date</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($edulinks as $idx=>$edulink) 
                
                <tr>

                    {{-- <td>{{++$idx}}</td> --}}
                    <td>{{$idx + $edulinks->firstItem()}}</td>
                    {{-- <td>{{$enroll ->student($enroll->user_id)}}</td> --}}
                    <td><a href="{{route('posts.show',$edulink->post_id)}}">{{$edulink->post["title"]}}</a></td>
                    <td>
                        <a href="javascript:void(0)" class="link_btns" title="Copy Link"
                        data-url = "{{$edulink ->url}}"
                        >
                            {{Str::limit($edulink ->url,30)}}
                        </a>
                    </td>
                    <td>
                        {{$edulink->counter}}
                    </td>
                    
                    
                    <td>{{$edulink['user']['name']}}</td>
                    <td>{{date("d m y",strtotime($edulink->classdate))}}</td>
                     
                    <td>{{$edulink->created_at->format('d M Y | h:m A')}}</td>
                    <td>{{$edulink->updated_at->format('d M Y')}}</td>
                    <td>
                        {{-- download counter --}}
                        <a href="{{route('edulinks.download',$edulink->id)}}" class="me-3 btn btn-outline-info btn-sm text-primary ms-2 me-2 " target="_blank" >
                            download
                            <i class="fas fa-download"></i>
                        </a>
                        {{-- download counter --}}
                        <a href="#editmodal" data-bs-toggle="modal" class="me-3 btn btn-outline-info btn-sm edit_form"
                        data-id="{{$edulink ->id}}"
                        data-classdate="{{$edulink ->classdate}}"
                        data-url="{{$edulink ->url}}"
                        data-post="{{$edulink->post_id}}">
                            <i class="fas fa-pen"></i>
                        </a>

                        <a href="#" class="text-danger me-3 delete-btns" 
                        data-idx = "{{$idx + $edulinks->firstItem()}}" >
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>

                    <form id="formdelete{{$idx + $edulinks->firstItem()}}" action="{{route('edulinks.destroy',$edulink->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                    
                </tr>
                @endforeach
            </tbody>
            
        </table>
        <div class="d-flex justify-content-center">
            {{-- appends(request()->only("filter")) သည် filter ချ်ပြီး pagination သွားပါက အားလံဒး ပျောက်သွားသည် error ကို ဖျောက်ပေးသည်  --}}
            {{$edulinks -> appends(request()->only("filter")) -> links("pagination::bootstrap-4")}}
        </div>
       
        
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
                                <div class="col-md-12 form-group mb-2">
                                    <label for="">Class Date</label>
                                    <input type="date" name="editclassdate" id="editclassdate" class="form-control  rounded-0">
                                </div>
                                <div class="form-group">
                                    <label for="">Post</label>
                                    <select name="editpost" id="editpost_id" class="form-select form-control-sm rounded-0" >
                                        @foreach ($filterposts as $id => $title)
                                            <option value="{{$id}}" {{$id == request("filter") ? "selected" : " " }}>{{$title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 form-group mb-2">
                                    <label for="editurl">URL</label>
                                    <input type="text" name="editurl" id="editurl" class="form-control  rounded-0">
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

    <script>
        
        // start alert box
        setTimeout(() => {
            document.querySelector(".alert").style.display = "none";
        }, 5000);
        // end alert box

        

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

            // start link btn url copy
            $(".link_btns").click(function(){
                var getUrl = $(this).data("url");
                // window.alert("Copied Link");
                navigator.clipboard.writeText(getUrl); // insert click board
            })
            // end link btn url copy

            $(document).on("click",".edit_form",function(e){
                e.preventDefault();
                // console.log("hello");
                // console.log($(this).attr("data-name"));
                // console.log($(this).data("id"));
                $("#editclassdate").val($(this).data("classdate"));
                $("#editpost_id").val($(this).data("post"));
                $("#editurl").val($(this).data("url"));

                const getid = $(this).data("id");

                // $("#form_action").attr('action',`\{\{route('statuses.update',$status->id)\}\}`); // error 

                // use method 1
                // $("#form_action").attr('action',`http://127.0.0.1:8000/statuses/${getid}`);

                // method 2
                $("#form_action").attr('action',`/edulinks/${getid}`);
                
            })
            // for my table

            // start delete
            // $(".delete-btns").click(function(){
            //     // console.log("hello");
            //     var getidx = $(this).data("idx");

            //     // console.log(getidx);

            //     if(confirm(`Are Your Sure!! You want to delete`)){
            //         $("#formdelete"+getidx).submit();
            //     }else{

            //     }
            // })
             // start delete
        })

        // start delete btn
        let getDeleteBtns = document.querySelectorAll(".delete-btns");
        getDeleteBtns.forEach(function(getDeleteBtn){
            getDeleteBtn.addEventListener("click",function(){
                let getIdx = this.getAttribute("data-idx");
                if(confirm(`Are Your Sure!! You want to delete`)){
                    document.querySelector("#formdelete"+getIdx).submit();
                }
            })
        })
        // end delete btn



    </script>
@endsection

<!-- edit show -->

{{--  --}}