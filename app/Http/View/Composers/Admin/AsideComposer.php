<?php

namespace App\Http\View\Composers\Admin;

use Illuminate\View\View;

class AsideComposer
{
    /**
     * Aside Tab
     */
    public $asideTab = [
        [
            'title' => 'Account',
            'id' => 'account',
            'view' => 'reseller.aside.account',
        ],
        [
            'title' => 'Transactions',
            'id' => 'transactions',
            'view' => 'reseller.aside.transactions',
        ],
    ];

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('asideTab', []);
    }
}