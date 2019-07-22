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
        $training = new Training();
        $training->name = $request->name;
        $training->description = $request->description;

        if ($training->save()) {
            $this->addFlash('Treinamento criado com sucesso!', 'success');
            return redirect()->route('treinamentos.edit', $training->id);
        } else {
            $this->addFlash('Erro ao criar treinamento!', 'warning');
            return redirect()->back()->withInputs();
        }
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
    public function update(Request $request, $id)
    {
        $training = Training::findOrFail($id);
        $training->fill($request->all());

        if ($training->save()) {
            $this->addFlash('Treinamento atualizado com sucesso!', 'success');
            return redirect()->route('treinamentos.edit', $training->id);
        } else {
            $this->addFlash('Erro ao atualizar treinamento!', 'warning');
            return redirect()->back()->withInputs();
        }

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
