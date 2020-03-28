@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <h1>
        Meus Usuários
        <a href="{{ route('pages.create') }}" class="btn btn-sm btn-success">Nova Página</a>
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
                        <th>Título</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>    
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->title}}</td>
                            <td>
                                <a href="{{ route('pages.edit', ['page' => $page->id]) }}" class="btn btn-sm btn-info">Editar</a>
                                    <form class="d-inline" method="post" action="{{ route('pages.destroy', ['page' => $page->id]) }}" onsubmit="return confirm('Deseja mesmo excluir?')">
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
    {{ $pages->links() }}
@endsection