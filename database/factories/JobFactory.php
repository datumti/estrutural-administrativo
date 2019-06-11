<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Job::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'crm' => rand(1,8),
        'clinic' => $faker->company
    ];
});
