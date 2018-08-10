<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->text,
        'imgurl' => $faker->imageUrl(),
        'ShippingType' => 'ship',
    ];
});
