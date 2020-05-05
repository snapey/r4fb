<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shipper;
use Faker\Generator as Faker;

$factory->define(Shipper::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'modes' => $faker->word,
    ];
});
