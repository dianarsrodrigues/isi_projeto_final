@extends('layouts.main_layout')
@section('content')
    <div class="container">
        <h1>Dados do user {{$user -> name}}</h1>
        <table class="table" style="text-align: center">
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
                    <td>{{$user -> id}}</td>
                    <td>{{$user -> name}}</td>
                    <td>{{$user -> email}}</td>
                    <td>{{date('d-m-Y', strtotime($user-> created_at))}}</td>
                    @auth
                    <td>
                        <a href="{{ route('users.add', ['id' => $user->id])}}"><button type="button" class="btn btn-outline-dark">Editar</button></a>
                        <a href="{{ route('user.delete', $user->id)}}"><button type="button" class="btn btn-outline-danger">Apagar</button></a>
                    </td>
                    @endauth
                </tr>
            </tbody>
          </table>
    </div>
@endsection
