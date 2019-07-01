<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
