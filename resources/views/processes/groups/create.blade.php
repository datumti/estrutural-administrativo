@extends('adminlte::page')

@section('title', 'Criar Grupo - Estrutural-RS')

@section('content_header')
    <h1>{{$process->name}}</h1>
@stop

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Novo Grupo</h3>
        <a type="button" href="{{route('processo-seletivo.index')}}" class="btn btn-flat btn-secondary pull-right">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>
    <!-- /.box-header -->
    {!! Form::open(['method' => 'post', 'route' => ['grupos.store']]) !!}
        <input type="hidden" name="process_id" value="{{$process->id}}">
        <input type="hidden" name="construction_id" value="{{Session::get('construction.id')}}">
        <div class="box-body">
            <div class="form-group col-md-4">
                <label for="name">Nome do Grupo</label>
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="creation_date">Data</label>
                {!! Form::text('creation_date', null, ['id' => 'datepicker', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
        </div>
        <div class="box-header with-border">
            <h3 class="box-title">Candidato</h3>
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
                {!! Form::text('job', null, ['id' => 'job', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="status">Status</label>
                {!! Form::select('status', $status, null,['id' => 'status', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
            </div>
            <div class="form-group col-md-2">
                <button type="button" class="btn btn-flat btn-info" style="margin:25px 0 0 0" title="Informações">
                    <i class="fa fa-info fa-1x"></i> 
                </button>
                <button type="button" class="btn btn-flat btn-warning" style="margin:25px 0 0 0" title="Anexar documento">
                    <i class="fa fa-paperclip fa-1x"></i> 
                </button>
                <button type="button" class="btn btn-flat btn-danger" style="margin:25px 0 0 0" title="Excluir">
                    <i class="fa fa-trash fa-1x"></i>
                </button>
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