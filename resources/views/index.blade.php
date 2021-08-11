@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="my-4 mb-4 text-center">
            WELCOME! -> Aktuelle Neuigkeiten: @admin ADMIN @endadmin
        </h4>


        @foreach($news as $post)
            <div class="card w-100 mb-2" style="box-shadow: 5px 5px 10px #4a6fff">
                <div class="card-header">
                    <h4>{{ $post->header }}</h4>
                </div>
                <div class="card-body">
                    {{ $post->detail }}
                </div>
                <div class="card-footer">
                    {{ $post->created_at }}
                </div>
            </div>


        @endforeach


    </div>
@endsection
