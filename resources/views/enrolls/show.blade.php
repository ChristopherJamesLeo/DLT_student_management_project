@extends("layouts.adminindex")


@section("css")
    <link rel="stylesheet" href="{{asset('assets/libs/lightbox2-dev/dist/css/lightbox.min.css')}}">
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

        .accordion {
    width: 100%;
}
.acctitle {
    font-size: 13px;
    padding: 5px;
    margin: 0px;

    cursor: pointer;
    user-select: none;
    transition: all 0.1s ease 0s;

    position: relative;
}
.acctitle i{
    margin-right: 10px;
}
.acctitle::after{
    content: "\f0e0";
    font-family: "Font Awesome 5 Free";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.5s ease-in 0s;
}
.acctitle:hover , .shown{
    /* background-color: #4682b4; */
}
.accordion.shown .acctitle {
    /* background-color: #4682b4; */
}
.accortent{
    height: 0;
    background-color: #f4f4f4;
    text-align: justify;
    font-size: 13px;
    padding: 0px 10px;
    line-height: 1.5;
    overflow: hidden;
    transition: all 0.5s ease 0s;
}
.shown::after{
    content: '\f2b6';
}
    </style>
@endsection
@section("caption","enroll List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <a href="javascript:void(0)" id="back_btn" class="btn btn-secondary btn-sm rounded-0">Back</a>
            <a href="{{route('enrolls.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>

            
            <hr>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card rounded-0">
                    <div class="card-body text-center">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <img src="{{asset($enroll->image)}}" alt="{{asset($enroll->image)}}">
                            </div>
                        </div>
                        <h5 class="card-title">{{$enroll -> title}} </h5>
                        <span>{{$enroll->stage->name}} for {{$enroll->post["title"]}}</span>
                    </div>
                    <ul class="list-group">
                        
                        
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                               
                               
                                <div class="row gap-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    {{-- <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Authorize</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">
                                                    @foreach ($enroll -> tagpersons($enroll->tag) as $id => $name)
                                                        <a href="{{route("students.show",$enroll->tagpersonUrl($id))}}">{{$name}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
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
                                                    {{date("d M Y ",strtotime($enroll->created_at))}} | {{date("h:m:s a ",strtotime($enroll->created_at))}}
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
                                                    {{date("d M Y h:m:s A",strtotime($enroll->updated_at))}}
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
                            
                            <div class="card-body border-top">
                                <form action="{{route('comments.store')}}" method="POST" >

                                    @csrf 

                                    @method("POST")

                                    <div class="col-md-12 d-flex justify-content-between">
                                        <textarea name="description" id="description" rows="1" class="form-control border-0 shadow-none outline-none rounded-0 " style="resize:none;" placeholder="Comment Here....">{{old("description")}}</textarea>
                                        <button type="submit" class="me-auto btn btn-info btn-sm text-light ms-3"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                    

                                    <!-- start Hidden fields -->
                                    <input type="hidden" name="commentable_id" id="commentable_id" value="{{$enroll->id}}">

                                    <input type="hidden" name="commentable_type" id="commentable_type" value="App\Models\enroll">
                                    <!-- end Hidden fields -->

                                </form>
                            </div>
                        </div>

                        {{-- @if(auth()->user()->hasRole(["Admin","Teacher"]))
                        
                        <h6>Compose</h6>

                        <div class="card border-0 rounded-0 shadow mb-4">
                            <div class="card-body d-flex flex-wrap gap-3">
                                <div class="accordion ">
                                    <h1 class="acctitle "><i class="fas fa-hand-point-right"></i>Email </h1>
                                    <div class="accortent ">
                                        <div class="py-3 col-md-12">
                                            <form action="{{route('students.mailbox')}}" method="POST">
                                                @csrf 
                                                @method("POST")
                                                <div class="row">
                                                    <div class="col-md-6 form-group mb-3">
                                                        <input type="email" name="cmpemail" id="cmpemail" class="form-control form-control-sm border-0 rounded-0 shadow-none" placeholder="To" value="{{$enroll->user["email"]}}" readonly> 
                                                    </div>
                                                    <div class="col-md-6 form-group mb-3">
                                                        <input type="text" name="comsubject" id="cmpsubject" class="form-control form-control-sm border-0 rounded-0 shadow-none" placeholder="Subject"> 
                                                    </div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <textarea style="resize: none" rows="3" name="cmpcontent" id="cmpcontent" class="form-control form-control-sm border-0 rounded-0 shadow-none" placeholder="Your message here..."></textarea>
                                                    </div>
                                                    <div class="col d-flex justify-content-end align-items-end">
                                                        <button type="submit" class="btn btn-sm btn-secondary rounded-0">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        @endif --}}

                        <h6>Enrolls</h6>
                        <div class="mb-4 card border-0 shadow rounded-0">
                            <div class="card-body d-flex flex-wrap gap-3">

                                <div class="border shadow p-3 mb-3 enrollboxes">
                                    <a href="{{route('posts.show',$enroll->post['id'])}}">{{$enroll->post["title"]}}</a>
                                </div>
                                

                            </div>

                        </div>

                <div class="mb-4 card border-0 shadow rounded-0">
                    <ul class="nav">
                        <li class="nav-item "><button type="button" id="autoclick" class="tablinks active" onclick="gettab(event,'content')">Content</button></li>
                        <li class="nav-item "><button type="button" id="autoclick" class="tablinks " onclick="gettab(event,'enrollments')">Enrollments</button></li>
                    </ul>


                    <div class="tab-content">
                        
                        <div id="content" class="tab-pane">
                            <p>
                                {!! $enroll->remark !!}
                            </p>
                        </div>
                        <div id="enrollments" class="tab-pane">
                            <p>
                                {!! $enroll->remark !!}
                            </p>
                        </div>
                    </div>

                </div>
                <div class="row">
                    @if (auth()->user()->hasRole(["Admin","Teacher"]))
                        <div class="col-md-12 my-3">
                            <h5>Authorize</h5>
                            
                        
                            <form action="/enrolls/{{$enroll->id}}/updatestage" method="post" class="">
                
                                @csrf
                                @method("PUT")
                
                                {{-- old('firstname')  သည် refresh ဖြစ်ပြီး data reject ဖြစ်၍ ပြန်လာပါက မူလပေးခဲ့သောစာသားကို မပြောက်ဘဲ invalit ဖြစ်နေသော data input box တစ်ခုတည်းသာ blank ဖြစ်ပြီး အရင် ထည့်ခဲ့သော data ကိူ ပြန်ဖော်ပြပေးနေမည် --}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12 form-group mb-1">
                                                {{-- <label for="stage_id">Choose Stage</label> --}}
                                                <select name="stage_id" id="stage_id" class="form-control rounded-0 gender_id">
                                                    <option selected disabled>Choose Stage</option>
                        
                                                    @foreach($stages as $id => $stage)
                                {{--                           <option value="{{$gender->id}}" {{$gender['id'] == $lead->gender->id ? "selected" : ""}}>{{$gender['name']}}</option>--}}
                                                        <option value="{{$stage->id}}" {{$enroll->stage_id == $stage->id ? "selected" : ""}}>{{$stage['name']}}</option>
                                                    @endforeach
                        
                                                </select>
                                                @if($enroll -> isconverted())
                                                    <small class="text-danger">This enroll form has already been converted to an authtorize stage</small>
                                            
                                                @endif
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3" {{$enroll -> isconverted() ? "disabled" : " "}}>Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                   
                                </div>
                            </form>
                        </div>
                    @endif
                    
                    <h6>Additional Info</h6>
                    <div class="col-md-12">
                        @if (!empty($enrollfiles) && $enrollfiles->count() > 0)
                             <div class="row">
                                @foreach ($enrollfiles as $id => $enrollfile)
                                <div class="col-6">
                                    <a href="{{asset($enrollfile->image)}}" data-lightbox ="{{$enrollfile->id}}">
                                        <img src="{{asset($enrollfile->image)}}" width="130px" alt="{{$enrollfile->id}}">
                                    </a>
                                    
                                </div>
                            
                                @endforeach
                             </div>
                         
                        @endif
                    </div>

                    <div class="col-md-12">
                        <table id="mytable" class="table table-hover border">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Student Id</th>
                                    <th>Class</th>
                                    
                                    <th>Stage</th>
                                    <th>Create At</th>
                                    <th>Updated at</th>
                                </tr>
                            </thead>
                
                            <tbody>
                                @foreach($enrollments as $idx=>$enrollment) 
                                
                                <tr>
                
                                    <td>{{++$idx}}</td>
                                    {{-- <td>{{$enroll ->student($enroll->user_id)}}</td> --}}
                                    {{-- <td><a href="{{route('students.show',$enroll -> studenturl())}}">{{$enroll ->student($enroll->user_id)}}</a></td> --}}
                                    <td><a href="{{route('enrolls.show',$enrollment -> id)}}">{{$enrollment ->student($enrollment->user_id)}}</a></td>
                                    <td>{{$enrollment ->post->title}}</td>
                                    
                                    <td>{{$enrollment->stage->name}}</td>
                                     
                                    <td>{{$enrollment->created_at->format('d m Y')}}</td>
                                    <td>{{$enrollment->updated_at->format('d M Y')}}</td>
                
                                    
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
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
                                <input type="hidden" name="enroll_id" value="{{$enroll->id}}">
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
    <script src="{{asset('assets/libs/lightbox2-dev/dist/js/lightbox.min.js')}}"></script>
    <script>
        lightbox.option({
            "resizeDuration" : 50,
            "wrapAround" : true
        })
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

                // start accordian

        let getacctitle = document.querySelectorAll(".acctitle");
        let getactiveacctitle = document.querySelectorAll(".accortent");
        // console.log(getactiveacctitle);
        for( var i = 0 ; i < getacctitle.length ; i++){
            // console.log(list[i]);
            getacctitle[i].addEventListener("click", function(e){
                // console.log(e)
                // console.log(e.target) // event နှိပ်လိုက်သော tag ၏ target ကို သိရှိစေရန်
                // console.log(this) // this key word သည် နှိပ်လိုက်သော tag အား  သူ့ကိုသူ ပြန်လည်ပြောခြင်းဖြစ်သည် example . event.target နှင့်ညီသည် 
                this.classList.toggle("shown");
                // console.warn(e.target.children[0]);
                // nextElementSibling သည် this တွင်ဝင်နေသော tag နှင့် တစ်တန်းထဲ ရှီနေသော ဖြစ်သူ tag အား ခေါ်ပေးမည်ဖစ်သည် 
                var getcontent = this.nextElementSibling;
                // console.log(getcontent);
                // console.log(getcontent.scrollHeight) // scrollHeight သည် element ၏ height ကို number data type ဖြင့် ဖော်ပြပေးမည်ဖြစ်သည် ထို့ကြောင့် အောက်ပါ အတိုင်း ၄င်း property အား အသုံးချနိုင်သည် 
                // getcontent.style.height = getcontent.scrollHeight+"px"; 
                if(getcontent.style.height){
                    // getcontent.style.height = "0px"; // ၄င်းသည် 0 px ပေးထားသောကြောင့်  HTML ထဲတွင် သွားထည့်ပေးမည်ဖြစ်သည်။ သို့သော် ပထမတစ်ကြိမ်ကတည်းက ဝင်နေမည်ဖြစ်သောကြောင့် ဒုတိယတစ်ကြိမ် ပြန်လည် run သည့်အခါ ၄င်း height သည် ရှိနေပြီးဖြ့စ်ပြီး tag height porperty သည် 0px သာဖြစ်နေမည် ထို့ကြောင့် ၄င်း height အား ရှိနေပါက အပြီးသတ် css property ပါဖျောက်ရန် NULL တန်ဖိုး‌ပေးရမည်ဖြစ်သည် သို့မှသာ heigt property သည် tag အတွင်းမှ မပြီးပျောက်သွားမည်ဖြစ်သည် ။
                    getcontent.style.height = null;
                }else {
                    getcontent.style.height = getcontent.scrollHeight+"px"; 
                }
            })     
            if(getacctitle[i].classList.contains("shown")) {
                // contains() သည် classList အတွင်း () အထဲရှိ class ပါသလားကို စစ်ပေးသော method ဖြစ်သည် 
                getactiveacctitle[i].style.height = getactiveacctitle[i].scrollHeight+ "px";
            }
        }
        // end accordian
    </script>
@endsection