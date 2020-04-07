<?php

use App\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'reseller_id' => 1,
            'name' => 'Bongo Deal',
            'email' => 'bongodeal@cyber32.com',
            'phone' => '01624093099',
        ]);
    }
}
