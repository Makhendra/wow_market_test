<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $has_description = $faker->boolean;
    return [
         'code' => $faker->numerify('######'),
         'name' => $faker->name,
         'description' => $has_description ? $faker->text : null,
    ];
});
