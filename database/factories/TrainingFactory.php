<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Training::class, function (Faker $faker) {
    return [
        'name' => 'NR-'.rand(1,9).rand(1,9),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
