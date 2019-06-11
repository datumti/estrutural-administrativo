<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupPerson;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /groups
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return response()->json($groups, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /groups
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = Group::create($request->all());
        $group->creation_date = explode("T", $request->creation_date)[0];
        return response()->json($group, 201);
    }

    /**
     * Display the specified resource.
     * GET: /groups/:id
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $group = Group::find($group->id);
        $gp = GroupPerson::where('group_id', $group->id)->get();
        $gpController = new GroupPersonController();
        foreach ($gp as $p) {
            $attachments = $gpController->searchAttachments($group->id, $p->person_id);
            $p->attachments = $attachments->original;
            $p->person;
            if ($p->person->job_id != null) {
                $p->person->job;
            }
            
        }
        $group->groupPeople = $gp;
        return response()->json($group, 200);
    }

    /**
     * Display the specified resource.
     * GET: /groups/construction/:c/process/:p
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function findByConstruction($c, $p)
    {
        $groups = Group::where('construction_id', $c)->where('process_id', $p)->get();
        return response()->json($groups, 200);
    }


    /**
     * Find GroupPerson by group array.
     * POST: /groups
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findPeopleByGroups(Request $request)
    {
        $groups = $request->input();
        $groupsGps = array();
        foreach ($groups as $g) {
            $g['groupPeople'] = GroupPerson::where('group_id', $g['id'])->get();
            array_push($groupsGps, $g);
        }
        return $groupsGps;
    }

    /**
     * Update the specified resource in storage.
     * PUT: /groups/:id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $groupPeople = $request->input()[1];
        $g = Group::findOrFail($group->id);
        $g->name = $request[0]['name'];
        if (isset($request[0]['creation_date'])) $g->creation_date = explode("T", $request[0]['creation_date'])[0];
        if (isset($request[0]['training_id'])) $g->training_id = $request[0]['training_id'];
        if (isset($request[0]['clinic_name'])) $g->clinic_name = $request[0]['clinic_name'];
        if (isset($request[0]['clinic_code'])) $g->clinic_code = $request[0]['clinic_code'];
        if (isset($request[0]['crm'])) $g->crm = $request[0]['crm'];
        $g->save();

        //deletes any removed GPs
        $dbGps = GroupPerson::where('group_id', $group->id)->get();
        $dbGpIds = array();
        $inputGpIds = array();
        foreach ($dbGps as $dbGp) {
            array_push($dbGpIds, $dbGp->id);
        }
        foreach ($groupPeople as $inputGp) {
            if ($inputGp['id'] != null) array_push($inputGpIds, $inputGp['id']);
        }
        $gpToDelete = array_diff($dbGpIds, $inputGpIds);
        foreach ($gpToDelete as $gotd) {
            $gp = GroupPerson::find($gotd);
            $gp->delete();
        }

        foreach ($groupPeople as $gp) {
            if ($gp['id'] != null) {
                //update groupPerson
                $existingGp = GroupPerson::findOrFail($gp['id']);
                $existingGp->status_id = $gp['status_id'];
                if (isset($gp['status_aso'])) $existingGp->status_aso_id = $gp['status_aso'];
                $existingGp->description = $gp['description'];
                $existingGp->note = $gp['note'];
                $existingGp->save();
                // input attachments
                foreach ($gp['attachments'] as $att) {
                    $baseStr = $att['value'];
                    $path = storage_path() . '/app/public/groups/' . $group->id . '/people/' . $gp['person_id'];
                    $this->uploadFile($baseStr, $path, $att['filename']);
                }
            } else {
                //new groupPerson
                $newGp = new GroupPerson;
                $newGp->group_id = $group->id;
                $newGp->status_id = $gp['status_id'];
                $newGp->description = $gp['description'];
                $newGp->note = $gp['note'];
                if (isset($gp['status_aso'])) $newGp->status_aso_id = $gp['status_aso'];
                //get person id or create a new one
                $p = Person::where('cpf', $gp['person_cpf'])->first();
                if ($p == null) {
                    $p = new Person;
                    $p->name = $gp['person_name'];
                    $p->cpf = $gp['person_cpf'];
                    $p->job_id = null;
                    $p->save();
                }
                $newGp->person_id = $p->id;
                $newGp->save();
                // input attachments
                foreach ($gp['attachments'] as $att) {
                    $baseStr = $att['value'];
                    $path = storage_path() . '/app/public/groups/' . $group->id . '/people/' . $newGp->person_id;
                    $this->uploadFile($baseStr, $path, $att['filename']);
                }
            }
        }
        return response()->json($request->input(), 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE: /groups/:id
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group = Group::findOrFail($group->id);
        $groupPeople = GroupPerson::where('group_id', $group->id)->get();
        foreach ($groupPeople as $gp) {
            $gp->delete();
        }
        $group->delete();
        return response()->json(null, 204);
    }

    public function uploadFile($base64_string, $path, $filename)
    {
        // makes sure folder exists
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $ifp = fopen($path . '/' . $filename, 'wb'); 
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode(',', $base64_string);
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
        return $path;
    }

    /**
     * Remove the specified resource from storage.
     * GET: /groups/populate/construction/:id/process/:p
     * @return \Illuminate\Http\Response
     */
    public function populateSelectionProcess($constructionId)
    {
        $groups = Group::where('construction_id', $constructionId)->get();
        $groups = Group::orderBy('name', 'asc')->get();
        $groupsGps = array();
        $response = [
            'tech' => [],
            'psico' => [],
            'training' => [],
            'exam' => [],
            'badge' => []
        ];
        foreach ($groups as $g) {
            $g['groupPeople'] = GroupPerson::where('group_id', $g->id)->get();
            switch ($g->process_id) {
                case 1:
                    array_push($response['tech'], $g);
                    break;
                case 2:
                    array_push($response['psico'], $g);
                    break;
                case 3:
                    array_push($response['training'], $g);
                    break;
                case 4:
                    array_push($response['exam'], $g);
                    break;
                case 5:
                    array_push($response['badge'], $g);
                    break;
                default:
                    break;
            }
        }
        return response()->json($response, 200);
    }
}
