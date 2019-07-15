<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restriction extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'cpf', 'description'];
    protected $dates = ['created_at'];


    public function people() {
        return $this->belongsTo(Person::class);
    }
}
