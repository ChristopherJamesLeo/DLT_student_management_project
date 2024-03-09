@extends("layouts.adminindex")
@section("css")
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
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
    </style>
@endsection

@section("caption","Create Announcement")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <form action="/announcements"  method="POST" enctype="multipart/form-data"> 
                
                @csrf
                @method("POST")
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <div class="gallery" style="h-100 ">
                                    <label for="image" class="w-100 h-100 text-center">
                                        <span>Choose Images</span>
                                    </label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            
                            <input type="file" name="image" id="image" class="form-control  rounded-0" hidden>
                            <div class="col-md-6 col-sm-12 form-group mb-1">
                                <label for="name">Title <span class="text-danger">*</span></label>
                                @error("title") 
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="text" name="title" id="name" class="form-control rounded-0 @error("title") is-invalid @enderror" placeholder="Enter Title" value="{{old('title')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="post_id">Class <span class="text-danger">*</span></label>
                               
                                <select name="post_id" id="post_id" class="form-control form-contrl-sm rounded-0">
                                    <option value="" selected disabled>Choose Class...</option>
                                    @foreach ($posts as $id => $title)
                                        <option value="{{$id}}">{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 form-group mb-1">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                
                                <textarea type="text" name="content" id="content" class="form-control rounded-0" rows="5" placeholder="Say Something..." >{{old('fee')}}</textarea>
                            </div>
                            
                         

                            
                            <div class="mt-4 col-md-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('announcements.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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

        })

    </script>
@endsection