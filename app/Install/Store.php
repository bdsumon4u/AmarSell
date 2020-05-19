<?php

namespace App\Install;

use Modules\Setting\Entities\Setting;
use App\Repository\SettingsRepository;

class Store
{
    public function __construct(SettingsRepository $settingsRepo)
    {
        $this->settings = $settingsRepo;
    }

    public function setup($data)
    {
        $this->settings->setMany([
            'company' => [
                'name' => $data['store_name'],
                'email' => $data['store_email'],
                'tagline' => 'Tagline',
                'address' => 'Address',
            ],
            'contact' => [
                'phone' => '01xxxxxxxxx',
            ],
            'logo' => [
                'white' => asset('images/logo/default-white.png'),
                'color' => asset('images/logo/default-color.png'),
                'footer' => asset('images/logo/default-footer.png'),
                'favicon' => asset('images/logo/default-favicon.png'),
            ]
        ]);
    }
}
