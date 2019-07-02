<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyExam extends Model
{
    protected $table = 'vacancy_exam';
    protected $fillable = ['vacancy_id', 'exam_id'];

    public function vacancy()
    {
        return $this->hasOne('App\Models\Vacancy');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }
}
