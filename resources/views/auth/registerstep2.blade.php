

@extends('layouts.auth.authindex')

@section("caption","Personal Info")

@section("content")
    <form id="stepform" class="mt-3" action="{{route('register.storestep2')}}"  method="POST" style="width: 100%" class="border-1">
        @csrf
        <div class="form-group mb-3">
            <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" placeholder="Enter your firstname"/>
        </div>
        <div class="form-group mb-3">
            <input name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Enter your lastname"/>

        </div>

        <div class="form-group mb-3">
            <input name="age" type="number" class="form-control @error('age') is-invalid @enderror" placeholder="Enter your age"/>

        </div>

        <div class="form-group mb-3">
            <select name="gender_id" id="gender_id" class="form-control">
                <option value="" selected disabled>Choose a gender</option>
                @foreach($genders as $gender)
                    <option value="{{$gender->id}}">{{$gender->name}}</option>

                @endforeach
            </select>

        </div>

        <div class="d-flex justify-content-between">
            <a href="{{route('register.step1')}}" class="btn btn-secondary">Back</a>
            <button id="submitbtn" type="submit" class="btn btn-info">Sign Up</button>
        </div>
    </form>

@endsection





