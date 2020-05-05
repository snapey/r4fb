<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'sku' => $faker->word,
        'uom' => $faker->word,
        'weight' => $faker->randomNumber(),
        'description' => $faker->text,
        'durability' => $faker->word,
        'generic' => $faker->boolean,
    ];
});
