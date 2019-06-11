<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'job_id',
        'ctps',
        'rg',
        'phoneMobile',
        'mobileAlternative',
        'birthDate',
        'pcd',
        'motherName',
        'address',
        'addressNumber',
        'addressExtra',
        'neighborhood',
        'city',
        'states',
        'cep',
        'bootNumber',
        'pantsNumber',
        'shirtNumber',
        'markNumber',
        'number',
        'email',
        'password',
        'profile_id'
    ];

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
