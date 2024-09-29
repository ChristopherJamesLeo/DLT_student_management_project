

@include("layouts.adminheader")

<div id="app">

    <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="p-3 bg-white" style="width:300px" >
            <h3 class="display-6">Sign Up</h3>
            <form class="mt-3" action="{{route('register')}}"  method="POST" style="width: 100%" class="border-1">
                @csrf
                <div class="form-group mb-3">
                    <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" placeholder="Enter your firstname"/>
                </div>
                <div class="form-group mb-3">
                    <input name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Enter your lastname"/>

                </div>

                <div class="form-group mb-3">
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"/>

                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">

                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="confirm your password">
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
                    <a href="{{route('register')}}" class="mx-1 text-primary">Sign In</a>


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


