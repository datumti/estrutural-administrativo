<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fsa extends Model
{
    protected $table = 'fsas';
    protected $fillable = [
        'person_id',
        'schooling',
        'experience',
        'skills',
        'competence_obs',
        'direct_leadership',
        'supervisor',
        'quality_opinion',
        'quality_salary',
        'quality_obs',
        'admin_opinion',
        'admin_salary',
        'admin_obs',
        'manager_opinion',
        'manager_salary',
        'manager_obs'
    ];
}