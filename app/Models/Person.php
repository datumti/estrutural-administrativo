<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\PeopleDocument;

class Person extends Authenticatable
{

    protected $with = ['job'];

    use Notifiable;

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

    public function group_person() {
        return $this->hasOne(GroupPerson::class);
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function getBirthDateAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function people_document() {
        return $this->hasMany(PeopleDocument::class, 'people_id');
    }
}
