<?php

namespace App\Repository;

use App\Setting;

class SettingsRepository
{
    public function set($name, $value)
    {
        return Setting::updateOrCreate([
            'name' => $name,
        ], [
            'value' => $value,
        ]);
    }

    public function setMany($data)
    {
        foreach($data as $name => $value) {
            Setting::updateOrCreate([
                'name' => $name,
            ], [
                'value' => $value,
            ]);
        }
    }

    public function get($name)
    {
        return Setting::where('name', $name)->get() ?? new Setting;
    }

    public function first($name)
    {
        return Setting::where('name', $name)->first() ?? new Setting;
    }
}
