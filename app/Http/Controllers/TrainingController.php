<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /trainings
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = Training::all();
        $trainings = Training::orderBy('name', 'asc')->get();
        return response()->json($trainings, 200);
    }

    public function create() {
        return view('trainings.create');
    }

    public function edit($id) {

        $training = Training::find($id);
        return view('trainings.edit', compact('training'));
    }

    /**
     * Store a newly created resource in storage.
     * POST: /trainings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $training = Training::create($request->all());
        return response()->json($training, 201);
    }

    /**
     * Display the specified resource.
     * GET: /trainings/:id
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        $training = Training::find($training->id);
        return response()->json($training, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /trainings/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        $training = Training::findOrFail($training->id);
        $training->fill($request->all());
        $training->save();
        return response()->json($training, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /trainings/:id
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        $training = Training::findOrFail($training->id);
        $training->delete();
        return response()->json(null, 204);
    }
}
