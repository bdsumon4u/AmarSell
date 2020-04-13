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
            'reseller_id' => 2,
            'name' => 'Bongo Deal',
            'email' => 'bongodeal@cyber32.com',
            'phone' => '01624093099',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Deleniti, velit voluptate, consequuntur fugiat itaque reiciendis ipsum libero incidunt illum vitae laboriosam animi expedita omnis enim eveniet ab cum quisquam maxime?
            Voluptas repellat a vitae laboriosam inventore earum quas quod sit suscipit!
            Autem expedita enim, ratione quos veniam deserunt aut consequatur.'
        ]);
    }
}
