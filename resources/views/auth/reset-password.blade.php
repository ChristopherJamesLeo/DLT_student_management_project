{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}




@include('layouts.auth.authheader')

<div id="app">

    <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="p-3 bg-white" style="width:500px" >
            <h5>New Password</h5>

            @if (session('status'))
                <small class="mb-4 font-medium text-sm ">'A new link has been sent to the email address you provided during registration.</small>

            @endif

            <form class="mt-3" action="{{ route('password.store') }}"  method="POST" style="width: 100%" class="border-1">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group mb-3">
                    <input name="email" type="email" class="form-control shadow-none @error('email') is-invalid @enderror" placeholder="Enter your log in email"/>
                </div>

                <div class="form-group mb-3">
                    <input name="password" type="password" class="form-control shadow-none @error('password') is-invalid @enderror" placeholder="Enter your password"/>
                </div>

                <div class="form-group mb-3">
                    <input name="password_confirmation" type="password" class="form-control shadow-none @error('password_confirmation') is-invalid @enderror" placeholder="Enter your confirm password"/>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info">Reset Password</button>
                </div>
            </form>
        </div>

    </div>

</div>

@include('layouts.auth.authfooter')

