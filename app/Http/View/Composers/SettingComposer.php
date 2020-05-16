<?php

namespace App\Http\View\Composers;

use App\Repository\SettingsRepository;
use Illuminate\View\View;

class SettingComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $settingsRepo = new SettingsRepository;
        foreach(['company', 'social', 'contact', 'logo', 'footer_menu'] as $item) {
            $view->with($item, $settingsRepo->first($item)->value);
        }
    }
}
