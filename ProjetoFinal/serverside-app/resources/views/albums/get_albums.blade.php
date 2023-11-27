@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <h1>Albuns</h1>
        @if (Auth::check() && Auth::user()->user_type == 1)
        <div>
            <button type="button" class="btn btn-light"><a class="nav-link" href="/add-album">Adicionar um novo Album</a></button>
        </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            @foreach ($albums as $album)
            <div class="col-sm-2">
                <div class="card bg-dark text-white card-all ">
                    <img src="{{$album -> image ? asset('storage/' . $album->image) : asset('images/nophoto.png')}}" alt="" class="card-image">
                    <div class="card-body card-img-overlay card-album">
                        <h5 class="card-title">{{ $album->name }}</h5>
                        <p class="card-text">{{date('Y', strtotime( $album->release_at))}}</p>
                    </div>
                </div>
                <div class="card-footer">
                    @if (Auth::check())
                        <a href="{{ route('album.add', ['id' => $album->id])}}" class="card-link"><button type="submit" class="btn btn-outline-dark">Editar</button></a>
                        @if (Auth::user()->user_type == 1)
                            <a href="{{ route('album.delete', ['id' => $album->id, 'band' => $album->band_id])}}" class="card-link"><button type="submit" class="btn btn-outline-danger">Apagar</button></a>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
