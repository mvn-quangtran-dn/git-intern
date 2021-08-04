<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;
use App\User;

$factory->define(Contact::class, function (Faker $faker) {

    $listUserID = User::pluck('id');
    return [
        'content' => $faker->text,
        'user_id' => $faker->randomElement($listUserID)
    ];
});
