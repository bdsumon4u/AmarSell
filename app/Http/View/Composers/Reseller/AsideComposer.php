<?php

namespace App\Http\View\Composers\Reseller;

use Illuminate\View\View;

class AsideComposer
{
    /**
     * Aside Tab
     */
    public $asideTab = [
        [
            'title' => 'Account',
            'id' => 'account',
            'view' => 'reseller.aside.account',
        ],
    ];

    /**
     * Calculation
     */
    public function calculation()
    {
        $orders = auth('reseller')->user()->orders;
        $pending = $orders->where('status', 'pending');
        $not_pending = $orders->where('status', '!=', 'pending');
        $completed = $orders->where('status', 'completed');

        $completed_advanced = $completed->sum(function($order){ return $order->data['advanced']; });
        $completed_shipping = $completed->sum(function($order){ return $order->data['shipping']; });

        $total_sell = $orders->sum(function($order){ return $order->data['sell']; });
        $pending_sell = $pending->sum(function($order){ return $order->data['sell']; });
        $completed_sell = $completed->sum(function($order){ return $order->data['sell']; });

        $completed_buy = $completed->sum(function($order){ return $order->data['price']; });
        $not_pending_charges = $not_pending->sum(function($order){ return $order->data['delivery_charge'] + $order->data['packaging'] + $order->data['cod_charge']; });

        $paid = 0;

        $my_balance = $completed_sell - $completed_advanced - $completed_buy - $not_pending_charges + $completed_shipping - ($paid);

        $calculation['total_sell'] = theMoney($total_sell);
        $calculation['pending_sell'] = theMoney($pending_sell);
        $calculation['completed_sell'] = theMoney($completed_sell);

        $calculation['my_balance'] = theMoney($my_balance);

        return $calculation;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('asideTab', $this->asideTab);
        $view->with('calculation', $this->calculation());
    }
}