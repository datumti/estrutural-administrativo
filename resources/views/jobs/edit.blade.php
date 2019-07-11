@extends('adminlte::page')

@section('title', 'Editar Cargo - Estrutural-RS')

@section('content_header')
    <h1>Editar Cargo</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Informações do Cargo</h3>
        <a type="button" href="{{route('cadastros.index')}}" class="btn btn-flat btn-secondary pull-right">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>
    <!-- /.box-header -->
    {!! Form::model($job,['method' => 'put', 'route' => ['cargos.update', $job->id]]) !!}
        <input type="hidden" name="status" value="1">
        <div class="box-body">
            <div class="form-group col-md-7">
                <label for="name">Nome</label>
                {!! Form::text('name', $job->name, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-7">
                <label for="name">Descrição</label>
                {!! Form::textarea('description', $job->description, ['id' => 'description', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
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