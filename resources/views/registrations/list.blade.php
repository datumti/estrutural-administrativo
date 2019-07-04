@extends('adminlte::page')

@section('title', 'Cadastros')

@section('content_header')
    <h1>Cadastros</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-body">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0" style="background: #cd4126;">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="text-decoration:none">
                                <strong style="color:white; font-size: 18px">PESSOAS</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <a href="/pessoas/create" class="btn btn-warning">Adicionar</a>
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
                                        @foreach ($peoples as $people)
                                            <tr>
                                                <td>{{$people->name}}</td>
                                                <td>{{$people->cpf}}</td>
                                                <td>{{$people->cpf}}</td>
                                                <td class="table-actions">
                                                    <button class="btn btn-primary" title="Visualizar"><i class="fa fa-eye"></i></button> 
                                                    <button class="btn btn-danger" title="Remover"><i class="fa fa-trash"></i></button> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0" style="background: #cd4126">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration:none">
                            <strong style="color:white; font-size: 18px">CARGOS</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <button class="btn btn-warning">Adicionar</button>
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td>{{$job->name}}</td>
                                                <td class="table-actions">
                                                    <button class="btn btn-primary" title="Visualizar"><i class="fa fa-eye"></i></button> 
                                                    <button class="btn btn-danger" title="Remover"><i class="fa fa-trash"></i></button> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0" style="background: #cd4126">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="text-decoration:none">
                            <strong style="color:white; font-size: 18px">TREINAMENTOS</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <button class="btn btn-warning">Adicionar</button>
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trainings as $training)
                                            <tr>
                                                <td>{{$training->name}}</td>

                                                <td class="table-actions">
                                                    <button class="btn btn-primary" title="Visualizar"><i class="fa fa-eye"></i></button> 
                                                    <button class="btn btn-danger" title="Remover"><i class="fa fa-trash"></i></button> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0" style="background: #cd4126">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="text-decoration:none">
                            <strong style="color:white; font-size: 18px">EXAMES</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <button class="btn btn-warning">Adicionar</button>
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td>{{$exam->name}}</td>
                                                <td class="table-actions">
                                                    <button class="btn btn-primary" title="Visualizar"><i class="fa fa-eye"></i></button> 
                                                    <button class="btn btn-danger" title="Remover"><i class="fa fa-trash"></i></button> 
                                                </td>
                                            </tr>
                                        @endforeach
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
                "dom": "bfrtip",
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        } );        
    </script>
@stop