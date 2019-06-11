<?php

namespace App\Http\Controllers;

use App\Models\BadgeTraining;
use Illuminate\Http\Request;

class BadgeTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /badgetrainings
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badgeTrainings = BadgeTraining::all();
        foreach ($badgeTrainings as $bt) {
            $bt->training;
            $bt->construction;
        }
        return response()->json($badgeTrainings, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /badgetrainings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $badgeTraining = BadgeTraining::create($request->all());
        return response()->json($badgeTraining, 201);
    }

    /**
     * Display the specified resources by construction_id.
     * GET: /badgetrainings/:id
     * @param  \App\BadgeTraining  $badgeTraining
     * @return \Illuminate\Http\Response
     */
    public function show($badgeTrainingId)
    {
        $badgeTrainings = BadgeTraining::where('construction_id', $badgeTrainingId)->get();
        foreach ($badgeTrainings as $bt) {
            $bt->training;
            $bt->construction;
        }
        return response()->json($badgeTrainings, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /badgetrainings/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BadgeTraining  $badgeTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BadgeTraining $badgeTraining)
    {
        $badgeTraining = BadgeTraining::findOrFail($badgeTraining->id);
        $badgeTraining->fill($request->all());
        $badgeTraining->save();
        return response()->json($badgeTraining, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /badgetrainings/:id
     * @param  \App\BadgeTraining  $badgeTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy(BadgeTraining $badgeTraining)
    {
        $badgeTraining = BadgeTraining::findOrFail($badgeTraining->id);
        $badgeTraining->delete();
        return response()->json(null, 204);
    }
}
