<?php

namespace App\Http\Controllers;
use App\Models\Reports;
use Illuminate\Http\Request;



class ReportController extends Controller
{

    /**
     * Display the required data for the registration page.
     * GET: /registration/populate
     * @return \Illuminate\Http\Response
     */
    public  function report($id)
    {
        // die($id);
        $report = array('report'=>Reports::getReport($id));
        // die();
        // return response()->json($report, 200);
        
    }
}