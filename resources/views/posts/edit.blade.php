@extends("layouts.adminindex")
@section("css")
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

@section("caption","Edit Post")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <form action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data" class=""> 
                
                @csrf
                @method("PUT")
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{asset($post->image)}}" width="200px" alt="{{$post->title}}">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gallery" style="h-100 ">
                                            <label for="image" class="w-100 h-100 text-center">
                                                <span>Choose Images</span>
                                            </label>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="startdate" id="startdate" class="form-control rounded-0" placeholder="Enter startdate" value="{{$post->startdate}}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="enddate">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="enddate" id="enddate" class="form-control rounded-0" placeholder="Enter enddate" value="{{$post->enddate}}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="starttime">Start Time <span class="text-danger">*</span></label>
                                <input type="time" name="starttime" id="starttime" class="form-control rounded-0" placeholder="Enter starttime" value="{{$post->starttime}}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="endtime">End Time <span class="text-danger">*</span></label>
                                <input type="time" name="endtime" id="endtime" class="form-control rounded-0" placeholder="Enter endtime" value="{{$post->endtime}}">
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="">Days<span class="text-danger">*</span></label>
                                <div class="d-flex flex-wrap">
                                    @foreach($days as $idx => $day)
                                    <div class="form-check form-switch mx-3">
                                        <input type="checkbox" name="day_id[]" id="day_id{{$idx}}" class="form-check-input" value="{{$day->id}}"  

                                        @foreach($dayables as $dayable)
                                            @if($dayable["id"] === $day["id"])
                                                checked 
                                            @endif
                                        @endforeach
                                        
                                        /><Label for="day_id{{$idx}}">{{$day->name}}</Label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                      
                        
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <input type="file" name="image" id="image" class="form-control  rounded-0" hidden>
                            <div class="col-md-12 col-sm-12 form-group mb-1">
                                <label for="name">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="name" class="form-control rounded-0" placeholder="Enter Post Name" value="{{$post->title}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="type">Type <span class="text-danger">*</span></label>

                                <select name="type_id" id="type" class="form-control form-contrl-sm rounded-0">
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}"
                                            @if($type["id"]===$post["type_id"])

                                            selected

                                            @endif
                                        >{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 form-group mb-1">
                                <label for="fee">Fee <span class="text-danger">*</span></label>
                                <input type="number" name="fee" id="fee" class="form-control rounded-0" placeholder="Class Fee" value="{{$post->fee}}">
                            </div>
                            <div class="col-md-12 col-sm-12 form-group mb-1">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea type="text" name="content" id="content" class="form-control rounded-0" rows="5" placeholder="Say Something..." >{{$post->content}}</textarea>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="tag_id">Tag <span class="text-danger">*</span></label>
                                <select name="tag_id" id="tag_id" class="form-control form-contrl-sm rounded-0">
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}"
                                        @if($tag["id"]===$post["tag_id"])

                                            selected

                                        @endif
                                        >{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="attshow">Show On Att Form <span class="text-danger">*</span></label>
                                <select name="attshow" id="attshow" class="form-control form-contrl-sm rounded-0">
                                    @foreach ($attshows as $attshow)
                                        <option value="{{$attshow->id}}"
                                        @if($attshow["id"]===$post["attshow"])

                                            selected

                                        @endif
                                        >{{$attshow->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status_id" id="status" class="form-control form-contrl-sm rounded-0">
                                    @foreach ($statuses as $status)
                                        <option value="{{$status->id}}"
                                        {{ ($status -> id === $post['status_id'] ) ? 'selected' : '' }}
                                        >{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mt-4 col-md-3">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('posts.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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