<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Job;
use App\Models\Exam;
use App\Models\Training;

class RegistrationController extends Controller
{


        /**
     * Display a listing of the resource.
     * GET: /groups
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = Person::orderBy('name')->get();
        $jobs = Job::orderBy('name')->get();
        $trainings = Training::orderBy('name')->get();
        $exams = Exam::orderBy('name')->get();

        return view('registrations.list', compact('peoples', 'jobs', 'trainings', 'exams'));
    }


    /**
     * Display the required data for the registration page.
     * GET: /registration/populate
     * @return \Illuminate\Http\Response
     */
    public function populate()
    {
        $people = Person::all();
        $people = Person::orderBy('name', 'asc')->get();
        $jobs = Job::all();
        $jobs = Job::orderBy('name', 'asc')->get();
        $exams = Exam::all();
        $exams = Exam::orderBy('name', 'asc')->get();
        $trainings = Training::all();
        $trainings = Training::orderBy('name', 'asc')->get();
        $resources = array(
            'people' => $people, 
            'jobs' => $jobs,
            'exams' => $exams,
            'trainings' => $trainings
        );
        return response()->json($resources, 200);
    }
}
