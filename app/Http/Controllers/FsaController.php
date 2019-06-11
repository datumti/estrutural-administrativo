<?php

namespace App\Http\Controllers;

use App\Models\Fsa;
use App\Models\Person;
use App\Models\Job;
use App\Models\GroupPerson;
use App\Models\Group;
use Illuminate\Http\Request;

class FsaController extends Controller
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

    public function populate($id)
    {
        $person = Person::find($id);
        $person->job;
        $fsa = Fsa::where('person_id', $id)->first();
        $jobs = Job::all();

        $resources = array('person' => $person, 'jobs' => $jobs, 'fsa' => $fsa);
        return response()->json($resources, 200);
    }


    /**
     * Display a listing of group_person by construction id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEligiblePeople($id)
    {
        $groups = Group::where('construction_id', $id)->whereIn('process_id', [1, 2])->get();
        $groupIds = array();
        foreach ($groups as $g) array_push($groupIds, $g->id);
        $gp = GroupPerson::whereIn('group_id', $groupIds)->get();
        $people = array();
        $peopleIdsToRemove = array();
        foreach ($gp as $groupperson) {
            $groupperson->group;
            $groupperson->person;
            $groupperson->status;
            if ($groupperson->status_id == 2 || $groupperson->status_id == 4) array_push($peopleIdsToRemove, $groupperson->person_id);
            if (array_key_exists($groupperson->person_id, $people)) {
                if ($people[$groupperson->person_id]->status != $groupperson->status_id) {
                    $people[$groupperson->person_id]->status = 3;
                }
            } else {
                $groupperson->person->status = $groupperson->status_id;
                $people[$groupperson->person_id] = $groupperson->person;
            }
        }
        foreach ($peopleIdsToRemove as $id) unset($people[$id]);
        //checks if the person has both tech and psico tests
        foreach ($people as $person) {
            $groupPeople = GroupPerson::whereIn('group_id', $groupIds)->where('person_id', $person->id)->where('status_id', '!=', 2)->where('status_id', '!=', 4)->get();
            $gpIds = array();
            foreach ($groupPeople as $gp) array_push($gpIds, $gp->group_id);
            $groups = Group::whereIn('id', $gpIds)->get();
            if (count($groups) != 2) unset($people[$person->id]);
            $person->job;
        }
        $people = array_merge($people); // reset indexes

        // set status based on FSA approval
        foreach ($people as $person) {
            $fsa = Fsa::where('person_id', $person->id)->first();
            if ($fsa == null) {
                $person->status = 3;
            }
            else {
                if ($fsa->quality_opinion === '1' && $fsa->admin_opinion === '1' && $fsa->manager_opinion === '1') $person->status = 1;
                if ($fsa->quality_opinion === null || $fsa->admin_opinion === null || $fsa->manager_opinion === null) $person->status = 3;
                if ($fsa->quality_opinion === '0' || $fsa->admin_opinion === '0' || $fsa->manager_opinion === '0') $person->status = 2;
            }
        }

        return response()->json($people, 200);
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

    /**
     * Display the specified resource by Person Id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fsa = Fsa::where('person_id', $id);
        return response()->json($fsa, 200);
    }

    /**
     * Update the specified resource in storage by Person Id.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $personId)
    {
        $fsa = Fsa::where('person_id', $personId)->first();
        if ($fsa != null) {
            //existing fsa
            $fsa->fill($request->all());
            $fsa->save();
        } else {
            //new fsa
            $fsa = Fsa::create($request->all());
            $fsa->person_id = $personId;
            $fsa->save();
        }

        $person = Person::findOrFail($personId);
        $person['job_id'] = $request->person['job'];
        $person['ctps'] = $request->person['ctps'];
        $person['rg'] = $request->person['rg'];
        $person['phoneMobile'] = $request->person['phoneMobile'];
        $person['mobileAlternative'] = $request->person['mobileAlternative'];
        $person['birthDate'] = explode("T", $request->person['birthDate'])[0];
        $person['pcd'] = $request->person['pcd'];
        $person['motherName'] = $request->person['motherName'];
        $person['address'] = $request->person['address'];
        $person['addressNumber'] = $request->person['addressNumber'];
        $person['addressExtra'] = $request->person['addressExtra'];
        $person['neighborhood'] = $request->person['neighborhood'];
        $person['city'] = $request->person['city'];
        $person['states'] = $request->person['states'];
        $person['cep'] = $request->person['cep'];
        $person['bootNumber'] = $request->person['bootNumber'];
        $person['pantsNumber'] = $request->person['pantsNumber'];
        $person['shirtNumber'] = $request->person['shirtNumber'];
        $person['markNumber'] = $request->person['markNumber'];
        $person->save();
        return response()->json($fsa, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fsa  $fsa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fsa $fsa)
    {
        $fsa = Job::findOrFail($fsa->id);
        $jfsaob->delete();
        return response()->json(null, 204);
    }

    function getDuplicates($array)
    {
        return array_merge(array_unique(array_diff_assoc($array, array_unique($array))));
    }
}
