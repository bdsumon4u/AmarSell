<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $sa = [0, 50, 60, 100];
    $s = $sa[mt_rand(0, 3)];
    $a = $sa[mt_rand(0, 3)];
    $sell = 3130 + mt_rand(150, 500);
    $date = now()->subDays(mt_rand(1, 35));
    return [
        'reseller_id' => mt_rand(1, 26),
        'data' => [
            'customer_name' => $faker->name,
            'customer_email' => $faker->email,
            'customer_phone' => $faker->e164PhoneNumber,
            'customer_address' => $faker->address,
            'shop' => mt_rand(1, 2),
            'delivery_method' => $faker->name,
            'sell' => $sell,
            'shipping' => $s,
            'advanced' => $a,
            'payable' => $sell + $s - $a,

            'price' => 3130.0,
            'products' => [
                3 => [
                    'id' => 3,
                    'quantity' => 3,
                    'name' => 'Arduino Uno',
                    'code' => 'KEF01HZXTG',
                    'slug' => 'arduino-uno',
                    'wholesale' => 720,
                    'retail' => 826,
                ],
                1 => [
                    'id' => 1,
                    'quantity' => 2,
                    'name' => 'Bijoy Biyanno Keyboard',
                    'code' => 'FUUYN7HUKW',
                    'slug' => 'bijoy-biyanno-keyboard',
                    'wholesale' => 485,
                    'retail' => 680,
                ],
            ]
        ],
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
