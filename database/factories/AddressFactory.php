<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'firstLine' => $faker->streetAddress,
        'secondLine' => "No second line",
        'country' => $faker->country,
        'city' => $faker->city,
        'number' => $faker->buildingNumber,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});
