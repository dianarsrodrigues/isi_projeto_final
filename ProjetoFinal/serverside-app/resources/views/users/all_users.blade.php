@extends('layouts.main_layout')
@section('content')
    <div class="container">

        <h1>Todos os users</h1>
        @auth
        <div>
            <button type="button" class="btn btn-dark button-add"><a class="nav-link" href="/add-users">Adicionar um novo utilizador</a></button>
            <br>
        </div>
        @endauth
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="" method="GET" class="formulario-allusers">
            <select name="user_id" id="" onchange="this.form.submit()" class="select-allusers">
                <option value="">Todos os users</option>
                @foreach ($allUsers as $user)
                    <option @if ($user->id == request()->query('user_id')) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            <div class="">
                <input type="text" value="{{request()->query('search')}}" name="search" id="" placeholder="Procurar" class="procurar-allusers">
                <button class="btn btn-secondary" >Procurar</button>
            </div>

        </form>
        <br>
        <table class="table" style="text-align: center">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo de User</th>
                <th scope="col">Data de Criação</th>
                @auth
                <th></th>
                @endauth
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user -> id}}</td>
                        <td>{{$user -> name}}</td>
                        <td>{{$user -> email}}</td>
                        @if ($user -> user_type == 1)
                            <td>Administrador</td>
                        @else
                            <td>User</td>
                        @endif
                        <td>{{date('d-m-Y', strtotime($user-> created_at))}}</td>
                        @auth
                        <td>
                            <a href="{{ route('user.view', $user->id)}}"><button type="button" class="btn btn-dark">Ver</button></a>
                            <a href="{{ route('users.add', ['id' => $user->id])}}"><button type="button" class="btn btn-outline-dark">Editar</button></a>
                            <a href="{{ route('user.delete', $user->id)}}"><button type="button" class="btn btn-outline-danger">Apagar</button></a>
                        </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
          </table>

    </div>
@endsection
