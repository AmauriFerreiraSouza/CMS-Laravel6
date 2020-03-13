@extends('adminlte::page')

@section('title', 'novo usuário')

@section('content_header')
    <h1>
        Novo Usuário
    </h1>
@endsection

@section('content')
    <!--Listo meus usuários-->

    <form method="post" action="{{ route('users.store') }}" class="form-horizontal">
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">Nome Completo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Digite seu Nome">
                        </div>
                    </div>
                </div>        
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Digite seu E-mail">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">Senha</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Digite sua senha">
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