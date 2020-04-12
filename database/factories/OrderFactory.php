<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $s = [0, 50, 100];
    return [
        'reseller_id' => mt_rand(1, 3),
        'data' => [
            'customer_name' => $faker->name,
            'customer_email' => $faker->email,
            'customer_phone' => $faker->e164PhoneNumber,
            'customer_address' => $faker->address,
            'shop' => $faker->name,
            'delevery_method' => $faker->name,
            'sell' => mt_rand(800, 2000),
            'shipping' => $s[mt_rand(0, 2)],
            'advanced' => $s[mt_rand(0, 2)],

            'price' => 2421.0,
            'products' => [
                193 => [
                    'id' => 193,
                    'quantity' => 3,
                    'product' => [
                        'sku' => 'AiSKv8PAK7',
                        'wholesale_price' => 527,
                        'retail_price' => 608,
                    ]
                ],
                192 => [
                    'id' => 192,
                    'quantity' => 2,
                    'product' => [
                        'sku' => 'UUcjsyrUvH',
                        'wholesale_price' => 420,
                        'retail_price' => 493,
                    ]
                ],
            ]
        ]
    ];
});
