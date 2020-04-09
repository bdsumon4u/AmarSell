<?php

namespace App\Http\View\Composers\Layout;

use Illuminate\View\View;

class HeaderComposer
{
    /**
     * Menu
     */
    public $menu = [
        [
            'icon' => 'fa fa-tachometer',
            'style' => 'simple',
            'name' => 'Dashboard',
            'url' => 'home',
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
            'style' => 'dropdown',
            'name' => 'Categories',
            'items' => [
                [
                    'name' => 'All',
                    'route' => 'categories.index',
                ],
                [
                    'name' => 'Create',
                    'route' => 'categories.create',
                ],
            ],
        ],
        [
            'icon' => 'fa fa-server',
            'style' => 'dropdown',
            'name' => 'Standards',
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
            'icon' => 'fa fa-th-list',
            'style' => 'dropdown',
            'name' => 'Subjects',
            'items' => [
                [
                    'name' => 'All',
                    'url' => 'subjects.index',
                ],
                [
                    'name' => 'Create',
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