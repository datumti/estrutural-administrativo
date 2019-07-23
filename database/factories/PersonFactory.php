<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name($gender = null),
        'email' => $faker->companyEmail(),
        'password' => '123',
        'profile_id' => 1,
        'construction_id' => 1,
        'cpf' =>
            $faker->randomNumber($nbDigits = 3, $strict = true) . '.' .
            $faker->randomNumber($nbDigits = 3, $strict = true) . '.' .
            $faker->randomNumber($nbDigits = 3, $strict = true) . '-' .
            $faker->randomNumber($nbDigits = 2, $strict = true),
        'job_id' => rand(1, 9),
        'ctps' =>
            $faker->randomNumber($nbDigits = 7, $strict = true) . ' ' .
            $faker->randomNumber($nbDigits = 3, $strict = true) . '-' .
            rand(0, 9),
        'rg' => $faker->randomNumber($nbDigits = 9, $strict = true).rand(0, 9),
        'phoneMobile' => $faker->tollFreePhoneNumber(),
        'mobileAlternative' => $faker->tollFreePhoneNumber(),
        'birthDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'pcd' => rand(0, 1),
        'motherName' => $faker->name($gender = 'female'),
        'address' => $faker->streetName(),
        'addressNumber' => $faker->buildingNumber(),
        'addressExtra' => $faker->secondaryAddress(),
        'neighborhood' => $faker->streetName(),
        'city' => $faker->city(),
        'states' => 'RS',
        'cep' => $faker->randomNumber($nbDigits = 8, $strict = true),
        'bootNumber' => $faker->randomNumber($nbDigits = 2, $strict = true),
        'pantsNumber' => $faker->randomNumber($nbDigits = 2, $strict = true),
        'shirtNumber' => $faker->randomNumber($nbDigits = 2, $strict = true),
        'markNumber' => $faker->randomNumber($nbDigits = 2, $strict = true),
        'number' => '026171',
        'journey' => rand(1, 5)
    ];
});
