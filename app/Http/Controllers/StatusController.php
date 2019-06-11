<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /statuses
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return response()->json($statuses, 200);
    }

    /**
     * Display a listing of the resource for psico groups.
     * GET: /statuses
     * @return \Illuminate\Http\Response
     */
    public function psico()
    {
        $statuses = Status::whereIn('id', [1,2,3,4])->get();
        return response()->json($statuses, 200);
    }

    /**
     * Display a listing of the resource for main groups.
     * GET: /statuses
     * @return \Illuminate\Http\Response
     */
    public function group()
    {
        $statuses = Status::whereIn('id', [1,2,3])->get();
        return response()->json($statuses, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /statuses
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = Status::create($request->all());
        return response()->json($status, 201);
    }

    /**
     * Display the specified resource.
     * GET: /statuses/:id
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        $status = Status::find($status->id);
        return response()->json($status, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /statuses/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $status = Status::findOrFail($status->id);
        $status->fill($request->all());
        $status->save();
        return response()->json($status, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /statuses/:id
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status = Status::findOrFail($status->id);
        $status->delete();
        return response()->json(null, 204);
    }
}
