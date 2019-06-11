<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeExam extends Model
{
    protected $table = 'badge_exam';

    protected $fillable = ['construction_id', 'exam_id'];

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }
}
