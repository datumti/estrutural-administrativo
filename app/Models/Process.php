<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $fillable = ['name'];

    public function group() {
        return $this->hasMany(Group::class);
    }

}
