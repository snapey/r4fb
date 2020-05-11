<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Club;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Club::class, function (Faker $faker) {
    return [
        'name' => Str::ucfirst($faker->word) . ' ' . Str::ucfirst($faker->word),
        'areas' => $faker->sentence,
        'group' => $faker->word,
        'District' => '1220',
    ];
});
