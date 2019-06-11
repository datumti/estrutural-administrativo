<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeTraining extends Model
{
    protected $table = 'badge_training';

    protected $fillable = ['construction_id', 'training_id'];

    public function training()
    {
        return $this->belongsTo('App\Models\Training');
    }

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }
}
