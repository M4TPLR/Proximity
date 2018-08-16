<?php

use Faker\Generator as Faker;
use App\Basket;

$factory->define(Basket::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'quantity' => $faker->randomFloat(0, 10),
        'priceWithTaxes' => $faker->randomFloat(0,100),
    ];
});
