
{{-- To change Email Template--}}
{{--php artisan vendor:publish --tag=laravel-notification --}}



@extends('layouts.auth.authindex')

@section("caption","Email Verification")

@section("content")
    <div class="row">
        <div>
            <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <small class="mb-4 font-medium text-sm ">'A new verification link has been sent to the email address you provided during registration.</small>

        @endif

        <form class="mt-3" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="d-grid">
                <button type="submit" class="btn btn-info">Resend Verification Email</button>
            </div>
        </form>

        {{--            Login --}}
        <div class="col-12 mt-2 text-center">
            <small>Don't have an action?</small>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="mx-1 text-primary">Sign Out</a>
            </form>

        </div>

    </div>

@endsection


