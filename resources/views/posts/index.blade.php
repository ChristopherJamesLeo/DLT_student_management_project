@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Post List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <a href="{{route('posts.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr>
        </div>

        <table class="table table-hover border" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Fee</th>
                    <th>Type</th>
                    <th>Tag</th>
                    <th>Att Form</th>
                    <th>Status</th>
                    <th>By</th>
                    <th>Cretate at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($posts as $idx=>$post) 
                
                <tr>

                    <td>{{++$idx}}</td>
                    <td>
                        <a href="{{route('posts.show',$post->id)}}">
                            <img src="{{asset($post->image)}}" class="rounded-circle" style="width:40px;height:40px" alt="{{$post->image}}">
                            <span>{{$post->title}}</span>
                        </a>
                        
                    </td>
                    <td>{{$post->startdate}}</td>
                    <td>{{$post->enddate}}</td>
                    <td>{{$post->starttime}}</td>
                    <td>{{$post->endtime}}</td>
                    <td>{{$post->fee}}</td>
                    <td>{{$post->type->name}}</td>
                    <td>{{$post->tag->name}}</td>
                    <td>{{$post->attstatus->name}}</td>
                    <td>{{$post->status->name}}</td>
                    <td>{{$post->user["name"]}}</td>
                     
                    <td>{{$post->created_at->format('d m Y')}}</td>
                    <td>{{$post->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="{{route('posts.edit',$post->id)}}" class="me-3 btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$post->$idx}}" ><i class="fas fa-trash"></i></a>

                    </td>
                    <form id="formdelete{{$post->$idx}}" action="{{route('posts.destroy',$post->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    

                    

                    
                    
                </tr>
                @endforeach
            </tbody>
            
        </table>
        
    </div>
    <!--End Content Area-->




@endsection

@section("scripts")
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
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

            // for my table
            // let table = new DataTable('#mytable');
            $("#mytable").DataTable();

        })
    </script>
@endsection

{{-- index page အားလုံ data table နှင့်ချိတ်ခဲ့ရန်  --}}