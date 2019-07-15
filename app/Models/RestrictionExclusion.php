<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestrictionExclusion extends Model
{
    protected $fillable = ['people_id', 'restriction_id', 'description'];
    protected $table = 'restriction_exclusions';

    public function people() {
        return $this->belongsTo(Person::class);
    }

    public function restriction() {
        return $this->belongsTo(Restriction::class);
    }

}
