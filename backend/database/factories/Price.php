<?php

use App\Price;
use Faker\Generator as Faker;

$store_ids = \App\Store::pluck('id')->toArray();
$products_ids = \App\Store::pluck('id')->toArray();
$factory->define(Price::class, function (Faker $faker) use ($store_ids, $products_ids){
    $has_store = $faker->boolean;
    return [
         'product_id' => $faker->randomElement($products_ids),
         'store_id' => $has_store ? $faker->randomElement($store_ids) : null,
         'price' => $faker->randomFloat(2, 0, 1),
         'starts_at' => $faker->dateTime,
    ];
});
