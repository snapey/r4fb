<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contactable;
use Faker\Generator as Faker;

$factory->define(Contactable::class, function (Faker $faker) {
    return [
        'contactable_id' => $faker->numberBetween(1,20),
        'contactable_type' => 'App\Foodbank',
        'relationship' => $faker->word,
        'contact_id' => $faker->numberBetween(1,20),
    ];
});
