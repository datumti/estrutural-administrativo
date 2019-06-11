<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['openings', 'construction_id', 'contract_id', 'person_id', 'job_id'];

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

}
