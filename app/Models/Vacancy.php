<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancies';
    protected $fillable = ['construction_id', 'number', 'constract_id', 'job_id', 'quality_vancancy'];

    public function construction()
    {
        return $this->hasOne('App\Models\Construction');
    }

    public function job()
    {
        return $this->hasOne('App\Models\Job');
    }
}
