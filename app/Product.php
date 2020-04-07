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
        return number_format($price / 100, 2);
    }
    
    public function getRetailPriceAttribute($price)
    {
        return number_format($price / 100, 2);
    }

    public function setWholesalePriceAttribute($price)
    {
        return intval($price * 100, 10);
    }
    
    public function setRetailPriceAttribute($price)
    {
        return intval($price * 100, 10);
    }

    /**
     * Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
