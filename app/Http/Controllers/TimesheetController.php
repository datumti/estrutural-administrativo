<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TimesheetExport;
use App\Exports\TimesheetViewExport;
use App\Models\Job;
use App\Models\Construction;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $effective = [];
        $filter['date'] = '';
        $filter['start_time'] = '';
        $filter['end_time'] = '';
        $fileName = '';

        //se filtragem
        if($request->date) {
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

            $query = "date = '" . $date . "'";
            $query = $query . " AND time >= '" . $request->start_time . "' AND time <= '" . $request->end_time . "'" ;

            $filter['date'] = $request->date;
            $filter['start_time'] = $request->start_time;
            $filter['end_time'] = $request->end_time;

            $timesheets = Timesheet::whereRaw($query)->orderBy('employee')->get();

            foreach($timesheets as $key => $ef) {
                $effective[$ef->employee][] = $ef->time;
            }

            $construction = $this->getCheckConstruction('Você deve selecionar uma obra para pesquisar seu efetivo!', 'info');

            $report = new TimesheetViewExport($filter, $construction);
            $fileName = str_replace('/', '', $filter['date']).'.xlsx';

            //Excel::store($report, $fileName);
            //Excel::download($report, storage_path().'/app/'.$fileName);
            /* return response()->download(storage_path().'/app/'.$fileName, $fileName, [
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Disposition' => "attachment; filename='".$fileName."'"
           ]); */

        } else {
            //default dia atual
            $query = "YEAR(date) = YEAR(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND DAY(date) = DAY(CURRENT_DATE())";
            $timesheets = Timesheet::whereRaw($query)->orderBy('employee')->get();

            foreach($timesheets as $key => $ef) {
                $effective[$ef->employee][] = $ef->time;
            }
        }

        return view('effectives.list', compact('effective', 'filter', 'fileName'));

    }

    public function export($fileName)
    {
//dd($fileName);


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $construction = $this->getCheckConstruction('Você deve selecionar uma obra para importar seu efetivo!', 'info');

        $validateData = $request->validate([
            'file' => 'required|mimes:txt'
        ]);

        $realpath = $request->file('file')->getRealPath();
        $file = file($realpath);

        $deleted = false;

        foreach($file as $row) {
            if($row != '') {
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
                $timesheet->construction_id = $construction->id;
                $timesheet->save();
            } else {
                $this->addFlash('Erro ao importar arquivo', 'danger');
                return redirect()->back();
            }
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
