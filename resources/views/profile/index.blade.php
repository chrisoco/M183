@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 mb-4 text-center">{{ $user->fullName }}</h1>

        <hr />
        <h4 class="pagetitle">Passwort ändern</h4>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible col-md-4 offset-4" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
        @endif

        @if (isset($msg))
            <div class="alert alert-success alert-dismissible col-md-4 offset-4" role="alert">
                {{ $msg }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- NEW PW FORM -->
        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-right">Aktuelles Passwort</label>
                <div class="col-md-4">
                    <input type="password" class="form-control" name="old_password" required autocomplete="old-password">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-right">Neues Passwort</label>
                <div class="col-md-4">
                    <input type="password" class="form-control" name="password" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-right">Neues Passwort wiederholen</label>
                <div class="col-md-4">
                    <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 offset-4">
                    <button type="submit" class="btn btn-block btn-primary">
                        Passwort ändern
                    </button>
                </div>
            </div>

        </form>

    </div>
@endsection
