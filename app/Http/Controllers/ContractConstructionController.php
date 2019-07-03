<?php

namespace App\Http\Controllers;

use App\Models\ContractConstruction;
use App\Models\Vacancy;
use App\Models\VacancyTraining;
use App\Models\VacancyExam;
use App\Models\Manager;
use App\Models\Team;
use Illuminate\Http\Request;

class ContractConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /contracts
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = ContractConstruction::all();
        foreach ($contracts as $c) {
            $c->construction;
        }
        return response()->json($contracts, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /contracts
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contract = ContractConstruction::create($request->all());
        return response()->json($contract, 201);
    }

    /**
     * Display the specified resource.
     * GET: /contracts/:id
     * @param  \App\ContractConstruction  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(ContractConstruction $contract)
    {
        $contract = ContractConstruction::find($contract->id);
        return response()->json($contract, 200);
    }

    /**
     * Display the specified resource by construction.
     * GET: /contracts/:id
     * @param  \App\ContractConstruction  $contract
     * @return \Illuminate\Http\Response
     */
    public function showByConstruction($constId)
    {
        $contracts = ContractConstruction::where('construction_id', $constId)->get();
        return response()->json($contracts, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /contracts/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContractConstruction  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContractConstruction $contract)
    {   
        $contract = ContractConstruction::findOrFail($contract->id);
        $contract->fill($request->all());
        $contract->save();
        return response()->json($contract, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /contracts/:id
     * 
     * @param  \App\ContractConstruction  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy($cc)
    {
        
        if(request()->construction_id == 'undefined') {
            $this->addFlash('Contrato removido com sucesso!', 'success');
            return redirect()->back();
        }

        $cc = ContractConstruction::where('contract_id', $cc)
            ->where('construction_id', request()->construction_id)
            ->first();

        // remove vacancies
        $vacancies = Vacancy::where('contract_id', $cc->contract_id)->get();
        foreach ($vacancies as $vacancy) {
            $vacancyTrainings = VacancyTraining::where('vacancy_id', $vacancy->id)->get();
            foreach ($vacancyTrainings as $vt) {
                $vt->delete();
            }
            $vacancyExams = VacancyExam::where('vacancy_id', $vacancy->id)->get();
            foreach ($vacancyExams as $ve) {
                $ve->delete();
            }
            $vacancy->delete();
        }
        // remove managers
        $managers = Manager::where('contract_id', $cc->contract_id)->get();
        foreach ($managers as $m) {
            $m->delete();
        }
        // remove teams
        $teams = Team::where('contract_id', $cc->contract_id)->get();
        foreach ($teams as $t) {
            $t->delete();
        }
        // delete contract_construction
        $cc->delete();
        
        $this->addFlash('Contrato removido com sucesso!', 'success');
        return redirect()->back();
        
    }
}
