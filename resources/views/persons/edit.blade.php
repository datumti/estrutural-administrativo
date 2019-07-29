@extends('adminlte::page')

@section('title', 'Editar Pessoa - Estrutural-RS')

@section('content_header')
    <h1>Editar Pessoa</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Informações básicas</h3>
        <a type="button" href="{{route('cadastros.index')}}" class="btn btn-flat btn-secondary pull-right">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>
    <!-- /.box-header -->
    {!! Form::model($people,['method' => 'put', 'route' => ['gestao-pessoas.update', $people->id]]) !!}
        <input type="hidden" name="status" value="1">
        <div class="box-body">
            <div class="form-group col-md-2">
                <label for="cpf">CPF</label>
                {!! Form::text('cpf', $people->cpf, ['id' => 'cpf', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-5">
                <label for="name">Nome completo</label>
                {!! Form::text('name', $people->fullName, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-5">
                <label for="job">Função</label>
                {!! Form::select('job', $jobs, $people->job_id, ['id' => 'job', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="ctps">CTPS (Nº e Série)</label>
                {!! Form::text('ctps', $people->ctps, ['id' => 'ctps', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="phone_mobile">Celular</label>
                {!! Form::text('phone_mobile', $people->phoneMobile, ['id' => 'phone_mobile', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="mobile_alternative">Nº alternativo</label>
                {!! Form::text('mobile_alternative', $people->mobileAlternative, ['id' => 'mobile_alternative', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="birth_date">Data de Nascimento</label>
                {!! Form::text('birth_date', $people->birthDate, ['id' => 'datepicker', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="pcd">PCD</label><br>
                {!! Form::radio('pcd', 's') !!} Sim &nbsp;&nbsp;
                {!! Form::radio('pcd', 'n') !!} Não
            </div>
            <div class="form-group col-md-4">
                <label for="mother_name">Nome da mãe</label>
                {!! Form::text('mother_name', $people->motherName, ['id' => 'mother_name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="number">Chapa</label>
                {!! Form::text('number', $people->number, ['id' => 'number', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="cep">CEP</label>
                {!! Form::text('cep', $people->cep, ['id' => 'cep', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="address">Endereço</label>
                {!! Form::text('address', $people->address, ['id' => 'address', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-1">
                <label for="address_number">Número</label>
                {!! Form::text('address_number', $people->addressNumber, ['id' => 'address_number', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-1">
                <label for="address_extra">Complemento</label>
                {!! Form::text('address_extra', $people->addressExtra, ['id' => 'address_extra', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="neighborhood">Bairro</label>
                {!! Form::text('neighborhood', $people->neighborhood, ['id' => 'neighborhood', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="city">Cidade</label>
                {!! Form::text('city', $people->city, ['id' => 'city', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="state">Estado</label>
                {!! Form::text('state', $people->states, ['id' => 'state', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-1">
                <label for="boot_number">Nº botina</label>
                {!! Form::number('boot_number', $people->bootNumber, ['id' => 'boot_number', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-1">
                <label for="pants_number">Nº calça</label>
                {!! Form::text('pants_number', $people->pantsNumber, ['id' => 'pants_number', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-1">
                <label for="shirt_number">Nº camisa</label>
                {!! Form::text('shirt_number', $people->shirtNumber, ['id' => 'shirt_number', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-1">
                <label for="mark_number">Nº macacão</label>
                {!! Form::text('mark_number', $people->markNumber, ['id' => 'mark_number', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-3">
                <label for="email">Email</label>
                {!! Form::email('email', $people->email, ['id' => 'email', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="password">Senha</label>
                {!! Form::text('password', null, ['id' => 'password', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="profile">Perfil de acesso</label>
                {!! Form::select('profile', $profiles, $people->profile_id, ['id' => 'profile', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="profile">Turno</label>
                {!! Form::select('journey', ['0' => 'Selecione', '1' => '1','2' => '2','3' => '3','4' => '4','5' => '5' ], null, ['id' => 'journey', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
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
        <h3 class="box-title">Ficha do Candidato</h3>
    </div>
    <!-- /.box-header -->

    @forelse ($constructions as $item)
        <div class="box-header">
            <h4 class="box-title">{{$item->name}}</h4>
        </div>
        @forelse ($item->group as $group)
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th width="15%">{{$group->process->name}}</th>
                                @if ($group->process->id == 1 || $group->process->id == 2)
                                    <th width="30%">Nota</th>
                                @elseif ($group->process->id == 4)
                                    <th width="30%">Treinamento</th>
                                @elseif ($group->process->id == 5)
                                    <th width="30%">Status ASO</th>
                                @endif
                                <th>Data</th>
                                <th>Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($group->group_person as $gp)
                                <tr>
                                    <td>
                                        {{$gp->status->name}}
                                    </td>
                                    @if ($group->process->id == 1 || $group->process->id == 2)
                                        <td>{{$gp->note}}</td>
                                    @elseif ($group->process->id == 4)
                                        <td>{{$group->training->name}}</td>
                                    @elseif ($group->process->id == 5)
                                        <td>{{$gp->status_aso->name}}</td>
                                    @endif
                                    <td>{{$gp->updated_at->format('d/m/Y')}}</td>
                                    <td>
                                        <a type="button" href="#" class="btn btn-flat btn-info" data-toggle="modal" data-target="#modal-details-{{$gp->id}}">
                                            <i class="fa fa-info"></i>
                                        </a>
                                        <div class="modal fade" id="modal-details-{{$gp->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h4 class="modal-title" id="exampleModalLongTitle">Informações do Candidato</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group col-md-12">
                                                                <h4 for="anexos">Anexos</h4>
                                                                <ul>
                                                                    @forelse ($gp->person->people_document as $key => $item)
                                                                        <li>
                                                                            {{$item->filename}}
                                                                            <a target="new" href="{{$item->filepath}}" type="button" class="btn btn-flat btn-info btn-xs" style="margin:2px 0 2px 5px" title="Download">
                                                                                <i class="fa fa-download"></i>
                                                                            </a>
                                                                        </li>
                                                                        <br>
                                                                    @empty
                                                                        nenhum anexo até o momento...
                                                                    @endforelse
                                                                </ul>
                                                            </div>
                                                            @if ($gp->description != '')
                                                                <div class="form-group col-md-12">
                                                                    <h4 for="">Observação</h4>
                                                                    <span>{{$gp->description}}</span>
                                                                </div>
                                                            @endif

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <td colspan="4">nenhuma seleção técnica realizada...</td>
        @endforelse
        <br>
    @empty
    <div class="box-body">
        nenhuma obra até o momento...
    </div>
    @endforelse

    <!-- /.box-body -->
    <div class="box-footer clearfix">

    </div>
    {!! Form::close() !!}

</div>

@stop

@section('css')

@stop

@section('js')

    <script>

        $(document).ready( function () {

            $('#job').select2();
            $('#cpf').inputmask('999.999.999-99');
            $('#phone_mobile').inputmask('(99) 99999-9999');
            $('#mobile_alternative').inputmask('(99) 99999-9999');
            $('#birth_date').inputmask('99/99/9999');
            $('#cep').inputmask('99999-999');
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
