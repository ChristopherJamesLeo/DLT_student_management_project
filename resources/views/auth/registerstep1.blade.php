

@extends('layouts.auth.authindex')

@section("caption","Access")

@section("content")
    <form id="stepform" class="mt-3" action="{{route('register.storestep1')}}"  method="POST" style="width: 100%" class="border-1">
        @csrf

        <div class="form-group mb-3">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"/>

        </div>
        <div class="form-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">

        </div>
        <div class="form-group mb-3">
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="confirm your password">
        </div>


        <div class="d-grid ">
            <button type="submit" id="submitbtn" class="btn btn-info">Next</button>
        </div>
    </form>

@endsection




