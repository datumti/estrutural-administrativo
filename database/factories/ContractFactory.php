<?php

use Faker\Generator as Faker;
use App\ContractConstruction;

$factory->define(App\Models\ContractConstruction::class, function (Faker $faker) {
    return [
        'contract_id' => rand(1,9),
        'construction_id' => rand(1,9)
    ];
});
