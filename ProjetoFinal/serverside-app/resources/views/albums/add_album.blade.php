@extends('layouts.main_layout')

@section('content')
<div class="container">
    @if (Auth::user()->user_type == 0 && !isset($album))
        <h1>Não tens permissões para adicionar albums</h1>
        <button type="cancel" class="btn btn-light"><a href=/albums>Voltar</a></button>
    @else
    @if (isset($album)) <h1>Update do album {{$album->name}}!</h1>
    @else <h1>Aqui podes adicionar um album!</h1>
    @endif
    <form method="POST" action="{{ isset($album) ? route('album.update', ['id' => $album->id]) :  route('album.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>O nome inserido ultrapassa os caracteres permitidos.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <label for="exampleInputNome">Nome do Album</label>
                <input type="text" name="name" value="{{ isset($album) ? $album->name : '' }}" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputNome">Data</label>
                <input type="date" name="release_at" value="{{ isset($album) ? $album->release_at : '' }}" class="form-control" id="release_at" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagem</label>
                <input type="file" accept="image/*" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3">
                <label for="exampleInputNome">Associar banda ao album</label>
                <select class="form-select" aria-label="Default select example" name="band_id" required>
                    <option value="">Todas as bandas</option>
                    @foreach ($bands as $band)
                        @if (isset($album)) {
                            <option @if ($band->id == $album->band_id) selected @endif value="{{$band->id}}">{{$band->name}}</option>
                        }
                        @else {
                            <option value="{{$band->id}}">{{$band->name}}</option>
                        }
                        @endif
                    @endforeach
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Submit</button>
            <button type="cancel" class="btn btn-light"><a href=/albums>Cancelar</a></button>
      </form>
      @endif
</div>
@endsection
