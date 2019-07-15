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

        $manager = new Manager();
        $manager->construction_id = $request->construction_id;
        $manager->contract_id = $request->contract_id;
        $manager->person_id_sms = $request->people_sms;
        $manager->person_id_quality = $request->people_quality;
        $manager->person_id_production = $request->people_production;
        $manager->person_id_discipline = $request->people_discipline;

        if($manager->save()) {
            $this->addFlash('Gerentes inseridos com sucesso!', 'success');
        } else {
            $this->addFlash('Erro ao inserir gerentes da obra!', 'danger');
        }

        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        $manager = Manager::find($id);
        $manager->contract_id = $request->contract_id;
        $manager->person_id_sms = $request->people_sms;
        $manager->person_id_quality = $request->people_quality;
        $manager->person_id_production = $request->people_production;
        $manager->person_id_discipline = $request->people_discipline;

        if($manager->save()) {
            $this->addFlash('Gerentes atualizados com sucesso!', 'success');
        } else {
            $this->addFlash('Erro ao atualizar gerentes da obra!', 'danger');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Manager::where('contract_id', $id)->delete()) {
            $this->addFlash('Gerentes removidos com sucesso!', 'success');
        } else {
            $this->addFlash('Erro ao remover gerentes da obra!', 'danger');
        }

        return redirect()->back();
    }

    public function get($id) {

        $manager = Manager::find($id);

        return response()->json($manager, 200);
    }
}
