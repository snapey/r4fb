<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Foodbank;
use Faker\Generator as Faker;

$factory->define(Foodbank::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'location' => $faker->city,
        'charity' => $faker->randomNumber(8),
        'organisation' => $faker->company,
        'updated_at' => $faker->dateTimeThisMonth(),
    ];
});
