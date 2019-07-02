@extends('adminlte::page')

@section('title', 'Editar Obra - Estrutural-RS')

@section('content_header')
    <h1>Editar Obra</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Informações básicas</h3>
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
                        <i class="fa fa-plus"></i> Adicionar
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
                                                <button type="button" class="btn btn-flat btn-danger btn-xs" style="margin:2px 0 2px 5px" title="Remover" data-toggle="modal" data-target="#modal-contract-delete">
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
        <div class="box-header with-border">
            <h3 class="box-title">Informações das vagas</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="add-vacancy">Vagas, exames e treinamentos </label>
                    <br>
                    <button class="btn btn-flat btn-warning form-control" type="button" name="" id="add-vacancy"  data-toggle="modal" data-target="#modal-vacancy" style="width:147px">
                            <i class="fa fa-plus"></i> Adicionar
                    </button>
                </div>
                <div class="form-group col-md-10">
                    @if($construction->vacancy)
                        <div class="row">
                            @foreach($construction->vacancy as $vacancy)
                            <div class="card col-md-3" style="border-radius: 5px; background-color:#f8f9fa; margin: 1px">
                                <div class="card-header text-center">
                                    <h5>Contrato <strong>{{$vacancy->contract_id}}</strong></h5>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Tipo da vaga: {{$vacancy->job->name}}</li>
                                        <li>Número de vagas: {{$vacancy->number}}</li>
                                        <li>
                                            Exames necessários
                                            <ul>
                                                @foreach($vacancy->vacancy_exam as $exam)
                                                    <li>
                                                        {{$exam->exam->name}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            Treinamentos necessários
                                            <ul>
                                                @foreach($vacancy->vacancy_training as $training)
                                                    <li>
                                                        {{$training->training->name}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer text-muted text-center">
                                    <!-- <button type="submit" class="btn btn-flat btn-warning" title="Editar">
                                        <i class="fa fa-pencil"></i> 
                                    </button> -->
                                    <button type="button" class="btn btn-flat btn-danger" title="Remover"  data-toggle="modal" data-target="#modal-vacancy-delete">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                </div>
                            </div>
                            @endforeach
                            <!-- {{$construction->vacancy}} -->
                        
                        @else
                            Nenhuma vaga cadastrada até o momento.
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <button type="submit" class="btn btn-flat btn-success">
                <i class="fa fa-floppy-o"></i> Salvar
            </button>
        </div>
    {!! Form::close() !!}


    <div class="modal fade" id="modal-vacancy" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'route' => ['vacancy.store']]) !!}
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Adicionar vaga</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
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
                        <button type="submit" class="btn btn-success" id="vacancies-add">Adicionar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-vacancy-delete" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'delete', 'route' => ['vacancy.destroy', 1]]) !!}
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Remover vaga</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
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
                {!! Form::open(['method' => 'delete', 'route' => ['vacancy.destroy', 1]]) !!}
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Remover contrato</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
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
  </div>

@stop

@section('css')
    
@stop

@section('js')

    <script>
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
                }
            })

            $('#exams').select2();
            $('#trainings').select2();
            $('#jobs').select2();

            /* $('#vacancies-add').on('click', function() {
                $('#vacancies').append(`
                    <li>
                        ${$('#contract-selected').val()}
                    </li>
                `)
            }) */
        });
    </script>
@stop