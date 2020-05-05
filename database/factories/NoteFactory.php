<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'memo' => $faker->word,
        'state' => $faker->word,
        'pinned' => $faker->boolean,
        'notable_id' => $faker->randomNumber(1, 20),
        'notable_type' => $faker->word,
    ];
});
