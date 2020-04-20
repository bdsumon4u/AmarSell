<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reseller_id', 'name', 'email', 'phone', 'logo',
    ];

    /**
     * Owner
     */
    public function owner()
    {
        return $this->belongsTo(Reseller::class, 'reseller_id', 'id');
    }
}
