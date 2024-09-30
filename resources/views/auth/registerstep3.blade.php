

@include("layouts.adminheader")

<div id="app">

    <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="p-3 bg-white" style="width:500px" >
            <h5 class="display-6">Contact Info</h5>
            <form class="mt-3" action="{{route('register.storestep3')}}"  method="POST" style="width: 100%" class="border-1">
                @csrf
                <div class="form-group mb-3">
                    <select name="country_id" id="country_id" class="form-control">
                        <option value="" selected disabled>Choose a Country</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>

                        @endforeach
                    </select>

                </div>
                <div class="form-group mb-3">
                    <select name="city_id" id="city_id" class="form-control">
                        <option value="" selected disabled>Choose a City</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div>
                    <button type="submit" class="btn btn-info">Sign Up</button>
                </div>
            </form>


            {{--         social login--}}
            <div class="row">
                <small class="text-center text-muted">Sign Up with</small>
                <div class="col-12 mb-2 text-center">
                    <a href="javascript:void(0)" title="login with facebook" class="btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="javascript:void(0)" title="login with google" class="btn"><i class="fab fa-google"></i></a>
                    <a href="javascript:void(0)" title="login with twitter" class="btn"><i class="fab fa-twitter"></i></a>
                    <a href="javascript:void(0)" title="login with github" class="btn"><i class="fab fa-github"></i></a>

                </div>

            </div>

            {{--            Login --}}
            <div class="row">

                <div class="col-12 mb-2 text-center">
                    <small>Already Have An Account?</small>
                    <a href="{{route('login')}}" class="mx-1 text-primary">Sign In</a>


                </div>

            </div>

            {{--            data ppolicy--}}
            <div class="row">

                <div class="col-12 mb-2 text-center text-muted">
                    <small>Bu Clicking Sign Up, you agree to our <a href="javascript:void(0)" class="fw-bold">Terms,</a><a href="javascript:void(0)"  class="fw-bold">Data Policy,</a><a href="javascript:void(0)" class="fw-bold">Cookie Policy</a> You may receive SMS notification from us</small>


                </div>

            </div>
        </div>

    </div>

</div>

@include('layouts.adminfooter')


