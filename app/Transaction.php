<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['reseller_id', 'amount', 'method', 'bank_name', 'account_name', 'branch', 'routing_no', 'account_type', 'account_number', 'transaction_number', 'status'];

    /**
     * Reseller
     */
    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}
