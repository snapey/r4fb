<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'forenames' => $faker->firstName,
        'surname' => $faker->lastName,
        'phone1' => $faker->e164PhoneNumber,
        'phone2' => null,
        'email1' => $faker->safeEmail,
        'email2' => null,
    ];
});
