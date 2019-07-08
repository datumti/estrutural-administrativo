<?php

namespace App\Http\Controllers;

use App\Models\Restriction;
use App\Models\Person;
use Illuminate\Http\Request;
use DB;

class RestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restrictions = Restriction::all();
        $peoples = Person::pluck('name', 'id');
        $peoples = Person::select(DB::raw("CONCAT(name,' - ',cpf) AS name"),'id')->pluck('name', 'id');
        $peoples->prepend('Selecione', '');
        return view('restrictions.list', compact('restrictions', 'peoples'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restriction = Restriction::create($request->all());
        $this->addFlash('Restrição cadastrada com sucesso!', 'success');
        return redirect()->route('restricoes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restriction  $restriction
     * @return \Illuminate\Http\Response
     */
    public function show(Restriction $restriction)
    {
        $restriction = Restriction::find($restriction->id);
        return response()->json($restriction, 200);
    }

    /**
     * Display the specified resource by CPF.
     *
     * @param  string  $cpf
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $restriction = Restriction::where('cpf', $request->input()[0])->first();
        if ($restriction == null) {
            return response()->json(null, 204);
        }
        else {
            return response()->json($restriction, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restriction  $restriction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restriction $restriction)
    {
        $restriction = Restriction::findOrFail($restriction->id);
        $restriction->fill($request->all());
        $restriction->save();
        return response()->json($restriction, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restriction  $restriction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restriction $restriction)
    {
        $restriction = Restriction::findOrFail($restriction->id);
        $restriction->delete();
        return response()->json(null, 204);
    }
}
