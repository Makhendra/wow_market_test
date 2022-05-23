<?php

use App\Role;
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

$roles = Role::pluck('id')->toArray();
$factory->define(App\User::class, function (Faker $faker) use ($roles) {
    $email = $faker->unique()->safeEmail;
    $password = $faker->password;
    echo "$email=$password".PHP_EOL;
    return [
        'name' => $faker->name,
        'role_id' => $faker->randomElement($roles),
        'email' => $email,
        'password' => Hash::make($password),
        'remember_token' => str_random(10),
    ];
});
