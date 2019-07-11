@extends('adminlte::page')

@section('title', 'Home - Estrutural-RS')

@section('content_header')
    <h3>Bem vindo!</h3>
    <h5>Selecione a obra abaixo</h5>
@stop

@section('content')
    <div class="box box-info">
          <div class="box-header pull-right">
            <a type="button" href="/gestao-obras/create" class="btn btn-flat btn-warning">
                <i class="fa fa-plus"></i> Nova Obra
            </a>
          </div>
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
                    @foreach ($constructions as $construction)
                        <tr>
                            <td><a href="">{{$construction->id}}</a></td>
                            <td>{{$construction->name}}</td>
                            <td>
                              @foreach($construction->contract as $contract) 
                                {{$contract->contract_id}} <br>  
                              @endforeach
                            </td>
                            <td class="table-actions">
                                @if(Session::get('construction.id') == $construction->id)
                                    {!! Form::open(['method' => 'post', 'route' => ['gestao-obras.set', $construction->id]]) !!}
                                        {!! Form::button('<i class="fa fa-check-square" style="color:green"></i>', ['type' => 'submit', 'class' => 'btn btn-flat btn-default btn', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Selecionado', 'disabled' => true]) !!}
                                    {!! Form::close() !!}      
                                @else
                                    {!! Form::open(['method' => 'post', 'route' => ['gestao-obras.set', $construction->id]]) !!}
                                        {!! Form::button('<i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-flat btn-default btn', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Selecionar']) !!}
                                    {!! Form::close() !!}
                                @endif
                                {!! Form::open(['method' => 'get', 'route' => ['gestao-obras.edit', $construction->id]]) !!}
                                  {!! Form::button('<i class="fa fa-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-flat btn-default', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Editar']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="box-footer">
                  <a type="button" href="/gestao-obras/create" class="btn btn-flat btn-warning">
                    <i class="fa fa-plus"></i> Nova Obra
                  </a>
                </div>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div> 

@stop

@section('scripts')

    <script>
    $(document).ready( function () {
        $('.table').DataTable({
            "dom": "f"
        });
    } );
    </script>

@stop