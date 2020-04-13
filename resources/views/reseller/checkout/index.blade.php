@extends('reseller.shop.layout')

@section('styles')
@livewireStyles
@endsection

@section('content')
<div class="row">
    <div class="cart-list-wrapper clearfix">
        @livewire('live-cart', [
            'type' => 'checkout',
            'sell' => $sell,
            'shipping' => $shipping,
            'advanced' => $advanced,
            'cart' => $cart->toArray()
        ])
    </div>
</div>
@endsection

@section('scripts')
@livewireScripts
@endsection