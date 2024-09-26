@extends("layouts.adminindex")

@section("caption","Edit Student")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">

        <div class="col-md-12 my-3">
            <form action="/leads/{{$lead->id}}" method="POST" enctype="multipart/form-data" class="">

                @csrf
                @method("PUT")

                {{-- old('firstname')  သည် refresh ဖြစ်ပြီး data reject ဖြစ်၍ ပြန်လာပါက မူလပေးခဲ့သောစာသားကို မပြောက်ဘဲ invalit ဖြစ်နေသော data input box တစ်ခုတည်းသာ blank ဖြစ်ပြီး အရင် ထည့်ခဲ့သော data ကိူ ပြန်ဖော်ပြပေးနေမည် --}}
                <div class="row">
                    <div class="col-md-4 col-sm-12 form-group mb-1">
                        <label for="firstname">First name <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" id="firstname" class="form-control rounded-0" placeholder="First Name" value="{{$lead->firstname}}">
                    </div>
                    <div class="col-md-4 col-sm-12 form-group mb-2">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control  rounded-0" placeholder="last name" value="{{$lead->lastname}}">
                    </div>
                    <div class="col-md-3 col-sm-12 form-group mb-1">
                        <label for="gender_id">Gender</label>
                        <select name="gender_id" id="gender_id" class="form-control rounded-0 gender_id">

                            @foreach($genders as $gender)
{{--                                <option value="{{$gender->id}}" {{$gender['id'] == $lead->gender->id ? "selected" : ""}}>{{$gender['name']}}</option>--}}
                                <option value="{{$gender->id}}" {{$gender['id'] == old('gender_id',$lead->gender_id) ? "selected" : ""}}>{{$gender['name']}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group mb-2">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" class="form-control  rounded-0" placeholder="Age" value="{{$lead->age}}">
                    </div>
                    <div class="col-md-3 col-sm-12 form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control  rounded-0" placeholder="email" value="{{$lead->email}}">
                    </div>
                    <div class="col-md-3 col-sm-12 form-group mb-1">
                        <label for="country_id">Country</label>
                        <select name="country_id" id="country_id" class="form-control rounded-0 country_id">
                            <option selected disabled>Choose a Gender</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$country["id"]== $lead->country_id ? "selected" : ""}}>{{$country['name']}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group mb-1">
                        <label for="city_id">City</label>
                        <select name="city_id" id="city_id" class="form-control rounded-0 city_id">
                            <option selected disabled>Choose a City</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" {{$city['id']== $lead->city_id ? "selected" : "hidden"}}>{{$city['name']}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('leads.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button>
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
            // start dynamic select option
            $(document).on("change",".country_id",function (){
                const getcountryid = $(this).val();
                console.log(getcountryid);
                let opforcity = '';
                $.ajax({
                    url: `/api/filter/cities/${getcountryid}`,
                    type : "GET",
                    dataType : "json",
                    success : function (response){
                        // console.log(response);
                        $('.city_id').empty();
                        opforcity += `<option selected disabled>Choose a City</option>`;

                        for(let x = 0 ; x < response.data.length ; x++){
                            opforcity += `<option value='${response.data[x].id}'>${response.data[x].name}</option>`;
                        }

                        $(".city_id").append(opforcity);

                    },
                    error: function (response){
                        console.log("Error", response);
                    }

                })
            })
            // end dynamic select option
        })
    </script>

@endsection
