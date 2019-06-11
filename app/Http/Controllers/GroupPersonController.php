<?php

namespace App\Http\Controllers;

use App\Models\GroupPerson;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GroupPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /exam
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = GroupPerson::all();
        return response()->json($groups, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /exam
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrayGp = $request->input();
        foreach ($arrayGp as $gp) {
            //get person id or create a new one
            $p = Person::where('cpf', $gp['person_cpf'])->first();
            if ($p == null) {
                $p = new Person;
                $p->name = $gp['person_name'];
                $p->cpf = $gp['person_cpf'];
                $p->job_id = null;
                $p->save();
            }
            $gp['person_id'] = $p->id;
            $groupPerson = GroupPerson::create($gp);
            // input attachments
            foreach ($gp['attachments'] as $att) {
                $baseStr = $att['value'];
                $path = storage_path() . '/app/public/groups/' . $gp['group_id'] . '/people/' . $gp['person_id'];
                $this->uploadFile($baseStr, $path, $att['filename']);
            }
        }
        return response()->json($arrayGp, 201);
    }

    /**
     * Display the specified resource by group_id.
     *
     * @param  \App\GroupPerson  $groupPerson
     * @return \Illuminate\Http\Response
     */
    public function show($groupId)
    {
        $groupPeople = GroupPerson::where('group_id', $groupId)->get();
        return response()->json($groupPeople, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupPerson  $groupPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupPerson $groupPerson)
    {
        $groupPerson = GroupPerson::findOrFail($groupPerson->id);
        $groupPerson->fill($request->all());
        $groupPerson->save();
        return response()->json($groupPerson, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupPerson  $groupPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPerson $groupPerson)
    {
        $groupPerson = GroupPerson::findOrFail($groupPerson->id);
        $groupPerson->delete();
        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage by Person id.
     *
     * @param  \App\GroupPerson  $groupPerson
     * @return \Illuminate\Http\Response
     */
    public function destroyByPerson($id)
    {
        $groupPeople = GroupPerson::where('person_id', $id)->get();
        foreach ($groupPeople as $gp) {
            $gp->delete();
        }
        return response()->json(null, 204);
    }

    /**
     * List the attachments by group and person.
     *
     * @param  \App\Group  $groupId
     * @param  \App\Person  $personId
     * @return \Illuminate\Http\Response
     */
    public function searchAttachments($groupId, $personId)
    {
        $url = storage_path() . '/app/public/groups/' . $groupId . '/people/' . $personId;
        if (file_exists($url)) {
            $files = array_slice(scandir($url), 2);
            $response = array();
            foreach ($files as $file) {
                $fullPath = '/api/groups/'.$groupId.'/people/'.$personId.'/download/attachment/'.$file;
                $response[urldecode($file)] = $fullPath;
            }
            return response()->json($response, 200);
        } else {
            return response()->json(null, 204);
        }
    }

    /**
     * Download the attachment by group and person.
     *
     * @param  \App\Group  $groupId
     * @param  \App\Person  $personId
     * @param  Int  $attachmentId
     * @return \Illuminate\Http\Response
     */
    public function downloadAttachments($groupId, $personId, $attachment)
    {
        $url = storage_path() . '/app/public/groups/' . $groupId . '/people/' . $personId . '/' . $attachment;
        return response()->download($url);
    }

    /**
     * Upload the attachments by group and person.
     *
     * @param  \App\Group  $groupId
     * @param  \App\Person  $personId
     * @return \Illuminate\Http\Response
     */
    public function uploadAttachments($groupId, $personId)
    {
        $url = storage_path() . '/app/public/groups/' . $groupId . '/people/' . $personId;
        if (!file_exists($url)) {
            File::makeDirectory($url, 0777, true);
        }
        if (isset($_FILES['attachments'])) {
            setlocale(LC_ALL, 'pt_BR');
            // getting the files
            $attachments = $_FILES['attachments'];
            $success = null;
            $paths = [];
            // getting file names
            $filenames = $attachments['name'];
            // processing the files
            for ($i = 0; $i < count($filenames); $i++) {
                $ext = explode('.', basename($filenames[$i]));
                $target = $url . DIRECTORY_SEPARATOR . ($filenames[$i]);
                if (move_uploaded_file($attachments['tmp_name'][$i], $target)) {
                    $success = true;
                    $paths[] = $target;
                } else {
                    $success = false;
                    break;
                }
            }
            return response()->json(json_encode($paths), 200);
        }
    }

    /**
     * Remove the attachment by group and person.
     *
     * @param  \App\Group  $groupId
     * @param  \App\Person  $personId
     * @param  Int  $attachmentId
     * @return \Illuminate\Http\Response
     */
    public function removeAttachment($groupId, $personId, $attachment)
    {
        $url = storage_path() . '/app/public/groups/' . $groupId . '/people/' . $personId . '/' . $attachment;
        $res = unlink($url);
        return response()->json(json_encode($res), 200);
    }

    public function uploadFile($base64_string, $path, $filename) {
        // makes sure folder exists
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $ifp = fopen($path.'/'.$filename, 'wb'); 
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp ); 
        return $path; 
    }
    
    /**
     * Display a listing of the resource based on job X Training.
     * GET: /people/suggestions/trainings
     * @return \Illuminate\Http\Response
     */
    public function suggestionsTraining($trainingId)
    {
        $groupPerson = Person::select('people.*')
        ->join('group_person', 'people.id', '=', 'group_person.person_id')
        ->join('groups', 'groups.id', '=', 'group_person.group_id')
        ->join('job_trainings', 'job_trainings.job_id', '=', 'people.job_id')
            ->whereRaw('people.id not in (select people.id from people, group_person, groups where group_person.person_id=people.id and group_person.group_id = groups.id and groups.process_id = 3)')
            ->where('job_trainings.training_id', $trainingId)
            ->groupBy('people.id')
            ->orderBy('name', 'asc')
            ->get();

        // print_r($groupPerson);
        foreach ($groupPerson as $g) $g->job;
        return response()->json($groupPerson, 200);
    }

}
