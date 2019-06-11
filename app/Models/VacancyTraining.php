<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyTraining extends Model
{
    protected $table = 'vacancy_training';
    protected $fillable = ['vacancy_id', 'training_id'];

    public function vacancy()
    {
        return $this->hasOne('App\Models\Vacancy');
    }

    public function training()
    {
        return $this->hasOne('App\Models\Training');
    }
}
