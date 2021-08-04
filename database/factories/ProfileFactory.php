<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'gender' => rand(0,1),
        'age' => rand(1,100),
        'tel' => $faker->phoneNumber
    ];
});
