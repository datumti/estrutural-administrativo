<?php

use Faker\Generator as Faker;
use App\Group;

$factory->define(App\Models\Group::class, function (Faker $faker) {
    return [
        'name' => strtoupper($faker->city),
        'process_id' => rand(1,2),
        'construction_id' => rand(1,9),
        'training_id' => rand(1,9),
    ];
});
