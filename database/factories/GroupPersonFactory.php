<?php

use Faker\Generator as Faker;
use App\GroupPerson;

$factory->define(App\Models\GroupPerson::class, function (Faker $faker) {
    return [
        'group_id' => rand(1,28),
        'person_id' => rand(1,48),
        'status_id' => rand(1,3),
        'note' => rand(1,9),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
    ];
});
