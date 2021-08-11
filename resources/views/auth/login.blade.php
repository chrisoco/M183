@extends('layouts.app')

@section('content')

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <div class="container">

        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf

            <img class="rounded mx-auto d-block mb-3" src="{{ asset('media/user-solid.svg') }}" alt="User Icon" width="250">

            @error('email')
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Incorrect Username or Password.
            </div>
            @enderror

            <div class="form-label-group">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                <label for="email">{{ __('E-Mail Adresse') }}</label>
            </div>


            <div class="form-label-group">
                <input id="password" type="password" class="form-control" name="password" autocomplete="current-password" required>
                <label for="password">{{ __('Password') }}</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Anmelden') }}</button>

            <a href="{{ route('register') }}" class="btn btn-lg btn-secondary btn-block">Registrieren</a>

        </form>
        @if (Route::has('password.request'))
            <div class="d-flex justify-content-center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Passwort vergessen?') }}
                </a>
            </div>
        @endif

    </div>
@endsection
