<?php

namespace App\Http\Livewire;

use App\Reseller;
use Livewire\Component;

class PaymentCalculator extends Component
{
    public $reseller;
    public $balance;
    public $amount;
    public $method;

    public function mount(Reseller $reseller)
    {
        $this->reseller = $reseller;
        $this->calc();
    }

    public function render()
    {
        return view('livewire.payment-calculator');
    }

    public function calc()
    {
        $this->balance = $this->reseller->balance - (is_numeric($this->amount) ? $this->amount : 0);
    }
}
