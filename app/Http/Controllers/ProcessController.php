<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Http\Middleware\CheckConstruction;
use App\Models\Job;
use App\Models\Person;
use Illuminate\Support\Facades\Session;

class ProcessController extends Controller
{

    public function __construct()
    {
        $this->middleware(CheckConstruction::class);
    }

    /**
     * Display a listing of the resource.
     * GET: /exam
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $construction = $this->getCheckConstruction('Erro!', 'danger');

        $processes = Process::with(['group.group_person'])
            ->with(['group.group_person_convocado',
                    'group.group_person_aprovado',
                    'group.group_person_reprovado',
                    'group.group_person_ressalva'])
            ->get();


        return view('processes.list', compact('processes'));
    }


    //CRIAÇÃO DE GRUPOS DENTRO DO PROCESSO
    public function create($id) {

        $process = Process::find($id);
        $status = Status::pluck('name', 'id');
        $status->prepend('Selecione', 0);

        $jobs = Job::pluck('name', 'id');
        $jobs->prepend('Selecione', 0);

        return view('processes.groups.create', compact('process', 'status', 'jobs'));
    }

    public function edit($idProcess, $idGroup) {

        $process = Process::find($idProcess);

        $group = Group::with('group_person.person.people_document')
            ->where('id', $idGroup)
            ->first();

        $status = Status::pluck('name', 'id');
        $status->prepend('Selecione', 0);

        $jobs = Job::pluck('name', 'id');
        $jobs->prepend('Selecione', 0);

        $sugestions = Person::join('vacancies', 'vacancies.job_id', '=', 'people.job_id')
            ->where('vacancies.construction_id', Session::get('construction')->id)
            ->get();

        return view('processes.groups.edit', compact('process', 'group', 'status', 'jobs', 'sugestions'));
    }

    /**
     * Store a newly created resource in storage.
     * POST: /exam
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $process = Process::create($request->all());
        return response()->json($process, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process)
    {
        $process = Process::find($process->id);
        return response()->json($process, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Process $process)
    {
        $process = Process::findOrFail($process->id);
        $process->fill($request->all());
        $process->save();
        return response()->json($process, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        $process = Process::findOrFail($process->id);
        $process->delete();
        return response()->json(null, 204);
    }
}
