@extends('adminlte::page')

@section('title', 'Editar Obra - Estrutural-RS')

@section('content_header')
    <h1>Editar Obra</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informações básicas</h3>
        <a type="button" href="{{route('gestao-obras.index')}}" class="btn btn-flat btn-secondary pull-right">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>
    <!-- /.box-header -->
    {!! Form::model($construction,['method' => 'put', 'route' => ['gestao-obras.update', $construction->id]]) !!}
        <input type="hidden" name="status" value="1">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="construction_name">Nome da obra</label>
                    <input type="text" name="name" class="form-control" id="construction_name" placeholder="" value="{{$construction->name}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="contract_number">Número do contrato</label>
                    <input type="number" class="form-control" name="" id="contract_number" style="width:148px">
                    <button class="btn btn-flat btn-warning" type="button" name="" id="add-contract"  style="width:148px">
                        <i class="fa fa-plus"></i> 
                    </button>
                </div>
                <div class="form-group col-md-2">
                    <div class="card" style="border-radius: 5px; background-color:#f8f9fa; margin: 1px">
                        <div class="card-header text-center">
                            <h5 id="contracts-label">Contratos da obra</h5>
                        </div>
                        <div class="card-body" id="contracts">
                                @forelse($construction->contract as $contract)
                                    <div class="row" style="">
                                            <div class="col-md-6 text-right">
                                                {{$contract->contract_id}}
                                            </div>
                                            <div class="col-md-6 ">
                                                <button type="button" class="btn btn-flat btn-danger btn-xs" style="margin:2px 0 2px 5px" title="Remover" data-toggle="modal" data-target="#modal-contract-delete" data-construction-id="{{$construction->id}}" data-contract-id="{{$contract->contract_id}}">
                                                    <i class="fa fa-trash"></i> 
                                                </button>
                                            </div>

                                        <input type="hidden" name="contracts[]" value="{{$contract->contract_id}}">
                                    </div>
                                @empty
                                    <h5 id="contract-empty" class="text-center"><i>nenhum contrato até o momento...</i></h5>
                                @endforelse
                            
                        </div>
                        
                    </div>                
                    
                </div>
                <div class="form-group col-md-4">
                    <label for="cut_grade">Nota de corte</label>
                    <input type="text"  class="form-control" name="cut_grade" value="{{$construction->cut_grade}}" style="width:147px">
                </div>
            </div>
        </div>
        <div class="box-footer clearfix">
            <button type="submit" class="btn btn-flat btn-success">
                <i class="fa fa-floppy-o"></i> Salvar
            </button>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Informações de vagas</h3>&nbsp;
            <button class="btn btn-flat btn-warning form-control pull-right" type="button" name="" id="add-vacancy"  data-toggle="modal" data-target="#modal-vacancy" style="width:147px">
                <i class="fa fa-plus"></i> Adicionar
            </button>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                        <th>Contrato</th>
                        <th>Quantidade</th>
                        <th>Tipo</th>
                        <th>Exame(s)</th>
                        <th>Treinamento(s)</th>
                        <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($construction->vacancy as $vacancy)
                            <tr>
                                <td>
                                    {{$vacancy->contract_id}}
                                </td>
                                <td>{{$vacancy->number}}</td>
                                <td>{{$vacancy->job->name}}</td>
                                <td>
                                    <ul>
                                        @foreach($vacancy->vacancy_exam as $exam)
                                            <li>
                                                {{$exam->exam->name}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($vacancy->vacancy_training as $training)
                                            <li>
                                                {{$training->training->name}}
                                            </li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td class="table-actions">
                                    <button type="button" class="btn btn-flat btn-danger btn-xs" style="margin:2px 0 2px 5px" title="Remover" data-toggle="modal" data-target="#modal-vacancy-delete" data-vacancy-id="{{$vacancy->id}}">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6">
                                    nenhuma vaga cadastrada até o momento...
                                </td>
                            </tr>    
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>

    <div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Responsáveis</h3>&nbsp;
    <button class="btn btn-flat btn-warning form-control pull-right" type="button" name="" id="add-manager"  data-toggle="modal" data-target="#modal-manager-add" data-construction-id="{{$construction->id}}" data-contract-id="{{$contract->contract_id}}" style="width:147px">
            <i class="fa fa-plus"></i> Adicionar
        </button>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Contrato</th>
                        <th>SMS</th>
                        <th>Qualidade</th>
                        <th>Produtividade</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($construction->manager as $manager)
                        <tr>
                            <td>
                                {{$manager->contract_id}}
                            </td>
                            <td>
                                {{$manager->personSms->name}}
                            </td>
                            <td>
                                {{$manager->personQuality->name}}
                            </td>
                            <td>
                                {{$manager->personProduction->name}}
                            </td>
                            <td>
                                {{$manager->personDiscipline->name}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-flat btn-info btn-xs" style="margin:2px 0 2px 5px" title="Editar" data-toggle="modal" data-target="#modal-manager-edit" data-manager-id="{{$manager->id}}">
                                    <i class="fa fa-pencil"></i> 
                                </button>
                                <button type="button" class="btn btn-flat btn-danger btn-xs" style="margin:2px 0 2px 5px" title="Remover" data-toggle="modal" data-target="#modal-manager-delete" data-construction-id="{{$manager->construction_id}}" data-contract-id="{{$manager->contract_id}}">
                                    <i class="fa fa-trash"></i> 
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                nenhum responsável até o momento...
                            </td>
                        </tr>    
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    
        <!-- /.box-body -->
    {!! Form::close() !!}

    <div class="modal fade" id="modal-vacancy" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'route' => ['vagas.store']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Adicionar vaga</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="quality_vacancy" value="0">
                        <input type="hidden" name="construction_id" value="{{$construction->id}}">
                        <div class="form-group">
                            <label for="contract_number">Contrato</label>
                            {!! Form::select('contract_id', $contracts, null, ['id' => 'contract-selected', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="jobs">Tipo da vaga</label>
                            {!! Form::select('job_id', $jobs, null, ['id' => 'jobs', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="construction_name">Número de posições</label>
                            <input type="number" name="number" class="form-control" id="number" placeholder="" value="">
                        </div>
                        <div class="form-group">
                            <label for="exams">Exames necessários</label>
                            {!! Form::select('exams[]', $exams, null, ['id' => 'exams', 'class' => 'form-control', 'multiple' => 'multiple', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="trainings">Treinamentos necessários</label>
                            {!! Form::select('trainings[]', $trainings, null, ['id' => 'trainings', 'class' => 'form-control', 'multiple' => 'multiple', 'style' => 'width: 100%']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success" id="vacancies-add">Salvar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-vacancy-delete" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'delete', 'route' => ['vagas.destroy', '']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Remover vaga</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover essa vaga?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" id="vacancies-remove">Remover</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-contract-delete" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'delete', 'route' => ['contracts.destroy', '']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Remover contrato</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover esse contrato?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" id="contract-remove">Remover</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
  
    <div class="modal fade" id="modal-manager-add" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'route' => ['gerentes.store']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Adicionar responsáveis</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="construction_id" value="{{$construction->id}}">
                        <div class="form-group">
                            <label for="contract_number">Contrato</label>
                            {!! Form::select('contract_id', $contracts, null, ['id' => 'contract-selected', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_sms">Responsável SMS</label>
                            {!! Form::select('people_sms', $peoples, null, ['id' => 'people_sms', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_quality">Responsável Qualidade</label>
                            {!! Form::select('people_quality', $peoples, null, ['id' => 'people_quality', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_production">Responsável Produtividade</label>
                            {!! Form::select('people_production', $peoples, null, ['id' => 'people_production', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_discipline">Responsável Disciplina</label>
                            {!! Form::select('people_discipline', $peoples, null, ['id' => 'people_discipline', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="manager-add">Salvar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-manager-edit" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'put', 'route' => ['gerentes.update', '']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Editar responsáveis</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="contract_number">Contrato</label>
                            {!! Form::select('contract_id', $contracts, null, ['id' => 'contract-selected', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_sms">Responsável SMS</label>
                            {!! Form::select('people_sms', $peoples, null, ['id' => 'people_sms', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_quality">Responsável Qualidade</label>
                            {!! Form::select('people_quality', $peoples, null, ['id' => 'people_quality', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_production">Responsável Produtividade</label>
                            {!! Form::select('people_production', $peoples, null, ['id' => 'people_production', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                        <div class="form-group">
                            <label for="people_discipline">Responsável Disciplina</label>
                            {!! Form::select('people_discipline', $peoples, null, ['id' => 'people_discipline', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="manager-add">Salvar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-manager-delete" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'delete', 'route' => ['gerentes.destroy', '']]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLongTitle">Remover responsáveis</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover esses responsáveis?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" id="manager-remove">Remover</button>
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

        $('#modal-contract-delete').on('show.bs.modal', function(e) {
            var contract_id = $(e.relatedTarget).data('contract-id');
            var construction_id = $(e.relatedTarget).data('construction-id');
            
            $(e.currentTarget).find('form').attr('action', '/contracts/'+contract_id);
            $(e.currentTarget).find('form').append(`<input type="hidden" name="construction_id" value="${construction_id}">`)
        });

        $('#modal-vacancy-delete').on('show.bs.modal', function(e) {
            var vacancy_id = $(e.relatedTarget).data('vacancy-id');
            $(e.currentTarget).find('form').attr('action', '/vacancy/'+vacancy_id);
        });

        $('#modal-manager-add').on('show.bs.modal', function(e) {
            var construction_id = $(e.relatedTarget).data('construction-id');

            $(e.currentTarget).find('form').attr('action', '/gerentes/');
            $(e.currentTarget).find('form').append(`<input type="hidden" name="construction_id" value="${construction_id}">`)
        });

        $('#modal-manager-edit').on('show.bs.modal', function(e) {
            var manager_id = $(e.relatedTarget).data('manager-id');
            
            $.ajax({
                    type: "GET",
                    url: "/gerentes/get/"+manager_id,
                    data: { 

                    },
                    dataType: "JSON", 
                    beforeSend: function(){

                    },
                    success: function(response, status) {
                        $('select[name="contract_id"]').val(response.contract_id)
                        $('select[name="people_sms"]').val(response.person_id_sms)
                        $('select[name="people_quality"]').val(response.person_id_quality)
                        $('select[name="people_production"]').val(response.person_id_production)
                        $('select[name="people_discipline"]').val(response.person_id_discipline)
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError)
                    }
                });

            $(e.currentTarget).find('form').attr('action', '/gerentes/'+manager_id);

        });

        $('#modal-manager-delete').on('show.bs.modal', function(e) {
            var contract_id = $(e.relatedTarget).data('contract-id');
            var construction_id = $(e.relatedTarget).data('construction-id');

            $(e.currentTarget).find('form').attr('action', '/gerentes/'+contract_id);
            $(e.currentTarget).find('form').append(`<input type="hidden" name="construction_id" value="${construction_id}">`)
        });

        $(document).ready( function () {

            $('#add-contract').on('click', function() {
                if($('#contract_number').val() != '') {
                    $('#contracts').append(`
                        <div class="row" style="">
                            <div class="col-md-6 text-right">
                                ${$('#contract_number').val()}
                            </div>
                            <div class="col-md-6 ">
                                <button type="button" class="btn btn-flat btn-danger btn-xs" style="margin:2px 0 2px 5px" title="Remover" data-toggle="modal" data-target="#modal-contract-delete">
                                    <i class="fa fa-trash"></i> 
                                </button>
                            </div>
                            <input type="hidden" name="contracts[]" value="${$('#contract_number').val()}">
                        </div>
                    `)
                    $('#contract-empty').fadeOut()
                    $('#contract_number').val('')
                    $('#add-vacancy').attr('disabled', true)
                    $('#add-vacancy').attr('title', 'Salve as alterações da obra para poder adicionar vagas')
                    $('#add-manager').attr('disabled', true)
                    $('#add-manager').attr('title', 'Salve as alterações da obra para poder adicionar responsáveis')
                }
            })

            $('#exams').select2();
            $('#trainings').select2();
            $('#jobs').select2();

            $('#people_sms').select2();
            $('#people_quality').select2();
            $('#people_production').select2();
            $('#people_discipline').select2();
        });
    </script>
@stop