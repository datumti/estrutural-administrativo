<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Provider\sk_SK\Person;

class PeopleDocument extends Model
{
    //
    protected $table = 'people_documents';

    protected $fillable = ['people_id', 'construction_id', 'filename'];

    public function people() {
        return $this->belongsTo(Person::class);
    }
}
