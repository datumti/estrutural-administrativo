<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Job;
use App\Models\GroupPerson;
use App\Models\Fsa;
use App\Models\Team;
use App\Models\Manager;
use App\Models\Group;
use App\Models\JobTraining;
use App\Models\Resignation;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Construction;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /people
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $peoples = Person::all();

        return view('persons.list', compact('peoples'));
    }


    public function create() {

        $jobs = Job::pluck('name', 'id');
        $jobs->prepend('Selecione', 0);
        $profiles = Profile::pluck('name', 'id');
        $profiles->prepend('Selecione', 0);
        return view('persons.create', compact('jobs', 'profiles'));
    }


    public function edit($id)
    {
        $people = Person::find($id);
        $jobs = Job::pluck('name', 'id');
        $jobs->prepend('Selecione', 0);
        $profiles = Profile::pluck('name', 'id');
        $profiles->prepend('Selecione', 0);

        $constructions = Construction::has('group.group_person')
            ->with(['group.group_person' => function($query) use ($id) {
                $query->where('group_person.person_id', $id);
            }])
            ->get();
            //dd($constructions);

       /*  $groups['tecnica'] = GroupPerson::where('person_id', $id)
            ->join('groups', 'groups.id', '=', 'group_person.group_id')
            ->join('processes', 'processes.id', '=', 'groups.process_id')
            ->with('group.construction.contract')
            ->where('processes.id', 1)
            ->get();

        $groups['psicologica'] = GroupPerson::where('person_id', $id)
            ->join('groups', 'groups.id', '=', 'group_person.group_id')
            ->join('processes', 'processes.id', '=', 'groups.process_id')
            ->with('group.construction.contract')
            ->where('processes.id', 2)
            ->get();

        $groups['treinamento'] = GroupPerson::where('person_id', $id)
            ->join('groups', 'groups.id', '=', 'group_person.group_id')
            ->join('processes', 'processes.id', '=', 'groups.process_id')
            ->with('group.construction.contract')
            ->where('processes.id', 4)
            ->get();

        $groups['exame'] = GroupPerson::where('person_id', $id)
            ->join('groups', 'groups.id', '=', 'group_person.group_id')
            ->join('processes', 'processes.id', '=', 'groups.process_id')
            ->with('group.construction.contract')
            ->where('processes.id', 5)
            ->get(); */

        return view('persons.edit', compact('people', 'jobs', 'profiles', 'constructions'));
    }

    public function getbycpf() {

        $person = Person::where('cpf', request()->cpf)->first();
        if ($person) {
            return response()->json($person, 200);
        }
        return response()->json(null, 204);
    }

    /**
     * Display a listing of the resource.
     * POST: /people/login
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $person = Person::where('email', $request->email)->where('password', $request->password)->first();
        if ($person != null) {
            return response()->json($person, 200);
        }
        else {
            return response()->json(null, 204);
        }
    }

    /**
     * Display a listing of the resource and all it's selective process statuses.
     * GET: /people/overview/construction/:id
     * @param  int  $constructionId
     * @return \Illuminate\Http\Response
     */
    public function overview($constructionId)
    {
        $employees = $this->employees($constructionId);
        $candidates = $this->candidates($constructionId);
        $dismissed = $this->dismissed($constructionId);
        $transfered = $this->transfered($constructionId);
        $resignationFirstStep = $this->resignationFirstStep($constructionId);
        $resignationSecondStep = $this->resignationSecondStep($constructionId);
        $resignationThirdStep = $this->resignationThirdStep($constructionId);
        $this->setOverviewStatus($employees, $constructionId);
        $this->setOverviewStatus($candidates, $constructionId);
        return response()->json([
            'candidates' => $candidates,
            'employees' => $employees,
            'dismissed' => $dismissed,
            'resignationFirstStep' => $resignationFirstStep,
            'resignationSecondStep' => $resignationSecondStep,
            'resignationThirdStep' => $resignationThirdStep,
            'transfered' => $transfered
        ], 200);
    }

    /**
     * Attaches the group statuses to the person.
     * @param \App\Person $person
     */
    public function setOverviewStatus($employees, $constructionId)
    {
        $groupsTechPsico = Group::select('id')->where('construction_id', $constructionId)->whereIn('process_id', [1, 2])->pluck('id');
        $groupsTrainings = Group::select('id')->where('construction_id', $constructionId)->where('process_id', 3)->pluck('id');
        $groupsExams = Group::select('id')->where('construction_id', $constructionId)->where('process_id', 4)->pluck('id');
        $groupsBadges = Group::select('id')->where('construction_id', $constructionId)->where('process_id', 5)->pluck('id');

        foreach ($employees as $employee) {
            $groupPeople = GroupPerson::whereIn('group_id', $groupsTechPsico)->where('person_id', $employee->id)->pluck('status_id');
            if (count($groupPeople) != 0) {
                $employee->status_techpsico = 1;
                if (in_array(null, $groupPeople->toArray())) $employee->status_techpsico = null;
                if (in_array(2, $groupPeople->toArray())) $employee->status_techpsico = 2;
            } else {
                $employee->status_techpsico = null;
            }

            $groupPeople = GroupPerson::whereIn('group_id', $groupsTrainings)->where('person_id', $employee->id)->pluck('status_id');
            if (count($groupPeople) != 0) {
                $employee->status_trainings = 1;
                if (in_array(null, $groupPeople->toArray())) $employee->status_trainings = null;
                if (in_array(2, $groupPeople->toArray())) $employee->status_trainings = 2;
            } else {
                $employee->status_trainings = null;
            }

            $groupPeople = GroupPerson::whereIn('group_id', $groupsExams)->where('person_id', $employee->id)->pluck('status_id');
            if (count($groupPeople) != 0) {
                $employee->status_exams = 1;
                if (in_array(null, $groupPeople->toArray())) $employee->status_exams = null;
                if (in_array(2, $groupPeople->toArray())) $employee->status_exams = 2;
            } else {
                $employee->status_exams = null;
            }

            $groupPeople = GroupPerson::whereIn('group_id', $groupsBadges)->where('person_id', $employee->id)->pluck('status_id');
            if (count($groupPeople) != 0) {
                $employee->status_badges = 1;
                if (in_array(null, $groupPeople->toArray())) $employee->status_badges = null;
                if (in_array(5, $groupPeople->toArray())) $employee->status_badges = 5;
                if (in_array(2, $groupPeople->toArray())) $employee->status_badges = 2;
            } else {
                $employee->status_badges = null;
            }
        }
    }

    /**
     * Display a listing of employees by a given construction for the first step of resignation.
     * @param  int  $constructionId
     * @return \App\Person
     */
    public function resignationFirstStep($constructionId)
    {
        $resignations = Resignation::where('construction_id', $constructionId)->pluck('person_id')->toArray();

        $people = Person::join('groups', 'group_person.group_id', '=', 'groups.id')
            ->join('people', 'group_person.person_id', '=', 'people.id')
            ->select('people.*')
            ->from('group_person')
            ->where('groups.process_id', 5)
            ->where('groups.construction_id', $constructionId)
            ->where('group_person.status_id', 1)
            ->whereNotIn('people.id', $resignations)
            ->get();

        foreach ($people as $p) {
            $p->job;
        }

        return $people;
    }

    /**
     * Display a listing of employees by a given construction for the second step of resignation.
     * @param  int  $constructionId
     * @return \App\Person
     */
    public function resignationSecondStep($constructionId)
    {
        $resignations = Resignation::where('construction_id', $constructionId)->whereNull('fired')->whereNull('transfered')->get();
        foreach ($resignations as $r) {
            $r->person;
            if ($r->person->job_id != null) $r->person->job;
        }

        return $resignations;
    }

    /**
     * Display a listing of employees by a given construction for the third step of resignation.
     * @param  int  $constructionId
     * @return \App\Person
     */
    public function resignationThirdStep($constructionId)
    {
        $resignations = Resignation::where('construction_id', $constructionId)->where('fired', 0)->get();
        foreach ($resignations as $r) {
            $r->person;
            if ($r->person->job_id != null) $r->person->job;
        }

        return $resignations;
    }

    /**
     * Display a listing of employees by a given construction.
     * GET: /people/employees/construction/:id
     * @param  int  $constructionId
     * @return \App\Person
     */
    public function employees($constructionId)
    {
        $dismissed = Resignation::where('construction_id', $constructionId)->where('fired', 1)->pluck('person_id');
        $transfered = Resignation::where('construction_id', $constructionId)->where('transfered', 1)->pluck('person_id');
        $people = Person::join('groups', 'group_person.group_id', '=', 'groups.id')
            ->join('people', 'group_person.person_id', '=', 'people.id')
            ->select('people.*')
            ->from('group_person')
            ->where('groups.process_id', 5)
            ->where('groups.construction_id', $constructionId)
            ->where('group_person.status_id', 1)
            ->whereNotIn('people.id', $dismissed)
            ->whereNotIn('people.id', $transfered)
            ->orderBy('name', 'asc')
            ->get();

        foreach ($people as $p) {
            if ($p->job_id != null) $p->job;
        }
        return $people;
    }

    /**
     * Display a listing of dismissed employees by a given construction.
     * GET: /people/employees/construction/:id
     * @param  int  $constructionId
     * @return \App\Person
     */
    public function dismissed($constructionId)
    {
        $people = array();
        // $people = Person::orderBy('name', 'asc')->get();
        $resignations = Resignation::where('construction_id', $constructionId)->where('fired', 1)->get();
        foreach ($resignations as $r) {
            $r->person;
            if ($r->person->job_id != null) $r->person->job;
            array_push($people, $r->person);
        }
        return $people;
    }

    /**
     * Display a listing of transfered employees by a given construction.
     * GET: /people/employees/construction/:id
     * @param  int  $constructionId
     * @return \App\Person
     */
    public function transfered($constructionId)
    {
        $people = array();
        // $people = Person::orderBy('name', 'asc')->get();
        $resignations = Resignation::where('construction_id', $constructionId)->where('transfered', 1)->get();
        foreach ($resignations as $r) {
            $r->person;
            if ($r->person->job_id != null) $r->person->job;
            array_push($people, $r->person);
        }
        return $people;
    }

    /**
     * Display a listing of candidates by a given construction.
     * GET: /people/overview/construction/:id
     * @param  int  $constructionId
     * @return \Illuminate\Http\Response
     */
    public function candidates($constructionId)
    {
        $employees = $this->employees($constructionId)->pluck('id');
        $people = Person::join('groups', 'group_person.group_id', '=', 'groups.id')
            ->join('people', 'group_person.person_id', '=', 'people.id')
            ->select('people.*')
            ->from('group_person')
            ->where('groups.process_id', '!=', 5)
            ->where('groups.construction_id', $constructionId)
            ->whereNotIn('people.id', $employees)
            ->groupBy('people.id')
            ->get();
        $people = Person::orderBy('name', 'asc')->get();

        foreach ($people as $p) {
            $p->job;
        }

        return $people;
    }

    public function populate($id)
    {
        $person = Person::find($id);
        $person->job;
        $person->profile;
        $jobs = Job::all();
        $profiles = Profile::all();
        $gpController = new GroupPersonController;
        $attachmentsArray = array();
        $groupPeople = GroupPerson::where('person_id', $id)->get();
        foreach ($groupPeople as $gp) {
            $gp->group;
            $gp->status;
            $gp->group->construction;
            $gp->group->process;
            $attachments = $gpController->searchAttachments($gp->group_id, $id);
            foreach ($attachments->original as $key => $att) {
                array_push($attachmentsArray, ['file' => $key, 'group' => $gp->group_id]);
            }
        }
        $resources = array(
            'person' => $person,
            'jobs' => $jobs,
            'evaluation' => $groupPeople,
            'attachments' => $attachmentsArray,
            'profiles' => $profiles
        );
        return response()->json($resources, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /people
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'job' => 'required|gt:0',
            'profile' => 'required|gt:0',
            'email' => 'required|email|unique:people',
        ]);

        $person = new Person;
        $person->name = $request->name;
        $person->cpf = $request->cpf;
        $person->job_id = $request->job;
        $person->ctps = $request->ctps;
        $person->rg = $request->rg;
        $person->phoneMobile = $request->phone_mobile;
        $person->mobileAlternative = $request->mobile_alternative;
        $request->birthDate = $request->birthDate;
        $person->pcd = $request->pcd;
        $person->motherName = $request->mother_name;
        $person->address = $request->address;
        $person->addressNumber = $request->address_number;
        $person->addressExtra = $request->address_extra;
        $person->neighborhood = $request->neighborhood;
        $person->city = $request->city;
        $person->states = $request->state;
        $person->cep = $request->cep;
        $person->bootNumber = $request->boot_number;
        $person->pantsNumber = $request->pants_number;
        $person->shirtNumber = $request->shirt_number;
        $person->markNumber = $request->mark_number;
        $person->number = $request->number;
        $person->email = $request->email;
        if ($request->password != null && $request->password != '') $person->password = $request->password;
        $person->profile_id = $request->profile;

        if ($person->save()) {
            $this->addFlash('Pessoa criada com sucesso!', 'success');
            return redirect()->back();
        } else {
            $this->addFlash('Erro!', 'warning');
            return redirect()->back()->withInputs();
        }


    }

    /**
     * Display the specified resource.
     * GET: /people/:id
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        $person = Person::find($person->id);
        $person->job;
        return response()->json($person, 200);
    }

    /**
     * Display the specified resource by cpf.
     * GET: /people/cpf/:cpf
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function showByCpf($constructionId, $cpf, $process)
    {
        $person = Person::where('cpf', $cpf)->first();
        if ($person != null) {
            $groupPeople = GroupPerson::where('person_id', $person->id)->get();
            $isInGroup = false;
            if (count($groupPeople) != 0) {
                foreach ($groupPeople as $gp) {
                    if ($gp->group->process_id == $process && $gp->group->construction_id == $constructionId) $isInGroup = true;
                }
            }
            $person->isInGroup = $isInGroup;
            $person->job;
        }
        return response()->json($person, 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT: /people/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'job' => 'required|gt:0',
            'profile' => 'required|gt:0',
            'email' => 'required|email',
        ]);

        $person = Person::find($id);
        $person->name = $request->name;
        $person->cpf = $request->cpf;
        $person->job_id = $request->job;
        $person->ctps = $request->ctps;
        $person->rg = $request->rg;
        $person->phoneMobile = $request->phone_mobile;
        $person->mobileAlternative = $request->mobile_alternative;
        $request->birthDate = $request->birthDate;
        $person->pcd = $request->pcd;
        $person->motherName = $request->mother_name;
        $person->address = $request->address;
        $person->addressNumber = $request->address_number;
        $person->addressExtra = $request->address_extra;
        $person->neighborhood = $request->neighborhood;
        $person->city = $request->city;
        $person->states = $request->state;
        $person->cep = $request->cep;
        $person->bootNumber = $request->boot_number;
        $person->pantsNumber = $request->pants_number;
        $person->shirtNumber = $request->shirt_number;
        $person->markNumber = $request->mark_number;
        $person->number = $request->number;
        $person->email = $request->email;
        $person->journey = $request->journey;
        if ($request->password != null && $request->password != '') {
            $person->password = $request->password;
        }
        $person->profile_id = $request->profile;

        if ($person->save()) {
            $this->addFlash('Pessoa alterada com sucesso!', 'success');
            return redirect()->back();
        } else {
            $this->addFlash('Erro!', 'warning');
            return redirect()->back()->withInputs();
        }

    }


    /**
     * Remove the specified resource from storage.
     * DELETE: /people/:id
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person = Person::findOrFail($person->id);

        $fsas = Fsa::where('person_id', $person->id)->get();
        foreach ($fsas as $fsa) $fsa->delete();

        $groupPeople = GroupPerson::where('person_id', $person->id)->get();
        foreach ($groupPeople as $gp) $gp->delete();

        $teams = Team::where('person_id', $person->id)->get();
        foreach ($teams as $t) $t->delete();

        $managersSms = Manager::where('person_id_sms', $person->id)->get();
        $managersQual = Manager::where('person_id_quality', $person->id)->get();
        $managersProd = Manager::where('person_id_production', $person->id)->get();
        $managersDisc = Manager::where('person_id_discipline', $person->id)->get();

        foreach ($managersSms as $m) {
            $m->person_id_sms = null;
            $m->save();
        }
        foreach ($managersQual as $m) {
            $m->person_id_quality = null;
            $m->save();
        }
        foreach ($managersProd as $m) {
            $m->person_id_production = null;
            $m->save();
        }
        foreach ($managersDisc as $m) {
            $m->person_id_discipline = null;
            $m->save();
        }

        $person->delete();
        return response()->json(null, 204);
    }

    /**
     * Display a listing of the resource based on job X Training.
     * GET: /people/suggestions/trainings
     * @return \Illuminate\Http\Response
     */
   /**blic function suggestionsTraining($trainingId)
    {
        $people = Person::select('people.*')
            ->join('job_trainings', 'job_trainings.job_id', '=', 'people.job_id')
            ->where('job_trainings.training_id', $trainingId)
            ->orderBy('name', 'asc')
            ->get();
        foreach ($people as $p) $p->job;
        return response()->json($people, 200);
    }*/

    /**
     * Display a listing of the resource based on job X people X Training.
     * GET: /people/suggestions/trainings
     * @return \Illuminate\Http\Response
     */
    public function suggestionsBadge($constructionId)
    {
        $groups = Group::where('process_id', 3)->where('construction_id', $constructionId)->get();
        $groupIds = array();
        foreach ($groups as $g) array_push($groupIds, $g->id);
        $groupPeople = GroupPerson::select('group_person.*')
            ->join('groups', 'group_person.group_id', '=', 'groups.id')
            ->where('groups.process_id', 3)
            ->whereIn('group_person.group_id', $groupIds)
            ->orderBy('name', 'asc')
            ->get();
        $people = array();
        foreach ($groupPeople as $gp) {
            $gp->group->training;
            $gp->person;
            $gp->status;
            $people[$gp->person_id]['job'] = $gp->person->job_id;
            $people[$gp->person_id]['trainings_done'] = [];
            $people[$gp->person_id]['trainings_required'] = [];
        }
        foreach ($groupPeople as $gp) {
            array_push($people[$gp->person_id]['trainings_done'], $gp->group->training->id);
            $jobTrainings = JobTraining::where('job_id', $gp->person->job_id)->get();
            foreach ($jobTrainings as $jt) array_push($people[$gp->person_id]['trainings_required'], $jt->training_id);
            $people[$gp->person_id]['trainings_done'] = array_values(array_unique($people[$gp->person_id]['trainings_done']));
            $people[$gp->person_id]['trainings_required'] = array_values(array_unique($people[$gp->person_id]['trainings_required']));
        }
        $suggestions = array();
        foreach ($people as $key => $p) {
            $diff = array_diff($p['trainings_required'], $p['trainings_done']);
            if ($diff == null && $diff != '') {
                $suggestion = Person::find($key);
                array_push($suggestions, $suggestion);
            }
        }
        foreach ($suggestions as $p) $p->job;
        return response()->json($suggestions, 200);
    }

}
