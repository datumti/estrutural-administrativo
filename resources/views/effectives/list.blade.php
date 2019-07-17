@extends('adminlte::page')

@section('title', 'Efetivo Diário')

@section('content_header')
    <h1>Efetivo Diário</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Importar arquivo-ponto</h3>
            {{-- <a type="button" href="{{route('cadastros.index')}}" class="btn btn-flat btn-secondary pull-right">
                <i class="fa fa-arrow-left"></i> Voltar
            </a> --}}
        </div>
        <div class="box-body">
            {!! Form::open(['method' => 'post', 'route' => ['efetivo-diario.store'], 'files' => true]) !!}
                <div class="form-group col-md-4">
                    <label for="file">Arquivo</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="form-group col-md-1">
                    <label for="importar">&nbsp;</label>
                    <br>
                    <button class="btn btn-warning pull-right" href="#" id="importar">
                        <i class="fa fa-plus"></i> Importar
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Efetivo</h3>
            {{-- <a type="button" href="{{route('efetivo-diario.export')}}" class="btn btn-flat btn-secondary pull-right">
                <i class="fa fa-download"></i> Exportar
            </a> --}}
        </div>
        <div class="box-body">
            {!! Form::open(['method' => 'get', 'route' => ['efetivo-diario.index']]) !!}
                <div class="form-group col-md-2">
                    <label for="date">Data</label>
                <input type="text" name="date" id="date" class="form-control" value="{{$filter['date']}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="date">Hora inicial</label>
                <input type="text" name="start_time" id="start_time" class="form-control" value="{{$filter['start_time']}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="date">Hora final</label>
                <input type="text" name="end_time" id="end_time" class="form-control" value="{{$filter['end_time']}}">
                </div>
                <div class="form-group col-md-1">
                    <label for="">&nbsp;</label>
                    <button href="" class="btn btn-warning pull-right" href="#">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                </div>
            {!! Form::close() !!}
            <div class="form-group col-md-12">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Chapa</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Hora</th>
                                <th>Hora</th>
                                <th>Hora</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($effective as $key => $item)
                                <tr>
                                    <td>
                                        {{$key}}
                                    </td>
                                    @foreach ($item as $chave => $time)
                                        <td>{{$time}}</td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        nenhum registro encontrado...
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
    </div>

@stop

@section('css')

@stop

@section('js')

    <script>

        $(document).ready( function () {

            $(".table").tableExport({

                // Displays table headers (th or td elements) in the <thead>
                headers: true,

                // Displays table footers (th or td elements) in the <tfoot>
                footers: true,

                // Filetype(s) for the export
                formats: ["xls", "csv", "txt"],

                // Filename for the downloaded file
                fileName: "efetivo-diario",

                // Style buttons using bootstrap framework
                bootstrap: false,

                // Automatically generates the built-in export buttons for each of the specified formats
                exportButtons: true,

                // Position of the caption element relative to table
                position: "bottom",

                // (Number, Number[]), Row indices to exclude from the exported file(s)
                ignoreRows: null,

                // (Number, Number[]), column indices to exclude from the exported file(s)
                ignoreCols: null,

                // Removes all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s)
                trimWhitespace: false,

                // (Boolean), set direction of the worksheet to right-to-left (default: false)
                RTL: false,

                // (id, String), sheet name for the exported spreadsheet, (default: 'id')
                sheetname: "id"

                });

        });

        $(function () {
            $('#date').datetimepicker({
                format: 'L',
                locale: 'pt-BR',
                widgetPositioning: {
                    vertical: 'auto',
                    horizontal: 'left'
                }
            });
            $('#start_time').datetimepicker({
                format: 'LT',
                locale: 'pt-BR',
                widgetPositioning: {
                    vertical: 'auto',
                    horizontal: 'left'
                }
            });
            $('#end_time').datetimepicker({
                format: 'LT',
                locale: 'pt-BR',
                widgetPositioning: {
                    vertical: 'auto',
                    horizontal: 'left'
                }
            });
        });
    </script>

@stop
