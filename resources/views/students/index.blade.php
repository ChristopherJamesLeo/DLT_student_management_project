@extends("layouts.adminindex")

@section("caption","Student List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <a href="{{route('students.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr>
        </div>

    
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reg Number</th>
                    <th>Name</th>
                    <th>Remark</th>
                    <th>Status</th>
                    <th>By</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($students as $idx=>$student) 
                
                <tr>

                    <td>{{++$idx}}</td>
                    <td><a href="{{route('students.show',$student->id)}}">{{$student->regnumber}}</a></td>
                    
                    <td>{{$student->firstname}} {{$student->lastname}}</td>
                    {{-- မိမိတို့စာလံုးရေးပြပါက limit လုပ်ရန် --}}
                    <td>{{Str::limit($student->remark,10)}}</td>
                    
                    <!-- <td>{{$student->status["name"]}}</td> -->
                    <td>{{$student->status->slug}}</td>
                    <!-- Student Model ထဲတွင် statuses tabel  အား  belong to ဖြင့် ချိတ်ထားသောကြောင့် user ၏ table ထဲရှိ column အားလုံး ပေါ်လာမည်ဖြစ်သည်  -->
                    <td>{{$student->user["name"]}}</td>
                    {{-- မိမိပျြချင်သော စာလုံးပြော်ငးရန်  --}}
                     
                    <td>{{$student->created_at->format('d m Y')}}</td>
                    <td>{{$student->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="{{route('students.edit',$student->id)}}" class="me-3 btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        
                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$student->regnumber}}" ><i class="fas fa-trash"></i></a>
 
                       
                        

                        
                    </td>
                    <form id="formdelete{{$student->regnumber}}" action="{{route('students.destroy',$student->id)}}" method="POST">
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
        })
    </script>
@endsection