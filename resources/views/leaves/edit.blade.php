@extends("layouts.adminindex")
@section("css")
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .gallery {
            width: 100%;
            height: 100%;
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
    </style>
@endsection

@section("caption","Edit Leave")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <form action="{{route('leaves.update',$leave->id)}}" method="POST" enctype="multipart/form-data" class=""> 
                
                @csrf
                @method("PUT")
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{asset($leave->image)}}" width="200px" alt="{{$leave->title}}">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gallery" style="h-100 ">
                                            <label for="images" class="w-100 h-100 text-center">
                                                <span>Choose Images</span>
                                            </label>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="startdate" id="startdate" class="form-control rounded-0" placeholder="Enter startdate" value="{{$leave->startdate}}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="enddate">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="enddate" id="enddate" class="form-control rounded-0" placeholder="Enter enddate" value="{{$leave->enddate}}">
                            </div>
                        </div>
                        
                      
                        
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <input type="file" name="images[]" multiple id="images" class="form-control  rounded-0" hidden>
                            <div class="col-md-12 col-sm-12 form-group mb-1">
                                <label for="name">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="name" class="form-control rounded-0" placeholder="Enter Leave" value="{{$leave->title}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="post_id">Class <span class="text-danger">*</span></label>

                                <select name="post_id[]" id="post_id" class="form-control form-contrl-sm rounded-0" multiple>

                                    {{-- ?? Coalescing operator 
                                        $value = $variable ?? default value  // variable သည် မိမိပေးစေချင်သော value ဖြစ်သလား ဖြစ်ရင် ၄င်း value ကိုယူမည် မဖြစ်ပါက default value ကိုယူမည်ဖြစ်သည် 
                                    --}}
                                    @foreach ($posts as $idx => $title)
                                                                {{-- json အား decode ပြန်လုပ်ပေးမည် ထို့နောက် inarray ဖြင့် json မှ ရလာသော array ထဲတွင် id ပါသလား ပါရင် true မပါရင် false  --}}
                                        {{-- <option value="{{$idx}}" {{ in_array($idx,json_decode($leave->post_id,true)) ? "selected" : "" }} {{$idx == $leave->post_id ? "selected" : ""}}>{{$title}}</option> --}}
                                        {{-- or --}}
                                        <option value="{{$idx}}" {{ in_array($idx,json_decode($leave->post_id,true) ?? [] ) ? "selected" : ""}} {{$idx == $leave->post_id ? "selected" : ""}}>{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 form-group mb-1">
                                <label for="tag">Tag <span class="text-danger">*</span></label>
                                
                                <select name="tag[]" id="tag" class="form-control form-contrl-sm rounded-0" multiple>

                                    @foreach ($users as $idx => $name)
                                                                     {{-- array ထဲမှာ tag ပါလာ ပါရင် ??  ဖြင့် ယူမယ် မပါရင် [] ထားမည် ထို့နောက် in array ဖြင့် မှန်လားမှားလားစစ်ပြီး select လုပ်မည်  --}}
                                        <option value="{{$idx}}" {{ in_array( $idx ,json_decode($leave -> tag, true) ?? []) ? "selected" : ""  }} {{$idx == $leave->tag ? "selected" : ""}}>{{$name}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 form-group mb-1">
                                <label for="stage_id">Stage <span class="text-danger">*</span></label>

                                <select name="stage_id" id="stage_id" class="form-control form-contrl-sm rounded-0">
                                    @foreach ($stages as $idx => $name)
                                        <option value="{{$idx}}" {{$idx == $leave->stage_id ? "selected" : ""}}>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 form-group mb-1">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea type="text" name="content" id="content" class="form-control rounded-0" rows="5" placeholder="Say Something..." >{{$leave->content}}</textarea>
                            </div>
                            
                            <div class="mt-4 col-md-3">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('leaves.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    

                </div>
            </form>
        </div>

    </div>
    <!--End Content Area-->




@endsection



@section("scripts")
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
        $(document).ready(function(){

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
                            
                            $($.parseHTML("<img>")).attr("src",e.target.result).appendTo(output);

                            // image tag အား attr ဖြင့် src တည်ဆောက်သည်  ပတ်လမ်းကြောင်းသည် target အတွင်းရှိ result ကို ထည့်ပေးရမည်
                        }

                        filereader.readAsDataURL(input.files[i]); // file data တစ်ခုချင်းစီ အား loop ပတ်ပြီး ဖတ်ပေးမည်ဖြစ်သည် 
                    }
                }
            }
            $("#images").change(function(){
                previewimages(this,".gallery")
            })

            $("#post_id").select2({
                placeholder : "Choose Class"
            })

            $("#tag").select2({
                placeholder : "Choose Authorize Person..."
            })

            $("#startdate,#enddate").flatpickr({
                dateFormat: "Y-m-d",
                minDate: "today",
                maxDate: new Date().fp_incr(30)
            });
        })

                    // start text editor
      $('#content').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });


    </script>
@endsection


<!-- 
    
    update-> လုပ်ခဲ့ရန် 
    အပိတ် အဖွင့် လုပ်မည် 

 -->