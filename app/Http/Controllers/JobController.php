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

    /**
     * Store a newly created resource in storage.
     * POST: /jobs
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = Job::create($request->all());
        return response()->json($job, 201);
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
    public function update(Request $request, Job $job)
    {
        $job = Job::findOrFail($job->id);
        $job->fill($request->all());
        $job->save();
        return response()->json($job, 200);
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

