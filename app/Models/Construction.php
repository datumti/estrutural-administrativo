<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    protected $fillable = ['name', 'status', 'cut_grade'];

    public function contract() {
        return $this->hasMany(ContractConstruction::class);
    }

    public function vacancy() {
        return $this->hasMany(Vacancy::class);
    }

    public function manager() {
        return $this->hasMany(Manager::class);
    }

    public function job() {
        return $this->hasManyThrough(Job::class, Vacancy::class, 'job_id', 'id');
    }

}
