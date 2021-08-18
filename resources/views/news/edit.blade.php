@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="container">
        <h4 class="pagetitle">"{{ $user->fullName }}" bearbeiten</h4>

        <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')

            @if($user->pb)
                <div class="form-group row">
                    <img src="{{ url('/pb/'.$user->pb) }}" class="rounded mx-auto d-block border border-dark" alt="Profil Bild von Benutzer">
                </div>
            @endif

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Profilbild</label>
                <div class="col-md-4">
                    <input type="file" class="custom-file-input" name="img" accept=".png, .jpg, .jpeg">
                    <label class="custom-file-label mx-3" for="customFile">Profilbild auswählen</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Vorname <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required>
                </div>
                @error('firstname')
                <div class="offset-4 invalid-feedback">
                    {{ $message == 'x' ? '' : $message }}
                </div>
                @enderror
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Nachname <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                </div>
                @error('name')
                <div class="offset-4 invalid-feedback">
                    {{ $message == 'x' ? '' : $message }}
                </div>
                @enderror
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">E-Mail <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                </div>
                @error('email')
                <div class="offset-4 invalid-feedback">
                    {{ $message == 'x' ? '' : 'Diese E-Mail-Adresse ist bereits vergeben.' }}
                </div>
                @enderror
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Tel.</label>
                <div class="col-md-4">
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}">
                </div>
                @error('phone')
                <div class="offset-4 invalid-feedback">
                    {{ $message == 'x' ? '' : 'Diese Tel.-Nummer ist bereits vergeben oder ungültig.' }}
                </div>
                @enderror
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Rolle <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <select class="custom-select @error('roles_id') is-invalid @enderror" name="roles_id">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if($role->id == $user->role->id) selected @endif>{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Fachbereich/Beruf <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <select class="custom-select @error('categories_id') is-invalid @enderror" name="categories_id">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @if($cat->id == $user->category->id) selected @endif>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mt-4">
                <div class="col-md-1 offset-3"></div>
                <div class="col-md-4 justify-content-center d-flex">
                    <a href="{{ session('prevURL') }}" class="btn btn-secondary mr-2">Zurück</a>
                    <input class="btn btn-primary ml-2" type="submit" value="Änderungen Speichern">
                </div>
            </div>

        </form>

        @if($user->userHasSheets()->count() > 0)
            <hr />

            <div class="col-8 offset-2">
            <h4 class="text-center">Zugewiesene Fragebögen:</h4>
                <div class="list-group">
                    @foreach($user->userHasSheets->sortByDesc('prio') as $uhs)
                        <a href="{{ route('assign.edit', $uhs->id) }}" class="list-group-item list-group-item-action py-1
                                @if(is_null($uhs->finished_at) && !is_null($uhs->release_end) && Carbon\Carbon::parse($uhs->release_end)->lt(now())) border border-danger @endif">

                            <b>{{ $uhs->sheet->title }}</b>
                            @if($uhs->finished_at)
                                <span class="float-right">Abgeschlossen am: {{ Carbon\Carbon::parse($uhs->finished_at)->format('d.m.Y H:i') }}</span>
                            @else
                                @if($uhs->release_start && $uhs->release_end)
                                    <span class="float-right">Freigabe: {{ Carbon\Carbon::parse($uhs->release_start)->format('d.m.Y H:i') }} - {{ Carbon\Carbon::parse($uhs->release_end)->format('d.m.Y H:i') }}</span>
                                @elseif($uhs->release_start)
                                    <span class="float-right">Freigabe ab: {{ Carbon\Carbon::parse($uhs->release_start)->format('d.m.Y H:i') }}</span>
                                @elseif($uhs->release_end)
                                    <span class="float-right">Freigabe bis: {{ Carbon\Carbon::parse($uhs->release_end)->format('d.m.Y H:i') }}</span>
                                @else
                                    <span class="float-right">Offen</span>
                                @endif
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection

