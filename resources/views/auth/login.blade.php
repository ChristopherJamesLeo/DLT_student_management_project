@include("layouts.adminheader")

<div id="app">

    <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="p-3 bg-white" >
            <h3 class="display-6">Sign In</h3>
            <form class="mt-3" action="{{route('login')}}"  method="POST" style="width: 400px;" class="border-1">
                @csrf
                <div class="form-group mb-3">
                    <input name="email" type="email" class="form-control" placeholder="Enter your email"/>
                    @error('email')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    @error('password')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input" {{old("remember") ? "checked" : " "}} />
                            <label for="remember">Remember Me</label>
                        </div>
                        <div>
                            <a href="{{route('password.request')}}"><i class="fas fa-lock me-2"></i> Forgot Password</a>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-info">Login</button>
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

{{--            register --}}
            <div class="row">

                <div class="col-12 mb-2 text-center">
                    <small>Don't have account</small>
                    <a href="{{route('register')}}" class="mx-1 text-primary">Sign Up</a>


                </div>

            </div>
        </div>

    </div>

</div>

@include('layouts.adminfooter')

