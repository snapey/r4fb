<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'memo' => $faker->catchphrase,
        'state' => null,
        'user_id' => $faker->numberBetween(1,10),
        'pinned' => $faker->boolean(10),
        'notable_id' => $faker->numberBetween(1,20),
        'notable_type' => 'App\Foodbank',
    ];
});
