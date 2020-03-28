<?php

namespace App\Helpers\Traits;

use App\Category;

trait CategoryModelHelper
{
    /**
     * Childrens
     */
    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('childrens');
    }

    /**
     * Formatted
     */
    public static function formatted()
    {
        return self::whereNull('parent_id')->with('childrens')->get();
    }
}