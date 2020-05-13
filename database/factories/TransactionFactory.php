<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'reseller_id' => mt_rand(1, 56),
        'amount' => mt_rand(24, 200),
        'method' => 'bKash',
        'bank_name' => null,
        'account_name' => null,
        'branch' => null,
        'routing_no' => null,
        'account_type' => 'Personal',
        'account_number' => $faker->e164PhoneNumber,
        'transaction_number' => $faker->word(),
        'status' => 'paid',
    ];
});
