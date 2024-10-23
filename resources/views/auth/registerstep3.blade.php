

@extends('layouts.auth.authindex')

@section("caption","Contact Info")

@section("content")
    <form id="stepform" class="mt-3" action="{{route('register.storestep3')}}"  method="POST" style="width: 100%" class="border-1">
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

        <div class="d-flex justify-content-between">
            <a href="{{route('register.step2')}}" class="btn btn-secondary">Back</a>
            <button id="submitbtn" type="submit" class="btn btn-info">Sign Up</button>
        </div>
    </form>

@endsection



