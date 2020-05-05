<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'address1' => $faker->streetAddress,
        'address2' => $faker->secondaryAddress,
        'address3' => $faker->word,
        'address4' => $faker->word,
        'postcode' => $faker->postcode,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'phone_number' => $faker->phoneNumber,
        'addressable_id' => $faker->randomNumber(1,20),
        'addressable_type' => $faker->word,
    ];
});
