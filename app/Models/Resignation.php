<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    protected $fillable = [
        'person_id',
        'construction_id',
        'description',
        'evaluation_quality',
        'evaluation_sms',
        'evaluation_discipline',
        'evaluation_production',
        'fired',
        'transfered'
    ];

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }
}
