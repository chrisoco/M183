@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading pagetitle">Set up Google Authenticator</div>

                    <div class="panel-body" style="text-align: center;">
                        <p>Set up your two factor authentication by scanning the barcode below. <br>Alternatively, you can use the code: {{ $secret }}</p>
                        <div>
                            {!! $QR_Image !!}
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                        <div>
                            <a href="{{ route('complete-reg') }}"><button class="btn-primary">Complete Registration</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
