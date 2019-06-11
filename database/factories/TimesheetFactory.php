<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Timesheet::class, function (Faker $faker) {
    return [
        'employee' => $faker->randomNumber($nbDigits = 5, $strict = true),
        'date' => date('Y-m-d'),
        'time' => '0'.rand(1,9).':'.rand(10,59)
    ];
});
