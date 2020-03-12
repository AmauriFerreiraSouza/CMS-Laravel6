@extends('adminlte::page')

@section('title', 'usuários')

@section('content_header')
    <h1>
        Meus Usuários
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">Novo usuário</a>
    </h1>
@endsection

@section('content')
    <!--Listo meus usuários-->
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-info">Editar</a>
                    <a href="{{ route('users.destroy', ['user' => $user->id]) }}" class="btn btn-sm btn-danger">Excluir</a>
                </td>
            </tr>    
        @endforeach
    </table>
    
@endsection