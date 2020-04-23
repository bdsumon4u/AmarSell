<?php

namespace App\Http\View\Composers\Admin;

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
            'route' => 'home',
            'badge' => [
                'variant' => 'secondary',
                'data' => 4,
            ],
        ],
        [
            'style' => 'title',
            'name' => 'BASE',
        ],
        [
            'icon' => 'fa fa-columns',
            'style' => 'simple',
            'name' => 'Categories',
            'route' => 'admin.categories.index',
        ],
        [
            'icon' => 'fa fa-server',
            'style' => 'dropdown',
            'name' => 'Products',
            'items' => [
                [
                    'name' => 'All',
                    'route' => 'admin.products.index',
                ],
                [
                    'name' => 'Create',
                    'route' => 'admin.products.create',
                ],
            ],
        ],
        [
            'icon' => 'fa fa-th-list',
            'style' => 'dropdown',
            'name' => 'Orders',
            'items' => [
                [
                    'name' => 'Pending',
                    'route' => 'admin.order.index',
                    'param' => 'filter[status]=pending',
                ],
                [
                    'name' => 'Accepted',
                    'route' => 'admin.order.index',
                    'param' => 'filter[status]=accepted',
                ],
                [
                    'name' => 'Processing',
                    'route' => 'admin.order.index',
                    'param' => 'filter[status]=processing',
                ],
                [
                    'name' => 'Transporting',
                    'route' => 'admin.order.index',
                    'param' => 'filter[status]=transporting',
                ],
                [
                    'name' => 'Completed',
                    'route' => 'admin.order.index',
                    'param' => 'filter[status]=completed',
                ],
            ],
        ],
        [
            'icon' => 'fa fa-server',
            'style' => 'dropdown',
            'name' => 'Transactions',
            'items' => [
                [
                    'name' => 'Pay',
                    'route' => 'admin.transactions.pay',
                ],
                [
                    'name' => 'History',
                    'route' => 'admin.transactions.index',
                ],
                [
                    'name' => 'Requests',
                    'route' => 'admin.transactions.requests',
                ],
            ],
        ],
        [
            'icon' => 'fa fa-columns',
            'style' => 'dropdown',
            'name' => 'Students',
            'items' => [
                [
                    'name' => 'Active',
                    'url' => 'students.index',
                    'param' => ['status' => 'active'],
                ],
                [
                    'name' => 'Suspended',
                    'url' => 'students.index',
                    'param' => ['status' => 'suspended'],
                ],
            ],
        ],
        [
            'icon' => 'fa fa-exclamation',
            'style' => 'dropdown',
            'name' => 'Exams',
            'items' => [
                [
                    'name' => 'All',
                    'url' => 'exams.index',
                ],
                [
                    'name' => 'Add New',
                    'url' => 'exams.create',
                ],
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
        $view->with('provider', 'web');
    }
}