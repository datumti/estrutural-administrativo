<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Exam::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
