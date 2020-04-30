<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\Reseller\VerifyEmail;
use App\Notifications\Reseller\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Reseller extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'payment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'payment' => 'object',
    ];

    /**
     * Set Hashed Password Attribute
     * 
     * @param string $password
     * 
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password)
                                        ? Hash::make($password)
                                        : $password;
    }

    /**
     * Set Payment Attribute
     * 
     * @param array $payment
     * 
     * @return void
     */
    public function setPaymentAttribute($payment)
    {
        $this->attributes['payment'] = json_encode($payment);
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Shops
     */
    public function shops()
    {
        return $this->hasMany(Shop::class, 'reseller_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getPaidAttribute()
    {
        return $this->transactions->sum(function($transaction) { return $transaction->amount; });
    }

    /**
     * Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPendingOrdersAttribute()
    {
        return $this->orders->where('status', 'pending');
    }

    public function getNonPendingOrdersAttribute()
    {
        return $this->orders->where('status', '!=', 'pending');
    }

    public function getCompletedOrdersAttribute()
    {
        return $this->orders->where('status', 'completed');
    }

    public function getTotalSellAttribute()
    {
        return $this->orders->sum(function($order){ return $order->data['sell']; });
    }

    public function getPendingSellAttribute()
    {
        return $this->pending_orders->sum(function($order){ return $order->data['sell']; });
    }
    
    public function getCompletedSellAttribute()
    {
        return $this->completed_orders->sum(function($order){ return $order->data['sell']; });
    }

    /**
     * Balance
     */
    public function getBalanceAttribute()
    {
        $non_pending = $this->non_pending_orders;
        $completed = $this->completed_orders;

        $completed_advanced = $completed->sum(function($order){ return $order->data['advanced']; });
        $completed_shipping = $completed->sum(function($order){ return $order->data['shipping']; });

        $completed_buy = $completed->sum(function($order){ return $order->data['price']; });
        $non_pending_charges = $non_pending->sum(function($order){ return $order->data['delivery_charge'] + $order->data['packaging'] + $order->data['cod_charge']; });


        $balance = $this->completed_sell - $completed_advanced - $completed_buy - $non_pending_charges + $completed_shipping - ($this->paid);

        return $balance;
    }
}
