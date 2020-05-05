<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'forenames' => $faker->word,
        'surname' => $faker->word,
        'phone1' => $faker->word,
        'phone2' => $faker->word,
        'email1' => $faker->word,
        'email2' => $faker->word,
    ];
});
