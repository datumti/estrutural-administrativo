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
