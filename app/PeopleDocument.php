<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Provider\sk_SK\Person;
use Illuminate\Support\Facades\Storage;

class PeopleDocument extends Model
{
    //
    protected $table = 'people_documents';

    protected $fillable = ['people_id', 'construction_id', 'filename', 'filepath'];

    public function people() {
        return $this->belongsTo(Person::class);
    }

    public function getFilepathAttribute() {
        return Storage::url($this->attributes['filepath']);
    }

}
