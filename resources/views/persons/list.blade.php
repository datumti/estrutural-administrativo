@extends('adminlte::page')

@section('title', 'Gestão de Pessoas')

@section('content_header')
    <h1>Gestão de Pessoas</h1>
@stop

@section('content')
        
<div class="content">
    <ul class="nav nav-tabs">
        <li class="nav-item active">
          <a class="nav-link" data-toggle="tab" href="#candidatos" style="color: black;font-size: 18px">CANDIDATOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#funcionarios" style="color: black;font-size: 18px">FUNCIONÁRIOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#demissao" style="color: black;font-size: 18px">DEMISSÃO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#transferencia" style="color: black;font-size: 18px">TRANSFERÊNCIA</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="candidatos" class="tab-pane active">
            <br>
            <div class="box box-info">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peoples as $people)
                                    <tr>
                                        <td>{{$people->name}}</td>
                                        <td>{{$people->cpf}}</td>
                                        <td>{{$people->cpf}}</td>
                                        <td class="table-actions">
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">nenhum candidato até o momento...</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
        <div id="funcionarios" class="tab-pane">
            <br>
            <div class="box box-info">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td colspan="4">nenhum candidato até o momento...</td>
                                    </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
        <div id="demissao" class="tab-pane">
            <br>
            <div class="box box-info">
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" data-toggle="tab" href="#triagem" style="color: black;font-size: 18px">1 - Triagem</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#avaliacao" style="color: black;font-size: 18px">2 - Avaliação</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#dem" style="color: black;font-size: 18px">3 - Demissão</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="triagem" class="tab-pane active">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>CPF</th>
                                                    <th>RG</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                    <tr>
                                                        <td colspan="4">nenhum candidato até o momento...</td>
                                                    </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="avaliacao" class="tab-pane">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>CPF</th>
                                                    <th>RG</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <tr>
                                                        <td colspan="4">nenhum candidato até o momento...</td>
                                                    </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="dem" class="tab-pane">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>CPF</th>
                                                    <th>RG</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                    <tr>
                                                        <td colspan="4">nenhum candidato até o momento...</td>
                                                    </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Desligados</h3>
                </div>
                <div class="box-body">    
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td colspan="4">nenhum desligamento até o momento...</td>
                                    </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
        <div id="transferencia" class="tab-pane">
            <br>
            <div class="box box-info">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td colspan="4">nenhum candidato até o momento...</td>
                                    </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Transferidos</h3>
                </div>
                <div class="box-body">    
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td colspan="4">nenhuma transferência até o momento...</td>
                                    </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
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
            $('.table').DataTable({
                "dom": "f"
            });
        } );  
    </script>
@stop