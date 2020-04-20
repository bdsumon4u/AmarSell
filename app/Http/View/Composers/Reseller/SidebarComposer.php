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
            'badge' => [
                'variant' => 'secondary',
                'data' => 4,
            ],
        ],
        [
            'icon' => 'fa fa-tachometer',
            'style' => 'simple',
            'name' => 'Products',
            'route' => 'shop.index',
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
            'style' => 'dropdown',
            'name' => 'Orders',
            'items' => [
                [
                    'name' => 'Pending',
                    'route' => 'reseller.order.index',
                    'param' => 'filter[status]=pending',
                ],
                [
                    'name' => 'Accepted',
                    'route' => 'reseller.order.index',
                    'param' => 'filter[status]=accepted',
                ],
                [
                    'name' => 'Processing',
                    'route' => 'reseller.order.index',
                    'param' => 'filter[status]=processing',
                ],
                [
                    'name' => 'Transporting',
                    'route' => 'reseller.order.index',
                    'param' => 'filter[status]=transporting',
                ],
                [
                    'name' => 'Completed',
                    'route' => 'reseller.order.index',
                    'param' => 'filter[status]=completed',
                ],
            ],
        ],
        [
            'icon' => 'fa fa-book',
            'style' => 'simple',
            'name' => 'Books',
            'url' => 'slfjs',
            'badge' => [
                'variant' => 'secondary',
                'data' => 4,
            ],
        ],
        [
            'icon' => 'fa fa-table',
            'style' => 'simple',
            'name' => 'Attendance',
            'url' => 'attendances.index',
        ],
        [
            'style' => 'title',
            'name' => 'Person',
        ],
        [
            'icon' => 'fa fa-server',
            'style' => 'dropdown',
            'name' => 'Applicants',
            'items' => [
                [
                    'name' => 'All',
                    'url' => 'standards.index',
                ],
                [
                    'name' => 'Create',
                    'url' => 'standards.create',
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
        $view->with('provider', 'resellers');
    }
}