<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function personSms()
    {
        return $this->belongsTo('App\Models\Person', 'person_id_sms');
    }

    public function personQuality()
    {
        return $this->belongsTo('App\Models\Person', 'person_id_quality');
    }

    public function personProduction()
    {
        return $this->belongsTo('App\Models\Person', 'person_id_production');
    }

    public function personDiscipline()
    {
        return $this->belongsTo('App\Models\Person', 'person_id_discipline');
    }

    public function managerSms()
    {
        return $this->belongsTo('App\Models\Person', 'manager_id_sms');
    }

    public function managerQuality()
    {
        return $this->belongsTo('App\Models\Person', 'manager_id_quality');
    }

    public function managerProduction()
    {
        return $this->belongsTo('App\Models\Person', 'manager_id_production');
    }

    public function managerDiscipline()
    {
        return $this->belongsTo('App\Models\Person', 'manager_id_discipline');
    }

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }
}
