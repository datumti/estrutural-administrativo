<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /jobs
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::orderBy('name', 'asc')->get();
        return response()->json($jobs, 200);
    }

    public function create() {
        return view('jobs.create');
    }

    public function edit($id)
    {
        $job = Job::find($id);

        return view('jobs.edit', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     * POST: /jobs
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = new Job();
        $job->name = $request->name;
        $job->description = $request->description;
        $job->crm = 1;
        $job->clinic = 1;

        if ($job->save()) {
            $this->addFlash('Cargo criado com sucesso!', 'success');
            return redirect()->route('cargos.edit', $job->id);
        } else {
            $this->addFlash('Erro ao criar cargo!', 'warning');
            return redirect()->back()->withInputs();
        }
    }

    /**
     * Display the specified resource.
     * GET: /jobs/:id
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $job = Job::find($job->id);
        return response()->json($job, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /jobs/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->fill($request->all());

        if ($job->save()) {
            $this->addFlash('Cargo atualizado com sucesso!', 'success');
            return redirect()->route('cargos.edit', $job->id);
        } else {
            $this->addFlash('Erro ao atualizar cargo!', 'warning');
            return redirect()->back()->withInputs();
        }

    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /jobs/:id
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job = Job::findOrFail($job->id);
        $job->delete();
        return response()->json(null, 204);
    }
}

