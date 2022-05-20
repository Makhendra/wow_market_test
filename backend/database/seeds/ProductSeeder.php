<?php

use App\Price;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::truncate();
        Product::truncate();

        factory(App\Product::class, 50)->create()->each(function ($product) {
            $product->prices()->save(factory(App\Price::class)->make(['product_id' => $product->id]));
        });
    }
}
