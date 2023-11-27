@extends('layouts.main_layout')
@section('content')
    <div class="container">
        @if (Auth::user()->user_type == 1)
            <div class="alert alert-light alert-dismissible fade show" role="alert">
                <strong>Administrador iniciado com sucesso.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <div class="alert alert-light alert-dismissible fade show" role="alert">
                <strong>User iniciado com sucesso.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="dashboard-title">Olá {{ Auth::user()->name }}!</h1>
        <div >
            @if (Auth::user()->user_type == 1)
                <div class="dashboard-buttons-div">
                    <a class="nav-link" href="/all-users"><button type="button" class="btn btn-dark">Todos os utilizadores</button></a>
                    <a class="nav-link" href="/add-users"><button type="button" class="btn btn-dark">Adicionar utilizador</button></a>
                    <a class="nav-link" href="/add-band"><button type="button" class="btn btn-dark">Adicionar banda</button></a>
                    <a class="nav-link" href="/add-album"><button type="button" class="btn btn-dark">Adicionar album</button></a>
                </div>
            @endif
            <table class="table dashboard-table" style="text-align: center">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Data de Criação</th>
                        @auth
                            <th></th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ Auth::user()->id }}</td>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ Auth::user()->email }}</td>
                        <td>{{date('d-m-Y', strtotime(Auth::user()->created_at))}}</td>
                        @auth
                            <td>
                                <a href="{{ route('users.add', ['id' => Auth::user()->id]) }}"><button type="button"
                                        class="btn btn-dark">Editar</button></a>
                            </td>
                        @endauth
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
    @endsection
