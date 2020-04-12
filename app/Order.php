<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reseller_id', 'data', 'status',
    ];

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = serialize($data);
    }

    public function getDataAttribute($data)
    {
        return unserialize($data);
    }

    public function current_price()
    {
        $products = Product::whereIn('id', array_keys($this->data['products']))->get();
        $sum = $products->sum(function ($product) {
            return $product->wholesale * $this->data['products'][$product->id]['quantity'];
        });
        return $sum;
    }

    /**
     * Reseller
     */
    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}
