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
        'reseller_id', 'data', 'buy_price', 'sell_price', 'status',
    ];

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = serialize($data);
    }

    public function getDataAttribute($data)
    {
        return unserialize($data);
    }
}
