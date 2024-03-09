@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","announcement List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <a href="{{route('announcements.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr>
        </div>

        <table class="table table-hover border" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Class</th>
                    <th>By</th>
                    <th>Cretate at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($announcements as $idx=>$announcement) 
                
                <tr>

                    <td>{{++$idx}}</td>
                    <td>
                        <a href="{{route('announcements.show',$announcement->id)}}">
                            <img src="{{asset($announcement->image)}}" class="rounded-circle" style="width:40px;height:40px" alt="{{$announcement->image}}">
                            <span>{{$announcement->title}}</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('posts.show',$announcement->post->id)}}">
                            {{$announcement->post->title}}
                        </a>
                    </td>
                    <td>{{$announcement->user["name"]}}</td>
                     
                    <td>{{$announcement->created_at->format('d m Y')}}</td>
                    <td>{{$announcement->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="{{route('announcements.edit',$announcement->id)}}" class="me-3 btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$announcement->$idx}}" ><i class="fas fa-trash"></i></a>

                    </td>
                    <form id="formdelete{{$announcement ->$idx}}" action="{{route('announcements.destroy',$announcement->id)}}" method="POST">
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