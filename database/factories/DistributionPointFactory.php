<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DistributionPoint;
use Faker\Generator as Faker;

$factory->define(DistributionPoint::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
