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
     * Parent
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Formatted
     */
    public static function formatted()
    {
        return cache('categories.formatted', function () {
            $formatted = self::whereNull('parent_id')->with('childrens')->get();
            cache(['categories.formatted' => $formatted]);
            return $formatted;
        });
    }
}