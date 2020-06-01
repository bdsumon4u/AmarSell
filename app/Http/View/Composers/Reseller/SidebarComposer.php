<?php

namespace App\Http\View\Composers\Reseller;

use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Menu
     */
    public $menu = [
        [
            'icon' => 'fa fa-tachometer',
            'style' => 'simple',
            'name' => 'Dashboard',
            'route' => 'reseller.home',
        ],
        [
            'icon' => 'fa fa-product-hunt',
            'style' => 'simple',
            'name' => 'Products',
            'route' => 'reseller.product.index',
        ],
        [
            'style' => 'title',
            'name' => 'BASE',
        ],
        [
            'icon' => 'fa fa-server',
            'style' => 'dropdown',
            'name' => 'Shops',
            'items' => [
                [
                    'name' => 'My Shops',
                    'route' => 'reseller.shops.index',
                ],
                [
                    'name' => 'Create Shop',
                    'route' => 'reseller.shops.create',
                ],
            ],
        ],
        [
            'icon' => 'fa fa-th-list',
            'style' => 'simple',
            'name' => 'Orders',
            'route' => 'reseller.order.index',
        ],
        [
            'icon' => 'fa fa-money',
            'style' => 'dropdown',
            'name' => 'Transactions',
            'items' => [
                [
                    'name' => 'History',
                    'route' => 'reseller.transactions.index',
                ],
                [
                    'name' => 'Settings',
                    'route' => 'reseller.setting.edit',
                ],
                // [
                //     'name' => 'Money Request',
                //     'route' => 'reseller.transactions.request',
                // ],
            ],
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
        $view->with('menu', $this->menu);
        $view->with('provider', 'resellers');
    }
}