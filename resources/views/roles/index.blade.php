@extends("layouts.adminindex")
@section("css")
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endsection
@section("caption","Role List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <a href="{{route('roles.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr>
        </div>
        <div class="col-md-12">
            <form action="" method="">
                <div class="row justify-content-end">
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="form-group">
                            <select name="filterstatus_id" id="filterstatus_id" class="form-control form-control-sm rounded-0" value="{{request("filterstatus_id")}}">
                                {{-- အားလုံးပြရန် value ကို " " ထားပေးရမည် method 1 --}}
                                {{-- <option value=" " selected >Choose Status...</option> --}}
                                @foreach ($filterstatuses as $id => $name)
                                {{-- database မှ id နှင့် queryမှ id သည် datatype ကွဲနိုင်သောကြာင့် == ဖြင့်သာ စစ်သင့်သည်  --}}
                                    <option value="{{$id}}" {{$id == request("filterstatus_id") ? "selected" : " " }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div>
            <table id="mytable"  class="table table-hover border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>By</th>
                        <th>Create At</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach($roles as $idx=>$role) 
                    
                    <tr>
    
                        {{-- <td>{{++$idx}}</td> --}}
                        <td>{{$idx+ $roles->firstItem()}}</td>
                        <td>
                            <a href="{{route('roles.show',$role->slug)}}">
                                <img src="{{asset($role->image)}}" class="rounded-circle" style="width:40px;height:40px" alt="{{$role->image}}">
                            </a>
                            
                        </td>
    
                        
                        <td>{{$role->name}}</td>
                        <td>
                            <div class="form-checkbox form-switch">
                                <input type="checkbox" name="" id="" class="form-check-input change-btn" {{$role->status_id == "3" ? "checked" : ""}}
                                {{-- type ကိုပြင်ရန် id သတ်မှတ်ရမည် --}}
                                data-id = {{$role->id}}
                                >
                            </div>
                        </td>
                        <td>{{$role->user["name"]}}</td>
                         
                        <td>{{$role->created_at->format('d m Y')}}</td>
                        <td>{{$role->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="{{route('roles.edit',$role->slug)}}" class="me-3 btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                            
                            <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$role->$idx}}" ><i class="fas fa-trash"></i></a>
    
                        </td>
                        <form id="formdelete{{$role->$idx}}" action="{{route('roles.destroy',$role->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        
    
                        
    
                        
                        
                    </tr>
                    @endforeach
                </tbody>
                
            </table>

            {{$roles->links("pagination::bootstrap-4")}}
        </div>
        
        
    </div>
    <!--End Content Area-->




@endsection

@section("scripts")
{{-- datatable css1 js1 --}}
{{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}

    <script>

        let getfilterstatus = document.getElementById("filterstatus_id");
        getfilterstatus.addEventListener("change",function(){
           
            // const getstatusid = this.value;
            // or
            // const getstatusid =  this.options[this.selectedIndex].value;
            // or
            const getstatusid = this.value || this.options[this.selectedIndex].value;

            // console.log(getstatusid);
            const getcururl = window.location.href;

            window.location.href = getcururl.split("?")[0]  + "?filterstatus_id=" +getstatusid;
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
            // $("#mytable").DataTable();

            // start change status btn
            $(".change-btn").click(function(){
                // console.log($(this).data("id"));

                var getid = $(this).data("id");

                // prop ဖြင့် checkbox သည် prop ဖြင့် check ဖြစ်သလား ဖြစ်လှျင်3 မဖြစ်လှျင် 4
                var setstatus = $(this).prop("checked") === true ? 3 : 4;
                
                // change API 
                $.ajax({
                    url : "rolestatus", //route list ထဲရှီ route name ကို ပို့ပေးရမည်
                    type : "GET", // route ကို ဖမ်းတီးရာတွင် GET ဖြစ်သော ကြောင့် GET ဖြင့် သ့ဒဂပေးရမည်
                    
                    dataType : "json",
                    data : {
                        // columnName : value
                        "id" : getid,
                        "status_id" : setstatus
                    },
                    success : function(response){
                        console.log(response.success); // return ပြန်လာသော data အား ယူမည် 
                    }
                    
                });
            })
            // end change status btn
        })
    </script>
@endsection