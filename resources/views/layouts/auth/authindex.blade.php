@include('layouts.auth.authheader')

<div id="app">

    <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="p-3 bg-white" style="width:500px" >
            <h5 class="">@yield("caption")</h5>
                @yield("content")

{{--            start loader --}}
            <div class="text-center mt-2">
                <span id="loader" class="spinner-border spinner-border-sm d-none"></span>
            </div>

{{--            end loader  --}}
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

@include('layouts.auth.authfooter')
