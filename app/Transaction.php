<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['reseller_id', 'amount', 'method', 'account_number', 'transaction_number'];

    /**
     * Reseller
     */
    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}
