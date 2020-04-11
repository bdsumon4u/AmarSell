<?php

namespace App\Http\Livewire;

use Darryldecode\Cart\Facades\CartFacade;
use Livewire\Component;
use Cart;

class LiveCart extends Component
{
    public $type;
    public $cart;
    public $user_id;
    public $subTotal;
    public $total;
    public $payable;
    public $sell;
    public $shipping;
    public $advanced;
    public $success;
    public $delete;

    public function mount($type, $cart, $sell = 0, $shipping = 100, $advanced = 100)
    {
        $this->type = $type;
        $this->cart = $cart;
        $this->user_id = auth('reseller')->user()->id;
        $this->sell = $sell;
        $this->shipping = $shipping;
        $this->advanced = $advanced;
        $this->theMoney();
    }

    public function increment($id)
    {
        CartFacade::session($this->user_id)->update($id, [
            'quantity' => 1
        ]);
        $this->cart[$id]['quantity'] = $this->cart[$id]['quantity'] + 1;
        
        $this->sell = $this->retail();
        $this->theMoney();
    }

    public function decrement($id)
    {
        CartFacade::session($this->user_id)->update($id, [
            'quantity' => -1
        ]);
        $this->cart[$id]['quantity'] = $this->cart[$id]['quantity'] - 1 > 0
                                            ? $this->cart[$id]['quantity'] - 1
                                            : 1;
        
        $this->sell = $this->retail();
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
        $this->sell = $this->retail();
        $this->theMoney();
        $this->success = "Cart Item Removed.";
    }

    public function render()
    {
        return view('livewire.live-cart');
    }

    protected function retail()
    {
        return Cart::session($this->user_id)
                    ->getContent()
                    ->sum(function ($item) {
                        return $item->attributes->product->retail_price * $item->quantity;
                    });
    }

    protected function theMoney()
    {
        $this->sell = $this->sell > 0
                        ? $this->sell
                        : $this->retail();
        $this->subTotal = theMoney(Cart::session($this->user_id)->getSubTotal());
        $this->total = theMoney(Cart::session($this->user_id)->getTotal());
        $this->payable = $this->sell
                        + (empty($this->shipping) ? 0 : round($this->shipping))
                        - (empty($this->advanced) ? 0 : round($this->advanced));
    }
}
