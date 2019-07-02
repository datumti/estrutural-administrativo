<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\ContractConstruction;
use App\Models\Exam;
use App\Models\Training;
use App\Models\Job;
use App\Models\VacancyExam;
use App\Models\VacancyTraining;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /vacancies
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::all();
        return response()->json($vacancies, 200);
    }

    /**
     * Display a listing of all the child data the resource needs.
     * GET: /vacancies/populate/:id
     * @return \Illuminate\Http\Response
     */
    public function populate($id)
    {
        $exams = Exam::all();
        $trainings = Training::all();
        $jobs = Job::all();
        $exams = Exam::orderBy('name', 'asc')->get();
        $trainings = Training::OrderBy('name', 'asc')->get();
        $jobs = Job::OrderBy('name', 'asc')->get();
        $contracts = ContractConstruction::where('construction_id', $id)->get();
        $resources = array('exams' => $exams, 'trainings' => $trainings, 'jobs' => $jobs, 'contracts' => $contracts);
        return response()->json($resources, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /vacancies
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vacancy = Vacancy::create($request->all());

        foreach($request->exams as $exam) {
            $vacancyExam = new VacancyExam();
            $vacancyExam->vacancy_id = $vacancy->id;
            $vacancyExam->exam_id = $exam;
            $vacancyExam->save();
        }

        foreach($request->trainings as $training) {
            $vacancyTraining = new VacancyTraining();
            $vacancyTraining->vacancy_id = $vacancy->id;
            $vacancyTraining->training_id = $training;
            $vacancyTraining->save();
        }

        //return response()->json($vacancie, 201);
        $this->addFlash('Vagas inseridas com sucesso!', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resources by construction_id.
     * GET: /vacancies/:id
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show($vacancy)
    {
        $vacancies = Vacancy::where('construction_id', $vacancy)->get();

        //get ids from exams and trainings
        foreach ($vacancies as $v) {
            $examArray = VacancyExam::where('vacancy_id', $v->id)->get();
            $examArrayIds = array();
            foreach ($examArray as $exam) {
                array_push($examArrayIds, $exam->exam_id);
            }
            $v->exams = $examArrayIds;

            $trainingArray = VacancyTraining::where('vacancy_id', $v->id)->get();
            $trainingArrayIds = array();
            foreach ($trainingArray as $training) {
                array_push($trainingArrayIds, $training->training_id);
            }
            $v->trainings = $trainingArrayIds;
        }

        return response()->json($vacancies, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /vacancies/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $vacancy = Vacancy::findOrFail($vacancy->id);
        $vacancy->fill($request->all());
        $vacancy->save();
        return response()->json($vacancy, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /vacancies/:id
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy = Vacancy::findOrFail($vacancy->id);
        $vacancy->delete();
        return response()->json(null, 204);
    }
    public function findByJob(Request $request){
        $vacancy = Vacancy::where('job_id', $request->id);
        return response()->json($vacancy, 200);
    }
}
