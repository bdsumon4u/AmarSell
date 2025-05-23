<?php

namespace App\Http\Livewire;

use App\Pathao\Apis\AreaApi;
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
    public $shops;
    public $success;
    public $delete;

    public $cities = [];
    public $zones = [];
    public $selectedCity;
    public $selectedZone;
    public $deliveryMethod;

    public function mount($type, $cart, $sell = 0, $shipping = 100, $advanced = 100)
    {
        $this->type = $type;
        $this->cart = $cart;
        $this->user_id = auth('reseller')->user()->id;
        $this->sell = $sell;
        $this->shipping = $shipping;
        $this->advanced = $advanced;
        $this->theMoney();
        $this->shops = auth('reseller')->user()->shops;
        $this->loadCities();
    }

    public function loadCities()
    {
        try {
            $areaApi = new AreaApi();
            $this->cities = json_decode(json_encode($areaApi->city()->data), true);
        } catch (\Exception $e) {
            $this->cities = [];
        }
    }

    public function loadZones()
    {
        if ($this->selectedCity) {
            try {
                $areaApi = new AreaApi();
                $this->zones = json_decode(json_encode($areaApi->zone($this->selectedCity)->data), true);
            } catch (\Exception $e) {
                $this->zones = [];
            }
        } else {
            $this->zones = [];
        }
    }

    public function updatedSelectedCity()
    {
        $this->loadZones();
        $this->selectedZone = '';
    }

    public function increment($id)
    {
        $cart = CartFacade::session($this->user_id);
        $cart->update($id, [
            'quantity' => 1
        ]);
        $this->cart = $cart->getContent()->toArray();
        
        $this->sell = $this->retail();
        $this->theMoney();
    }

    public function decrement($id)
    {
        $cart = CartFacade::session($this->user_id);
        $cart->update($id, [
            'quantity' => -1
        ]);
        $this->cart = $cart->getContent()->toArray();
        
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
                        return $item->attributes->product->retail * $item->quantity;
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
