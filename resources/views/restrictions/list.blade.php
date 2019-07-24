@extends('adminlte::page')

@section('title', 'Restrições')

@section('content_header')
    <h1>Restrições</h1>
@stop

@section('content')
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Cadastrar Restrição</h3>
            </div>
            {!! Form::open(['method' => 'post', 'route' => ['restricoes.store']]) !!}
            <div class="box-body">
                {{-- <div class="form-group col-md-7">
                    <label for="cpf">Pessoa</label>
                    {!! Form::select('people_id', $peoples, null, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                </div> --}}
                <div class="form-group col-md-4">
                    <label for="name">Nome</label>
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-3">
                    <label for="cpf">CPF</label>
                    {!! Form::text('cpf', null, ['id' => 'cpf', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-7">
                    <label for="description">Motivo</label>
                    {!! Form::textarea('description', null, ['id' => 'description', 'rows' => '3','class' => 'form-control', 'style' => 'width: 100%']) !!}
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
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Restrições</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Motivo</th>
                    <th>Data</th>
                    <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($restrictions as $restriction)
                        <tr>
                            <td>{{$restriction->name}}</td>
                            <td>{{$restriction->cpf}}</td>
                            <td>{{$restriction->description}}</td>
                            <td>{{$restriction->created_at->format('d/m/Y')}}</td>
                            <td>
                                <button type="button" class="btn btn-flat btn-danger btn-xs" style="margin:2px 0 2px 5px" title="Remover" data-toggle="modal" data-target="#modal-restriction-delete" data-restriction-id="{{$restriction->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                nenhuma restrição até o momento...
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Exclusão de Restrições</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Motivo da restrição</th>
                    <th>Data da restrição</th>
                    <th>Motivo da exclusão</th>
                    <th>Data da exclusão</th>
                    <th>Responsável</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($restrictionExclusions as $exclusion)
                        <tr>
                            <td>{{$exclusion->restriction->name}}</td>
                            <td>{{$exclusion->restriction->cpf}}</td>
                            <td>{{$exclusion->restriction->description}}</td>
                            <td>{{$exclusion->restriction->created_at->format('d/m/Y')}}</td>
                            <td>{{$exclusion->description}}</td>
                            <td>{{$exclusion->created_at->format('d/m/Y')}}</td>
                            <td>{{$exclusion->people->name}}</td>
                        </tr>
                    @empty
                        <tr>

                            <td>
                                nenhuma exclusão até o momento...
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

            <div class="modal fade" id="modal-restriction-delete" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            {!! Form::open(['method' => 'delete', 'route' => ['restricoes.destroy', '']]) !!}
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLongTitle">Remover restrição</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <h5>Tem certeza que deseja remover essa restrição?</h5>
                                        <br>
                                        <label for="description" class="label-description">Motivo*</label>
                                        {!! Form::textarea('description', null, ['rows' => '3','class' => 'form-control exclusion-description', 'style' => 'width: 100%']) !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger restriction-remove">Remover</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            <!-- /.box-body -->
        </div>
@stop

@section('css')

@stop

@section('js')
    <script>

        $('#modal-restriction-delete').on('show.bs.modal', function(e) {
            var restriction_id = $(e.relatedTarget).data('restriction-id');

            $(e.currentTarget).find('form').attr('action', '/restricoes/'+restriction_id);
        });


        $(document).ready(function() {
            $('.table').DataTable({
                "dom": "bfrtp", //i
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });

            $('#cpf').inputmask('999.999.999-99');

            $('.restriction-remove').on('click', function(e){
                e.preventDefault();
                if($('.exclusion-description').val() == '') {
                    $('.label-description').css('color', 'red');
                } else {
                    $('.label-description').removeAttr('css');
                    $('.restriction-remove').unbind('click').click();
                }
            })

        });
    </script>

@stop
