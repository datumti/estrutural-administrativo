@extends('adminlte::page')

@section('title', 'Gestão de Pessoas')

@section('content_header')
    <h1>Gestão de Pessoas</h1>
@stop

@section('content')
        
<div class="content">
    <ul class="nav nav-tabs">
        <li class="nav-item active">
          <a class="nav-link" data-toggle="tab" href="#candidatos" style="color: black;font-size: 18px">CANDIDATOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#funcionarios" style="color: black;font-size: 18px">FUNCIONÁRIOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#demissao" style="color: black;font-size: 18px">DEMISSÃO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#transferencia" style="color: black;font-size: 18px">TRANSFERÊNCIA</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="candidatos" class="tab-pane active">
            <br>
            <div class="box box-info">
                <div class="box-body">
                Lista de Candidatos
                </div>
            </div>
        </div>  
        <div id="funcionarios" class="tab-pane">
            <br>
            <div class="box box-info">
                <div class="box-body">
                Lista de Funcionários
                </div>
            </div>
        </div>  
        <div id="demissao" class="tab-pane">
            <br>
            <div class="box box-info">
                <div class="box-body">
                Lista de Demissões
                </div>
            </div>
        </div>  
        <div id="transferencia" class="tab-pane">
            <br>
            <div class="box box-info">
                <div class="box-body">
                Lista de Transferências
                </div>
            </div>
        </div>  
    </div>
  </div>        

@stop

@section('css')
    
@stop

@section('js')
    
@stop