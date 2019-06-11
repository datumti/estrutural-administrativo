<?php

namespace App\Http\Controllers;

use App\Models\BadgeExam;
use Illuminate\Http\Request;

class BadgeExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /badgeexams
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badgeExams = BadgeExam::all();
        foreach ($badgeExams as $be) {
            $be->exam;
            $be->construction;
        }
        return response()->json($badgeExams, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /badgeexams
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $badgeExam = BadgeExam::create($request->all());
        return response()->json($badgeExam, 201);
    }

    /**
     * Display the specified resources by construction_id.
     * GET: /badgeexams/:id
     * @param  \App\BadgeExam  $badgeExam
     * @return \Illuminate\Http\Response
     */
    public function show($constructionId)
    {
        $badgeExams = BadgeExam::where('construction_id', $constructionId)->get();
        foreach ($badgeExams as $be) {
            $be->exam;
            $be->construction;
        }
        return response()->json($badgeExams, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /badgeexams/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BadgeExam  $badgeExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BadgeExam $badgeExam)
    {
        $badgeExam = BadgeExam::findOrFail($badgeExam->id);
        $badgeExam->fill($request->all());
        $badgeExam->save();
        return response()->json($badgeExam, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /badgeexams/:id
     * @param  \App\BadgeExam  $badgeExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(BadgeExam $badgeExam)
    {
        $badgeExam = BadgeExam::findOrFail($badgeExam->id);
        $badgeExam->delete();
        return response()->json(null, 204);
    }
}
