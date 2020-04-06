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
        'title', 'slug', 'code', 'description', 'wholesale_price', 'retail_price',
    ];

    /**
     * Price
     */
    public function getWholesalePriceAttribute($price)
    {
        return "$this->currency $price";
    }
    
    public function getRetailPriceAttribute($price)
    {
        return "$this->currency $price";
    }

    /**
     * Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
