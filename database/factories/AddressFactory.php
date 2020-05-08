<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {

    $faker = Factory::create('en_GB');

    return [
        'address1' => $faker->streetAddress,
        'address2' => $faker->secondaryAddress,
        'address3' => $faker->city,
        'address4' => $faker->county,
        'postcode' => $faker->postcode,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'phone_number' => $faker->e164PhoneNumber,
        'addressable_id' => $faker->numberBetween(1,20),
        'addressable_type' => 'App\Foodbank',
    ];
});
