<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPerson extends Model
{
    protected $table = 'group_person';
    protected $fillable = ['group_id', 'person_id', 'status_id', 'status_aso_id', 'note', 'description'];
    protected $with = ['status', 'status_aso'];

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function status_aso()
    {
        return $this->belongsTo('App\Models\Status');
    }

/*     public function people_document() {
        return $this->hasMany(PeopleDocument::class, 'people_id');
    } */
}
