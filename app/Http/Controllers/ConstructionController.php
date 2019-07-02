<?php

namespace App\Http\Controllers;

use App\Models\Construction;
use App\Models\BadgeExam;
use App\Models\BadgeTraining;
use App\Models\ContractConstruction;
use App\Models\Manager;
use App\Models\Team;
use App\Models\Person;
use App\Models\Vacancy;
use App\Models\VacancyExam;
use App\Models\VacancyTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Exam;
use App\Models\Training;
use App\Models\Job;

class ConstructionController extends Controller
{

    // Seta na sessão do PHP a obra para facilitar gerenciamento
    public function set($constructionId) {
        
        \Session::put('construction', Construction::find($constructionId));
        $this->addFlash('Obra selecionada com sucesso!', 'success');

        return redirect()->back();
    }

    public function create() {
        return view('constructions.create');
    }


    public function edit($id) {

        $construction = Construction::with('vacancy.job')
            ->with('vacancy.vacancy_exam.exam')
            ->with('vacancy.vacancy_training.training')
            ->where('id', $id)
            ->first();

        $exams = Exam::orderBy('name')->pluck('name', 'id');
        $trainings = Training::orderBy('name')->pluck('name', 'id');
        $jobs = Job::orderBy('name')->pluck('name', 'id');
        $contracts = ContractConstruction::where('construction_id', $construction->id)->orderBy('id')->pluck('contract_id', 'contract_id');
        
        return view('constructions.edit', compact('construction', 'exams', 'trainings', 'jobs', 'contracts'));
    }

    /**
     * Display a listing of the resource.
     * GET: /constructions
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $constructions = Construction::with('contract')
            ->where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        //return response()->json($constructions, 200);

        return view('constructions.list', compact('constructions'));
    }

    /**
     * Store a newly created resource in storage.
     * POST: /constructions
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $construction = Construction::create($request->all());
        
        foreach ($request->contracts as $c) {
            $cc = new ContractConstruction;
            $cc->contract_id = $c;
            $cc->construction_id = $construction->id;
            $cc->save();
        }
        //return response()->json($construction, 201);
        $this->addFlash('Obra criada com sucesso!', 'success');
        return Redirect::route('gestao-obras.edit', ['id' => $construction->id]);
        //return redirect('/gestao-obras/'.$construction->id.'/edit');
    }

    /**
     * Display the specified resource.
     * GET: /constructions/:id
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function show(Construction $construction)
    {
        $construction = Construction::find($construction->id);
        $contracts = ContractConstruction::where('construction_id', $construction->id)->get();
        $construction->contracts = $contracts;
        return response()->json($construction, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /constructions/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $construction = Construction::findOrFail($id);
        $construction->name = $request->name;
        $construction->cut_grade = $request->cut_grade;
        
        if($construction->save()) {
            ContractConstruction::where('construction_id', $construction->id)->delete();
            
            foreach ($request->contracts as $c) {
                $cc = new ContractConstruction;
                $cc->contract_id = $c;
                $cc->construction_id = $construction->id;
                $cc->save();
            }

            $this->addFlash('Obra atualizada com sucesso!', 'success');

            return redirect()->back();
        }
    

        /* $construction->vacancies = $this->updateConstructionVacancy($request);
        $construction->managers = $this->updateConstructionManager($request);
        $construction->teams = $this->updateConstructionTeam($request); */
        //$construction->badge = $this->updateConstructionBadge($request);
        //return response()->json($construction, 200);
    }

    public function updateConstructionBadge(Request $request)
    {
        //exams
        $dbBadgeExams = BadgeExam::where('construction_id', $request->id)->get();
        $dbExams = array();
        foreach ($dbBadgeExams as $be) {
            array_push($dbExams, $be->exam_id);
        }
        $examsToDelete = array_diff($dbExams, $request->badge['exams']);
        $examsToInclude = array_diff($request->badge['exams'], $dbExams);
        foreach ($examsToDelete as $examId) {
            $be = BadgeExam::where('exam_id', $examId)->where('construction_id', $request->id)->first();
            $be->delete();
        }
        foreach ($examsToInclude as $examId) {
            $be = new BadgeExam;
            $be->construction_id = $request->id;
            $be->exam_id = $examId;
            $be->save();
        }
        //trainings
        $dbBadgeTrainings = BadgeTraining::where('construction_id', $request->id)->get();
        $dbTrainings = array();
        foreach ($dbBadgeTrainings as $bt) {
            array_push($dbTrainings, $bt->training_id);
        }
        $trainingsToDelete = array_diff($dbTrainings, $request->badge['trainings']);
        $trainingsToInclude = array_diff($request->badge['trainings'], $dbTrainings);
        foreach ($trainingsToDelete as $trainingId) {
            $bt = BadgeTraining::where('training_id', $trainingId)->where('construction_id', $request->id)->first();
            $bt->delete();
        }
        foreach ($trainingsToInclude as $trainingId) {
            $bt = new BadgeTraining;
            $bt->construction_id = $request->id;
            $bt->training_id = $trainingId;
            $bt->save();
        }

        return $request->badge;
    }

    public function updateConstructionTeam(Request $request)
    {
        //checks if some team was removed
        $dbTeams = Team::where('construction_id', $request->id)->get();
        $dbTeamsIds = array();
        foreach ($dbTeams as $dbt) {
            array_push($dbTeamsIds, $dbt->id);
        }
        $inputTeamsIds = array();
        foreach ($request->teams as $t) {
            array_push($inputTeamsIds, $t['id']);
        }
        $teamIdsToRemove = array_diff($dbTeamsIds, $inputTeamsIds);
        foreach ($teamIdsToRemove as $id) {
            $ttr = Team::findOrFail($id);
            $ttr->delete();
        }

        foreach ($request->teams as $team) {
            if ($team['id'] == null) {
                //new team
                $newTeam = new Team;
                $newTeam->openings = $team['openings'];
                $newTeam->contract_id = $team['contracts'];
                $newTeam->job_id = $team['jobs'];
                if (is_numeric($team['leader'][0])) { //first chat is number = is cpf
                    $newTeam->person_id = Person::where('cpf', $team['leader'])->first()->id;
                } else { //is name
                    $newTeam->person_id = Person::where('name', $team['leader'])->first()->id;
                }
                $newTeam->construction_id = $request->id;
                $newTeam->save();
            } else {
                //existing team
                $existingTeam = Team::findOrFail($team['id']);
                $existingTeam->openings = $team['openings'];
                $existingTeam->contract_id = $team['contracts'];
                $existingTeam->job_id = $team['jobs'];
                if (is_numeric($team['leader'][0])) { //first chat is number = is cpf
                    $existingTeam->person_id = Person::where('cpf', $team['leader'])->first()->id;
                } else { //is name
                    $existingTeam->person_id = Person::where('name', $team['leader'])->first()->id;
                }
                $existingTeam->save();
            }
        }
        return $request->teams;
    }

    public function updateConstructionVacancy(Request $request)
    {
        //checks if some vacancy was removed
        $dbVacancies = Vacancy::where('construction_id', $request->id)->get();
        $dbVacanciesIds = array();
        foreach ($dbVacancies as $dbv) {
            array_push($dbVacanciesIds, $dbv->id);
        }
        $inputVacanciesIds = array();
        foreach ($request->vacancies as $v) {
            array_push($inputVacanciesIds, $v['id']);
        }
        $vacancyIdsToRemove = array_diff($dbVacanciesIds, $inputVacanciesIds);
        foreach ($vacancyIdsToRemove as $id) {
            $vtr = Vacancy::findOrFail($id);
            $vtr->delete();
        }

        foreach ($request->vacancies as $vacancy) {
            if ($vacancy['id'] == null) {
                //new vacancy
                $newVacancy = new Vacancy;
                $newVacancy->number = $vacancy['number'];
                $newVacancy->contract_id = $vacancy['contracts'];
                $newVacancy->job_id = $vacancy['jobs'];
                $newVacancy->construction_id = $request->id;
                if(isset($request->quality_vacancy)){
                    $newVacancy->quality_vacancy = $request->quality_vacancy;
                }else{
                    $newVacancy->quality_vacancy = 0;
                }

               
                
                $newVacancy->save();
                //save exams
                foreach ($vacancy['exams'] as $exam) {
                    $vacancyExam = new VacancyExam;
                    $vacancyExam->vacancy_id = $newVacancy->id;
                    $vacancyExam->exam_id = $exam;
                    $vacancyExam->save();
                }
                //save trainings
                foreach ($vacancy['trainings'] as $training) {
                    $vacancyTraining = new VacancyTraining;
                    $vacancyTraining->vacancy_id = $newVacancy->id;
                    $vacancyTraining->training_id = $training;
                    $vacancyTraining->save();
                }
            } else {
                //existing vacancy
                // print_r($vacancy);
                $existingVacancy = Vacancy::findOrFail($vacancy['id']);
                $existingVacancy->number = $vacancy['number'];
                $existingVacancy->contract_id = $vacancy['contracts'];
                $existingVacancy->job_id = $vacancy['jobs'];
                if(isset($vacancy['quality_vacancy'])){
                    $existingVacancy->quality_vacancy = $vacancy['quality_vacancy'];
                }else{
                    $existingVacancy->quality_vacancy = 0;
                }
                
            
                $existingVacancy->save();
                $this->updateVacancyExamsAndTrainings($existingVacancy, $vacancy['exams'], $vacancy['trainings']);
            }
        }
        return $request->vacancies;
    }

    public function updateConstructionManager(Request $request)
    {
        foreach ($request->managers as $manager) {
            $m = Manager::where('construction_id', $manager['construction_id'])->where('contract_id', $manager['contract'])->first();
            if ($m == null) {
                //insert new manager
                $m = new Manager;
                $m->construction_id = $manager['construction_id'];
                $m->contract_id = $manager['contract'];

                if (is_numeric($manager['sms'][0])) { //first chat is number = is cpf
                    $m->person_id_sms = Person::where('cpf', $manager['sms'])->first()->id;
                } else { //is name
                    $m->person_id_sms = Person::where('name', $manager['sms'])->first()->id;
                }
                if (is_numeric($manager['quality'][0])) {
                    $m->person_id_quality = Person::where('cpf', $manager['quality'])->first()->id;
                } else {
                    $m->person_id_quality = Person::where('name', $manager['quality'])->first()->id;
                }
                if (is_numeric($manager['discipline'][0])) {
                    $m->person_id_discipline = Person::where('cpf', $manager['discipline'])->first()->id;
                } else {
                    $m->person_id_discipline = Person::where('name', $manager['discipline'])->first()->id;
                }
                if (is_numeric($manager['production'][0])) {
                    $m->person_id_production = Person::where('cpf', $manager['production'])->first()->id;
                } else {
                    $m->person_id_production = Person::where('name', $manager['production'])->first()->id;
                }
                $m->save();
            } else {
                //update existing manager
                if (is_numeric($manager['sms'][0])) { //first chat is number = is cpf
                    $m->person_id_sms = Person::where('cpf', $manager['sms'])->first()->id;
                } else { //is name
                    $m->person_id_sms = Person::where('name', $manager['sms'])->first()->id;
                }
                if (is_numeric($manager['quality'][0])) {
                    $m->person_id_quality = Person::where('cpf', $manager['quality'])->first()->id;
                } else {
                    $m->person_id_quality = Person::where('name', $manager['quality'])->first()->id;
                }
                if (is_numeric($manager['discipline'][0])) {
                    $m->person_id_discipline = Person::where('cpf', $manager['discipline'])->first()->id;
                } else {
                    $m->person_id_discipline = Person::where('name', $manager['discipline'])->first()->id;
                }
                if (is_numeric($manager['production'][0])) {
                    $m->person_id_production = Person::where('cpf', $manager['production'])->first()->id;
                } else {
                    $m->person_id_production = Person::where('name', $manager['production'])->first()->id;
                }
                $m->save();
            }
        }
        return $request->managers;
    }

    public function updateVacancyExamsAndTrainings($vacancy, $inputExams, $inputTrainings)
    {
        //update exams
        $vacancyExams = VacancyExam::where('vacancy_id', $vacancy->id)->get();
        $dbExams = array();
        foreach ($vacancyExams as $ve) {
            array_push($dbExams, $ve->exam_id);
        }
        $examsToDelete = array_diff($dbExams, $inputExams);
        $examsToInclude = array_diff($inputExams, $dbExams);
        foreach ($examsToDelete as $examId) {
            $ve = VacancyExam::where('exam_id', $examId)->where('vacancy_id', $vacancy->id)->first();
            $ve->delete();
        }
        foreach ($examsToInclude as $examId) {
            $ve = new VacancyExam;
            $ve->vacancy_id = $vacancy->id;
            $ve->exam_id = $examId;
            $ve->save();
        }

        //update trainings
        $vacancyTrainings = VacancyTraining::where('vacancy_id', $vacancy->id)->get();
        $dbTrainings = array();
        foreach ($vacancyTrainings as $vt) {
            array_push($dbTrainings, $vt->training_id);
        }
        $trainingsToDelete = array_diff($dbTrainings, $inputTrainings);
        $trainingsToInclude = array_diff($inputTrainings, $dbTrainings);
        foreach ($trainingsToDelete as $trainingId) {
            $vt = VacancyTraining::where('training_id', $trainingId)->where('vacancy_id', $vacancy->id)->first();
            $vt->delete();
        }
        foreach ($trainingsToInclude as $trainingId) {
            $vt = new VacancyTraining;
            $vt->vacancy_id = $vacancy->id;
            $vt->training_id = $trainingId;
            $vt->save();
        }
    }

    /**
     * Alternates the construction status between active and terminated.
     * GET: /constructions/:id/changestatus
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $construction = Construction::find($request->id);
        switch ($construction->status) {
            case 1:
                $construction->status = 0;
                break;
            case 0:
                $construction->status = 1;
                break;
            default:
                $construction->status == 1;
                break;
        }
        $construction->save();
        return response()->json(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /constructions/:id
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Construction $construction)
    {
        $construction = Construction::findOrFail($construction->id);
        $construction->delete();
        return response()->json(null, 204);
    }
}
