<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Foodbank;
use Faker\Generator as Faker;

$factory->define(Foodbank::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'location' => $faker->city,
        'charity' => $faker->randomNumber(8),
        'organisation' => $faker->boolean(50) ? $faker->company : null,
        'website' => $faker->boolean(50) ? $faker->url : null,
        'email' => $faker->boolean(50) ? $faker->companyEmail : null,
        'updated_at' => $faker->dateTimeThisMonth(),
    ];
});
