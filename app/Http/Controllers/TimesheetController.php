<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Carbon;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($query = null, $params = null)
    {
        $filter['date'] = $params['date'];
        $filter['start_time'] = $params['start_time'];
        $filter['end_time'] = $params['end_time'];

        if ($query == null) $query = "YEAR(date) = YEAR(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE())";

        $timesheets = Timesheet::whereRaw($query)->get();

        $effective = [];
        foreach($timesheets as $key => $ef) {
            $effective[$ef->employee][] = $ef->time;
        }

        return view('effectives.list', compact('effective', 'filter'));

    }

    public function search(Request $request) {

        $validateData = $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        $query = "date = '" . $date . "'";
        $query = $query . " AND time >= '" . $request->start_time . "' AND time <= '" . $request->end_time . "'" ;

        return $this->index($query, $request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'file' => 'required'
        ]);

        $realpath = $request->file('file')->getRealPath();
        $file = file($realpath);

        $deleted = false;

        foreach($file as $row) {
            $employee = substr($row, 0, 6);
            $date = Carbon::createFromFormat('dmy', substr($row, 6, 6), null)->format('Y-m-d');
            $time = Carbon::createFromFormat('Hi', substr($row, 12, 4), null)->format('H:i');

            if(!$deleted) {
                if(Timesheet::where('date', $date)->count()) {
                    Timesheet::where('date', $date)->delete();
                    $deleted = true;
                }
            }

            $timesheet = new Timesheet();
            $timesheet->employee = $employee;
            $timesheet->date = $date;
            $timesheet->time = $time;
            $timesheet->save();
        }

        $this->addFlash('Importação efetuada com sucesso!', 'success');

        return redirect()->back();
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        /* $timesheet = Timesheet::find($timesheet->id);
        return response()->json($timesheet, 200); */



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        $timesheet = Timesheet::findOrFail($timesheet->id);
        $timesheet->fill($request->all());
        $timesheet->save();
        return response()->json($timesheet, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
        $timesheet = Timesheet::findOrFail($timesheet->id);
        $timesheet->delete();
        return response()->json(null, 204);
    }


}
