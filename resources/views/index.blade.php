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
        <h4 class="pagetitle my-2">
            NEWS:
        </h4>

        <div class="card mb-2" style="box-shadow: 5px 5px 10px #46c740">
            <div class="card-body">
            <form action="{{ route('news.store') }}" method="POST" autocomplete="off">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label class="col-2 col-form-label text-right">Header <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control @error('header') is-invalid @enderror" name="header" required>
                    </div>
                    @error('header')
                    <div class="offset-4 invalid-feedback">
                        {{ $message == 'x' ? '' : $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label text-right">Detail <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <textarea rows="5" class="form-control @error('detail') is-invalid @enderror" name="detail" required></textarea>
                    </div>
                    @error('detail')
                    <div class="offset-4 invalid-feedback">
                        {{ $message == 'x' ? '' : $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group row mb-0">
                    <div class="col justify-content-center d-flex">
                        <input class="btn btn-primary col-3" type="submit" value="POST">
                    </div>
                </div>

            </form>
            </div>
        </div>

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
