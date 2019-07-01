@extends('adminlte::page')

@section('title', 'Criar Obra - Estrutural-RS')

@section('content_header')
    <h1>Criar Obra</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informações básicas</h3>
    </div>
    <!-- /.box-header -->
    {!! Form::open(['method' => 'post', 'route' => ['gestao-obras.store']]) !!}
        <input type="hidden" name="status" value="1">
        <div class="box-body">
            <div class="form-group">
                <label for="construction_name">Nome da obra</label>
                <input type="text" name="name" class="form-control" id="construction_name" placeholder="">
            </div>
            <div class="form-group">
                <label for="contract_number">Número do contrato</label>
                <input type="number" class="form-control" name="" id="contract_number">
                <br>
                <button class="btn btn-flat btn-warning" type="button" name="" id="add-contract">
                    <i class="fa fa-plus"></i> Adicionar contrato
                </button>
                <h4 id="contracts-label" class="fade">Contratos da Obra</h4>
                <ul id="contracts" class="fade">
                </ul>
            </div>
            <div class="form-group">
                <label for="cut_grade">Nota de corte</label>
                <input type="text"  class="form-control" name="cut_grade">
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <button type="submit" class="btn btn-flat btn-success" disabled>
                <i class="fa fa-floppy-o"></i> Salvar
            </button>
        </div>
    {!! Form::close() !!}
  </div>

@stop

@section('css')
    
@stop

@section('js')

    <script>
        $(document).ready( function () {
            $('#add-contract').on('click', function() {
                if($('#contract_number').val() != '') {
                    $('#contracts-label').removeClass('fade')
                    $('#contracts').removeClass('fade')
                    $('#contracts').append('<li>'+$('#contract_number').val()+'</li>')
                    $('#contracts').append('<input type="hidden" name="contracts[]" value="'+$('#contract_number').val()+'">')
                    $('#contract_number').val('')
                    $('.btn-success').attr('disabled', false)
                }
            })
        });
    </script>
@stop