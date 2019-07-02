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
}
