<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $w = mt_rand(200, 700);
    $r = $w + mt_rand(50, 100);
    return [
        'title' => $faker->unique()->sentence,
        'slug' => $faker->unique()->slug,
        'code' => '',
        'description' => '',
        'wholesale_price' => $w,
        'retail_price' => $r,
    ];
});
