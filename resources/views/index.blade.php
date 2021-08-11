@extends('layouts.app')

@section('style')
    <style>
        .card-header {
            padding-bottom: 0px;
        }
        .card-footer {
            font-size: smaller;
            padding-top: 2px;
            padding-bottom: 2px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h4 class="my-4 mb-4 text-center">
            WELCOME! -> Aktuelle Neuigkeiten: @admin ADMIN @endadmin
        </h4>

        @foreach($news as $post)

            @if($post->CreatedByAdmin)
               <div class="card w-100 mb-2" style="box-shadow: 5px 5px 10px #4a6fff">
            @else
               <div class="card w-100 mb-2" style="box-shadow: 5px 5px 10px #c5c6c9">
            @endif
                <div class="card-header">
                    <h4>{{ $post->header }}</h4>
                </div>
                <div class="card-body">
                    {{ $post->detail }}
                </div>
                <div class="card-footer">
                    {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y h:s') }}
                </div>
                @if($post->user_id == auth()->user()->id)
                    <a href="#" class="stretched-link"></a>
                @endif
            </div>


        @endforeach


    </div>
@endsection
