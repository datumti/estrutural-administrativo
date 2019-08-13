<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupPerson;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\PeopleDocument;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /groups
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::awhere('construction_id', Session::get('construction')->id)->get();
        return response()->json($groups, 200);
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'creation_date' => 'required'
        ]);

        $data = $request->all();

        $data['creation_date'] = Carbon::createFromFormat('d/m/Y', $data['creation_date'])->format('Y-m-d');

        //cria o grupo
        $group = new Group();
        $group->name = $data['name'];
        $group->creation_date = $data['creation_date'];
        $group->construction_id = Session::get('construction')->id;
        $group->process_id = $data['process_id'];
        $group->save();

        //cria ou atualiza a pessoa
        if($data['cpf'] != '') {
            $person = Person::firstOrNew(['id' => $data['person_id']]);
            $person->cpf = $data['cpf'];
            $person->name = $data['fullName'];
            $person->job_id = $data['job'];
            $person->save();

            //insere a pessoa no grupo
            $groupPerson = new GroupPerson();
            $groupPerson->group_id = $group->id;
            $groupPerson->person_id = $person->id;
            $groupPerson->status_id = $data['status'];
            if($data['note'] != '')
                $groupPerson->note = str_replace(',', '.', $data['note']);
            if($data['status'] == 3 || $data['status'] == 4)
                $groupPerson->description = $data['description'];

            if ($request->hasFile('files')) {
                $files = $request->file('files');
                foreach ($files as $file) {
                    $filepath = $file->storeAs('/public/documents/'.$person->id.'/'.$group->construction_id, trim($file->getClientOriginalName()));
                    PeopleDocument::create([
                        'people_id' => $person->id,
                        'construction_id' => $group->construction_id,
                        'filename' => trim($file->getClientOriginalName()),
                        'filepath' => $filepath
                    ]);
                }
            }

            if($groupPerson->save()) {
                $this->addFlash('Grupo criado e candidato cadastrado com sucesso!', 'success');
            }
        } else {
            $this->addFlash('Grupo cadastrado com sucesso!', 'success');
        }

        return redirect('processo-seletivo/'.$request->process_id.'/grupos/'.$group->id.'/edit');
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

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'creation_date' => 'required'
        ]);

        $data = $request->all();
        $data['creation_date'] = Carbon::createFromFormat('d/m/Y', $data['creation_date'])->format('Y-m-d');

        //busca o grupo
        $group = Group::find($id);

        $group->name = $data['name'];
        $group->creation_date = $data['creation_date'];
        $group->save();

        //cria ou atualiza a pessoa
        if(request()->get('cpf') != '') {

            $person = Person::firstOrNew(['id' => $data['person_id']]);
            $person->name = $data['fullName'];
            $person->job_id = $data['job'];

            if($data['cpf'] != '')
                $person->cpf = $data['cpf'];

            $person->save();

            //insere a pessoa no grupo
            $groupPerson = GroupPerson::firstOrNew(['id' => $data['group_person_id']]);
            $groupPerson->group_id = $group->id;
            $groupPerson->person_id = $person->id;
            $groupPerson->status_id = $data['status'];

            if($data['note'] != '')
                $groupPerson->note = str_replace(',', '.', $data['note']);
            if($data['status'] == 3 || $data['status'] == 4)
                $groupPerson->description = $data['description'];

            $groupPerson->save();

            if ($request->hasFile('files')) {
                $files = $request->file('files');
                foreach ($files as $file) {
                    $filepath = $file->storeAs('/public/documents/'.$person->id.'/'.$group->construction_id, trim($file->getClientOriginalName()));
                    PeopleDocument::create([
                        'people_id' => $person->id,
                        'construction_id' => $group->construction_id,
                        'filename' => trim($file->getClientOriginalName()),
                        'filepath' => $filepath
                    ]);
                }
            }
        }

        $this->addFlash('Grupo atualizado com sucesso!', 'success');
        return redirect('processo-seletivo/'.$request->process_id.'/grupos/'.$group->id.'/edit');
    }

    public function insertPerson($personId) {

        //insere a pessoa no grupo
        $groupPerson = new GroupPerson();
        $groupPerson->group_id = request()->get('group_id');
        $groupPerson->person_id = $personId;
        $groupPerson->status_id = 5; //em progresso
        $groupPerson->save();

        $this->addFlash('Grupo atualizado com sucesso!', 'success');
        return redirect()->back();
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
