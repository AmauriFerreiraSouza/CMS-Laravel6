@extends('adminlte::page')

@section('title', 'Nova Página')

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
            <h2>Nova Página</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('pages.store') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}" placeholder="Digite seu Título">
                    </div>
                </div>        
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Corpo</label>
                    <div class="col-sm-10">
                        <textarea name="body" class="form-control">{{old('body')}}</textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-success" value="Criar">
                    </div>
                </div>
        </form>
        </div>
    </div>

@endsection