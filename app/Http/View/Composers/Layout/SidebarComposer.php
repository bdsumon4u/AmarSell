<?php

namespace App\Http\View\Composers\Layout;

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
                    'url' => 'subjects.index',
                ],
                [
                    'name' => 'Accepted',
                    'url' => 'subjects.create',
                ],
                [
                    'name' => 'Processing',
                    'url' => 'subjects.create',
                ],
                [
                    'name' => 'Transporting',
                    'url' => 'subjects.create',
                ],
                [
                    'name' => 'Completed',
                    'url' => 'subjects.create',
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
        $view->with('provider', 'web');
    }
}