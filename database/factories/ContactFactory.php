<?php

use App\Contact;
use App\User;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
       'name' => $faker->name,
       'phone' => $faker->phoneNumber,
       'user_id' => User::all()->random()->id
    ];
});
