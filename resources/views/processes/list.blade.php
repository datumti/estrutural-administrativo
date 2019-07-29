@extends('adminlte::page')

@section('title', 'Processo Seletivo')

@section('content_header')
    <h1>Processo Seletivo</h1>
@stop

@section('content')
  <div class="content">
    <ul class="nav nav-tabs">
      @foreach($processes as $key => $process)
        <li class="nav-item {{$key == 0 ? 'active' : ''}}">
          <a class="nav-link" data-toggle="tab" href="#{{$process->id}}" style="color: black; font-size: 18px">{{mb_strtoupper($process->name, 'UTF-8')}}</a>
        </li>
      @endforeach
    </ul>

    <div class="tab-content">
        @foreach($processes as $key => $process)
            <div id="{{$process->id}}" class="tab-pane {{$key == 0 ? 'active' : ''}}">
                <br>
                <a href="{{url('processo-seletivo/'.$process->id.'/grupos/create')}}" class="btn btn-warning pull-right" href="#">
                    <i class="fa fa-plus"></i> Adicionar Grupo
                </a>
                <br><br>
                @switch($process->name)
                    @case ('Seleção Técnica')
                    @case ('Seleção Treinamento')
                    @case ('Seleção Psicológica')
                    @case ('Seleção Exame')
                    <div class="box box-info">
                        <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                <td>Grupo</td>
                                <td>Convocados</td>
                                <td>Aprovados</td>
                                <td>Reprovados</td>
                                <td>Ressalva</td>
                                @if ($process->name == 'Seleção Psicológica')
                                    <td>Requer avaliação</td>
                                @endif
                                <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($process->group as $group)
                                    <tr>
                                        <td>{{$group->name}}</td>
                                        <td>{{count($group->group_person)}}</td>
                                        <td><i class="fa fa-circle" style="color:green"></i> {{count($group->group_person_aprovado)}}</td>
                                        <td><i class="fa fa-circle" style="color:red"></i> {{count($group->group_person_reprovado)}}</td>
                                        <td><i class="fa fa-circle" style="color:orange"></i> {{count($group->group_person_ressalva)}}</td>
                                        @if ($process->name == 'Seleção Psicológica')
                                            <td><i class="fa fa-circle" style="color:orange"></i> {{count($group->group_person_avaliacao)}}</td>
                                        @endif
                                        <td>
                                            <a href="processo-seletivo/{{$process->id}}/grupos/{{$group->id}}/edit" class="btn btn-warning" title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-danger" title="Remover"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            nenhum grupo até o momento...
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    @break
                    @case ('Seleção Crachá')
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>Grupo</td>
                                                <td>Convocados</td>
                                                <td>Aprovados</td>
                                                <td>Inapto</td>
                                                <td>Em progresso</td>
                                                <td>Ações</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($process->group as $group)
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">nenhum grupo até o momento...</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @break
                @endswitch
            </div>
        @endforeach
    </div>
  </div>

@stop

@section('css')

@stop

@section('js')

@stop
