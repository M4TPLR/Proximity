<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '1vXwhAkuCDS4euKnt7sl6HAw5TQ9QK8WEKxuJ8LJc6c',
        //secret
        'phone' => $faker->unique()->phoneNumber,
        'role' => 'client',
        'imgurl' => $faker->imageUrl(),
        'bio' => $faker->text,
    ];
});
