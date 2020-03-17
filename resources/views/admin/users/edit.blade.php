@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    
@endsection

@section('content')
    <!--Cadastro de usuários-->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5><i class="icon fas fa-ban"></i>Ocorreu um erro</h5>
                    @foreach ($errors->all() as $erro)
                        <li>{{$erro}}</li>   
                    @endforeach
            </ul>    
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h2>Editar Usuário</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('users.update', ['user'=>$user->id]) }}" class="form-horizontal">
                @method('put')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" placeholder="Digite seu Nome">
                    </div>
                </div>        
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="Digite seu E-mail">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nova Senha</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Digite sua senha">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirme sua senha</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Digite novamente sua senha">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-success" value="Salvar">
                    </div>
                </div>
        </form>
        </div>
    </div>

@endsection