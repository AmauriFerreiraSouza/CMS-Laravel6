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
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>    
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-info">Editar</a>
                                <form class="d-inline" method="post" action="{{ route('users.destroy', ['user' => $user->id]) }}" onsubmit="return confirm('Deseja mesmo excluir?')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}
@endsection