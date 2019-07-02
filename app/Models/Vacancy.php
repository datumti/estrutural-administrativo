<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancies';
    protected $fillable = ['construction_id', 'number', 'contract_id', 'job_id', 'quality_vacancy'];

    public function construction()
    {
        return $this->hasOne('App\Models\Construction');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function vacancy_exam() {
        return $this->hasMany(VacancyExam::class);
    }

    public function vacancy_training() {
        return $this->hasMany(VacancyTraining::class);
    }
}
