<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName(),
        'password' => bcrypt($faker->sentence(rand(1,4))),
    ];
});
