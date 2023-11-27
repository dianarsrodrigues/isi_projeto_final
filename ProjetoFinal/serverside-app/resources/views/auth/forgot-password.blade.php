@extends('layouts.main_layout')

@section('content')
    <div class="container login-container">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.996V14H3s-1 0-1-1 1-4 6-4c.564 0 1.077.038 1.544.107a4.524 4.524 0 0 0-.803.918A10.46 10.46 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664zM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
            </svg>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Email de recuperação enviado com sucesso.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="POST" action="{{route('password.email')}}" class="form-login">
            @csrf
                <div class="mb-3">
                    @error('email')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>O email inserido deve ser válido.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <br>
                    <button type="submit" class="btn btn-dark">Recuperar</button>
                </div>
        </form>

@endsection
