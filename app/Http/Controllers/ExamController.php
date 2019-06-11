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


    /**
     * Store a newly created resource in storage.
     * POST: /exams
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = Exam::create($request->all());
        return response()->json($exam, 201);
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
        $exam->save();
        return response()->json($exam, 200);
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
