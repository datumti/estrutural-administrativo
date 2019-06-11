<?php

namespace App\Http\Controllers;

use App\Models\JobTraining;
use Illuminate\Http\Request;

class JobTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobTrainings = JobTraining::all();
        return response()->json($jobTrainings, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobTraining = JobTraining::create($request->all());
        return response()->json($jobTraining, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobTraining  $jobTraining
     * @return \Illuminate\Http\Response
     */
    public function show(JobTraining $jobTraining)
    {
        $jobTraining = JobTraining::find($jobTraining->id);
        return response()->json($jobTraining, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobTraining  $jobTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobTraining $jobTraining)
    {
        $jobTraining = JobTraining::findOrFail($jobTraining->id);
        $jobTraining->fill($request->all());
        $jobTraining->save();
        return response()->json($jobTraining, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobTraining  $jobTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTraining $jobTraining)
    {
        $jobTraining = JobTraining::findOrFail($jobTraining->id);
        $jobTraining->delete();
        return response()->json(null, 204);
    }
}
