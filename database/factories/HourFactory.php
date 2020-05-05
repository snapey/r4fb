<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hour;
use Faker\Generator as Faker;

$factory->define(Hour::class, function (Faker $faker) {
    return [
        'opens' => $faker->time(),
        'closes' => $faker->time(),
        'day' => $faker->randomNumber(),
        'accessible_id' => $faker->randomNumber(1,20),
        'accessible_type' => $faker->word,
    ];
});
