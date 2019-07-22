@extends('adminlte::page')

@section('title', 'Criar Cargo - Estrutural-RS')

@section('content_header')
    <h1>Novo Cargo</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Informações do Cargo</h3>
          <a type="button" href="{{route('cadastros.index')}}" class="btn btn-flat btn-secondary pull-right">
              <i class="fa fa-arrow-left"></i> Voltar
          </a>
      </div>
    {!! Form::open(['method' => 'post', 'route' => ['cargos.store']]) !!}
        <div class="box-body">
            <div class="form-group col-md-6">
                <label for="cpf">Nome</label>
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="type">Mão de obra</label><br>
                {!! Form::radio('type', 'D') !!} Mão de obra direta &nbsp;&nbsp;
                {!! Form::radio('type', 'I') !!} Mão de obra indireta
            </div>
            <div class="form-group col-md-10">
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
