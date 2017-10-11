<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(QuickUser\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone_number' => $faker->e164PhoneNumber,
        'active' => 1,
        'role_id' => random_int(1, 3),
        'remember_token' => str_random(10),
        'created_at' => $faker->dateTimeThisDecade,
        'updated_at' => $faker->dateTimeThisDecade
    ];
});
