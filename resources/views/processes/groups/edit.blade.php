@extends('adminlte::page')

@section('title', 'Criar Grupo - Estrutural-RS')

@section('content_header')
    <h1>{{$process->name}}</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Editar Grupo</h3>
        <a type="button" href="{{route('processo-seletivo.index')}}" class="btn btn-flat btn-secondary pull-right">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>
    <!-- /.box-header -->
    {!! Form::model($group,['method' => 'put', 'route' => ['grupos.update', $group->id], 'id' => 'formGroup','files' => true]) !!}
        <input type="hidden" name="process_id" value="{{$process->id}}">
        <input type="hidden" name="construction_id" value="{{Session::get('construction.id')}}">
        <div class="box-body">
            <div class="form-group col-md-4">
                <label for="name">Nome</label>
                {!! Form::text('name', $group->name, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="creation_date">Data</label>
                {!! Form::text('creation_date', $group->creation_date, ['id' => 'datepicker', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
        </div>
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar Candidato</h3>
            <h5><span style="" id="feedback-person"></span></h5>
        </div>
        <div class="box-body" style="">
            <div class="form-group col-md-2">
                <label for="cpf">CPF</label>
                {!! Form::text('cpf', null, ['id' => 'cpf', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-5">
                <label for="fullName">Nome completo</label>
                {!! Form::text('fullName', null, ['id' => 'fullName', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="note">Nota</label>
                {!! Form::text('note', null, ['id' => 'note', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>

            <div class="form-group col-md-4">
                <label for="job">Cargo</label>
                {!! Form::select('job', $jobs, null, ['id' => 'jobs', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="status">Status</label>
                {!! Form::select('status', $status, null,['id' => 'status', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-6">
               {{--  <button type="button" class="btn btn-flat btn-info" style="margin:25px 0 0 0" title="Informações">
                    <i class="fa fa-info fa-1x"></i>
                </button> --}}
                <label for="file">Anexos (você pode selecionar mais de um arquivo)</label>
                <input type="file" class="form-control" name="files[]" multiple />

            </div>

        </div>


        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <button type="submit" class="btn btn-flat btn-success">
                <i class="fa fa-floppy-o"></i> Salvar
            </button>
        </div>
        <br>
        <div class="box-header with-border">
            <h3 class="box-title">Candidatos no Grupo</h3>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Nota</th>
                                <th>Cargo</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($group->group_person as $gp)
                                <tr>
                                    <td><a href="">{{$gp->person->id}}</a></td>
                                    <td>{{$gp->person->name}}</td>
                                    <td>
                                        {{$gp->person->cpf}}
                                    </td>
                                    <td>
                                        {{$gp->note}}
                                    </td>
                                    <td>
                                        {{$gp->person->job->name}}
                                    </td>
                                    <td>
                                        {{$gp->status->name}}
                                    </td>
                                    <td class="table-actions">
                                        <button type="button" class="btn btn-flat btn-warning btn-xs" style="margin:2px 0 2px 5px" title="Editar" data-toggle="modal" data-target="#modal-person-edit">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-flat btn-info btn-xs" style="margin:2px 0 2px 5px" title="Informações" data-toggle="modal" data-target="#modal-person-edit">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button type="button" class="btn btn-flat btn-danger btn-xs" style="margin:2px 0 2px 5px" title="Remover" data-toggle="modal" data-target="#modal-person-delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7">nenhum integrante até o momento...</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
    {!! Form::close() !!}

    <div class="modal fade" id="modal-person-delete" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'delete', 'route' => ['processo-seletivo.destroy', '']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Remover candidato</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover esse cadidato do do grupo?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" id="contract-remove">Remover</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-person-edit" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'put', 'route' => ['processo-seletivo.update', '']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Atualizar candidato</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="">Salvar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

  </div>

@stop

@section('css')

@stop

@section('js')

    <script>

        $(document).ready( function () {

            /* $("#files").dropzone({ url: "/file/post" }); */

            $('#jobs').select2();

            $('#modal-person-delete').on('show.bs.modal', function(e) {
                var person_id = $(e.relatedTarget).data('person-id');
                var group_id = $(e.relatedTarget).data('group-id');

                $(e.currentTarget).find('form').attr('action', '/processo-seletivo/'+group_id);
                $(e.currentTarget).find('form').append(`<input type="hidden" name="person_id" value="${person_id}">`)
            });

            $('#modal-person-edit').on('show.bs.modal', function(e) {
                var person_id = $(e.relatedTarget).data('person-id');
                var group_id = $(e.relatedTarget).data('group-id');

                $(e.currentTarget).find('form').attr('action', '/processo-seletivo/'+group_id);
                $(e.currentTarget).find('form').append(`<input type="hidden" name="person_id" value="${person_id}">`)
            });

            $('#cpf').inputmask('999.999.999-99');

            $('#cpf').on('blur', function() {

                $.ajax({
                    type: "POST",
                    url: "/pessoas/getbycpf",
                    data: { "_token": "{{ csrf_token() }}",
                            cpf : $(this).val()
                    },
                    dataType: "JSON",
                    beforeSend: function(){
                        $('#feedback-person').html('')
                        $('#cpf').attr('disabled', true);
                    },
                    success: function(response, status) {
                        if(status == 'nocontent') {
                            $('#feedback-person').css('color', 'red')
                            $('#feedback-person').html('Nenhum candidato encontrado. Um novo candidato será cadastrado.')
                        } else {
                            console.log(response)
                            $('#feedback-person').css('color', 'blue')
                            $('#feedback-person').html('Candidato já encontrado no sistema.')
                            $('#fullName').val(response.name)
                        }

                        $('#cpf').attr('disabled', false);
                        $('#formGroup').append('<input type="hidden" name="person_id" value="${person_id}">');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $('#cpf').attr('disabled', false);
                    }
                });
            })

        });

        $(function () {
            //Date picker
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                orientation: "bottom",
                mask:true,
            }).inputmask('99/99/9999')

        })

    </script>
@stop
