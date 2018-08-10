<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text,
        'quantity' => $faker->randomDigitNotNull,
        'price' => $faker->randomFloat(2),
        'imgurl' => $faker->imageUrl(),
    ];
});
