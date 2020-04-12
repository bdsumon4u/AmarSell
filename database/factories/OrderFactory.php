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
            'delevary_method' => $faker->name,
            'sell' => 2421 + mt_rand(150, 500),
            'shipping' => $s[mt_rand(0, 2)],
            'advanced' => $s[mt_rand(0, 2)],

            'price' => 2421.0,
            'products' => [
                193 => [
                    'id' => 193,
                    'quantity' => 3,
                    'sku' => 'AiSKv8PAK7',
                    'slug' => 'fugiat-unde-voluptatem-quia-natus-eos-animi',
                    'wholesale' => 527,
                    'retail' => 608,
                ],
                192 => [
                    'id' => 192,
                    'quantity' => 2,
                    'sku' => 'UUcjsyrUvH',
                    'slug' => 'perferendis-neque-eos-ut-maiores-dolores',
                    'wholesale' => 420,
                    'retail' => 493,
                ],
            ]
        ]
    ];
});
