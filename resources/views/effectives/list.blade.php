@extends('adminlte::page')

@section('title', 'Efetivo Diário')

@section('content_header')
    <h1>Efetivo Diário</h1>
    <a href="" class="btn btn-warning pull-right" href="#">
        <i class="fa fa-plus"></i> Importar
    </a>
    <br>
    <br>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Chapa</th>
                            <th>Hora</th>
                            <th>Hora</th>
                            <th>Hora</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
    </div>

@stop

@section('css')
    
@stop

@section('js')
    
@stop