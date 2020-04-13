<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Currency
     */
    protected $currency = 'BDT';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'code', 'description', 'wholesale', 'retail',
    ];

    /**
     * Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
