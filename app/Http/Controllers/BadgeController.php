<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Exam;
use App\Models\BadgeExam;
use App\Models\BadgeTraining;
use App\Models\Group;
use App\Models\GroupPerson;
use App\Models\Person;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of people by construction id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEligiblePeople($id)
    {
        $eligiblePeople = array();

        $badgeExams = BadgeExam::where('construction_id', $id)->get();
        $mandatoryExamIds = array();
        foreach ($badgeExams as $be) array_push($mandatoryExamIds, $be->exam_id);

        $badgeTrainings = BadgeTraining::where('construction_id', $id)->get();
        $mandatoryTrainingIds = array();
        foreach ($badgeTrainings as $bt) array_push($mandatoryTrainingIds, $bt->training_id);

        $groups = Group::where('construction_id', $id)->whereIn('process_id', [3,4])->get();
        $groupIds = array();
        foreach ($groups as $g) array_push($groupIds, $g->id);
        
        $groupPeople = GroupPerson::whereIn('group_id', $groupIds)->where('status_id', '!=', 2)->get();
        $people = array();

        foreach ($groupPeople as $gp) $people[$gp->person_id] = ['trainings' => [], 'exams' => [] ];

        foreach ($groupPeople as $gp) {
            $group = Group::find($gp->group_id);
            if ($group->process_id == 3) array_push($people[$gp->person_id]['trainings'], $group->training_id);
            if ($group->process_id == 4) array_push($people[$gp->person_id]['exams'], $group->exam_id);
        }

        $eligiblePeopleIds = array();
        foreach ($people as $p_id => $p) {
            $hasAllTrainings = false;
            $hasAllExams = false;
            if (count( array_diff($mandatoryExamIds, $p['exams']) ) == 0) $hasAllExams = true;
            if (count( array_diff($mandatoryTrainingIds, $p['trainings']) ) == 0) $hasAllTrainings = true;
            if ($hasAllExams && $hasAllTrainings) array_push($eligiblePeopleIds, $p_id);
        }

        foreach ($eligiblePeopleIds as $id) {
            $person = Person::find($id);
            array_push($eligiblePeople, $person);
        }
        
        return response()->json($eligiblePeople, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function populate($id)
    {
        $exams = Exam::all();
        $trainings = Training::all();
        $exams = Exam::orderBy('name', 'asc')->get();
        $trainings = Training::orderBy('name', 'asc')->get();
        $badgeExams = BadgeExam::where('construction_id', $id)->get();
        $badgeExamsId = array();
        foreach ($badgeExams as $be) {
            array_push($badgeExamsId, $be->exam_id);
        }
        $badgeTrainings = BadgeTraining::where('construction_id', $id)->get();
        $badgeTrainingsId = array();
        foreach ($badgeTrainings as $bt) {
            array_push($badgeTrainingsId, $bt->training_id);
        }
        $resources = array('exams' => $exams, 'trainings' => $trainings, 'badgeExams' => $badgeExamsId, 'badgeTrainings' => $badgeTrainingsId);
        return response()->json($resources, 200);
    }

    /**
     * Display badge_exams and badge_trainings by construction id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $badgeExams = BadgeExam::where('construction_id', $id)->get();
        foreach ($badgeExams as $be) {
            $be->exam;
            $be->construction;
        }
        $badgeTrainings = BadgeTraining::where('construction_id', $id)->get();
        foreach ($badgeTrainings as $bt) {
            $bt->training;
            $bt->construction;
        }
        return array('badgeexams' => $badgeExams, 'badgetrainings' => $badgeTrainings);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
