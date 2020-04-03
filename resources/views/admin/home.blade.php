@extends('adminlte::page')<!--extendo da minha biblioteca adminLTE a tela principal-->

@section('plugins.Chartjs', true)<!--importo o meu gráfico-->

@section('title', 'Painel')<!--coloco um titulo na minha aba-->

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$visitsCount}}</h3>
                    <p>Acessos</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$onlineCount}}</h3>
                    <p>Usuários Online</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$pageCount}}</h3>
                    <p>Páginas</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$userCount}}</h3>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Páginas mais visitadas</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sobre o sistema</h3>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>

<!--Monto meu gráfico-->
<script>
   //carrego minha função 
   window.onload = function(){
       //armazeno no meu let o contexto 
       let ctx = document.getElementById('pagePie').getContext('2d');
       //instâncio minha biblioteca Chart e passo o meu ctx
       window.pagePie = new Chart(ctx, {
           //passo o tipo "torta"
           type:'pie',
           //passo meus dados
           data:{
               //
               datasets:[{
                   //valores
                   data:{{$pageValues}},
                   backgroundColor:'#0000FF'
               }],
               //nomes das partes do meu pie 
               labels:{!! $pageLabels !!}
           },
           //passo algumas opições
           options:{
               //vai ser responsivo
               responsive:true,
               //e não vai ter legendas
               legend:{
                   display:false
               }
           }
       });
   } 
</script>
@endsection