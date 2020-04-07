<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $desc = '<p>Two spacious compartments and a padded laptop sleeve provide ample room for all your tech - the Eastpak Provider backpack is a great way to get your stuff around.
    It’s a very comfortable fit with extra features like the key keeper to help you stay organized, and it’s a great-looking accessory!
    The Eastpak Provider backpack comes in a great range of alternate colors and designs.</p>
    <p>Product Features:</p>
    <ul>
        <li>Laptop sleeve (38x29cm)</li>
        <li>Two large compartments</li>
        <li>Shaped shoulder strap with SGS</li>
        <li>Compressions straps</li>
        <li>Front pocket with organizer</li>
        <li>Comfortable quilted padded back</li>
        <li>Rubber molded handle</li>
        <li>Detachable key clip</li>
        <li>Padded bottom for books</li>
        <li>Height: 44 cm</li>
        <li>Width: 31 cm</li>
        <li>Depth: 25 cm</li>
        <li>Volume: 33 l</li>
        <li>Weight: 900g</li>
        <li>Material: Polyamide</li>
    </ul>';

    $w = mt_rand(200, 700);
    $r = $w + mt_rand(50, 100);
    return [
        'title' => $faker->unique()->sentence,
        'slug' => $faker->unique()->slug,
        'sku' => Str::random(10),
        'description' => $desc,
        'wholesale_price' => $w,
        'retail_price' => $r,
    ];
});
