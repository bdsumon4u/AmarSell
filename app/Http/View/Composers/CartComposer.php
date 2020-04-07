<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user_id = auth('reseller')->user()->id;
        $cart = Cart::session($user_id)->getContent();
        $view->with('cart', $cart);
    }
}