<?php

namespace App\Http\Controllers;

use App\Models\PermissionProfile;
use App\Models\Permission;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;


class PermissionProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET: /exam
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = PermissionProfile::all();
        return response()->json($groups, 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST: /exam
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request)
    {
        
        $local=$request->local;
        $profile=$request->id;
        $p = Permission::where('local_access', $local)->get();
        foreach ($p as $permission) {
            $pp[]=PermissionProfile::where('id_permission', $permission['id'])->where('id_profile',$profile)->get();             
        }
        if(isset($pp)){//*só pra controle, pois sempre vai entrar 
            return response()->json($pp, 200);
        }
        
    }
    public function getAll(Request $request)
    {
        
        
        $profile=$request->id;
        $user=$request->user;
        $pp=PermissionProfile::where('id_profile',$profile)->get();             
        $g=Group::join('group_person', 'groups.id', '=', 'group_person.group_id')->where('group_person.person_id', $user)->first();
        
       
        if($g){
            $i=0;
            foreach($pp as $person){
                $p = Permission::where('id', $person->id_permission)->first();
                $return[$i]['limit']=$person->limit;
                $return[$i]['local_access']=$p->local_access;
                $return[$i]['id']=$person->id;
                $return[$i]['construction_id']=$g->construction_id;
                $i++;
            }
        }else{
            $i=0;
            foreach($pp as $person){
                $p = Permission::where('id', $person->id_permission)->first();
                $return[$i]['limit']=$person->limit;
                $return[$i]['local_access']=$p->local_access;
                $return[$i]['id']=$person->id;
                $return[$i]['construction_id']=0;
                $i++;
            }
        }
        
        //*só pra controle, pois sempre vai entrar 
        return response()->json($return, 200);
        
        
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
        $fsasPeople = Fsa::where('person_id', $id)->get();
        foreach ($fsasPeople as $fp) {
           $fp['quality_opinion']=null;
           $fp['manager_opinion']=null;
           $fp['admin_opinion']=null;
           $fp->save();
        }
       
        return response()->json(null, 204);
    }

}
