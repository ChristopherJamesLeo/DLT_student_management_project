@extends("layouts.adminindex")
@section("css")
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

@section("caption","Create Role")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <form action="/roles" method="POST" enctype="multipart/form-data" class=""> 
                
                @csrf
                @method("POST")
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="gallery" style="h-100 ">
                            <label for="image" class="w-100 h-100 text-center">
                                <span>Choose Images</span>
                            </label>
                        </div>
                        
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 form-group mb-2">
                                <label for="image">Image</label>
                                @error("image")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="file" name="image" id="image" class="form-control  rounded-0 @error("image") is-invalid @enderror" value="{{old('image')}}">

                                
                            </div>
                            <div class="col-md-6 col-sm-12 form-group mb-1">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="text" name="name" id="name" class="form-control rounded-0 @error("name") is-invalid  @enderror" placeholder="Enter Role Name" value="{{old('name')}}" >
                            </div>
                            <div class="col-md-6 form-group">
                                <select name="status_id" id="" class="form-control form-contrl-sm rounded-0">
                                    <option selected disabled>Choose Status</option>
                                    {{-- @foreach ($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach --}}

                                    {{-- pluck ဖြင့် ဆွဲထုတ်လာသောကြောင့် တိုက်ရိုက်ထွက်လာသည် --}}
                                    @foreach ($statuses as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error("status_id")
                                    <span class="invalid-feedback text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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

    </script>
@endsection