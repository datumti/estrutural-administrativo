<?php

namespace App\Http\Controllers;

use App\Models\Restriction;

use Illuminate\Http\Request;
use App\Models\RestrictionExclusion;
use DB;
use Auth;

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

        $restrictionExclusions = RestrictionExclusion::with(['restriction' => function($query) {
                $query->withTrashed();
            }])
            ->with('people')
            ->get();

            return view('restrictions.list', compact('restrictions', 'restrictionExclusions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'description' => 'required',
        ]);

        if(Restriction::create($request->all())) {
            $this->addFlash('Restrição cadastrada com sucesso!', 'success');
        } else {
            $this->addFlash('Erro ao inserir restrição!', 'success');
        }

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
    public function destroy(Request $request, $id)
    {
        $restriction = Restriction::findOrFail($id);

        if($restriction->delete()) {

            $restrictionExclusion = new RestrictionExclusion();
            $restrictionExclusion->people_id = Auth::user()->id;
            $restrictionExclusion->restriction_id = $id;
            $restrictionExclusion->description = $request->description;
            $restrictionExclusion->save();

            $this->addFlash('Restrição removida com sucesso!', 'success');
        } else {
            $this->addFlash('Erro ao remover restrição!', 'danger');
        }

        return redirect()->route('restricoes.index');
    }
}
