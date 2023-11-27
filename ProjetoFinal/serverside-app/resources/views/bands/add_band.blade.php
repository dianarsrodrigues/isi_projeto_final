@extends('layouts.main_layout')

@section('content')
<div class="container">
    @if (Auth::user()->user_type == 0 && !isset($band))
        <h1>Não tens permissões para adicionar bandas</h1>
        <button type="cancel" class="btn btn-light"><a href=/dashboard>Voltar</a></button>
    @else
    @if (isset($band)) <h1>Aqui podes fazer o update da banda {{$band->name}}!</h1>
    @else <h1>Aqui podes adicionar uma banda!</h1>
    @endif
    <form method="POST" action="{{ isset($band) ? route('band.update', ['id' => $band->id]) :  route('band.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>O nome inserido ultrapassa os caracteres permitidos.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <label for="exampleInputNome">Nome da Banda</label>
                <input type="text" name="name" value="{{ isset($band) ? $band->name : '' }}" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagem</label>
                <input type="file" accept="image/*" name="image" class="form-control" id="image">
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Submit</button>
            <button type="cancel" class="btn btn-light"><a href=/bands>Cancelar</a></button>
      </form>
      @endif
</div>
@endsection
