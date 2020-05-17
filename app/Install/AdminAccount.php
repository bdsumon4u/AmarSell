<?php

namespace App\Install;

use App\Reseller;
use App\User as AppUser;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Support\Facades\Artisan;

class AdminAccount
{
    public function setup($data)
    {
        AppUser::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        Reseller::create([
            'name' => 'Reseller',
            'email' => 'reseller@cyber32.com',
            'phone' => '01xxxxxxxxx',
            'password' => 'password',
        ]);
    }
}
