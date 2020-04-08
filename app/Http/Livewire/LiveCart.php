<?php

namespace App\Http\Livewire;

use Darryldecode\Cart\Facades\CartFacade;
use Livewire\Component;
use Cart;

class LiveCart extends Component
{
    public $cart;
    public $user_id;
    public $subTotal;
    public $total;
    public $payable;
    public $shipping;
    public $advanced;
    public $success;
    public $delete;

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->user_id = auth('reseller')->user()->id;
        $this->shipping = 100;
        $this->advanced = 100;
        $this->theMoney();
    }

    public function increment($id)
    {
        CartFacade::session($this->user_id)->update($id, [
            'quantity' => 1
        ]);
        $this->theMoney();
    }

    public function decrement($id)
    {
        CartFacade::session($this->user_id)->update($id, [
            'quantity' => -1
        ]);
        $this->theMoney();
    }

    public function changed()
    {
        $this->theMoney();
    }

    public function remove($id)
    {
        Cart::session($this->user_id)->remove($id);
        unset($this->cart[$id]);
        $this->theMoney();
        $this->success = "Cart Item Removed.";
    }

    public function render()
    {
        return view('livewire.live-cart');
    }

    protected function theMoney()
    {
        $this->subTotal = theMoney(Cart::session($this->user_id)->getSubTotal());
        $this->total = theMoney(Cart::session($this->user_id)->getTotal());
        $this->payable = Cart::session($this->user_id)->getTotal()
                        + (empty($this->shipping) ? 0 : $this->shipping)
                        - (empty($this->advanced) ? 0 : $this->advanced);
    }
}
