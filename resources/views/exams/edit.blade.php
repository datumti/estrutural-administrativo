@extends('adminlte::page')

@section('title', 'Editar Exame - Estrutural-RS')

@section('content_header')
    <h1>Editar Exame</h1>
@stop

@section('content')

<div class="box box-info">
    <!-- /.box-header -->
    {!! Form::model($exam,['method' => 'put', 'route' => ['exames.update', $exam->id]]) !!}
        <input type="hidden" name="status" value="1">
        <div class="box-body">
            <div class="form-group col-md-7">
                <label for="name">Nome</label>
                {!! Form::text('name', $exam->name, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-7">
                <label for="name">Descrição</label>
                {!! Form::textarea('description', $exam->description, ['id' => 'description', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
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