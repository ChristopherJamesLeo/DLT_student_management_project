@extends("layouts.adminindex")


@section("css")
    <style>
        .chat_box {
            height: 200px;
            overflow-y : scroll;
        }

        .gallery {
            width: 100%;
            background-color: #eee;
            color: #aaa;
            display: flex;
            justify-content: center;
        }
        .gallery img {
            width: 100px;
            height: 100px;


            border: 2px dashed #aaa;
            border-radius: 10px;
            object-fit: cover;
            padding: 5px;
            margin: 0 5px;
        }
        .gallery.removetxt span{
            display: none;
        }

        .nav {
            display: flex;
            padding: 0;
            margin: 0;

        }
        .nav .nav-item {
            list-style: none;
        }
        .nav .tablinks {
            padding: 14px 16px;
            border: none;
            outline: none;
            cursor: pointer;
            transition: all 0.3s ease 0s;
        }

        .nav .tablinks:hover {
            background-color: #f3f3f3;
        }
        .nav .tablinks.active {
            color: blue;
        }

        .tab-pane {
            padding: 6px 12px;
            display: none;
        }
    </style>
@endsection
@section("caption","Post List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <a href="javascript:void(0)" id="back_btn" class="btn btn-secondary btn-sm rounded-0">Back</a>
            <a href="{{route('announcements.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>

            
            <hr>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card rounded-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$announcement -> title}} </h5>
                    </div>
                    
                    <ul class="list-group">
                        <li class="d-flex justify-content-center list-group-item fw-bold">
                            <img src="{{asset($announcement->image)}}" class="" style="width:200px;height:100px" alt="{{$announcement->title}}">
                        </li>
                        <div class="w-100 d-flex">
                          
                            <button type="button" id="#createmodel" data-bs-toggle="modal" class="w-100 btn btn-primary btn-sm rounded-0">Enroll</button>
                            <button type="button" class="w-100 btn btn-outline-primary btn-sm rounded-0">Follow</button>
                        </div>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="row gap-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Title</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">
                                                    {{$announcement->title}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Title</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">
                                                    {{$announcement->title}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-sm "></i>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Created At</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">
                                                    {{date("d M Y ",strtotime($announcement->created_at))}} | {{date("h:m:s a ",strtotime($announcement->created_at))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-edit fa-sm "></i>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Updated At</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">
                                                    {{date("d M Y h:m:s A",strtotime($announcement->updated_at))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-8">
               

                <div class="row">
                    <div class="col-md-12">
                        

                        <div class="card rounded-0 border-0">
                            <div class="card-body">
                                <ul class="list-group chat_box">
                                    @foreach($comments as $comment)
                                        <li class="mt-2 list-group-item border-0 rounded-0">
                                            <div>
                                                <p>
                                                    {{$comment->description}}
                                                </p>
                                            </div>
                                            <div >
                                                <span class="small fw-bold float-end">{{$comment->user->name}} | {{$comment->created_at->diffForHumans()}}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body border-top">
                                <form action="{{route('comments.store')}}" method="POST" >

                                    @csrf 

                                    @method("POST")

                                    <div class="col-md-12 d-flex justify-content-between">
                                        <textarea name="description" id="description" rows="1" class="form-control border-0 shadow-none outline-none rounded-0 " style="resize:none;" placeholder="Comment Here....">{{old("description")}}</textarea>
                                        <button type="submit" class="me-auto btn btn-info btn-sm text-light ms-3"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                    

                                    <!-- start Hidden fields -->
                                    <input type="hidden" name="commentable_id" id="commentable_id" value="{{$announcement->id}}">

                                    <input type="hidden" name="commentable_type" id="commentable_type" value="App\Models\Announcement">
                                    <!-- end Hidden fields -->

                                </form>
                            </div>
                        </div>
                        <h6>Additional Info</h6>

                <div class="mb-4 card border-0 shadow rounded-0">
                    <ul class="nav">
                        <li class="nav-item "><button type="button" id="autoclick" class="tablinks active" onclick="gettab(event,'follower')">Follower</button></li>
                        <!-- event ကို html မှ parameter  ပေးရန် event ဟု အပြည့်အပြည့်စုံရေးပေးရမည် -->
                        <li class="nav-item"><button type="button" id="" class="tablinks" onclick="gettab(event,'following')">Following</button></li>
                        <li class="nav-item"><button type="button" id="" class="tablinks" onclick="gettab(event,'liked')">Liked</button></li>
                        <li class="nav-item"><button type="button" id="" class="tablinks" onclick="gettab(event,'remark')">Remark</button></li>
                    </ul>


                    <div class="tab-content">
                        <div id="follower" class="tab-pane">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim id consequuntur explicabo ea eveniet qui ipsum quae commodi similique fuga ipsam reiciendis officia, tempora sapiente porro modi distinctio autem! Repellendus!
                                Quaerat optio mollitia beatae? Similique est, molestias eius quos voluptas porro necessitatibus sit facere repellat unde beatae accusamus id distinctio dolore tempora dolorem modi earum numquam laborum provident debitis architecto.
                                Provident minima est laudantium fugit dicta atque esse excepturi repudiandae quo iusto ipsam, animi id nulla, consectetur commodi quisquam facilis at accusamus dolorum iste et pariatur odit. Temporibus, dignissimos alias!
                            </p>
                        </div>
                        <div id="following" class="tab-pane">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim id consequuntur explicabo ea eveniet qui ipsum quae commodi similique fuga ipsam reiciendis officia, tempora sapiente porro modi distinctio autem! Repellendus!
                                Quaerat optio mollitia beatae? Similique est, molestias eius quos voluptas porro necessitatibus sit facere repellat unde beatae accusamus id distinctio dolore tempora dolorem modi earum numquam laborum provident debitis architecto.
                                Provident minima est laudantium fugit dicta atque esse excepturi repudiandae quo iusto ipsam, animi id nulla, consectetur commodi quisquam facilis at accusamus dolorum iste et pariatur odit. Temporibus, dignissimos alias!
                            </p>
                        </div>
                        <div id="liked" class="tab-pane">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim id consequuntur explicabo ea eveniet qui ipsum quae commodi similique fuga ipsam reiciendis officia, tempora sapiente porro modi distinctio autem! Repellendus!
                                Quaerat optio mollitia beatae? Similique est, molestias eius quos voluptas porro necessitatibus sit facere repellat unde beatae accusamus id distinctio dolore tempora dolorem modi earum numquam laborum provident debitis architecto.
                                Provident minima est laudantium fugit dicta atque esse excepturi repudiandae quo iusto ipsam, animi id nulla, consectetur commodi quisquam facilis at accusamus dolorum iste et pariatur odit. Temporibus, dignissimos alias!
                            </p>
                        </div>
                        <div id="remark" class="tab-pane">
                            <p>
                                {!! $announcement->content !!}
                            </p>
                        </div>
                    </div>

                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--End Content Area-->

    {{-- start model area --}}
        <!-- start create modal -->
        <div id="createmodel" class="modal fade">
            <div class="modal-dialog modal-md modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Enroll Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_action" action="{{route('enrolls.store')}}" method="POST" enctype="multipart/form-data" class=""> 

                            {{csrf_field()}}
                            {{method_field("POST")}}
                            <div class="col-md-12 form-group mb-3">
                                <div class="gallery" style="h-100 ">
                                    <label for="image" class="w-100 h-100 text-center">
                                        <span>Choose Images</span>
                                    </label>
                                    
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="remark">Remark <span class="text-danger">*</span></label>
                                    <textarea type="text" name="remark" id="remark" class="form-control rounded-0" placeholder="Enter Remark" rows="3">{{old('remark')}}</textarea>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">

                                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                    </div>
                                </div>

                                {{-- start hidden fields --}}
                                <input type="file" name="image" id="image" class="form-control  rounded-0" hidden >
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>

        </div>
        <!-- end create modal -->
    {{-- end model area --}}




@endsection

@section("scripts")

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

            // start preview img
            var previewimages = function(input , output){
                // console.log(input,output)
                if(input.files){
                    var totalfiles = input.files.length;
                    console.log(totalfiles);

                    if(totalfiles > 0) {
                        $(".gallery").addClass("removetxt");
                    }else {
                        $(".gallery").removeClass("removetxt");
                    }
                    

                    for(var i = 0 ; i < totalfiles ; i++){
                        // console.log(i);

                        var filereader = new FileReader(); // input တွင် ဝင်လာသော file အား ဖတ်ပေးခြင်းဖြစ်သည် 

                        filereader.onload = function(e){ // e သည် file ကို ဖတ်လိုက်သော အခါ input result ကို ပြပေးမည်
                            $(output).html(" ");
                            $($.parseHTML("<img>")).attr("src",e.target.result).appendTo(output);

                            // image tag အား attr ဖြင့် src တည်ဆောက်သည်  ပတ်လမ်းကြောင်းသည် target အတွင်းရှိ result ကို ထည့်ပေးရမည်
                        }

                        filereader.readAsDataURL(input.files[i]); // file data တစ်ခုချင်းစီ အား loop ပတ်ပြီး ဖတ်ပေးမည်ဖြစ်သည် 
                    }
                }
            }
            $("#image").change(function(){
                previewimages(this,".gallery")
            })
            // start preview img
        })

        document.querySelector("#back_btn").addEventListener("click",function(){
            window.history.back();
        })

        // start tabs box
        // Get Ui
        var gettablinks = document.getElementsByClassName("tablinks");
        var gettabpanes = document.getElementsByClassName("tab-pane");


        function gettab(even,link){

            var tabpanes = Array.from(gettabpanes);
            tabpanes.forEach(function(tabpane){
            tabpane.style.display = "none";
            })
            for(let i = 0 ; i < gettablinks.length ; i++){
                gettablinks[i].className = gettablinks[i].className.replace(" active","")

                
            }
            document.getElementById(link).style.display = "block";

            even.currentTarget.className += " active";
        }

        document.getElementById("autoclick").click(); // page စ run သည် နှင့် click ခေါက်ထားမည်ဟုဆိုလိုသည်

        // end tabs box
    </script>
@endsection