<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Job;
use App\Models\ContractConstruction;
use App\Models\Person;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /teams
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        foreach ($teams as $t) {
            $t->construction;
            $t->person;
            $t->job;
        }
        return response()->json($teams, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /teams
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = Team::create($request->all());
        return response()->json($team, 201);
    }

    public function populate($id)
    {
        $jobs = Job::all();
        $contracts = ContractConstruction::where('construction_id', $id)->get();
        $people = Person::all();
        $teams = Team::where('construction_id', $id)->get();
        foreach ($teams as $t) {
            $t->construction;
            $t->person;
            $t->job;
        }
        $resources = array('jobs' => $jobs, 'contracts' => $contracts, 'people' => $people, 'teams' => $teams);
        return response()->json($resources, 200);
    }

    /**
     * Display the specified resource by construction_id.
     * GET: /teams/:id
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($constructionId)
    {
        $teams = Team::where('construction_id', $constructionId)->get();
        foreach ($teams as $t) {
            $t->construction;
            $t->person;
            $t->job;
        }
        return response()->json($teams, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /teams/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $team = Team::findOrFail($team->id);
        $team->fill($request->all());
        $team->save();
        return response()->json($team, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /teams/:id
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team = Team::findOrFail($team->id);
        $team->delete();
        return response()->json(null, 204);
    }
}
