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
                        <textarea name="body" class="form-control bodyfield">{{old('body')}}</textarea>
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

    {{-- pego a url da minha biblioteca TINYMCE --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>

    <script>
        //inicio  
        tinymce.init({
            //pego o campo do meu textarea através do name na class 
            selector:'textarea.bodyfield',
            // passo uma altura
            height:300,
            //menu false para adiciona um menu personalisado
            menubar:false,
            //pego os plugins desejados
            plugins:['link lists', 'table', 'image', 'autoresize', 'list'],
            //especifíco no meu toolbar as propriedades que quero
            toolbar:['undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist'],
            //instâncio o local do meu css 
            content_css:[
                '{{asset('assets/css/content.css')}}'
            ],
            //chamo a função (images_upload_url) para definir a rota do método de upload de imagens
            images_upload_url:'{{ route('imageupload') }}',
            //chamo a função (images_upload_credentials) e passo true para gerar cookies para só quem estiver logado conseguir fazer esta ação
            images_upload_credentials:true,
            //chamo a função (convert_urls) para previnir que não se gere uma url relativa e sim a verdadeira da imagem
            convert_urls:false
        });

    </script>

@endsection