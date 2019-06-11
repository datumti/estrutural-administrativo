<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use DB;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($query = null)
    {
        if ($query == null) $query = "YEAR(date) = YEAR(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE())";
        $timesheets = Timesheet::whereRaw($query)->get();
        $times = array();
        foreach ($timesheets as $ts) {
            $times[$ts->employee] = [];
        }
        foreach ($timesheets as $ts) {
            $times[$ts->employee][$ts->date] = [];
        }
        foreach ($timesheets as $ts) {
            array_push($times[$ts->employee][$ts->date], $ts->time);
            sort($times[$ts->employee][$ts->date]);
        }
        $responseTimes = array();
        foreach ($times as $key => $t) {
            $dates = array();
            foreach ($t as $day => $time) {
                $date = new \stdClass();
                $date->date = $day;
                $date->times = $time;
                array_push($dates, $date);
            }
            array_push($responseTimes, [
                'employee' => $key,
                'dates' => $dates
            ]);
        }
        return response()->json($responseTimes, 200);
    }

    /**
     * Search the resources by range filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $query = "";
        if ($request->start_date != 'Invalid date') {
            $query = $query . "date >= '" . $request->start_date . "'";
            if ($request->end_date != 'Invalid date') $query = $query . ' AND ';
        }
        if ($request->end_date != 'Invalid date') {
            $query = $query . "date <= '" . $request->end_date . "'";
        }
        return $this->index($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timesheet = Timesheet::create($request->all());
        return response()->json($timesheet, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        $timesheet = Timesheet::find($timesheet->id);
        return response()->json($timesheet, 200);
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

    /**
     * Imports timesheet file to database.
     *
     * @return \Illuminate\Http\Response
     */
    public function importTimesheetFile(Request $request)
    {
        foreach ($request->input() as $row) {
            if ($row != null) {
                $employee = $row[5].$row[6].$row[7].$row[8].$row[9];
                
                $date = $row[10].$row[11].$row[12].$row[13].$row[14].$row[15];
                $date = str_split($date);
                $date = '20'.$date[4].$date[5].'-'.$date[2].$date[3].'-'.$date[0].$date[1];
                
                $time = $row[16].$row[17].$row[18].$row[19];
                $time = str_split($time);
                $time = $time[0].$time[1].':'.$time[2].$time[3];
                
                $timesheet = new Timesheet;
                $timesheet->employee = $employee;
                $timesheet->date = $date;
                $timesheet->time = $time;
                $timesheet->save();
            }
        }
        return response()->json($request->input(), 200);

    }
}
