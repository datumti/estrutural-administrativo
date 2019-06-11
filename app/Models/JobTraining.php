<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTraining extends Model
{
    protected $fillable = ['job_id', 'training_id'];

    public function job()
    {
        return $this->hasOne('App\Models\Job');
    }

    public function training()
    {
        return $this->hasOne('App\Models\Training');
    }
}
