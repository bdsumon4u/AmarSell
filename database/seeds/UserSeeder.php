<?php

use App\Reseller;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'aDmiN',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        Reseller::truncate();
        Reseller::create([
            'name' => 'Cyber32 Reseller',
            'email' => 'reseller@cyber32.com',
            'phone' => '01624093099',
            'password' => bcrypt('password'),
        ]);
    }
}
