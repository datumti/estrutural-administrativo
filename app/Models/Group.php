<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Group extends Model
{

    protected $fillable = [
        'name',
        'construction_id',
        'process_id',
        'creation_date',
        'training_id',
        'clinic_name',
        'clinic_code',
        'crm'
    ];

    public function process()
    {
        return $this->belongsTo('App\Models\Process');
    }

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }

    public function training()
    {
        return $this->belongsTo('App\Models\Training');
    }

    public function group_person() {
        return $this->hasMany(GroupPerson::class);
    }

    public function group_person_convocado() {
        return $this->hasMany(GroupPerson::class)->where('status_id', 5);
    }

    public function group_person_aprovado() {
        return $this->hasMany(GroupPerson::class)->where('status_id', 1);
    }

    public function group_person_reprovado() {
        return $this->hasMany(GroupPerson::class)->where('status_id', 2);
    }

    public function group_person_ressalva() {
        return $this->hasMany(GroupPerson::class)->where('status_id', 3);
    }

    public function group_person_avaliacao() {
        return $this->hasMany(GroupPerson::class)->where('status_id', 4);
    }

    public function getCreationDateAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
