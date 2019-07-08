<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /exams
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        $exams = Exam::orderBy('name', 'asc')->get();
        return response()->json($exams, 200);
    }

    public function create() {
        return view('exams.create');
    }

    public function edit($id) {

        $exam = Exam::find($id);
        return view('exams.edit', compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     * POST: /exams
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = Exam::create($request->all());
            
        $this->addFlash('Exame criado com sucesso!', 'success');
        return redirect()->route('exames.edit', $exam->id);
    }

    /**
     * Display the specified resource.
     * GET: /exams/:id
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $exam = Exam::find($exam->id);
        return response()->json($exam, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /exams/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $exam = Exam::findOrFail($exam->id);
        $exam->fill($request->all());
        
        if ($exam->save()) {
            $this->addFlash('Exame criado com sucesso!', 'success');
            return redirect()->route('exames.edit', $exam->id);
        } else {
            $this->addFlash('Erro ao criar exame!', 'warning');
            return redirect()->back()->withInputs();
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /exams/:id
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam = Exam::findOrFail($exam->id);
        $exam->delete();
        return response()->json(null, 204);
    }
}
