@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="container">
        <h4 class="pagetitle">"{{ $news->header }}" bearbeiten</h4>

        <form action="{{ route('news.update', $news) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-2 col-form-label text-right">Header <span class="text-danger">*</span></label>
                <div class="col-md-8">
                    <input type="text" class="form-control @error('header') is-invalid @enderror" name="header" value="{{ $news->header }}" required>
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
                    <textarea rows="5" class="form-control @error('detail') is-invalid @enderror" name="detail" required>{{ $news->detail }}</textarea>
                </div>
                @error('detail')
                <div class="offset-4 invalid-feedback">
                    {{ $message == 'x' ? '' : $message }}
                </div>
                @enderror
            </div>

            <div class="form-group row mt-4">
                <div class="col-md-1 offset-3"></div>
                <div class="col-md-4 justify-content-center d-flex">
                    <a href="{{ session('prevURL') }}" class="btn btn-secondary mr-2">Zurück</a>
                    <input class="btn btn-primary ml-2" type="submit" value="Änderungen Speichern">
                </div>
            </div>

        </form>

    </div>
@endsection

