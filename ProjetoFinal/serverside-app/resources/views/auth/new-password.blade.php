@extends('layouts.main_layout')

@section('content')
    <div class="container login-container">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
            </svg>
        </div>
        <form method="POST" action="{{route('password.update')}}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="email" type="email" value={{ request()->email}} class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                @error('password')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Coloque uma password com pelo menos 8 caracteres.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <label for="exampleInputPassword1" class="form-label">Nova Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Coloque novamente a Password</label>
                <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <br>
            <input type="hidden" name="token" value={{ request()->route('token')}}>
            <button type="submit" class="btn btn-dark">Recuperar</button>
        </form>
    </div>

@endsection
