<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Construction::class, function (Faker $faker) {
    return [
        'name' => strtoupper($faker->city),
        'status' => 1,
        'cut_grade' => rand(1,9),
    ];
});
