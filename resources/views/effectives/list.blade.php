@extends('adminlte::page')

@section('title', 'Efetivo Diário')

@section('content_header')
    <h1>Efetivo Diário</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Contrato(s)</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a type="button" href="/gestao-obras/create" class="btn btn-flat btn-warning">
                <i class="fa fa-plus"></i> Nova Obra
            </a>
        </div>
    </div>

@stop

@section('css')
    
@stop

@section('js')
    
@stop