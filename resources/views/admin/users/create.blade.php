@extends('adminlte::page')

@section('title', 'novo usuário')

@section('content_header')
    <h1>
        Novo Usuário
    </h1>
@endsection

@section('content')
    <!--Cadastro de usuários-->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h4>Ocorreu um erro</h4>
                @foreach ($errors->all() as $erro)
                    <li>{{$erro}}</li>   
                @endforeach
            </ul>    
        </div>
    @endif
    <form method="post" action="{{ route('users.store') }}" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">Nome Completo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Digite seu Nome">
                        </div>
                    </div>
                </div>        
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Digite seu E-mail">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">Senha</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Digite sua senha">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">Confirme sua senha</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Digite novamente sua senha">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-success" value="Cadastrar">
                        </div>
                    </div>
                </div>
        </form>

@endsection