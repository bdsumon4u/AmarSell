<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'name' => 'company',
                'value' => json_encode([
                    'name' => 'AmarSell',
                    'email' => 'amarsell@cyber32.com',
                    'tagline' => 'Tagline',
                    'address' => 'Address',
                ]),
            ],
            [
                'name' => 'contact',
                'value' => json_encode([
                    'phone' => '01xxxxxxxxx',
                ]),
            ],
            [
                'name' => 'logo',
                'value' => json_encode([
                    'white' => asset('images/defaults/white-logo.png'),
                    'color' => asset('images/defaults/color-logo.png'),
                    'footer' => asset('images/defaults/footer-logo.png'),
                    'favicon' => asset('images/defaults/favicon-logo.png'),
                ]),
            ],
            [
                'name' => 'footer_menu',
                'value' => json_encode([]),
            ],
            [
                'name' => 'courier',
                'value' => json_encode([
                    'Sundarban',
                    'SA Paribahan',
                    'Korotua',
                ]),
            ],
        ]);
    }
}
