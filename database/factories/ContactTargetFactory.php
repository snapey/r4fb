<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ContactTarget;
use Faker\Generator as Faker;

$factory->define(ContactTarget::class, function (Faker $faker) {
    return [
        'contactable_id' => $faker->randomNumber(1,20),
        'contactable_type' => $faker->word,
    ];
});
