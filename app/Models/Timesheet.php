<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = [
        'employee',
        'date',
        'time'
    ];

    public function people() {
        return $this->belongsTo(Person::class, 'employee', 'number');
    }

}
