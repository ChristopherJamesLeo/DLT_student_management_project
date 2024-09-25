@extends("layouts.adminindex")

@section("caption","Student List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">

        <div class="col-md-12 my-3">
            <a href="{{route('leads.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr>
        </div>


        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lead Number</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Pipe</th>
                    <th>By</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($leads as $idx=>$lead)

                <tr>

                    <td>{{++$idx}}</td>
                    <td><a href="{{route('leads.show',$lead->id)}}">{{$lead->leadnumber}}</a></td>

                    <td>{{$lead->firstname}} {{$lead->lastname}}</td>
                    {{-- မိမိတို့စာလံုးရေးပြပါက limit လုပ်ရန် --}}
                    <td>{{$lead->gender['name']}}</td>

                    <td>{{$lead->age}}</td>
                    <!-- Student Model ထဲတွင် statuses tabel  အား  belong to ဖြင့် ချိတ်ထားသောကြောင့် user ၏ table ထဲရှိ column အားလုံး ပေါ်လာမည်ဖြစ်သည်  -->
                    <td>{{$lead->email}}</td>
                    {{-- မိမိပျြချင်သော စာလုံးပြော်ငးရန်  --}}
                    <td>
                        <span class="badge {{$lead -> converted ? 'bg-success' : 'bg-danger'}}">Pipe</span>
                    </td>
                    <td>{{$lead->user['name']}}</td>

                    <td>{{$lead->created_at->format('d m Y')}}</td>
                    <td>{{$lead->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="{{route('leads.edit',$lead-->id)}}" class="me-3 btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>

                    </td>






                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
    <!--End Content Area-->




@endsection

@section("scripts")

@endsection
