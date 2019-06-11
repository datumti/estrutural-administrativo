<?php

namespace App\Http\Controllers;

use App\Models\Resignation;
use Illuminate\Http\Request;
use App\Models\EmailModel;
class ResignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resignations = Resignation::all();
        return response()->json($resignations, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resignation = Resignation::create($request->all());
        return response()->json($resignation, 201);
    }

    /**
     * Store a list of new resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeList(Request $request)
    {
        $resignations = array();
        foreach ($request->input() as $r) {
            $resignation = new Resignation;
            $resignation->id = $r['id'];
            $resignation->person_id = $r['person_id'];
            $resignation->construction_id = $r['construction_id'];
            $resignation->description = $r['description'];
            $resignation->evaluation_discipline = $r['evaluation_discipline'];
            $resignation->evaluation_production = $r['evaluation_production'];
            $resignation->evaluation_quality = $r['evaluation_quality'];
            $resignation->evaluation_sms = $r['evaluation_sms'];
            $resignation->fired = $r['fired'];
            $resignation->save();
            array_push($resignations, $resignation);
        }
        return response()->json($resignations, 201);
    }

    /**
     * Store a list of new resources in storage after evaluations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEvaluations(Request $request)
    {
        $resignations = array();
        foreach ($request->input() as $r) {
            $resignation = Resignation::findOrFail($r['id']);
            $resignation->description = $r['description'];
            $resignation->evaluation_discipline = $r['evaluation_discipline'];
            $resignation->evaluation_production = $r['evaluation_production'];
            $resignation->evaluation_quality = $r['evaluation_quality'];
            $resignation->evaluation_sms = $r['evaluation_sms'];
            $resignation->fired = 0;
            $resignation->save();
            array_push($resignations, $resignation);
        }
        return response()->json($resignations, 201);
    }

    /**
     * Mark the given employees to resignation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dismiss(Request $request)
    {
        $resignations = array();
        foreach ($request->input() as $r) {
            
            $resignation = Resignation::findOrFail($r['id']);
            $resignation->fired = 1;
            $resignation->save();
            array_push($resignations, $resignation);
        }
        // print_r($resignations);
        $title="Confirmação de Demissão";
        $email=EmailModel::getEmail($title, $resignations);
        EmailModel::send('estefani.silva@datumcorp.inf.br', $email);
        
        return response()->json($resignations, 201);
    }

    /**
     * Mark the given employees as transfered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request, $constructionId)
    {
        $people = array();
        foreach ($request->input() as $p) {
            $resignation = Resignation::find($p['id']);
            if ($resignation == null) {
                $resignation = new Resignation;
                $resignation->person_id = $p['id'];
                $resignation->construction_id = $constructionId;
            }
            $resignation->transfered = 1;
            $resignation->save();
            array_push($people, $resignation);
        }
        return response()->json($people, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resignation  $resignation
     * @return \Illuminate\Http\Response
     */
    public function show(Resignation $resignation)
    {
        $resignation = Resignation::find($resignation->id);
        return response()->json($resignation, 200);
    }

    /**
     * Display the specified resources by Construction.
     *
     * @param  int  $resignation
     * @return \Illuminate\Http\Response
     */
    public function findByConstruction($constructionId)
    {
        $resignations = Resignation::where('construction_id', $constructionId);
        return response()->json($resignations, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resignation  $resignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resignation $resignation)
    {
        $resignation = Resignation::findOrFail($resignation->id);
        $resignation->fill($request->all());
        $resignation->save();
        return response()->json($resignation, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resignation  $resignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resignation $resignation)
    {
        $resignation = Resignation::findOrFail($resignation->id);
        $resignation->delete();
        return response()->json(null, 204);
    }
}
