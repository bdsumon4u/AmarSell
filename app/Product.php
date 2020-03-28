<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'code', 'description', 'wholesale_price', 'retail_price',
    ];

    /**
     * Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
