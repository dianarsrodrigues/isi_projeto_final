@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <h1>Bandas</h1>
        @if (Auth::check() && Auth::user()->user_type == 1)
            <div>
                <button type="button" class="btn btn-light"><a class="nav-link" href="/add-band">Adicionar uma nova Banda</a></button>
                <br>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            @foreach ($bands as $band)
                <div class="col-sm-2">
                    <div class="card bg-dark text-white card-all">
                        <a href="{{ route('albums.view', $band->id) }}">
                            <img src="{{ $band->image ? asset('storage/' . $band->image) : asset('images/nophoto.png') }}" alt="" class="card-image">
                            <div class="card-body card-img-overlay card-album">
                                <h5 class="card-title">{{ $band->name }}</h5>
                                <p class="card-text">{{ $band->totalAlbums }} Albuns</p>
                            </div>
                        </a>
                    </div>
                    <div class="card-footer">
                        @if (Auth::check())
                        <a href="{{ route('band.add', ['id' => $band->id]) }}" class="card-link"><button type="submit" class="btn btn-outline-dark">Editar</button></a>
                            @if (Auth::user()->user_type == 1)
                                <a href="{{ route('band.delete', $band->id) }}" class="card-link"><button type="submit" class="btn btn-outline-danger">Apagar</button></a>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
