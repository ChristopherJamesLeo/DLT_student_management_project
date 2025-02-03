@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","leave List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        {{-- method 1 --}}
        {{-- @if(auth()->user()->hasRole(["Admin","Teacher","Student"]))
        <div class="col-md-12 my-3">
            <a href="{{route('leaves.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr>
        </div>
        @endif --}}

        {{-- method 2 --}}
        @can("create",App\Models\Leave::class)  {{-- policy method name , model --}}
        <div class="col-md-12 my-3">
            <a href="{{route('leaves.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr>
        </div>
        @endcan

        <div class="row">
            <div class="col-md-12">
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-4 col-sm-6 mb-2">
                           
                        </div>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="form-group">
                                <select name="filter" id="filter" class="form-select form-control-sm rounded-0" value="{{request("filter")}}">
                                    {{-- အားလုံးပြရန် value ကို " " ထားပေးရမည် method 1 --}}
                                    {{-- <option value=" " selected >Choose Status...</option> --}}
                                    {{-- @foreach ($filterposts as $id => $title) --}}
                                    {{-- database မှ id နှင့် queryမှ id သည် datatype ကွဲနိုင်သောကြာင့် == ဖြင့်သာ စစ်သင့်သည်  --}}
                                        {{-- <option value="{{$id}}" {{$id == request("filter") ? "selected" : " " }}>{{$title}}</option>
                                    @endforeach --}}
                                    <option value="">Choose Class ...</option>
                                    @foreach($posts as $id => $name)
                                        <option value="{{$id}}" {{$id == request("filter") ? "selected" : " "}}>{{$name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="search" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request("search")}}">
                                <button type="submit" id="btn-search" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                                <button type="button" id="btn-clear" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
    
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-hover border" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Students</th>
                    <th>Class</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Tag</th>
                    <th>Stage</th>
                    <th>By</th>
                    <th>Cretate at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($leaves as $idx=>$leave) 
                
                <tr>

                    <td>{{$idx + $leaves -> firstitem()}}</td>
                    <td><a href="{{route('students.show',$leave->studentUrl())}}">{{$leave -> student($leave->user_id)}}</a></td>
                    <td><a href="{{route('leaves.show',$leave->id)}}">{{Str::limit($leave->title, 20)}}</a></td>
                    <td>{{$leave->startdate}}</td>
                    <td>{{$leave->enddate}}</td>
                    {{-- <td>{{$leave->tagperson->name}}</td> --}}
                    <td>{{$leave->stage["name"]}}</td>
                    <td>{{$leave->user["name"]}}</td>
                     
                    <td>{{$leave->created_at->format('d m Y')}}</td>
                    <td>{{$leave->updated_at->format('d M Y')}}</td>
                    <td>

                        <a href="{{route('leaves.show',$leave->id)}}" class="me-3 btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>

                        <a href="{{route('leaves.edit',$leave->id)}}" class="me-3 btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$leave->$idx}}" ><i class="fas fa-trash"></i></a>

                    </td>
                    <form id="formdelete{{$leave->$idx}}" action="{{route('leaves.destroy',$leave->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                </tr>
                @endforeach
            </tbody>
            
        </table>
        {{$leaves ->appends(request()->only("filter"))-> links()}}
    </div>
    <!--End Content Area-->




@endsection

@section("scripts")
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>


        // start filter
        document.getElementById("filter").addEventListener("change",function(){
            let getfilterid = this.value || this.options[this.selectedIndex].value;
            window.location.href = window.location.href.split("?")[0]+"?filter="+getfilterid;

        })
        // end filter

        // start clear filter 
        document.getElementById("btn-clear").addEventListener("click",function(){
            // window.location.href = window.location.href.split("?")[0]+"?filter=&search=";
            const getfilter = document.getElementById("filter");
            const getsearch = document.getElementById("search");
            getfilter.selectedIndex = 0; // select box မှ index ကို 0 ပြန်ထားမည်
            getsearch.value = "";

            
            window.location.href = window.location.href.split("?")[0];
        })
        // end clear filter

                // start auto show clear btn
                const autoshowbtn = function(){
            let getBtnClear = document.getElementById("btn-clear");
            let getUrlQuery = window.location.search; // url ထဲရှိ query ကို ဆွဲထုတ်မည်
            let pattern = /[?&]search=/; // url ထဲရှိ search ဟူသော ကောင်ပါသလား ? နှင့် & ပါသလား  (true/false)
            if(pattern.test(getUrlQuery)){
                // pattern ထဲရှိ စာသားသည် test ထဲရှိစာသားနှင့် တူညီသလား စစ်သည် js default function
                getBtnClear.style.display = 'block';
            }else{
                getBtnClear.style.display = 'none';

            }
        }
        autoshowbtn();
        // end auto show clear btn

        $(document).ready(function(){
            $(".delete-btns").click(function(){
                // console.log("hello");
                var getidx = $(this).data("idx");

                if(confirm(`Are Your Sure!! You want to delete ${getidx}`)){
                    $("#formdelete"+getidx).submit();
                }else{

                }
            })

            // for my table
            // let table = new DataTable('#mytable');
            // $("#mytable").DataTable();

        })
    </script>
@endsection

{{-- index page အားလုံ data table နှင့်ချိတ်ခဲ့ရန်  --}}