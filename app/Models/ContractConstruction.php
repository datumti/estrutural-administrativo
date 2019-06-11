<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractConstruction extends Model
{
    protected $table = 'contract_construction';
    protected $fillable = ['contract_id', 'construction_id'];

    public function construction()
    {
        return $this->belongsTo('App\Models\Construction');
    }
}
