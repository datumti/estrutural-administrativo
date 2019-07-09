@extends('adminlte::page')

@section('title', 'Criar Treinamento - Estrutural-RS')

@section('content_header')
    <h1>Novo Treinamento</h1>
@stop

@section('content')

<div class="box box-info">

    {!! Form::open(['method' => 'post', 'route' => ['treinamentos.store']]) !!}
        <div class="box-body">
            <div class="form-group col-md-7">
                <label for="cpf">Nome</label>
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-7">
                <label for="name">Descrição</label>
                {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <button type="submit" class="btn btn-flat btn-success">
                <i class="fa fa-floppy-o"></i> Salvar
            </button>
        </div>
    {!! Form::close() !!}
  </div>

@stop

@section('css')
    
@stop

@section('js')

    
@stop