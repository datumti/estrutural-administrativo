<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Person;
use App\Models\ContractConstruction;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::all();
        foreach ($managers as $m) {
            $m->construction;
            $m->personSms;
            $m->personQuality;
            $m->personProduction;
            $m->personDiscipline;
        }
        return response()->json($managers, 200);
    }

    /**
     * Display a listing of all the child data the resource needs.
     * GET: /managers/populate/:id
     * @return \Illuminate\Http\Response
     */
    public function populate($id)
    {
        $people = Person::all();
        $managers = Manager::where('construction_id', $id)->get();
        foreach ($managers as $m) {
            $m->construction;
            $m->personSms;
            $m->personQuality;
            $m->personProduction;
            $m->personDiscipline;
        }
        $contracts = ContractConstruction::where('construction_id', $id)->get();
        $resources = array('people' => $people, 'managers' => $managers, 'contracts' => $contracts);
        return response()->json($resources, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manager = Manager::create($request->all());
        return response()->json($manager, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $managers = Manager::where('construction_id', $id)->get();
        foreach ($managers as $m) {
            $m->construction;
            $m->personSms;
            $m->personQuality;
            $m->personProduction;
            $m->personDiscipline;
        }
        return response()->json($managers, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $manager = Manager::findOrFail($manager->id);
        $manager->fill($request->all());
        $manager->save();
        return response()->json($manager, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        $manager = Manager::findOrFail($manager->id);
        $manager->delete();
        return response()->json(null, 204);
    }
}
