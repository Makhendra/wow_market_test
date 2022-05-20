<?php

use App\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
         'name' => $faker->company,
         'description' => $faker->text,
    ];
});
