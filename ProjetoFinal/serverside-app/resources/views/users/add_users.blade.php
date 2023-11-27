@extends('layouts.main_layout')
@section('content')
    <div class="container login-container">
        @if (isset($user))
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                </svg>
            </div>
        @else
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-person-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                </svg>
            </div>
        @endif
        <form method="POST" action="{{ isset($user) ? route('user.update', ['id' => $user->id]) : route('user.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    @error('name')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>O nome inserido ultrapassa os caracteres permitidos.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <label for="exampleInputNome">Nome</label>
                    <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}" class="form-control" id="exampleInputName" required>
                </div>
                <div class="mb-3">
                    @error('email')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>O email inserido já existe.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <label for="exampleInputEmail1">Email</label>
                    <input @if (isset($user)) disabled @endif  type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    @error('password')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Coloque no minimo 8 caracteres na password.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" value="" class="form-control" id="exampleInputPassword1" @if (!isset($user)) required @endif>
                </div>
                @if (Auth::check() && Auth::user()->user_type == 1)
                <div class="mb-3">
                    <label for="exampleInputNome">Tipo de utilizador</label>
                    <select class="form-select" aria-label="Default select example" name="user_type" required>
                        <option value=0>User</option>
                        <option value=1>Administrador</option>
                    </select>
                </div>
                @endif
                <button type="submit" class="btn btn-dark">Submit</button>
                <button type="cancel" class="btn btn-light"><a href=/dashboard>Cancelar</a></button>
          </form>
    </div>
@endsection
