<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /exam
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::all();
        return response()->json($processes, 200);
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
